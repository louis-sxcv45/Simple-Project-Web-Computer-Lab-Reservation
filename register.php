<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login_regis.css">
    <script src="./js/login_regis.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Register Account</title>
</head>

<body>
    <section class="register">

            <h1>Sign Up</h1>
            <form action="regis.php" method="POST">
                <div class="txt_box">
                    <input type="text" name="nama_lengkap" id="name" placeholder="Full Name" required>
                </div>

                <div class="txt_box">
                    <input type="email" name="email" id="email" placeholder = "E-Mail" required>
                </div>

                <div class="txt_box">
                    <input type="text" name="kelas" id="kelas" placeholder = "Class" required>
                </div>
                <div class="txt_box">
                    <input type="text" name="nim" id="nim" placeholder = "NIM" required>
                </div>
                <div class="txt_box">
                    <input type="text" name="no_hp" id="no_hp" placeholder = "Phone Number" required>
                </div>

                <div class="txt_box">
                    <input type="text" name="username" id="username" placeholder = "Username" required>
                </div>
                <div class="txt_box">
                    <input type="password" name="password" id="password" placeholder = "Password" required>
                    <img src="./img-2/eye_close.png" id="eyeicon" onclick="myFunction()">
                </div>

                <div class="policy">
                    <input type="checkbox" name="policy" id="policy" required>
                    <h3>I Accept All Terms & Conditions</h3>
                </div>

                <div class="txt_box button">
                    <input type="submit" name="sign-up" value="Sign Up">
                </div>

                <div class="link">
                    <h3>Do You Have an Account? <a href="login.php">Login</a> </h3>
                </div>
            </form>
    </section>
</body>

</html>