<?php
//دالة فحص  حالة الإرسال بإستخدام CURL
function sendStatus($viewResult=1)
{
	$url = "http://www.alfa-cell.com/api/sendStatus.php?returnJson=1";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	$result = curl_exec($ch);

	return $result;
}

//دالة تغيير كلمة المرور لحساب الإرسال في موقع ألفا سيل Json بإستخدام CURL
function changePassword($jsonObj)
{
    $url = "http://www.alfa-cell.com/api/changePassword.php";
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonObj));
	$result = curl_exec($ch);

	return $result;
}

//دالة إسترجاع كلمة المرور لحساب الإرسال في موقع ألفا سيل JSON بإستخدام CURL
function forgetPassword($jsonObj)
{
	$url = "http://www.alfa-cell.com/api/forgetPassword.php";$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonObj));
    $result = curl_exec($ch);

    return $result;
}

//دالة عرض الرصيد JSON بإستخدام CURL
function balanceSMS($jsonObj)
{
	$url = "http://www.alfa-cell.com/api/balance.php";$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonObj));
	$result = curl_exec($ch);

    return $result;
}

//دالة الإرسال Json بإستخدام CURL
function sendSMS($jsonObj)
{
    $url = "http://www.alfa-cell.com/api/msgSend.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonObj));
    $result = curl_exec($ch);

    return $result;
}

//دالة قالب الإرسال JSON بإستخدام CURL
function sendSMSWK($jsonObj)
{
	$url = "http://www.alfa-cell.com/api/msgSendWK.php";$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonObj));
	$result = curl_exec($ch);

    return $result;
}

//دالة حذف الرسائل JSON بإستخدام CURL
function deleteSMS($jsonObj)
{
    $url = "http://www.alfa-cell.com/api/deleteMsg.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($jsonObj));
    $result = curl_exec($ch);

    return $result;
}

//دالة طلب إسم مرسل JOSN (جوال) بإستخدام CURL
function addSender($jsonObj)
{
	$url = "http://www.alfa-cell.com/api/addSender.php";$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonObj));
    $result = curl_exec($ch);

    return $result;
}

//دالة تفعيل إسم مرسل JSON (جوال) بإستخدام CURL
function activeSender($jsonObj)
{
	$url = "http://www.alfa-cell.com/api/activeSender.php";$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonObj));
    $result = curl_exec($ch);

    return $result;
}

//دالة التحقق من حالة طلب إسم مرسل JSON (جوال) بإستخدام CURL
function checkSender($jsonObj)
{
	$url = "http://www.alfa-cell.com/api/checkSender.php";$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonObj));
    $result = curl_exec($ch);

    return $result;
}

//دالة طلب إسم مرسل JSON (أحرف) بإستخدام CURL
function addAlphaSender($jsonObj)
{
	$url = "http://www.alfa-cell.com/api/addAlphaSender.php";$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonObj));
    $result = curl_exec($ch);

    return $result;
}

//دالة التحقق من حالة طلب إسم مرسل JOSN (أحرف) بإستخدام CURL
function checkAlphasSender($jsonObj)
{
	$url = "http://www.alfa-cell.com/api/checkAlphasSender.php";
$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonObj));
    $result = curl_exec($ch);

    return $result;
}
?>