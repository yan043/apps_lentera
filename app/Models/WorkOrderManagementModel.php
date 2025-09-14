<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class WorkOrderManagementModel extends Model
{
    public static function updateOrInsertOrder($data)
    {
        DB::table('tb_assign_orders')->updateOrInsert(
            [
                'order_id' => $data['order_id'],
            ],
            [
                'sourcedata'    => $data['source_data'],
                'order_code'    => $data['order_code'],
                'team_id'       => $data['team_id'],
                'team_name'     => $data['team_name'],
                'assign_date'   => $data['assign_date'],
                'assign_labels' => json_encode($data['assign_labels']),
                'assign_notes'  => $data['assign_notes'],
                'created_by'    => Session::get('nik'),
                'created_at'    => now(),
                'updated_by'    => Session::get('nik'),
                'updated_at'    => now(),
            ]
        );

        DB::table('tb_assign_orders_log')->insert(
            [
                'sourcedata'    => $data['source_data'],
                'order_code'    => $data['order_code'],
                'order_id'      => $data['order_id'],
                'team_id'       => $data['team_id'],
                'team_name'     => $data['team_name'],
                'assign_date'   => $data['assign_date'],
                'assign_labels' => json_encode($data['assign_labels']),
                'assign_notes'  => $data['assign_notes'],
                'created_by'    => Session::get('nik'),
                'created_at'    => now()
            ]
        );
    }

    public static function get_new_order_charts($type, $startdate, $enddate)
    {
        $witel = strtoupper(Session::get('witel_alias'));

        $insera = DB::table('tb_source_insera AS tsi')
            ->leftJoin('tb_assign_orders AS tao', 'tsi.incident_id', '=', 'tao.order_id')
            ->select(DB::raw('
                tsi.workzone,
                SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tsi.reported_date, NOW()) >= 0
                        AND TIMESTAMPDIFF(HOUR, tsi.reported_date, NOW()) < 2
                        AND tsi.ticket_id_gamas = "" THEN 1 ELSE 0 END) AS ttr0to2,
                SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tsi.reported_date, NOW()) >= 2
                        AND TIMESTAMPDIFF(HOUR, tsi.reported_date, NOW()) < 3
                        AND tsi.ticket_id_gamas = "" THEN 1 ELSE 0 END) AS ttr2to3,
                SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tsi.reported_date, NOW()) >= 3
                        AND TIMESTAMPDIFF(HOUR, tsi.reported_date, NOW()) < 12
                        AND tsi.ticket_id_gamas = "" THEN 1 ELSE 0 END) AS ttr3to12,
                SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tsi.reported_date, NOW()) >= 12
                        AND TIMESTAMPDIFF(HOUR, tsi.reported_date, NOW()) < 24
                        AND tsi.ticket_id_gamas = "" THEN 1 ELSE 0 END) AS ttr12to24,
                SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tsi.reported_date, NOW()) >= 24
                        AND tsi.ticket_id_gamas = "" THEN 1 ELSE 0 END) AS ttr24,
                SUM(CASE WHEN tsi.ticket_id_gamas != "" THEN 1 ELSE 0 END) AS gamas,
                COUNT(*) AS jumlah
            '))
            ->whereNull('tao.order_code')
            ->whereBetween('tsi.date_reported', [$startdate, $enddate])
            ->where([
                ['tsi.witel', $witel],
                ['tsi.service_type', '!=', 'NON-NUMBERING'],
            ])
            ->whereIn('tsi.status', ['NEW', 'DRAFT', 'ANALYSIS', 'PENDING', 'BACKEND'])
            ->groupBy('tsi.workzone');

        $manual = DB::table('tb_source_manuals AS tsm')
            ->leftJoin('tb_assign_orders AS tao', 'tsm.incident_id', '=', 'tao.order_id')
            ->select(DB::raw('
                tsm.workzone,
                SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tsm.reported_date, NOW()) >= 0
                        AND TIMESTAMPDIFF(HOUR, tsm.reported_date, NOW()) < 2 THEN 1 ELSE 0 END) AS ttr0to2,
                SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tsm.reported_date, NOW()) >= 2
                        AND TIMESTAMPDIFF(HOUR, tsm.reported_date, NOW()) < 3 THEN 1 ELSE 0 END) AS ttr2to3,
                SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tsm.reported_date, NOW()) >= 3
                        AND TIMESTAMPDIFF(HOUR, tsm.reported_date, NOW()) < 12 THEN 1 ELSE 0 END) AS ttr3to12,
                SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tsm.reported_date, NOW()) >= 12
                        AND TIMESTAMPDIFF(HOUR, tsm.reported_date, NOW()) < 24 THEN 1 ELSE 0 END) AS ttr12to24,
                SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tsm.reported_date, NOW()) >= 24 THEN 1 ELSE 0 END) AS ttr24,
                0 AS gamas,
                COUNT(*) AS jumlah
            '))
            ->whereNull('tao.order_code')
            ->whereBetween('tsm.date_reported', [$startdate, $enddate])
            ->where('tsm.witel', $witel)
            ->groupBy('tsm.workzone');

        $bima = DB::table('tb_source_bima AS tsb')
            ->leftJoin('tb_assign_orders AS tao', 'tsb.c_wonum_id', '=', 'tao.order_id')
            ->select(DB::raw('
                tsb.c_workzone AS workzone,
                SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tsb.c_datemodified, NOW()) >= 0
                        AND TIMESTAMPDIFF(HOUR, tsb.c_datemodified, NOW()) < 2 THEN 1 ELSE 0 END) AS ttr0to2,
                SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tsb.c_datemodified, NOW()) >= 2
                        AND TIMESTAMPDIFF(HOUR, tsb.c_datemodified, NOW()) < 3 THEN 1 ELSE 0 END) AS ttr2to3,
                SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tsb.c_datemodified, NOW()) >= 3
                        AND TIMESTAMPDIFF(HOUR, tsb.c_datemodified, NOW()) < 12 THEN 1 ELSE 0 END) AS ttr3to12,
                SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tsb.c_datemodified, NOW()) >= 12
                        AND TIMESTAMPDIFF(HOUR, tsb.c_datemodified, NOW()) < 24 THEN 1 ELSE 0 END) AS ttr12to24,
                SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tsb.c_datemodified, NOW()) >= 24 THEN 1 ELSE 0 END) AS ttr24,
                0 AS gamas,
                COUNT(*) AS jumlah
            '))
            ->whereNull('tao.order_code')
            ->whereBetween('tsb.c_datemodified', [$startdate, $enddate])
            ->where('tsb.c_tk_subregion', $witel)
            ->groupBy('tsb.c_workzone');

        $data = $insera->unionAll($manual)->unionAll($bima);

        $final = DB::table(DB::raw("({$data->toSql()}) as src"))
            ->mergeBindings($data)
            ->select(DB::raw('
                src.workzone,
                SUM(src.ttr0to2) as ttr0to2,
                SUM(src.ttr2to3) as ttr2to3,
                SUM(src.ttr3to12) as ttr3to12,
                SUM(src.ttr12to24) as ttr12to24,
                SUM(src.ttr24) as ttr24,
                SUM(src.gamas) as gamas,
                SUM(src.jumlah) as jumlah
            '))
            ->groupBy('src.workzone')
            ->orderBy('jumlah', 'DESC')
            ->get();

        switch ($type)
        {
            case 'bar':
                return $final->map(function ($row)
                {
                    return [
                        'workzone' => $row->workzone,
                        'jumlah'   => (int) $row->jumlah,
                    ];
                });
            case 'pie':
                $sla = [
                    'ttr0to2'   => $final->sum('ttr0to2'),
                    'ttr2to3'   => $final->sum('ttr2to3'),
                    'ttr3to12'  => $final->sum('ttr3to12'),
                    'ttr12to24' => $final->sum('ttr12to24'),
                    'ttr24'     => $final->sum('ttr24'),
                ];

                return $sla;
            default:
                return $final;
        }
    }

    public static function new_order_details($sourcedata, $workzone, $ttr, $startdate, $enddate)
    {
        $witel = strtoupper(Session::get('witel_alias'));

        $inseraQuery = DB::table('tb_source_insera AS tsi')
            ->leftJoin('tb_assign_orders AS tao', 'tsi.incident_id', '=', 'tao.order_id')
            ->select(
                DB::raw('"insera" as source_data'),
                'tsi.incident AS order_code',
                'tsi.incident_id AS order_id',
                'tsi.service_no',
                'tsi.customer_name',
                'tsi.contact_phone',
                'tsi.summary AS notes',
                'tsi.odp_name',
                'tsi.reported_date AS order_date',
                'tsi.workzone',
                'tsi.witel'
            )
            ->whereNull('tao.order_code')
            ->whereBetween('tsi.reported_date', [$startdate, $enddate])
            ->where('tsi.witel', $witel)
            ->when(! empty($workzone), function ($query) use ($workzone)
            {
                return $query->where('tsi.workzone', $workzone);
            })
            ->where('tsi.service_type', '!=', 'NON-NUMBERING')
            ->whereIn('tsi.status', ['NEW', 'DRAFT', 'ANALYSIS', 'PENDING', 'BACKEND'])
            ->when($ttr == 'ttr0to2', function ($query)
            {
                return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) >= 0')
                    ->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) < 2');
            })
            ->when($ttr == 'ttr2to3', function ($query)
            {
                return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) >= 2')
                    ->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) < 3');
            })
            ->when($ttr == 'ttr3to12', function ($query)
            {
                return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) >= 3')
                    ->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) < 12');
            })
            ->when($ttr == 'ttr12to24', function ($query)
            {
                return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) >= 12')
                    ->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) < 24');
            })
            ->when($ttr == 'ttr24', function ($query)
            {
                return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsi.reported_date, NOW() ) >= 24');
            });

        $manualQuery = DB::table('tb_source_manuals AS tsm')
            ->leftJoin('tb_assign_orders AS tao', 'tsm.incident_id', '=', 'tao.order_id')
            ->select(
                DB::raw('"manuals" as source_data'),
                'tsm.incident AS order_code',
                'tsm.incident_id AS order_id',
                'tsm.service_no',
                'tsm.customer_name',
                'tsm.contact_phone',
                'tsm.summary AS notes',
                'tsm.odp_name',
                'tsm.reported_date AS order_date',
                'tsm.workzone',
                'tsm.witel'
            )
            ->whereNull('tao.order_code')
            ->whereBetween('tsm.reported_date', [$startdate, $enddate])
            ->where('tsm.witel', $witel)
            ->when(! empty($workzone), function ($query) use ($workzone)
            {
                return $query->where('tsm.workzone', $workzone);
            })
            ->when($ttr == 'ttr0to2', function ($query)
            {
                return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) >= 0')
                    ->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) < 2');
            })
            ->when($ttr == 'ttr2to3', function ($query)
            {
                return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) >= 2')
                    ->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) < 3');
            })
            ->when($ttr == 'ttr3to12', function ($query)
            {
                return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) >= 3')
                    ->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) < 12');
            })
            ->when($ttr == 'ttr12to24', function ($query)
            {
                return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) >= 12')
                    ->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) < 24');
            })
            ->when($ttr == 'ttr24', function ($query)
            {
                return $query->whereRaw('TIMESTAMPDIFF( HOUR , tsm.reported_date, NOW() ) >= 24');
            });

        $bimaQuery = DB::table('tb_source_bima AS tbm')
            ->leftJoin('tb_assign_orders AS tao', 'tbm.c_wonum_id', '=', 'tao.order_id')
            ->select(
                DB::raw('"bima" as source_data'),
                'tbm.c_wonum AS order_code',
                'tbm.c_wonum_id AS order_id',
                'tbm.c_servicenum AS service_no',
                'tbm.c_customer_name AS customer_name',
                'tbm.c_contact_telephone_number AS contact_phone',
                'tbm.c_serviceaddress AS notes',
                DB::raw('NULL as odp_name'),
                'tbm.c_datemodified AS order_date',
                'tbm.c_workzone AS workzone',
                'tbm.c_tk_subregion AS witel'
            )
            ->whereNull('tao.order_code')
            ->whereBetween('tbm.c_datemodified', [$startdate, $enddate])
            ->where('tbm.c_tk_subregion', $witel)
            ->when(! empty($workzone), function ($query) use ($workzone)
            {
                return $query->where('tbm.c_workzone', $workzone);
            })
            ->when($ttr == 'ttr0to2', function ($query)
            {
                return $query->whereRaw('TIMESTAMPDIFF( HOUR , tbm.c_datemodified, NOW() ) >= 0')
                    ->whereRaw('TIMESTAMPDIFF( HOUR , tbm.c_datemodified, NOW() ) < 2');
            })
            ->when($ttr == 'ttr2to3', function ($query)
            {
                return $query->whereRaw('TIMESTAMPDIFF( HOUR , tbm.c_datemodified, NOW() ) >= 2')
                    ->whereRaw('TIMESTAMPDIFF( HOUR , tbm.c_datemodified, NOW() ) < 3');
            })
            ->when($ttr == 'ttr3to12', function ($query)
            {
                return $query->whereRaw('TIMESTAMPDIFF( HOUR , tbm.c_datemodified, NOW() ) >= 3')
                    ->whereRaw('TIMESTAMPDIFF( HOUR , tbm.c_datemodified, NOW() ) < 12');
            })
            ->when($ttr == 'ttr12to24', function ($query)
            {
                return $query->whereRaw('TIMESTAMPDIFF( HOUR , tbm.c_datemodified, NOW() ) >= 12')
                    ->whereRaw('TIMESTAMPDIFF( HOUR , tbm.c_datemodified, NOW() ) < 24');
            })
            ->when($ttr == 'ttr24', function ($query)
            {
                return $query->whereRaw('TIMESTAMPDIFF( HOUR , tbm.c_datemodified, NOW() ) >= 24');
            });

        if ($sourcedata == 'insera')
        {
            return $inseraQuery->orderBy('tsi.reported_date', 'DESC')->get();
        }
        elseif ($sourcedata == 'manual')
        {
            return $manualQuery->orderBy('tsm.reported_date', 'DESC')->get();
        }
        elseif ($sourcedata == 'bima')
        {
            return $bimaQuery->orderBy('tbm.c_datemodified', 'DESC')->get();
        }
        else
        {
            $inseraSql = $inseraQuery->orderBy('tsi.reported_date', 'DESC');
            $manualSql = $manualQuery->orderBy('tsm.reported_date', 'DESC');
            $bimaSql   = $bimaQuery->orderBy('tbm.c_datemodified', 'DESC');

            return $inseraSql->unionAll($manualSql)->unionAll($bimaSql)->get();
        }
    }

    public static function assigned_order_details($sourcedata, $startdate, $enddate)
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
                'tst.status_description AS order_status_description',

                'tar.order_segment_id',
                'tos.name AS order_segment_name',

                'tar.order_action_id',
                'toa.name AS order_action_name'
            )
            ->whereNotNull('tao.order_code')
            ->whereBetween('tao.assign_date', [$startdate, $enddate])
            ->where('tsi.witel', $witel);

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
                'tst.status_description AS order_status_description',

                'tar.order_segment_id',
                'tos.name AS order_segment_name',

                'tar.order_action_id',
                'toa.name AS order_action_name'
            )
            ->whereNotNull('tao.order_code')
            ->whereBetween('tao.assign_date', [$startdate, $enddate])
            ->where('tsm.witel', $witel);

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
                'tst.status_description AS order_status_description',

                'tar.order_segment_id',
                'tos.name AS order_segment_name',

                'tar.order_action_id',
                'toa.name AS order_action_name'
            )
            ->whereNotNull('tao.order_code')
            ->whereBetween('tao.assign_date', [$startdate, $enddate])
            ->where('tbm.c_tk_subregion', $witel);

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
}
