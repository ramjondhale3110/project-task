$(document).ready(function () {
    $(document).on('submit', 'form#registerForm', function (event) {
        event.preventDefault();
        // let fullNameInput = $('input[name="fullNameInput"]').val();
        // let emailInput = $('input[name="emailInput"]').val();
        // let passwordInput = $('input[name="passwordInput"]').val();
        // let profile = $('input[name="profile"]').val();

        // var fullNameReg = new RegExp("^[A-Za-z\s]{3,}[\ .]{0,1}[A-Za-z\s]{0,}$");
        // if (!fullNameInput.match(fullNameReg)) {
        //     alert('full name wrong formt !!');
        //     return false;
        // }

        // var passwordReg = new RegExp('^[A-Za-z\s]{5,10}$');
        // if (!passwordInput.match(passwordReg)) {
        //     alert('password must be strong !!');
        //     return false;
        // }

        // let profileArray = profile.split('.');
        // let extArray = ['jpg', 'png', 'jpeg'];
        // let fileExt = profileArray.slice(-1)[0];
        // if ($.inArray(fileExt, extArray) == -1) {
        //     alert("This type of profile not allowed !!!");
        //     return false;
        // }


        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: new FormData($('#registerForm')[0]),
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
            }
        });
    });
});