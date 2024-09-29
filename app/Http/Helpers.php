<?php
use Illuminate\Support\Facades\Request;
// use App\Product;
use App\Service;
include("includeSettings.php");


function paymentMethodCheckUp ($order, $route){

    // return view('paymentCheckUp', compact(['order', 'route']));
    return view('engazFawry.parts.paymentCheckUp', compact(['order', 'route']))->render();

}

function createNotification($user_id, $type, $query)
{
    $Notification = new Notification;
    $Notification->user_id = $user_id;
    $Notification->type = $type;
    $Notification->query = json_encode($query);
    $Notification->save();

    return $Notification;
}


 function getPaymentKeys($type) { 
    $moyaser_mobile_secret_api_key = "sk_live_pRCggGGMpfxZTqgecwGCfiSnCFRrxUAdWv6gk9st";
    $moyaser_mobile_publishable_api_key = "pk_live_y6DsA5yxjzjN7QZthqTfVoPgL8sQ7W1si2YBRa7c";


    if($type == 'secret_api_key'){
        return $moyaser_mobile_secret_api_key;
    }
    elseif ($type == 'publishable_api_key'){
        return $moyaser_mobile_publishable_api_key;
    }
 
}


function getServiceName($serviceId)
{
     $service = Service::find($serviceId);

     if ( $service) {
       return $service->name;
     }else{
       return " N/A ";

     }
     
}

function getStatusAdmin($st)
{
    if($st == "-1"){
        $status = 'جديد لم تشاهد بعد ';
    }elseif($st == "0"){
        $status = 'جديد تمت المشاهدة ';
    }elseif($st == "1"){
        $status = 'موافقة العميل ';
    }elseif($st == "-2"){
        $status = 'مرفوض من العميل ';
    }elseif($st == "-3"){
        $status = 'مرفوض من الادمن ';
    }elseif($st == "2"){
        $status = 'قيد الاجراء';
    }elseif($st == "3"){
        $status = 'معلق';
    }elseif($st == "5"){
        $status = 'تم الانجاز';
    }elseif($st == "4"){
        $status = 'تم الانجاز من المعقب';
    }elseif($st == "-4"){
        $status = 'ملاحظات على الطلب';
    }elseif($st == "-5"){
        $status = 'تم الرد على الملاحظات';
    }else{
        $status = 'N/A';
    }

    return  $status;
}

function getStatusUser($st)
{
    if($st == "-1" || $st == "0"){
        $status = 'جديد';
    }elseif($st == "1"){
        $status = 'مقبول ';
    }elseif($st == "-2"){
        $status = 'مرفوض من العميل ';
    }elseif($st == "-3"){
        $status = 'مرفوض ';
    }elseif($st == "2"){
        $status = 'قيد الاجراء';
    }elseif($st == "3"){
        $status = 'معلق';
    }elseif($st == "5" || $st == "4"){
        $status = 'تم الانجاز';
    }elseif($st == "-4"){
        $status = 'ملاحظات على الطلب';
    }elseif($st == "-5"){
        $status = 'تم الرد على الملاحظات';
    }else{
        $status = 'N/A';
    }

    return  $status;
}


function getUserType($type)
{ 
    if($type == "individual" ){
        $t = 'عميل';
    }elseif($type == "vendorC"){
        $t = 'مكتب خدمات ';
    }elseif($type == "vendor"){
        $t = 'معقب ';
    }else{
        $t = 'N/A';
    }
    return  $t;
}

function the_excerpt($title){

    if (strlen($title) < 40) {
        return $title;
    } else {

        $new = wordwrap($title, 60);
        $new = explode("\n", $new);

        $new = $new[0] . '...';

        return $new;
    }

}


function getNav()
{
    return view('web.templates.nav');
}


function exerpt_text($text, $length)
{
  
    $max_length = $length;

    if (strlen($text) > $max_length)
    {
        $offset = ($max_length - 3) - strlen($text);
        $text = substr($text, 0, strrpos($text, ' ', $offset)) . '...';
    }
    
    return $text;
}



function printStars($avg){

    if($avg >= 0 && $avg < 1 ){

        $stars = '
            <div class="product-rating">
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
        </div>';

    }elseif($avg >= 1 && $avg < 2 ){
        $stars = '
        <div class="product-rating">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
        </div>';

    }elseif($avg >= 2 && $avg < 3 ){
        $stars = '
        <div class="product-rating">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
        </div>';
    }elseif($avg >= 3 && $avg < 4 ){
        $stars = '
        <div class="product-rating">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
        </div>';
    }elseif($avg >= 4 && $avg < 5 ){
        $stars = '
        <div class="product-rating">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
        </div>';
    }elseif($avg == 5){
        $stars = '
        <div class="product-rating">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
        </div>';
    }else{
        $stars = '';
    }

    return $stars;

}


/**
 * @param $route
 * @return string
 */
