<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportingConfigurationModel;

class ReportingConfigurationController extends Controller
{
    public function status()
    {
        return view('reporting-configuration.status');
    }

    public function storeStatus(Request $request)
    {
        $data = $request->only(['id', 'name']);

        if (isset($data['id']) && $data['id'])
        {
            ReportingConfigurationModel::update_order_status($data['id'], ['name' => $data['name']]);
        }
        else
        {
            ReportingConfigurationModel::insert_order_status(['name' => $data['name']]);
        }

        return redirect()->back()->with('success', 'Status berhasil disimpan.');
    }

    public function destroyStatus($id)
    {
        ReportingConfigurationModel::delete_order_status($id);

        return redirect()->back()->with('success', 'Status berhasil dihapus.');
    }

    public function subStatus()
    {
        $get_order_status = ReportingConfigurationModel::get_order_status();

        return view('reporting-configuration.sub-status', ['get_order_status' => $get_order_status]);
    }

    public function storeSubStatus(Request $request)
    {
        $data = $request->only(['id', 'order_status_id', 'name']);

        if (isset($data['id']) && $data['id'])
        {
            ReportingConfigurationModel::update_order_sub_status($data['id'], $data);
        }
        else
        {
            ReportingConfigurationModel::insert_order_sub_status($data);
        }

        return redirect()->back()->with('success', 'Sub-Status berhasil disimpan.');
    }

    public function destroySubStatus($id)
    {
        ReportingConfigurationModel::delete_order_sub_status($id);

        return redirect()->back()->with('success', 'Sub-Status berhasil dihapus.');
    }

    public function segments()
    {
        return view('reporting-configuration.segments');
    }

    public function storeSegment(Request $request)
    {
        $data = $request->only(['id', 'name']);

        if (isset($data['id']) && $data['id'])
        {
            ReportingConfigurationModel::update_order_segment($data['id'], ['name' => $data['name']]);
        }
        else
        {
            ReportingConfigurationModel::insert_order_segment(['name' => $data['name']]);
        }

        return redirect()->back()->with('success', 'Segment berhasil disimpan.');
    }

    public function destroySegment($id)
    {
        ReportingConfigurationModel::delete_order_segment($id);

        return redirect()->back()->with('success', 'Segment berhasil dihapus.');
    }

    public function actions()
    {
        $get_order_segment = ReportingConfigurationModel::get_order_segments();

        return view('reporting-configuration.actions', ['get_order_segment' => $get_order_segment]);
    }

    public function storeAction(Request $request)
    {
        $data = $request->only(['id', 'order_segment_id', 'name']);

        if (isset($data['id']) && $data['id'])
        {
            ReportingConfigurationModel::update_order_action($data['id'], $data);
        }
        else
        {
            ReportingConfigurationModel::insert_order_action($data);
        }

        return redirect()->back()->with('success', 'Action berhasil disimpan.');
    }

    public function destroyAction($id)
    {
        ReportingConfigurationModel::delete_order_action($id);

        return redirect()->back()->with('success', 'Action berhasil dihapus.');
    }

    public function labels()
    {
        return view('reporting-configuration.labels');
    }

    public function storeLabel(Request $request)
    {
        $data = $request->only(['id', 'name']);

        if (isset($data['id']) && $data['id'])
        {
            ReportingConfigurationModel::update_order_label($data['id'], ['name' => $data['name']]);
        }
        else
        {
            ReportingConfigurationModel::insert_order_label(['name' => $data['name']]);
        }

        return redirect()->back()->with('success', 'Label berhasil disimpan.');
    }

    public function destroyLabel($id)
    {
        ReportingConfigurationModel::delete_order_label($id);

        return redirect()->back()->with('success', 'Label berhasil dihapus.');
    }
}
