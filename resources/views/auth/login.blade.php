@extends('layouts.auth')
@section('htmlheader_extra')
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <style>
        .google-button {
            border: 2px solid transparent;
            padding: 8px 12px 8px 40px;
            font-family: 'Roboto', sans-serif;
            color: #ffffff;
            background: #4285F4 url('/img/g-logo.png');
            background-size: 18px 18px;
            background-position: 8px 8px;
            background-repeat: no-repeat;

        }
    </style>
@endsection
@section('htmlheader_title')
    Log in
@endsection

@section('content')
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/home') }}"><b>Teikos</b>CRM</a>
        </div><!-- /.login-logo -->

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Attenzione</strong> Ci sono problemi nei dati inseriti:<br/>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form action="{{ url('/login') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Email" name="email"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> Ricordami
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div><!-- /.col -->
                </div>
            </form>
            <div class=" text-center" style="margin-top: 20px;">
                <a href="{{ url('/linkGoogle') }}">
                    <button class="google-button">SIGN IN WITH GOOGLE</button>
                </a>
            </div><!-- /.social-auth-links -->
            </br>
            <a href="{{ url('/password/reset') }}">Hai dimenticato la password?</a><br>
        <!--a href="{{ url('/register') }}" class="text-center">Register a new membership</a-->

        </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->

    @include('layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    </body>

@endsection
