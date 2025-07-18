<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Telegram;

class TelegramController extends Controller
{
    public static function updateWebhookLenteraBot()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => 'https://api.telegram.org/bot7292690834:AAGz4ZcB_pUNVYwiFMsLpHFMik-SvErUJ_8/getWebhookInfo',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        print_r($response);

        $result = json_decode($response);

        if ($result->result->pending_update_count <> 0)
        {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL            => 'https://api.telegram.org/bot7292690834:AAGz4ZcB_pUNVYwiFMsLpHFMik-SvErUJ_8/setWebhook?url=https://lentera.jukung-dev.org/telegram/lenteraBot&max_connections=100&drop_pending_updates=true',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'POST',
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            print_r($response);
        }
        else
        {
            print_r("Pending Update Count is Zero \n");
        }
    }

    private static function getAddressFromCoordinates($coordinates)
    {
        [$lat, $lon] = explode(',', $coordinates);
        $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat=$lat&lon=$lon&zoom=18&addressdetails=1";
        $opts = [
            "http" => [
                "header" => "User-Agent: LenteraBot/1.0\r\n"
            ]
        ];
        $context  = stream_context_create($opts);
        $response = @file_get_contents($url, false, $context);
        $data     = json_decode($response, true);
        $address  = $data['address'] ?? [];
        return [
            'street'   => $address['road'] ?? '',
            'city'     => $address['city'] ?? ($address['town'] ?? ($address['village'] ?? '')),
            'province' => $address['state'] ?? '',
            'full'     => $data['display_name'] ?? ''
        ];
    }

    public static function lenteraBot()
    {
        $tokenBot = "7292690834:AAGz4ZcB_pUNVYwiFMsLpHFMik-SvErUJ_8";
        $apiBot   = "https://api.telegram.org/bot" . $tokenBot;
        $update   = json_decode(file_get_contents("php://input"), TRUE);

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => 'Start',     'callback_data' => '/start'],
                    ['text' => 'Chat ID',   'callback_data' => '/chat_id'],
                ],
                [
                    ['text' => 'Lapor ODP Terbuka', 'callback_data' => '/lapor_odp_terbuka'],
                ],
                [
                    ['text' => 'Tutup ODP Terbuka', 'callback_data' => '/tutup_odp_terbuka'],
                ],
                [
                    ['text' => 'iBooster',  'callback_data' => '/ibooster'],
                ]
            ]
        ];

        if (isset($update['callback_query']))
        {
            $callback   = $update['callback_query'];
            $chat_type  = $callback['message']['chat']['type'] ?? '';

            if ($chat_type !== 'private')
            {
                $chat_id   = $callback['message']['chat']['id'];
                $messageID = $callback['message']['message_id'];

                Telegram::sendMessage($tokenBot, $chat_id, "Maaf, bot ini hanya bisa digunakan di chat pribadi.");
                return;
            }

            $chat_id    = $callback['message']['chat']['id'];
            $messageID  = $callback['message']['message_id'];
            $data       = $callback['data'];
            $chat_title = self::getChatTitle($callback['message']['chat'] ?? []);

            self::answerCallbackQuery($callback['id']);

            if ($data === '/lapor_odp_terbuka')
            {
                self::setUserState($chat_id, ['step' => 'input_odp_name']);
                Telegram::sendMessage($tokenBot, $chat_id, "🔖 Ketik nama ODP");
                return;
            }

            if (strpos($data, 'odp_hsa_') === 0)
            {
                $hsa_id   = str_replace('odp_hsa_', '', $data);
                $saList   = DB::table('master_service_area')->where('id_hsa', $hsa_id)->select('sa_id', 'sa_name')->get();
                $saKeyboard = ['inline_keyboard' => []];

                foreach ($saList as $sa)
                {
                    $saKeyboard['inline_keyboard'][] = [
                        ['text' => $sa->sa_name, 'callback_data' => 'odp_sa_' . $hsa_id . '_' . $sa->sa_id]
                    ];
                }

                self::setUserState($chat_id, [
                    'step'   => 'choose_sa',
                    'hsa_id' => $hsa_id
                ]);
                self::sendMessageReplyWithInlineKeyboard($chat_id, "🏬 Pilih Service Area", $messageID, $saKeyboard);
                return;
            }

            if (strpos($data, 'odp_sa_') === 0)
            {
                $parts  = explode('_', $data);
                $hsa_id = $parts[2];
                $sa_id  = $parts[3];

                self::setUserState($chat_id, [
                    'step'      => 'input_odp_name',
                    'hsa_id'    => $hsa_id,
                    'sa_id'     => $sa_id
                ]);
                Telegram::sendMessage($tokenBot, $chat_id, "🔖 Ketik nama ODP");
                return;
            }

            if ($data === '/ibooster')
            {
                self::setUserState($chat_id, ['step' => 'input_ibooster']);
                $msg = "Silakan masukkan nomor internet (tanpa @telkom.net) untuk pengecekan iBooster:";
                self::sendMessageReplyWithInlineKeyboard($chat_id, $msg, $messageID, $keyboard);
                return;
            }

            if ($data === '/start')
            {
                $hour = date('H', time());

                if ($hour > 6 && $hour <= 11)
                {
                    $saying = "Selamat Pagi";
                }
                elseif ($hour > 11 && $hour <= 15)
                {
                    $saying = "Selamat Siang";
                }
                elseif ($hour > 15 && $hour <= 17)
                {
                    $saying = "Selamat Sore";
                }
                elseif ($hour > 17 && $hour <= 23)
                {
                    $saying = "Selamat Malam";
                }
                else
                {
                    $saying = "Why aren't you asleep? Are you programming?";
                }

                $msg = "Hai $chat_title, $saying ...";
                self::sendMessageReplyWithInlineKeyboard($chat_id, $msg, $messageID, $keyboard);
                return;
            }

            if ($data === '/chat_id')
            {
                $msg  = "Name    : <b>$chat_title</b>\n";
                $msg .= "Chat ID : <b>$chat_id</b>";
                self::sendMessageReplyWithInlineKeyboard($chat_id, $msg, $messageID, $keyboard);
                return;
            }

            if ($data === '/tutup_odp_terbuka')
            {
                $odps = DB::table('report_open_alpro')
                    ->whereNull('repair_notes')
                    ->orderBy('created_date', 'desc')
                    ->get();

                if ($odps->isEmpty())
                {
                    self::sendMessageReplyWithInlineKeyboard($chat_id, "Tidak ada ODP terbuka yang perlu ditutup.", $messageID, $keyboard);
                    return;
                }

                $odpKeyboard = ['inline_keyboard' => []];
                foreach ($odps as $odp)
                {
                    $odpKeyboard['inline_keyboard'][] = [
                        ['text' => $odp->odp_name, 'callback_data' => 'tutup_odp_' . $odp->id]
                    ];
                }

                self::setUserState($chat_id, ['step' => 'choose_tutup_odp']);
                self::sendMessageReplyWithInlineKeyboard($chat_id, "Pilih ODP yang akan ditutup:", $messageID, $odpKeyboard);
                return;
            }

            if (strpos($data, 'tutup_odp_') === 0)
            {
                $id  = str_replace('tutup_odp_', '', $data);
                $odp = DB::table('report_open_alpro')->where('id', $id)->first();

                if (!$odp)
                {
                    self::sendMessageReplyWithInlineKeyboard($chat_id, "Data ODP tidak ditemukan.", $messageID, $keyboard);
                    return;
                }

                $hsa = DB::table('master_head_service_area')->where('hsa_id', $odp->hsa_id)->first();
                $sa  = DB::table('master_service_area')->where('sa_id', $odp->sa_id)->first();

                $msg = "<b>Detail ODP Terbuka</b>\n";
                $msg .= "🏢 Head Service Area : " . ($hsa->hsa_name ?? '-') . "\n";
                $msg .= "🏬 Service Area : " . ($sa->sa_name ?? '-') . "\n";
                $msg .= "🔖 Nama ODP : " . ($odp->odp_name ?? '-') . "\n";
                $msg .= "📍 Koordinat ODP : " . ($odp->odp_coordinates ?? '-') . "\n";
                $msg .= "📝 Catatan : " . ($odp->note ?? '-') . "\n";

                self::setUserState($chat_id, [
                    'step'   => 'input_repair_notes',
                    'odp_id' => $odp->id
                ]);

                if ($odp->photo_odp && file_exists(public_path($odp->photo_odp)))
                {
                    self::sendPhotoWithCaption($chat_id, public_path($odp->photo_odp), $msg);
                }
                else
                {
                    self::sendMessageReply($chat_id, $msg, $messageID);
                }
                self::sendMessageReply($chat_id, "Silakan masukkan catatan perbaikan.", $messageID);
                return;
            }

            $msg = "Maaf perintah tidak tersedia ...";
            self::sendMessageReplyWithInlineKeyboard($chat_id, $msg, $messageID, $keyboard);
            return;
        }

        if (isset($update['message']))
        {
            $chat_type = $update['message']['chat']['type'] ?? '';

            if ($chat_type !== 'private')
            {
                $chat_id   = $update['message']['chat']['id'];
                $messageID = $update['message']['message_id'];

                Telegram::sendMessage($tokenBot, $chat_id, "Maaf, bot ini hanya bisa digunakan di chat pribadi.");
                return;
            }

            $chat_id    = $update['message']['chat']['id'];
            $messageID  = $update['message']['message_id'];
            $text       = $update['message']['text'] ?? '';
            $photo      = $update['message']['photo'] ?? null;
            $location   = $update['message']['location'] ?? null;

            $state = self::getUserState($chat_id);

            if ($state && $state['step'] === 'input_odp_name' && !empty($text))
            {
                self::setUserState($chat_id, [
                    'step'      => 'input_odp_photo',
                    'odp_name'  => $text
                ]);
                Telegram::sendMessage($tokenBot, $chat_id, "📸 Upload foto ODP");
                return;
            }
            if ($state && $state['step'] === 'input_odp_photo' && $photo)
            {
                $file_id   = end($photo)['file_id'];
                $filename  = 'odp_open_' . date('Ymd_His') . '_' . $chat_id . '.jpg';
                $photo_path= self::downloadTelegramPhotoAndRename($file_id, $filename);

                self::setUserState($chat_id, [
                    'step'      => 'input_odp_location',
                    'odp_name'  => $state['odp_name'],
                    'photo_odp' => $photo_path
                ]);
                Telegram::sendMessage($tokenBot, $chat_id, "📍 Kirim lokasi ODP (share location)");
                return;
            }
            if ($state && $state['step'] === 'input_odp_location' && $location)
            {
                $coordinates = $location['latitude'] . ',' . $location['longitude'];
                $address = self::getAddressFromCoordinates($coordinates);

                DB::table('report_open_alpro')->insert([
                    'odp_name'        => $state['odp_name'],
                    'odp_coordinates' => $coordinates,
                    'photo_odp'       => $state['photo_odp'],
                    'street'          => $address['street'],
                    'city'            => $address['city'],
                    'province'        => $address['province'],
                    'created_date'    => date('Y-m-d'),
                    'created_time'    => date('H:i:s'),
                ]);
                self::clearUserState($chat_id);
                Telegram::sendMessage($tokenBot, $chat_id, "ODP berhasil dilaporkan. Terima kasih!");
                return;
            }

            if ($state && $state['step'] === 'input_repair_notes' && !empty($text))
            {
                self::setUserState($chat_id, [
                    'step'          => 'input_repair_photo',
                    'odp_id'        => $state['odp_id'],
                    'repair_notes'  => $text
                ]);
                Telegram::sendMessage($tokenBot, $chat_id, "📸 Upload foto hasil perbaikan ODP.");
                return;
            }
            if ($state && $state['step'] === 'input_repair_photo' && $photo)
            {
                $file_id   = end($photo)['file_id'];
                $filename  = 'odp_repair_' . date('Ymd_His') . '_' . $state['odp_id'] . '.jpg';
                $photo_path= self::downloadTelegramPhotoAndRename($file_id, $filename);

                self::setUserState($chat_id, [
                    'step'              => 'input_repair_location',
                    'odp_id'            => $state['odp_id'],
                    'repair_notes'      => $state['repair_notes'],
                    'repair_photo_odp'  => $photo_path
                ]);
                Telegram::sendMessage($tokenBot, $chat_id, "📍 Kirim lokasi perbaikan (share location)");
                return;
            }
            if ($state && $state['step'] === 'input_repair_location' && $location)
            {
                $coordinates = $location['latitude'] . ',' . $location['longitude'];
                $address = self::getAddressFromCoordinates($coordinates);

                DB::table('report_open_alpro')->where('id', $state['odp_id'])->update([
                    'repair_notes'        => $state['repair_notes'],
                    'repair_coordinates'  => $coordinates,
                    'repair_photo_odp'    => $state['repair_photo_odp'],
                    'repair_date'         => date('Y-m-d'),
                    'repair_time'         => date('H:i:s'),
                    'repair_street'       => $address['street'],
                    'repair_city'         => $address['city'],
                    'repair_province'     => $address['province'],
                ]);
                self::clearUserState($chat_id);
                Telegram::sendMessage($tokenBot, $chat_id, "ODP berhasil ditutup dan diperbaiki. Terima kasih!");
                return;
            }

            if (!empty($text) && substr($text, 0, 1) == '/')
            {
                if (strpos($text, "/start") === 0)
                {
                    $hour       = date('H', time());
                    $chat_title = self::getChatTitle($update['message']['chat'] ?? []);

                    if ($hour > 6 && $hour <= 11)
                    {
                        $saying = "Selamat Pagi";
                    }
                    elseif ($hour > 11 && $hour <= 15)
                    {
                        $saying = "Selamat Siang";
                    }
                    elseif ($hour > 15 && $hour <= 17)
                    {
                        $saying = "Selamat Sore";
                    }
                    elseif ($hour > 17 && $hour <= 23)
                    {
                        $saying = "Selamat Malam";
                    }
                    else
                    {
                        $saying = "Why aren't you asleep? Are you programming?";
                    }

                    $msg = "Hai $chat_title, $saying ...";
                    self::sendMessageReplyWithInlineKeyboard($chat_id, $msg, $messageID, $keyboard);
                }
                elseif (strpos($text, "/chat_id") === 0)
                {
                    $chat_title = self::getChatTitle($update['message']['chat'] ?? []);
                    $msg  = "Name    : <b>$chat_title</b>\n";
                    $msg .= "Chat ID : <b>$chat_id</b>";
                    self::sendMessageReplyWithInlineKeyboard($chat_id, $msg, $messageID, $keyboard);
                }
                elseif (strpos($text, "/ibooster") === 0)
                {
                    self::setUserState($chat_id, ['step' => 'input_ibooster']);
                    $msg = "Silakan masukkan nomor internet (tanpa @telkom.net) untuk pengecekan iBooster:";
                    self::sendMessageReplyWithInlineKeyboard($chat_id, $msg, $messageID, $keyboard);
                }
                else
                {
                    $msg = "Maaf perintah tidak tersedia ...";
                    self::sendMessageReplyWithInlineKeyboard($chat_id, $msg, $messageID, $keyboard);
                }
            }
        }
    }

    private static function getChatTitle($chat)
    {
        if (isset($chat['title']))
        {
            return $chat['title'];
        }
        if (isset($chat['first_name']))
        {
            return $chat['first_name'] . (isset($chat['last_name']) ? ' ' . $chat['last_name'] : '');
        }
        return '';
    }

    private static function sendMessageReplyWithInlineKeyboard($chatID, $message, $messageID, $keyboard)
    {
        $url        = "https://api.telegram.org/bot7292690834:AAGz4ZcB_pUNVYwiFMsLpHFMik-SvErUJ_8/sendMessage";
        $postFields = [
            'chat_id'             => $chatID,
            'text'                => $message,
            'parse_mode'          => 'HTML',
            'reply_to_message_id' => $messageID,
            'reply_markup'        => json_encode($keyboard),
        ];

        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => "",
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => "POST",
                CURLOPT_POSTFIELDS     => $postFields,
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    private static function sendMessageReply($chatID, $message, $messageID)
    {
        $url        = "https://api.telegram.org/bot7292690834:AAGz4ZcB_pUNVYwiFMsLpHFMik-SvErUJ_8/sendMessage";
        $postFields = [
            'chat_id'             => $chatID,
            'text'                => $message,
            'parse_mode'          => 'HTML',
            'reply_to_message_id' => $messageID,
        ];

        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => "",
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => "POST",
                CURLOPT_POSTFIELDS     => $postFields,
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    private static function answerCallbackQuery($callback_query_id)
    {
        $url        = "https://api.telegram.org/bot7292690834:AAGz4ZcB_pUNVYwiFMsLpHFMik-SvErUJ_8/answerCallbackQuery";
        $postFields = [
            'callback_query_id' => $callback_query_id,
        ];

        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => "",
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => "POST",
                CURLOPT_POSTFIELDS     => $postFields,
            )
        );

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    private static function getUserState($chat_id)
    {
        $file = storage_path("app/odp_state_$chat_id.json");
        if (file_exists($file))
        {
            return json_decode(file_get_contents($file), true);
        }
        return null;
    }

    private static function setUserState($chat_id, $data)
    {
        $file = storage_path("app/odp_state_$chat_id.json");
        file_put_contents($file, json_encode($data));
    }

    private static function clearUserState($chat_id)
    {
        $file = storage_path("app/odp_state_$chat_id.json");
        if (file_exists($file))
        {
            unlink($file);
        }
    }

    private static function downloadTelegramPhotoAndRename($file_id, $filename)
    {
        $token      = "7292690834:AAGz4ZcB_pUNVYwiFMsLpHFMik-SvErUJ_8";
        $getFileUrl = "https://api.telegram.org/bot$token/getFile?file_id=$file_id";
        $fileInfo   = json_decode(file_get_contents($getFileUrl), true);
        $filePath   = $fileInfo['result']['file_path'];
        $downloadUrl= "https://api.telegram.org/file/bot$token/$filePath";
        $contents   = file_get_contents($downloadUrl);
        $saveDir    = public_path('upload_report_open_alpro');

        if (!is_dir($saveDir))
        {
            mkdir($saveDir, 0777, true);
        }

        $savePath = 'upload_report_open_alpro/' . $filename;
        file_put_contents(public_path($savePath), $contents);

        return $savePath;
    }

    private static function sendPhotoWithCaption($chat_id, $photo_path, $caption)
    {
        $token      = "7292690834:AAGz4ZcB_pUNVYwiFMsLpHFMik-SvErUJ_8";
        $url        = "https://api.telegram.org/bot$token/sendPhoto";

        $postFields = [
            'chat_id'    => $chat_id,
            'caption'    => $caption,
            'parse_mode' => 'HTML',
            'photo'      => new \CURLFile($photo_path)
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data"]);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

    public static function comparin_ibooster($id)
    {
        $result = ApiModel::comparin_ibooster($id);

        if (!empty($result->MESSAGE) || $result == null)
        {
            $data = null;
        }
        else
        {
            $data = $result;
        }

        if ($data == null)
        {
            $msg = "Nomor internet $id@telkom.net tidak memiliki usage";
        }
        else
        {
            $msg  = "Berikut hasil pengukuran i-booster untuk nomor internet $id.\n\n";
            $msg .= "CLID : $data->clid\n";
            $msg .= "ID OLT di Radius : $data->identifier\n";
            $msg .= "IP OLT : $data->hostname\n";
            $msg .= "IP AMS : $data->ip_ams\n";
            $msg .= "Tipe OLT : $data->type\n";
            $msg .= "Deskripsi ONU : $data->desc_name\n";
            $msg .= "Tipe ONU : $data->reg_type ( $data->version_id )\n";
            $msg .= "ONU SN : $data->serial_number\n";
            $msg .= "ONU Status : $data->oper_status\n\n";
            $msg .= "BW Profile : $data->bw_up / $data->bw_down\n\n";
            $msg .= "ONU Power Supply : $data->onu_pwr_spl Volt\n";
            $msg .= "ONU Bias Current : $data->onu_bias_curr mA\n";
            $msg .= "ONU Temperature : $data->onu_temp derajat Celcius\n";
            $msg .= "ONU Tx Power : $data->onu_tx_pwr dBm\n";
            $msg .= "ONU Rx Power : $data->onu_rx_pwr dBm\n";
            $msg .= "OLT Power Supply : $data->olt_pwr_spl Volt\n";
            $msg .= "OLT Bias Current : $data->olt_bias_curr mA\n";
            $msg .= "OLT Temperature : $data->olt_temp derajat Celcius\n";
            $msg .= "OLT Tx Power : $data->olt_tx_pwr dBm\n";
            $msg .= "OLT Rx Power : $data->olt_rx_pwr dBm\n";
            $msg .= "Panjang Fiber : $data->fiber_length meter\n";
            $msg .= "Framed-IP-Addr : $data->frame_ip\n";
            $msg .= "MAC-Addr : $data->mac\n";
            $msg .= "Start Time : $data->session_start\n";
            $msg .= "Connection Status : $data->connection_status\n";
            $msg .= "Usage Bytes : $data->usage_upload / $data->usage_download\n\n";
            if (!empty($data->gangguan))
            {
                $msg .= "Jenis Gangguan : $data->gangguan \n\n";
            }
            if (!empty($data->indikasi))
            {
                $indikasi = str_replace(array("                                      ", "\n"), "", $data->indikasi);
                $msg .= "<b>Indikasi :</b>\n<i>$indikasi</i>\n";
            }
            if (!empty($data->desc))
            {
                $diskripsi = str_replace(array("                                                ", "\n"), "", $data->desc);
                $msg .= "<b>Deskripsi :</b>\n<i>$diskripsi</i>\n";
            }
            if (!empty($data->suggestion))
            {
                $msg .= "<b>Saran :</b>\n<i>$data->suggestion</i>\n";
            }
        }

        return $msg;
    }
}
