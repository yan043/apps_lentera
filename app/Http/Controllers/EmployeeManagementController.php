<?php

namespace App\Http\Controllers;

use App\Models\EmployeeManagementModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function storeEmployee(Request $request)
    {
        $request->validate([
            'nik'          => 'required|min:6',
            'full_name'    => 'required',
            'regional_id'  => 'required',
            'witel_id'     => 'required',
            'mitra_id'     => 'required',
            'sub_unit_id'  => 'required',
            'sub_group_id' => 'required',
            'role_id'      => 'required',
            'is_active'    => 'required',
        ]);

        $data = $request->except(['_token', '_method']);
        $data['created_by'] = session('nik');
        $data['created_at'] = now();

        if ($request->filled('password'))
        {
            $data['password'] = Hash::make($request->password);
        }

        EmployeeManagementModel::storeEmployee($data);

        return redirect()->back()->with('success', 'Employee has been successfully added.');
    }

    public function updateEmployee(Request $request, $id)
    {
        $request->validate([
            'nik'          => 'required|min:6',
            'full_name'    => 'required',
            'regional_id'  => 'required',
            'witel_id'     => 'required',
            'mitra_id'     => 'required',
            'sub_unit_id'  => 'required',
            'sub_group_id' => 'required',
            'role_id'      => 'required',
            'is_active'    => 'required',
        ]);

        $data = $request->except(['_token', '_method', 'id']);
        $data['updated_by'] = session('nik');

        if ($request->filled('password'))
        {
            $data['password'] = Hash::make($request->password);
        }

        EmployeeManagementModel::updateEmployee($id, $data);

        return redirect()->back()->with('success', 'Employee has been successfully updated.');
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        EmployeeManagementModel::storeRole($request);

        return redirect()->back()->with('success', 'Role has been successfully added.');
    }

    public function updateRole(Request $request)
    {
        $request->validate([
            'id'   => 'required|integer|exists:tb_roles_permissions,id',
            'name' => 'required|string|max:255',
        ]);

        EmployeeManagementModel::updateRole($request);

        return redirect()->back()->with('success', 'Role has been successfully updated.');
    }
}
