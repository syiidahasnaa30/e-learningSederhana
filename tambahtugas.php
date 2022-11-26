<?php
    if(!isset($_SESSION['status'])){
        echo "<script>alert('Anda harus login terlebih dahulu');</script>";
        echo "<script>location='index.php';</script>";
        exit();
    }
    else{
        $nim=$_SESSION['nim'];
        $query=" SELECT dosen.nama as nama,matkul.id as id_matkul,matkul.matkul as matkul
        FROM dosen,matkul WHERE dosen.id_dosen=matkul.id_dosen AND dosen.id_dosen='$nim'";
        $result=mysqli_query($conn,$query);
        $dosen=mysqli_fetch_assoc($result);
        $id_matkul=$dosen['id_matkul'];
    }
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Penambahan Tugas <?php echo $dosen['matkul'];?></h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="judul">Judul Tugas:</label>
            <input type="text" class="form-control"  name="judul">
        </div>
        <div class="form-group">
            <label for="deadline">Dealine Tugas:</label>
            <input type="date" class="form-control"  name="deadline">
        </div>
        <div class="form-group">
            <label for="catatan">Catatan Tugas:</label>
            <textarea class="form-control"name="catatan" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label for="userfile">File Tugas</label>
            <input type="file" name="userfile" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Tambahkan" name="tambah">
        </div>
    </form>
</body>
</html>
<?php
    $uploadDir = 'tugas/';
    if (isset($_POST['tambah'])) {
        $judul=$_POST['judul'];
        $catatan=$_POST['catatan'];
        $deadline=$_POST['deadline'];
        $fileName = $_FILES['userfile']['name'];
        $tmpName = $_FILES['userfile']['tmp_name'];
        $fileSize = $_FILES['userfile']['size'];
        $fileType = $_FILES['userfile']['type'];
        $filePath = $uploadDir . $fileName;
        if($fileType=="application/vnd.openxmlformats-officedocument.wordprocessingml.document"|| $fileType == "application/pdf" || $fileType=="image/png")
        {
            if($fileSize<450000)
            {

                    move_uploaded_file($tmpName, $filePath);
                    include 'connection.php';

                    $query = "INSERT INTO file_tugas (name, size, type, path )"."VALUES ('$fileName', '$fileSize', '$fileType', '$filePath')";
                    if (mysqli_query($conn, $query)) {
                        $id_file = mysqli_insert_id($conn);
                        $query2="INSERT INTO tugas(id_matkul,tugas,catatan,deadline,id_file) VALUES('$id_matkul','$judul','$catatan','$deadline','$id_file')";
                        if (mysqli_query($conn, $query2))
                        {
                            echo "<script>alert('Anda harus login terlebih dahulu');</script>";
                            echo "<script>location='dosen.php?halaman=daftartugas';</script>";
                        }else{
                            echo "Gagal update: " . $sql . "<br>" . mysqli_error($koneksi);
                        }

                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
                    }
                    include 'closedb.php';
            }else{
                echo "<script>alert('Maaf, file melebihi 450 KB');</script>";
            }
        }else{
            echo "<script>alert('maaf, file anda harus png, pdf , atau docx !<br>');</script>";
        }

    }
?>