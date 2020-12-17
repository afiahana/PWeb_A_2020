<?php session_start();
// Ini ntr setting session nd db validation
if($_SESSION["username"]){
    include "koneksi.php";
    $flag = 0;
    $upErr = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $usernama=$_POST['nama'];
        $password=md5($_POST['password']);
        if($_FILES['image']){
            $data = base64_encode(file_get_contents( $_FILES["image"]["tmp_name"] ));
            $base64_string = "data:".getimagesize($_FILES["image"]["tmp_name"])["mime"].";base64,".$data;
        }
        else{
            $base64_string = $_POST['image'];
        }
        // $base64_string=$_POST['image'];
        $image_name = "C:\\xampp\\htdocs\\uploadFace\\".$usernama;

        $query=mysqli_query($koneksi,"select * from admin where username='$usernama' and password='$password'");
        $cek=mysqli_num_rows($query);

        if($cek){
            if(!file_exists($image_name)){
                if(!mkdir($image_name)){
                    $m = array('msg' => "REJECTED, can't create folder");
                    echo json_encode($m);
                    return;
                }
            }
            // $path = explode('/', $base);
            // $extension = explode(';', $path[1])[0];

            $fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
            $file_count = iterator_count($fi)+1;
            $data = explode(',', $base64_string);
            $fullName = $image_name."\\X_".$file_count."_". date("YmdHis") .".png";
            $tanggal = date("YmdHis");
            $ifp = fopen($fullName, "wb");
            fwrite($ifp, base64_decode($data[1]));
            fclose($ifp);
        
            if(!$ifp){
                $m = array('msg' => "REJECTED, ".$fullName."not saved");
                echo json_encode($m);
                return;
            }
        
            $fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
            $file_count = iterator_count($fi);
            $m = array('msg' => "ACCEPTED");
            echo json_encode($m);
            $flag = 1;

            if($flag == 1){
                $tablename="log";
                $sqlstr="insert into $tablename(username, time) value('$usernama','$tanggal')";
                $query=mysqli_query($koneksi,$sqlstr);
        
                if($query){
                    ?><script> alert("Image Successfully Uploaded!");</script><?php
                    header("location:upload.php");
                }else{
                    echo("Gagal input data " . mysqli_error($koneksi));
                }
            }
            else{
                $upErr = "Cannot upload image, your username or password is wrong";
            }
        }
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="home.php">HOME</a>
                <a class="nav-item nav-link" href="chart.php">CHART</a>
                <a class="nav-item nav-link active" href="upload.php">UPLOAD<span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="log.php">LOG</a>
            </div>
        </div>
    </nav>
    <br>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-8">
                    <div class="card w-75">
                        <div class="card-header text-center">
                            <h4 class="card-title">
                                Upload Image
                            </h4>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="table-responsive">
                                <form name="newMember" action="upload.php" method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>Username</td>
                                            <td><input class="form-control" type="text" name="nama" required /></td>
                                        </tr>
                                        <tr>
                                            <td>Password</td>
                                            <td><input class="form-control" type="text" name="password" required /></td>
                                        </tr>
                                        <tr>
                                            <td>Image</td>
                                            <td><input class="form-control" type="file" name="image" accept="image/*" required /><span class="error"> <?php echo $upErr;?></span></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input type="submit" name="uploadprocess" value="Upload" class="btn btn-success float-right"></td>
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
}else{
    header("location:login.php");
}
?>
