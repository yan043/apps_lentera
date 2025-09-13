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
}
