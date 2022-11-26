<?php
    if(!isset($_SESSION['status'])){
        echo "<script>alert('Anda harus login terlebih dahulu');</script>";
        echo "<script>location='index.php';</script>";
        exit();
    }
    else{
        $nrp=$_SESSION['nrp'];
        $idtugas=$_GET['id'];
        $query="SELECT id_matkul FROM tugas where id_tugas='$idtugas'";
        $matkul=mysqli_query($conn,$query);
        $id_matkul=mysqli_fetch_assoc($matkul);
    }
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Upload Tugas Anda</h1>
    <div class="kotak_login">
        <p class="tulisan_login">Kumpulkan Tugas</p>

        <form enctype="multipart/form-data" action="" method="post">
            <label>Pilih Tugas</label>
            <input type="file" name="userfile" class="form_login">
            <input type="submit" name="upload" class="tombol_login" value="UPLOAD">
            <br />
            <br />
            <center>
                <a class="link" href="mhs.php?halaman=tugas&&id=<?php echo $id_matkul['id_matkul']; ?>">kembali</a>
            </center>
        </form>
    </div>
</body>

</html>
<?php
    $uploadDir = 'pengumpulan/';
    if (isset($_POST['upload'])) {
        $fileName = $_FILES['userfile']['name'];
        $tmpName = $_FILES['userfile']['tmp_name'];
        $fileSize = $_FILES['userfile']['size'];
        $fileType = $_FILES['userfile']['type'];
        $filePath = $uploadDir . $fileName;
        if($fileType=="application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $fileType=="image/png")
        {
            if($fileSize<450000)
            {

                move_uploaded_file($tmpName, $filePath);
                    include 'connection.php';
                    $query = "INSERT INTO upload (name, size, type, path )"."VALUES ('$fileName', '$fileSize', '$fileType', '$filePath')";
                    if (mysqli_query($conn, $query)) {
                        $last_id = mysqli_insert_id($conn);
                        echo "Upload success !!. Last inserted ID is: " . $last_id;
                        $query2="INSERT INTO pengumpulan(id_tugas,nrp,id_upload) VALUES('$idtugas','$nrp','$last_id')";
                        if (mysqli_query($conn, $query2))
                        {
                            echo "<script>alert('Upload tugas anda berhasil');</script>";
                            echo "<script>location='mhs.php?halaman=tugas&&id=$idtugas';</script>";
                        }else{
                            echo "Gagal update: " . $sql . "<br>" . mysqli_error($conn);
                        }

                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                    include 'closedb.php';
            }else{
                echo "maaf, file anda melebihi 450 kb";
            }
        }else{
            echo " maaf, file anda harus png atau docx !<br>";
            if($fileType=="application/pdf"){
                echo "file yang anda upload adalah pdf";
            }
        }

    }
?>