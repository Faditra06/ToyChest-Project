<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->string('transaction_status');
            $table->decimal('gross_amount', 15, 2);
            $table->string('payment_type');
            $table->string('merchant_id');
            $table->string('signature_key');
            $table->timestamp('transaction_time');
            $table->timestamp('settlement_time')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}