<?php

namespace App\Http\Controllers;

use App\Models\EmployeeManagementModel;
use Illuminate\Http\Request;

class EmployeeManagementController extends Controller
{
    public function employeeList()
    {
        return view('employee-management.list');
    }

    public function rolesPermissions()
    {
        return view('employee-management.roles-permissions');
    }
}
