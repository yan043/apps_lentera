<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\UserModel;

class AuthController extends Controller
{
    public function auth()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nik'      => 'required|numeric',
            'password' => 'required|string',
        ]);

        $user = UserModel::identity($request->nik);

        if ($user && Hash::check($request->password, $user->password))
        {
            if ($user->is_active == 0)
            {
                return back()->withErrors(['login' => 'User Tidak Aktif!']);
            }

            Auth::login($user);

            $token = Str::random(60);

            $ip_address = null;

            if (isset($_SERVER['HTTP_CLIENT_IP']))
            {
                $ip_address = $_SERVER['HTTP_CLIENT_IP'];
            }
            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
            {
                $ip_address = $_SERVER['HTTP_X_FORWARDED'];
            }
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            {
                $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
            }
            else if(isset($_SERVER['HTTP_FORWARDED']))
            {
                $ip_address = $_SERVER['HTTP_FORWARDED'];
            }
            else if(isset($_SERVER['REMOTE_ADDR']))
            {
                $ip_address = $_SERVER['REMOTE_ADDR'];
            }
            else
            {
                $ip_address = 'UNKNOWN';
            }

            UserModel::set_token($request->nik, $token, $ip_address);

            Session::put([
                'regional_id'    => $user->regional_id,
                'witel_id'       => $user->witel_id,
                'mitra_id'       => $user->mitra_id,
                'level_id'       => $user->level->id,
                'level_name'     => $user->level->name,
                'nik'            => $user->nik,
                'full_name'      => $user->full_name,
                'chat_id'        => $user->chat_id,
                'number_phone'   => $user->number_phone,
                'home_address'   => $user->home_address,
                'gender'         => $user->gender,
                'date_of_birth'  => $user->date_of_birth,
                'place_of_birth' => $user->place_of_birth,
                'remember_token' => $token,
                'is_logged_in'   => true
            ]);

            return redirect()->route('home');
        }

        return back()->withErrors(['login' => 'NIK atau password salah!']);
    }


    public function logout()
    {
        Auth::logout();

        Session::flush();

        return redirect()->route('login');
    }
}
