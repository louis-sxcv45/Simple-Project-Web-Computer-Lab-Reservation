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

                    <li class="nav-link">
                        <a href="barang.php">
                            <i class='material-symbols-outlined icon'>add_to_queue</i>
                            <span class="text nav-text">Pinjam Alat</span>
                        </a>
                    </li>
                    <li class="nav-link active">
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
        <div class="text-table">Data Peminjaman Barang</div>
        <section class="table">
            <div class="add-button">
                <a href="javascript:void(0)" class="add-room" onclick="showForm()">
                    <span class="material-symbols-outlined">
                        add
                    </span>
                    <p>Booked</p>
                </a>
            </div>
            <?php
            if (isset($_SESSION['id_user'])) {
                $user_id = $_SESSION['id_user'];


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
                barang b ON pb.id_barang = b.id_barang
            WHERE
                pb.id_user = '$user_id'";


                $result = $conn->query($sql);
            }

            ?>
            <table class="content-table">
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Nama Peminjaman</td>
                        <td>Nama Ruangan</td>
                        <td>Tanggal Peminjaman</td>
                        <td>Jumlah Peminjaman</td>
                        <td>Status</td>
                        <td>Opsi</td>
                    </tr>
                </thead>
                <td></td>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $nomor = 1;
                        while ($barang = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td>
                                    <?php echo $nomor++; ?>
                                </td>
                                <td>
                                    <?php echo $barang["nama_peminjam"]; ?>
                                </td>
                                <td>
                                    <?php echo $barang["nama_barang"]; ?>
                                </td>
                                <td>
                                    <?php echo $barang["tanggal_peminjaman"]; ?>
                                </td>
                                <td>
                                    <?php echo $barang["jumlah"]; ?>
                                </td>
                                <td>
                                    <?php echo $barang["status"]; ?>
                                </td>
                                <td>
                                    <?php
                                    if ($barang["status"] == "Not yet approved") {
                                    ?>
                                        <div class="opsi">
                                            <a href="edit_peminjaman_barang.php?id_peminjaman=<?php echo $barang['id_peminjaman']; ?>" class="button edit" onclick="showForm()">
                                                <span class="material-symbols-outlined">edit</span>
                                                <div class="text-edit">Edit</div>
                                            </a>
                                        <?php
                                    }
                                        ?>
                                        <a href="data_pinjam_ruang.php?id_peminjaman=<?php echo $barang['id_peminjaman']; ?>" class="button delete">
                                            <span class="material-symbols-outlined">delete</span>
                                            <div class="text-edit">Delete</div>
                                        </a>
                                        </div>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <?php
        include('../database/connect.php');

        if (isset($_POST['submit'])) {
            $rb = $_POST['nama_barang'];
            $tgl = $_POST['tanggal_peminjaman'];
            $stokitem = $_POST['jumlah'];
            $status = isset($_POST['status']) ? $_POST['status'] : '';

            $selectBarangQuery = "SELECT id_barang, stok_barang FROM barang WHERE nama_barang = '$rb'";
            $result = $conn->query($selectBarangQuery);

            if ($result->num_rows > 0) {
                $barang = $result->fetch_assoc();
                $id_barang = $barang['id_barang'];
                $current_stok = $barang['stok_barang'];

                if ($current_stok >= $stokitem) {
                    $new_stok = $current_stok - $stokitem;

                    $updateStokQuery = "UPDATE barang SET stok_barang = $new_stok WHERE id_barang = $id_barang";

                    if ($conn->query($updateStokQuery) === TRUE) {
                        $insertQuery = "INSERT INTO peminjaman_barang (id_user, id_barang, nama_barang, tanggal_peminjaman, jumlah, status) 
    VALUES ('" . $_SESSION['id_user'] . "','$id_barang','$rb', '$tgl', '$stokitem', 'Not yet approved')";

                        if ($conn->query($insertQuery) === TRUE) {
                            echo "<script> alert('Item Successfully Borrowed'); window.location.href = 'data_pinjam_barang.php';</script>";
                        } else {
                            echo "Error inserting data: " . $conn->error;
                        }
                    } else {
                        echo "Error updating stock: " . $conn->error;
                    }
                } else {
                    echo "Not enough stock available for borrowing.";
                }
            } else {
                echo "Item not found in the barang table.";
            }
        }
        ?>


        <section class="container" id="create" style="display: none;">
            <header>Booking Item</header>
            <form action="" class="form" method="POST">
                <div class="input-box">
                    <label>Item Name</label>
                    <input type="text" name="nama_barang" placeholder="Item Name" required />
                </div>
                <div class="input-box">
                    <label>Date Of Booking</label>
                    <input type="date" name="tanggal_peminjaman" placeholder="Date Of Booking" required />
                </div>
                <div class="column">
                    <div class="input-box">
                        <label>Amount Booked</label>
                        <input type="number" name="jumlah" placeholder="Amount Booked" required />
                    </div>
                </div>
                <button name="submit">Booked Now</button>
            </form>
        </section>

    </main>


    <script src="../js/home.js"></script>
</body>

</html>