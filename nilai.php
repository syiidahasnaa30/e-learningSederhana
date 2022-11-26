<?php
    if(!isset($_SESSION['status'])){
        echo "<script>alert('Anda harus login terlebih dahulu');</script>";
        echo "<script>location='index.php';</script>";
        exit();
    }
    else{
        include 'connection.php';
        $nim=$_SESSION['nim'];
        $id_pengumpulan=$_GET['idpengumpulan'];
        $query="SELECT * FROM pengumpulan where id_pengumpulan='$id_pengumpulan'";
        $result=mysqli_query($conn,$query);
        $nilai=mysqli_fetch_assoc($result);
        $id_tugas=$nilai['id_tugas'];
    }
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Nilai Tugas NRP <?php echo $nilai['nrp'];?></h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nilai">Nilai:</label>
            <input type="number" class="form-control"  name="nilai">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Tambahkan" name="tambah">
        </div>
    </form>
    <a href="dosen.php?halaman=lihatpengumpulan&&idtugas=<?php echo $id_tugas; ?>" class="btn btn-primary">Kembali</a>
</body>
</html>
<?php
if(isset($_POST['tambah'])){
    $nilai=$_POST['nilai'];
    $query="UPDATE pengumpulan set nilai='$nilai' where id_pengumpulan='$id_pengumpulan'";
    $result=mysqli_query($conn,$query);
    if($result){
        echo "<script>alert('Nilai Berhasil diperbarui');</script>";
        echo "<script>location='dosen.php?halaman=lihatpengumpulan&&idtugas=$id_tugas';</script>";
    }
}
?>