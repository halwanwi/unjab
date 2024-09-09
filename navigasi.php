<nav>

    <div class="overlay-for-mobile">
        <div class="kampus">
            <img src="images/logo.png" alt="logo kampus">
            <h2>UNIVERSITAS<br>JAYA ABADI</h2>
        </div>
        <div class="menu-mobile"></div>
    </div>


    <div class="page">
        <?php if (isset($status) && $status == 'admin') { ?>
            <a href="admin-diterima.php" class="hal">Diterima</a>
            <a href="admin-ditolak.php" class="hal">Ditolak</a>
            <a href="admin-pending.php" class="hal">Pending</a>
        <?php } else { ?>
            <a href="index.php" class="hal">Beasiswa</a>
            <a href="pengajuan.php" class="hal">Pengajuan</a>
        <?php } ?>

        <?php if (!isset($login)) { ?>
            <a href="login.php">
                <div class="login">
                    <span>Login</span>
                    <img src="images/icon-profile.png" alt="profile-icon">
                </div>
            </a>
            <a href="register.php">
                <div class="register">
                    <span>Register</span>
                    <img src="images/icon-profile.png" alt="profile-icon">
                </div>
            </a>
        <?php }?>
        <?php if (isset($_SESSION['login'])) { ?>
            <a href="logout.php">
                <div class="logout">
                    <span>Logout</span>
                    <img src="images/icon-profile.png" alt="profile-icon">
                </div>
            </a>
        <?php } ?>
    </div>
</nav>