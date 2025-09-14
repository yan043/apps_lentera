<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\SupportModel;
use App\Models\EmployeeManagementModel;
use App\Models\WorkOrderManagementModel;
use App\Models\InventoryManagementModel;
use App\Models\OrganizationStructureModel;
use App\Models\ReportingConfigurationModel;

class AjaxController extends Controller
{
    public function get_order_status()
    {
        $data = ReportingConfigurationModel::get_order_status();

        return response()->json($data);
    }

    public function get_order_status_by_id($id)
    {
        $data = ReportingConfigurationModel::get_order_status_by_id($id);

        return response()->json($data);
    }

    public function get_order_status_by_step($next_step)
    {
        $data = OrderModel::get_order_status_by_step($next_step);

        return response()->json($data);
    }

    public function get_order_segments()
    {
        $data = ReportingConfigurationModel::get_order_segments();

        return response()->json($data);
    }

    public function get_order_segment_by_id($id)
    {
        $data = ReportingConfigurationModel::get_order_segment_by_id($id);

        return response()->json($data);
    }

    public function get_order_actions()
    {
        $data = ReportingConfigurationModel::get_order_actions();

        return response()->json($data);
    }

    public function get_order_action_by_segment_id($id)
    {
        $data = ReportingConfigurationModel::get_order_action_by_segment_id($id);

        return response()->json($data);
    }

    public function get_order_labels()
    {
        $data = ReportingConfigurationModel::get_order_labels();

        return response()->json($data);
    }

    public function get_regional()
    {
        $data = OrganizationStructureModel::get_data('tb_regional');

        return response()->json($data);
    }

    public function get_regional_by_id($id)
    {
        $data = OrganizationStructureModel::get_data('tb_regional', $id);

        return response()->json($data);
    }

    public function get_witel()
    {
        $data = OrganizationStructureModel::get_witel();

        return response()->json($data);
    }

    public function get_witel_by_id($id)
    {
        $data = OrganizationStructureModel::get_witel_by_id($id);

        return response()->json($data);
    }

    public function get_sub_unit()
    {
        $data = OrganizationStructureModel::get_sub_unit();

        return response()->json($data);
    }

    public function get_sub_unit_by_id($id)
    {
        $data = OrganizationStructureModel::get_sub_unit_by_id($id);

        return response()->json($data);
    }

    public function get_sub_group()
    {
        $data = OrganizationStructureModel::get_data('tb_sub_group');

        return response()->json($data);
    }

    public function get_sub_group_by_id($id)
    {
        $data = OrganizationStructureModel::get_data('tb_sub_group', $id);

        return response()->json($data);
    }

    public function get_mitra()
    {
        $data = OrganizationStructureModel::get_mitra();

        return response()->json($data);
    }

    public function get_mitra_by_id($id)
    {
        $data = OrganizationStructureModel::get_mitra_by_id($id);

        return response()->json($data);
    }

    public function get_service_area()
    {
        $data = OrganizationStructureModel::get_service_area();

        return response()->json($data);
    }

    public function get_service_area_by_id($id)
    {
        $data = OrganizationStructureModel::get_service_area_by_id($id);

        return response()->json($data);
    }

    public function get_work_zone()
    {
        $data = OrganizationStructureModel::get_work_zone();

        return response()->json($data);
    }

    public function get_work_zone_by_id($id)
    {
        $data = OrganizationStructureModel::get_work_zone_by_id($id);

        return response()->json($data);
    }

    public function get_team()
    {
        $data = OrganizationStructureModel::get_team();

        return response()->json($data);
    }

    public function get_team_by_id($id)
    {
        $data = OrganizationStructureModel::get_team_by_id($id);

        return response()->json($data);
    }

    public function get_employee_list()
    {
        $data = EmployeeManagementModel::employeeList();

        return response()->json($data);
    }

    public function get_employee_list_by_id($id)
    {
        $data = EmployeeManagementModel::employeeListById($id);

        return response()->json($data);
    }

    public function get_employee_roles_permissions()
    {
        $data = EmployeeManagementModel::rolesPermissions();

        return response()->json($data);
    }

