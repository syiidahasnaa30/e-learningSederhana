
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
<h2>Halaman Ubah Akun <?php echo $mhs['nama'];?></h2>
<form  action="" method="post" enctype="multipart/form-data" >
    <div class="form-group">
        <label for="stok">Nama Mahasiswa:</label>
        <input type="text" class="form-control" value="<?php echo $mhs['nama']; ?>" name="nama">
    </div>
    <div class="form-group">
        <label for="harga">Tanggal Lahir :</label>
        <input type="date" class="form-control" value="<?php echo $mhs['tgl_lahir'] ?>" name="ttl">
    </div>
    <div class="form-group">
        <label for="berat">Email:</label>
        <input type="email" class="form-control" value="<?php echo $mhs['email']; ?>"name="email">
    </div>
    <div class="form-group">
        <label for="berat">No Telepon:</label>
        <input type="text" class="form-control" value="<?php echo $mhs['telepon']; ?>"name="telpon">
    </div>
    <div class="form-group">
        <label for="berat">Alamat:</label>
        <input type="text" class="form-control" value="<?php echo $mhs['alamat']; ?>"name="alamat">
    </div>
    <div class="form-group">
    <br>
    <button class="btn btn-primary" name="ubah">Simpan Perubahan</button>
    </div>
</form>
</body>
</html>
<?php
require_once('connection.php');
    if(isset($_POST['ubah']))
    {
            $nama = $_POST['nama'];
            $ttl = $_POST['ttl'];
            $email= $_POST['email'];
            $noHp= $_POST['telpon'];
            $alamat=$_POST['alamat'];
            $query="UPDATE mahasiswa SET nama='".$nama."',email='".$email."', tgl_lahir='".$ttl."',telepon='".$noHp."',
                    alamat='".$alamat."' WHERE nrp='".$nrp."'";
            $result = mysqli_query($conn,$query);
            echo "<script>alert('Akun anda telah diperbarui');</script>";
            echo "<script>location='mhs.php?halaman=akun';</script>";
    }
?>