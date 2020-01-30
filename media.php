<?php
session_start();
error_reporting(0);
include "config/config.php";
include "config/fungsi_rupiah.php";
include "timeout.php"; 
//include "config/userInfo.php";
require('config/userInfo.php');
 $ipaddress = $_SERVER['REMOTE_ADDR'];

function user_akses($mod,$id){
  $link = "?module=".$mod;
  $cek = mysql_num_rows(mysql_query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='$id' AND modul.link='$link'"));
  return $cek;
}
//fungsi cek akses menu
function umenu_akses($link,$id){
  $cek = mysql_num_rows(mysql_query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='$id' AND modul.link='$link'"));
  return $cek;
}
//fungsi redirect
function akses_salah(){
  $pesan = "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Maaf Anda tidak berhak mengakses halaman ini</center>";
  $pesan.= "<meta http-equiv='refresh' content='2;url=media.php?module=home'>";
  return $pesan;
}
//var_dump($_SESSION[username]);exit;
$login=mysql_query("SELECT * FROM users WHERE username='$_SESSION[username]'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);
// Apabila user masih login
if($r[isLogin]==1){

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){

  echo "
  <link href='css/betron.css' rel='stylesheet' type='text/css'>";

  echo "
  </head>
  <body class='special-page'>
  <div id='container'>
  <section id='error-number'>
  
  <img src='images/lock.png'>
  <h1>AKSES ILEGAL</h1>
  
  <p><span class style=\"font-size:14px; color:#ccc;\">
  Maaf, untuk masuk Halaman Administrator
  anda harus Login dahulu!</p></span><br/>
  
  </section>
  
  <section id='error-text'>
  <p><a class='button' href='index.php'>&nbsp;&nbsp; <b>LOGIN DI SINI</b> &nbsp;&nbsp;</a></p>
  </section>
  </div>";
  
}
else{
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SKT | Sistem Koperasi Terpadu</title>
    <link rel="shortcut icon" href="img/logo_martabe.png" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" type="text/css" href="assets/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="assets/easyui/themes/icon.css">

  
    <script type="text/javascript">
        //set timezone
        <?php date_default_timezone_set('Asia/Jakarta'); ?>
        //buat object date berdasarkan waktu di server
        var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);
        //buat object date berdasarkan waktu di client
        var clientTime = new Date();
        //hitung selisih
        var Diff = serverTime.getTime() - clientTime.getTime();
        //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
        function displayServerTime() {
            //buat object date berdasarkan waktu di client
            var clientTime = new Date();
            //buat object date dengan menghitung selisih waktu client dan server
            var time = new Date(clientTime.getTime() + Diff);
            //ambil nilai jam
            var sh = time.getHours().toString();
            //ambil nilai menit
            var sm = time.getMinutes().toString();
            //ambil nilai detik
            var ss = time.getSeconds().toString();
            //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
            document.getElementById("clock").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" + sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
        }
        </script>

</head>

<body onload="setInterval('displayServerTime()', 1000);" class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="home.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>SKT</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">Sistem Koperasi Terpadu</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- Home: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="home.html">
                                <i class="fa fa-home"></i> Home
                            </a>
                            </li>
                       <li class="dropdown messages-menu">
                            <a href="#" class="small-box-footer tutup">
                                <i class="fa fa-clock-o"></i>
                                Tutup Hari
                            </a>
                        </li>         
                        <?php

$a=mysql_fetch_array(mysql_query("SELECT * FROM users,tbl_level WHERE users.level=tbl_level.id_level AND username='$_SESSION[username]'"));


?>
                        <li class="dropdown user user-menu">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php if($a[foto]==''){
         echo " <img src='images/user/no-photo.png' class='user-image' >";
       }else{
       echo " <img src='images/user/$a[foto]' class='user-image' >";
       } ?>
                                <span class="hidden-xs">
                                    <?php echo "$a[nama_lengkap]"; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <?php
       if($a[foto]==''){
         echo " <img src='images/user/no-photo.png' class='img-circle' >";
       }else{
       echo " <img src='images/user/$a[foto]' class='img-circle' >";
       } 
        ?>

                                    <p>
                                        <?php echo "$a[nama_lengkap] - $a[nama_level]"; ?>
                                        <small>
                                            <?php echo "$a[email]"; ?> </small>
                                    </p>

                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <!--   <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>-->
                                    <div class="pull-right">
                                        <a href="out.html" class="btn btn-default btn-flat">Sign out</a>
                                    </div>

                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <?php

$a=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username='$_SESSION[username]'"));
   echo "     <div class='pull-left image'>";
   if($a[foto]==''){
         echo " <img src='images/user/no-photo.png' class='img-circle' >";
       }else{
       echo " <img src='images/user/small_$a[foto]' class='img-circle' >";
       }
         echo" 
        </div>
    <div class='pull-left info'>
    <p>$a[nama_lengkap]</p>"; 

?>

                    <a href="#"><i class="fa fa-circle text-success"></i> <span id="clock">
                            <?php print date('H:i:s'); ?></span></a>

                </div>
    </div>
    <!-- search form -->

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <?php include "menu1.php"; ?>

    </ul>
    <!-- Sidebar user panel -->


    </section>
    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?php include "content.php"; ?>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2018 <a href="https://www.facebook.com/lambejeding" target="blank">Betron</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">

        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
            </div>

        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
   <!--  <script src="plugins/jQuery/jquery-2.2.4.min.js"></script> -->
    <script src="plugins/jQuery/jquery-2.2.4.js"></script>
	<script src="plugins/jQueryUI/jquery-ui-1-12-1.js"></script>
	
    <!-- jQuery UI 1.11.4 -->
  <!--   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
   
    <!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
    <script src="js/jquery.validate.min.js"></script>
    <!-- <script src="assets\plugins\jquery/jquery.min.js"></script>-->
    
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- page script -->
    <script>
        $(function() {
            $("#example1").DataTable();
            $("#formbaps").DataTable();
            $('#example2').DataTable({
                "dom": ' <"search"f><"top"l>rt<"bottom"ip><"clear">',
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });

       
    </script>

    
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/select2.full.min.js"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $(".select2").select2();
			$(".selectDialog").select2({
				dropdownParent: $("#dialog-form")
				});
        });
    </script>
	<script src="assets/easyui/jquery.easyui.min.js"></script>
	
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <!-- <script src="js/raphael-min.js"></script> -->
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
     <script>
        $(document).ready(function() {
            //   $("#tgl_pkb").datepicker({  Format: "yy-mm-dd",autoclose: true }),
            var dateToday = new Date();
            $("#ftTgl_Gaji").datepicker({  format: "yyyy-mm-dd",autoclose: true });
            $("#ftTgl_Lahir").datepicker({  format: "yyyy-mm-dd",autoclose: true });
            $("#fdTglJurnal").datepicker({  format: "yyyy-mm-dd",autoclose: true });
            $('#fdTrans_date').datepicker({format: "yyyy-mm-dd",showAnim:"drop",autoclose: true});
            $('#kelompok_date').datepicker({format: "yyyy-mm-dd",showAnim:"drop",autoclose: true});
			$('#enddate').datepicker({format: "yyyy-mm-dd",showAnim:"drop",startDate: new Date(),autoclose: true,maxDate: moment(),init_animation: "fadein"

        });

        })
    </script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) 
    <script src="dist/js/pages/dashboard.js"></script>-->
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="dist/js/demo.js"></script> -->
    <!-- InputMask -->
    <script src="plugins/input-mask/jquery.inputmask.js"></script>

    <!--<script src="js/function.js"></script>-->




    <!-- Jam -->
    <script type="text/javascript">
        $(document).ready(function() {
            setInterval(function() {
                $.get("timeout.php", function(data) {
                    if (data == 0) window.location.href = "logout.php";
                });
            }, 1 * 60 * 10000);
        });
    </script>
    <!-- Jam -->
<script type="text/javascript"> 

         $(document).ready(function() {
          // view so      
            $(".tutup").focusin(function() {
            $("#tutup_hari").modal('show'); // ini fungsi untuk menampilkan modal
           
          });
         });  
    </script>
	
</body>

</html>




<?php
  }
  require_once("modul/close/form_tutup.php"); 
}else{
  session_destroy();                     
  echo "<script>alert('Anda telah keluar dari halaman'); window.location = 'index.html'</script>";
}
  ?>
