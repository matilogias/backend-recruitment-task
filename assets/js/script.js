
$(document).ready(function() {
    $(document).on('click', '.confirm', function(e) {
        e.preventDefault();
        let text = $(this).data('confirm-text');

        let result = confirm(text);
        
        if (result) {
            window.location.href = $(this).attr('href');
        }
    });
    //live email validation
    $(document).on('keyup', '.email-validate', function(e) {
        //check if email is in correct format
        let email = $(this).val();
        
        if (email.length > 0) {
            let result = validateEmail(email);
            if (result) {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            } else {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            }
        }else if ($(this).attr('required')) {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
        }
        else {
            $(this).removeClass('is-valid');
            $(this).removeClass('is-invalid');
        }
    });
    //on required (by required attribute) field excepr .email-validate add is-valid class if not empty and add is-invalid if empty
    $(document).on('keyup', 'input[required]:not(.email-validate)', function(e) {
        let value = $(this).val().trim();
        if (value.length > 0) {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        } else {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
        }
    });
});
function validateEmail(email) {
    let regex = /\S+@\S+\.\S+/;
    return regex.test(email);
}

