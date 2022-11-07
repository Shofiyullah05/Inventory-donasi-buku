<?php 
require 'function.php';


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cekdatabase = mysqli_query($conn, "SELECT * FROM login where email = '$email' and password ='$password' ");

    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung>0) {

        $_SESSION['log'] = 'True';
        header('location:index2.php');
    } else {
        header('location:invalidloginasvisitor.php');
    }
}

if (!isset($_SESSION['log'])) {

} else {
    header('location:index2.php');
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>VISITOR LOGIN</title>
        <link rel="stylesheet" href="stylelogin.css">
    </head>
<body>
    <div class="box">
        <center>
        
            <img src="logo.png" alt="HTML5 Icon" width="150px" height="175px">
        
        </center>
        <br>
        <div class="title">
        <a>Dinas Kearsipan dan Perpustakaan Kabupaten</a>
        </div>
       
       
       
    </div>
    <div class="form-box">
    <form method="POST">
        <h1>Login as Visitor</h1>
            <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="text" name="email" placeholder="email">
            </div>
            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password">
            </div>
            <button class="btn" name="login">Login</button>
            <br>
            <br>
            <a class="btn" href="landing.php">Back</a>
        </form>
    </div>
</body>
</html>