<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class WebhooksController extends Controller
{
    public function handle(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $order = Orders::where('id', $request->order_id)->first();

            if ($order) {
                // Update order status based on transaction_status
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $order->update(['status' => 'completed']);
                }

                // Update va_number if available
                if (isset($request->va_numbers[0]['va_number'])) {
                    $order->update(['va_number' => $request->va_numbers[0]['va_number']]);
                }

                // Simpan informasi webhook untuk logging
                $order->webhooks()->create([
                    'event' => $request->transaction_status,
                    'payload' => $request->all()
                ]);
            } else {
                return response()->json(['message' => 'Order not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid signature key'], 400);
        }

        return response()->json(['message' => 'Webhook received']);
    }
}
