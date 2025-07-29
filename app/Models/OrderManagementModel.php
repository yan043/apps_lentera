<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

class OrderManagementModel extends Model
{
    public static function new_orders($witel, $sourcedata, $startdate, $enddate)
    {
        switch ($sourcedata) {
            case 'insera':
                return DB::table('tb_source_insera AS tsi')
                    ->leftJoin('tb_assign_orders AS tao', 'tsi.incident_id', '=', 'tao.order_id')
                    ->select(DB::raw('
                        tsi.workzone,
                        SUM(CASE WHEN
                            TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) >= 0 AND
                            TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) < 2 AND
                            tsi.ticket_id_gamas = ""
                        THEN 1 ELSE 0 END) AS ttr0to2,
                        SUM(CASE WHEN
                            TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) >= 2 AND
                            TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) < 3 AND
                            tsi.ticket_id_gamas = ""
                        THEN 1 ELSE 0 END) AS ttr2to3,
                        SUM(CASE WHEN
                            TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) >= 3 AND
                            TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) < 12 AND
                            tsi.ticket_id_gamas = ""
                        THEN 1 ELSE 0 END) AS ttr3to12,
                        SUM(CASE WHEN
                            TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) >= 12 AND
                            TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) < 24 AND
                            tsi.ticket_id_gamas = ""
                        THEN 1 ELSE 0 END) AS ttr12to24,
                        SUM(CASE WHEN
                            TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) >= 24 AND
                            tsi.ticket_id_gamas = ""
                        THEN 1 ELSE 0 END) AS ttr24,
                        SUM(CASE WHEN
                            tsi.ticket_id_gamas != ""
                        THEN 1 ELSE 0 END) AS gamas,
                        COUNT(*) AS jumlah
                    '))
                    ->whereNull('tao.order_code')
                    ->whereBetween('tsi.date_reported', [$startdate, $enddate])
                    ->where([
                        ['tsi.witel', $witel],
                        ['tsi.service_type', '!=', "NON-NUMBERING"],
                    ])
                    ->whereIn('tsi.status', ["NEW", "DRAFT", "ANALYSIS", "PENDING", "BACKEND"])
                    ->groupBy('tsi.workzone')
                    ->orderBy('jumlah', 'DESC')
                    ->get();
            case 'manual':
                return DB::table('tb_source_manuals AS tsm')
                    ->leftJoin('tb_assign_orders AS tao', 'tsm.incident_id', '=', 'tao.order_id')
                    ->select(DB::raw('
                        tsm.workzone,
                        SUM(CASE WHEN
                            TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) >= 0 AND
                            TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) < 2
                        THEN 1 ELSE 0 END) AS ttr0to2,
                        SUM(CASE WHEN
                            TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) >= 2 AND
                            TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) < 3
                        THEN 1 ELSE 0 END) AS ttr2to3,
                        SUM(CASE WHEN
                            TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) >= 3 AND
                            TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) < 12
                        THEN 1 ELSE 0 END) AS ttr3to12,
                        SUM(CASE WHEN
                            TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) >= 12 AND
                            TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) < 24
                        THEN 1 ELSE 0 END) AS ttr12to24,
                        SUM(CASE WHEN
                            TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) >= 24
                        THEN 1 ELSE 0 END) AS ttr24,
                        COUNT(*) AS jumlah
                    '))
                    ->whereNull('tao.order_code')
                    ->whereBetween('tsm.date_reported', [$startdate, $enddate])
                    ->where([
                        ['tsm.witel', $witel],
                    ])
                    ->groupBy('tsm.workzone')
                    ->orderBy('jumlah', 'DESC')
                    ->get();
        }
    }

    public static function new_order_details($sourcedata, $workzone, $ttr, $startdate, $enddate)
    {
        switch ($sourcedata) {
            case 'insera':
                return DB::table('tb_source_insera AS tsi')
                    ->leftJoin('tb_assign_orders AS tao', 'tsi.incident_id', '=', 'tao.order_id')
                    ->select('tsi.*')
                    ->whereNull('tao.order_code')
                    ->whereBetween('tsi.date_reported', [$startdate, $enddate])
                    ->where([
                        ['tsi.workzone', $workzone],
                        ['tsi.service_type', '!=', "NON-NUMBERING"],
                    ])
                    ->whereIn('tsi.status', ["NEW", "DRAFT", "ANALYSIS", "PENDING", "BACKEND"])
                    ->when($ttr == 'ttr0to2', function ($query) {
                        return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) >= 0')
                            ->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) < 2');
                    })
                    ->when($ttr == 'ttr2to3', function ($query) {
                        return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) >= 2')
                            ->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) < 3');
                    })
                    ->when($ttr == 'ttr3to12', function ($query) {
                        return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) >= 3')
                            ->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) < 12');
                    })
                    ->when($ttr == 'ttr12to24', function ($query) {
                        return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) >= 12')
                            ->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) < 24');
                    })
                    ->when($ttr == 'ttr24', function ($query) {
                        return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) >= 24');
                    })
                    ->orderBy('tsi.date_reported', 'DESC')
                    ->get();
            case 'manual':
                return DB::table('tb_source_manuals AS tsm')
                    ->leftJoin('tb_assign_orders AS tao', 'tsm.incident_id', '=', 'tao.order_id')
                    ->select('tsm.*')
                    ->whereNull('tao.order_code')
                    ->whereBetween('tsm.date_reported', [$startdate, $enddate])
                    ->where([
                        ['tsm.workzone', $workzone],
                    ])
                    ->when($ttr == 'ttr0to2', function ($query) {
                        return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) >= 0')
                            ->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) < 2');
                    })
                    ->when($ttr == 'ttr2to3', function ($query) {
                        return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) >= 2')
                            ->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) < 3');
                    })
                    ->when($ttr == 'ttr3to12', function ($query) {
                        return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) >= 3')
                            ->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) < 12');
                    })
                    ->when($ttr == 'ttr12to24', function ($query) {
                        return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) >= 12')
                            ->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) < 24');
                    })
                    ->when($ttr == 'ttr24', function ($query) {
                        return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) >= 24');
                    })
                    ->orderBy('tsm.date_reported', 'DESC')
                    ->get();
        }
    }
}
