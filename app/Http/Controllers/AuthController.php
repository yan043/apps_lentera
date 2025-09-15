<?php

namespace App\Http\Controllers;

use App\Models\AuthModel;
use App\Models\EmployeeManagementModel;
use App\Models\OrganizationStructureModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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
            'captcha'  => 'required|captcha',
        ], [
            'captcha.captcha' => 'The entered captcha is incorrect.',
        ]);

        $user = AuthModel::identity($request->nik);

        if ($user && Hash::check($request->password, $user->password))
        {
            if ($user->is_active == 0)
            {
                return back()->withErrors(['login' => 'User is not active!']);
            }

            Auth::login($user);

            $token = Str::random(60);

            $ip_address = null;

            if (isset($_SERVER['HTTP_CLIENT_IP']))
            {
                $ip_address = $_SERVER['HTTP_CLIENT_IP'];
            }
            elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            elseif (isset($_SERVER['HTTP_X_FORWARDED']))
            {
                $ip_address = $_SERVER['HTTP_X_FORWARDED'];
            }
            elseif (isset($_SERVER['HTTP_FORWARDED_FOR']))
            {
                $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
            }
            elseif (isset($_SERVER['HTTP_FORWARDED']))
            {
                $ip_address = $_SERVER['HTTP_FORWARDED'];
            }
            elseif (isset($_SERVER['REMOTE_ADDR']))
            {
                $ip_address = $_SERVER['REMOTE_ADDR'];
            }
            else
            {
                $ip_address = 'UNKNOWN';
            }

            AuthModel::set_token($request->nik, $token, $ip_address);

            $profile = AuthModel::profile($user->id);

            Session::put([
                'employee_id'    => $profile->id,
                'regional_id'    => $profile->regional_id,
                'regional_name'  => $profile->regional_name,
                'witel_id'       => $profile->witel_id,
                'witel_name'     => $profile->witel_name,
                'witel_alias'    => $profile->witel_alias,
                'mitra_id'       => $profile->mitra_id,
                'mitra_name'     => $profile->mitra_name,
                'sub_unit_id'    => $profile->sub_unit_id,
                'sub_unit_name'  => $profile->sub_unit_name,
                'sub_group_id'   => $profile->sub_group_id,
                'sub_group_name' => $profile->sub_group_name,
                'role_id'        => $profile->role_id,
                'role_name'      => $profile->role_name,
                'nik'            => $profile->nik,
                'full_name'      => $profile->full_name,
                'chat_id'        => $profile->chat_id,
                'number_phone'   => $profile->number_phone,
                'home_address'   => $profile->home_address,
                'gender'         => $profile->gender,
                'date_of_birth'  => $profile->date_of_birth,
                'place_of_birth' => $profile->place_of_birth,
                'remember_token' => $token,
                'is_logged_in'   => true,
            ]);

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['login' => 'NIK or password is incorrect!']);
    }

    public function logout()
    {
        Auth::logout();

        Session::flush();

        return redirect()->route('login');
    }

    public function deactivateAccount()
    {
        $user = AuthModel::find(Session::get('employee_id'));

        if ($user)
        {
            $user->update([
                'remember_token'   => null,
                'ip_address'       => null,
                'login_at'         => null,
                'google2fa_secret' => null,
                'password'         => null,
                'is_active'        => 0,
            ]);

            Auth::logout();

            Session::flush();
        }

        return redirect()->route('login')->with('success', 'Account has been successfully deactivated.');
    }

    public function profile()
    {
        $get_regional  = OrganizationStructureModel::get_data('tb_regional');
        $get_witel     = OrganizationStructureModel::get_witel();
        $get_mitra     = OrganizationStructureModel::get_mitra();
        $get_sub_unit  = OrganizationStructureModel::get_sub_unit();
        $get_sub_group = EmployeeManagementModel::get_sub_group();
        $get_role      = EmployeeManagementModel::get_role();

        $get_gender = collect([
            (object) ['id' => 'Laki-Laki', 'name' => 'Laki-Laki'],
            (object) ['id' => 'Perempuan', 'name' => 'Perempuan'],
        ]);

        $data = AuthModel::profile(Session::get('employee_id'));

        return view('auth.profile', ['get_regional' => $get_regional, 'get_witel' => $get_witel, 'get_sub_unit' => $get_sub_unit, 'get_mitra' => $get_mitra, 'get_sub_group' => $get_sub_group, 'get_role' => $get_role, 'get_gender' => $get_gender, 'data' => $data]);
    }

    public function storeProfile(Request $request)
    {
        $request->validate([
            'full_name'      => 'required|string|max:255',
            'chat_id'        => 'nullable|string|max:255',
            'number_phone'   => 'required|numeric|min:11',
            'home_address'   => 'nullable|string',
            'gender'         => 'required|string',
            'date_of_birth'  => 'nullable|date',
            'place_of_birth' => 'nullable|string|max:255',
            'regional_id'    => 'required|integer',
            'witel_id'       => 'required|integer',
            'mitra_id'       => 'required|integer',
            'sub_unit_id'    => 'required|integer',
            'sub_group_id'   => 'required|integer',
            'password'       => 'nullable|string|min:6',
        ]);

        $user = AuthModel::find(Session::get('employee_id'));

        if (! $user)
        {
            return back()->withErrors(['update' => 'User not found!']);
        }

        $user->update([
            'full_name'      => $request->full_name,
            'chat_id'        => $request->chat_id,
            'number_phone'   => $request->number_phone,
            'home_address'   => $request->home_address,
            'gender'         => $request->gender,
            'date_of_birth'  => $request->date_of_birth,
            'place_of_birth' => $request->place_of_birth,
            'regional_id'    => $request->regional_id,
            'witel_id'       => $request->witel_id,
            'mitra_id'       => $request->mitra_id,
            'sub_unit_id'    => $request->sub_unit_id,
            'sub_group_id'   => $request->sub_group_id,
        ]);

        if ($request->password)
        {
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            $token = Str::random(60);

            $ip_address = null;

            if (isset($_SERVER['HTTP_CLIENT_IP']))
            {
                $ip_address = $_SERVER['HTTP_CLIENT_IP'];
            }
            elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            elseif (isset($_SERVER['HTTP_X_FORWARDED']))
            {
                $ip_address = $_SERVER['HTTP_X_FORWARDED'];
            }
            elseif (isset($_SERVER['HTTP_FORWARDED_FOR']))
            {
                $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
            }
            elseif (isset($_SERVER['HTTP_FORWARDED']))
            {
                $ip_address = $_SERVER['HTTP_FORWARDED'];
            }
            elseif (isset($_SERVER['REMOTE_ADDR']))
            {
                $ip_address = $_SERVER['REMOTE_ADDR'];
            }
            else
            {
                $ip_address = 'UNKNOWN';
            }

            AuthModel::set_token($request->nik, $token, $ip_address);

            Session::forget(['remember_token', 'is_logged_in']);
        }

        return redirect()->route('profile')->with('success', 'Profile has been successfully updated!');
    }
}
