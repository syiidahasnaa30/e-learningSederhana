
<?php
    if(!isset($_SESSION['status'])){
        echo "<script>alert('Anda harus login terlebih dahulu');</script>";
        echo "<script>location='index.php';</script>";
        exit();
    }
    else{
        //session_start();
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
<h4>Daftar Mahasiswa Mata Kuliah <?php echo $dosen['matkul'];?></h4>
<table class="table-bordered table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nrp</th>
                                <th>Nama Mahasiswa</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no=1;
                        $query=" SELECT mahasiswa.nrp as nrp, mahasiswa.nama as nama
                        from mahasiswa,mhs_matkul where mahasiswa.nrp=mhs_matkul.nrp AND mhs_matkul.id_matkul='$id_matkul'";
                        $result=mysqli_query($conn,$query);
                        while($mahasiswa=mysqli_fetch_assoc($result)){
                        ?>
                          <tr>
                          <td><?php echo $no;?></td>
                          <td><?php echo $mahasiswa['nrp'];?></td>
                          <td><?php echo $mahasiswa['nama'];?></td>
                          </tr>
                          <?php
                            $no++;
                        }
                          ?>
                        </tbody>
                    </table>
</body>
</html>