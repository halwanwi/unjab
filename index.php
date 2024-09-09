<?php
require_once 'koneksi_database.php';
session_start();

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








if (isset($_POST['daftar'])) {

    $ajuans = mysqli_query($conn, "SELECT * FROM data WHERE id='$id'");
    $jumlah_pending = 0;
    $jumlah_diterima = 0;
    $jumlah_ditolak = 0;
    foreach ($ajuans as $key => $value) {
        if ($value['status'] == 'pending') {
            $jumlah_pending++;
        } elseif ($value['status'] == 'terima') {
            $jumlah_diterima++;
        } elseif ($value['status'] == 'tolak') {
            $jumlah_ditolak++;
        }
    }

    if ($jumlah_diterima or $jumlah_pending) {
        if ($jumlah_diterima) { $sukses = "Anda tidak dapat mendaftar jika sudah dapat Beasiswa";}
        if ($jumlah_pending) { $sukses = "Masih menunggu konfirmasi pengajuan sebelumnya"; }
        $sukses_warna = 'warning';
    }
    else {
        // MENANGANI FILE
        $dir_berkas = "berkas/" . str_replace(' ', '_', $nama) . '/';
        $filename = time() . '_' . $_FILES['berkas']['name'];
        $nama_berkas = $dir_berkas . $filename;
        // membuat folder baru jika belum ada
        if (!is_dir($dir_berkas)) {
            mkdir($dir_berkas, 0755, true);
        }
        if (!file_exists($nama_berkas)) {
            move_uploaded_file($_FILES['berkas']['tmp_name'], $nama_berkas);
        }

        $ipk = $_POST['ipk'];
        $nomer = $_POST['nomer'];
        $semester = $_POST['semester'];
        $beasiswa = $_POST['beasiswa'];
        $berkas = $nama_berkas . ' ' . $filename;

        // kalo user ga upload file jangan sertakan berkas, berkas akan diisi oleh default yang disetting di database
        if ($_FILES['berkas']['tmp_name']) {
            $query = "INSERT INTO `project_beasiswa`.`data` (`id`, `nama`, `email`, `nomer`, `semester`, `ipk`, `beasiswa`, `berkas`) VALUES ('$id', '$nama', '$email', '$nomer', '$semester', '$ipk', '$beasiswa', '$berkas')";
        }
        else {
            $query = "INSERT INTO `project_beasiswa`.`data` (`id`, `nama`, `email`, `nomer`, `semester`, `ipk`, `beasiswa`) VALUES ('$id', '$nama', '$email', '$nomer', '$semester', '$ipk', '$beasiswa')";
        }

        try {
            mysqli_query($conn, $query);
            $sukses = 'berhasil mengajukan beasiswa';
        } catch (\Throwable $th) {
            $sukses = strtolower($th->getMessage());
        }

        $sukses_warna = 'sukses';
    }
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/navigasi.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Beasiswa Menu</title>
</head>

<body>
    <halaman value="beranda"></halaman>
    <?php if (isset($login)) {
        echo "<login></login>";
    } ?>
    <?php require 'navigasi.php' 
    ?>



    <main>
        <div class="kontener akademik" id="akademik" onclick="showForm(this.id)">
            <div class="beasiswa">
                <div class="icon"></div>
                <!-- <img src="images/icon-beasiswa-akademik.png" alt="akademik"> -->
                <h3>Beasiswa Akademik</h3>
                <ul>
                    <li>Mahasiswa semester 1 - 8</li>
                    <li>Minimal IPK 3.8</li>
                </ul>

                <button id="akademik">Daftar</button>
            </div>
            <div class="alas">
                <?php require "images/alas.html" ?>
            </div>
        </div>

        <div class="kontener non-akademik" id="non-akademik" onclick="showForm(this.id)">
            <div class="beasiswa ">
                <div class="icon"></div>
                <!-- <img src="images/icon-beasiswa-non-akademik.png" alt="non-akademik"> -->
                <h3>Beasiswa Non-akademik</h3>
                <ul>
                    <li>Mahasiswa semester 1 - 8</li>
                    <li>Minimal IPK 3.0</li>
                    <li>Memiliki sertifikat kompetensi</li>
                </ul>

                <button id="non-akademik">Daftar</button>
            </div>
            <div class="alas">
                <?php require "images/alas.html" ?>
            </div>
        </div>

    </main>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="box">
            <h2>Daftar Beasiswa</h2>
            <section class="isian">
                <?php if (isset($id)) {
                    echo "<input type='number' name='id' id='id' value=$id required disabled hidden>";
                } ?>
                <div class="beasiswa">
                    <span></span>
                    <input type="text" name="beasiswa" hidden required>
                </div>
                <div class="nama">
                    <label for="nama">Nama :</label>
                    <?php if (isset($nama)) {
                        echo "<input type='text' name='nama' id='nama' value=$nama required disabled>";
                    } ?>
                    <!-- <input type="text" name="nama" id="nama" placeholder="Nama Anda" required> -->
                </div>
                <div class="email">
                    <label for="email">Email :</label>
                    <?php if (isset($nama)) {
                        echo "<input type='email' name='email' id='email' value=$email required disabled>";
                    } ?>
                    <!-- <input type="email" name="email" id="email" placeholder="Alamat Email" required> -->
                </div>
                <div class="nomer">
                    <label for="nomer">Nomer Telp/HP :</label>
                    <input type="number" name="nomer" id="nomer" placeholder="08191234XXXX" required>
                </div>
                <div class="semester">
                    <label for="semester">Semester Saat Ini :</label>
                    <select name="semester" id="semester">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                </div>
                <div class="ipk">
                    <label for="ipk">IPK :</label>
                    <input type="number" name="ipk" step="0.01" max="4" id="ipk" placeholder="3.8" required>
                </div>
                <div class="berkas">
                    <label for="berkas">Upload Berkas Syarat :</label>
                    <input type="file" name="berkas" id="berkas">
                </div>
            </section>

            <section class="tombol">
                <button type="submit" class="daftar" name="daftar">daftar</button>
                <button type="reset" class="batal" onclick="hideForm()">batal</button>
            </section>
        </div>
    </form>


    <?php if (isset($sukses)) { ?>
        <div class=<?= $sukses_warna ?> id="pesan"><?php echo $sukses ?></div>
    <?php } ?>

    <script src="js/jquery.js"></script>
    <script src="js/navpos.js"></script>
    <script src="js/script.js"></script>

    <!-- buat ngambil fungsi nampilin pesan lalu menghilangkanya setelah beberapa detik -->
    <script src="js/register.js"></script>
</body>

</html>