<?php
session_start();
include("../database/connect.php");
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
    <!-- Sidebar and main content -->
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

                    <li class="nav-link active">
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
        <div class="text-table">Data Peminjaman Ruangan</div>
        <section class="table">
            <?php
            // Fetch all room reservation data
            $sql = "SELECT 
                        pr.id_peminjaman AS id_peminjaman,
                        u.username AS nama_peminjam,
                        pr.nama_ruangan,
                        pr.tanggal_peminjaman,
                        pr.waktu_mulai,
                        pr.waktu_selesai,
                        pr.status
                    FROM
                        peminjaman_ruangan pr
                    JOIN
                        users u ON pr.id_user = u.id_user
                    JOIN
                        ruangan r ON pr.id_ruangan = r.id_ruangan";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            ?>
                <table class="content-table">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Nama Peminjaman</td>
                            <td>Nama Ruangan</td>
                            <td>Tanggal Peminjaman</td>
                            <td>Waktu Mulai</td>
                            <td>Waktu Selesai</td>
                            <td>Status</td>
                            <td>Opsi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        while ($ruang = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $nomor++; ?></td>
                                <td><?php echo $ruang["nama_peminjam"]; ?></td>
                                <td><?php echo $ruang["nama_ruangan"]; ?></td>
                                <td><?php echo $ruang["tanggal_peminjaman"]; ?></td>
                                <td><?php echo $ruang["waktu_mulai"]; ?></td>
                                <td><?php echo $ruang["waktu_selesai"]; ?></td>
                                <td><?php echo $ruang["status"]; ?></td>
                                <td>
                                    <?php
                                    if ($ruang['status'] == "Not yet approved") {
                                    ?>
                                        <div class="opsi">
                                            <a href="opsi.php?id_peminjaman=<?php echo $ruang['id_peminjaman']; ?>&action=approve" class="button edit approve" onclick="showForm()">
                                                <span class="material-symbols-outlined">done</span>
                                                <div class="text-edit" name="approve">Approve</div>
                                            </a>
                                            <a href="opsi.php?id_peminjaman=<?php echo $ruang['id_peminjaman']; ?>&action=reject" class="button delete reject">
                                                <span class="material-symbols-outlined">close</span>
                                                <div class="text-edit" name="approve">Reject</div>
                                            </a>
                                        </div>
                                    <?php
                                    } else if ($ruang['status'] == "Rejected") {
                                        echo "Rejected";
                                    } else {
                                        echo "Approved";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "No data found.";
            }
            ?>
        </section>
    </main>

    <script src="../js/home.js"></script>
</body>

</html>