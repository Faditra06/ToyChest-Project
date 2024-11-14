<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->usertype === 'admin') {
            return redirect()->route('admin.home'); // Admin ke halaman admin
        } else {
            return redirect()->route('user.products.index'); // User ke halaman user
        }
    }
    public function home()
    {
        return view('user.home');
    }
}
