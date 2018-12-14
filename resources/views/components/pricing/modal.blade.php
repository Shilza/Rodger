<div id="modal-center-{!! $type !!}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical" style="background: #33363d;">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <p style="text-align: center; font-weight: bold; color: white; font-size: 1.5em">Buying</p>

        <div class="modal-pricing">
            @switch($type)
                @case('noob')
                @component('components.pricing.card')
                    @slot('cardClass')
                        white-pricing-card
                    @endslot
                    @slot('image')
                        images/kite.png
                    @endslot
                    @slot('title')
                        Noob
                    @endslot
                    @slot('description')
                        Description
                    @endslot
                    @slot('price')
                        10$
                    @endslot
                @endcomponent
                @break

                @case('normal')
                @component('components.pricing.card')
                    @slot('cardClass')
                        blue-pricing-card
                    @endslot
                    @slot('image')
                        images/paper-plane.png
                    @endslot
                    @slot('title')
                        Normal
                    @endslot
                    @slot('description')
                        Description
                    @endslot
                    @slot('price')
                        10$
                    @endslot
                @endcomponent
                @break

                @case('hero')
                @component('components.pricing.card')
                    @slot('cardClass')
                        deep-blue-pricing-card
                    @endslot
                    @slot('image')
                        images/rocket.png
                    @endslot
                    @slot('title')
                        Hero
                    @endslot
                    @slot('description')
                        Description
                    @endslot
                    @slot('price')
                        10$
                    @endslot
                @endcomponent
                @break
            @endswitch

            @include('parts.modal-main', ['type' => $type])
        </div>
    </div>
</div>