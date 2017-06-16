<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<h3>Contato via SAC</h3>
<br><br>
Atenção, Foi registrado um novo SAC para a casa {{ $casa }}
<br><br>
<b>Solicitante:</b> {{ $nome }} <br>
<b>Email:</b> {{ $email }} <br>
@if($empresa)
<b>Empresa:</b> {{ $empresa }} <br>
@endif
<b>Telefone:</b> {{ $telefone }} <br>
<b>Estado:</b> {{ $estado==1?'RO':'' }} <br>
<b>Cidade:</b> {{ $cidade }} <br>
<b>Assunto:</b> {{ $assunto }} <br>
<b>Categoria:</b> {{ $categoria }} <br>
<b>Mensagem:</b> {{ $mensagem }} <br><br><br>

Atenciosamente, <br><br>

<b>Sistema de Transparência FIERO.</b>

</body>
</html>