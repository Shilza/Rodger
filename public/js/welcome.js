function showProxyInput(type) {
    const input = document.getElementById("modal-custom-proxy-input-" + type);
    if (input.hidden)
        input.hidden = false;
}

function hideProxyInput(type) {
    const input = document.getElementById("modal-custom-proxy-input-" + type);
    if (!input.hidden)
        input.hidden = true;
}