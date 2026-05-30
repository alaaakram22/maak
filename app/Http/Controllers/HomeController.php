<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect()
    {

        if (!Auth::check()) {
            return redirect('/login');
        }
        if (Auth::user()->role == 'admin') {
            return view('admin.home');
        } else {
            return view('user.home');
        }
    }
}
