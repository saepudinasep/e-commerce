<?php

namespace App\Http\Controllers;

use App\Models\Cart_Items;
use App\Models\Carts;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    public function index()
    {
        $cart = Carts::where('user_id', Auth::id())->first();
        return view('cart', compact('cart'));
    }

    public function add(Request $request, $productId)
    {
        // Validasi input
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->input('quantity');
        $cart = Carts::firstOrCreate(['user_id' => Auth::id()]);
        $product = Products::findOrFail($productId);

        // Cek apakah item sudah ada di keranjang
        $cartItem = $cart->items()->where('product_id', $productId)->first();

        if ($cartItem) {
            // Jika item sudah ada, update kuantitas
            $cartItem->quantity += $quantity;
        } else {
            // Jika item belum ada, tambahkan item baru ke keranjang
            $cartItem = new Cart_Items(['product_id' => $productId, 'quantity' => $quantity]);
            $cart->items()->save($cartItem);
        }

        // Simpan perubahan
        $cartItem->save();

        // Redirect dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart_Items::findOrFail($id);
        $cartItem->quantity = $request->input('quantity');
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully');
    }

    public function remove($id)
    {
        $cartItem = Cart_Items::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }
}
