<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telegram extends Model
{
    public static function sendMessage($tokenBot, $chatID, $message)
    {
        $text = urlencode($message);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://api.telegram.org/bot$tokenBot/sendmessage?chat_id=$chatID&text=$text&parse_mode=HTML",
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'POST',
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public static function sendMessageReply($tokenBot, $chatID, $message, $messageID)
    {
        $text = urlencode($message);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://api.telegram.org/bot$tokenBot/sendmessage?chat_id=$chatID&text=$text&parse_mode=HTML&reply_to_message_id=$messageID",
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'POST',
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public static function sendPhoto($tokenBot, $chatID, $caption, $photo)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://api.telegram.org/bot$tokenBot/sendPhoto",
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => [
                'chat_id'    => $chatID,
                'parse_mode' => 'HTML',
                'caption'    => $caption,
                'photo'      => new \CURLFILE($photo),
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public static function sendMessageWithInlineKeyboard($tokenBot, $chatID, $message, $keyboard)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://api.telegram.org/bot$tokenBot/sendMessage",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => [
                'chat_id'      => $chatID,
                'text'         => $message,
                'parse_mode'   => 'HTML',
                'reply_markup' => json_encode($keyboard),
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public static function sendMessageReplyWithInlineKeyboard($tokenBot, $chatID, $message, $messageID, $keyboard)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://api.telegram.org/bot$tokenBot/sendMessage",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => [
                'chat_id'             => $chatID,
                'text'                => $message,
                'parse_mode'          => 'HTML',
                'reply_to_message_id' => $messageID,
                'reply_markup'        => json_encode($keyboard),
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public static function answerCallbackQuery($tokenBot, $callback_query_id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://api.telegram.org/bot$tokenBot/answerCallbackQuery",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => [
                'callback_query_id' => $callback_query_id,
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public static function downloadTelegramPhotoAndRename($tokenBot, $file_id, $path, $filename)
    {
        $getFileUrl  = "https://api.telegram.org/bot$tokenBot/getFile?file_id=$file_id";
        $fileInfo    = json_decode(file_get_contents($getFileUrl), true);
        $filePath    = $fileInfo['result']['file_path'];
        $downloadUrl = "https://api.telegram.org/file/bot$tokenBot/$filePath";
        $contents    = file_get_contents($downloadUrl);
        $saveDir     = public_path($path);

        if (! is_dir($saveDir))
        {
            mkdir($saveDir, 0777, true);
        }

        $savePath = $path . '/' . $filename;
        file_put_contents(public_path($savePath), $contents);

        return $savePath;
    }
}
