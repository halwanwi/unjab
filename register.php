<?php
require_once 'koneksi_database.php';
session_start();
if (isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}


if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "INSERT INTO `project_beasiswa`.`user` (`nama`, `email`, `password`) VALUES ('$nama', '$email', '$password')";
    try {
        mysqli_query($conn, $query);
        $sukses = 'akun berhasil terdaftar';
    } catch (\Throwable $th) {
        $pesan = strtolower($th->getMessage());
        if (str_contains($pesan, 'duplicate') and str_contains($pesan, 'email')) {
            $pesan_email_duplikat = 'email sudah terdaftar';
        }
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
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/registrasi.css">

    <title>Registrasi</title>
</head>
<body>
    <?php require 'navigasi.php' ?>
    <form action="" method="post">
        <div class="box">
            <h2>Registrasi</h2>
            <section class="isian">
                <div class="nama">
                    <label for="nama">Nama :</label>
                    <input type="text" name="nama" id="nama" placeholder="Nama Anda" required>
                </div>
                <div class="email">
                    <label for="email">Email :</label>
                    <?= (isset($pesan_email_duplikat)) ? "<error>$pesan_email_duplikat</error>" : '' ;?>
                    <input type="email" name="email" id="email" placeholder="Alamat Email" required>
                </div>
                <div class="password">
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
            </section>

            <section class="tombol">
                <button type="submit" name="register" class="registrasi">Registrasi</button>
            </section>
        </div>
    </form>


    <?php if (isset($sukses)) { ?>
            <div class="sukses" id="pesan"><?php echo $sukses ?></div>
    <?php }?>


    <script src="js/jquery.js"></script>
    <script src="js/register.js"></script>
    <script src="js/navpos.js"></script>
</body>
</html>