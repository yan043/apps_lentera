<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganizationStructureModel;

class OrganizationStructureController extends Controller
{
    public function regional()
    {
        return view('organization-structure.regional');
    }

    public function storeRegional(Request $request)
    {
        $data = $request->only(['id', 'name', 'alias']);

        if (isset($data['id']) && $data['id'])
        {
            OrganizationStructureModel::update_data('tb_regional', $data['id'], $data);
        }
        else
        {
            OrganizationStructureModel::insert_data('tb_regional', $data);
        }

        return redirect()->back()->with('success', 'Regional berhasil disimpan.');
    }

    public function destroyRegional($id)
    {
        OrganizationStructureModel::delete_data('tb_regional', $id);

        return redirect()->back()->with('success', 'Regional berhasil dihapus.');
    }

    public function witel()
    {
        $get_regional = OrganizationStructureModel::get_data('tb_regional');

        return view('organization-structure.witel', ['get_regional' => $get_regional]);
    }

    public function storeWitel(Request $request)
    {
        $data = $request->only(['id', 'regional_id', 'name', 'alias']);

        if (isset($data['id']) && $data['id'])
        {
            OrganizationStructureModel::update_data('tb_witel', $data['id'], $data);
        }
        else
        {
            OrganizationStructureModel::insert_data('tb_witel', $data);
        }

        return redirect()->back()->with('success', 'Witel berhasil disimpan.');
    }

    public function destroyWitel($id)
    {
        OrganizationStructureModel::delete_data('tb_witel', $id);

        return redirect()->back()->with('success', 'Witel berhasil dihapus.');
    }

    public function subUnit()
    {
        $get_regional = OrganizationStructureModel::get_data('tb_regional');

        return view('organization-structure.sub-unit', ['get_regional' => $get_regional]);
    }

    public function storeSubUnit(Request $request)
    {
        $data = $request->only(['id', 'regional_id', 'name']);

        if (isset($data['id']) && $data['id'])
        {
            OrganizationStructureModel::update_data('tb_sub_unit', $data['id'], $data);
        }
        else
        {
            OrganizationStructureModel::insert_data('tb_sub_unit', $data);
        }

        return redirect()->back()->with('success', 'Sub-Unit berhasil disimpan.');
    }

    public function destroySubUnit($id)
    {
        OrganizationStructureModel::delete_data('tb_sub_unit', $id);

        return redirect()->back()->with('success', 'Sub-Unit berhasil dihapus.');
    }

    public function subGroup()
    {
        return view('organization-structure.sub-group');
    }

    public function storeSubGroup(Request $request)
    {
        $data = $request->only(['id', 'name']);

        if (isset($data['id']) && $data['id'])
        {
            OrganizationStructureModel::update_data('tb_sub_group', $data['id'], $data);
        }
        else
        {
            OrganizationStructureModel::insert_data('tb_sub_group', $data);
        }

        return redirect()->back()->with('success', 'Sub-Group berhasil dihapus.');
    }

    public function destroySubGroup($id)
    {
        OrganizationStructureModel::delete_data('tb_sub_group', $id);

        return redirect()->back()->with('success', 'Sub-Group berhasil dihapus.');
    }

    public function mitra()
    {
        $get_witel = OrganizationStructureModel::get_witel();

        return view('organization-structure.mitra', ['get_witel' => $get_witel]);
    }

    public function storeMitra(Request $request)
    {
        $data = $request->only(['id', 'witel_id', 'name', 'alias']);

        if (isset($data['id']) && $data['id'])
        {
            OrganizationStructureModel::update_data('tb_mitra', $data['id'], $data);
        }
        else
        {
            OrganizationStructureModel::insert_data('tb_mitra', $data);
        }

        return redirect()->back()->with('success', 'Mitra berhasil disimpan.');
    }

    public function destroyMitra($id)
    {
        OrganizationStructureModel::delete_data('tb_mitra', $id);

        return redirect()->back()->with('success', 'Mitra berhasil dihapus.');
    }

    public function serviceArea()
    {
        return view('organization-structure.service-area');
    }

    public function storeServiceArea(Request $request)
    {
        $data = $request->only(['id', 'regional_id', 'witel_id', 'name', 'chat_id', 'head_service_area', 'officer_service_area', 'kordinator_lapangan1', 'kordinator_lapangan2']);

        if (isset($data['id']) && $data['id'])
        {
            OrganizationStructureModel::update_data('tb_service_area', $data['id'], $data);
        }
        else
        {
            OrganizationStructureModel::insert_data('tb_service_area', $data);
        }

        return redirect()->back()->with('success', 'Service Area berhasil disimpan.');
    }

    public function destroyServiceArea($id)
    {
        OrganizationStructureModel::delete_data('tb_service_area', $id);

        return redirect()->back()->with('success', 'Service Area berhasil dihapus.');
    }

    public function team()
    {
        return view('organization-structure.team');
    }

    public function storeTeam(Request $request)
    {
        $data = $request->only(['id', 'service_area_id', 'name', 'technician1', 'technician2']);

        if (isset($data['id']) && $data['id'])
        {
            OrganizationStructureModel::update_data('tb_team', $data['id'], $data);
        }
        else
        {
            OrganizationStructureModel::insert_data('tb_team', $data);
        }

        return redirect()->back()->with('success', 'Team berhasil disimpan.');
    }

    public function destroyTeam($id)
    {
        OrganizationStructureModel::delete_data('tb_team', $id);

        return redirect()->back()->with('success', 'Team berhasil dihapus.');
    }
}
