<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atestado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Atestado</h1>
        <p>Nome do Paciente: {{ $paciente->name }}</p>
        <p>Email do Paciente: {{ $paciente->email }}</p>
        <p>CEP do Paciente: {{ $paciente->cep }}</p>
        <p>Descrição do atestado...</p>
    </div>
</body>
</html>
