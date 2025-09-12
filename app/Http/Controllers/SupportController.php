<?php

namespace App\Http\Controllers;

use App\Models\SupportModel;

class SupportController extends Controller
{
    public function orderTracking()
    {
        return view('support.order-tracking');
    }

    public function helpdeskMonitoring()
    {
        $service_area_id = request()->input('service_area_id') ?? 'ALL';
        $sourcedata      = request()->input('sourcedata')      ?? 'ALL';
        $date            = request()->input('date')            ?? date('Y-m-d');

        $data = SupportModel::helpdesk_monitoring($service_area_id, $sourcedata, $date);

        $summary = ['READY' => 0, 'ON-PROGRESS' => 0, 'CUST-ISSUE' => 0, 'TECH-ISSUE' => 0, 'EXTERNAL-ISSUE' => 0, 'DONE' => 0];

        foreach ($data as $area)
        {
            foreach ($area as $team)
            {
                foreach ($team as $order)
                {
                    $status = $order->order_status_name ?? 'READY';

                    if ($status === null || $status === 'READY')
                    {
                        $summary['READY']++;
                    } elseif ($status === 'ON-PROGRESS')
                    {
                        $summary['ON-PROGRESS']++;
                    } elseif ($status === 'CUST-ISSUE')
                    {
                        $summary['CUST-ISSUE']++;
                    } elseif ($status === 'TECH-ISSUE')
                    {
                        $summary['TECH-ISSUE']++;
                    } elseif ($status === 'EXTERNAL-ISSUE')
                    {
                        $summary['EXTERNAL-ISSUE']++;
                    } elseif ($status === 'DONE')
                    {
                        $summary['DONE']++;
                    }
                }
            }
        }

        return view('support.helpdesk-monitoring', ['service_area_id' => $service_area_id, 'sourcedata' => $sourcedata, 'date' => $date, 'data' => $data, 'summary' => $summary]);
    }

    public function mapsRouting()
    {
        return view('support.maps-routing');
    }
}
