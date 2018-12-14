<div class="pricing-container">
    <div class="pricing-container-title">
        <h3 class="pricing-title">Pricing</h3>
    </div>
    <div class="pricing">
        @component('components.pricing.new')
            @slot('type')
                noob
            @endslot
        @endcomponent

        @component('components.pricing.new')
            @slot('type')
                normal
            @endslot
        @endcomponent

        @component('components.pricing.new')
            @slot('type')
                hero
            @endslot
        @endcomponent
    </div>
</div>

@component('components.pricing.modal')
    @slot('type')
        noob
    @endslot
@endcomponent

@component('components.pricing.modal')
    @slot('type')
        normal
    @endslot
@endcomponent

@component('components.pricing.modal')
    @slot('type')
        hero
    @endslot
@endcomponent