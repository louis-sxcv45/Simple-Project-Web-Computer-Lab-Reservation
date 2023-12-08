<?php
if (isset($_POST['sign-up'])) {
    $name = $_POST["nama_lengkap"];
    $email = $_POST["email"];
    $kelas = $_POST["kelas"];
    $nim = $_POST["nim"];
    $nohp = $_POST["no_hp"];
    $user = $_POST["username"];
    $password = $_POST["password"];

    include("./database/connect.php");

    $query = "INSERT INTO users (nama_lengkap, email, kelas, nim, no_hp, username, password)
        VALUES ('$name', '$email', '$kelas', '$nim', '$nohp', '$user', '$password')";

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Error: " . $conn->error);
    }

    if ($stmt->execute()) {
        session_start();
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['username'] = $user;
        echo "<script> alert('Registration Successful'); window.location.href = 'login.php';</script>";
    } else {
        echo "<script> alert('Registration Failed'); window.location.href = 'register.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
