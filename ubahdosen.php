
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
<h2>Halaman Ubah Akun <?php echo $dosen['nama'];?></h2>
<form  action="" method="post" enctype="multipart/form-data" >
    <div class="form-group">
        <label for="stok">Nama Dosen:</label>
        <input type="text" class="form-control" value="<?php echo $dosen['nama']; ?>" name="nama">
    </div>
    <div class="form-group">
        <label for="berat">Email:</label>
        <input type="email" class="form-control" value="<?php echo $dosen['email']; ?>"name="email">
    </div>
    <div class="form-group">
        <label for="berat">Alamat:</label>
        <input type="text" class="form-control" value="<?php echo $dosen['alamat']; ?>"name="alamat">
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
            $email= $_POST['email'];
            $alamat=$_POST['alamat'];
            $query="UPDATE dosen SET nama='".$nama."',email='".$email."',alamat='".$alamat."' WHERE id_dosen='".$nim."'";
            $result = mysqli_query($conn,$query);
            echo "<script>alert('Akun dosen telah diperbarui');</script>";
            echo "<script>location='dosen.php?halaman=akundosen';</script>";
    }
?>