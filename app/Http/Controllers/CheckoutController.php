<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Cart; // Asumsi Anda sudah memiliki model Cart
use App\Models\Transaction;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createSnapToken(Request $request)
    {
        // Ambil total harga dari keranjang belanja
        $cartItems = Cart::with('product')->get();
        $totalAmount = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Detail transaksi
        $transactionDetails = [
            'order_id' => rand(),
            'gross_amount' => $totalAmount, // Total belanja
        ];

        // Item detail
        $itemDetails = [];
        foreach ($cartItems as $item) {
            $itemDetails[] = [
                'id' => $item->product_id,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
                'name' => $item->product->name,
            ];
        }

        // Customer detail
        $customerDetails = [
            'first_name' => $request->user()->name,
            'email' => $request->user()->email,
            // Anda bisa menambahkan detail lain jika diperlukan
        ];

        // Data transaksi
        $transactionData = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        // Generate Snap token
        $snapToken = Snap::getSnapToken($transactionData);

        // Kirim snapToken ke view
        return response()->json(['snapToken' => $snapToken]);
    }

    // Fungsi untuk menangani webhook dari Midtrans
    public function handleWebhook(Request $request)
    {
        // Data yang diterima dari Midtrans
        $data = $request->all();

        // Verifikasi signature (opsional, bisa ditambahkan jika diperlukan)
        if (!$this->verifySignature($data)) {
            return response()->json(['status' => 'failed', 'message' => 'Invalid signature'], 400);
        }

        // Simpan data transaksi ke database
        $this->storeTransaction($data);

        // Kirim balasan ke Midtrans untuk konfirmasi
        return response()->json(['status' => 'success']);
    }

    public function getTransactionDetails($orderId)
    {
        
        // Cek apakah data sudah ada di database
        $transaction = Transaction::where('order_id', $orderId)->first();

        if ($transaction) {
            // Jika transaksi sudah ada di database, kembalikan data lokal
            return response()->json(['status' => 'success', 'data' => $transaction]);
        }

        // Jika tidak ada, ambil data dari Midtrans
        try {
            $status = \Midtrans\Transaction::status($orderId);

            // Simpan data transaksi ke database
            $transaction = new Transaction();
            $transaction->order_id = $status->order_id?? null;
            $transaction->transaction_status = $status->transaction_status?? null;
            $transaction->gross_amount = $status->gross_amount?? null;
            $transaction->payment_type = $status->payment_type?? null;
            $transaction->merchant_id = $status->merchant_id ?? null;
            $transaction->signature_key = $status->signature_key ?? null;
            $transaction->transaction_time = $status->transaction_time?? null;
            $transaction->settlement_time = $status->settlement_time ?? null;
            $transaction->save();

            return response()->json(['status' => 'success', 'data' => $transaction]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'message' => $e->getMessage()]);
        }
    }
}
