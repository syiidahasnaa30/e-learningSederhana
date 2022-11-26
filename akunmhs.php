
<?php
    if(!isset($_SESSION['status'])){
        echo "<script>alert('Anda harus login terlebih dahulu');</script>";
        echo "<script>location='index.php';</script>";
        exit();
    }
    else{
        $nrp=$_SESSION['nrp'];
        $query=" SELECT * FROM mahasiswa WHERE nrp='$nrp'";
        $result=mysqli_query($conn,$query);
        $mhs=mysqli_fetch_assoc($result);
    }
?>
<!DOCTYPE html>
<html>
<body>
<h2>IniAkun <?php echo $mhs['nama'];?></h2>
<div class="container container-sm">
    <pre><?php print_r($mhs); ?></pre>
    <a href="mhs.php?halaman=ubah" class="btn btn-primary">Perbarui Data</a>
</div>
</body>
</html>