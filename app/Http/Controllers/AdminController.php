<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    // Di AdminController.php
    public function home()
    {
        return view('admin.home');
    }

    public function users()
    {
        $users = User::paginate(10);
        return view('admin.manage-user', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.users');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User successfully deleted');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $users = User::query();

        // Menambahkan logika search
        if ($search) {
            $users->where('name', 'like', '%' . $search . '%');
        }

        $users = $users->paginate(10)->appends(request()->query());

        return view('admin.manage-user', compact('users',));
    }

    public function sort(Request $request)
    {
        $sortBy = $request->input('sort_by');
        $query = User::query();

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

        $users = $query->paginate(10)->appends(request()->query());

        return view('admin.manage-user', compact('users'));
    }

    public function showTransactions()
    {
        $transactions = $this->getTransactionStatus('your_order_id');
        return view('admin.transactions', compact('transactions'));
    }
}
