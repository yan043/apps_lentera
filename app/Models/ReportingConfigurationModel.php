<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class ReportingConfigurationModel extends Model
{
    public static function get_order_status()
    {
        return DB::table('tb_order_status')->get();
    }

    public static function get_order_status_by_id($id)
    {
        return DB::table('tb_order_status')->where('id', $id)->first();
    }

    public static function get_order_status_by_step($id)
    {
        $check = DB::table('tb_assign_orders AS tao')
                ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
                ->leftJoin('tb_order_sub_status AS tss', 'tar.order_substatus_id', '=', 'tss.id')
                ->leftJoin('tb_order_status AS tst', 'tss.order_status_id', '=', 'tst.id')
                ->select(
                    'tst.*',
                    'tss.name AS order_substatus_name',
                    'tss.previous_step',
                    'tss.next_step'
                )
                ->where('tao.id', $id)
                ->first();

        if ($check->name == null && Session::get('role_id') == 16)
        {
            $data = DB::table('tb_order_status')->where('step', 2);
        }
        elseif ($check->step == 3)
        {
            $data = DB::table('tb_order_status')->whereIn('step', [3, 4]);
        }
        elseif ($check->name != null)
        {
            $data = DB::table('tb_order_status')->where('step', $check->after_step);
        }
        else
        {
            $data = DB::table('tb_order_status')->where('step', '!=', 1);
        }

        return $data->get();
    }

    public static function insert_order_status($data)
    {
        return DB::table('tb_order_status')->insert($data);
    }

    public static function update_order_status($id, $data)
    {
        return DB::table('tb_order_status')->where('id', $id)->update($data);
    }

    public static function delete_order_status($id)
    {
        return DB::table('tb_order_status')->where('id', $id)->delete();
    }

    public static function get_order_sub_status()
    {
        return DB::table('tb_order_sub_status AS toss')
        ->leftJoin('tb_order_status AS tos', 'tos.id', '=', 'toss.order_status_id')
        ->select('toss.*', 'tos.name AS order_status_name')
        ->get();
    }

    public static function get_order_sub_status_by_id($id)
    {
        return DB::table('tb_order_sub_status AS toss')
        ->leftJoin('tb_order_status AS tos', 'tos.id', '=', 'toss.order_status_id')
        ->select('toss.*', 'tos.step AS order_status_step', 'tos.name AS order_status_name')
        ->where('toss.id', $id)
        ->first();
    }

    public static function get_order_sub_status_by_status_id($order_status_id)
    {
        return DB::table('tb_order_sub_status AS toss')
        ->leftJoin('tb_order_status AS tos', 'tos.id', '=', 'toss.order_status_id')
        ->select('toss.*', 'tos.step AS order_status_step', 'tos.name AS order_status_name')
        ->where('toss.order_status_id', $order_status_id)
        ->get();
    }

    public static function insert_order_sub_status($data)
    {
        return DB::table('tb_order_sub_status')->insert($data);
    }

    public static function update_order_sub_status($id, $data)
    {
        return DB::table('tb_order_sub_status')->where('id', $id)->update($data);
    }

    public static function delete_order_sub_status($id)
    {
        return DB::table('tb_order_sub_status')->where('id', $id)->delete();
    }

    public static function get_order_segments()
    {
        return DB::table('tb_order_segment')->get();
    }

    public static function get_order_segment_by_id($id)
    {
        return DB::table('tb_order_segment')->where('id', $id)->first();
    }

    public static function insert_order_segment($data)
    {
        return DB::table('tb_order_segment')->insert($data);
    }

    public static function update_order_segment($id, $data)
    {
        return DB::table('tb_order_segment')->where('id', $id)->update($data);
    }

    public static function delete_order_segment($id)
    {
        return DB::table('tb_order_segment')->where('id', $id)->delete();
    }

    public static function get_order_actions()
    {
        return DB::table('tb_order_action AS toa')
        ->leftJoin('tb_order_segment AS tos', 'tos.id', '=', 'toa.order_segment_id')
        ->select('toa.*', 'tos.name AS order_segment_name')
        ->get();
    }

    public static function get_order_action_by_segment_id($id)
    {
        return DB::table('tb_order_action AS toa')
        ->leftJoin('tb_order_segment AS tos', 'tos.id', '=', 'toa.order_segment_id')
        ->select('toa.*', 'tos.name AS order_segment_name')
        ->where('toa.order_segment_id', $id)
        ->first();
    }

    public static function insert_order_action($data)
    {
        return DB::table('tb_order_action')->insert($data);
    }

    public static function update_order_action($id, $data)
    {
        return DB::table('tb_order_action')->where('id', $id)->update($data);
    }

    public static function delete_order_action($id)
    {
        return DB::table('tb_order_action')->where('id', $id)->delete();
    }

    public static function get_order_labels()
    {
        return DB::table('tb_order_labels')->get();
    }

    public static function get_photo_list($sourcedata, $id)
    {
        if (in_array($sourcedata, ['insera', 'manuals']))
        {
            $photos = DB::table('tb_order_segment')->where('id', $id)->first();
        }
        elseif ($sourcedata == 'bima')
        {
            $photos = DB::table('tb_order_sub_status')->where('id', $id)->first();
        }
        else
        {
            $photos = [];
        }

        return $photos;
    }
}
