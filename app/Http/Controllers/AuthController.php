<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\AuthModel;
use App\Models\EmployeeManagementModel;
use App\Models\RegionalUnitModel;

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
            'captcha'  => 'required|captcha'
        ], [
            'captcha.captcha' => 'Captcha yang dimasukkan salah.'
        ]);

        $user = AuthModel::identity($request->nik);

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

            AuthModel::set_token($request->nik, $token, $ip_address);

            Session::put([
                'employee_id'    => $user->id,
                'regional_id'    => $user->regional_id,
                'witel_id'       => $user->witel_id,
                'mitra_id'       => $user->mitra_id,
                'sub_unit_id'    => $user->sub_unit_id,
                'sub_group_id'   => $user->sub_group_id,
                'role_id'        => $user->role->id,
                'role_name'      => $user->role->name,
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

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['login' => 'NIK atau password salah!']);
    }

    public function logout()
    {
        Auth::logout();

        Session::flush();

        return redirect()->route('login');
    }

    public function profile()
    {
        $get_regional  = RegionalUnitModel::get_data('tb_regional');
        $get_witel     = RegionalUnitModel::get_witel();
        $get_mitra     = RegionalUnitModel::get_mitra();
        $get_sub_unit  = RegionalUnitModel::get_sub_unit();
        $get_sub_group = EmployeeManagementModel::get_sub_group();
        $get_role      = EmployeeManagementModel::get_role();

        $get_gender = collect([
            (object) ['id' => 'Laki-Laki', 'name' => 'Laki-Laki'],
            (object) ['id' => 'Perempuan', 'name' => 'Perempuan']
        ]);

        $data = AuthModel::profile(Session::get('employee_id'));

        return view('auth.profile', ['get_regional' => $get_regional, 'get_witel' => $get_witel, 'get_sub_unit' => $get_sub_unit, 'get_mitra' => $get_mitra, 'get_sub_group' => $get_sub_group, 'get_role' => $get_role, 'get_gender' => $get_gender, 'data' => $data]);
    }
}
