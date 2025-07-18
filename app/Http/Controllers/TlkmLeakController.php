<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Telegram;

class TlkmLeakController extends Controller
{
    public static function bima_get_workorder_list_date($witel)
    {
        $total            = 0;
        $page             = 1;
        $page_size        = 10000;

        $datecreated_from = date('Y-m-d', strtotime('-6 days'));
        $datecreated_to   = date('Y-m-d', strtotime('+1 days'));

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://wfm.telkom.co.id/jw/web/json/plugin/org.telkom.co.id.GetWorkorderList/service',
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "filters": {
                    "C_STATUS": "STARTWORK,WORKFAIL",
                    "C_OWNERGROUP": "",
                    "C_WONUM": "",
                    "C_SCORDERNO": "",
                    "C_JMSCORRELATIONID": "",
                    "C_SERVICENUM": "",
                    "C_WORKZONE": "",
                    "C_DESCRIPTION": "",
                    "C_TK_WORKORDER_04": "",
                    "C_CUSTOMER_NAME": "",
                    "C_CONTACT_TELEPHONE_NUMBER": "",
                    "C_WOCLASS": "",
                    "C_CRMORDERTYPE": "CREATE,MIGRATE,MODIFY",
                    "C_SERVICEADDRESS": "",
                    "C_SCHEDSTART": "",
                    "C_PRODUCTNAME": "",
                    "C_TK_SUBREGION": "' . $witel . '",
                    "C_PRODUCTTYPE": "",
                    "C_SITEID": "",
                    "C_MEASUREMENT": "",
                    "C_MEASUREMENTRESULT": "",
                    "DATECREATED_FROM": "' . $datecreated_from . '",
                    "DATECREATED_TO": "' . $datecreated_to . '"
                },
                "page": ' . $page . ',
                "pageSize": ' . $page_size . ',
                "SORT": "DESC",
                "ORDER_BY": "datecreated"
            }',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);

        $insert = [];

        foreach ($result['workorders'] as $value)
        {
            if (!in_array($value['c_description'], ['Pasang ONT', 'Remove STB', 'Cabut ONT']))
            {
                $insert[] = [
                    'parent_id'                  => $value['id'],
                    'c_datecreated'              => empty($value['datecreated']) ? null : date('Y-m-d H:i:s', strtotime($value['datecreated'])),
                    'c_datemodified'             => empty($value['datemodified']) ? null : date('Y-m-d H:i:s', strtotime($value['datemodified'])),
                    'c_wonum'                    => $value['c_wonum'],
                    'c_wonum_id'                 => preg_replace('/\D/', '', $value['c_wonum']),
                    'c_scorderno'                => $value['c_scorderno'],
                    'c_jmscorrelationid'         => $value['c_jmscorrelationid'],
                    'c_servicenum'               => $value['c_servicenum'] ? : 0,
                    'c_description'              => $value['c_description'],
                    'c_crmordertype'             => $value['c_crmordertype'],
                    'c_ownergroup'               => $value['c_ownergroup'],
                    'c_status'                   => $value['c_status'],
                    'c_productname'              => $value['c_productname'],
                    'c_serviceaddress'           => $value['c_serviceaddress'],
                    'c_tk_subregion'             => $value['c_tk_subregion'],
                    'c_customer_name'            => $value['c_customer_name'],
                    'c_workzone'                 => $value['c_workzone'],
                    'c_siteid'                   => $value['c_siteid'],
                    'c_statusdate'               => empty($value['c_statusdate']) ? null : date('Y-m-d H:i:s', strtotime($value['c_statusdate'])),
                    'c_schedstart'               => empty($value['c_schedstart']) ? null : date('Y-m-d H:i:s', strtotime($value['c_schedstart'])),
                    'c_contact_telephone_number' => $value['c_contact_telephone_number'] ? preg_replace('/[^0-9]/', '', $value['c_contact_telephone_number']) : 0,
                    'c_measurement'              => $value['c_measurement'],
                    'c_measurementdate'          => empty($value['c_measurementdate']) ? null : date('Y-m-d H:i:s', strtotime($value['c_measurementdate'])),
                    'c_measurementresult'        => $value['c_measurementresult'],
                    'c_woclass'                  => $value['c_woclass'],
                    'c_chief_code'               => $value['c_chief_code'],
                    'c_producttype'              => $value['c_producttype'],
                    'c_bookingdate'              => empty($value['c_bookingdate']) ? null : date('Y-m-d H:i:s', strtotime($value['c_bookingdate'])),
                    'c_tk_workorder_04'          => $value['c_tk_workorder_04']
                ];
            }
        }

        $total = count($insert);

        if ($total == 0)
        {
            print_r("no data\n");
            return;
        }
        else
        {
            DB::table('tb_source_bima')->whereBetween('c_datecreated', [date('Y-m-d 00:00:00', strtotime($datecreated_from)), date('Y-m-d 23:59:59', strtotime($datecreated_to))])->delete();
        }

        foreach (array_chunk($insert, 500) as $numb => $data)
        {
            DB::table('tb_source_bima')->insert($data);

            print_r("saved page $numb and sleep (1)\n");

            sleep(1);
        }

