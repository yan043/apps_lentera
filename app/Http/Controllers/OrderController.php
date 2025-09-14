<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index($id)
    {
        $data                            = OrderModel::index($id);
        $get_inventory_by_order_material = OrderModel::get_inventory_by_order($id, 'material');
        $get_inventory_by_order_nte_ont  = OrderModel::get_inventory_by_order($id, 'nte', 'ont');
        $get_inventory_by_order_nte_stb  = OrderModel::get_inventory_by_order($id, 'nte', 'stb');

        return view('order.index', ['id' => $id, 'data' => $data, 'get_inventory_by_order_material' => $get_inventory_by_order_material, 'get_inventory_by_order_nte_ont' => $get_inventory_by_order_nte_ont, 'get_inventory_by_order_nte_stb' => $get_inventory_by_order_nte_stb]);
    }

    public function indexUpdate(Request $request)
    {
        $request->validate(
            [
                'id'                         => 'required',
                'order_status_id'            => 'required',
                'report_odp_name'            => 'nullable',
                'report_odp_coordinates'     => 'nullable',
                'report_valins_id'           => 'nullable',
                'report_refferal_order_code' => 'nullable',
                'nte_data'                   => 'nullable',
                'materials_data'             => 'nullable',
                'photos_data'                => 'nullable',
            ]
        );

        if (! in_array($request->input('order_status_id'), [1, 2]))
        {
            $request->validate(
                [
                    'report_phone_number'         => 'required',
                    'report_coordinates_location' => 'required',
                    'report_notes'                => 'required',
                ]
            );
        }

        if (! empty($request->input('order_segment_id')))
        {
            $request->validate(
                [
                    'order_segment_id' => 'required',
                    'order_action_id'  => 'required',
                ]
            );
        }

        OrderModel::indexUpdate($request);

        return redirect()->back()->with('success', 'Successfully Updated Work Order!');
    }
}
