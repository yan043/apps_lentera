<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReportingConfigurationModel extends Model
{
    public static function get_order_status()
    {
        return DB::table('tb_order_status')->get();
    }

    public static function get_order_sub_status()
    {
        return DB::table('tb_order_sub_status AS toss')
        ->leftJoin('tb_order_status AS tos', 'tos.id', '=', 'toss.order_status_id')
        ->select('toss.*', 'tos.name AS order_status_name')
        ->get();
    }

    public static function get_order_segments()
    {
        return DB::table('tb_order_segment')->get();
    }

    public static function get_order_actions()
    {
        return DB::table('tb_order_action AS toa')
        ->leftJoin('tb_order_segment AS tos', 'tos.id', '=', 'toa.order_segment_id')
        ->select('toa.*', 'tos.name AS order_segment_name')
        ->get();
    }
}
