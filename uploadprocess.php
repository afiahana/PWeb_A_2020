<?php session_start();
    include "koneksi.php";
    if($_SESSION["username"]){
        $usernama=$_POST['nama'];
        $password=md5($_POST['password']);
        $base64_string=$_POST['image'];
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
        }
        else{
            $upErr = "Cannot upload image, your username or password is wrong";
            
        }
    }
    else{
        header("location:login.php");
    }
    
?> 