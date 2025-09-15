<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SupportModel extends Model
{
    public static function get_search_order($id)
    {
        $witel = strtoupper(Session::get('witel_alias'));

        $searchType = null;
        if (preg_match('/^INC\d+$/', $id))
        {
            $searchType = 'incident';
        }
        elseif (preg_match('/^\d{10,}$/', $id))
        {
            $searchType = 'service_no';
        }
        else
        {
            $searchType = 'order_code';
        }

        $assignedInsera = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_source_insera AS tsi', 'tao.order_id', '=', 'tsi.incident_id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->select(
                'tao.id',
                'tao.order_code',
                'tao.order_id',
                'tao.team_id',
                'tao.team_name',
                'tao.assign_date',
                'tao.assign_labels',
                'tao.assign_notes',
                'tsi.service_no',
                'tsi.customer_name',
                'tsi.contact_phone',
                'tsi.summary AS notes',
                'tsi.odp_name',
                'tsi.reported_date AS order_date',
                'tsi.date_reported',
                'tsi.workzone',
                'tsi.witel',
                'tt.name AS team_name',
                'tt.service_area_id',
                'tsa.name AS service_area_name'
            )
            ->whereNotNull('tao.order_code')
            ->where('tsi.witel', $witel);

        if ($searchType == 'incident')
        {
            $assignedInsera->where('tsi.incident', $id);
        }
        elseif ($searchType == 'service_no')
        {
            $assignedInsera->where('tsi.service_no', $id);
        }
        else
        {
            $assignedInsera->where('tao.order_code', $id);
        }

        $assignedManual = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_source_manuals AS tsm', 'tao.order_id', '=', 'tsm.incident_id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->select(
                'tao.id',
                'tao.order_code',
                'tao.order_id',
                'tao.team_id',
                'tao.team_name',
                'tao.assign_date',
                'tao.assign_labels',
                'tao.assign_notes',
                'tsm.service_no',
                'tsm.customer_name',
                'tsm.contact_phone',
                'tsm.summary AS notes',
                'tsm.odp_name',
                'tsm.reported_date AS order_date',
                'tsm.date_reported',
                'tsm.workzone',
                'tsm.witel',
                'tt.name AS team_name',
                'tt.service_area_id',
                'tsa.name AS service_area_name'
            )
            ->whereNotNull('tao.order_code')
            ->where('tsm.witel', $witel);

        if ($searchType == 'incident')
        {
            $assignedManual->where('tsm.incident', $id);
        }
        elseif ($searchType == 'service_no')
        {
            $assignedManual->where('tsm.service_no', $id);
        }
        else
        {
            $assignedManual->where('tao.order_code', $id);
        }

        $assignedBima = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_source_bima AS tbm', 'tao.order_id', '=', 'tbm.c_wonum_id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->select(
                'tao.id',
                'tao.order_code',
                'tao.order_id',
                'tao.team_id',
                'tao.team_name',
                'tao.assign_date',
                'tao.assign_labels',
                'tao.assign_notes',
                'tbm.c_servicenum AS service_no',
                'tbm.c_customer_name AS customer_name',
                'tbm.c_contact_telephone_number AS contact_phone',
                'tbm.c_serviceaddress AS notes',
                DB::raw('NULL as odp_name'),
                'tbm.c_datemodified AS order_date',
                'tbm.c_workzone AS workzone',
                'tbm.c_tk_subregion AS witel',
                'tt.name AS team_name',
                'tt.service_area_id',
                'tsa.name AS service_area_name'
            )
            ->whereNotNull('tao.order_code')
            ->where('tbm.c_tk_subregion', $witel);

        if ($searchType == 'incident')
        {
            $assignedBima->where('tbm.c_wonum', $id);
        }
        elseif ($searchType == 'service_no')
        {
            $assignedBima->where('tbm.c_servicenum', $id);
        }
        else
        {
            $assignedBima->where('tao.order_code', $id);
        }

        $newInsera = DB::table('tb_source_insera AS tsi')
            ->leftJoin('tb_assign_orders AS tao', 'tsi.incident_id', '=', 'tao.order_id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->select(
                'tao.id',
                'tsi.incident AS order_code',
                'tsi.incident_id AS order_id',
                'tsi.service_no',
                'tsi.customer_name',
                'tsi.contact_phone',
                'tsi.summary AS notes',
                'tsi.odp_name',
                'tsi.reported_date AS order_date',
                'tsi.workzone',
                'tsi.witel',
                'tt.name AS team_name',
                'tt.service_area_id',
                'tsa.name AS service_area_name'
            )
            ->whereNull('tao.order_code')
            ->where('tsi.witel', $witel);

        if ($searchType == 'incident')
        {
            $newInsera->where('tsi.incident', $id);
        }
        elseif ($searchType == 'service_no')
        {
            $newInsera->where('tsi.service_no', $id);
        }
        else
        {
            $newInsera->where('tsi.incident', $id);
        }

        $newManual = DB::table('tb_source_manuals AS tsm')
            ->leftJoin('tb_assign_orders AS tao', 'tsm.incident_id', '=', 'tao.order_id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->select(
                'tao.id',
                'tsm.incident AS order_code',
                'tsm.incident_id AS order_id',
                'tsm.service_no',
                'tsm.customer_name',
                'tsm.contact_phone',
                'tsm.summary AS notes',
                'tsm.odp_name',
                'tsm.reported_date AS order_date',
                'tsm.workzone',
                'tsm.witel',
                'tt.name AS team_name',
                'tt.service_area_id',
                'tsa.name AS service_area_name'
            )
            ->whereNull('tao.order_code')
            ->where('tsm.witel', $witel);

        if ($searchType == 'incident')
        {
            $newManual->where('tsm.incident', $id);
        }
        elseif ($searchType == 'service_no')
        {
            $newManual->where('tsm.service_no', $id);
        }
        else
        {
            $newManual->where('tsm.incident', $id);
        }

        $newBima = DB::table('tb_source_bima AS tbm')
            ->leftJoin('tb_assign_orders AS tao', 'tbm.c_wonum_id', '=', 'tao.order_id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->select(
                'tao.id',
                'tbm.c_wonum AS order_code',
                'tbm.c_wonum_id AS order_id',
                'tbm.c_servicenum AS service_no',
                'tbm.c_customer_name AS customer_name',
                'tbm.c_contact_telephone_number AS contact_phone',
                'tbm.c_serviceaddress AS notes',
                DB::raw('NULL as odp_name'),
                'tbm.c_datemodified AS order_date',
                'tbm.c_workzone AS workzone',
                'tbm.c_tk_subregion AS witel',
                'tt.name AS team_name',
                'tt.service_area_id',
                'tsa.name AS service_area_name'
            )
            ->whereNull('tao.order_code')
            ->where('tbm.c_tk_subregion', $witel);

        if ($searchType == 'incident')
        {
            $newBima->where('tbm.c_wonum', $id);
        }
        elseif ($searchType == 'service_no')
        {
            $newBima->where('tbm.c_servicenum', $id);
        }
        else
        {
            $newBima->where('tbm.c_wonum', $id);
        }

        $assigned = $assignedInsera->orderBy('tao.updated_at', 'DESC')->get()
            ->merge($assignedManual->orderBy('tao.updated_at', 'DESC')->get())
            ->merge($assignedBima->orderBy('tao.updated_at', 'DESC')->get());

        $new = $newInsera->orderBy('tsi.reported_date', 'DESC')->get()
            ->merge($newManual->orderBy('tsm.reported_date', 'DESC')->get())
            ->merge($newBima->orderBy('tbm.c_datemodified', 'DESC')->get());

        if ($assigned->isEmpty())
        {
            return $new->take(1)->values();
        }

        return $assigned->take(1)->values();
    }

    public static function get_service_area_order($service_area_id, $sourcedata, $date)
    {
        $data = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
            ->leftJoin('tb_order_status AS tos', 'tar.order_status_id', '=', 'tos.id')
            ->leftJoin('tb_order_segment AS tseg', 'tar.order_segment_id', '=', 'tseg.id')
            ->leftJoin('tb_order_action AS toa', 'tar.order_action_id', '=', 'toa.id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->select('tsa.id', 'tsa.name')
            ->whereNotNull('tao.order_code')
            ->where([
                'tao.assign_date' => $date,
                'tsa.witel_id'    => Session::get('witel_id'),
                'tt.is_active'    => 1,
                'tsa.is_active'   => 1,
            ])
            ->groupBy('tsa.id');

        if ($service_area_id != 'ALL')
        {
            $data->where('tt.service_area_id', $service_area_id);
        }

        if ($sourcedata != 'ALL')
        {
            $data->where('tao.sourcedata', $sourcedata);
        }

        return $data->orderBy('tsa.sort_id', 'ASC')->get();
    }

    public static function get_service_area_order_to_team($service_area_id, $sourcedata, $date)
    {
        $data = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
            ->leftJoin('tb_order_status AS tos', 'tar.order_status_id', '=', 'tos.id')
            ->leftJoin('tb_order_segment AS tseg', 'tar.order_segment_id', '=', 'tseg.id')
            ->leftJoin('tb_order_action AS toa', 'tar.order_action_id', '=', 'toa.id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->select('tt.id', 'tt.name')
            ->whereNotNull('tao.order_code')
            ->where([
                'tt.service_area_id' => $service_area_id,
                'tao.assign_date'    => $date,
                'tt.is_active'       => 1,
                'tsa.is_active'      => 1,
            ]);

        if ($sourcedata != 'ALL')
        {
            $data->where('tao.sourcedata', $sourcedata);
        }

        return $data->groupBy('tt.id')->get();
    }

    public static function get_order_team($team_id, $sourcedata, $date)
    {
        $witel = strtoupper(Session::get('witel_alias'));

        $inseraQuery = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_source_insera AS tsi', 'tao.order_id', '=', 'tsi.incident_id')
            ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
            ->leftJoin('tb_order_status AS tst', 'tar.order_status_id', '=', 'tst.id')
            ->leftJoin('tb_order_segment AS tseg', 'tar.order_segment_id', '=', 'tseg.id')
            ->leftJoin('tb_order_action AS toa', 'tar.order_action_id', '=', 'toa.id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->select(
                'tao.*',

                'tsi.incident AS order_code',
                'tsi.incident_id AS order_id',
                'tsi.service_no',
                'tsi.customer_name',
                'tsi.contact_phone',
                'tsi.summary AS notes',
                'tsi.odp_name',
                'tsi.reported_date AS order_date',
                'tsi.workzone',
                'tsi.witel',

                'tt.name AS team_name',
                'tsa.name AS service_area_name',

                'tar.order_status_id',
                'tst.previous_step AS order_status_previous_step',
                'tst.next_step AS order_status_next_step',
                'tst.name AS order_status_name',
                'tst.status_code AS order_status_code',
                'tst.status_group AS order_status_group',
                'tst.status_description AS order_status_description',

                'tar.order_segment_id',
                'tseg.name AS order_segment_name',

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
            ->whereNotNull('tao.order_code')
            ->where([
                'tao.team_id'     => $team_id,
                'tao.assign_date' => $date,
                'tsi.witel'       => $witel,
                'tt.is_active'    => 1,
                'tsa.is_active'   => 1,
            ]);

        $manualQuery = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_source_manuals AS tsm', 'tao.order_id', '=', 'tsm.incident_id')
            ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
            ->leftJoin('tb_order_status AS tst', 'tar.order_status_id', '=', 'tst.id')
            ->leftJoin('tb_order_segment AS tseg', 'tar.order_segment_id', '=', 'tseg.id')
            ->leftJoin('tb_order_action AS toa', 'tar.order_action_id', '=', 'toa.id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->select(
                'tao.*',

                'tsm.incident AS order_code',
                'tsm.incident_id AS order_id',
                'tsm.service_no',
                'tsm.customer_name',
                'tsm.contact_phone',
                'tsm.summary AS notes',
                'tsm.odp_name',
                'tsm.reported_date AS order_date',
                'tsm.workzone',
                'tsm.witel',

                'tt.name AS team_name',
                'tsa.name AS service_area_name',

                'tar.order_status_id',
                'tst.previous_step AS order_status_previous_step',
                'tst.next_step AS order_status_next_step',
                'tst.name AS order_status_name',
                'tst.status_code AS order_status_code',
                'tst.status_group AS order_status_group',
                'tst.status_description AS order_status_description',

                'tar.order_segment_id',
                'tseg.name AS order_segment_name',

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
            ->whereNotNull('tao.order_code')
            ->where([
                'tao.team_id'     => $team_id,
                'tao.assign_date' => $date,
                'tsm.witel'       => $witel,
                'tt.is_active'    => 1,
                'tsa.is_active'   => 1,
            ]);

        $bimaQuery = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_source_bima AS tbm', 'tao.order_id', '=', 'tbm.c_wonum_id')
            ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
            ->leftJoin('tb_order_status AS tst', 'tar.order_status_id', '=', 'tst.id')
            ->leftJoin('tb_order_segment AS tseg', 'tar.order_segment_id', '=', 'tseg.id')
            ->leftJoin('tb_order_action AS toa', 'tar.order_action_id', '=', 'toa.id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->select(
                'tao.*',

                'tbm.c_wonum AS order_code',
                'tbm.c_wonum_id AS order_id',
                'tbm.c_servicenum AS service_no',
                'tbm.c_customer_name AS customer_name',
                'tbm.c_contact_telephone_number AS contact_phone',
                'tbm.c_serviceaddress AS notes',
                DB::raw('NULL as odp_name'),
                'tbm.c_datemodified AS order_date',
                'tbm.c_workzone AS workzone',
                'tbm.c_tk_subregion AS witel',

                'tt.name AS team_name',
                'tsa.name AS service_area_name',

                'tar.order_status_id',
                'tst.previous_step AS order_status_previous_step',
                'tst.next_step AS order_status_next_step',
                'tst.name AS order_status_name',
                'tst.status_code AS order_status_code',
                'tst.status_group AS order_status_group',
                'tst.status_description AS order_status_description',

                'tar.order_segment_id',
                'tseg.name AS order_segment_name',

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
            ->whereNotNull('tao.order_code')
            ->where([
                'tao.team_id'        => $team_id,
                'tao.assign_date'    => $date,
                'tbm.c_tk_subregion' => $witel,
                'tt.is_active'       => 1,
                'tsa.is_active'      => 1,
            ]);

        if ($sourcedata == 'insera')
        {
            return $inseraQuery->orderBy('tao.updated_at', 'DESC')->get();
        }
        elseif ($sourcedata == 'manual')
        {
            return $manualQuery->orderBy('tao.updated_at', 'DESC')->get();
        }
        elseif ($sourcedata == 'bima')
        {
            return $bimaQuery->orderBy('tao.updated_at', 'DESC')->get();
        }
        else
        {
            $inseraSql = $inseraQuery->orderBy('tao.updated_at', 'DESC');
            $manualSql = $manualQuery->orderBy('tao.updated_at', 'DESC');
            $bimaSql   = $bimaQuery->orderBy('tao.updated_at', 'DESC');

            return $inseraSql->unionAll($manualSql)->unionAll($bimaSql)->get();
        }
    }

    public static function helpdesk_monitoring($service_area_id, $sourcedata, $date)
    {
        $order = [];

        $service_area = self::get_service_area_order($service_area_id, $sourcedata, $date);

        foreach ($service_area as $s)
        {
            $team = self::get_service_area_order_to_team($s->id, $sourcedata, $date);

            foreach ($team as $t)
            {
                $list_order = self::get_order_team($t->id, $sourcedata, $date);

                foreach ($list_order as $k2 => $v2)
                {
                    $order[$s->name][$t->name][$k2] = $v2;
                }
            }
        }

        return $order;
    }
}
