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
<h2>Daftar Kelas <?php echo $mhs['nama'];?></h2>
<table class="table-bordered table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Dosen Pengajar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $no=1;
                                    $query="SELECT matkul.matkul as mata_kuliah,dosen.nama as dosen,matkul.id as id
                                    FROM mhs_matkul,matkul,dosen WHERE mhs_matkul.id_matkul=matkul.id AND matkul.id_dosen=dosen.id_dosen AND mhs_matkul.nrp='$nrp'";
                                    $result=mysqli_query($conn,$query);
                                    while($matkul=mysqli_fetch_assoc($result)){
                                ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $matkul['mata_kuliah'];?></td>
                                <td><?php echo $matkul['dosen'];?></td>
                                <td>
                                    <a href="mhs.php?halaman=tugas&&id=<?php echo $matkul['id'];?>" class="btn-success btn">Lihat Tugas</a>
                                </td>
                            </tr>
                            <?php
                                    $no++;
                                    }
                                ?>
                        </tbody>
                    </table>
    <a href="mhs.php?halaman=daftar" class="btn btn-primary">Daftar Kelas Baru</a>
</body>
</html>