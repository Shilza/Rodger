<div class="uk-flex uk-flex-column uk-flex-between uk-flex-middle" style="margin: 0 2% 0 2%;">
    <div class="modal-credentials-proxy">
        <form class="modal-pricing-form">
            <span class="uk-label uk-label" style="margin-bottom: 8%">Credentials</span>
            <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: user; ratio: 0.7"></span>
                <input class="uk-input uk-form-small" id='login' type="text" placeholder="Login">
            </div>

            <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: lock; ratio: 0.7"></span>
                <input class="uk-input uk-form-small" id='password' type="password"
                       placeholder="Password">
            </div>
            <select>
                <option>Facebook</option>
                <option>Google+</option>
                <option>VK</option>
            </select>
        </form>
        <form class="modal-pricing-form">
            <span class="uk-label uk-label" style="margin-bottom: 8%">Proxy</span>
            <div class="uk-grid-small uk-child-width-auto uk-grid" id="modal-proxy-checker-{!! $type !!}">
                <label><input class="uk-radio" type="radio" name="radio1" onclick="hideProxyInput('{!! $type !!}')"> IPv6</label>
                <label><input class="uk-radio" type="radio" name="radio1" onclick="hideProxyInput('{!! $type !!}')"> IPv4</label>
                <div class="uk-margin">
                    <label><input class="uk-radio" type="radio" name="radio1" onclick="showProxyInput('{!! $type !!}')"> Custom
                        proxy</label>
                    <div class="uk-inline uk-margin" id="modal-custom-proxy-input-{!! $type !!}" hidden>
                        <span class="uk-form-icon" uk-icon="icon: server; ratio: 0.7"></span>
                        <input class="uk-input uk-form-small" id='login' type="text" placeholder="Enter proxy address">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <button class="fuller-button black" style="padding: 0; width: 200px; height: 30px">Submit</button>
</div>