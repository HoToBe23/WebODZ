$(document).ready(function () {
    $('#signup-form').submit(function () {
        $('.invalid-feedback').hide();

        var password = $('#password').val().trim();
        var passwordLenght = String(password).length;
        var repetedPassword = $('#repetedPassword').val();
        var email = $('#email').val();
        var result = true;

        if (password != repetedPassword) {
            $('#passwordMatchInvalid').show();
            result = false;
        }
        else if (passwordLenght < 8 || passwordLenght > 16) {
            $('#passwordLengthInvalid').show();
            result = false;
        }
        if (!validateEmail(email)) {
            $('#emailInvalid').show();
            result = false;
        }

        return result;
    });
});

function validateEmail($email) {
    const regex =
        /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test($email);
}