<?php
    if(!isset($_SESSION['status'])){
        echo "<script>alert('Anda harus login terlebih dahulu');</script>";
        echo "<script>location='index.php';</script>";
        exit();
    }
    else{
        include 'connection.php';
        $nim=$_SESSION['nim'];
        $id_tugas=$_GET['idtugas'];
        $query="SELECT * FROM tugas where id_tugas='$id_tugas'";
        $result=mysqli_query($conn,$query);
        $tugas=mysqli_fetch_assoc($result);
        $id_matkul=$tugas['id_matkul'];
    }
?>
<h2>Daftar Pengumpulan Tugas <?php echo $tugas['tugas'];?></h2>
<table class="table-bordered table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nrp</th>
            <th>Nama Mahasiswa</th>
            <th>File</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
                        $no=1;
                        $query=" SELECT mahasiswa.nrp as nrp, mahasiswa.nama as nama
                        from mahasiswa,mhs_matkul where mahasiswa.nrp=mhs_matkul.nrp AND mhs_matkul.id_matkul='$id_matkul'";
                        $result=mysqli_query($conn,$query);
                        while($mhs=mysqli_fetch_assoc($result)){
                            $nrp=$mhs['nrp'];
                            $nama=$mhs['nama'];
                        ?>
        <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $nrp?></td>
            <td><?php echo $nama?></td>
            <?php
                            $query2="SELECT id_pengumpulan,id_upload,nilai FROM pengumpulan where id_tugas='$id_tugas' and nrp='$nrp'";
                            $result2=mysqli_query($conn,$query2);
                            $status=mysqli_fetch_assoc($result2);
                            if($status){
                                $id_pengumpulan=$status['id_pengumpulan'];
                                
                                ?>
                                <td><a href="dosen.php?halaman=lihatpengumpulan&&id_pengumpulan=<?php echo $status['id_upload'];?>">Download disini</a></td>
                                <?php
                                if($status['nilai'] > 0){?>
                                    <td><?php echo $status['nilai']; ?></td>
                                    <td><a href="dosen.php?halaman=masuk_nilai&&idpengumpulan=<?php echo $id_pengumpulan; ?>" class="btn btn-warning">Edit Nilai</a></td>
                                    <?php
                                }else{
                                    echo "<td>belum dinilai</td>";?>
                                    <td>
                                    <a href="dosen.php?halaman=masuk_nilai&&idpengumpulan=<?php echo $id_pengumpulan; ?>" class="btn btn-success">Masukkan Nilai</a>
                                    </td><?php
                                }

                                }
                            else{
                                echo "<td>Belum mengumpulkan</td>";
                                echo "<td>Belum dinilai</td>";?>
                                <td>Belum ada Pengumpulan</td><?php
                            }
            ?>
        </tr>
        <?php
                            $no++;
                        }
                          ?>
    </tbody>
</table>
<a href="dosen.php?halaman=daftartugas" class="btn btn-primary">Kembali</a>
</body>
</html>
<?php
if (isset($_GET['id_pengumpulan'])) {
    $id = $_GET['id_pengumpulan'];
    include 'connection.php';
    $query = "SELECT name, size,type FROM upload WHERE id_upload = '$id'";
    $result = mysqli_query($conn, $query) or die('Error, query failed');
    list($name, $type, $size) = mysqli_fetch_array($result);
    header("Content-Disposition: attachment;filename=$name");
    header("Content-length: $size"); 
    header("Content-type: $type");
  }
?>