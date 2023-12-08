<?php 
    $iditem = isset ($_POST['id_barang']) ? $_POST['id_barang'] : "";
    $nameitem = $_POST['nama_barang'];
    $codeitem = $_POST['kode_barang'];
    $stokitem = $_POST['stok_barang'];
    

    

    include("../database/connect.php");

    mysqli_query($conn, "INSERT INTO barang(nama_barang, kode_barang, stok_barang)
    VALUES('$nameitem', '$codeitem', '$stokitem')");

    echo "<script> alert('Data Added Successfully') </script>";
    include('data_barang.php');
?>