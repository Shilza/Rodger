<div class={!! $cardClass !!}>
    <img src="{!! asset($image) !!}">
    <span class="pricing-card-title">{!! $title !!}</span>
    <span class="pricing-card-description">{!! $description !!}</span>
    <div class="pricing-card-includes-container">
        @component('components.pricing.includes')
            {{ 'Includes' }}
        @endcomponent
    </div>
    <div class="pricing-card-splitter"></div>
    <div class="pricing-card-price-container">
        <span class="pricing-card-price">{!! $price !!}</span>
        <span>/ mounth</span>
    </div>

    @if(isset($button))
        <button
                class="fuller-button {!! $button !!}"
                uk-toggle="target: #modal-center-{!! $modalButton !!}"
        >
            Buy
        </button>
    @endif
</div>