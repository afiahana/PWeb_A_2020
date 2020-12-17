<?php
session_start();
include "koneksi.php";
if(isset($_POST['username'])){
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $query=mysqli_query($koneksi,"select * from admin where username='$username' and password='$password'");
    $cek=mysqli_num_rows($query);
    
    if($cek){
        $_SESSION['username']=$username; 
        header("location:home.php");
    }else{
        ?><script> alert("your username or password is wrong");</script><?php
    }
}
?>
<html>
    <head>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link href="myStyle.css" rel="stylesheet">
        <title>Login</title>
    </head>
    <body>
        <div id="login">
            <h3 class="text-center text-white pt-5"></h3>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="" method="post">
                                <h3 class="text-center text-info">Login</h3>
                                <div class="form-group">
                                    <label for="username" class="text-info">Username:</label><br>
                                    <input type="text" name="username" id="username" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Password:</label><br>
                                    <input type="text" name="password" id="password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="Login" class="btn btn-info btn-md" value="Proses">
                                </div>
                                <div id="register-link" class="text-right">
                                    <a href="#" class="text-info">Register here</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>