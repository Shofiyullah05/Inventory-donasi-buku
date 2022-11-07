<?php 
require 'function.php';


// mengecek apakah email terdaftar

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cekdatabase = mysqli_query($conn, "SELECT * FROM login where email = '$email' and password ='$password' ");

    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung>0) {

        $_SESSION['log'] = 'True';
        header('location:indexadmin.php');
    } else {
        header('location:invalidloginasadmin.php');
    }
}

if (!isset($_SESSION['log'])) {

} else {
    header('location:indexadmin.php');
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
    <head>
    <meta charset="utf-8">
    <title>ADMIN LOGIN</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="box">
        <img class="image" src="logo.png" alt="HTML5 Icon" width="110" height="128">
        <br>
        <a class = title>DINAS KEARSIPAN DAN PERPUSTAKAAN KAUPATEN KUDUS</a>
    </div>
    <div class="form-box">
    <form method="POST">
        <span class="warning"> invalid login !!!</span>
        <h1>Login as Admin</h1>
            <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="text" name="email" placeholder="email">
            </div>
            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password">
            </div>
            <button class="btn btn-primary" name="login">Login</button>
            <br>
            <a href="landing.php" class="cancel">cancel</a>
        </form>
    </div>

    <!-- <form method="post">
                    <div class="color">
                        <h3>Admin Login Form</h3>
                        <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
                        <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
                        <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
                        <div class="form-group"><button class="btn btn-primary" name="login" >Login</button>
                    </div>
                </div>
    </form> -->
</body>
</html>