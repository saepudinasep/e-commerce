<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Order_Items;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $order->id = random_int(100, 999); // Generate random unique order_id
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


        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $user = Auth::user();
        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->total_amount,
            ),
            'customer_details' => array(
                'first_name' => $user->name,
                'last_name' => $user->name,
                'email' => $user->email,
                'phone' => '08111222333',
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Simpan snapToken ke dalam order
        $order->snapToken = $snapToken;
        $order->save();

        return redirect()->route('checkout.show', $order->id);
    }

    public function show($id, Request $request)
    {
        // $order = Order_items::where('order_id', $id)->get();
        // Ambil pesanan dan relasinya
        $order = Orders::with('items.product')->findOrFail($id);

        // Pastikan pengguna yang melihat pesanan adalah pemilik pesanan
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'Unauthorized access');
        }

        return view('checkout', compact('order'));
    }

    public function process(Request $request)
    {
        dd($request->all());
    }
}
