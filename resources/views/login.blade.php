<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rodger</title>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/css/uikit.min.css"/>
    <link rel="stylesheet" href="{!! asset('css/welcome/general.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/welcome/login-form.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/welcome/toast.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/welcome/social.css') !!}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro" rel="stylesheet">

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/js/uikit-icons.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

@if ( $errors->count() > 0 )
    @foreach( $errors->all() as $message )
        @component('components.toast')
            {{ $message }}
        @endcomponent
    @endforeach
@endif

<div class="uk-flex uk-flex-center uk-flex-middle uk-flex-column parallax">

    <div class="uk-card uk-card-default uk-card-body">
        <div class="uk-flex uk-flex-right uk-flex-around">
            <div class="uk-flex uk-flex-column">
                <a href="{{ url('/') }}">
                    <img src="{!! asset('images/rodger.png') !!}" class="login-logo"
                         uk-tooltip="title: Hello,I'm Rodger!; pos: right">
                </a>
                <h3 class="login-form-header">Login</h3>
            </div>
        </div>

        <form>
            <div class="uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: user; ratio: 0.7"></span>
                    <input class="uk-input uk-form-small" id='login' type="text" placeholder="Login">
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: lock; ratio: 0.7"></span>
                    <input class="uk-input uk-form-small" id='password' type="password"
                           placeholder="Password">
                </div>
            </div>
        </form>
        <ul class="social-nav model-2">
            <li>
                <a class="facebook fa fa-facebook" onclick="loginSocial('Fb')"></a>
                <a class="google-plus fa fa-google-plus" onclick="loginSocial('G+')"></a>
                <a class="twitter fa fa-vk" onclick="loginSocial('VK')"></a>
            </li>
        </ul>
    </div>
</div>


<script src="{!! asset('js/login.js') !!}"></script>
<script src="{!! asset('js/toast.js') !!}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>
