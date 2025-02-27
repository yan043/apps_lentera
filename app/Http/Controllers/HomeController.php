<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        if (!Session::get('is_logged_in'))
        {
            return redirect()->route('login')->withErrors(['login' => 'Harap login terlebih dahulu.']);
        }

        return view('additionals.home');
    }
}
