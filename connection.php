<?php
$conn = mysqli_connect("localhost","root","","kampus");
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi  gagal : " . mysqli_connect_error();
}
?>