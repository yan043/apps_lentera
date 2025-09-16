<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

class ReportsPaymentModel extends Model
{
    public static function get_reports_status_group($start_date, $end_date)
    {
        $witel_id = Session::get('witel_id');

        $inseraQuery = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_source_insera AS tsi', 'tao.order_id', '=', 'tsi.incident_id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
            ->leftJoin('tb_order_status AS tst', 'tar.order_status_id', '=', 'tst.id')
            ->select(DB::raw('
                tsa.id AS service_area_id,
                tsa.name AS service_area_name,
                SUM(CASE WHEN (tst.status_group = "READY" OR tst.status_group IS NULL) THEN 1 ELSE 0 END) AS sg_ready,
                SUM(CASE WHEN tst.status_group = "ON-PROGRESS" THEN 1 ELSE 0 END) AS sg_on_progress,
                SUM(CASE WHEN tst.status_group = "CUST-ISSUE" THEN 1 ELSE 0 END) AS sg_cust_issue,
                SUM(CASE WHEN tst.status_group = "TECH-ISSUE" THEN 1 ELSE 0 END) AS sg_tech_issue,
                SUM(CASE WHEN tst.status_group = "CLOSED" THEN 1 ELSE 0 END) AS sg_closed,
                SUM(CASE WHEN tst.status_group = "OTHER-ISSUE" THEN 1 ELSE 0 END) AS sg_other_issue,
                SUM(CASE WHEN tst.status_group = "DONE" THEN 1 ELSE 0 END) AS sg_done,
                COUNT(tao.id) AS total_orders
            '))
            ->whereBetween('tao.assign_date', [$start_date, $end_date])
            ->whereNotNull('tsi.workzone')
            ->where([
                'tst.is_active' => 1,
                'tt.is_active'  => 1,
                'tsa.is_active' => 1,
                'tsa.witel_id'  => $witel_id
            ])
            ->groupBy('tsa.id', 'tsa.name');

        $manualQuery = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_source_manuals AS tsm', 'tao.order_id', '=', 'tsm.incident_id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
            ->leftJoin('tb_order_status AS tst', 'tar.order_status_id', '=', 'tst.id')
            ->select(DB::raw('
                tsa.id AS service_area_id,
                tsa.name AS service_area_name,
                SUM(CASE WHEN (tst.status_group = "READY" OR tst.status_group IS NULL) THEN 1 ELSE 0 END) AS sg_ready,
                SUM(CASE WHEN tst.status_group = "ON-PROGRESS" THEN 1 ELSE 0 END) AS sg_on_progress,
                SUM(CASE WHEN tst.status_group = "CUST-ISSUE" THEN 1 ELSE 0 END) AS sg_cust_issue,
                SUM(CASE WHEN tst.status_group = "TECH-ISSUE" THEN 1 ELSE 0 END) AS sg_tech_issue,
                SUM(CASE WHEN tst.status_group = "CLOSED" THEN 1 ELSE 0 END) AS sg_closed,
                SUM(CASE WHEN tst.status_group = "OTHER-ISSUE" THEN 1 ELSE 0 END) AS sg_other_issue,
                SUM(CASE WHEN tst.status_group = "DONE" THEN 1 ELSE 0 END) AS sg_done,
                COUNT(tao.id) AS total_orders
            '))
            ->whereBetween('tao.assign_date', [$start_date, $end_date])
            ->whereNotNull('tsm.workzone')
            ->where([
                'tst.is_active' => 1,
                'tt.is_active'  => 1,
                'tsa.is_active' => 1,
                'tsa.witel_id'  => $witel_id
            ])
            ->groupBy('tsa.id', 'tsa.name');

        $bimaQuery = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_source_bima AS tbm', 'tao.order_id', '=', 'tbm.c_wonum_id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
            ->leftJoin('tb_order_status AS tst', 'tar.order_status_id', '=', 'tst.id')
            ->select(DB::raw('
                tsa.id AS service_area_id,
                tsa.name AS service_area_name,
                SUM(CASE WHEN (tst.status_group = "READY" OR tst.status_group IS NULL) THEN 1 ELSE 0 END) AS sg_ready,
                SUM(CASE WHEN tst.status_group = "ON-PROGRESS" THEN 1 ELSE 0 END) AS sg_on_progress,
                SUM(CASE WHEN tst.status_group = "CUST-ISSUE" THEN 1 ELSE 0 END) AS sg_cust_issue,
                SUM(CASE WHEN tst.status_group = "TECH-ISSUE" THEN 1 ELSE 0 END) AS sg_tech_issue,
                SUM(CASE WHEN tst.status_group = "CLOSED" THEN 1 ELSE 0 END) AS sg_closed,
                SUM(CASE WHEN tst.status_group = "OTHER-ISSUE" THEN 1 ELSE 0 END) AS sg_other_issue,
                SUM(CASE WHEN tst.status_group = "DONE" THEN 1 ELSE 0 END) AS sg_done,
                COUNT(tao.id) AS total_orders
            '))
            ->whereBetween('tao.assign_date', [$start_date, $end_date])
            ->whereNotNull('tbm.c_workzone')
            ->where([
                'tst.is_active' => 1,
                'tt.is_active'  => 1,
                'tsa.is_active' => 1,
                'tsa.witel_id'  => $witel_id
            ])
            ->groupBy('tsa.id', 'tsa.name');

        $parent = $inseraQuery->unionAll($manualQuery)->unionAll($bimaQuery);

        $parentFinal = DB::query()->fromSub($parent, 'src')
            ->select(
                'src.service_area_id',
                'src.service_area_name',
                DB::raw('SUM(src.sg_ready) AS sg_ready'),
                DB::raw('SUM(src.sg_on_progress) AS sg_on_progress'),
                DB::raw('SUM(src.sg_cust_issue) AS sg_cust_issue'),
                DB::raw('SUM(src.sg_tech_issue) AS sg_tech_issue'),
                DB::raw('SUM(src.sg_closed) AS sg_closed'),
                DB::raw('SUM(src.sg_other_issue) AS sg_other_issue'),
                DB::raw('SUM(src.sg_done) AS sg_done'),
                DB::raw('SUM(src.total_orders) AS total_orders')
            )
            ->groupBy('src.service_area_id', 'src.service_area_name')
            ->get();

        $childInsera = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_source_insera AS tsi', 'tao.order_id', '=', 'tsi.incident_id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
            ->leftJoin('tb_order_status AS tst', 'tar.order_status_id', '=', 'tst.id')
            ->select(DB::raw('
                tsa.id AS service_area_id,
                tsi.workzone AS work_zone_name,
                SUM(CASE WHEN (tst.status_group = "READY" OR tst.status_group IS NULL) THEN 1 ELSE 0 END) AS sg_ready,
                SUM(CASE WHEN tst.status_group = "ON-PROGRESS" THEN 1 ELSE 0 END) AS sg_on_progress,
                SUM(CASE WHEN tst.status_group = "CUST-ISSUE" THEN 1 ELSE 0 END) AS sg_cust_issue,
                SUM(CASE WHEN tst.status_group = "TECH-ISSUE" THEN 1 ELSE 0 END) AS sg_tech_issue,
                SUM(CASE WHEN tst.status_group = "CLOSED" THEN 1 ELSE 0 END) AS sg_closed,
                SUM(CASE WHEN tst.status_group = "OTHER-ISSUE" THEN 1 ELSE 0 END) AS sg_other_issue,
                SUM(CASE WHEN tst.status_group = "DONE" THEN 1 ELSE 0 END) AS sg_done,
                COUNT(tao.id) AS total_orders
            '))
            ->whereBetween('tao.assign_date', [$start_date, $end_date])
            ->whereNotNull('tsi.workzone')
            ->where([
                'tst.is_active' => 1,
                'tt.is_active'  => 1,
                'tsa.is_active' => 1,
                'tsa.witel_id'  => $witel_id
            ])
            ->groupBy('tsa.id', 'tsi.workzone');

        $childManual = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_source_manuals AS tsm', 'tao.order_id', '=', 'tsm.incident_id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
            ->leftJoin('tb_order_status AS tst', 'tar.order_status_id', '=', 'tst.id')
            ->select(DB::raw('
                tsa.id AS service_area_id,
                tsm.workzone AS work_zone_name,
                SUM(CASE WHEN (tst.status_group = "READY" OR tst.status_group IS NULL) THEN 1 ELSE 0 END) AS sg_ready,
                SUM(CASE WHEN tst.status_group = "ON-PROGRESS" THEN 1 ELSE 0 END) AS sg_on_progress,
                SUM(CASE WHEN tst.status_group = "CUST-ISSUE" THEN 1 ELSE 0 END) AS sg_cust_issue,
                SUM(CASE WHEN tst.status_group = "TECH-ISSUE" THEN 1 ELSE 0 END) AS sg_tech_issue,
                SUM(CASE WHEN tst.status_group = "CLOSED" THEN 1 ELSE 0 END) AS sg_closed,
                SUM(CASE WHEN tst.status_group = "OTHER-ISSUE" THEN 1 ELSE 0 END) AS sg_other_issue,
                SUM(CASE WHEN tst.status_group = "DONE" THEN 1 ELSE 0 END) AS sg_done,
                COUNT(tao.id) AS total_orders
            '))
            ->whereBetween('tao.assign_date', [$start_date, $end_date])
            ->whereNotNull('tsm.workzone')
            ->where([
                'tst.is_active' => 1,
                'tt.is_active'  => 1,
                'tsa.is_active' => 1,
                'tsa.witel_id'  => $witel_id
            ])
            ->groupBy('tsa.id', 'tsm.workzone');

        $childBima = DB::table('tb_assign_orders AS tao')
            ->leftJoin('tb_source_bima AS tbm', 'tao.order_id', '=', 'tbm.c_wonum_id')
            ->leftJoin('tb_team AS tt', 'tao.team_id', '=', 'tt.id')
            ->leftJoin('tb_service_area AS tsa', 'tt.service_area_id', '=', 'tsa.id')
            ->leftJoin('tb_assign_order_reports AS tar', 'tao.id', '=', 'tar.assign_order_id')
            ->leftJoin('tb_order_status AS tst', 'tar.order_status_id', '=', 'tst.id')
            ->select(DB::raw('
                tsa.id AS service_area_id,
                tbm.c_workzone AS work_zone_name,
                SUM(CASE WHEN (tst.status_group = "READY" OR tst.status_group IS NULL) THEN 1 ELSE 0 END) AS sg_ready,
                SUM(CASE WHEN tst.status_group = "ON-PROGRESS" THEN 1 ELSE 0 END) AS sg_on_progress,
                SUM(CASE WHEN tst.status_group = "CUST-ISSUE" THEN 1 ELSE 0 END) AS sg_cust_issue,
                SUM(CASE WHEN tst.status_group = "TECH-ISSUE" THEN 1 ELSE 0 END) AS sg_tech_issue,
                SUM(CASE WHEN tst.status_group = "CLOSED" THEN 1 ELSE 0 END) AS sg_closed,
                SUM(CASE WHEN tst.status_group = "OTHER-ISSUE" THEN 1 ELSE 0 END) AS sg_other_issue,
                SUM(CASE WHEN tst.status_group = "DONE" THEN 1 ELSE 0 END) AS sg_done,
                COUNT(tao.id) AS total_orders
            '))
            ->whereBetween('tao.assign_date', [$start_date, $end_date])
            ->whereNotNull('tbm.c_workzone')
            ->where([
                'tst.is_active' => 1,
                'tt.is_active'  => 1,
                'tsa.is_active' => 1,
                'tsa.witel_id'  => $witel_id
            ])
            ->groupBy('tsa.id', 'tbm.c_workzone');

        $child = $childInsera->unionAll($childManual)->unionAll($childBima);

        $childFinal = DB::query()->fromSub($child, 'src')
            ->select(
                'src.service_area_id',
                'src.work_zone_name',
                DB::raw('SUM(src.sg_ready) AS sg_ready'),
                DB::raw('SUM(src.sg_on_progress) AS sg_on_progress'),
                DB::raw('SUM(src.sg_cust_issue) AS sg_cust_issue'),
                DB::raw('SUM(src.sg_tech_issue) AS sg_tech_issue'),
                DB::raw('SUM(src.sg_closed) AS sg_closed'),
                DB::raw('SUM(src.sg_other_issue) AS sg_other_issue'),
                DB::raw('SUM(src.sg_done) AS sg_done'),
                DB::raw('SUM(src.total_orders) AS total_orders')
            )
            ->groupBy('src.service_area_id', 'src.work_zone_name')
            ->get();

        $result = $parentFinal->map(function ($p) use ($childFinal)
        {
            return [
                'service_area_id'   => $p->service_area_id,
                'service_area_name' => $p->service_area_name,
                'sg_ready'          => $p->sg_ready,
                'sg_on_progress'    => $p->sg_on_progress,
                'sg_cust_issue'     => $p->sg_cust_issue,
                'sg_tech_issue'     => $p->sg_tech_issue,
                'sg_closed'         => $p->sg_closed,
                'sg_other_issue'    => $p->sg_other_issue,
                'sg_done'           => $p->sg_done,
                'total_orders'      => $p->total_orders,
                'children'          => $childFinal->where('service_area_id', $p->service_area_id)->values()
            ];
        });

        return $result;
    }
}
