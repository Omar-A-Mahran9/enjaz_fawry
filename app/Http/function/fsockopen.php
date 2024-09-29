<?php
//دالة فحص  حالة الإرسال بإستخدام fsockopen
function sendStatus($viewResult=1)
{
	$fsockParameter = "POST /api/sendStatus.php?returnJson=1 HTTP/1.0\r\n";
	$fsockParameter.= "Host: www.alfa-cell.com \r\n";
	$fsockParameter.= "Content-type: application/x-www-form-urlencoded \r\n";
	$fsockParameter.= "Content-length: 0 \r\n\r\n";

	$fsockConn = fsockopen("www.alfa-cell.com", 80, $errno, $errstr, 10);
	fputs($fsockConn,$fsockParameter);
	
	$result = ""; 
	$clearResult = false; 
	
	while(!feof($fsockConn))
	{
		$line = fgets($fsockConn, 10240);
		if($line == "\r\n" && !$clearResult)
		$clearResult = true;
		
		if($clearResult)
			$result .= trim($line); 
	}
    return $result;
}

//دالة تغيير كلمة المرور لحساب الإرسال في موقع ألفا سيل JSON بإستخدام fsockopen
function changePassword($jsonObj)
{
    $jsonObj=json_encode($jsonObj);
	$stringToPostLength = strlen($jsonObj);
	$fsockParameter = "POST /api/changePassword.php HTTP/1.0\r\n";
	$fsockParameter.= "Host: www.alfa-cell.com \r\n";
	$fsockParameter.= "Content-type: application/json \r\n";
	$fsockParameter.= "Content-length: $stringToPostLength \r\n\r\n";
	$fsockParameter.= "$jsonObj";
	
	$fsockConn = fsockopen("www.alfa-cell.com", 80, $errno, $errstr, 10);
	fputs($fsockConn,$fsockParameter);
	
	$result = "";
	$clearResult = false;
	while(!feof($fsockConn))
	{
		$line = fgets($fsockConn, 10240);
		if($line == "\r\n" && !$clearResult)
		$clearResult = true;

		if($clearResult)
			$result .= trim($line);
	}
    return $result;
}

//دالة إسترجاع كلمة المرور لحساب الإرسال في موقع ألفا سيل بإستخدام fsockopen
function forgetPassword($jsonObj)
{
    $jsonObj=json_encode($jsonObj);
    $stringToPostLength = strlen($jsonObj);
    $fsockParameter = "POST /api/forgetPassword.php HTTP/1.0\r\n";
    $fsockParameter.= "Host: www.alfa-cell.com \r\n";
    $fsockParameter.= "Content-type: application/json \r\n";
    $fsockParameter.= "Content-length: $stringToPostLength \r\n\r\n";
    $fsockParameter.= "$jsonObj";
	
    $fsockConn = fsockopen("www.alfa-cell.com", 80, $errno, $errstr, 10);
    fputs($fsockConn,$fsockParameter);
	
    $result = "";
    $clearResult = false;
    while(!feof($fsockConn))
    {
        $line = fgets($fsockConn, 10240);
        if($line == "\r\n" && !$clearResult)
            $clearResult = true;

        if($clearResult)
            $result .= trim($line);
    }
    return $result;
}

//دالة عرض الرصيد JSON بإستخدام fsockopen
function balanceSMS($jsonObj){
    $jsonObj=json_encode($jsonObj);
	$stringToPostLength = strlen($jsonObj);
	$fsockParameter = "POST /api/balance.php HTTP/1.0\r\n";
	$fsockParameter.= "Host: www.alfa-cell.com \r\n";
	$fsockParameter.= "Content-type: application/json \r\n";
	$fsockParameter.= "Content-length: $stringToPostLength \r\n\r\n";
	$fsockParameter.= "$jsonObj";
	
	$fsockConn = fsockopen("www.alfa-cell.com", 80, $errno, $errstr, 10);
	fputs($fsockConn,$fsockParameter);
	
	$result = "";
	$clearResult = false;
	while(!feof($fsockConn))
	{
		$line = fgets($fsockConn, 10240);
		if($line == "\r\n" && !$clearResult)
		$clearResult = true;

		if($clearResult)
			$result .= trim($line);
	}
    return $result;
}

