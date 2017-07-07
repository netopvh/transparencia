<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login do Sistema</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('backend/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/minified/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/minified/core.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/minified/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/minified/colors.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

</head>

<body class="login-container">

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('home') }}"><img src="" alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Password recovery -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                    {{ csrf_field() }}
                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
                            <h5 class="content-group">Recuperar Senha <small class="display-block">Informe o seu email abaixo para recuperar sua senha</small></h5>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                            <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="Seu email" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                            <div class="form-control-feedback">
                                <i class="icon-mail5 text-muted"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn bg-blue btn-block">Recuperar Senha <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>
                <!-- /password recovery -->


                <!-- Footer -->
                <div class="footer text-muted text-center">
                    &copy; 2017. <a href="#">Sistema Fiero - Todos os direitos reservados</a>
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

<script type="text/javascript" src="{{ asset('backend/assets/js/plugins/loaders/pace.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/core/libraries/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/core/libraries/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/plugins/loaders/blockui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
<!-- /core JS files -->

</body>
</html>

