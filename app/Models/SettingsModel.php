<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class SettingsModel extends Model
{
    public static function regional()
    {
        return DB::table('tb_regional')->get();
    }

    public static function witel()
    {
        return DB::table('tb_witel')->get();
    }

    public static function mitra()
    {
        return DB::table('tb_mitra AS tm')
        ->leftJoin('tb_witel AS tw', 'tm.witel_id', '=', 'tw.id')
        ->select('tm.*', 'tw.name AS witel_name')
        ->get();
    }

    public static function level()
    {
        return DB::table('tb_level')->get();
    }
}
