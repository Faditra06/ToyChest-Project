<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'transaction_status',
        'gross_amount',
        'payment_type',
        'merchant_id',
        'signature_key',
        'transaction_time',
        'settlement_time',
    ];
}
