<?php 
    if (!isset($_SESSION["login"])){
        header("Location: login_admin.php");
        exit();
    }

    session_destroy();


    header("Location: login_admin.php");

?>