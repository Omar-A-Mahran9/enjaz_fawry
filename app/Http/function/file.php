<?php
//دالة فحص  حالة الإرسال بإستخدام File
function sendStatus($viewResult=1)
{
	$contextOptions['http'] = array('method' => 'GET', 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/sendStatus.php?returnJson=1";
	$arrayResult = file($url, FILE_IGNORE_NEW_LINES, $contextResouce);
	$result = $arrayResult[0];

	return $result;
}

//دالة تغيير كلمة المرور لحساب الإرسال في موقع ألفا سيل JSON بإستخدام File
function changePassword($jsonObj)
{
    $contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/changePassword.php";
	$arrayResult = file($url, FILE_IGNORE_NEW_LINES, $contextResouce);
	$result = $arrayResult[0];

	return $result;
}

//دالة إسترجاع كلمة المرور لحساب الإرسال في موقع ألفا سيل JSON بإستخدام File
function forgetPassword($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/forgetPassword.php";
	$arrayResult = file($url, FILE_IGNORE_NEW_LINES, $contextResouce);
	$result = $arrayResult[0];

	return $result;
}

//دالة عرض الرصيد JSON بإستخدام File
function balanceSMS($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/balance.php";
	$arrayResult = file($url, FILE_IGNORE_NEW_LINES, $contextResouce);
	$result = $arrayResult[0];

	return $result;
}

//دالة الإرسال Json بإستخدام File
function sendSMS($jsonObj)
{
    $contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
    $contextResouce  = stream_context_create($contextOptions);
    $url = "http://www.alfa-cell.com/api/msgSend.php";
    $arrayResult = file($url, FILE_IGNORE_NEW_LINES, $contextResouce);
    $result = $arrayResult[0];

    return $result;
}

//دالة قالب الإرسال JSON بإستخدام File
function sendSMSWK($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/msgSendWK.php";
	$arrayResult = file($url, FILE_IGNORE_NEW_LINES, $contextResouce);
	$result = $arrayResult[0];

	return $result;
}

//دالة حذف الرسائل JSON بإستخدام File
function deleteSMS($jsonObj)
{
    $contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
    $contextResouce  = stream_context_create($contextOptions);
    $url = "http://www.alfa-cell.com/api/deleteMsg.php";
    $arrayResult = file($url, FILE_IGNORE_NEW_LINES, $contextResouce);
    $result = $arrayResult[0];

    return $result;
}

//دالة طلب إسم مرسل JSON (جوال) بإستخدام File
function addSender($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/addSender.php";
	$arrayResult = file($url, FILE_IGNORE_NEW_LINES, $contextResouce);
	$result = $arrayResult[0];

	return $result;
}

//دالة تفعيل إسم مرسل JONS (جوال) بإستخدام File
function activeSender($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/activeSender.php";
	$arrayResult = file($url, FILE_IGNORE_NEW_LINES, $contextResouce);
	$result = $arrayResult[0];

	return $result;
}

//دالة التحقق م1ن حالة طلب إسم مرسل JSON (جوال) بإستخدام File
function checkSender($jsonObj)
{
    $contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
    $contextResouce  = stream_context_create($contextOptions);
    $url = "http://www.alfa-cell.com/api/checkSender.php";
	$arrayResult = file($url, FILE_IGNORE_NEW_LINES, $contextResouce);
	$result = $arrayResult[0];

	return $result;
}

//دالة طلب إسم مرسل JOSN (أحرف) بإستخدام File
function addAlphaSender($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/addAlphaSender.php";
	$arrayResult = file($url, FILE_IGNORE_NEW_LINES, $contextResouce);
	$result = $arrayResult[0];

	return $result;
}

//دالة التحقق من حالة طلب إسم مرسل JSON (أحرف) بإستخدام File
function checkAlphasSender($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/checkAlphasSender.php";
	$arrayResult = file($url, FILE_IGNORE_NEW_LINES, $contextResouce);
	$result = implode('',$arrayResult);

	return $result;
}
?>