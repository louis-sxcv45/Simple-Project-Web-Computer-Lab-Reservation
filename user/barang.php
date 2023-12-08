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

                    <li class="nav-link">
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

                    <li class="nav-link active">
                        <a href="barang.php">
                            <i class='material-symbols-outlined icon'>add_to_queue</i>
                            <span class="text nav-text">Pinjam Alat</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="data_pinjam_barang.php">
                            <i class='bx bx-briefcase-alt-2 icon'></i>
                            <span class="text nav-text">Pinjam Alat</span>
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
    <div class="text-table">List Barang</div>
        <section class="table">
            <table class="content-table">
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Kode Barang</td>
                        <td>Nama Barang</td>
                        <td>Stok</td>
                    </tr>
                </thead>
                <td></td>
                <tbody>
                    <?php
                    include('../database/connect.php');
                    $sql = "SELECT * FROM barang";
                    $result = mysqli_query($conn, $sql);
                    $nomor = 1;
                    while ($ruang = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $nomor++; ?>
                            </td>
                            <td>
                                <?php echo $ruang["kode_barang"]; ?>
                            </td>
                            <td>
                                <?php echo $ruang["nama_barang"]; ?>
                            </td>
                            <td>
                                <?php echo $ruang["stok_barang"]; ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>


    <script src="../js/home.js"></script>
</body>

</html>