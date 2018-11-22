
function loginSocial(social) {
    const login = $('#login').val();
    const password = $('#password').val();

    $.ajax({
        type: "POST",
        url: 'http://127.0.0.1:8000/api/login',
        data: {login, password, social},
        success: data => $('body').html(data.html),
        fail: data => alert(data)
    });
}

