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

                <!-- Advanced login -->
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
                            <h5 class="content-group">Alteração de Senha <small class="display-block">Preencha todos os Campos</small></h5>
                        </div>

                        <div class="content-divider text-muted form-group"><span>Sua informações</span></div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback has-feedback-left">
                            <input type="text" name="email" class="form-control" placeholder="Seu email" {{ $email or old('email') }} required autofocus>
                            <div class="form-control-feedback">
                                <i class="icon-mention text-muted"></i>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback has-feedback-left">
                            <input type="password" name="password" class="form-control" placeholder="Senha">
                            <div class="form-control-feedback">
                                <i class="icon-user-lock text-muted"></i>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} has-feedback has-feedback-left">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Senha">
                            <div class="form-control-feedback">
                                <i class="icon-user-lock text-muted"></i>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <button type="submit" class="btn bg-teal btn-block btn-lg">Alterar Senha <i class="icon-circle-right2 position-right"></i></button>
                    </div>
                </form>
                <!-- /advanced login -->


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

<!-- Core JS files -->
<script type="text/javascript" src="{{ asset('backend/assets/js/plugins/loaders/pace.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/core/libraries/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/core/libraries/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/plugins/loaders/blockui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
<!-- /core JS files -->
</body>
</html>
