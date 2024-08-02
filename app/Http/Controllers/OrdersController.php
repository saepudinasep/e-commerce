<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function show()
    {
        return "show";
    }

    public function status()
    {
        return "status";
    }

    public function belum_bayar()
    {
        // $order = Orders::all();
        $orders = Orders::where('status', '=', 'pending')->get();
        return view('belum-bayar', compact('orders'));
    }

    public function dikemas()
    {
        return "dikemas";
    }

    public function dikirim()
    {
        return "dikirim";
    }
}
