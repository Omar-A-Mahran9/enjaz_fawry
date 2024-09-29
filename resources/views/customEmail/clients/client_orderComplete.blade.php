<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>انجاز فوري</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">	
		<tr>
			<td style="padding: 10px 0 30px 0;">
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
					<tr>
						<td align="center" bgcolor="#f2f2f2" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                        	<a target="_blank" href="https://enjaz-fawry.com/"><img src="{{ asset('images')}}/logo.png" alt="منصة انجاز فوري" style="display: block;" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;text-align:center">
                                        <p>مرحبا : {{ $name }}</p>
                                        <b style="color:#3CBFAF;">تم انجاز طلبك رقم : {{ $order_no }}</b>
										<p>يرجى تسجيل الدخول بحسابك لتقييم الطلب وتحميل الفاتورة</p>
									</td>
								</tr>
								<tr>
									<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;text-align:center">
										للدخول المباشر على الطلب يرجى الضغط على الرابط التالي 
										<br>
										<br>
                                        @if($type == 'mo3amla')
                                            <a  target="_blank" href="{{ url('client_panel/mo3amla') }}/{{ $id }}">الدخول على الطلب</a>
                                        @elseif($type == 'estfsar')
                                            <a  target="_blank" href="{{ url('client_panel/estfsar') }}/{{ $id }}">الدخول على الطلب</a>
                                        @elseif($type == 'ta3med')
                                            <a  target="_blank" href="{{ url('client_panel/ta3med') }}/{{ $id }}">الدخول على الطلب</a>
                                        @endif

                                    </td>
								</tr>
								
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#3CBFAF" style="padding: 30px 30px 30px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr align="center">
									<td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;text-align:center" width="100%">
									    <span style="text-align:rightl">	&reg; جميع الحقوق محفوظة - <a href="https://enjaz-fawry.com">انجاز فوري</a></span><br/>
									</td>

								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>