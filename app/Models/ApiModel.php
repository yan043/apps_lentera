<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ApiModel extends Model
{
    public static function monetKritis($type)
    {
        switch ($type)
        {
            case 'all':
                $link = 'http://10.62.165.58/monet/hasil-ukur-bpp';
                break;

            case 'hvc':
                $link = 'http://10.62.165.58/monet/hvc-kritis-bpp';
                break;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => $link,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "GET",
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response);

        return $result->data;
    }

    public static function comparin_search($id, $type)
    {
        // type <ORDER_ID/ND_INTERNET/ND_INET/NCLI>
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => "http://10.128.16.65/comparin/controller/api/tomman_search.php?token=5ebabd69df0c7e36dfe6dd14c7d068156af5146a4c3867ef056b564f22cfd925&id=$id&type=$type",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "GET",
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response);

        return $result->data;
    }

    public static function comparin_ibooster($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => 'http://benspec.dalapa.id/api/ibooster/ukur',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => array('nd' => $id, 'domain' => '@telkom.net'),
            CURLOPT_HTTPHEADER     => array(
                'Authorization: 1a3a774238934d08af294bbe01135cc02b3e4abd723f0a0621775f745c192f0792cd4ab0fe79f5a3'
            ),
        ));

        $response   = curl_exec($curl);
        $http_code  = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curl_error = curl_errno($curl);

        curl_close($curl);

        if ($curl_error || $http_code != 200)
        {
            $result = null;
        }
        else
        {
            $result = json_decode($response);
        }

        return $result;
    }

    public static function save_log_ibooster($nd_inet, $type, $data)
    {
        DB::table('log_ibooster')
            ->where([
                ['nd_inet', $nd_inet],
                ['data_type', $type]
            ])
            ->whereDate('created_date', date('Y-m-d'))
            ->delete();

        DB::table('log_ibooster')->insert([
            'nd_inet'           => $nd_inet,
            'nas_ip'            => @$data->nas_ip,
            'frame_ip'          => @$data->frame_ip,
            'clid'              => @$data->clid,
            'type'              => @$data->type,
            'shelf'             => @$data->shelf,
            'slot'              => @$data->slot,
            'port'              => @$data->port,
            'host_id'           => @$data->host_id,
            'hostname'          => @$data->hostname,
            'identifier'        => @$data->identifier,
            'description'       => @$data->description,
            'sto'               => substr(@$data->description, 10, 3),
            'onu'               => @$data->onu,
            'vendor_id'         => @$data->vendor_id,
            'fiber_length'      => @$data->fiber_length,
            'version_id'        => @$data->version_id,
            'desc_name'         => @$data->desc_name,
            'reg_type'          => @$data->reg_type,
            'oper_status'       => @$data->oper_status,
            'admin_status'      => @$data->admin_status,
            'bw_up'             => @$data->bw_up,
            'bw_down'           => @$data->bw_down,
            'onu_pwr_spl'       => @$data->onu_pwr_spl,
            'onu_bias_curr'     => @$data->onu_bias_curr,
            'onu_temp'          => @$data->onu_temp,
            'onu_rx_pwr'        => @$data->onu_rx_pwr,
            'onu_tx_pwr'        => @$data->onu_tx_pwr,
            'olt_tx_pwr'        => @$data->olt_tx_pwr,
            'olt_rx_pwr'        => @$data->olt_rx_pwr,
            'olt_temp'          => @$data->olt_temp,
            'olt_pwr_spl'       => @$data->olt_pwr_spl,
            'olt_bias_curr'     => @$data->olt_bias_curr,
            'serial_number'     => @$data->serial_number,
            'indikasi'          => @$data->indikasi,
            'gangguan'          => @$data->gangguan,
            'desc'              => @$data->desc,
            'suggestion'        => @$data->suggestion,
            'status_cpe'        => @$data->status_cpe,
            'tipejaringan'      => @$data->tipejaringan,
            'status_koneksi'    => @$data->status_koneksi,
            'status_jaringan'   => @$data->status_jaringan,
            'usage_download'    => @$data->usage_download,
            'usage_upload'      => @$data->usage_upload,
            'session_start'     => @$data->session_start,
            'mac'               => @$data->mac,
            'traffic_graph_id'  => @$data->traffic_graph_id,
            'connection_status' => @$data->connection_status,
            'ip_ams'            => @$data->ip_ams,
            'log'               => @$data->log,
            'data_type'         => $type,
            'created_date'      => date('Y-m-d'),
            'created_time'      => date('H:i:s')
        ]);
    }
}
