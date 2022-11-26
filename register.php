<!DOCTYPE html>
<html>

<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

	<h1>Selamat Datang di <br />Sistem Informasi Mahasiswa</h1>
	<div class="kotak_login">
		<p class="tulisan_login">Buat Akun</p>
		<form action="" method="post">
			<label>Username</label>
			<input type="text" name="username" class="form_login" placeholder="Username .." required="required">

			<label>Password</label>
			<input type="password" name="password" class="form_login" placeholder="Password .." required="required">

			<label>NRP/NIM</label>
			<input type="text" name="nrp_nim" class="form_login" placeholder="nrp / nim" required="required">

			<label>Level</label>
			<select name="level" class="form_login">
				<option value="mahasiswa">mahasiswa</option>
				<option value="dosen">dosen</option>
			</select>
			<input type="submit" class="tombol_login" name="buat" value="Buat Akun">

			<br />
			<br />
		</form>

	</div>
</body>

</html>
<?php
    include 'connection.php';
    if(isset($_POST['buat']))
    {
      $user=$_POST['username'];
      $pwd=$_POST['password'];
	$level=$_POST['level'];
	$nrp_nim=$_POST['nrp_nim'];
      $query="INSERT INTO user (username,password,level,nrp_nim) VALUES('$user','$pwd','$level','$nrp_nim')";
      $result=mysqli_query($conn,$query);
      if($result){
        echo "<script>alert('Akun anda berhasil dibuat. silakan login !!');</script>";
        echo "<script>location='index.php'</script>";
      }
    }
    ?>