<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EmployeeManagementModel extends Model
{
    public static function employeeList()
    {
        $data = DB::table('tb_employee AS te')
        ->leftJoin('tb_regional AS tr', 'te.regional_id', '=', 'tr.id')
        ->leftJoin('tb_witel AS tw', 'te.witel_id', '=', 'tw.id')
        ->leftJoin('tb_mitra AS tm', 'te.mitra_id', '=', 'tm.id')
        ->leftJoin('tb_sub_unit AS tsu', 'te.sub_unit_id', '=', 'tsu.id')
        ->leftJoin('tb_sub_group AS tsg', 'te.sub_group_id', '=', 'tsg.id')
        ->leftJoin('tb_roles_permissions AS trp', 'te.role_id', '=', 'trp.id')
        ->select('te.*', 'tr.name AS regional_name', 'tw.name AS witel_name', 'tm.name AS mitra_name', 'tsu.name AS sub_unit_name', 'tsg.name AS sub_group_name', 'trp.name AS role_name');

        if (Session::get('role_id') != 1)
        {
            $data->where([
                ['te.regional_id', '=', Session::get('regional_id')],
                ['te.witel_id', '=', Session::get('witel_id')],
                ['te.sub_unit_id', '=', Session::get('sub_unit_id')],
                ['te.sub_group_id', '=', Session::get('sub_group_id')],
                ['te.role_id', '!=', 1],
                ['te.is_active', '=', 1]
            ]);
        }

        return $data->get();
    }

    public static function rolesPermissions()
    {
        return DB::table('tb_roles_permissions')->get();
    }
}
