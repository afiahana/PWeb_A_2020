<?php session_start();
    // print_r($_SESSION);
    if($_SESSION["username"]){
        include "koneksi.php";
        $query=mysqli_query($koneksi, "select * from log");
        $jumlah=mysqli_num_rows($query);
        ?>
    
    <head>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="myStyle.css">
    </head>
    <body class="bg-info">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="home.php">HOME</a>
                    <a class="nav-item nav-link" href="chart.php">CHART</a>
                    <a class="nav-item nav-link" href="upload.php">UPLOAD</a>
                    <a class="nav-item nav-link active" href="log.php">LOG<span class="sr-only">(current)</span></a>
                </div>
            </div>
        </nav>
        <br>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- <div class="card-header text-center">
                                <h4 class="card-title">
                                    Data
                                </h4>
                            </div> -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <br>
                                    <table class="table table-hover table-bordered">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Waktu</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $no=0; 
                                        while($row=mysqli_fetch_array($query)){
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no=$no+1;?></td>
                                            <td><?php echo $row['username'];?></td>
                                            <td><?php echo $row['time'];?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                                <br />
                                <a href="home.php" class="btn btn-warning float-right">Back</a>
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