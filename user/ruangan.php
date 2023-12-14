<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/index.css">

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../img-2/logo.jpg" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">JOJO</span>
                    <span class="profession">University</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="../index.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link active">
                        <a href="ruangan.php">
                            <i class='material-symbols-outlined icon'>store</i>
                            <span class="text nav-text">Daftar Ruangan</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="data_pinjam_ruang.php">
                            <i class='material-symbols-outlined icon'>add_home_work</i>
                            <span class="text nav-text">Pinjam Ruang</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="barang.php">
                            <i class='material-symbols-outlined icon'>add_to_queue</i>
                            <span class="text nav-text">Daftar Barang</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="data_pinjam_barang.php">
                            <i class='bx bx-briefcase-alt-2 icon'></i>
                            <span class="text nav-text">Pinjam Barang</span>
                        </a>
                    </li>

                    <div class="bottom-content">
                        <li class="">
                            <a href="../logout.php">
                                <i class='bx bx-log-out icon'></i>
                                <span class="text nav-text">Logout</span>
                            </a>
                        </li>

                    </div>
            </div>
    </nav>

    <main class="home">
    <div class="top">
            <span class="text-top">JOJO University</span>
            <span class="material-symbols-outlined help">
                help
            </span>
            <span class="material-symbols-outlined">
                language
            </span>
        </div>
        <div class="text-table">
            List Ruangan
        </div>
        <section class="card-2">
            <?php
            include('../database/connect.php');
            $sql = "SELECT * FROM ruangan";
            $result = mysqli_query($conn, $sql);
            while ($room = mysqli_fetch_array($result)) {
            ?>
                <div class="card-room">
                    <div class="card-img">
                        <img src="../img/<?php echo $room['img'];?>" alt="img">
                    </div>
                    <div class="card-info">
                        <div class="card-text">
                            <p class="text-title"><?php echo $room['nama_ruangan'];?></p>
                            <p class="text-subtitle"><?php echo $room['kode_ruangan'];?></p>
                        </div>
                        <div class="card-icon" data-href="info-ruangan.php">
                            <span class="material-symbols-outlined icn">
                                arrow_right_alt
                            </span>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </section>
    </main>
    <script src="../js/home.js"></script>
</body>

</html>