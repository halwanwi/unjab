function showForm(e) {
    if ($('login').length) {
        $('form').addClass('show');
        $('form .beasiswa span').text(e);
        // $('form .beasiswa input').val(e);
        $('form .beasiswa input').attr('value', e);

        $('form .ipk input').attr('min', (e=='akademik') ? 3.8 : 3.0 );
    }
    else {
        window.location.assign('login.php');
    }
}

function hideForm() {
    $('form').removeClass('show');
}


$(document).click(function (e) {
    // kalau form lagi aktif dan yang dipencet adalah backgroundya
    if ($('form').hasClass('show') && e.target == $('form')[0]) {
        $('form .batal').click();
    }
});