<?php

namespace App\Http\Controllers;

use App\Models\InventoryManagementModel;
use App\Models\WorkOrderManagementModel;
use Illuminate\Http\Request;

class WorkOrderManagementController extends Controller
{
    public function view($id)
    {
        $data                            = WorkOrderManagementModel::view($id);
        $get_inventory_by_order_material = InventoryManagementModel::get_inventory_by_order($id, 'material');
        $get_inventory_by_order_nte_ont  = InventoryManagementModel::get_inventory_by_order($id, 'nte', 'ont');
        $get_inventory_by_order_nte_stb  = InventoryManagementModel::get_inventory_by_order($id, 'nte', 'stb');

        return view('work-order-management.view', ['id' => $id, 'data' => $data, 'get_inventory_by_order_material' => $get_inventory_by_order_material, 'get_inventory_by_order_nte_ont' => $get_inventory_by_order_nte_ont, 'get_inventory_by_order_nte_stb' => $get_inventory_by_order_nte_stb]);
    }

    public function viewUpdate(Request $request)
    {
        $request->validate(
            [
                'id'                         => 'required',
                'order_status_id'            => 'required',
                'order_substatus_id'         => 'required',
                'report_odp_name'            => 'nullable',
                'report_odp_coordinates'     => 'nullable',
                'report_valins_id'           => 'nullable',
                'report_refferal_order_code' => 'nullable',
                'nte_data'                   => 'nullable',
                'materials_data'             => 'nullable',
                'photos_data'                => 'nullable',
            ]
        );

        if (! in_array($request->input('order_status_id'), [1, 2]))
        {
            $request->validate(
                [
                    'report_phone_number'         => 'required',
                    'report_coordinates_location' => 'required',
                    'report_notes'                => 'required',
                ]
            );
        }

        if (! empty($request->input('order_segment_id')))
        {
            $request->validate(
                [
                    'order_segment_id' => 'required',
                    'order_action_id'  => 'required',
                ]
            );
        }

        WorkOrderManagementModel::viewUpdate($request);

        return redirect()->back()->with('success', 'Successfully Updated Work Order!');
    }

    public function updateOrInsertOrder(Request $request)
    {
        $validateData = $request->validate([
            'source_data'   => 'required',
            'order_code'    => 'required',
            'order_id'      => 'required',
            'team_id'       => 'required',
            'team_name'     => 'required',
            'assign_date'   => 'required',
            'assign_labels' => 'required',
            'assign_notes'  => 'required',
        ]);

        WorkOrderManagementModel::updateOrInsertOrder($validateData);

        return redirect()->back()->with('success', 'Successfully Assigned Work Order to Team!');
    }

    public function newOrders()
    {
        return view('work-order-management.new-orders');
    }

    public function newOrderDetails()
    {
        $sourcedata = request()->input('sourcedata');
        $workzone   = request()->input('workzone');
        $ttr        = request()->input('ttr');
        $startdate  = request()->input('startdate');
        $enddate    = request()->input('enddate');

        return view('work-order-management.new-order-details', ['sourcedata' => $sourcedata, 'workzone' => $workzone, 'ttr' => $ttr, 'startdate' => $startdate, 'enddate' => $enddate]);
    }

    public function assignedOrders()
    {
        return view('work-order-management.assigned-orders');
    }

    public function inProgress()
    {
        return view('work-order-management.in-progress');
    }

    public function completedOrders()
    {
        return view('work-order-management.completed-orders');
    }

    public function cancelledOrders()
    {
        return view('work-order-management.cancelled-orders');
    }
}
