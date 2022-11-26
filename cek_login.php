<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'connection.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($conn,"SELECT * FROM user WHERE username='$username' AND password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai dosen
	if($data['level']=="dosen"){

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "dosen";
		$_SESSION['nim']=$data['nrp_nim'];
		$_SESSION['status']="login";
		// alihkan ke halaman dosen
		header("location:dosen.php");

	// cek jika user login sebagai mahasiswa
	}else if($data['level']=="mahasiswa"){
		// buat session login dan username
		$_SESSION['username'] = $username;
        $_SESSION['level'] = "mahasiswa";
		$_SESSION['nrp']=$data['nrp_nim'];
		$_SESSION['status']="login";
		// alihkan ke halaman dashboard pegawai
		header("location:mhs.php");
	}else{

		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}
}else{
	header("location:index.php?pesan=gagal");
}
include 'closedb.php';
?>