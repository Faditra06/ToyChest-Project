<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function products(Request $request)
    {
        $products = Product::all(); // Ambil semua produk dari database
        $randomProducts = Product::inRandomOrder()->paginate(16);
        return view('user.shop', compact('randomProducts')); // Pastikan 'products' dikirim ke view
    }
}
