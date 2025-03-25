<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegionalUnitModel extends Model
{
    public static function get_regional()
    {
        return DB::table('tb_regional')->get();
    }

    public static function get_regional_by_id($id)
    {
        return DB::table('tb_regional')->where('id', $id)->first();
    }

    public static function insert_regional($data)
    {
        return DB::table('tb_regional')->insert($data);
    }

    public static function update_regional($id, $data)
    {
        return DB::table('tb_regional')->where('id', $id)->update($data);
    }

    public static function delete_regional($id)
    {
        return DB::table('tb_regional')->where('id', $id)->delete();
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

    public static function insert_witel($data)
    {
        return DB::table('tb_witel')->insert($data);
    }

    public static function update_witel($id, $data)
    {
        return DB::table('tb_witel')->where('id', $id)->update($data);
    }

    public static function delete_witel($id)
    {
        return DB::table('tb_witel')->where('id', $id)->delete();
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

    public static function insert_sub_unit($data)
    {
        return DB::table('tb_sub_unit')->insert($data);
    }

    public static function update_sub_unit($id, $data)
    {
        return DB::table('tb_sub_unit')->where('id', $id)->update($data);
    }

    public static function delete_sub_unit($id)
    {
        return DB::table('tb_sub_unit')->where('id', $id)->delete();
    }

    public static function get_sub_group()
    {
        return DB::table('tb_sub_group')->get();
    }

    public static function get_sub_group_by_id($id)
    {
        return DB::table('tb_sub_group')->where('id', $id)->first();
    }

    public static function insert_sub_group($data)
    {
        return DB::table('tb_sub_group')->insert($data);
    }

    public static function update_sub_group($id, $data)
    {
        return DB::table('tb_sub_group')->where('id', $id)->update($data);
    }

    public static function delete_sub_group($id)
    {
        return DB::table('tb_sub_group')->where('id', $id)->delete();
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

    public static function insert_mitra($data)
    {
        return DB::table('tb_mitra')->insert($data);
    }

    public static function update_mitra($id, $data)
    {
        return DB::table('tb_mitra')->where('id', $id)->update($data);
    }

    public static function delete_mitra($id)
    {
        return DB::table('tb_mitra')->where('id', $id)->delete();
    }
}
