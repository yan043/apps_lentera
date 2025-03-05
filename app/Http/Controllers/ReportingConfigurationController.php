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

    public function actions()
    {
        return view('reporting-configuration.actions');
    }

    public function segments()
    {
        return view('reporting-configuration.segments');
    }
}
