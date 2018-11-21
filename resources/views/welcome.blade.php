<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rodger</title>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/css/uikit.min.css"/>
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">



    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/js/uikit-icons.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<div class="uk-flex uk-flex-center uk-flex-middle" style="height: 100%">
    <div class="uk-card uk-card-default uk-card-body ">
        <div class="uk-flex uk-flex-right uk-flex-around">
            <div class="uk-flex uk-flex-column">
                <img src="{!! asset('rodger.png') !!}" class="login-logo" uk-tooltip="title: Hello,I'm Rodger!; pos: right">
                <h3 class="login-form-header">Login</h3>
            </div>
        </div>

        <form>
            <div class="uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: user; ratio: 0.7"></span>
                    <input class="uk-input uk-form-small" type="text" placeholder="Login">
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: lock; ratio: 0.7"></span>
                    <input class="uk-input uk-form-small" type="password"
                           placeholder="Password">
                </div>
            </div>
        </form>
        <div class="uk-flex uk-flex-center uk-flex-around">
            <button class="uk-icon-link uk-margin-small-right" id="facebook" uk-icon="facebook"></button>
            <button class="uk-icon-link uk-margin-small-right" id="google-plus" uk-icon="google-plus"></button>
            <button class="uk-icon-link uk-margin-small-right" id="vk" uk-icon="vimeo"></button>
        </div>

    </div>
</div>
</div>

<script src="{!! asset('js/app.js') !!}"></script>
</body>
</html>
