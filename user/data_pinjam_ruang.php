<?php
session_start();

include("../database/connect.php");
    if(isset($_GET['id_peminjaman'])) {
        $idbooked = $_GET['id_peminjaman'];
        mysqli_query($conn, "DELETE FROM peminjaman_ruangan WHERE id_peminjaman = '$idbooked'");
        header("location:data_pinjam_ruang.php");
        exit(); 
    }
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

                    <li class="nav-link active">
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
            <span class="text-top tp">JOJO University</span>
            <span class="material-symbols-outlined help">
                help
            </span>
            <span class="material-symbols-outlined">
                language
            </span>
        </div>
        <div class="text-table">Data Peminjaman Ruangan</div>
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


                $sql = $sql = "SELECT 
                pr.id_peminjaman AS id_peminjaman,
                u.username AS nama_peminjam,
                r.penanggung_jawab AS nama_penanggung_jawab,
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
                ruangan r ON pr.id_ruangan = r.id_ruangan
            WHERE
                pr.id_user = '$user_id'";

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
                        <td>Waktu Mulai</td>
                        <td>Waktu Selesai</td>
                        <td>Penanggung Jawab</td>
                        <td>Status</td>
                        <td>Opsi</td>
                    </tr>
                </thead>
                <td></td>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $nomor = 1;
                        while ($ruang = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td>
                                    <?php echo $nomor++; ?>
                                </td>
                                <td>
                                    <?php echo $ruang["nama_peminjam"]; ?>
                                </td>
                                <td>
                                    <?php echo $ruang["nama_ruangan"]; ?>
                                </td>
                                <td>
                                    <?php echo $ruang["tanggal_peminjaman"]; ?>
                                </td>
                                <td>
                                    <?php echo $ruang["waktu_mulai"]; ?>
                                </td>
                                <td>
                                    <?php echo $ruang["waktu_selesai"]; ?>
                                </td>
                                <td>
                                    <?php echo $ruang["nama_penanggung_jawab"]; ?>
                                </td>
                                <td>
                                    <?php echo $ruang["status"]; ?>
                                </td>
                                <td>
                                    <?php
                                    if ($ruang["status"] == "Not yet approved") {
                                    ?>
                                        <div class="opsi">
                                            <a href="edit.php?id_peminjaman=<?php echo $ruang['id_peminjaman']; ?>" class="button edit" onclick="showForm()">
                                                <span class="material-symbols-outlined">edit</span>
                                                <div class="text-edit">Edit</div>
                                            </a>
                                    <?php
                                    }
                                    ?>
                                            <a href="data_pinjam_ruang.php?id_peminjaman=<?php echo $ruang['id_peminjaman']; ?>" class="button delete">
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

        <section class="container" id="create" style="display: none;">
            <header>Booking Room</header>
            <form action="create_room.php" class="form" method="POST">
                <div class="input-box">
                    <label>Room Name</label>
                    <input type="text" name="nama_ruangan" placeholder="Room Name" required />
                </div>
                <div class="input-box">
                    <label>Date Of Booking</label>
                    <input type="date" name="tanggal_peminjaman" placeholder="Date Of Booking" required />
                </div>
                <div class="column">
                    <div class="input-box">
                        <label>Booking Start Time</label>
                        <input type="date" name="waktu_mulai" placeholder="Booking Start Time" required />
                    </div>
                    <div class="input-box">
                        <label>Booked Finish Time</label>
                        <input type="date" name="waktu_selesai" placeholder="Booked Finish Time" required />
                    </div>
                </div>
                <button name="submit">Booked Now</button>
            </form>
        </section>

    </main>

    <script src="../js/home.js"></script>
</body>

</html>