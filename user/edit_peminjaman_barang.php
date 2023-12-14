<?php
session_start();

include('../database/connect.php');

if (isset($_POST['save'])) {
    $id_peminjaman = $_POST['id_peminjaman'];
    $rb = $_POST['nama_barang'];
    $tgl = $_POST['tanggal_peminjaman'];
    $stok = $_POST['jumlah'];


    $selectPeminjamanQuery = "SELECT * FROM peminjaman_barang WHERE id_peminjaman = $id_peminjaman";
    $result = $conn->query($selectPeminjamanQuery);

    if ($result->num_rows > 0) {
        $peminjaman = $result->fetch_assoc();
        $id_barang = $peminjaman['id_barang'];
        $current_stok = $peminjaman['jumlah']; 


        $selectBarangQuery = "SELECT stok_barang FROM barang WHERE id_barang = $id_barang";
        $result = $conn->query($selectBarangQuery);

        if ($result->num_rows > 0) {
            $barang = $result->fetch_assoc();
            $original_stok = $barang['stok_barang'];

            $new_stok = $original_stok + $current_stok - $stok;


            $updateStokQuery = "UPDATE barang SET stok_barang = $new_stok WHERE id_barang = $id_barang";
            if ($conn->query($updateStokQuery) === TRUE) {

                $updateQuery = "UPDATE peminjaman_barang SET nama_barang = '$rb', tanggal_peminjaman = '$tgl', jumlah = '$stok' WHERE id_peminjaman = $id_peminjaman";
                if ($conn->query($updateQuery) === TRUE) {
                    echo "Data berhasil diupdate";
                    header("location:data_pinjam_barang.php");
                    exit();
                } else {
                    echo "Error updating peminjaman_barang: " . $conn->error;
                }
            } else {
                echo "Error updating stock: " . $conn->error;
            }
        } else {
            echo "Item not found in the barang table.";
        }
    } else {
        echo "Peminjaman not found.";
    }
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
                    <li class="nav-link active">
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
                b.penanggung_jawab AS nama_penanggung_jawab,
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
                                    <?php echo $barang["nama_penanggung_jawab"]; ?>
                                </td>
                                <td>
                                    <?php echo $barang["status"]; ?>
                                </td>
                                <td>
                                    <div class="opsi">
                                        <a href="data_pinjam_barang.php?id_peminjaman=<?php echo $barang['id_peminjaman']; ?>" class="button edit" onclick="showForm()">
                                            <span class="material-symbols-outlined">edit</span>
                                            <div class="text-edit">Edit</div>
                                        </a>
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
        $id_peminjaman = isset($_GET['id_peminjaman']);
        $data = mysqli_query($conn, "SELECT * FROM peminjaman_barang WHERE id_peminjaman = '$id_peminjaman'");

        while ($barang = mysqli_fetch_array($data)) {
        ?>
            <section class="container" id="create">
                <header>Booking Room</header>
                <form action="" class="form" method="POST">
                    <input type="hidden" name="id_peminjaman" value="<?php echo $barang['id_peminjaman']; ?>">
                    <div class="input-box">
                        <label>Item Name</label>
                        <input type="text" name="nama_barang" placeholder="Item Name" value="<?php echo $barang['nama_barang']; ?>" required />
                    </div>
                    <div class="input-box">
                        <label>Date Of Booking</label>
                        <input type="date" name="tanggal_peminjaman" placeholder="Date Of Booking" value="<?php echo $barang['tanggal_peminjaman']; ?>" required />
                    </div>
                    <div class="column">
                        <div class="input-box">
                            <label>Amount Booked</label>
                            <input type="number" name="jumlah" placeholder="Amount Booked" value="<?php echo $barang['jumlah']; ?>" required />
                        </div>
                    </div>
                    <button name="save">Save</button>
                </form>
            </section>
        <?php
        }
        ?>

    </main>


    <script src="../js/home.js"></script>
</body>

</html>