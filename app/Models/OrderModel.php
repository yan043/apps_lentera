<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderModel extends Model
{
    public static function get_order_status_by_step($step = '1.1')
    {
        if ($step == 'ALL')
        {
            $data = DB::table('tb_order_status');
        } else
        {
            $data = DB::table('tb_order_status')->where('previous_step', $step);
        }

        return $data->where('is_active', 1)->orderBy('id', 'ASC')->get();
    }

    public static function index($id)
    {
        $witel = strtoupper(Session::get('witel_alias'));

        $inseraQuery = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_source_insera AS tsi', 'tao.order_id', '=', 'tsi.incident_id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
            ->leftJoin('tb_order_status AS tst', 'tar.order_status_id', '=', 'tst.id')
            ->leftJoin('tb_order_segment AS tos', 'tar.order_segment_id', '=', 'tos.id')
            ->leftJoin('tb_order_action AS toa', 'tos.id', '=', 'toa.order_segment_id')
            ->select(
                'tao.*',

                'tsi.incident AS order_code',
                'tsi.incident_id AS order_id',
                'tsi.service_no',
                'tsi.customer_name',
                'tsi.contact_phone',
                'tsi.summary AS notes',
                DB::raw('NULL as customer_coordinates'),
                'tsi.odp_name',
                'tsi.reported_date AS order_date',
                'tsi.region AS region_name',
                'tsi.witel',
                'tsi.workzone',

                'tt.name AS team_name',
                'tsa.name AS service_area_name',

                'tar.order_status_id',
                'tst.previous_step AS order_status_previous_step',
                'tst.next_step AS order_status_next_step',
                'tst.name AS order_status_name',
                'tst.status_code AS order_status_code',
                'tst.status_group AS order_status_group',

                'tar.order_segment_id',
                'tos.name AS order_segment_name',

                'tar.order_action_id',
                'toa.name AS order_action_name',

                'tar.report_phone_number',
                'tar.report_coordinates_location',
                'tar.report_odp_name',
                'tar.report_odp_coordinates',
                'tar.report_valins_id',
                'tar.report_refferal_order_code',
                'tar.report_notes'
            )
            ->where([
                'tao.id'    => $id,
                'tsi.witel' => $witel,
            ]);

        $manualQuery = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_source_manuals AS tsm', 'tao.order_id', '=', 'tsm.incident_id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
            ->leftJoin('tb_order_status AS tst', 'tar.order_status_id', '=', 'tst.id')
            ->leftJoin('tb_order_segment AS tos', 'tar.order_segment_id', '=', 'tos.id')
            ->leftJoin('tb_order_action AS toa', 'tos.id', '=', 'toa.order_segment_id')
            ->select(
                'tao.*',

                'tsm.incident AS order_code',
                'tsm.incident_id AS order_id',
                'tsm.service_no',
                'tsm.customer_name',
                'tsm.contact_phone',
                'tsm.summary AS notes',
                DB::raw('NULL as customer_coordinates'),
                'tsm.odp_name',
                'tsm.reported_date AS order_date',
                'tsm.region AS region_name',
                'tsm.witel',
                'tsm.workzone',

                'tt.name AS team_name',
                'tsa.name AS service_area_name',

                'tar.order_status_id',
                'tst.previous_step AS order_status_previous_step',
                'tst.next_step AS order_status_next_step',
                'tst.name AS order_status_name',
                'tst.status_code AS order_status_code',
                'tst.status_group AS order_status_group',

                'tar.order_segment_id',
                'tos.name AS order_segment_name',

                'tar.order_action_id',
                'toa.name AS order_action_name',

                'tar.report_phone_number',
                'tar.report_coordinates_location',
                'tar.report_odp_name',
                'tar.report_odp_coordinates',
                'tar.report_valins_id',
                'tar.report_refferal_order_code',
                'tar.report_notes'
            )
            ->where([
                'tao.id'    => $id,
                'tsm.witel' => $witel,
            ]);

        $bimaQuery = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_source_bima AS tbm', 'tao.order_id', '=', 'tbm.c_wonum_id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
            ->leftJoin('tb_order_status AS tst', 'tar.order_status_id', '=', 'tst.id')
            ->leftJoin('tb_order_segment AS tos', 'tar.order_segment_id', '=', 'tos.id')
            ->leftJoin('tb_order_action AS toa', 'tos.id', '=', 'toa.order_segment_id')
            ->select(
                'tao.*',

                'tbm.c_wonum AS order_code',
                'tbm.c_wonum_id AS order_id',
                'tbm.c_servicenum AS service_no',
                'tbm.c_customer_name AS customer_name',
                'tbm.c_contact_telephone_number AS contact_phone',
                'tbm.c_serviceaddress AS notes',
                DB::raw('NULL as customer_coordinates'),
                DB::raw('NULL as odp_name'),
                'tbm.c_datemodified AS order_date',
                'tbm.c_siteid AS region_name',
                'tbm.c_tk_subregion AS witel',
                'tbm.c_workzone AS workzone',

                'tt.name AS team_name',
                'tsa.name AS service_area_name',

                'tar.order_status_id',
                'tst.previous_step AS order_status_previous_step',
                'tst.next_step AS order_status_next_step',
                'tst.name AS order_status_name',
                'tst.status_code AS order_status_code',
                'tst.status_group AS order_status_group',

                'tar.order_segment_id',
                'tos.name AS order_segment_name',

                'tar.order_action_id',
                'toa.name AS order_action_name',

                'tar.report_phone_number',
                'tar.report_coordinates_location',
                'tar.report_odp_name',
                'tar.report_odp_coordinates',
                'tar.report_valins_id',
                'tar.report_refferal_order_code',
                'tar.report_notes'
            )
            ->where([
                'tao.id'             => $id,
                'tbm.c_tk_subregion' => $witel,
            ]);

        $insera = $inseraQuery->first();
        if ($insera)
        {
            return $insera;
        }

        $manual = $manualQuery->first();
        if ($manual)
        {
            return $manual;
        }

        $bima = $bimaQuery->first();
        if ($bima)
        {
            return $bima;
        }

        return null;
    }

    public static function indexUpdate($request)
    {
        DB::table('tb_assign_order_reports')->updateOrInsert(
            [
                'assign_order_id' => $request['id'],
            ],
            [
                'order_status_id'             => $request['order_status_id'],
                'report_notes'                => $request['report_notes'],
                'report_phone_number'         => $request['report_phone_number'],
                'report_coordinates_location' => $request['report_coordinates_location'],
                'report_odp_name'             => $request['report_odp_name'],
                'report_odp_coordinates'      => $request['report_odp_coordinates'],
                'report_valins_id'            => $request['report_valins_id'],
                'report_refferal_order_code'  => $request['report_refferal_order_code'],
                'created_by'                  => Session::get('nik'),
                'updated_by'                  => Session::get('nik'),
                'updated_at'                  => now(),
            ]
        );

        if (! empty($request['order_segment_id']))
        {
            DB::table('tb_assign_order_reports')->where('assign_order_id', $request['id'])
                ->update(
                    [
                        'order_segment_id' => $request['order_segment_id'],
                        'order_action_id'  => $request['order_action_id'],
                    ]
                );
        }

        $id = DB::table('tb_assign_order_reports_log')->insertGetId(
            [
                'assign_order_id'             => $request['id'],
                'order_status_id'             => $request['order_status_id'],
                'order_segment_id'            => $request['order_segment_id'],
                'order_action_id'             => $request['order_action_id'],
                'report_notes'                => $request['report_notes'],
                'report_phone_number'         => $request['report_phone_number'],
                'report_coordinates_location' => $request['report_coordinates_location'],
                'report_odp_name'             => $request['report_odp_name'],
                'report_odp_coordinates'      => $request['report_odp_coordinates'],
                'report_valins_id'            => $request['report_valins_id'],
                'report_refferal_order_code'  => $request['report_refferal_order_code'],
                'created_by'                  => Session::get('nik'),
                'created_at'                  => now(),
            ]
        );

        if (! empty($request['order_segment_id']))
        {
            DB::table('tb_assign_order_reports_log')->where('id', $id)
                ->update(
                    [
                        'order_segment_id' => $request['order_segment_id'],
                        'order_action_id'  => $request['order_action_id'],
                    ]
                );
        }

        if (! empty($request['nte_data']))
        {
            $nte = json_decode($request['nte_data'], true);
            DB::table('tb_inventory_nte_reports')->updateOrInsert(
                [
                    'assign_order_reports_id' => $request['id'],
                ],
                [
                    'inventory_nte_id_ont' => $nte['inventory_nte_id_ont'] ?? 0,
                    'serial_number_ont'    => $nte['serial_number_ont']    ?? null,
                    'inventory_nte_id_stb' => $nte['inventory_nte_id_stb'] ?? 0,
                    'serial_number_stb'    => $nte['serial_number_stb']    ?? null,
                    'created_by'           => Session::get('nik'),
                    'created_at'           => now(),
                ]
            );
        }

        if (! empty($request['materials_data']))
        {
            $materials = json_decode($request['materials_data'], true);
            foreach ($materials as $material)
            {
                if ($material['id'] != null)
                {
                    DB::table('tb_inventory_material_reports')->updateOrInsert(
                        [
                            'assign_order_reports_id' => $request['id'],
                            'inventory_material_id'   => $material['id'],
                        ],
                        [
                            'qty'        => $material['qty'],
                            'created_by' => Session::get('nik'),
                            'created_at' => now(),
                        ]
                    );
                }
            }
        }
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

    public static function get_photo_list($sourcedata, $id)
    {
        if (in_array($sourcedata, ['insera', 'manuals']))
        {
            $photos = DB::table('tb_order_segment')->where('id', $id)->first();
        } elseif ($sourcedata == 'bima')
        {
            $photos = DB::table('tb_order_status')->where('id', $id)->first();
        } else
        {
            $photos = [];
        }

        return $photos;
    }

    public static function get_log_order($id)
    {
        return DB::table('tb_assign_order_reports_log AS tarl')
            ->leftJoin('tb_employee AS te', 'tarl.created_by', '=', 'te.nik')
            ->leftJoin('tb_order_status AS toss', 'tarl.order_status_id', '=', 'toss.id')
            ->leftJoin('tb_order_segment AS tose', 'tarl.order_segment_id', '=', 'tose.id')
            ->leftJoin('tb_order_action AS toa', 'tarl.order_action_id', '=', 'toa.id')
            ->select(
                'tarl.*',
                'te.full_name AS created_name',
                'toss.name AS order_status_name',
                'tose.name AS order_segment_name',
                'toa.name AS order_action_name'
            )
            ->where('tarl.assign_order_id', $id)
            ->orderBy('tarl.created_at', 'DESC')
            ->get();
    }

    public static function get_log_assignment($id)
    {
        return DB::table('tb_assign_orders_log AS tal')
            ->leftJoin('tb_employee AS te', 'tal.created_by', '=', 'te.nik')
            ->leftJoin('tb_team AS tt', 'tal.team_id', '=', 'tt.id')
            ->select(
                'tal.*',
                'te.full_name AS created_name'
            )
            ->where('tal.id', $id)
            ->orderBy('tal.created_at', 'DESC')
            ->get();
    }
}
