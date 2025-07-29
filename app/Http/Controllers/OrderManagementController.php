<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderManagementController extends Controller
{
    public function newOrders()
    {
        return view('order-management.new');
    }

    public function newOrderDetails()
    {
        $sourcedata = request()->input('sourcedata');
        $workzone   = request()->input('workzone');
        $ttr        = request()->input('ttr');
        $startdate  = request()->input('startdate');
        $enddate    = request()->input('enddate');

        return view('order-management.newOrderDetails', ['sourcedata' => $sourcedata, 'workzone' => $workzone, 'ttr' => $ttr, 'startdate' => $startdate, 'enddate' => $enddate,]);
    }

    public function assignedOrders()
    {
        return view('order-management.assigned');
    }

    public function ongoingOrders()
    {
        return view('order-management.ongoing');
    }

    public function completedOrders()
    {
        return view('order-management.completed');
    }

    public function cancelOrders()
    {
        return view('order-management.cancel');
    }
}
