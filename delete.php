<?php session_start();
    if($_SESSION["username"]){
        include "koneksi.php";
        $id=$_GET['id'];
        $query=mysqli_query($koneksi,"delete from biodata where id='$id'");
        
        if($query){
            header("location:home.php");
        }else{
            echo "gagal hapus data";
        }
    }else{
        header("location:login.php");
    }
    
?> 