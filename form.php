<?php session_start();
    if($_SESSION["username"]){
        //blok program jika user telah login terlebih dahulu
        include "koneksi.php";
        $nameErr = $alamatErr = $usiaErr = "";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $flag=0;
            $nama=$_POST['nama'];
            $alamat=$_POST['alamat'];
            $usia=$_POST['usia'];

            if (!preg_match("/^[a-zA-Z ]*$/",$nama)) {
                $nameErr = "Hanya huruf dan spasi yang diperbolehkan";
                $flag=1;
            }
            if (!preg_match("/^[0-9 ]*$/",$usia)) {
                $usiaErr = "Hanya angka yang diperbolehkan";
                $flag=1;
            }

            if($flag == 0){
                $tablename="biodata";
                $sqlstr="insert into $tablename(nama, alamat, usia) value('$nama','$alamat','$usia')";
                $query=mysqli_query($koneksi,$sqlstr);
    
                if($query){
                    header("location:home.php");
                }else{
                    echo("Gagal input data " . mysqli_error($koneksi));
                }
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
        <head>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
            <link href="myStyle.css" rel="stylesheet">
            <style>
                .error {color: #FF0000;}
            </style>
        </head>
        <body class="bg-info">
            <br>
            <br>
            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-8">
                            <div class="card w-75">
                                <div class="card-header text-center">
                                    <h4 class="card-title">
                                        Add Data
                                    </h4>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="table-responsive">
                                        <form name="newMember" action="form.php" method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>Nama</td>
                                                    <td><input class="form-control" type="text" name="nama" required /><span class="error"> <?php echo $nameErr;?></span></td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td><input class="form-control" type="text" name="alamat" required /></td>
                                                </tr>
                                                <tr>
                                                    <td>Usia</td>
                                                    <td><input class="form-control" type="text" name="usia" required /><span class="error"> <?php echo $usiaErr;?></span></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><input type="submit" name="proses" value="Proses" class="btn btn-success float-right"></td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    <?php
    }
    else{
        header("location:login.php");
    }
?>