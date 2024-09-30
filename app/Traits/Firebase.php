<?php

namespace App\Traits;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

trait Firebase
{
    public function sendNotification(string $firebase_token, $title, $body, $data)
    {
        
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
    
        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)->setSound('default');
    
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($data);
    
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
    
        $token = $firebase_token;
    
        $downstreamResponse = FCM::sendTo($firebase_token, $option, $notification, $data);
        return true;
    }
}