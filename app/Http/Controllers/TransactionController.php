<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Method untuk menangani webhook dari Midtrans
    public function handleMidtransWebhook(Request $request)
    {
        // Ambil data dari request (misalnya JSON body dari webhook)
        $data = $request->all();

        // Tampilkan data untuk debug
        \Log::debug('Data dari Midtrans:', $data);

        // Simpan data transaksi yang diterima ke database
        $this->storeTransaction($data);

        // Bisa merespons dengan status 200 jika berhasil
        return response()->json(['status' => 'success']);
    }

    // Method untuk menyimpan transaksi ke database
    public function storeTransaction($data)
    {
        $transaction = new Transaction();
        $transaction->order_id = $data['order_id'];
        $transaction->transaction_status = $data['transaction_status'];
        $transaction->gross_amount = $data['gross_amount'];
        $transaction->payment_type = $data['payment_type'];
        $transaction->merchant_id = $data['merchant_id'];
        $transaction->signature_key = $data['signature_key'];
        $transaction->transaction_time = $data['transaction_time'];
        $transaction->settlement_time = $data['settlement_time'] ?? null;
        $transaction->save();
    }

    // Fungsi untuk menampilkan transaksi di halaman admin
    public function showTransactions()
    {
        // Ambil semua transaksi dari database
        $transactions = Transaction::all();

        // Tampilkan transaksi di view
        return view('admin.transactions', compact('transactions'));
    }
}
