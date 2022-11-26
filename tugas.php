<?php
    if(!isset($_SESSION['status'])){
        echo "<script>alert('Anda harus login terlebih dahulu');</script>";
        echo "<script>location='index.php';</script>";
        exit();
    }
    else{
        $nrp=$_SESSION['nrp'];
        if($_GET['id']){
        $id_matkul=$_GET['id'];
        $query=" SELECT * FROM matkul WHERE id='$id_matkul'";
        $result=mysqli_query($conn,$query);
        $matkul=mysqli_fetch_assoc($result);
       
        }
    }
?>
<!DOCTYPE html>
<html>

<body>
    <h2>Daftar Tugas Mata Kuliah<?php echo $matkul['matkul'];?></h2>
    <table class="table-bordered table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Tugas</th>
                <th>File Soal Tugas</th>
                <th>Catatan</th>
                <th>Deadline</th>
                <th>Status Pengummpulan</th>
                <th>Nilai</th>
                <th>Aksi</th>
        </thead>
        <tbody>
            <?php
                                    $no=1;
                                    include 'connection.php';
                                    $query="SELECT tugas ,deadline,id_tugas,catatan, id_file FROM tugas WHERE tugas.id_matkul='$id_matkul' ";
                                    $result=mysqli_query($conn,$query);
                                    if($result){
                                    while($matkul=mysqli_fetch_assoc($result)){
                                        $idtugas=$matkul['id_tugas'];
                                        $tugas=$matkul['tugas'];
                                        $deadline=$matkul['deadline'];
                                        $catatan=$matkul['catatan'];
                                        $idfile=$matkul['id_file'];
                                ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $tugas;?></td>
                <td><a href="mhs.php?halaman=tugas&&download=<?php echo $idfile; ?>">Download disini</a></td>
                <td><?php echo $catatan;?></td>
                <td><?php echo $deadline;?></td>
                <?php
                                    $query2="SELECT id_pengumpulan,nilai FROM pengumpulan where id_tugas='$idtugas' and nrp='$nrp'";
                                    $result2=mysqli_query($conn,$query2);
                                    $status=mysqli_fetch_assoc($result2);
                                    if($status){
                                        echo "<td>Sudah Mengumpulkan</td>";
                                        if($status['nilai']>0){
                                        ?><td><?php echo $status['nilai'];?></td><?php
                                        }else{
                                            echo "<td>Belum Dinilai</td>";
                                        }?>
                                        <td>
                                       <a href="mhs.php?halaman=editTugas&&id=<?php echo $idtugas; ?>"class="btn btn-warning">Edit Pengumpulan</a></td><?php
                                    }else
                                    {
                                        echo "<td>Belum Mengumpulkan</td>";
                                        echo "<td>Belum Dinilai</td>";
                                        ?><td><a href="mhs.php?halaman=kumpulkantugas&&id=<?php echo $idtugas; ?>"
                        class="btn btn-success">Kumpulkan Tugas</a></td><?php
                                    }
                                ?>
            </tr>
            <?php
                                    $no++;
                                    }
                                }else{
                                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
                                    echo  "Belum ada Tugas";
                                }
                                ?>
        </tbody>
    </table>
    <a href="mhs.php?halaman=kelas" class="btn btn-primary">Kembali</a></td>
</body>

</html>
<?php
if (isset($_GET['download'])) {
    $id = $_GET['download'];
    include 'connection.php';
    $query = "SELECT name, size,type FROM file_tugas WHERE id_file_tugas = '$id'";
    $result = mysqli_query($conn, $query) or die('Error, query failed');
    list($name, $type, $size) = mysqli_fetch_array($result);
    header("Content-Disposition: attachment;filename=$name");
    header("Content-length: $size");
    header("Content-type: $type");
  }
?>