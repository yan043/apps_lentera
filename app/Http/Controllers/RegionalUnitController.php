<?php

namespace App\Http\Controllers;

use App\Models\RegionalUnitModel;
use Illuminate\Http\Request;

class RegionalUnitController extends Controller
{
    public function regional()
    {
        $data = RegionalUnitModel::get_regional();

        return view('regional-unit.regional', ['data' => $data]);
    }

    public function witel()
    {
        $get_regional = RegionalUnitModel::get_regional();

        $data = RegionalUnitModel::get_witel();

        return view('regional-unit.witel', ['get_regional' => $get_regional, 'data' => $data]);
    }

    public function unit()
    {
        $data = RegionalUnitModel::get_unit();

        return view('regional-unit.unit', ['data' => $data]);
    }

    public function subUnit()
    {
        $get_unit = RegionalUnitModel::get_unit();

        $data = RegionalUnitModel::get_sub_unit();

        return view('regional-unit.sub-unit', ['get_unit' => $get_unit, 'data' => $data]);
    }

    public function mitra()
    {
        $get_witel = RegionalUnitModel::get_witel();

        $data = RegionalUnitModel::get_mitra();

        return view('regional-unit.mitra', ['get_witel' => $get_witel, 'data' => $data]);
    }
}
