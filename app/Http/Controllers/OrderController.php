<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    public function index($id)
    {
        $data                            = OrderModel::index($id);
        $get_inventory_by_order_material = OrderModel::get_inventory_by_order($id, 'material');
        $get_inventory_by_order_nte_ont  = OrderModel::get_inventory_by_order($id, 'nte', 'ont');
        $get_inventory_by_order_nte_stb  = OrderModel::get_inventory_by_order($id, 'nte', 'stb');

        $photos    = [];
        $uploadDir = public_path('upload_order_reports/'.$id);
        if (File::exists($uploadDir))
        {
            $files = File::files($uploadDir);
            foreach ($files as $file)
            {
                $fileName       = $file->getFilename();
                $nameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
                $parts          = explode('_', $nameWithoutExt);
                if (count($parts) >= 2)
                {
                    $fileId = end($parts);
                    $type   = implode('_', array_slice($parts, 0, -1));
                    if ($fileId == $id)
                    {
                        if (! isset($photos[$type]))
                        {
                            $photos[$type] = [];
                        }
                        $photos[$type][] = '/upload_order_reports/'.$id.'/'.$fileName;
                    }
                }
            }
        }

        return view('order.index', ['id' => $id, 'data' => $data, 'get_inventory_by_order_material' => $get_inventory_by_order_material, 'get_inventory_by_order_nte_ont' => $get_inventory_by_order_nte_ont, 'get_inventory_by_order_nte_stb' => $get_inventory_by_order_nte_stb, 'photos' => $photos]);
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

        if (! empty($request['photos_data']))
        {
            $photos    = json_decode($request['photos_data'], true);
            $uploadDir = public_path('upload_order_reports/'.$request['id']);
            if (! File::exists($uploadDir))
            {
                File::makeDirectory($uploadDir, 0755, true);
            }
            foreach ($photos as $type => $images)
            {
                $base64Images = array_filter($images, function ($img)
                {
                    return strpos($img, 'data:image') === 0;
                });
                if (! empty($base64Images))
                {
                    $imageData   = end($base64Images);
                    $imageData   = str_replace('data:image/jpeg;base64,', '', $imageData);
                    $imageData   = str_replace('data:image/png;base64,', '', $imageData);
                    $imageData   = str_replace('data:image/jpg;base64,', '', $imageData);
                    $imageData   = str_replace(' ', '+', $imageData);
                    $imageBinary = base64_decode($imageData);

                    $fileName = $type.'_'.$request['id'].'.jpg';

                    $filePath = $uploadDir.'/'.$fileName;
                    file_put_contents($filePath, $imageBinary);
                }
            }
        }

        if (! empty($request['photos_data']))
        {
            $photos       = json_decode($request['photos_data'], true);
            $currentTypes = array_keys(array_filter($photos, function ($imgs)
            {
                return ! empty($imgs);
            }));
            $uploadDir = public_path('upload_order_reports/'.$request['id']);
            if (File::exists($uploadDir))
            {
                $files = File::files($uploadDir);
                foreach ($files as $file)
                {
                    $fileName       = $file->getFilename();
                    $nameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
                    $parts          = explode('_', $nameWithoutExt);
                    if (count($parts) >= 2)
                    {
                        $fileId = end($parts);
                        $type   = implode('_', array_slice($parts, 0, -1));
                        if ($fileId == $request['id'] && ! in_array($type, $currentTypes))
                        {
                            File::delete($file->getPathname());
                        }
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Successfully Updated Work Order!');
    }
}
