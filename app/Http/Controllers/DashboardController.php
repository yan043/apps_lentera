<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        if (! Session::get('is_logged_in'))
        {
            return redirect()->route('login')->withErrors(['login' => 'Please log in first.']);
        }

        return view('dashboard.index');
    }
}
