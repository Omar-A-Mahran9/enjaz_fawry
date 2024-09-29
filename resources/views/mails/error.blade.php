<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
     <div style="text-align:center">
        <h1>Enjaz  fawry</h1>
        <p><b>date : </b> {{  date("Y-m-d") }}</p>
        <p><b>time : </b> {{  date("h:i:sa") }}</p>
        <p><b>environment : </b> {{ $data['environment'] }}</p>
        <p><b>exception id : </b> {{$data['issue_id']}}</p>
        <p><b>exception url : </b> {{$data['url']}}</p>
        <p><b>method : </b> {{$data['method']}}</p>
        <p><b>data : </b> {{ $data['data'] }}</p>
        <p><b>message : </b> {{$data['message']}}</p>
        <p><b>file : </b> {{$data['file']}}</p>
        <p><b>line : </b> {{$data['line']}}</p>
    </div>
</body>
</html>
