<?php

namespace App\Http\Controllers;

use App\Models\WorkOrderManagementModel;
use Illuminate\Http\Request;

class WorkOrderManagementController extends Controller
{
    public function updateOrInsertOrder(Request $request)
    {
        $validateData = $request->validate([
            'id'            => 'required',
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
}
