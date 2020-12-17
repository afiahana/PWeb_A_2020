<?php session_start();
    // print_r($_SESSION);
    if($_SESSION["username"]){
        include "koneksi.php";
        $query=mysqli_query($koneksi, "select * from biodata");
        $jumlah=mysqli_num_rows($query);
        // echo "Selamat datang : ".$_SESSION['username'];
        // echo "<br><br>";
        // echo "Jumlah data ada : ".$jumlah;
        $counter_name = "counter.txt";
        $f = fopen($counter_name,"r");
        $counterVal = fread($f, filesize($counter_name));
        fclose($f);

        // Has visitor been counted in this session?
        // If not, increase counter value by one
        if(!isset($_SESSION['hasVisited'])){
        $_SESSION['hasVisited']="yes";
        $counterVal++;
        $f = fopen($counter_name, "w");
        fwrite($f, $counterVal);
        fclose($f); 
        }

        // $filecounter="counter.txt";
        // $fl=fopen($filecounter,"r+");
        // $hit=fread($fl,filesize($filecounter));

        // echo("<table width=250 align=center border=1 cellspacing=0 cellpadding=0 bordercolor=#0000FF><tr>");
        // echo("<td width=250 valign=middle align=center>");
        // echo("<font face=verdana size=2 color=#FF0000><b>");
        // echo("Anda pengunjung yang ke:");

        // echo($counterVal);
        // echo("</b></font>");
        // echo("</td>");
        // echo("</tr></table>");

        // fclose($fl);
        // $fl=fopen($filecounter,"w+");
        // $hit=$hit+1;
        // fwrite($fl,$hit,strlen($hit));
        // fclose($fl);
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
                    <a class="nav-item nav-link active" href="home.php">HOME <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="chart.php">CHART</a>
                    <a class="nav-item nav-link" href="upload.php">UPLOAD</a>
                    <a class="nav-item nav-link" href="log.php">LOG</a>
                </div>
            </div>
            <div class="navbar-text pl-10"><h8>Anda pengunjung ke: <?php echo($counterVal); ?></h5></div>
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
                                <a href="form.php?" class="btn btn-info">Add Data</a>
                                <div class="table-responsive">
                                    <br>
                                    <table class="table table-hover table-bordered">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Usia</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $no=0; 
                                        while($row=mysqli_fetch_array($query)){
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no=$no+1;?></td>
                                            <td><?php echo $row['nama'];?></td>
                                            <td><?php echo $row['alamat'];?></td>
                                            <td class="text-center"><?php echo $row['usia'];?></td>
                                            <td class="text-center">
                                                <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Update</a>
                                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return
                                                confirm('Apakah anda yakin?')">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                                <br />
                                <a href="logout.php" class="btn btn-danger float-right">Logout</a>
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