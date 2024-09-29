<?php
//دالة فحص  حالة الإرسال بإستخدام File_Get_Contents
function sendStatus($viewResult=1)
{
	$contextOptions['http'] = array('method' => 'GET', 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/sendStatus.php?returnJson=1";
	$result = file_get_contents($url, false, $contextResouce);

	return $result;
}

//دالة تغيير كلمة المرور لحساب الإرسال في موقع ألفا سيل JSON بإستخدام File_Get_Contents
function changePassword($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/changePassword.php";
	$result = file_get_contents($url, false, $contextResouce);

	return $result;
}

//دالة إسترجاع كلمة المرور لحساب الإرسال في موقع ألفا سيل JSON بإستخدام File_Get_Contents
function forgetPassword($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/forgetPassword.php";
	$result = file_get_contents($url, false, $contextResouce);

	return $result;
}

//دالة عرض الرصيد JSON بإستخدام File_Get_Contents
function balanceSMS($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=>  json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/balance.php";
	$result = file_get_contents($url, false, $contextResouce);

	return $result;
}

//دالة الإرسال JSON بإستخدام File_Get_Contents
function sendSMS($jsonObj){
    $contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/msgSend.php";
	$result = file_get_contents($url, false, $contextResouce);

	return $result;
}

//دالة قالب الإرسال JSON بإستخدام File_Get_Contents
function sendSMSWK($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/msgSendWK.php";
	$result = file_get_contents($url, false, $contextResouce);

	return $result;
}

//دالة حذف الرسائل JSON بإستخدام File_Get_Contents
function deleteSMS($jsonObj)
{

	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/deleteMsg.php";
	$result = file_get_contents($url, false, $contextResouce);

	return $result;
}

//دالة طلب إسم مرسل (جوال) JSON بإستخدام File_Get_Contents
function addSender($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/addSender.php";
	$result = file_get_contents($url, false, $contextResouce);

	return $result;
}

//دالة تفعيل إسم مرسل (جوال) JSON بإستخدام File_Get_Contents
function activeSender($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/activeSender.php";
	$result = file_get_contents($url, false, $contextResouce);

	return $result;
}

//دالة التحقق من حالة طلب إسم مرسل (جوال) JSON بإستخدام File_Get_Contents
function checkSender($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/checkSender.php";
	$result = file_get_contents($url, false, $contextResouce);

	return $result;
}

//دالة طلب إسم مرسل (أحرف)JSon  بإستخدام File_Get_Contents
function addAlphaSender($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/josn', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/addAlphaSender.php";
	$result = file_get_contents($url, false, $contextResouce);

	return $result;
}

//دالة التحقق من حالة طلب إسم مرسل (أحرف) Json بإستخدام File_Get_Contents
function checkAlphasSender($jsonObj)
{
	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/json', 'content'=> json_encode($jsonObj), 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.alfa-cell.com/api/checkAlphasSender.php";
	$result = file_get_contents($url, false, $contextResouce);

	return $result;
}
?>