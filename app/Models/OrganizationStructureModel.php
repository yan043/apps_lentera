<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class OrganizationStructureModel extends Model
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

    public static function get_service_area()
    {
        return DB::table('tb_service_area AS tsa')
            ->leftJoin('tb_regional AS tr', 'tsa.regional_id', '=', 'tr.id')
            ->leftJoin('tb_witel AS tw', 'tsa.witel_id', '=', 'tw.id')
            ->leftJoin(DB::raw('tb_employee AS te'), 'te.nik', '=', 'tsa.head_service_area')
            ->leftJoin(DB::raw('tb_employee AS te2'), 'te2.nik', '=', 'tsa.officer_service_area')
            ->leftJoin(DB::raw('tb_employee AS te3'), 'te3.nik', '=', 'tsa.kordinator_lapangan1')
            ->leftJoin(DB::raw('tb_employee AS te4'), 'te4.nik', '=', 'tsa.kordinator_lapangan2')
            ->select(
                'tsa.*',
                'tr.name AS regional_name',
                'tw.name AS witel_name',
                DB::raw('te.full_name AS head_service_area_name'),
                DB::raw('te2.full_name AS officer_service_area_name'),
                DB::raw('te3.full_name AS kordinator_lapangan1_name'),
                DB::raw('te4.full_name AS kordinator_lapangan2_name')
            )
            ->where('tsa.is_active', 1)
            ->get();
    }

    public static function get_service_area_by_id($id)
    {
        return DB::table('tb_service_area AS tsa')
            ->leftJoin('tb_regional AS tr', 'tsa.regional_id', '=', 'tr.id')
            ->leftJoin('tb_witel AS tw', 'tsa.witel_id', '=', 'tw.id')
            ->leftJoin(DB::raw('tb_employee AS te'), 'te.nik', '=', 'tsa.head_service_area')
            ->leftJoin(DB::raw('tb_employee AS te2'), 'te2.nik', '=', 'tsa.officer_service_area')
            ->leftJoin(DB::raw('tb_employee AS te3'), 'te3.nik', '=', 'tsa.kordinator_lapangan1')
            ->leftJoin(DB::raw('tb_employee AS te4'), 'te4.nik', '=', 'tsa.kordinator_lapangan2')
            ->select(
                'tsa.*',
                'tr.name AS regional_name',
                'tw.name AS witel_name',
                DB::raw('te.full_name AS head_service_area_name'),
                DB::raw('te2.full_name AS officer_service_area_name'),
                DB::raw('te3.full_name AS kordinator_lapangan1_name'),
                DB::raw('te4.full_name AS kordinator_lapangan2_name')
            )
            ->where([
                'tsa.id' => $id,
                'tsa.is_active' => 1
            ])
            ->first();
    }

    public static function get_work_zone()
    {
        return DB::table('tb_work_zone AS wz')
        ->leftJoin('tb_service_area AS ta', 'wz.service_area_id', '=', 'ta.id')
        ->leftJoin('tb_regional AS tr', 'ta.regional_id', '=', 'tr.id')
        ->leftJoin('tb_witel AS tw', 'ta.witel_id', '=', 'tw.id')
        ->select(
            'wz.*',
            'ta.id AS service_area_id',
            'ta.name AS service_area_name',
            'tr.id AS regional_id',
            'tr.name AS regional_name',
            'tw.id AS witel_id',
            'tw.name AS witel_name'
        )
        ->get();
    }

    public static function get_work_zone_by_id($id)
    {
        return DB::table('tb_work_zone AS wz')
        ->leftJoin('tb_service_area AS ta', 'wz.service_area_id', '=', 'ta.id')
        ->leftJoin('tb_regional AS tr', 'ta.regional_id', '=', 'tr.id')
        ->leftJoin('tb_witel AS tw', 'ta.witel_id', '=', 'tw.id')
        ->select(
            'wz.*',
            'ta.id AS service_area_id',
            'ta.name AS service_area_name',
            'tr.id AS regional_id',
            'tr.name AS regional_name',
            'tw.id AS witel_id',
            'tw.name AS witel_name'
        )
        ->where('wz.id', $id)
        ->first();
    }

    public static function get_team()
    {
        return DB::table('tb_team AS tt')
            ->leftJoin('tb_service_area AS ta', 'tt.service_area_id', '=', 'ta.id')
            ->leftJoin('tb_employee AS te', 'tt.technician1', '=', 'te.nik')
            ->leftJoin('tb_employee AS te2', 'tt.technician2', '=', 'te2.nik')
            ->select(
                'tt.*',
                'ta.id AS service_area_id',
                'ta.name AS service_area_name',
                DB::raw('te.full_name AS technician1_name'),
                DB::raw('te2.full_name AS technician2_name')
            )
            ->where('tt.is_active', 1)
            ->get();
    }

    public static function get_team_by_id($id)
    {
        return DB::table('tb_team AS tt')
            ->leftJoin('tb_service_area AS ta', 'tt.service_area_id', '=', 'ta.id')
            ->leftJoin('tb_employee AS te', 'tt.technician1', '=', 'te.nik')
            ->leftJoin('tb_employee AS te2', 'tt.technician2', '=', 'te2.nik')
            ->select(
                'tt.*',
                'ta.id AS service_area_id',
                'ta.name AS service_area_name',
                DB::raw('te.full_name AS technician1_name'),
                DB::raw('te2.full_name AS technician2_name')
            )
            ->where([
                'tt.id' => $id,
                'tt.is_active' => 1
            ])
            ->first();
    }
}
