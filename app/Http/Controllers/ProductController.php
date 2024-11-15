<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10); // Tampilkan 10 produk per halaman
        $categories = Category::all(); // Ambil semua kategori
        return view('admin.manage-product', compact('products', 'categories'));
    }

    public function guestindex(Request $request)
    {
        $products = Product::all(); // Ambil semua produk dari database
        $randomProducts = Product::inRandomOrder()->limit(8)->get();
        return view('index', compact('randomProducts')); // Pastikan 'products' dikirim ke view
    }

    public function userindex(Request $request)
    {
        $products = Product::all(); // Ambil semua produk dari database
        $randomProducts = Product::inRandomOrder()->limit(8)->get();
        return view('user.home', compact('randomProducts')); // Pastikan 'products' dikirim ke view
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('user.detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::delete($product->image);
            }
            // Simpan gambar baru
            $product->image = $request->file('image')->store('product_images', 'public');
        }

        $product->save();

        return redirect()->back()->with('success', 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Hapus gambar produk jika ada
        if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
            unlink(storage_path('app/public/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin.product')->with('success', 'Product deleted successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $products = Product::query();

        // Menambahkan logika search
        if ($search) {
            $products->where('name', 'like', '%' . $search . '%');
        }

        // Menambahkan kategori ke dalam view
        $categories = Category::all();
        $products = $products->paginate(10)->appends(request()->query());

        return view('admin.manage-product', compact('products', 'categories'));
    }

    public function sort(Request $request)
    {
        $sortBy = $request->input('sort_by');
        $query = Product::query();
        $categories = Category::all();

        // Logika sorting berdasarkan parameter `sort_by`
        if ($sortBy === 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sortBy === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sortBy === 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sortBy === 'name_desc') {
            $query->orderBy('name', 'desc');
        }

        $products = $query->paginate(10)->appends(request()->query());

        return view('admin.manage-product', compact('products', 'categories'));
    }
}
