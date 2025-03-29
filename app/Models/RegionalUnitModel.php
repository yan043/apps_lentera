<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegionalUnitModel extends Model
{
    public static function get_data($table, $id = null)
    {
        $query = DB::table($table);

        if ($id)
        {
            return $query->where('id', $id)->first();
        }

        return $query->get();
    }

    public static function insert_data($table, $data)
    {
        return DB::table($table)->insert($data);
    }

    public static function update_data($table, $id, $data)
    {
        return DB::table($table)->where('id', $id)->update($data);
    }

    public static function delete_data($table, $id)
    {
        return DB::table($table)->where('id', $id)->delete();
    }

    public static function get_witel()
    {
        return DB::table('tb_witel AS tw')
            ->leftJoin('tb_regional AS tr', 'tw.regional_id', '=', 'tr.id')
            ->select('tw.*', 'tr.id AS regional_id', 'tr.name AS regional_name')
            ->get();
    }

    public static function get_witel_by_id($id)
    {
        return DB::table('tb_witel AS tw')
            ->leftJoin('tb_regional AS tr', 'tw.regional_id', '=', 'tr.id')
            ->select('tw.*', 'tr.id AS regional_id', 'tr.name AS regional_name')
            ->where('tw.id', $id)
            ->first();
    }

    public static function get_sub_unit()
    {
        return DB::table('tb_sub_unit AS tsu')
            ->leftJoin('tb_regional AS tr', 'tsu.regional_id', '=', 'tr.id')
            ->select('tsu.*', 'tr.id AS regional_id', 'tr.name AS regional_name')
            ->get();
    }

    public static function get_sub_unit_by_id($id)
    {
        return DB::table('tb_sub_unit AS tsu')
            ->leftJoin('tb_regional AS tr', 'tsu.regional_id', '=', 'tr.id')
            ->select('tsu.*', 'tr.id AS regional_id', 'tr.name AS regional_name')
            ->where('tsu.id', $id)
            ->first();
    }

    public static function get_mitra()
    {
        return DB::table('tb_mitra AS tm')
            ->leftJoin('tb_witel AS tw', 'tm.witel_id', '=', 'tw.id')
            ->select('tm.*', 'tw.id AS witel_id', 'tw.name AS witel_name')
            ->get();
    }

    public static function get_mitra_by_id($id)
    {
        return DB::table('tb_mitra AS tm')
            ->leftJoin('tb_witel AS tw', 'tm.witel_id', '=', 'tw.id')
            ->select('tm.*', 'tw.id AS witel_id', 'tw.name AS witel_name')
            ->where('tm.id', $id)
            ->first();
    }
}
