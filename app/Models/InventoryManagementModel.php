<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

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
