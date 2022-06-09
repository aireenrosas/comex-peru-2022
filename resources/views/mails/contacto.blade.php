<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<p><strong>Nombre de contacto: </strong>{!! $nombre !!}</p>
<p><strong>Email: </strong>{!! $email !!}</p>
<p><strong>Teléfono: </strong>{!! $telefono !!}</p>
<p><strong>Empresa: </strong>{!! $empresa !!}</p>
<p><strong>Mensaje: </strong>{!! $mensaje !!}</p>
@if($autoriza==0)
<p><strong>Autoriza publicar fotos: </strong> No</p>
@else
<p><strong>Autoriza publicar fotos: </strong> Sí</p>
@endif
</body>
</html>
