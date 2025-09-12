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
        $validatedData = $request->validate([
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

        if ($request->filled('password'))
        {
            $validatedData['password'] = Hash::make($request->password);
        }

        EmployeeManagementModel::storeEmployee($validatedData);

        return redirect()->back()->with('success', 'Employee berhasil ditambahkan.');
    }

    public function updateEmployee(Request $request, $id)
    {
        $validatedData = $request->validate([
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

        if ($request->filled('password'))
        {
            $validatedData['password'] = Hash::make($request->password);
        }

        EmployeeManagementModel::updateEmployee($id, $validatedData);

        return redirect()->back()->with('success', 'Employee berhasil diperbarui.');
    }

    public function storeRole(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        EmployeeManagementModel::storeRole($validatedData);

        return redirect()->back()->with('success', 'Role berhasil ditambahkan.');
    }

    public function updateRole(Request $request)
    {
        $validatedData = $request->validate([
            'id'   => 'required|integer|exists:tb_roles_permissions,id',
            'name' => 'required|string|max:255',
        ]);

        EmployeeManagementModel::updateRole($validatedData);

        return redirect()->back()->with('success', 'Role berhasil diperbarui.');
    }
}
