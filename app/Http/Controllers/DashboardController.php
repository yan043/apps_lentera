<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\DashboardModel;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Session::get('is_logged_in'))
        {
            return redirect()->route('login')->withErrors(['login' => 'Harap login terlebih dahulu.']);
        }

        return view('dashboard.index');
    }
}
