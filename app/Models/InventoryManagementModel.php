<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InventoryManagementModel extends Model
{
    public static function get_inventory_material()
    {
        return DB::table('tb_inventory_material')->get();
    }

    public static function get_inventory_nte($type)
    {
        return DB::table('tb_inventory_nte')->where('nte_type', $type)->get();
    }

    public static function get_inventory_by_order($id, $inventory = null, $type = null)
    {
        if ($inventory == 'material')
        {
            return DB::table('tb_assign_orders AS tao')
                ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
                ->leftJoin('tb_inventory_material_reports AS tmr', 'tar.id', '=', 'tmr.assign_order_reports_id')
                ->leftJoin('tb_inventory_material AS tim', 'tmr.inventory_material_id', '=', 'tim.id')
                ->select('tim.*', 'tmr.qty')
                ->where('tao.id', $id)
                ->get();
        } elseif ($inventory == 'nte')
        {
            if ($type == 'ont')
            {
                return DB::table('tb_assign_orders AS tao')
                    ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
                    ->leftJoin('tb_inventory_nte_reports AS tnr', 'tar.id', '=', 'tnr.assign_order_reports_id')
                    ->leftJoin('tb_inventory_nte AS tin', 'tnr.inventory_nte_id_ont', '=', 'tin.id')
                    ->select('tin.*', 'tnr.serial_number_ont')
                    ->where('tao.id', $id)
                    ->where('tin.nte_type', 'ont')
                    ->first();
            } elseif ($type == 'stb')
            {
                return DB::table('tb_assign_orders AS tao')
                    ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
                    ->leftJoin('tb_inventory_nte_reports AS tnr', 'tar.id', '=', 'tnr.assign_order_reports_id')
                    ->leftJoin('tb_inventory_nte AS tin', 'tnr.inventory_nte_id_stb', '=', 'tin.id')
                    ->select('tin.*', 'tnr.serial_number_stb')
                    ->where('tao.id', $id)
                    ->where('tin.nte_type', 'stb')
                    ->first();
            }
        }
    }
}
