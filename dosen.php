<?php
    session_start();
    require_once('connection.php');
    if (!isset($_SESSION['status'])) {
        echo "<script>alert('Anda harus login terlebih dahulu');</script>";
        echo "<script>location='index.php';</script>";
        exit();
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home Elearning</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only"> navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index1.php">ELEARNINGKU</a>
            </div>
            <div style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;"> <a href="logout.php"
                    class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="assets/img/find_user.png" class="user-image img-responsive" />
                    </li>
                    <li>
                        <a class="active-menu" href="dosen.php?halaman=akundosen"><i class="fa fa-dashboard fa-3x"></i>Akun Saya</a>
                    </li>
                    <li>
                        <a href="dosen.php?halaman=akundosen"><i class="fa fa-dashboard fa-3x"></i>Home</a>
                    </li>
                    <li>
                        <a href="dosen.php?halaman=mahasiswa"><i class="fa fa-dashboard fa-3x"></i>Mahasiswa Dalam Kelas</a>
                    </li>
                    <li>
                        <a href="dosen.php?halaman=daftartugas"><i class="fa fa-dashboard fa-3x"></i>Daftar Tugas Mata Kuliah</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <?php
                    if(isset($_GET['halaman'])){
                        if($_GET['halaman']=="akundosen")
                        {
                            require_once('akundosen.php');
                        }
                        elseif ($_GET['halaman']=="ubah") {
                            require_once('ubahdosen.php');
                        }
                        elseif($_GET['halaman']=="daftartugas"){
                            require_once('penugasan.php');
                        }
                        elseif ($_GET['halaman']=="tambahtugas") {
                            require('tambahtugas.php');
                        }
                        elseif ($_GET['halaman']=="lihatpengumpulan") {
                           require_once('lihat_tugas_mhs.php');
                        } elseif ($_GET['halaman']=="mahasiswa") {
                            require_once('lihat_mahasiswa.php');
                        }elseif ($_GET['halaman']=="masuk_nilai") {
                            require_once('nilai.php');
                        }
                    }
                    else{
                        require_once('akundosen.php');
                    }
                ?>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>


</body>

</html>