        print_r("workorder_list witel $witel datecreated $datecreated_from - $datecreated_to total $total\n");
    }

    public static function insera_login($is_username, $is_password)
    {
        $username = urlencode($is_username);
        $password = urlencode($is_password);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://insera.telkom.co.id',
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => false,
            CURLOPT_HEADER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        curl_exec($curl);
        $header = curl_getinfo($curl);
        $redirect_url = $header['redirect_url'];

        curl_setopt_array($curl, [
            CURLOPT_URL => $redirect_url,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);
        $header = curl_getinfo($curl);
        $redirect_url = $header['redirect_url'];
        $header_content = substr($response, 0, $header['header_size']);
        trim(str_replace($header_content, '', $response));
        $pattern = "#set-cookie:\\s+(?<cookie>[^=]+=[^;]+)#m";
        preg_match_all($pattern, $header_content, $matches);
        $cookies1 = "";
        $header['headers'] = $header_content;
        $header['cookies'] = $cookies1;
        $cookies1 = implode("; ", $matches['cookie']);

        print_r("\nCookies 1 :\n$cookies1\n\n");

        curl_setopt_array($curl, [
            CURLOPT_URL => $redirect_url,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);
        $header = curl_getinfo($curl);
        $header_content = substr($response, 0, $header['header_size']);
        trim(str_replace($header_content, '', $response));
        $pattern = "#Set-Cookie:\\s+(?<cookie>[^=]+=[^;]+)#m";
        preg_match_all($pattern, $header_content, $matches);
        $cookies2 = "";
        $header['headers'] = $header_content;
        $header['cookies'] = $cookies2;
        $cookies2 = implode("; ", $matches['cookie']);

        print_r("\nCookies 2 :\n$cookies2\n\n");

        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML(trim($response));
        $url_post_unamepass = $dom->getElementsByTagName('form')->item(0)->getAttribute("action");

        print_r("$url_post_unamepass\n\n");

        curl_setopt_array($curl, [
            CURLOPT_URL => $url_post_unamepass,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'username=' . $username . '&password=' . $password . '&credentialId=',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: ' . $cookies2,
            ],
        ]);

        $response = curl_exec($curl);
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML(trim($response));
        $url_post_otp = $dom->getElementsByTagName('form')->item(0)->getAttribute("action");

        print_r("$url_post_otp\n\n");

        $otp = 0;
        print_r("\nEnter GoogleAuth Code :\n");
        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);

        if (trim($line) == 'cancel')
        {
            print_r("ABORTING!\n");
            exit;
        }

        $otp = trim($line);
        fclose($handle);
        print_r("\nOTP Received : $otp\n\n");

        curl_setopt_array($curl, [
            CURLOPT_URL => $url_post_otp,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'otp=' . $otp . '&login=Sign+In',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: ' . $cookies2,
            ],
        ]);

        $response = curl_exec($curl);
        $header = curl_getinfo($curl);
        $redirect_url = $header['redirect_url'];
        $header_content = substr($response, 0, $header['header_size']);
        trim(str_replace($header_content, '', $response));
        $pattern = "#Set-Cookie:\\s+(?<cookie>[^=]+=[^;]+)#m";
        preg_match_all($pattern, $header_content, $matches);
        $cookies3 = "";
        $header['headers'] = $header_content;
        $header['cookies'] = $cookies3;
        $cookies3 = implode("; ", $matches['cookie']);

        print_r("\nCookies 3 :\n$cookies3\n\n");

        curl_setopt_array($curl, [
            CURLOPT_URL => $redirect_url,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Cookie: ' . $cookies1,
            ],
        ]);

        $response = curl_exec($curl);
        $header = curl_getinfo($curl);
        $redirect_url = $header['redirect_url'];
        $header_content = substr($response, 0, $header['header_size']);
        trim(str_replace($header_content, '', $response));
        $pattern = "#set-cookie:\\s+(?<cookie>[^=]+=[^;]+)#m";
        preg_match_all($pattern, $header_content, $matches);
        $cookies4 = "";
        $header['headers'] = $header_content;
        $header['cookies'] = $cookies4;
        $cookies4 = implode("; ", $matches['cookie']);

        print_r("\nCookies 4 :\n$cookies4\n\n");

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://oss-incident.telkom.co.id/jw/web/userview/ticketIncidentService/ticketIncidentService/_/welcome',
        //     CURLOPT_SSL_VERIFYHOST => false,
        //     CURLOPT_SSL_VERIFYPEER => false,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_HEADER => false,
        //     CURLOPT_CUSTOMREQUEST => 'GET',
        //     CURLOPT_HTTPHEADER => array(
        //         'Cookie: '.$cookies1
        //     ),
        // ));

        // $response = curl_exec($curl);
        // curl_close($curl);

        // dd($response);
    }

    public static function insera_refresh()
    {
        $insera = DB::table('tb_auth_storage')->where('apps', 'insera')->first();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://oss-incident.telkom.co.id/jw/web/userview/ticketIncidentService/ticketIncidentService/_/welcome',
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: '.$insera->cookies
              ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        dd($response);
    }

    public static function insera_all_ticket_list()
    {
        $witels = ['KALSEL', 'BALIKPAPAN', 'KALBAR', 'KALTENG', 'KALTARA', 'SAMARINDA'];

        foreach ($witels as $witel)
        {
            self::insera_ticket_list($witel);
        }
    }

    public static function insera_ticket_list($witel)
    {
        $total_all = $total_close = 0;

        for ($i = 0; $i <= 2; $i++)
        {
            $date = date('Y-m-d', strtotime("-$i days"));

            // $total_all = self::insera_ticket_list_date('show', $witel, $date);

            // $total_close = self::insera_ticket_list_repo_date('show', $witel, $date);

            // if ($total_all > 0 || $total_close > 0)
            // {
                DB::table('tb_source_insera')
                    ->where([
                        ['incident', 'LIKE', 'INC%'],
                        ['witel', $witel]
                    ])
                    ->whereDate('date_reported', $date)
                    ->delete();

                self::insera_ticket_list_date('save', $witel, $date);

                self::insera_ticket_list_repo_date('save', $witel, $date);

                sleep(10);
            // }
        }
    }

    public static function insera_ticket_list_date($type, $witel, $date)
    {
        $start_datetime = date('Y-m-d 00:00:00', strtotime($date));
        $end_datetime   = date('Y-m-d 23:59:59', strtotime($date));

        $total          = 0;
        $page           = 1;
        $page_show      = 10000;

        $insera         = DB::table('tb_auth_storage')->where('apps', 'insera')->first();

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://oss-incident.telkom.co.id/jw/web/userview/ticketIncidentService/ticketIncidentService/_/welcome',
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: '.$insera->cookies
            ),
        ));

        $response = curl_exec($curl);

        $pattern = '/JPopup\.tokenValue\s*=\s*["\']([^"\']+)["\']/';

        if (preg_match($pattern, $response, $matches))
        {
            $tokenValue = $matches[1];
        }
        else
        {
            $tokenValue = null;
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://oss-incident.telkom.co.id/jw/web/userview/ticketIncidentService/ticketIncidentService/_/allTicketList?d-5564009-p='.$page.'&d-5564009-ps='.$page_show.'&d-5564009-fn_reported_date_filter='.urlencode($start_datetime).'&d-5564009-fn_reported_date_filter='.urlencode($end_datetime).'&d-5564009-fn_status_date_filter=&d-5564009-fn_status_date_filter=&d-5564009-fn_C_OWNER_GROUP=&d-5564009-fn_C_OWNER=&d-5564009-fn_C_REPORTED_PRIORITY=&d-5564009-fn_C_SOURCE_TICKET=GAMAS,PROACTIVE,CUSTOMER&d-5564009-fn_C_EXTERNAL_TICKETID=&d-5564009-fn_C_CHANNEL=&d-5564009-fn_C_CUSTOMER_SEGMENT=DCS,PL-TSEL,DGS,DWS,DES,DBS,DSS,DPS,REG&d-5564009-fn_C_CUSTOMER_TYPE=&d-5564009-fn_C_SERVICE_NO=&d-5564009-fn_C_SERVICE_TYPE=&d-5564009-fn_C_SERVICE_ID=&d-5564009-fn_C_SLG=&d-5564009-fn_C_KODE_PRODUK=&d-5564009-fn_DATEMODIFIED=&d-5564009-fn_C_CLOSED_BY=&d-5564009-fn_C_WORK_ZONE=&d-5564009-fn_C_WITEL='.$witel.'&d-5564009-fn_C_REGION=&d-5564009-fn_C_ID_TICKET=&d-5564009-fn_C_ACTUAL_SOLUTION=&d-5564009-fn_C_CLASSIFICATION_PATH=&d-5564009-fn_C_INCIDENT_DOMAIN=&d-5564009-fn_C_PERANGKAT=&d-5564009-fn_C_DESCRIPTION_ASSIGMENT=&d-5564009-fn_C_CLASSIFICATION_CATEGORY=&d-5564009-fn_C_REALM=&d-5564009-fn_C_PIPE_NAME=&d-5564009-fn_C_CUSTOMER_ID=&d-5564009-fn_C_RELATED_TO_GAMAS=&d-5564009-fn_C_TICKET_ID_GAMAS=&d-5564009-fn_C_GUARANTE_STATUS=&d-5564009-fn_C_DESCRIPTION_CUSTOMERID=&OWASP_CSRFTOKEN='.$tokenValue,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: '.$insera->cookies
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if ($response != null)
        {
            if (preg_match('/Nothing found to display./', $response))
            {
                print_r("nothing found to display (insera_ticket_list_date, $type, $witel, $date)\n");
            }
            else
            {
                libxml_use_internal_errors(true);
                $dom = new \DOMDocument();
                $dom->loadHTML(trim($response));

                $table = $dom->getElementsByTagName('table')->item(0);

                if ($table !== null)
                {
                    $rows = $table->getElementsByTagName('tr');

                    $columns = [ 1 =>
                        'parent_id',
                        'incident',
                        'ttr_customer',
                        'summary',
                        'reported_date',
                        'owner_group',
                        'owner',
                        'customer_segment',
                        'service_type',
                        'witel',
                        'workzone',
                        'status',
                        'status_date',
                        'ticket_id_gamas',
                        'reported_by',
                        'contact_phone',
                        'contact_name',
                        'contact_email',
                        'booking_date',
                        'description_assigment',
                        'reported_priority',
                        'source_ticket',
                        'subsidiary',
                        'external_ticket_id',
                        'channel',
                        'customer_type',
                        'closed_by',
                        'closed_reopen_by',
                        'customer_id',
                        'customer_name',
                        'service_id',
                        'service_no',
                        'slg',
                        'technology',
                        'lapul',
                        'gaul',
                        'onu_rx',
                        'pending_reason',
                        'datemodified',
                        'incident_domain',
                        'region',
                        'symptom',
                        'hierarchy_path',
                        'solution',
                        'description_actual_solution',
                        'kode_produk',
                        'perangkat',
                        'technician',
                        'device_name',
                        'worklog_summary',
                        'last_update_worklog',
                        'classification_flag',
                        'realm',
                        'related_to_gamas',
                        'tsc_result',
                        'scc_result',
                        'ttr_agent',
                        'ttr_mitra',
                        'ttr_nasional',
                        'ttr_pending',
                        'ttr_region',
                        'ttr_witel',
                        'ttr_end_to_end',
                        'note',
                        'guarante_status',
                        'resolve_date',
                        'sn_ont',
                        'tipe_ont',
                        'manufacture_ont',
                        'impacted_site',
                        'cause',
                        'resolution',
                        'notes_eskalasi',
                        'rk_information',
                        'external_ticket_tier_3',
                        'customer_category',
                        'classification_path',
                        'teritory_near_end',
                        'teritory_far_end',
                        'urgency',
                        'urgency_description',
                    ];

                    $result = [];

                    for ($i = 1, $count = $rows->length; $i < $count; $i++)
                    {
                        $cells = $rows->item($i)->getElementsByTagName('td');

                        $data = [];

                        for ($j = 1, $jcount = count($columns); $j <= $jcount; $j++)
                        {
                            $td = $cells->item($j);

                            $data[$columns[$j]] = $td ? $td->nodeValue : null;

                            if ($j == 2)
                            {
                                $data['incident_id'] = substr($td->nodeValue, 2);
                                $data['incident'] = $td->nodeValue;
                            }
                        }

                        $data['incident_id'] = substr($data['incident'], 3);

                        if ($data['lapul'] == '')
                        {
                            $data['lapul'] = 0;
                        }

                        if ($data['gaul'] == '')
                        {
                            $data['gaul'] = 0;
                        }

                        if (preg_match('/^\d+$/', $data['service_no']))
                        {
                            $data['service_no'] = $data['service_no'];
                            $data['service_no2'] = $data['service_no'];
                        }
                        else
                        {
                            $data['service_no2'] = $data['service_no'];
                            $data['service_no'] = 0;
                        }

                        if (preg_match('/^\d+$/', $data['channel']))
                        {
                            $data['channel'] = $data['channel'];
                        }
                        else
                        {
                            $data['channel'] = 0;
                        }

                        if ($data['status_date'] == '')
                        {
                            $data['status_date'] = null;
                        }
                        else
                        {
                            $data['status_date'] = date('Y-m-d H:i:s', strtotime($data['status_date']));
                        }

                        if ($data['booking_date'] == '')
                        {
                            $data['booking_date'] = null;
                        }
                        else
                        {
                            $data['booking_date'] = date('Y-m-d H:i:s', strtotime($data['booking_date']));
                        }

                        if ($data['reported_date'] == '')
                        {
                            $data['reported_date'] = null;
                            $data['date_reported'] = null;
                            $data['time_reported'] = null;
                        }
                        else
                        {
                            $data['reported_date'] = date('Y-m-d H:i:s', strtotime($data['reported_date']));
                            $data['date_reported'] = date('Y-m-d', strtotime($data['reported_date']));
                            $data['time_reported'] = date('H:i:s', strtotime($data['reported_date']));
                        }

                        if ($data['resolve_date'] == '')
                        {
                            $data['resolve_date'] = null;
                        }
                        else
                        {
                            $data['resolve_date'] = date('Y-m-d H:i:s', strtotime($data['resolve_date']));
                        }

                        if ($data['perangkat'] != '')
                        {
                            $data['odp_name'] = preg_replace('/\s+.*$/', '', $data['perangkat']);
                        }
                        else if ($data['device_name'] != '')
                        {
                            $data['odp_name'] = preg_replace('/\s+.*$/', '', $data['device_name']);
                        }
                        else
                        {
                            $data['odp_name'] = null;
                        }

                        $result[] = $data;
                    }

                    $total = count($result);

                    switch ($type) {
                        case 'show':
                                return $total;
                            break;

                        case 'save':
                                if ($total > 0)
                                {
                                    foreach(array_chunk($result, 500) as $data)
                                    {
                                        DB::table('tb_source_insera')->insert($data);
                                    }

                                    print_r("reported date $date assurance order insera status all witel $witel total $total\n");

                                    sleep(5);
                                }
                            break;
                    }
                }
            }
        }
    }

    public static function insera_ticket_list_repo_date($type, $witel, $date)
    {
        $start_datetime = date('Y-m-d 00:00:00', strtotime($date));
        $end_datetime   = date('Y-m-d 23:59:59', strtotime($date));

        $total          = 0;
        $page           = 1;
        $page_show      = 10000;

        $insera         = DB::table('tb_auth_storage')->where('apps', 'insera')->first();

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://oss-incident.telkom.co.id/jw/web/userview/ticketIncidentService/ticketIncidentService/_/welcome',
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: '.$insera->cookies
            ),
        ));
        $response = curl_exec($curl);

        $pattern = '/JPopup\.tokenValue\s*=\s*["\']([^"\']+)["\']/';

        if (preg_match($pattern, $response, $matches))
        {
            $tokenValue = $matches[1];
        }
        else
        {
            $tokenValue = null;
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://oss-incident.telkom.co.id/jw/web/userview/ticketIncidentService/ticketIncidentService/_/allTicketListRepo?d-7228731-p='.$page.'&d-7228731-ps='.$page_show.'&d-7228731-fn_reported_date_filter='.urlencode($start_datetime).'&d-7228731-fn_reported_date_filter='.urlencode($end_datetime).'&d-7228731-fn_status_date_filter=&d-7228731-fn_status_date_filter=&d-7228731-fn_C_OWNER_GROUP=&d-7228731-fn_C_OWNER=&d-7228731-fn_C_REPORTED_PRIORITY=&d-7228731-fn_C_SOURCE_TICKET=GAMAS,PROACTIVE,CUSTOMER&d-7228731-fn_C_EXTERNAL_TICKETID=&d-7228731-fn_C_CHANNEL=&d-7228731-fn_C_CUSTOMER_SEGMENT=DCS,PL-TSEL,DGS,DWS,DES,DBS,DSS,DPS,REG&d-7228731-fn_C_CUSTOMER_TYPE=&d-7228731-fn_C_SERVICE_NO=&d-7228731-fn_C_SERVICE_TYPE=&d-7228731-fn_C_SERVICE_ID=&d-7228731-fn_C_SLG=&d-7228731-fn_C_KODE_PRODUK=&d-7228731-fn_DATEMODIFIED=&d-7228731-fn_C_CLOSED_BY=&d-7228731-fn_C_WORK_ZONE=&d-7228731-fn_C_WITEL='.$witel.'&d-7228731-fn_C_REGION=&d-7228731-fn_C_ID_TICKET=&d-7228731-fn_C_ACTUAL_SOLUTION=&d-7228731-fn_C_CLASSIFICATION_PATH=&d-7228731-fn_C_INCIDENT_DOMAIN=&d-7228731-fn_C_PERANGKAT=&d-7228731-fn_C_DESCRIPTION_ASSIGMENT=&d-7228731-fn_C_CLASSIFICATION_CATEGORY=&d-7228731-fn_C_REALM=&d-7228731-fn_C_PIPE_NAME=&d-7228731-fn_C_CUSTOMER_ID=&d-7228731-fn_C_RELATED_TO_GAMAS=&d-7228731-fn_C_TICKET_ID_GAMAS=&d-7228731-fn_C_GUARANTE_STATUS=&d-7228731-fn_C_DESCRIPTION_CUSTOMERID=&OWASP_CSRFTOKEN='.$tokenValue,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: '.$insera->cookies
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if ($response != null)
        {
            if (preg_match('/Nothing found to display./', $response))
            {
                print_r("nothing found to display (insera_ticket_list_repo_date, $type, $witel, $date)\n");
            }
            else
            {
                libxml_use_internal_errors(true);
                $dom = new \DOMDocument();
                $dom->loadHTML(trim($response));

                $table = $dom->getElementsByTagName('table')->item(0);

                if ($table !== null)
                {
                    $rows = $table->getElementsByTagName('tr');

                    $columns = [ 1 =>
                        'parent_id',
                        'incident',
                        'ttr_customer',
                        'summary',
                        'reported_date',
                        'owner_group',
                        'owner',
                        'customer_segment',
                        'service_type',
                        'witel',
                        'workzone',
                        'status',
                        'status_date',
                        'ticket_id_gamas',
                        'reported_by',
                        'contact_phone',
                        'contact_name',
                        'contact_email',
                        'booking_date',
                        'description_assigment',
                        'reported_priority',
                        'source_ticket',
                        'subsidiary',
                        'external_ticket_id',
                        'channel',
                        'customer_type',
                        'closed_by',
                        'closed_reopen_by',
                        'customer_id',
                        'customer_name',
                        'service_id',
                        'service_no',
                        'slg',
                        'technology',
                        'lapul',
                        'gaul',
                        'onu_rx',
                        'pending_reason',
                        'datemodified',
                        'incident_domain',
                        'region',
                        'symptom',
                        'hierarchy_path',
                        'solution',
                        'description_actual_solution',
                        'kode_produk',
                        'perangkat',
                        'technician',
                        'device_name',
                        'worklog_summary',
                        'last_update_worklog',
                        'classification_flag',
                        'realm',
                        'related_to_gamas',
                        'tsc_result',
                        'scc_result',
                        'ttr_agent',
                        'ttr_mitra',
                        'ttr_nasional',
                        'ttr_pending',
                        'ttr_region',
                        'ttr_witel',
                        'ttr_end_to_end',
                        'note',
                        'guarante_status',
                        'resolve_date',
                        'sn_ont',
                        'tipe_ont',
                        'manufacture_ont',
                        'impacted_site',
                        'cause',
                        'resolution',
                        'notes_eskalasi',
                        'rk_information',
                        'external_ticket_tier_3',
                        'customer_category',
                        'classification_path',
                        'teritory_near_end',
                        'teritory_far_end',
                        'urgency',
                        'urgency_description',
                    ];

                    $result = [];

                    for ($i = 1, $count = $rows->length; $i < $count; $i++)
                    {
                        $cells = $rows->item($i)->getElementsByTagName('td');

                        $data = [];

                        for ($j = 1, $jcount = count($columns); $j <= $jcount; $j++)
                        {
                            $td = $cells->item($j);

                            $data[$columns[$j]] = $td ? $td->nodeValue : null;

                            if ($j == 2)
                            {
                                $data['incident_id'] = substr($td->nodeValue, 2);
                                $data['incident'] = $td->nodeValue;
                            }
                        }

                        $data['incident_id'] = substr($data['incident'], 3);

                        if ($data['lapul'] == '')
                        {
                            $data['lapul'] = 0;
                        }

                        if ($data['gaul'] == '')
                        {
                            $data['gaul'] = 0;
                        }

                        if (preg_match('/^\d+$/', $data['service_no']))
                        {
                            $data['service_no'] = $data['service_no'];
                            $data['service_no2'] = $data['service_no'];
                        }
                        else
                        {
                            $data['service_no2'] = $data['service_no'];
                            $data['service_no'] = 0;
                        }

                        if (preg_match('/^\d+$/', $data['channel']))
                        {
                            $data['channel'] = $data['channel'];
                        }
                        else
                        {
                            $data['channel'] = 0;
                        }

                        if ($data['status_date'] == '')
                        {
                            $data['status_date'] = null;
                        }
                        else
                        {
                            $data['status_date'] = date('Y-m-d H:i:s', strtotime($data['status_date']));
                        }

                        if ($data['booking_date'] == '')
                        {
                            $data['booking_date'] = null;
                        }
                        else
                        {
                            $data['booking_date'] = date('Y-m-d H:i:s', strtotime($data['booking_date']));
                        }

                        if ($data['reported_date'] == '')
                        {
                            $data['reported_date'] = null;
                            $data['date_reported'] = null;
                            $data['time_reported'] = null;
                        }
                        else
                        {
                            $data['reported_date'] = date('Y-m-d H:i:s', strtotime($data['reported_date']));
                            $data['date_reported'] = date('Y-m-d', strtotime($data['reported_date']));
                            $data['time_reported'] = date('H:i:s', strtotime($data['reported_date']));
                        }

                        if ($data['resolve_date'] == '')
                        {
                            $data['resolve_date'] = null;
                        }
                        else
                        {
                            $data['resolve_date'] = date('Y-m-d H:i:s', strtotime($data['resolve_date']));
                        }

                        if ($data['perangkat'] != '')
                        {
                            $data['odp_name'] = preg_replace('/\s+.*$/', '', $data['perangkat']);
                        }
                        else if ($data['device_name'] != '')
                        {
                            $data['odp_name'] = preg_replace('/\s+.*$/', '', $data['device_name']);
                        }
                        else
                        {
                            $data['odp_name'] = null;
                        }

                        $result[] = $data;
                    }

                    $total = count($result);

                    switch ($type) {
                        case 'show':
                                return $total;
                            break;

                        case 'save':
                                if ($total > 0)
                                {
                                    foreach(array_chunk($result, 500) as $data)
                                    {
                                        DB::table('tb_source_insera')->insert($data);
                                    }

                                    print_r("reported date $date assurance order insera status closed witel $witel total $total\n");

                                    sleep(5);
                                }
                            break;
                    }
                }
            }
        }
    }

    public static function scone_login($uname, $pass, $chatid)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://starclick.telkom.co.id/sc',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);

        libxml_use_internal_errors(true);

        $dom = new \DOMDocument();
        $dom->loadHTML(trim($response));

        $header = curl_getinfo($curl);
        $header_content = substr($response, 0, $header['header_size']);

        trim(str_replace($header_content, '', $response));

        $pattern = "#Set-Cookie:\\s+(?<cookie>[^=]+=[^;]+)#m";
        preg_match_all($pattern, $header_content, $matches);

        $cookiesOut = "";
        $header['headers'] = $header_content;
        $header['cookies'] = $cookiesOut;

        $cookiesOut = implode("; ", $matches['cookie']);

        print_r("Cookies Login Page : $cookiesOut\n\n");

        $token = $dom->getElementById('token')->getAttribute("value");

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://starclick.telkom.co.id/sc/user/preauth',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'guid=0&code=0&data=' . urlencode('{"token":"' . $token . '","code":"' . $uname . '","password":"' . $pass . '"}'),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: ' . $cookiesOut,
            ],
        ]);

        $response = curl_exec($curl);

        $otp = 0;

        print_r("\nMasukan Kode OTP :\n");

        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);

        if (trim($line) == 'cancel')
        {
            print_r("ABORTING!\n");
            exit;
        }

        $otp = trim($line);
        fclose($handle);

        $result = json_decode($response);

        $based64Captcha = "data:image/png;base64," . $result->data->captcha;

        list($type, $based64Captcha) = explode(';', $based64Captcha);
        list(, $based64Captcha) = explode(',', $based64Captcha);

        $imageData = base64_decode($based64Captcha);

        $filename = "sc1.jpg";

        file_put_contents($filename, $imageData);

        $caption = 'Kode Captcha Starclick One ' . date('Y-m-d H:i:s');

        Telegram::sendPhoto('7292690834:AAGz4ZcB_pUNVYwiFMsLpHFMik-SvErUJ_8', $chatid, $caption, 'sc1.jpg');

        print_r("\nMasukan Captcha :\n");

        $captcha = 0;

        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);

        if (trim($line) == 'cancel')
        {
            print_r("ABORTING!\n");
            exit;
        }

        $captcha = trim($line);
        fclose($handle);

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://starclick.telkom.co.id/sc/index/n',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => [
                'Cookie: ' . $cookiesOut,
            ],
        ]);

        curl_exec($curl);

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://starclick.telkom.co.id/sc/user/auth',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'guid=0&code=0&data=' . urlencode('{"token":"' . $token . '","code":"' . $uname . '","password":"' . $pass . '","otp":"' . $otp . '","captcha":"' . $captcha . '"}'),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: ' . $cookiesOut,
            ],
        ]);
        $response = curl_exec($curl);
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML(trim($response));
        $header = curl_getinfo($curl);
        $header_content = substr($response, 0, $header['header_size']);
        trim(str_replace($header_content, '', $response));
        $pattern = "#Set-Cookie:\\s+(?<cookie>[^=]+=[^;]+)#m";
        preg_match_all($pattern, $header_content, $matches);
        $cookiesOut = "";
        $header['headers'] = $header_content;
        $header['cookies'] = $cookiesOut;

        $cookiesOut = implode("; ", $matches['cookie']);
        print_r("Cookies Home Page : $cookiesOut\n\n");

        if ($cookiesOut)
        {
            DB::table('tb_auth_storage')
                ->where('apps', 'starclick1')
                ->update([
                    'username' => $uname,
                    'password' => $pass,
                    'cookies' => $cookiesOut,
                ]);
        }

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://starclick.telkom.co.id/retail/public/retail/user/get-session',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Cookie: ' . $cookiesOut,
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response);
        dd($result);
    }

    public static function scone_logout()
    {
        DB::table('tb_auth_storage')
            ->where('apps', 'starclick1')
            ->update([
                'username' => null,
                'password' => null,
                'cookies' => null,
            ]);

        $sc1 = DB::table('tb_auth_storage')->where('apps', 'starclick1')->first();

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://starclick.telkom.co.id/logout',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Cookie: ' . $sc1->cookies,
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        dd($response);
    }

    public static function scone_refresh()
    {
        $sc1 = DB::table('tb_auth_storage')->where('apps', 'starclick1')->first();

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://starclick.telkom.co.id/retail/public/retail/user/get-session',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Cookie: ' . $sc1->cookies,
            ],
        ]);

        curl_exec($curl);

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://starclick.telkom.co.id/sc',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Cookie: ' . $sc1->cookies,
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        dd($response);
    }

    public static function scone_order_weekly($witel)
    {
        $sc1 = DB::table('tb_auth_storage')->where('apps', 'starclick1')->first();

        for ($i = 0; $i <= 14; $i++)
        {
            $datex = date('d/m/Y', strtotime("-$i days"));

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://starclick.telkom.co.id/retail/public/retail/user/get-session',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => [
                    'Cookie: ' . $sc1->cookies,
                ],
            ]);

            curl_exec($curl);

            $link = 'https://starclick.telkom.co.id/retail/public/retail/api/tracking-naf?_dc=1694442833467&ScNoss=true&guid=0&code=0&data=' . urlencode('{"SearchText":"' . $witel . '","Field":"ORG","Fieldstatus":null,"Fieldtransaksi":null,"Fieldchannel":null,"StartDate":"' . $datex . '","EndDate":"' . $datex . '","start":null,"source":"NOSS","typeMenu":"TRACKING"}') . '&page=1&start=0&limit=10';

            curl_setopt_array($curl, [
                CURLOPT_URL => $link,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => [
                    'Cookie: ' . $sc1->cookies,
                ],
            ]);

            $response = curl_exec($curl);

            if (curl_errno($curl))
            {
                echo 'Error:' . curl_error($curl);
                curl_close($curl);
            }
            else
            {
                curl_close($curl);
                $response = json_decode($response);

                if ($response == null)
                {
                    print_r("starclick one session expired!");
                }

                $data = $response->data;
                $jumlahpage = round(@(int)$data->CNT / 10);

                if (isset($data->LIST) && isset($data->CNT))
                {
                    $start = 0;

                    if ($data->CNT > 0 && $data->CNT < 10)
                    {
                        self::scone_insert_order($witel, $datex, 1, 0, $sc1->cookies);
                    }
                    else
                    {
                        for ($x = 1; $x <= $jumlahpage; $x++)
                        {
                            if ($x == 1)
                            {
                                $start = $start + 11;
                            }
                            else
                            {
                                $start = $start + 10;
                            }

                            self::scone_insert_order($witel, $datex, $x, $start, $sc1->cookies);
                        }
                    }

                    sleep(30);
                }
            }
        }
    }

    public static function scone_insert_order($witel, $datex, $x, $start, $cookies)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://starclick.telkom.co.id/retail/public/retail/user/get-session',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Cookie: ' . $cookies,
            ],
        ]);

        curl_exec($curl);

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://starclick.telkom.co.id/retail/public/retail/api/tracking-naf?_dc=1694442833467&ScNoss=true&guid=0&code=0&data=' . urlencode('{"SearchText":"' . $witel . '","Field":"ORG","Fieldstatus":null,"Fieldtransaksi":null,"Fieldchannel":null,"StartDate":"' . $datex . '","EndDate":"' . $datex . '","start":null,"source":"NOSS","typeMenu":"TRACKING"}') . '&page=' . $x . '&start=' . $start . '&limit=10',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Cookie: ' . $cookies,
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response);

        if (isset($response->data->LIST))
        {
            $list = $response->data->LIST;
            $total = count($list);

            foreach ($list as $k => $v)
            {
                $insert[] = [
                    "order_id"        => $v->ORDER_ID,
                    "order_date"      => date('Y-m-d H: i: s', strtotime($v->ORDER_DATE)),
                    "order_status"    => $v->ORDER_STATUS,
                    "order_date_ps"   => date('Y-m-d H: i: s', strtotime($v->ORDER_DATE_PS)),
                    "extern_order_id" => $v->EXTERN_ORDER_ID,
                    "ncli"            => $v->NCLI,
                    "customer_name"   => str_replace(["'", "’"], "", $v->CUSTOMER_NAME),
                    "witel"           => $v->WITEL,
                    "agent_id"        => $v->AGENT_ID,
                    "jenis_psb"       => $v->JENISPSB,
                    "sto"             => $v->STO,
                    "speedy"          => $v->SPEEDY,
                    "pots"            => $v->POTS,
                    "package_name"    => $v->PACKAGE_NAME,
                    "status_resume"   => $v->STATUS_RESUME,
                    "status_code_sc"  => $v->STATUS_CODE_SC,
                    "order_id_ncx"    => $v->ORDER_ID_NCX,
                    "customer_addr"   => str_replace(["'", "’"], "", $v->CUSTOMER_ADDR),
                    "kcontact"        => str_replace(["'", "’"], "", $v->KCONTACT),
                    "ins_address"     => str_replace(["'", "’"], "", $v->INS_ADDRESS),
                    "nd_internet"     => $v->ND_INTERNET,
                    "nd_pots"         => $v->ND_POTS,
                    "gps_latitude"    => $v->GPS_LATITUDE,
                    "gps_longitude"   => $v->GPS_LONGITUDE,
                    "tn_number"       => $v->TN_NUMBER,
                    "loc_id"          => $v->LOC_ID,
                    "reserve_tn"      => $v->RESERVE_TN,
                    "reserve_port"    => $v->RESERVE_PORT,
                    "tipe_order"      => "TLKM",
                ];

                print_r("saved order id $v->ORDER_ID\n");
            }

            self::scone_insert_update($insert);
            sleep(1);

            print_r("\nFinish Grab Backend SC ONE Total $total\n");
        }
    }

    public static function scone_insert_update(array $rows)
    {
        $table = 'tb_source_starclick';
        $first = reset($rows);

        $columns = implode(
            ',',
            array_map(function ($value)
            {
                return "$value";
            }, array_keys($first))
        );

        $values = implode(
            ',',
            array_map(function ($row)
            {
                return '(' . implode(
                    ',',
                    array_map(function ($value)
                    {
                        return '"' . str_replace('"', '""', $value) . '"';
                    }, $row)
                ) . ')';
            }, $rows)
        );

        $updates = implode(
            ',',
            array_map(function ($value)
            {
                return "$value = VALUES($value)";
            }, array_keys($first))
        );

        $sql = "INSERT INTO {$table}({$columns}) VALUES {$values} ON DUPLICATE KEY UPDATE {$updates}";

        return \DB::statement($sql);
    }

    public static function newscmt_location_id($type, $parent)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-item-mgt-scm.telkom.co.id/product-by-location-id/?type_location_id=$type&parent_location_id=$parent&product_id=ALL",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NDYwODEsInJvbGVfaWQiOjg0LCJ3YXJlaG91c2VfaWQiOjM4NzgsImJ1c2luZXNzX3VuaXRfaWQiOjEwNjksInNjaGVtYV9pZCI6MSwic2NoZW1lX2xvZ2luIjoic2NtdCIsImJ1X3JvbGVfaWQiOjkwMDc5LCJpYXQiOjE3MDAyNzc0ODN9.ZUPlXY4LBSDWjpv5AiNpCp-WXMKlKPiIBbMTYRgWYn8',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response);

        if ($result)
        {
            $total = count($result->body);

            if ($total > 0)
            {
                DB::table('newscmt_location_id')->where('parent_location_id', $parent)->delete();

                foreach ($result->body as $k => $v)
                {
                    $insert[] = [
                        'parent_location_id'  => $parent,
                        'product_id'          => $v->product_id,
                        'product_code'        => $v->product_code,
                        'product_description' => $v->product_description,
                        'type_location_id'    => $v->type_location_id,
                        'available'           => $v->available,
                        'blocked'             => $v->blocked,
                        'use_in_transaction'  => $v->use_in_transaction,
                        'intransit'           => $v->intransit,
                        'others'              => $v->others,
                        'total'               => $v->total
                    ];
                }

                DB::table('newscmt_location_id')->insert($insert);
            }

            print_r("\nsuccess saved data newscmt_location_id type $type parent $parent total $total\n");
        }
    }

    public static function newscmt_detail_location_id($type, $parent)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-item-mgt-scm.telkom.co.id/product-detail-by-location-id/?type_location_id=$type&parent_location_id=$parent&product_id=ALL",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NDYwODEsInJvbGVfaWQiOjg0LCJ3YXJlaG91c2VfaWQiOjM4NzgsImJ1c2luZXNzX3VuaXRfaWQiOjEwNjksInNjaGVtYV9pZCI6MSwic2NoZW1lX2xvZ2luIjoic2NtdCIsImJ1X3JvbGVfaWQiOjkwMDc5LCJpYXQiOjE3MDAyNzc0ODN9.ZUPlXY4LBSDWjpv5AiNpCp-WXMKlKPiIBbMTYRgWYn8',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response);

        if ($result)
        {
            $total = count($result->body);

            if ($total > 0)
            {
                DB::table('newscmt_detail_location_id')->where('parent_location_id', $parent)->delete();

                foreach ($result->body as $k => $v)
                {
                    $insert[] = [
                        'parent_location_id'  => $parent,
                        'product_id'          => $v->product_id,
                        'product_code'        => $v->product_code,
                        'product_description' => $v->product_description,
                        'serial_number'       => $v->serial_number,
                        'sid'                 => $v->sid,
                        'inventory_status'    => $v->inventory_status,
                        'type_location_id'    => $v->type_location_id
                    ];
                }

                DB::table('newscmt_detail_location_id')->insert($insert);
            }

            print_r("\nsuccess saved data newscmt_detail_location_id type $type parent $parent total $total\n");
        }
    }
}