    public function get_witel_by_regional($regional_id)
    {
        $data = EmployeeManagementModel::get_witel_by_regional($regional_id);

        return response()->json($data);
    }

    public function get_mitra_by_witel($witel_id)
    {
        $data = EmployeeManagementModel::get_mitra_by_witel($witel_id);

        return response()->json($data);
    }

    public function get_sub_unit_by_regional($regional_id)
    {
        $data = EmployeeManagementModel::get_sub_unit_by_regional($regional_id);

        return response()->json($data);
    }

    public function get_new_order_charts()
    {
        $type      = request()->input('type');
        $startdate = request()->input('startdate');
        $enddate   = request()->input('enddate');

        $data = WorkOrderManagementModel::get_new_order_charts($type, $startdate, $enddate);

        if ($type == 'bar')
        {
            $labels = [];
            $values = [];

            foreach ($data as $row)
            {
                $labels[] = $row['workzone'];
                $values[] = $row['jumlah'];
            }

            return response()->json([
                'labels'   => $labels,
                'datasets' => [
                    [
                        'label'           => 'Orders by Zone',
                        'data'            => $values,
                        'backgroundColor' => '#3b82f6',
                    ],
                ],
            ]);
        }
        elseif ($type == 'pie')
        {
            $sla = [
                '0-2'   => 0,
                '2-3'   => 0,
                '3-12'  => 0,
                '12-24' => 0,
                '24+'   => 0,
            ];

            $sla['0-2']   += $data['ttr0to2'];
            $sla['2-3']   += $data['ttr2to3'];
            $sla['3-12']  += $data['ttr3to12'];
            $sla['12-24'] += $data['ttr12to24'];
            $sla['24+']   += $data['ttr24'];

            return response()->json([
                'labels'   => array_keys($sla),
                'datasets' => [
                    [
                        'data'            => array_values($sla),
                        'backgroundColor' => ['#2563eb', '#3b82f6', '#60a5fa', '#93c5fd', '#bfdbfe'],
                    ],
                ],
            ]);
        }
    }

    public function get_new_order_details()
    {
        $sourcedata = request()->input('sourcedata');
        $workzone   = request()->input('workzone');
        $ttr        = request()->input('ttr');
        $startdate  = request()->input('startdate');
        $enddate    = request()->input('enddate');

        $data = WorkOrderManagementModel::new_order_details($sourcedata, $workzone, $ttr, $startdate, $enddate);

        return response()->json($data);
    }

    public function get_assigned_order_details()
    {
        $sourcedata = request()->input('sourcedata');
        $startdate  = request()->input('startdate');
        $enddate    = request()->input('enddate');

        $data = WorkOrderManagementModel::assigned_order_details($sourcedata, $startdate, $enddate);

        return response()->json($data);
    }

    public function get_search_order($id)
    {
        $data = SupportModel::get_search_order($id);

        return response()->json($data);
    }

    public function get_inventory_material()
    {
        $data = InventoryManagementModel::get_inventory_material();

        return response()->json($data);
    }

    public function get_inventory_nte($type)
    {
        $data = InventoryManagementModel::get_inventory_nte($type);

        return response()->json($data);
    }

    public function get_photo_list($sourcedata, $id = 0)
    {
        if (in_array($sourcedata, ['insera', 'manuals']))
        {
            $order_segment_id = $id;

            $photo_list = json_decode(OrderModel::get_photo_list($sourcedata, $order_segment_id)->photo_list);
        }
        elseif ($sourcedata == 'bima')
        {
            $order_status_id = $id;

            $photo_list = json_decode(OrderModel::get_photo_list($sourcedata, $order_status_id)->photo_list);
        }
        else
        {
            $photo_list = [
                'Lokasi_Rumah',
                'Kondisi_Dalam_ODP',
                'Hasil_Ukur_Power_IN',
                'Hasil_Ukur_Power_OUT',
            ];
        }

        if (! isset($photo_list))
        {
            $photo_list = [];
        }

        return response()->json($photo_list);
    }

    public function get_log_order($id)
    {
        $data = OrderModel::get_log_order($id);

        return response()->json($data);
    }

    public function get_log_assignment($id)
    {
        $data = OrderModel::get_log_assignment($id);

        return response()->json($data);
    }
}