//دالة الإرسال JSON بإستخدام fsockopen
function sendSMS($jsonObj){
    $jsonObj=json_encode($jsonObj);
    $stringToPostLength = strlen($jsonObj);
    $fsockParameter = "POST /api/msgSend.php HTTP/1.0\r\n";
    $fsockParameter.= "Host: www.alfa-cell.com \r\n";
    $fsockParameter.= "Content-type: application/json \r\n";
    $fsockParameter.= "Content-length: $stringToPostLength \r\n\r\n";
    $fsockParameter.= "$jsonObj";
	
    $fsockConn = fsockopen("www.alfa-cell.com", 80, $errno, $errstr, 10);
    fputs($fsockConn, $fsockParameter);
	
    $result = "";
    $clearResult = false;
    while(!feof($fsockConn))
    {
        $line = fgets($fsockConn, 10240);
        if($line == "\r\n" && !$clearResult)
            $clearResult = true;

        if($clearResult)
            $result .= trim($line);
    }
    return $result;
}

//دالة قالب الإرسال JSON بإستخدام fsockopen
function sendSMSWK($jsonObj)
{
    $jsonObj=json_encode($jsonObj);
	$stringToPostLength = strlen($jsonObj);
	$fsockParameter = "POST /api/msgSendWK.php HTTP/1.0\r\n";
	$fsockParameter.= "Host: www.alfa-cell.com \r\n";
	$fsockParameter.= "Content-type: application/json \r\n";
	$fsockParameter.= "Content-length: $stringToPostLength \r\n\r\n";
	$fsockParameter.= "$jsonObj";
	
    $fsockConn = fsockopen("www.alfa-cell.com", 80, $errno, $errstr, 10);
	fputs($fsockConn, $fsockParameter);
	
	$result = "";
	$clearResult = false;
	while(!feof($fsockConn))
	{
		$line = fgets($fsockConn, 10240);
		if($line == "\r\n" && !$clearResult)
		$clearResult = true;
		if($clearResult)
			$result .= trim($line);
	}
    return $result;
}

//دالة حذف الرسائل المجدولة بإستخدام fsockopen
function deleteSMS($jsonObj)
{
	$jsonObj=json_encode($jsonObj);
	$stringToPostLength = strlen($jsonObj);
	$fsockParameter = "POST /api/deleteMsg.php HTTP/1.0\r\n";
	$fsockParameter.= "Host: www.alfa-cell.com \r\n";
	$fsockParameter.= "Content-type: application/json \r\n";
	$fsockParameter.= "Content-length: $stringToPostLength \r\n\r\n";
	$fsockParameter.= "$jsonObj";

	$fsockConn = fsockopen("www.alfa-cell.com", 80, $errno, $errstr, 10);
	fputs($fsockConn,$fsockParameter);

	$result = "";
	$clearResult = false;
	while(!feof($fsockConn))
	{
		$line = fgets($fsockConn, 10240);
		if($line == "\r\n" && !$clearResult)
		$clearResult = true;
		if($clearResult)
			$result .= trim($line);
	}
    return $result;
}

//دالة طلب إسم مرسل (جوال) بإستخدام fsockopen
function addSender($jsonObj)
{
    $jsonObj=json_encode($jsonObj);
	$stringToPostLength = strlen($jsonObj);
	$fsockParameter = "POST /api/addSender.php HTTP/1.0\r\n";
	$fsockParameter.= "Host: www.alfa-cell.com \r\n";
	$fsockParameter.= "Content-type: application/json \r\n";
	$fsockParameter.= "Content-length: $stringToPostLength \r\n\r\n";
	$fsockParameter.= "$jsonObj";

	$fsockConn = fsockopen("www.alfa-cell.com", 80, $errno, $errstr, 10);
	fputs($fsockConn,$fsockParameter);

	$result = "";
	$clearResult = false;
	while(!feof($fsockConn))
	{
		$line = fgets($fsockConn, 10240);
		if($line == "\r\n" && !$clearResult)
		$clearResult = true;

		if($clearResult)
			$result .= trim($line);
	}
    return $result;
}

