<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verifica tu registro</title>
</head>
<body>
    <h2>Hola, {{ $user->name }}</h2>
    <p>Gracias por registrarte al nuestro sistema académico</p>
    <p>No olvides de hacer tu verificación <a href="{{ route('user.verify', $user->id) }}">AQUÍ</a></p>
</body>
</html>