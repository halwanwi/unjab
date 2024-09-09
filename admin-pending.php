<?php
require_once "koneksi_database.php";
session_start();

if (isset($_SESSION['login'])) {
    $login = true;
    $id = $_SESSION['id'];
    $nama = $_SESSION['nama'];
    $email = $_SESSION['email'];
    $status = $_SESSION['status'];
}

if (isset($_POST['terima'])) {
    $terima = $_POST['terima'];
    $id = $_POST['id'];
    mysqli_query($conn, "UPDATE data SET status='$terima' WHERE unik='$id'");
}
if (isset($_POST['tolak'])) {
    $tolak = $_POST['tolak'];
    $id = $_POST['id'];
    mysqli_query($conn, "UPDATE data SET status='$tolak' WHERE unik='$id'");
}



$ajuans = mysqli_query($conn, "SELECT * FROM data WHERE status='pending'");

$jumlah_pending = 0;
foreach ($ajuans as $key => $value) {
    if ($value['status'] == 'pending') {
        $jumlah_pending++;
    }
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/navigasi.css">
    <link rel="stylesheet" href="css/admin.css">

    <title>Admin</title>
</head>

<body>
    <halaman value="admin-pending"></halaman>
    <?php require 'navigasi.php'; ?>

    <h1>Status Pending</h1>
    <?php if ($jumlah_pending == 0) { echo "<h2 class='not-data-found'>Tidak ada data</h2>"; } ?>

    <main>
        <?php foreach ($ajuans as $i => $ajuan) { ?>

            <div class="ajuan <?= $ajuan['status'] ?>">
                <h2><?= ++$i ?></h2>
                <div class="info">
                    <div class="nama">
                        <p class="title">Nama<span>:</span></p>
                        <p class="value"><?= $ajuan['nama'] ?></p>
                    </div>
                    <div class="email">
                        <p class="title">Email<span>:</span></p>
                        <p class="value"><?= $ajuan['email'] ?></p>
                    </div>
                    <div class="nomer">
                        <p class="title">Nomer<span>:</span></p>
                        <p class="value"><?= $ajuan['nomer'] ?></p>
                    </div>
                    <div class="semester">
                        <p class="title">Semester<span>:</span></p>
                        <p class="value">semester <?= $ajuan['semester'] ?></p>
                    </div>
                    <div class="ipk">
                        <p class="title">IPK<span>:</span></p>
                        <p class="value"><?= $ajuan['ipk'] ?></p>
                    </div>
                    <div class="beasiswa">
                        <p class="title">Beasiswa<span>:</span></p>
                        <p class="value"><?= $ajuan['beasiswa'] ?></p>
                    </div>
                    <div class="berkas">
                        <?php $berkas = explode(" ", $ajuan['berkas']);
                        $berkas_link =  $berkas[0];
                        $berkas_name =  $berkas[1]; ?>
                        <p class="title">Berkas<span>:</span></p>
                        <p class="value"><a target="_blank" href=<?= $berkas_link ?>><?= $berkas_name ?></a></p>
                    </div>
                </div>
                <div class="status">
                    <form action="" method="post">
                        <input type="text" name="id" value=<?= $ajuan['unik'] ?> hidden>
                        <button type="submit" name="terima" value="terima" class="terima">Diterima</button>
                        <button type="submit" name="tolak" value="tolak" class="tolak">Ditolak</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </main>

    <script src="js/jquery.js"></script>
    <script src="js/navpos.js"></script>
</body>

</html>