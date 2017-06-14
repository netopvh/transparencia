<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Escolha a Casa</title>
    <link rel="stylesheet" href="{{ asset('frontend/plugins/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/font-awesome/css/font-awesome.min.css') }}">
</head>
<body>
<div class="container">
    <div class="text-center">
        <h1>Selecione a Casa</h1>
        <div class="row">
            <div class="col-lg-offset-4 col-lg-4">
                <table class="table center">
                    <tr>
                        <td>
                            <a href="{{ route('senai.index') }}" class="btn btn-lg btn-primary">SENAI</a>
                        </td>
                        <td>
                            <a href="{{ route('sesi.index') }}" class="btn btn-lg btn-primary">SESI</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>