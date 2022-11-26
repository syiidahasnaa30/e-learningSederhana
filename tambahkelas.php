<?php
session_start();
include 'connection.php';
 if(!isset($_SESSION['status'])){
    echo "<script>alert('Anda harus login terlebih dahulu');</script>";
    echo "<script>location='index.php';</script>";
    exit();
}else{
    if(isset($_GET['id'])){
        $idmatkul=$_GET['id'];
        $nrp=$_SESSION['nrp'];
        $query="INSERT INTO mhs_matkul (nrp,id_matkul) VALUES('$nrp','$idmatkul')";
        $result=mysqli_query($conn,$query);
        if($result){
            echo "<script>alert('Anda Telah Terdaftar Kelas Baru');</script>";
            echo "<script>location='mhs.php?halaman=kelas';</script>";
        }
    }
}
?>