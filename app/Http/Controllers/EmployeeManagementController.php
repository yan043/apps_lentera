<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeManagementModel;
use App\Models\RegionalUnitModel;
use Illuminate\Support\Facades\DB;

class EmployeeManagementController extends Controller
{
    public function employeeList()
    {
        $get_regional  = EmployeeManagementModel::get_regional();
        $get_sub_group = EmployeeManagementModel::get_sub_group();
        $get_role      = EmployeeManagementModel::get_role();

        $data          = EmployeeManagementModel::employeeList();

        return view('employee-management.list', ['get_regional' => $get_regional, 'get_sub_group' => $get_sub_group, 'get_role' => $get_role, 'data' => $data]);
    }

    public function rolesPermissions()
    {
        $data = EmployeeManagementModel::rolesPermissions();

        return view('employee-management.roles-permissions', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|min:6',
            'full_name' => 'required',
            'password' => 'required',
            'regional_id' => 'required',
            'witel_id' => 'required',
            'mitra_id' => 'required',
            'sub_unit_id' => 'required',
            'sub_group_id' => 'required',
            'role_id' => 'required',
            'is_active' => 'required'
        ]);

        EmployeeManagementModel::storeEmployee($validatedData);

        return redirect()->back()->with('success', 'Employee added successfully');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nik' => 'required|min:6',
            'full_name' => 'required',
            'password' => 'required',
            'regional_id' => 'required',
            'witel_id' => 'required',
            'mitra_id' => 'required',
            'sub_unit_id' => 'required',
            'sub_group_id' => 'required',
            'role_id' => 'required',
            'is_active' => 'required'
        ]);

        EmployeeManagementModel::updateEmployee($id, $validatedData);

        return redirect()->back()->with('success', 'Employee updated successfully');
    }
}
