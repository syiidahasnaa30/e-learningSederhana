<?php
    if(!isset($_SESSION['status'])){
        echo "<script>alert('Anda harus login terlebih dahulu');</script>";
        echo "<script>location='index.php';</script>";
        exit();
    }
    else{
        $id=$_GET['id'];
        $nrp=$_SESSION['nrp'];
        $query0="SELECT id_matkul FROM tugas where id_tugas='$id'";
        $result0=mysqli_query($conn,$query0);
        $tugas=mysqli_fetch_assoc($result0);
        $id_matkul=$tugas['id_matkul'];
    }
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="kotak_login">
        <p class="tulisan_login">Edit Pengumpulan Tugas</p>

        <form enctype="multipart/form-data" action="" method="post">
            <label>Pilih Tugas Baru</label>
            <input type="file" name="userfile" class="form_login">
            <input type="submit" name="upload" class="tombol_login" value="UPLOAD">
            <br />
            <br />
            <center><a href="mhs.php?halaman=tugas&&id=<?php echo $id_matkul; ?>"class="btn btn-secondary">Batal</a></center>
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
                   
                    $query="SELECT id_ipload FROM pengumpulan where id_tugas='$id'";
                    $result=mysqli_query($conn, $query);
                    //$upload=mysqli_fetch_assoc($result);
                    $query2="UPDATE upload set name='$fileName', type='$fileType', size='$fileSize', path='$filePath' where id_ipload='$result'";
                    if(mysqli_query($conn,$query2)){
                        echo "<script>alert('File anda telah diperbarui');</script>";
                        echo "<script>location='mhs.php?halaman=tugas&&id=$id_matkul';</script>";
                    }else{
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