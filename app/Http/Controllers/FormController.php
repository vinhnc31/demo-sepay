<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class FormController extends Controller
{
    public function showForm()
    {
        return view('order'); // Đảm bảo tên view chính xác
    }

    public function handleForm(Request $request)
    {
        // Validate the request data
        $request->validate([
            'price' => 'required|integer',
            'transaction' => 'required|string'
        ]);

        // Create a new order with default status as 1
        $order = Order::create([
            'price' => $request->input('price'),
            'transaction' => $request->input('transaction'),
            'status' => 1 // Default status
        ]);

        // Get bank account and bank name from config
        $bankAccount = config('app.bank_account');
        $bankName = config('app.bank_name');

        // Build the URL for the QR code image
        $amount = $order->price;
        $transaction = urlencode($order->transaction); // Encode the transaction to be URL-safe
        $qrUrl = "https://qr.sepay.vn/img?acc=$bankAccount&bank=$bankName&template=compacts&amount=$amount&des=$transaction";

        // Return the QR URL to be displayed on the form
        return response()->json(['qrUrl' => $qrUrl]);
    }
}
