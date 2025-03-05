<?php

namespace App\Http\Controllers;

use App\Models\SupportModel;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function orderTracking()
    {
        return view('support.order-tracking');
    }

    public function helpdeskMonitoring()
    {
        return view('support.helpdesk-monitoring');
    }

    public function mapsRouting()
    {
        return view('support.maps-routing');
    }
}
