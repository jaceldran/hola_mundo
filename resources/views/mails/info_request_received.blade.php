<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Solicitud Recibida</title>
</head>
<body>
	<h1>Solicitud recibida</h1>

    @foreach($info_request['values'] as $key => $value)
        <p><b>{{$key}}</b><br> {{$value}}</p>
    @endforeach

</body>

</html>