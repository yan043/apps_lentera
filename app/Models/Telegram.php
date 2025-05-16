<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telegram extends Model
{
    protected static $botToken = '';

    protected static function getToken()
    {
        return self::$botToken;
    }

    public static function sendMessage($chatID, $message)
    {
        $token = self::getToken();
        $text = urlencode($message);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.telegram.org/bot$token/sendmessage?chat_id=$chatID&text=$text&parse_mode=HTML",
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public static function sendMessageReply($chatID, $message, $messageID)
    {
        $token = self::getToken();
        $text = urlencode($message);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.telegram.org/bot$token/sendmessage?chat_id=$chatID&text=$text&parse_mode=HTML&reply_to_message_id=$messageID",
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public static function sendPhoto($chatID, $caption, $photo)
    {
        $token = self::getToken();

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.telegram.org/bot$token/sendPhoto",
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => [
                "chat_id" => $chatID,
                "parse_mode" => "HTML",
                "caption" => $caption,
                "photo" => new \CURLFILE($photo),
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}
