$(document).ready(function () {
    baseUrl = $('input[name="baseUrl"]').val();
    $(document).on('submit', 'form#registerForm', function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: new FormData($('#registerForm')[0]),
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response == 'success') {
                    $('.defaultAlert').html('');
                    $('.defaultAlert').css('display', 'none');
                    window.location.href = baseUrl + "home";
                } else {
                    $('.defaultAlert').html(response);
                    $('.defaultAlert').css('display', 'block');
                }
            }
        });
    });

    $(document).on('submit', 'form#loginForm', function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: new FormData($('#loginForm')[0]),
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response == 'success') {
                    $('.defaultAlert').html('');
                    $('.defaultAlert').css('display', 'none');
                    window.location.href = baseUrl + "home";
                } else {
                    $('.defaultAlert').html(response);
                    $('.defaultAlert').css('display', 'block');
                }
            }
        });
    });
});