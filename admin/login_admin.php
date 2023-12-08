<?php
if (isset($_SESSION["login"])) {
    header("Location:index.php");
    exit();
}

$username_cookie = '';
$password_cookie = '';
$set_remember = '';

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    $username_cookie = $_COOKIE['username'];
    $password_cookie = $_COOKIE['password'];
    $set_remember = "checked = 'checked'";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin_login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="../js/admin_login.js"></script>
    <title>Login</title>
</head>

<body>
    <section class="container">
        <h1>Admin Login</h1>
        <form action="process_login_admin.php" method="POST">
            <div class="txt_field">
                <input type="text" class = "user" name="username" id="user" oninput = "return closeuser()" value="<?php echo $username_cookie ?>" required>
                <label for="placeholder">Username</label>
                <div class="close right_close" id="closeUsername">
                    <span class="material-symbols-outlined">
                        close
                    </span>
                </div>
            </div>

            <div class="txt_field ">
                <input type="password" class = "pass" name="password" id="password" oninput = "return closepass()" value="<?php echo $password_cookie ?>" required>
                <label for="placeholder" class = "password">Password</label>
                <div class="close left_close" id= "closePassword">
                    <span class="material-symbols-outlined">
                        close
                    </span>
                </div>
                <span id="eyeicon" class="material-symbols-outlined icon" onclick="togglePassword()">
                    visibility
                </span>
            </div>

            <div class="pass">
                <input type="checkbox" name="remember_me" id="me" <?php echo $set_remember ?>>
                <label for="remember_me" id="me">Remember me</label>
            </div>
            <div class="txt_field button">
                <input type="submit" name="login" value="Log In">
            </div>
            <div class="having_problem">
                <a href="#">Having Problems?</a>
            </div>
        </form>
    </section>
</body>

</html>