function activateRouteClass($route)
{
    if (! isRouteActive($route)) {
        return '';
    }
    return 'class=active';
}

/**
 * @param $numbers
 * @return mixed
 */
function translateNumbers($numbers)
{
    // Don't translate if the locale is English
    if (config('app.locale') === 'en') {
        return $numbers;
    }

    $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];
    $english = ['9', '8', '7', '6', '5', '4', '3', '2', '1', '0'];

    return str_replace($english, $arabic, $numbers);
}


function isActive($name)
{
    $current_route_name = \Route::current()->getName();
    $current_route_array = explode('.', $current_route_name);
    if (in_array($name, $current_route_array)) {
        return true;  
    }
    return false;  
}

function wActive($name)
{
    $current_route_name = \Route::current()->getName();
    $current_route_array = explode('.', $current_route_name);
    if (in_array($name, $current_route_array)) {
        return true;  
    }
    return false;  
}
function itemIsActive($name, $action)
{
    $current_route_name = \Route::current()->getName();
    $current_route_array = explode('.', $current_route_name);
    if (in_array($name, $current_route_array) && in_array($action, $current_route_array)) {
        return true;  
    }
    return false;  
}

function translateNumber($number)
{

    $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];
    $english = ['9', '8', '7', '6', '5', '4', '3', '2', '1', '0'];

    return str_replace($arabic, $english, $number);
}

function validNumber($number)
{
    $number = translateNumber((string) $number);
    $number = str_replace('+', '', $number);
    $numlength = strlen((string)$number);
    if ($numlength == 10) {
        $array = str_split($number);
        $array[0] = "966";
        $valid_number = null;
        foreach ($array as $key => $value) {
            $valid_number = $valid_number . $value; 
        }
        return  $valid_number;
    } elseif ($numlength == 12 ) {
        return  $number;
    } 
    return false;
}



function smsBalance()
{
    // if (validNumber($number) != false) {
        $jsonObj = array(
            'apiKey' => env('SMS_API_KEY'),            		   		
            'mobile' => '966544445811',            		   		
            'password' => 'Mokled1404',            		   		
        );
        // دالة الإرسال JOSN
        $result=balanceSMS($jsonObj);
        
        //لتحويل النتيجة إلى  array
        return $result = json_decode($result, true);
        
        
     //   dd( $result['status']);
    // }
    // return false;
}



// de586a9ab847ec49b89dfaf564fd81e2
// ENJAZ-AD
// ENJAZ-FAWRY

// function senSMS($number, $message)
// {
//     // if (validNumber($number) != false) {
//         $jsonObj = array(
//             'apiKey' => env('SMS_API_KEY'),            		   		
//             'sender'=>env('SMS_SENDER'),				  	
//             'numbers' => $number,	
//             'msg' => $message, 		
//             'timeSend' => '0',                   	
//             'dateSend' => '0',				    	
//             'lang' => '3',                      	
//             'applicationType' => 68, 				
//         );
//         // دالة الإرسال JOSN
//         $result=sendSMS($jsonObj);
        
//         //لتحويل النتيجة إلى  array
//         return $result = json_decode($result, true);
        
        
//      //   dd( $result['status']);
//     // }
//     // return false;
// }


function senSMS($number, $message)
{

    $bearer = 'de586a9ab847ec49b89dfaf564fd81e2';
    $taqnyt = new \TaqnyatSms($bearer);
    $body = $message;
    $recipients = $number;
    $sender = 'ENJAZ-FAWRY';

    $message =$taqnyt->sendMsg($body, $recipients, $sender);
  
    // // if (validNumber($number) != false) {
    //     $jsonObj = array(
    //         'apiKey' => env('SMS_API_KEY'),            		   		
    //         'sender'=>env('SMS_SENDER'),				  	
    //         'numbers' => $number,	
    //         'msg' => $message, 		
    //         'timeSend' => '0',                   	
    //         'dateSend' => '0',				    	
    //         'lang' => '3',                      	
    //         'applicationType' => 68, 				
    //     );
    //     // دالة الإرسال JOSN
        // $result=sendSMS($jsonObj);
        
        //لتحويل النتيجة إلى  array
    $result = json_decode($message, true);
    return json_decode($message, true);
        
     //   dd( $result['status']);
    // }
    // if($result['statusCode'] == (200 | 201) && $admin != null){
    //     $save = new SmsHistory();
    //     $save->message = $message;
    //     $save->phone = $number;
    //     $save->admin_id = $admin;
    //     $save->save();
    //     return 'done';
    // }else{
    //     return 'faild';
    // }
    
}
function getSmsBalance()
{

    $bearer = 'de586a9ab847ec49b89dfaf564fd81e2';
    $taqnyt = new \TaqnyatSms($bearer);


$balance = $taqnyt->balance();
return json_decode($balance, true);;

}
function siteName()
{
    return 'انجاز فوري';
}
