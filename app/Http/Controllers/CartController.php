<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        // Ambil semua item cart berdasarkan user yang sedang login
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();

        return view('cart', compact('cartItems'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'You need to login first!'], 401);
        }

        $userId = auth()->id();

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        $cartCount = Cart::where('user_id', $userId)->sum('quantity');

        return response()->json([
            'message' => 'Product added to cart!',
            'cartCount' => $cartCount,
        ]);
    }


    public function mashok(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You need to login first!');
        }

        $userId = auth()->id();

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart')->with('success', 'Product added to cart!');
    }

    public function destroy($id)
    {
        $cartItem = Cart::findOrFail($id);

        $cartItem->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('cart')->with('success', 'Quantity updated successfully!');
    }

    public function update(Request $request, Cart $cart)
    {
        // Validasi jumlah kuantitas
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Update kuantitas item dalam keranjang
        $cart->update([
            'quantity' => $request->quantity,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('cart')->with('success', 'Quantity updated successfully!');
    }

    public function emptyCart(Request $request)
    {
        // Kosongkan cart, misalnya dengan menghapus data cart di session
        Cart::where('user_id', auth()->id())->delete(); // Hapus cart untuk user yang sedang login

        // Atau hapus cart dari database jika menggunakan tabel cart
        // Cart::where('user_id', auth()->id())->delete();

        return response()->json(['success' => true]);
    }
}
