<?php
include "koneksi.php";
?>
    <head>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link href="myStyle.css" rel="stylesheet">
        <title>Register</title>
    </head>
    <body class="bg-1">
    <br>
        <div class="section text-center">
            <h3>Selamat Datang</h3>
        </div>
        <br>
        <br>
        <br>
        <section class="login_box_area p_120">
		    <div class="container">
			    <div class="row">
				    <div class="offset-md-3 col-lg-6">
                        <form action="register.php" method="post">
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" name="nama" placeholder="Name">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" name="username" placeholder="Username">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="Daftar" name="register" class="btn btn-secondary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
<?php
    if(isset($_POST['register'])){
        $name=$_POST['nama'];
        $username=$_POST['username'];
        $password=md5($_POST['password']);
        $tablename="admin";
        $query=mysqli_query($koneksi,"insert into admin values nama='$name', username='$alamat', password='$password'");
        // $sqlstr="insert into $tablename(nama, username, password) value('$name','$username','$password')";
        // $query=mysqli_query($koneksi,$sqlstr);

        if($query){
            // echo("INI REGISTER COK ");
            header("location:login.php");
        }else{
            echo("Gagal Register " . mysqli_error($koneksi));
        }
    }
?>