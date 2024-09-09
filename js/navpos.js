$(document).ready(function () {
    if ($('halaman').attr('value') == 'admin-pending') {
        $('nav .page a[href="admin-pending.php"]').addClass('aktif');
    }
    if ($('halaman').attr('value') == 'admin-diterima') {
        $('nav .page a[href="admin-diterima.php"]').addClass('aktif');
    }
    if ($('halaman').attr('value') == 'admin-ditolak') {
        $('nav .page a[href="admin-ditolak.php"]').addClass('aktif');
    }

    if ($('halaman').attr('value') == 'beranda') {
        $('nav .page a[href="index.php"]').addClass('aktif');
    }
    if ($('halaman').attr('value') == 'pengajuan') {
        $('nav .page a[href="pengajuan.php"]').addClass('aktif');
    }
});

$('.menu-mobile').click(function (e) {
    $('.overlay-for-mobile').toggleClass('aktif');
});
