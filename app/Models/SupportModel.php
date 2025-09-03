<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

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
                'tao.order_code',
                'tao.order_id',
                'tao.service_area_id',
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
                'tao.order_code',
                'tao.order_id',
                'tao.service_area_id',
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
                'tao.order_code',
                'tao.order_id',
                'tao.service_area_id',
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
}
