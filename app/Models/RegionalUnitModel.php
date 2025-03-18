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

    public static function get_witel()
    {
        return DB::table('tb_witel AS tw')
        ->leftJoin('tb_regional AS tr', 'tw.regional_id', '=', 'tr.id')
        ->select('tw.*', 'tr.id AS regional_id', 'tr.name AS regional_name')
        ->get();
    }

    public static function get_sub_unit()
    {
        return DB::table('tb_sub_unit AS tsu')
        ->leftJoin('tb_regional AS tr', 'tsu.regional_id', '=', 'tr.id')
        ->select('tsu.*', 'tr.id AS regional_id', 'tr.name AS regional_name')
        ->get();
    }

    public static function get_sub_group()
    {
        return DB::table('tb_sub_group')->get();
    }

    public static function get_mitra()
    {
        return DB::table('tb_mitra AS tm')
        ->leftJoin('tb_witel AS tw', 'tm.witel_id', '=', 'tw.id')
        ->select('tm.*', 'tw.id AS witel_id', 'tw.name AS witel_name')
        ->get();
    }
}
