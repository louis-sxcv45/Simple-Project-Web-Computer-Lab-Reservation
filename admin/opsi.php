<?php
include('../database/connect.php');

if (isset($_GET['id_peminjaman'])) {
    $id_peminjaman = $_GET['id_peminjaman'];


    if (isset($_GET['action']) && $_GET['action'] === 'approve') {

        mysqli_query($conn, "UPDATE peminjaman_ruangan SET status = 'Approved' WHERE id_peminjaman = '$id_peminjaman'");
    } 

    elseif (isset($_GET['action']) && $_GET['action'] === 'reject') {

        mysqli_query($conn, "UPDATE peminjaman_ruangan SET status = 'Rejected' WHERE id_peminjaman = '$id_peminjaman'");
    }

    header("location: data_pinjam_ruang.php");
} else {
    echo "Invalid request.";
}
?>