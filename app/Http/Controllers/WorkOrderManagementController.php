<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\WorkOrderManagementModel;

class WorkOrderManagementController extends Controller
{
    public function updateOrInsertOrder(Request $request)
    {
        $validateData = $request->validate([
            'order_code'      => 'required',
            'order_id'        => 'required',
            'service_area_id' => 'required',
            'team_id'         => 'required',
            'team_name'       => 'required',
            'assign_date'     => 'required',
            'assign_labels'   => 'required',
            'assign_notes'    => 'required',
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

        return view('work-order-management.new-order-details', ['sourcedata' => $sourcedata, 'workzone' => $workzone, 'ttr' => $ttr, 'startdate' => $startdate, 'enddate' => $enddate,]);
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
