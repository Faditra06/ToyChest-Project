<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function users()
    {
        $users = User::all();
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

    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sort_by');

        $users = User::query();

        if ($request->filled('search')) {
            $users->where('name', 'like', '%' . $request->search . '%');
        }
        // Logika sorting berdasarkan parameter `sort_by`
        if ($sortBy === 'newest') {
            $users = $users->orderBy('created_at', 'desc');
        } elseif ($sortBy === 'oldest') {
            $users = $users->orderBy('created_at', 'asc');
        } elseif ($sortBy === 'name_asc') {
            $users = $users->orderBy('name', 'asc');
        } elseif ($sortBy === 'name_desc') {
            $users = $users->orderBy('name', 'desc');
        }

        $users = $users->paginate(10)->appends(request()->query());

        return view('admin.manage-user', compact('users'));
    }
}
