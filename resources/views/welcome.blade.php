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
    <link rel="stylesheet" href="{!! asset('css/welcome/card.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/welcome/pricing/pricing-card.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/welcome/pricing/pricing_button.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/welcome/pricing/pricing.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/welcome/capabilities/capabilities.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/welcome/support-info.css') !!}">

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/js/uikit-icons.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

<div class="capabilities-container">
    <div class="capabilities-container-title">
        <span class="capabilities-title">What I can do</span>
    </div>
    <div class="capabilities">
        <div class="capabilities-card">
            <img src="https://camouf.ru/upload/iblock/198/maket1_min.jpg" class="capabilities-card-img"/>
            <p style="font-weight: bold; font-size: 1.3em;">Header</p>
            <span>Description</span>
        </div>
        <div class="capabilities-card">
            <img src="https://camouf.ru/upload/iblock/198/maket1_min.jpg" class="capabilities-card-img"/>
            <p style="font-weight: bold; font-size: 1.3em;">Header</p>
            <span>Description</span>
        </div>
        <div class="capabilities-card">
            <img src="https://camouf.ru/upload/iblock/198/maket1_min.jpg" class="capabilities-card-img"/>
            <p style="font-weight: bold; font-size: 1.3em;">Header</p>
            <span>Description</span>
        </div>
        <div class="capabilities-card">
            <img src="https://camouf.ru/upload/iblock/198/maket1_min.jpg" class="capabilities-card-img"/>
            <p style="font-weight: bold; font-size: 1.3em;">Header</p>
            <span>Description</span>
        </div>
    </div>
</div>

<div class="support-info">
    <div class="support-info-card-wrapper info-gray">
        <h3 class="support-info-card-title">Cloud solution</h3>
        <div class="support-info-card">
            <img src="{!! asset('images/cloud.png') !!}"/>
            <span class="support-info-description">Description</span>
        </div>
    </div>

    <div class="support-info-card-wrapper info-red">
        <h3 class="support-info-card-title">Online support</h3>
        <div class="support-info-card">
            <img src="{!! asset('images/allday.png') !!}"/>
            <span class="support-info-description">Description</span>
        </div>
    </div>

    <div class="support-info-card-wrapper info-green">
        <h3 class="support-info-card-title">100% fault tolerancey</h3>
        <div class="support-info-card">
            <img src="{!! asset('images/support.png') !!}"/>
            <span class="support-info-description">Description</span>
        </div>
    </div>
</div>

{{--<div class="capabilities">--}}
{{--<div class="card uk-width-1-5">--}}
{{--<h3 class="card-title">Default</h3>--}}
{{--<p class="card-description">Lorem ipsum <a href="#">dolor</a> sit amet, consectetur adipiscing elit, sed do--}}
{{--eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
{{--</div>--}}
{{--<div class="card uk-width-1-5">--}}
{{--<h3 class="card-title">Default</h3>--}}
{{--<p class="card-description">Lorem ipsum <a href="#">dolor</a> sit amet, consectetur adipiscing elit, sed do--}}
{{--eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
{{--</div>--}}
{{--<div class="card uk-width-1-5">--}}
{{--<h3 class="card-title">Default</h3>--}}
{{--<p class="card-description">Lorem ipsum <a href="#">dolor</a> sit amet, consectetur adipiscing elit, sed do--}}
{{--eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
{{--</div>--}}
{{--</div>--}}

<div class="pricing-container">
    <div class="pricing-container-title">
        <h3 class="pricing-title">Pricing</h3>
    </div>
    <div class="pricing">
        <div class="white-pricing-card">
            <img src="{!! asset('images/kite.png') !!}">
            <span class="pricing-card-title">Noob</span>
            <span class="pricing-card-description">Description</span>
            <div class="pricing-card-includes-container">
                @component('components.pricing-includes')
                    {{ 'Includes' }}
                @endcomponent
            </div>
            <div class="pricing-card-splitter"></div>
            <div class="pricing-card-price-container">
                <span class="pricing-card-price">10$</span>
                <span>/ mounth</span>
            </div>
            <button class="fuller-button blue">Buy</button>
        </div>
        <div class="blue-pricing-card">
            <img src="{!! asset('images/paper-plane.png') !!}">
            <span class="pricing-card-title">Normal</span>
            <span class="pricing-card-description">Description</span>
            <div class="pricing-card-includes-container">
                @component('components.pricing-includes')
                    {{ 'Includes' }}
                @endcomponent
            </div>
            <div class="pricing-card-splitter"></div>
            <div class="pricing-card-price-container">
                <span class="pricing-card-price">10$</span>
                <span>/ mounth</span>
            </div>
            <button class="fuller-button white">Buy</button>
        </div>
        <div class="deep-blue-pricing-card">
            <img src="{!! asset('images/rocket.png') !!}">
            <span class="pricing-card-title" style="color: white">Hero</span>
            <span class="pricing-card-description">Description Descri ption Descri ption Descrip tion Descrip tion</span>
            <div class="pricing-card-includes-container">
                @component('components.pricing-includes')
                    {{ 'Includes' }}
                @endcomponent
                @component('components.pricing-includes')
                    {{ 'Includes' }}
                @endcomponent
                @component('components.pricing-includes')
                    {{ 'Includes' }}
                @endcomponent
            </div>
            <div class="pricing-card-splitter"></div>
            <div class="pricing-card-price-container">
                <span class="pricing-card-price">10$</span>
                <span>/ mounth</span>
            </div>
            <button class="fuller-button black">Buy</button>
        </div>
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
