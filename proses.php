<?php
    include("koneksi.php");
    $nameErr = $alamatErr = $usiaErr = "";
    $flag=0;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nama=test_input($_POST['nama']);
        $alamat=test_input($_POST['alamat']);
        $usia=test_input($_POST['usia']);

        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Hanya huruf dan spasi yang diperbolehkan"; 
        }
        if (!preg_match("/^[0-9 ]*$/",$name)) {
            $nameErr = "Hanya angka yang diperbolehkan"; 
        }
        $flag=1;
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($flag == 1){
        $tablename="biodata";
        $sqlstr="insert into $tablename(nama, alamat, usia) value('$nama','$alamat','$usia')";
        $query=mysqli_query($koneksi,$sqlstr);

        if($query){
            header("location:home.php");
        }else{
            echo("Gagal input data " . mysqli_error($koneksi));
        }
    }
    
?> 