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
        $order = new Orders();
        $order->user_id = Auth::id();
        $order->total_amount = $cart->items->sum(fn ($item) => $item->product->price * $item->quantity);
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

        return view('checkout', compact('cart'));
    }
}
