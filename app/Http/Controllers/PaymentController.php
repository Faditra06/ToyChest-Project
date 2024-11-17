<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Notification;
use App\Models\Transaction;

class PaymentController extends Controller
{
    public function handleNotification(Request $request)
    {
        // Terima data dari Midtrans
        $notif = new Notification();

        // Ambil informasi transaksi
        $transactionStatus = $notif->transaction_status;
        $orderId = $notif->order_id;
        $grossAmount = $notif->gross_amount;

        // Dapatkan informasi lebih lanjut jika diperlukan
        $paymentType = $notif->payment_type;
        $transactionTime = $notif->transaction_time;
        $settlementTime = $notif->settlement_time ?? null;

        // Menyimpan atau memperbarui data transaksi di tabel transaksi
        $transaction = Transaction::where('order_id', $orderId)->first();

        if ($transaction) {
            // Update status transaksi sesuai dengan notifikasi yang diterima
            $transaction->transaction_status = $transactionStatus;
            $transaction->gross_amount = $grossAmount;
            $transaction->payment_type = $paymentType;
            $transaction->transaction_time = $transactionTime;
            $transaction->settlement_time = $settlementTime;
            $transaction->save();
        }

        return response()->json(['status' => 'success']);
    }
}
