<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Muestra la lista de deseos del usuario.
     */
    public function index()
    {
        $wishlistItems = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();
        return view('wishlist', compact('wishlistItems'));
    }

    /**
     * Añade o quita un producto de la lista de deseos (Toggle).
     */
    public function toggle(Product $product)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return back()->with('success', 'Eliminado de tus favoritos.');
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id
            ]);
            return back()->with('success', '¡Añadido a tus favoritos!');
        }
    }

    /**
     * Elimina un producto de la lista (para el botón de la vista de wishlist).
     */
    public function remove(Wishlist $wishlist)
    {
        if ($wishlist->user_id === Auth::id()) {
            $wishlist->delete();
        }
        return redirect()->back()->with('success', 'Producto eliminado de favoritos.');
    }
}
