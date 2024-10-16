<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
            'name' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.manage-category')->with('success', 'Category succesfully added');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    // Mengupdate kategori yang dipilih
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'slug' => 'required|unique:categories,slug,' . $category->id,
        ]);

        $category->update($request->all());

        return redirect()->route('admin.manage-category')->with('success', 'Category succesfully updated');
    }

    // Menghapus kategori
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.manage-category')->with('success', 'Category succesfully deleted');
    }
}