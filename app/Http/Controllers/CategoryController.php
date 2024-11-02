<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $categories = Category::with('children')->get();
        return view('admin.manage-category', compact('categories'));
    }

    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get(); // Menampilkan hanya kategori induk
        return view('admin.categories.create', compact('categories'));
    }

    // Menyimpan kategori baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        // Membuat slug dari nama kategori
        $slug = Str::slug($request->name);

        Category::create([
            'name' => $request->name,
            'slug' => $slug, // Tambahkan slug
            'parent_id' => $request->parent_id
        ]);

        return redirect()->back()->with('success', 'Category added successfully.');
    }


    // Menampilkan form untuk mengedit kategori
    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    // Mengupdate kategori yang dipilih
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        // Update data kategori
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect()->back()->with('success', 'Category updated successfully.');
    }


    // Menghapus kategori
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return redirect()->back()->with('success', 'Category deleted successfully');
        }
        return redirect()->back()->with('error', 'Category not found');
    }

    public function ss(Request $request)
    {
        $query = Category::query();
        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sort by name
        if ($request->filled('sort')) {
            if ($request->sort === 'name_asc') {
                $query->orderBy('name', 'asc');
            } elseif ($request->sort === 'name_desc') {
                $query->orderBy('name', 'desc');
            }
        }

        $categories = $query->paginate(10)->appends(request()->query());

        return view('admin.manage-category', compact('categories'));
    }
}
