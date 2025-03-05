<?php

namespace App\Http\Controllers;

use App\Models\OrderManagementModel;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    public function newOrders()
    {
        return view('order-management.new');
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
