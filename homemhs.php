<?php  
                $nrp=$_SESSION['nrp'];
                 $query="SELECT * FROM mahasiswa WHERE nrp='$nrp'";
                 $result=mysqli_query($conn,$query);
                 $mhs=mysqli_fetch_assoc($result);
            ?>
<h2>Selamat Datang Mahasiswa <?php echo $mhs['nama'];?> </h2>