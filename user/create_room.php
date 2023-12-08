<?php
    session_start();

    include('../database/connect.php');

    if(isset($_POST['submit'])){
        $rm = $_POST['nama_ruangan'];
        $tgl = $_POST['tanggal_peminjaman'];
        $start = $_POST['waktu_mulai'];
        $finish = $_POST['waktu_selesai'];
        $status = isset($_POST['status']) ? $_POST['status'] : '';

        $selectRuanganQuery = "SELECT id_ruangan FROM ruangan WHERE nama_ruangan = '$rm'";
        $result = $conn->query($selectRuanganQuery);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_ruangan = $row['id_ruangan'];
        
            $insertQuery = "INSERT INTO peminjaman_ruangan (id_user, id_ruangan, nama_ruangan, tanggal_peminjaman, waktu_mulai, waktu_selesai, status) 
            VALUES ('".$_SESSION['id_user']."', '$id_ruangan', '$rm', '$tgl', '$start', '$finish', 'Not yet approved')";

            if ($conn->query($insertQuery) === TRUE) {
                echo "Data berhasil ditambahkan ke database";
                header("location:data_pinjam_ruang.php");
                exit();
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        }
    }
?>