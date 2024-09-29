<?php
//دالة فحص  حالة الإرسال بإستخدام Fopen
function sendStatus($viewResult=1)
{
	$contextOptions['http'] = array('method' => 'GET', 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/sendStatus.php?returnJson=1";
	$handle = fopen($url, 'r', false, $contextResouce);
    $result = stream_get_contents($handle);

    return $result;
}

//دالة تغيير كلمة المرور لحساب الإرسال في موقع ألفا سيل JSON بإستخدام Fopen
function changePassword($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/josn', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/changePassword.php";
	$handle = fopen($url, 'r', false, $contextResouce);
    $result = stream_get_contents($handle);

    return $result;
}

//دالة إسترجاع كلمة المرور لحساب الإرسال في موقع ألفا سيل JSON بإستخدام Fopen
function forgetPassword($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/forgetPassword.php";
	$handle = fopen($url, 'r', false, $contextResouce);
    $result = stream_get_contents($handle);

    return $result;
}

//دالة عرض الرصيد JSON بإستخدام Fopen
function balanceSMS($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/balance.php";
	$handle = fopen($url, 'r', false, $contextResouce);
    $result = stream_get_contents($handle);

	return $result;
}

//دالة الإرسال JSON بإستخدام Fopen
function sendSMS($jsonObj){
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/msgSend.php";
	$handle = fopen($url, 'r', false, $contextResouce);
    $result = stream_get_contents($handle);

	return $result;
}

//دالة قالب الإرسال JSON بإستخدام Fopen
function sendSMSWK($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/msgSendWK.php";
	$handle = fopen($url, 'r', false, $contextResouce);
    $result = stream_get_contents($handle);

	return $result;
}

//دالة حذف الرسائل المجدولة بإستخدام Fopen
function deleteSMS($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/deleteMsg.php";
	$handle = fopen($url, 'r', false, $contextResouce);
    $result = stream_get_contents($handle);

	return $result;
}

//دالة طلب إسم مرسل (جوال) JSON بإستخدام Fopen
function addSender($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/addSender.php";
	$handle = fopen($url, 'r', false, $contextResouce);
    $result = stream_get_contents($handle);

	return $result;
}

//دالة تفعيل إسم مرسل (جوال) JSON بإستخدام Fopen
function activeSender($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/activeSender.php";
	$handle = fopen($url, 'r', false, $contextResouce);
    $result = stream_get_contents($handle);

	return $result;
}

//دالة التحقق من حالة طلب إسم مرسل (جوال) JSON بإستخدام Fopen
function checkSender($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/checkSender.php";
	$handle = fopen($url, 'r', false, $contextResouce);
    $result = stream_get_contents($handle);

	return $result;
}

//دالة طلب إسم مرسل (أحرف) بإستخدام Fopen
function addAlphaSender($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/addAlphaSender.php";
	$handle = fopen($url, 'r', false, $contextResouce);
    $result = stream_get_contents($handle);

	return $result;
}

//دالة التحقق من حالة طلب إسم مرسل (أحرف) بإستخدام Fopen
function checkAlphasSender($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/checkAlphasSender.php";
	$handle = fopen($url, 'r', false, $contextResouce);
    $result = stream_get_contents($handle);

	return $result;
}
?>