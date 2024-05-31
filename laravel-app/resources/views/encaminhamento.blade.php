<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encaminhamento</title>
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
        <h1>Encaminhamento</h1>
        <p>Nome do Paciente: {{ $paciente->name }}</p>
        <p>Email do Paciente: {{ $paciente->email }}</p>
        <p>CEP do Paciente: {{ $paciente->cep }}</p>
        <p>Descrição do encaminhamento...</p>
    </div>
</body>
</html>
