<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingsModel;

class SettingsController extends Controller
{
    public function regional()
    {
        $data = SettingsModel::regional();

        return view('settings.regional', compact('data'));
    }

    public function witel()
    {
        $data = SettingsModel::witel();

        return view('settings.witel', compact('data'));
    }

    public function mitra()
    {
        $witels = SettingsModel::witel();
        $data = SettingsModel::mitra();

        return view('settings.mitra', compact('witels', 'data'));
    }

    public function level()
    {
        $data = SettingsModel::level();

        return view('settings.level', compact('data'));
    }
}
