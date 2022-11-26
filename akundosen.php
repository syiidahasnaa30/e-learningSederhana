
<?php
    if(!isset($_SESSION['status'])){
        echo "<script>alert('Anda harus login terlebih dahulu');</script>";
        echo "<script>location='index.php';</script>";
        exit();
    }
    else{
        $nim=$_SESSION['nim'];
        $query=" SELECT * FROM dosen WHERE id_dosen='$nim'";
        $result=mysqli_query($conn,$query);
        $dosen=mysqli_fetch_assoc($result);
    }
?>
<!DOCTYPE html>
<html>
<body>
<h2>Ini Akun <?php echo $dosen['nama'];?></h2>
<div class="container container-sm">
    <pre><?php print_r($dosen); ?></pre>
    <a href="dosen.php?halaman=ubah" class="btn btn-primary">Perbarui Data</a>
</div>
</body>
</html>