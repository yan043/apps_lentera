<?php

namespace App\Http\Controllers;

use App\Models\ReportingConfigurationModel;
use Illuminate\Http\Request;

class ReportingConfigurationController extends Controller
{
    public function status()
    {
        $data = ReportingConfigurationModel::get_order_status();

        return view('reporting-configuration.status', ['data' => $data]);
    }

    public function subStatus()
    {
        $get_order_status = ReportingConfigurationModel::get_order_status();

        $data = ReportingConfigurationModel::get_order_sub_status();

        return view('reporting-configuration.sub-status', ['get_order_status' => $get_order_status, 'data' => $data]);
    }

    public function segments()
    {
        $data = ReportingConfigurationModel::get_order_segments();

        return view('reporting-configuration.segments', ['data' => $data]);
    }

    public function actions()
    {
        $get_order_segment = ReportingConfigurationModel::get_order_segments();

        $data = ReportingConfigurationModel::get_order_actions();

        return view('reporting-configuration.actions', ['get_order_segment' => $get_order_segment, 'data' => $data]);
    }
}
