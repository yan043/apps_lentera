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

    public function storeRegional(Request $request)
    {
        $data = $request->only(['id', 'name', 'alias']);

        if (isset($data['id']) && $data['id'])
        {
            RegionalUnitModel::update_data('tb_regional', $data['id'], $data);
        }
        else
        {
            RegionalUnitModel::insert_data('tb_regional', $data);
        }

        return redirect()->back()->with('success', 'Regional saved successfully.');
    }

    public function destroyRegional($id)
    {
        RegionalUnitModel::delete_data('tb_regional', $id);

        return redirect()->back()->with('success', 'Regional deleted successfully.');
    }

    public function witel()
    {
        $get_regional = RegionalUnitModel::get_data('tb_regional');

        return view('regional-unit.witel', ['get_regional' => $get_regional]);
    }

    public function storeWitel(Request $request)
    {
        $data = $request->only(['id', 'regional_id', 'name', 'alias']);

        if (isset($data['id']) && $data['id'])
        {
            RegionalUnitModel::update_data('tb_witel', $data['id'], $data);
        }
        else
        {
            RegionalUnitModel::insert_data('tb_witel', $data);
        }

        return redirect()->back()->with('success', 'Witel saved successfully.');
    }

    public function destroyWitel($id)
    {
        RegionalUnitModel::delete_data('tb_witel', $id);

        return redirect()->back()->with('success', 'Witel deleted successfully.');
    }

    public function subUnit()
    {
        $get_regional = RegionalUnitModel::get_data('tb_regional');

        return view('regional-unit.sub-unit', ['get_regional' => $get_regional]);
    }

    public function storeSubUnit(Request $request)
    {
        $data = $request->only(['id', 'regional_id', 'name']);

        if (isset($data['id']) && $data['id'])
        {
            RegionalUnitModel::update_data('tb_sub_unit', $data['id'], $data);
        }
        else
        {
            RegionalUnitModel::insert_data('tb_sub_unit', $data);
        }

        return redirect()->back()->with('success', 'Sub-Unit saved successfully.');
    }

    public function destroySubUnit($id)
    {
        RegionalUnitModel::delete_data('tb_sub_unit', $id);

        return redirect()->back()->with('success', 'Sub-Unit deleted successfully.');
    }

    public function subGroup()
    {
        return view('regional-unit.sub-group');
    }

    public function storeSubGroup(Request $request)
    {
        $data = $request->only(['id', 'name']);

        if (isset($data['id']) && $data['id'])
        {
            RegionalUnitModel::update_data('tb_sub_group', $data['id'], $data);
        }
        else
        {
            RegionalUnitModel::insert_data('tb_sub_group', $data);
        }

        return redirect()->back()->with('success', 'Sub-Group saved successfully.');
    }

    public function destroySubGroup($id)
    {
        RegionalUnitModel::delete_data('tb_sub_group', $id);

        return redirect()->back()->with('success', 'Sub-Group deleted successfully.');
    }

    public function mitra()
    {
        $get_witel = RegionalUnitModel::get_witel();

        return view('regional-unit.mitra', ['get_witel' => $get_witel]);
    }

    public function storeMitra(Request $request)
    {
        $data = $request->only(['id', 'witel_id', 'name', 'alias']);

        if (isset($data['id']) && $data['id'])
        {
            RegionalUnitModel::update_data('tb_mitra', $data['id'], $data);
        }
        else
        {
            RegionalUnitModel::insert_data('tb_mitra', $data);
        }

        return redirect()->back()->with('success', 'Mitra saved successfully.');
    }

    public function destroyMitra($id)
    {
        RegionalUnitModel::delete_data('tb_mitra', $id);

        return redirect()->back()->with('success', 'Mitra deleted successfully.');
    }
}
