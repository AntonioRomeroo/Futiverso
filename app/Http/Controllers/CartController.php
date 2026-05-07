<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Muestra la página con el resumen del carrito.
     */
    public function index()
    {
        // Obtenemos el carrito de la sesión
        $cart = session()->get('cart', []);

        // Calculamos el total de la compra sumando precio * cantidad de cada item
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Enviamos el carrito y el total a la vista
        return view('carrito', compact('cart', 'total'));
    }

    /**
     * Esta función se encarga de recibir el producto y la talla,
     * y guardarlos en la sesión del navegador.
     */
    public function add(Request $request)
    {
        // 1. Recogemos los datos que vienen del formulario
        $productId = $request->input('product_id');
        $talla = $request->input('talla');
        $customName = $request->input('custom_name'); // Nuevo: Nombre personalizado
        $customNumber = $request->input('custom_number'); // Nuevo: Número personalizado

        // 2. Buscamos el producto en la base de datos para estar seguros de que existe
        $product = Product::findOrFail($productId);

        // 3. Obtenemos el carrito actual de la sesión
        $cart = session()->get('cart', []);

        // 4. Creamos una "clave única" para este producto, talla y personalización
        // Si la camiseta es diferente (distinto nombre/número), se guarda como un item separado
        $cartKey = $productId . '-' . $talla . '-' . $customName . '-' . $customNumber;

        if(isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                "id" => $product->id,
                "name" => $product->nombre,
                "quantity" => 1,
                "price" => $product->precio_oferta ?? $product->precio,
                "image" => $product->imagen_url ?? $product->imagen,
                "talla" => $talla,
                "custom_name" => $customName, // Guardamos el nombre
                "custom_number" => $customNumber // Guardamos el número
            ];
        }

        // 5. Guardamos el carrito actualizado de nuevo en la sesión
        session()->put('cart', $cart);

        // 6. Devolvemos al usuario a la página anterior con un mensaje de éxito
        return redirect()->back()->with('success', '¡Producto añadido al carrito correctamente!');
    }

    /**
     * Incrementa en 1 la cantidad de un producto específico.
     */
    public function increment($key)
    {
        $cart = session()->get('cart');

        if(isset($cart[$key])) {
            $cart[$key]['quantity']++;
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

    /**
     * Decrementa en 1 la cantidad. Si llega a 0, elimina el producto.
     */
    public function decrement($key)
    {
        $cart = session()->get('cart');

        if(isset($cart[$key])) {
            if($cart[$key]['quantity'] > 1) {
                $cart[$key]['quantity']--;
            } else {
                unset($cart[$key]); // Si es 1 y restamos, lo borramos
            }
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

    /**
     * Elimina el producto del carrito completamente.
     */
    public function remove($key)
    {
        $cart = session()->get('cart');

        if(isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }
}
