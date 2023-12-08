<?php
    include('../database/connect.php');
    if(isset($_GET['id_ruangan'])) {
        $idroom = $_GET['id_ruangan'];
        mysqli_query($conn, "DELETE FROM ruangan WHERE id_ruangan = '$idroom'");
        header("location:data_ruangan.php");
        exit(); 
    }
?>