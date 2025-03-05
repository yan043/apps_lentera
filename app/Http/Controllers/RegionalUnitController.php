<?php

namespace App\Http\Controllers;

use App\Models\RegionalUnitModel;
use Illuminate\Http\Request;

class RegionalUnitController extends Controller
{
    public function regional()
    {
        return view('regional-unit.regional');
    }

    public function witel()
    {
        return view('regional-unit.witel');
    }

    public function unit()
    {
        return view('regional-unit.unit');
    }

    public function mitra()
    {
        return view('regional-unit.mitra');
    }
}
