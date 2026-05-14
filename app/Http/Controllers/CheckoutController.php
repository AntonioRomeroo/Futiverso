<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * El constructor asegura que solo los usuarios que hayan iniciado sesión puedan acceder a estas rutas.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la pantalla final de pago y envío (Checkout).
     */
    public function index()
    {
        // 1. Obtenemos el carrito. Si está vacío, devolvemos al usuario con un error.
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        // 2. Calculamos el total base de los productos sumando sus precios por sus cantidades.
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 3. Revisamos si hay algún cupón de descuento activo en la sesión y lo aplicamos.
        $discount = 0;
        if (session('coupon')) {
            $c = session('coupon');
            if ($c['type'] === 'fixed') {
                // Descuento fijo (ej. 10€)
                $discount = $c['value'];
            } else {
                // Descuento por porcentaje (ej. 20%)
                $discount = ($c['value'] / 100) * $total;
            }
        }
        
        // Calculamos el total final asegurando que nunca sea menor a 0.
        $finalTotal = max(0, $total - $discount);

        return view('checkout', compact('cart', 'total', 'discount', 'finalTotal'));
    }

    /**
     * Recibe los datos de envío, crea el pedido en la base de datos y vacía el carrito.
     */
    public function process(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        // 1. Validamos que el usuario ha introducido una dirección y teléfono válidos.
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:500',
        ]);

        // Usamos una "transacción" de base de datos. Esto significa que si algo falla
        // a mitad del proceso (ej. no hay stock), se deshace todo y no se crea un pedido a medias.
        try {
            DB::beginTransaction();

            // 2. Volvemos a calcular el total y el descuento por seguridad.
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $discount = 0;
            if (session('coupon')) {
                $c = session('coupon');
                if ($c['type'] === 'fixed') {
                    $discount = $c['value'];
                } else {
                    $discount = ($c['value'] / 100) * $total;
                }
            }
            $finalTotal = max(0, $total - $discount);

            // 3. Guardamos el pedido (Order) en la base de datos.
            $order = Order::create([
                'user_id' => Auth::id(), // El ID del usuario conectado
                'total' => $finalTotal,
                'status' => 'Pendiente', // El estado inicial
                'address' => $request->address,
                'phone' => $request->phone,
                'notes' => $request->notes,
            ]);

            // 4. Guardamos cada línea de producto (OrderItem) asociada al pedido.
            foreach ($cart as $item) {
                $product = Product::find($item['id']);
                
                // Comprobamos si nos hemos quedado sin stock justo antes de pagar.
                if (!$product || $product->stock < $item['quantity']) {
                    throw new \Exception("Stock insuficiente para el producto: " . ($product->nombre ?? 'Desconocido'));
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'talla' => $item['talla'],
                    'custom_name' => $item['custom_name'],
                    'custom_number' => $item['custom_number'],
                    'price' => $item['price'],
                ]);

                // 5. Restamos el stock comprado del producto.
                $product->decrement('stock', $item['quantity']);
            }

            // Si todo ha ido bien, confirmamos la transacción y lo guardamos definitivamente.
            DB::commit();

            // 6. Vaciamos el carrito y quitamos el cupón porque ya se han usado.
            session()->forget(['cart', 'coupon']);

            // 7. Redirigimos al inicio con mensaje de éxito.
            return redirect()->route('inicio')->with('success', '¡Pedido realizado con éxito! Gracias por confiar en Futiverso.');

        } catch (\Exception $e) {
            // Si algo falló, deshacemos la transacción y devolvemos al usuario con el error.
            DB::rollBack();
            return redirect()->back()->with('error', 'Hubo un error al procesar tu pedido: ' . $e->getMessage());
        }
    }
}
