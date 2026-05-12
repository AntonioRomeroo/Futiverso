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
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra el formulario de checkout.
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Calcular descuento si hay cupón en la sesión
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

        return view('checkout', compact('cart', 'total', 'discount', 'finalTotal'));
    }

    /**
     * Procesa el pedido.
     */
    public function process(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            // 1. Calcular total
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            // APLICAR DESCUENTO SI HAY CUPÓN
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

            // 2. Crear el pedido
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $finalTotal,
                'status' => 'Pendiente',
                'address' => $request->address,
                'phone' => $request->phone,
                'notes' => $request->notes,
            ]);

            // 3. Crear los items del pedido y descontar stock
            foreach ($cart as $item) {
                $product = Product::find($item['id']);
                
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

                // Descontar stock
                $product->decrement('stock', $item['quantity']);
            }

            DB::commit();

            // 4. Limpiar carrito y cupón
            session()->forget(['cart', 'coupon']);

            return redirect()->route('inicio')->with('success', '¡Pedido realizado con éxito! Gracias por confiar en Futiverso.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Hubo un error al procesar tu pedido: ' . $e->getMessage());
        }
    }
}
