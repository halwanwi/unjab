$(document).ready(function () {
    if ($('#pesan').length) {
        $('#pesan').addClass('show');

        setTimeout(() => {
            $('#pesan').removeClass('show');
        }, 2000);
    }
});