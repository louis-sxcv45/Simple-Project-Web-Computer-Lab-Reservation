<?php
session_start();

include("../database/connect.php");
    if(isset($_GET['id_barang'])) {
        $iditem = $_GET['id_barang'];
        mysqli_query($conn, "DELETE FROM barang WHERE id_barang = '$iditem'");
        header("location:data_barang.php");
        exit(); 
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

                    <li class="nav-link active">
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
        <div class="text-table">Data Barang</div>
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
                        <td>Kode Barang</td>
                        <td>Stok</td>
                        <td>Opsi</td>
                    </tr>
                </thead>
                <td></td>
                <tbody>
                    <?php
                    include("../database/connect.php");
                    $data = mysqli_query($conn, "select * from barang");
                    $nomor = 1;
                    while ($room = mysqli_fetch_array($data)) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $nomor++; ?>
                            </td>
                            <td>
                                <?php echo $room["nama_barang"]; ?>
                            </td>
                            <td>
                                <?php echo $room["kode_barang"]; ?>
                            </td>
                            <td>
                                <?php echo $room["stok_barang"]; ?>
                            </td>
                            <td>
                                <div class="opsi">
                                    <a href="edit_item.php?id_barang=<?php echo $room['id_barang']; ?>" class="button edit" onclick="showForm()">
                                        <span class="material-symbols-outlined">edit</span>
                                        <div class="text-edit">Edit</div>
                                    </a>
                                    <a href="data_barang.php?id_barang=<?php echo $room['id_barang']; ?>" class="button delete">
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
        
        <section class="container" id="create" style="display: none;">
            <header>Booking Room</header>
            <form action="add_item.php" class="form" method="POST">
                <div class="input-box">
                    <label>Item Name</label>
                    <input type="text" name="nama_barang" placeholder="Item Name" required />
                </div>
                <div class="input-box">
                    <label>ID Item</label>
                    <input type="text" name="kode_barang" placeholder="ID Item" required />
                </div>
                <div class="column">
                    <div class="input-box">
                        <label>Stok</label>
                        <input type="text" name="stok_barang" id="stok" required />
                    </div>
                </div>
                <button name="submit">Add Data</button>
            </form>
        </section>
            
    </main>
</body>
<script src="../js/home.js"></script>

</html>