<?php

namespace App\Http\Controllers;

use App\Models\Order_Items;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function show($id)
    {
        $order = Order_Items::where('order_id', $id)->get();
        return "show";
    }

    public function invoice($id)
    {
        $order = Orders::findOrFail($id);
        return view('invoice', compact('order'));
    }

    public function belum_bayar()
    {
        // $order = Orders::all();
        $orders = Orders::where('status', '=', 'pending')->get();
        return view('belum-bayar', compact('orders'));
    }

    public function dikemas()
    {
        $orders = Orders::where('status', '=', 'completed')->get();
        return view('dikemas', compact('orders'));
        // return "dikemas";
    }

    public function dikirim()
    {
        return "dikirim";
    }
}
