<?php
session_start();

include("../database/connect.php");

    $idroom = isset ($_POST['id_ruangan']) ? $_POST['id_ruangan'] : "";
    $nameroom = $_POST['nama_ruangan'];
    $coderoom = $_POST['kode_ruangan'];
    $pjr = $_POST['penanggung_jawab'];

    $targetdir = "../img/";
    $img = $targetdir.basename($_FILES["img"]["name"]);
    move_uploaded_file($_FILES["img"]["tmp_name"], $img);
    

    include("../database/connect.php");

    mysqli_query($conn, "INSERT INTO ruangan(nama_ruangan, kode_ruangan, penanggung_jawab ,img)
    VALUES('$nameroom', '$coderoom','$pjr' ,'$img')");

    echo "<script> alert('Data Added Successfully') </script>";
    include('data_ruangan.php');
?>