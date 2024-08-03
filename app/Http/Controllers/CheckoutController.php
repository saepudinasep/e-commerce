<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Order_Items;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Carts::where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('message', 'Your cart is empty');
        }

        $order = new Orders();
        $order->user_id = Auth::id();
        $order->total_amount = $cart->items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $order->status = 'pending';
        $order->save();

        foreach ($cart->items as $item) {
            $orderItem = new Order_Items([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
            $order->items()->save($orderItem);
        }

        // Kosongkan keranjang
        $cart->items()->delete();

        return redirect()->route('checkout.show', $order->id);
    }

    public function show($id)
    {
        $order = Order_items::where('order_id', $id)->get();

        return view('checkout', compact('order'));
    }
}