//دالة تفعيل إسم مرسل (جوال) بإستخدام fsockopen
function activeSender($jsonObj)
{
    $jsonObj=json_encode($jsonObj);
	$stringToPostLength = strlen($jsonObj);
	$fsockParameter = "POST /api/activeSender.php HTTP/1.0\r\n";
	$fsockParameter.= "Host: www.alfa-cell.com \r\n";
	$fsockParameter.= "Content-type: application/json \r\n";
	$fsockParameter.= "Content-length: $stringToPostLength \r\n\r\n";
	$fsockParameter.= "$jsonObj";

	$fsockConn = fsockopen("www.alfa-cell.com", 80, $errno, $errstr, 10);
	fputs($fsockConn,$fsockParameter);

	$result = "";
	$clearResult = false;
	while(!feof($fsockConn))
	{
		$line = fgets($fsockConn, 10240);
		if($line == "\r\n" && !$clearResult)
		$clearResult = true;
		if($clearResult)
			$result .= trim($line);
	}
    return $result;
}

//دالة التحقق من حالة طلب إسم مرسل (جوال) بإستخدام fsockopen
function checkSender($jsonObj)
{
    $jsonObj=json_encode($jsonObj);
	$stringToPostLength = strlen($jsonObj);
	$fsockParameter = "POST /api/checkSender.php HTTP/1.0\r\n";
	$fsockParameter.= "Host: www.alfa-cell.com \r\n";
	$fsockParameter.= "Content-type: application/json \r\n";
	$fsockParameter.= "Content-length: $stringToPostLength \r\n\r\n";
	$fsockParameter.= "$jsonObj";

	$fsockConn = fsockopen("www.alfa-cell.com", 80, $errno, $errstr, 10);
	fputs($fsockConn,$fsockParameter);

	$result = "";
	$clearResult = false;
	while(!feof($fsockConn))
	{
		$line = fgets($fsockConn, 10240);
		if($line == "\r\n" && !$clearResult)
		$clearResult = true;

		if($clearResult)
			$result .= trim($line);
	}
    return $result;
}

//دالة طلب إسم مرسل (أحرف) بإستخدام fsockopen
function addAlphaSender($jsonObj)
{
    $jsonObj=json_encode($jsonObj);
	$stringToPostLength = strlen($jsonObj);
	$fsockParameter = "POST /api/addAlphaSender.php HTTP/1.0\r\n";
	$fsockParameter.= "Host: www.alfa-cell.com \r\n";
	$fsockParameter.= "Content-type: application/json \r\n";
	$fsockParameter.= "Content-length: $stringToPostLength \r\n\r\n";
	$fsockParameter.= "$jsonObj";

	$fsockConn = fsockopen("www.alfa-cell.com", 80, $errno, $errstr, 10);
	fputs($fsockConn,$fsockParameter);

	$result = "";
	$clearResult = false;
	while(!feof($fsockConn))
	{
		$line = fgets($fsockConn, 10240);
		if($line == "\r\n" && !$clearResult)
		$clearResult = true;
		if($clearResult)
			$result .= trim($line);
	}
    return $result;
}

//دالة التحقق من حالة طلب إسم مرسل (أحرف) بإستخدام fsockopen
function checkAlphasSender($jsonObj)
{
    $jsonObj= json_encode($jsonObj);
	$stringToPostLength = strlen($jsonObj);
        $fsockParameter = "POST /api/checkAlphasSender.php HTTP/1.0\r\n";
	$fsockParameter.= "Host: www.alfa-cell.com \r\n";
	$fsockParameter.= "Content-type: application/json \r\n";
	$fsockParameter.= "Content-length: $stringToPostLength \r\n\r\n";
	$fsockParameter.= "$jsonObj";

	$fsockConn = fsockopen("www.alfa-cell.com", 80, $errno, $errstr, 10);
	fputs($fsockConn,$fsockParameter);

	$result = "";
	$clearResult = false;
	while(!feof($fsockConn))
	{
		$line = fgets($fsockConn, 10240);
		if($line == "\r\n" && !$clearResult)
		$clearResult = true;

		if($clearResult)
			$result .= trim($line);
	}
    return $result;
}
?>