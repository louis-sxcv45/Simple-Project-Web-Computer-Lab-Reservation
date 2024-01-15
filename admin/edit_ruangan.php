<?php
session_start();
        include('../database/connect.php');

        if (isset($_POST['save'])) {
            $idroom = $_POST['id_ruangan'];
            $nameroom = $_POST['nama_ruangan'];
            $coderoom = $_POST['kode_ruangan'];
            $pjr = $_POST['penanggung_jawab'];

            $targetdir = "../img/";
            $img = $targetdir . basename($_FILES["img"]["name"]);
            move_uploaded_file($_FILES["img"]["tmp_name"], $img);

            mysqli_query($conn, "UPDATE ruangan SET 
                    nama_ruangan = '$nameroom', 
                    kode_ruangan = '$coderoom',
                    penanggung_jawab = '$pjr',
                    img = '$img' WHERE id_ruangan = '$idroom'");
            
            header("location: data_ruangan.php");
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
                    <span class="profession">University </span>
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

                    <li class="nav-link active">
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
        <div class="text-table">Data Ruangan</div>
        <section class="table">
            <table class="content-table" width="20px">
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Nama Ruangan</td>
                        <td>Kode Ruangan</td>
                        <td>Nama Penanggung Jawab</td>
                        <td>Image</td>
                        <td>Opsi</td>
                    </tr>
                </thead>
                <td></td>
                <tbody>
                    <?php
                    include("../database/connect.php");
                    $data = mysqli_query($conn, "select * from ruangan");
                    $nomor = 1;
                    while ($room = mysqli_fetch_array($data)) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $nomor++; ?>
                            </td>
                            <td>
                                <?php echo $room["nama_ruangan"]; ?>
                            </td>
                            <td>
                                <?php echo $room["kode_ruangan"]; ?>
                            </td>
                            <td>
                                <?php echo $room["penanggung_jawab"]; ?>
                            </td>
                            <td></td>
                            <td>
                                <div class="opsi">
                                    <a href="edit_ruangan.php?id_ruangan=<?php echo $room['id_ruangan']; ?>" class="button edit" onclick="showForm()">
                                        <span class="material-symbols-outlined">edit</span>
                                        <div class="text-edit">Edit</div>
                                    </a>
                                    <a href="delete.php?id_ruangan=<?php echo $room['id_ruangan']; ?>" class="button delete">
                                        <span class="material-symbols-outlined">delete</span>
                                        <div class="text-edit">Delete</div>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <?php
        $idroom = $_GET['id_ruangan'];
        $data = mysqli_query($conn, "SELECT * FROM ruangan WHERE id_ruangan = '$idroom'");

        while ($room = mysqli_fetch_array($data)) {
        ?>
            <section class="container" id="create">
                <header>Booking Room</header>
                <form action="" class="form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_ruangan" value="<?php echo $room['id_ruangan']; ?>">
                    <div class="input-box">
                        <label>Room Name</label>
                        <input type="text" name="nama_ruangan" value="<?php echo $room['nama_ruangan'] ?>" placeholder="Room Name" required />
                    </div>
                    <div class="input-box">
                        <label>ID Room</label>
                        <input type="text" name="kode_ruangan" value="<?php echo $room['kode_ruangan'] ?>" placeholder="ID Room" required />
                    </div>
                    <div class="input-box">
                        <label>Responsible Person</label>
                        <input type="text" name="penanggung_jawab" value="<?php echo $room['penanggung_jawab'] ?>" placeholder="Responsible Person" required />
                    </div>
                    <div class="column">
                        <div class="input-box">
                            <label>Image</label>
                            <input type="file" name="img" id="img" value="<?php echo $room['img'] ?>" required />
                        </div>
                    </div>
                    <button name="save">Save</button>
                </form>
            <?php
        }
            ?>
            </section>
    </main>
</body>
<script src="../js/home.js"></script>

</html>