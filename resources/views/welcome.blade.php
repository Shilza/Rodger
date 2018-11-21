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

</head>
<body>

<div class="uk-flex uk-flex-center uk-flex-middle" style="height: 100%">
    <div class="uk-card uk-card-default uk-card-body ">
        <div class="uk-flex uk-flex-right uk-flex-around">
            <div class="uk-flex uk-flex-column">
                <img src="{!! asset('rodger.png') !!}" style="height:48px; width:48px" uk-tooltip="title: Hello,I'm Rodger!; pos: right">
                <h3 style="margin-top: 20%">Login</h3>
            </div>
        </div>

        <form>
            <div class="uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: user; ratio: 0.7"></span>
                    <input class="uk-input uk-form-small" id="form-stacked-text" type="text" placeholder="Login">
                </div>
            </div>

            <div class="uk-margin">
                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: lock; ratio: 0.7"></span>
                    <input class="uk-input uk-form-small" id="form-stacked-text" type="password"
                           placeholder="Password">
                </div>
            </div>
        </form>
        <div class="uk-flex uk-flex-center uk-flex-around">
            <button class="uk-icon-link uk-margin-small-right" uk-icon="facebook"></button>
            <button class="uk-icon-link uk-margin-small-right" uk-icon="google-plus"></button>
            <button class="uk-icon-link uk-margin-small-right" uk-icon="vimeo"></button>
        </div>

    </div>
</div>
</div>

</body>
</html>
