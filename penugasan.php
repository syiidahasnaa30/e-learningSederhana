
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
<h2>Halo <?php echo $dosen['nama'];?></h2>
<h4>Daftar Tugas Mata Kuliah <?php echo $dosen['matkul'];?></h4>
<table class="table-bordered table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Tugas</th>
                                <th>Deadline</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no=1;
                        $query=" SELECT id_tugas,tugas,deadline,catatan from tugas where id_matkul='$id_matkul'";
                        $result=mysqli_query($conn,$query);
                        while($tugas=mysqli_fetch_assoc($result)){
                        ?>
                          <tr>
                          <td><?php echo $no;?></td>
                          <td><?php echo $tugas['tugas'];?></td>
                          <td><?php echo $tugas['deadline'];?></td>
                          <td><?php echo $tugas['catatan'];?></td>
                          <td>
                          <a href="dosen.php?halaman=lihatpengumpulan&&idtugas=<?php echo $tugas['id_tugas']; ?>" class="btn btn-success">Lihat Pengumpulan</a>
                          </td>
                          </tr>
                          <?php
                            $no++;
                        }
                          ?>
                        </tbody>
                    </table>
                    <a href="dosen.php?halaman=tambahtugas" class="btn btn-primary">Tambah Tugas</a>
</body>
</html>