<?php

namespace App\Http\Controllers;

use App\Models\ReportingConfigurationModel;
use Illuminate\Http\Request;

class ReportingConfigurationController extends Controller
{
    public function status()
    {
        return view('reporting-configuration.status');
    }

    public function storeStatus(Request $request)
    {
        $data = $request->only(['id', 'name', 'previous_step', 'next_step', 'status_code', 'status_group', 'status_description', 'photo_list', 'is_active']);

        if (isset($data['id']) && $data['id'])
        {
            ReportingConfigurationModel::update_order_status($data['id'], $data);
        }
        else
        {
            ReportingConfigurationModel::insert_order_status($data);
        }

        return redirect()->back()->with('success', 'Status has been successfully saved.');
    }

    public function destroyStatus($id)
    {
        ReportingConfigurationModel::delete_order_status($id);

        return redirect()->back()->with('success', 'Status has been successfully deleted.');
    }

    public function segments()
    {
        return view('reporting-configuration.segments');
    }

    public function storeSegment(Request $request)
    {
        $data = $request->only(['id', 'name', 'photo_list']);

        if (isset($data['id']) && $data['id'])
        {
            ReportingConfigurationModel::update_order_segment($data['id'], $data);
        }
        else
        {
            ReportingConfigurationModel::insert_order_segment($data);
        }

        return redirect()->back()->with('success', 'Segment has been successfully saved.');
    }

    public function destroySegment($id)
    {
        ReportingConfigurationModel::delete_order_segment($id);

        return redirect()->back()->with('success', 'Segment has been successfully deleted.');
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

        return redirect()->back()->with('success', 'Action has been successfully saved.');
    }

    public function destroyAction($id)
    {
        ReportingConfigurationModel::delete_order_action($id);

        return redirect()->back()->with('success', 'Action has been successfully deleted.');
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

        return redirect()->back()->with('success', 'Label has been successfully saved.');
    }

    public function destroyLabel($id)
    {
        ReportingConfigurationModel::delete_order_label($id);

        return redirect()->back()->with('success', 'Label has been successfully deleted.');
    }
}
