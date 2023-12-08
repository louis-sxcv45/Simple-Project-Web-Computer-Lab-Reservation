<?php
session_start();
include('../database/connect.php');

if (isset($_GET['id_peminjaman'])) {
    $id_peminjaman = $_GET['id_peminjaman'];


    if (isset($_GET['action']) && $_GET['action'] === 'approve') {

        mysqli_query($conn, "UPDATE peminjaman_barang SET status = 'Approved' WHERE id_peminjaman = '$id_peminjaman'");
    } 

    elseif (isset($_GET['action']) && $_GET['action'] === 'reject') {

        mysqli_query($conn, "UPDATE peminjaman_barang SET status = 'Rejected' WHERE id_peminjaman = '$id_peminjaman'");
    }

    header("location: data_pinjam_barang.php");
} else {
    echo "Invalid request.";
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
                    <li class="nav-link active">
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
        <div class="text-table">Data Peminjaman Barang</div>
        <section class="table">
            <a href="javascript:void(0)" class="add-button" onclick="showForm()">
                <span class="material-symbols-outlined">
                    add
                </span>
                <p>Add Data</p>
            </a>

            <table class="content-table">
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Nama Barang</td>
                        <td>Nama Peminjam</td>
                        <td>Kode Barang</td>
                        <td>Stok</td>
                        <td>Opsi</td>
                    </tr>
                </thead>
                <td></td>
                <tbody>
                <?php
            $sql = "SELECT 
            pb.id_peminjaman AS id_peminjaman,
            u.username AS nama_peminjam,
            pb.nama_barang,
            pb.tanggal_peminjaman,
            pb.jumlah,
            pb.status
        FROM
            peminjaman_barang pb
        JOIN
            users u ON pb.id_user = u.id_user
        JOIN
            barang b ON pb.id_barang = b.id_barang";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            ?>
                        <?php
                        $nomor = 1;
                        while ($item = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $nomor++; ?>
                            </td>
                            <td>
                                <?php echo $item["nama_barang"]; ?>
                            </td>
                            <td>
                                <?php echo $item["nama_peminjam"]; ?>
                            </td>
                            <td>
                                <?php echo $item["tanggal_peminjaman"]; ?>
                            </td>
                            <td>
                                <?php echo $item["jumlah"]; ?>
                            </td>
                            <td>
                                    <?php
                                    if ($item['status'] == "Not yet approved") {
                                    ?>
                                        <div class="opsi">
                                            <a href="data_pinjam_barang.php?id_peminjaman=<?php echo $item['id_peminjaman']; ?>&action=approve" class="button edit approve" onclick="showForm()">
                                                <span class="material-symbols-outlined">done</span>
                                                <div class="text-edit" name="approve">Approve</div>
                                            </a>
                                            <a href="data_pinjam_barang.php?id_peminjaman=<?php echo $item['id_peminjaman']; ?>&action=reject" class="button delete reject">
                                                <span class="material-symbols-outlined">close</span>
                                                <div class="text-edit" name="approve">Reject</div>
                                            </a>
                                        </div>
                                    <?php
                                    } else if ($item['status'] == "Rejected") {
                                        echo "Rejected";
                                    } else {
                                        echo "Approved";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }}
                        ?>
                    </tbody>
            </table>
        </section>

    </main>
</body>
<script src="../js/home.js"></script>

</html>