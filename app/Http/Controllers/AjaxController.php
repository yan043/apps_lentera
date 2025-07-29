<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\RegionalUnitModel;
use App\Models\OrderManagementModel;
use App\Models\EmployeeManagementModel;
use App\Models\ReportingConfigurationModel;

class AjaxController extends Controller
{
    public function get_order_status()
    {
        $data = ReportingConfigurationModel::get_order_status();

        return response()->json($data);
    }

    public function get_order_status_by_id($id)
    {
        $data = ReportingConfigurationModel::get_order_status_by_id($id);

        return response()->json($data);
    }

    public function get_order_sub_status()
    {
        $data = ReportingConfigurationModel::get_order_sub_status();

        return response()->json($data);
    }

    public function get_order_sub_status_by_id($id)
    {
        $data = ReportingConfigurationModel::get_order_sub_status_by_id($id);

        return response()->json($data);
    }

    public function get_order_segments()
    {
        $data = ReportingConfigurationModel::get_order_segments();

        return response()->json($data);
    }

    public function get_order_segment_by_id($id)
    {
        $data = ReportingConfigurationModel::get_order_segment_by_id($id);

        return response()->json($data);
    }

    public function get_order_actions()
    {
        $data = ReportingConfigurationModel::get_order_actions();

        return response()->json($data);
    }

    public function get_order_action_by_id($id)
    {
        $data = ReportingConfigurationModel::get_order_action_by_id($id);

        return response()->json($data);
    }

    public function get_regional()
    {
        $data = RegionalUnitModel::get_data('tb_regional');

        return response()->json($data);
    }

    public function get_regional_by_id($id)
    {
        $data = RegionalUnitModel::get_data('tb_regional', $id);

        return response()->json($data);
    }

    public function get_witel()
    {
        $data = RegionalUnitModel::get_witel();

        return response()->json($data);
    }

    public function get_witel_by_id($id)
    {
        $data = RegionalUnitModel::get_witel_by_id($id);

        return response()->json($data);
    }

    public function get_sub_unit()
    {
        $data = RegionalUnitModel::get_sub_unit();

        return response()->json($data);
    }

    public function get_sub_unit_by_id($id)
    {
        $data = RegionalUnitModel::get_sub_unit_by_id($id);

        return response()->json($data);
    }

    public function get_sub_group()
    {
        $data = RegionalUnitModel::get_data('tb_sub_group');

        return response()->json($data);
    }

    public function get_sub_group_by_id($id)
    {
        $data = RegionalUnitModel::get_data('tb_sub_group', $id);

        return response()->json($data);
    }

    public function get_mitra()
    {
        $data = RegionalUnitModel::get_mitra();

        return response()->json($data);
    }

    public function get_mitra_by_id($id)
    {
        $data = RegionalUnitModel::get_mitra_by_id($id);

        return response()->json($data);
    }

    public function get_employee_list()
    {
        $data = EmployeeManagementModel::employeeList();

        return response()->json($data);
    }

    public function get_employee_list_by_id($id)
    {
        $data = EmployeeManagementModel::employeeListById($id);

        return response()->json($data);
    }

    public function get_employee_roles_permissions()
    {
        $data = EmployeeManagementModel::rolesPermissions();

        return response()->json($data);
    }

    public function get_witel_by_regional($regional_id)
    {
        $data = EmployeeManagementModel::get_witel_by_regional($regional_id);

        return response()->json($data);
    }

    public function get_mitra_by_witel($witel_id)
    {
        $data = EmployeeManagementModel::get_mitra_by_witel($witel_id);

        return response()->json($data);
    }

    public function get_sub_unit_by_regional($regional_id)
    {
        $data = EmployeeManagementModel::get_sub_unit_by_regional($regional_id);

        return response()->json($data);
    }

    public function get_new_orders($witel, $sourcedata, $startdate, $enddate)
    {
        $data = OrderManagementModel::new_orders($witel, $sourcedata, $startdate, $enddate);

        return response()->json($data);
    }

    public function get_new_orders_post(Request $request, $witel, $sourcedata)
    {
        $startdate = $request->input('startdate');
        $enddate   = $request->input('enddate');

        $data = OrderManagementModel::new_orders($witel, $sourcedata, $startdate, $enddate);

        return response()->json($data);
    }

    public function get_new_order_details()
    {
        $sourcedata = request()->input('sourcedata');
        $workzone   = request()->input('workzone');
        $ttr        = request()->input('ttr');
        $startdate  = request()->input('startdate');
        $enddate    = request()->input('enddate');

        $data = OrderManagementModel::new_order_details($sourcedata, $workzone, $ttr, $startdate, $enddate);

        return response()->json($data);
    }
}
