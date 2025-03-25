<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeManagementModel;
use App\Models\RegionalUnitModel;

class EmployeeManagementController extends Controller
{
    public function employeeList()
    {
        $get_regional  = EmployeeManagementModel::get_regional();
        $get_sub_group = EmployeeManagementModel::get_sub_group();
        $get_role      = EmployeeManagementModel::get_role();

        $data          = EmployeeManagementModel::employeeList();

        return view('employee-management.list', [
            'data'          => $data,
            'get_regional'  => $get_regional,
            'get_sub_group' => $get_sub_group,
            'get_role'      => $get_role
        ]);
    }

    public function rolesPermissions()
    {
        $data = EmployeeManagementModel::rolesPermissions();

        return view('employee-management.roles-permissions', ['data' => $data]);
    }
}
