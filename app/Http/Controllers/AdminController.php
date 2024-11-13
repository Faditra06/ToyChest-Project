<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
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

    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sort_by');

        // Mulai query User
        $users = User::query();

        // Filter berdasarkan pencarian nama
        if ($search) {
            $users->where('name', 'like', '%' . $search . '%');
        }

        // Logika sorting berdasarkan parameter `sort_by`
        if ($sortBy === 'newest') {
            $users->orderBy('created_at', 'desc');
        } elseif ($sortBy === 'oldest') {
            $users->orderBy('created_at', 'asc');
        } elseif ($sortBy === 'name_asc') {
            $users->orderBy('name', 'asc');
        } elseif ($sortBy === 'name_desc') {
            $users->orderBy('name', 'desc');
        }

        // Paginate dan append query string agar tetap ada di URL
        $users = $users->paginate(10)->appends($request->query());

        return view('admin.manage-user', compact('users'));
    }
}
