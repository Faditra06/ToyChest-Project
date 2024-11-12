<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // Nama produk
            $table->unsignedBigInteger('category_id'); // Kategori produk, mengacu ke tabel categories
            $table->decimal('price', 15, 2);         // Harga produk dalam rupiah
            $table->integer('stock');                // Jumlah stok produk
            $table->text('description')->nullable(); // Deskripsi produk
            $table->string('image')->nullable();     // Gambar produk
            $table->timestamps();
            
            // Foreign key untuk menghubungkan ke tabel categories
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
