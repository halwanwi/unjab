<?php

use function PHPSTORM_META\type;

require_once 'koneksi_database.php';
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}

if (isset($_SESSION['login'])) {
    $login = true;
    $id = $_SESSION['id'];
    $nama = $_SESSION['nama'];
    $email = $_SESSION['email'];
    $status = $_SESSION['status'];
    
    if ($status == 'admin') {
        header('Location: admin-pending.php');
        exit();
    }
}

$ajuans = mysqli_query($conn, "SELECT * FROM data WHERE id='$id' ORDER BY unik DESC");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/navigasi.css">
    <link rel="stylesheet" href="css/pengajuan.css">

    <title>Pengajuan</title>
</head>

<body>
    <halaman value="pengajuan"></halaman>
    <?php require 'navigasi.php'; ?>

    <main>
        <?php foreach ($ajuans as $ajuan) { ?>

            <div class="ajuan <?= $ajuan['status'] ?>">
                <h2><?= $ajuan['beasiswa'] ?></h2>
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
                    <div class="berkas">
                        <?php $berkas = explode(" ", $ajuan['berkas']); $berkas_link =  $berkas[0]; $berkas_name =  $berkas[1]; ?>
                        <p class="title">Berkas<span>:</span></p>
                        <p class="value"><a target="_blank" href=<?= $berkas_link ?>><?= $berkas_name ?></a></p>
                    </div>
                </div>
                <div class="status">
                    <button disabled="disabled"><?= $ajuan['status'] ?></button>
                </div>
            </div>
        <?php } ?>
    </main>


    <script src="js/jquery.js"></script>
    <script src="js/navpos.js"></script>
</body>

</html>