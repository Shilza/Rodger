<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rodger</title>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/css/uikit.min.css"/>
    <link rel="stylesheet" href="{!! asset('css//welcome.css') !!}">

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/js/uikit-icons.min.js"></script>
</head>
<body>

<div class="welcome-rodger-container">
    <img class="main-rodger-img" src="{!! asset('images/rodger.png') !!}"/>
    <div style="text-align: center">
        <h1 style="font-weight: bold">Rodger</h1>
        <h3>Rival regions support robot</h3>
    </div>
    <p style="font-family: 'Source Code Pro', monospace">Description</p>
    <a href="{{ url('/login') }}" class="main-start-button">START</a>
</div>

@include('parts.capabilities')

@include('parts.support-info')

@include('parts.pricing')

<script src={!! asset('js/welcome.js') !!}></script>
</body>
</html>
