(function($) {
    "use strict"; // Start of use strict

    $('#password').passtrength({
        minChars: 8,
        passwordToggle: true,
        tooltip: true
    });

    $('#password').keyup(function() {
        // set password variable
        var pswd = $(this).val();

        // Validate letter.
        if (pswd.match(/[A-z]/)) {
            $('#letter').removeClass('invalid').addClass('valid');
        } else {
            $('#letter').removeClass('valid').addClass('invalid');
        }

        // Validate capital letter.
        if (pswd.match(/[A-Z]/)) {
            $('#capital').removeClass('invalid').addClass('valid');
        } else {
            $('#capital').removeClass('valid').addClass('invalid');
        }

        // Validate number.
        if (pswd.match(/\d/)) {
            $('#number').removeClass('invalid').addClass('valid');
        } else {
            $('#number').removeClass('valid').addClass('invalid');
        }

        // Validate the length.
        if (pswd.length < 8) {
            $('#length').removeClass('valid').addClass('invalid');
        } else {
            $('#length').removeClass('invalid').addClass('valid');
        }

        // If it has one special character.
        if (pswd.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
            $('#special').removeClass('invalid').addClass('valid');
        } else {
            $('#special').removeClass('valid').addClass('invalid');
        }

        if ($('#password').val() != $('#password_confirmation').val()) {
            $('.reply').html('no').css('color', 'red');
        }
    }).focus(function() {
        $('#pswd_info').removeClass('hidden');
    });

    $('#password_confirmation').keyup(function() {
        $('.msg-confirm-match').removeClass('hidden');

        if ($('#password').val() == $('#password_confirmation').val()) {
            $('.reply').html('yes').css('color', 'green');
        }
    });

})(jQuery); // End of use strict
