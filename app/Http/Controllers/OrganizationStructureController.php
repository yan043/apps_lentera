<?php

namespace App\Http\Controllers;

use App\Models\OrganizationStructureModel;
use Illuminate\Http\Request;

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

        return redirect()->back()->with('success', 'Regional has been successfully saved.');
    }

    public function destroyRegional($id)
    {
        OrganizationStructureModel::delete_data('tb_regional', $id);

        return redirect()->back()->with('success', 'Regional has been successfully deleted.');
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

        return redirect()->back()->with('success', 'Witel has been successfully saved.');
    }

    public function destroyWitel($id)
    {
        OrganizationStructureModel::delete_data('tb_witel', $id);

        return redirect()->back()->with('success', 'Witel has been successfully deleted.');
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

        return redirect()->back()->with('success', 'Sub-Unit has been successfully saved.');
    }

    public function destroySubUnit($id)
    {
        OrganizationStructureModel::delete_data('tb_sub_unit', $id);

        return redirect()->back()->with('success', 'Sub-Unit has been successfully deleted.');
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

        return redirect()->back()->with('success', 'Sub-Group has been successfully saved.');
    }

    public function destroySubGroup($id)
    {
        OrganizationStructureModel::delete_data('tb_sub_group', $id);

        return redirect()->back()->with('success', 'Sub-Group has been successfully deleted.');
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

        return redirect()->back()->with('success', 'Mitra has been successfully saved.');
    }

    public function destroyMitra($id)
    {
        OrganizationStructureModel::delete_data('tb_mitra', $id);

        return redirect()->back()->with('success', 'Mitra has been successfully deleted.');
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

        return redirect()->back()->with('success', 'Service Area has been successfully saved.');
    }

    public function destroyServiceArea($id)
    {
        OrganizationStructureModel::delete_data('tb_service_area', $id);

        return redirect()->back()->with('success', 'Service Area has been successfully deleted.');
    }

    public function workZone()
    {
        $get_service_area = OrganizationStructureModel::get_service_area();

        return view('organization-structure.work-zone', ['get_service_area' => $get_service_area]);
    }

    public function storeWorkZone(Request $request)
    {
        $data = $request->only(['id', 'service_area_id', 'name']);

        if (isset($data['id']) && $data['id'])
        {
            OrganizationStructureModel::update_data('tb_work_zone', $data['id'], $data);
        }
        else
        {
            OrganizationStructureModel::insert_data('tb_work_zone', $data);
        }

        return redirect()->back()->with('success', 'Work Zone has been successfully saved.');
    }

    public function destroyWorkZone($id)
    {
        OrganizationStructureModel::delete_data('tb_work_zone', $id);

        return redirect()->back()->with('success', 'Work Zone has been successfully deleted.');
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

        return redirect()->back()->with('success', 'Team has been successfully saved.');
    }

    public function destroyTeam($id)
    {
        OrganizationStructureModel::delete_data('tb_team', $id);

        return redirect()->back()->with('success', 'Team has been successfully deleted.');
    }
}
