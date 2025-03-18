<?php

namespace App\Http\Controllers;

use App\Models\EmployeeManagementModel;
use Illuminate\Http\Request;

class EmployeeManagementController extends Controller
{
    public function employeeList()
    {
        $data = EmployeeManagementModel::employeeList();

        return view('employee-management.list', ['data' => $data]);
    }

    public function rolesPermissions()
    {
        $data = EmployeeManagementModel::rolesPermissions();

        return view('employee-management.roles-permissions', ['data' => $data]);
    }
}
