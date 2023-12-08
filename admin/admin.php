
<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location:login.php");
    exit();
}
include('../database/connect.php');

$query = "SELECT COUNT(*) as total_barang FROM barang";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $totalbarang = $row['total_barang'];
} else {
    $totalbarang = 0;
}

$query = "SELECT COUNT(*) as total_ruangan FROM ruangan";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $totalRuangan = $row['total_ruangan'];
} else {
    $totalRuangan = 0;
}

$queryUser = "SELECT COUNT(*) as total_user FROM users";
$resultUser = $conn->query($queryUser);

if ($resultUser) {
    $rowUser = $resultUser->fetch_assoc();
    $totalUser = $rowUser['total_user'];
} else {
    $totalUser = 0;
}

$queryRuang = "SELECT COUNT(*) as total_ruang FROM peminjaman_ruangan";
$totalRuang = $conn->query($queryRuang);

if ($totalRuang) {
    $rowRuang = $totalRuang->fetch_assoc();
    $totalRuang = $rowRuang['total_ruang'];
} else {
    $totalRuang = 0;
}

$queryBarang = "SELECT COUNT(*) as total_barang FROM peminjaman_barang";
$totalBarang1 = $conn->query($queryBarang);

if ($totalBarang1) {
    $rowBarang = $totalBarang1->fetch_assoc();
    $totalBarang1 = $rowBarang['total_barang'];
} else {
    $totalBarang1 = 0;
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/index_admin.css">

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
                    <li class="nav-link active">
                        <a href="admin.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="data_ruangan.php">
                            <i class='material-symbols-outlined icon'>store</i>
                            <span class="text nav-text">Data Ruangan</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="data_pinjam_ruang.php">
                            <i class='material-symbols-outlined icon'>add_home_work</i>
                            <span class="text nav-text">Data Pinjam Ruang</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="data_barang.php">
                            <i class='material-symbols-outlined icon'>add_to_queue</i>
                            <span class="text nav-text">Data Barang</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="data_pinjam_barang.php">
                            <i class='bx bx-briefcase-alt-2 icon'></i>
                            <span class="text nav-text">Data Pinjam Barang</span>
                        </a>
                    </li>

                    <div class="bottom-content">
                        <li class="">
                            <a href="logout.php">
                                <i class='bx bx-log-out icon'></i>
                                <span class="text nav-text">Logout</span>
                            </a>
                        </li>

                    </div>
            </div>

    </nav>

    <section class="home">
    <div class="top">
            <span class="text-top">JOJO University</span>
            <span class="material-symbols-outlined help">
                help
            </span>
            <span class="material-symbols-outlined">
                language
            </span>
        </div>
        <div class="text">Dashboard Admin</div>


        <div class="dashboard-content">
        <div class="card">
                <span class="material-symbols-outlined icon">
                add_to_queue
                </span>
                <div class="text-content">
                    <h2><?php echo $totalbarang; ?></h2>
                    <p>Total Barang </p>
                </div>
            </div>
            <div class="card">
                <span class="material-symbols-outlined icon">
                    store
                </span>
                <div class="text-content">
                    <h2><?php echo $totalRuangan; ?></h2>
                    <p>Total Ruangan Lab Komputer</p>
                </div>
            </div>

            <div class="card">
                <span class="material-symbols-outlined icon">
                    add_home_work
                </span>
                <div class="text-content">
                    <h2><?php echo $totalRuang; ?></h2>
                    <p>Total Peminjaman Ruangan</p>
                </div>
            </div>

            <div class="card">
                <span class="material-symbols-outlined icon">
                    home_repair_service
                </span>
                <div class="text-content">
                    <h2><?php echo $totalBarang1; ?></h2>
                    <p>Total Peminjaman Barang</p>
                </div>
            </div>
        </div>

        <div class= "table user">
    <table class="content-table">
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>NIM</td>
                        <td>Username</td>
                    </tr>
                </thead>
                <td></td>
                <tbody>
                    <?php
                    include('../database/connect.php');
                    $sql = "SELECT id_user, nim, username FROM users";
                    $result = mysqli_query($conn, $sql);
                    while ($user = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $user["id_user"]; ?>
                            </td>
                            <td>
                                <?php echo $user["nim"]; ?>
                            </td>
                            <td>
                                <?php echo $user["username"]; ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
    </section>


</body>
<script src="../js/home.js"></script>

</html>