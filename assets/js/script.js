
$(document).ready(function() {
    $(document).on('click', '.confirm', function(e) {
        e.preventDefault();
        let text = $(this).data('confirm-text');

        let result = confirm(text);
        
        if (result) {
            window.location.href = $(this).attr('href');
        }
    });
});


