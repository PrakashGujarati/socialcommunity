<?php


use Illuminate\Support\Facades\Auth;
 
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Notification;





function send_notification($token, $message, $title = null)
{
    $API_ACCESS_KEY = 'AAAAZkwzjLI:APA91bGJMNIZjlE8ormC8l_Re1CYwSolNwEa_rhyk7EPl1tzwF1EnqHzq5VUeEDMFGFErQQivaTYx1jNX7bfP7BJyx1dqag0vaAJ3p1V8vp9R5RPszIumzOF6EKFVvrM8vdKWqUV-DLg';

    $headers = array(
    'Authorization: key=' . $API_ACCESS_KEY,
    'Content-Type: application/json'
    );

    $msg = array(
    'alert' => $message,
    'title' => $title,
    'message' => $message,
    'notification_type' => "",
    'user_type' => "",
    'sound' => 'default',
    'client_id' => "",
    'flag'=>"",
    );

    $notification = array(
    'title' => $title,
    'body' => $message,
    'sound' => 'default',
    );


    $fields = array(
    'to' => $token,
    'data' => $msg,
    'priority' => 'high',
    'vibrate' => 1,
    'notification' => $notification
    );

    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        curl_close($ch);
        $errMsg = '';
        $res = (array) json_decode($result);
        print_r($res);
        $errMsg = '';

        if (!empty($res)) {
            if ($res['failure'] == 1) {
                $errMsg = $res['results'][0]->error;
            }
        }
    } catch (Exception $e) {
        Log::info("ERROR IN CACHE");
    }
}


