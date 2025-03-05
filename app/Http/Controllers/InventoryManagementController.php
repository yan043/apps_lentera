<?php

namespace App\Http\Controllers;

use App\Models\InventoryManagementModel;
use Illuminate\Http\Request;

class InventoryManagementController extends Controller
{
    public function stockOverview()
    {
        return view('inventory-management.stock-overview');
    }

    public function materialRequest()
    {
        return view('inventory-management.material-request');
    }

    public function materialInbound()
    {
        return view('inventory-management.material-inbound');
    }

    public function materialUsage()
    {
        return view('inventory-management.material-usage');
    }

    public function materialReturn()
    {
        return view('inventory-management.material-return');
    }
}
