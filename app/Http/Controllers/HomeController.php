<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Cek apakah user tipe admin
        if (Auth::user()->usertype === 'admin') {
            return view('admin.home'); // Mengembalikan tampilan untuk admin
        } else {
            return view('user.home'); // Mengembalikan tampilan untuk user
        }
    }
}
