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

        $summary = ['READY' => 0, 'ON-PROGRESS' => 0, 'CUST-ISSUE' => 0, 'TECH-ISSUE' => 0, 'OTHER-ISSUE' => 0, 'DONE' => 0];

        foreach ($data as $area)
        {
            foreach ($area as $team)
            {
                foreach ($team as $order)
                {
                    $status_group = $order->order_status_group ?? 'READY';

                    if ($status_group === null || $status_group === 'READY')
                    {
                        $summary['READY']++;
                    }
                    elseif ($status_group === 'ON-PROGRESS')
                    {
                        $summary['ON-PROGRESS']++;
                    }
                    elseif ($status_group === 'CUST-ISSUE')
                    {
                        $summary['CUST-ISSUE']++;
                    }
                    elseif ($status_group === 'TECH-ISSUE')
                    {
                        $summary['TECH-ISSUE']++;
                    }
                    elseif ($status_group === 'OTHER-ISSUE')
                    {
                        $summary['OTHER-ISSUE']++;
                    }
                    elseif ($status_group === 'DONE')
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
