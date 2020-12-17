<?php session_start();
    if($_SESSION["username"]){
        //blok program jika user telah login terlebih dahulu
        include "koneksi.php";
        $id=$_GET['id'];
        $query=mysqli_query($koneksi,"select * from biodata where id='$id'");
        ?>
        <head>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
            <link href="myStyle.css" rel="stylesheet">
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
                                        Update Data
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <form action="simpan.php" method="post">
                                            <table class="table table-borderless">
                                                <?php
                                                while($row=mysqli_fetch_array($query)){
                                                ?>
                                                <input type="hidden" name="id" value="<?php echo $id;?>"/>
                                                <tr>
                                                    <td>Nama</td>
                                                    <td><input class="form-control" type="text" name="nama" value="<?php echo $row['nama'];?>" required /></td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td><input class="form-control" type="text" name="alamat" value="<?php echo $row['alamat'];?>" required /></td>
                                                </tr>
                                                <tr>
                                                    <td>Usia</td>
                                                    <td><input class="form-control" type="text" name="usia" value="<?php echo $row['usia'];?>" required /></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><input type="submit" value="Simpan" name="simpan" class="btn btn-success float-right" /></td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
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