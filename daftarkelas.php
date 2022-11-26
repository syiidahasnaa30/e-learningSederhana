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
<h2>Daftar Kelas</h2>
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
                                    $query="SELECT matkul.matkul as mata_kuliah,dosen.nama as dosen, matkul.id_dosen as id_dosen, dosen.id_dosen as id_dosen, matkul.id as id
                                    FROM matkul LEFT JOIN dosen ON matkul.id_dosen =dosen.id_dosen";
                                    $result=mysqli_query($conn,$query);
                                    while($matkul=mysqli_fetch_assoc($result)){
                                ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $matkul['mata_kuliah'];?></td>
                                <td><?php echo $matkul['dosen'];?></td>
                                <td>
                                    <a href="tambahkelas.php?id=<?php echo $matkul['id'];?>" class="btn-success btn">Dafar Kelas Ini</a>
                                </td>
                            </tr>
                            <?php
                                    $no++;
                                    }
                                ?>
                        </tbody>
                    </table>
</body>
</html>