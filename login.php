<?php
require_once 'koneksi_database.php';
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $users = mysqli_query($conn,"SELECT * FROM user");

    foreach ($users as $i => $user) {
        if ($user['email'] == $email and $user['password'] == $password) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['status'] = $user['status'];
        }
    }

    if (!isset($_SESSION['login'])) {
        $pesan = "email atau password tidak ada yang cocok";
    }

}


if (isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
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

    <title>Login</title>
</head>

<body>
    <?php require 'navigasi.php' ?>
    <form action="" method="post">
        <div class="box">
            <h2>Login</h2>
            <section class="isian">
                <div class="email">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" placeholder="Alamat Email" required>
                </div>
                <div class="password">
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
            </section>

            <!-- pesan jika tidak berhasil login -->
            <?php if (isset($pesan)) { echo "<error>$pesan</error>"; } ?>

            <section class="tombol">
                <button type="submit" name="login" class="login">Login</button>
            </section>
            <a href="register.php" class="create-account">blom punya akun buat laah</a>
        </div>
    </form>

    <script src="js/jquery.js"></script>
    <script src="js/navpos.js"></script>
</body>

</html>