<?php

namespace App\Http\Controllers;

class SmsController
{
    public static function send_sms($user, $content)
    {
        ini_set("soap.wsdl_cache_enabled", "0");
        $sms_client = new \SoapClient(
            \App\Http\Controllers\Controller::setting()['sms_url']
            , array('encoding'=>'UTF-8'));
        try 
        {
            $x = $sms_client->SendSMS([ 
                'userName' => \App\Http\Controllers\Controller::setting()['sms_user'],
                'password' => \App\Http\Controllers\Controller::setting()['sms_pass'],
                'fromNumber' => \App\Http\Controllers\Controller::setting()['sms_phone'],
                'toNumbers' => [$user->phone],
                // 'toNumbers' => ['09106801685'],
                'messageContent' => $content . "\n". 'با تشکر '. \App\Http\Controllers\Controller::setting()['name'],
                'isFlash' => false,
                'recId' => [],
                // 'status' => []
                ]);
            \Log::info('sms با متن خریدار غذا فرستاده شد ب'. $x->SendSMSResult);
        } 
        catch (Exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    }
}
