   <?php
   include "config/config.php";
   include "config/library.php";
   include "config/fungsi_indotgl.php";
   include "config/fungsi_combobox.php";
   include "config/class_paging.php";
   $module=$_GET['module'];
   $module_val=mysql_query("SELECT * FROM module WHERE nama_module='$module' AND aktif='Y'");
   $get_module=mysql_fetch_array($module_val);
   $modul=$get_module[nama_module];
   $dir_modul=$get_module[dir_module];
   //var_dump($modul);
   // Bagian Home
   if ($_GET['module']=='home'){
   ?>


   <section class="content-header">
       <h1>

           <small>version 1.0</small>
       </h1>
       <ol class="breadcrumb">
           <li><a href="home.html"><i class="fa fa-dashboard"></i> Home</a></li>
           <li class="active">
               <?php echo"$hari_ini,"; ?>
               <?php echo tgl_indo(date('Y m d'));  ?>
               <?php echo "|";  ?>
           </li>
       </ol>
   </section>
   <!-- Main content -->
   <section class="content">
       <!-- Info boxes -->
       <div class="row">

           <?php
    
     $level=$_SESSION['leveluser'];
     if($level==1){
      $q=mysql_query("SELECT * FROM tbl_icon_layout WHERE tampil='Y' ORDER BY level,urut ASC ");
     }else{
      $q=mysql_query("SELECT * FROM tbl_icon_layout WHERE tampil='Y' AND level ='$level' ORDER BY level,urut ASC ");
     }
      
      while($l=mysql_fetch_array($q)){
        $level=$l[level];
        $gambar=$l[gambar];
        if($gambar != ''){
          $img=$gambar;
        }else{
          $img='user_blank.jpg';
        }
      
  echo"
      <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href='$l[url]'>
                   <div class='info-box'>
                       <span class='info-box-icon bg-$l[warna]'><img src='img/$img' width=60px /></span>
                       <div class='info-box-content'>
                       <span class='info-box-number'>$l[nama]</span>
                       </div>
                       <!-- /.info-box-content -->
                   </div>
               </a>
               <!-- /.info-box -->
           </div>
  ";
        
     }
   
  ?>

            <!-- /.col -->
           <!-- fix for small devices only -->
           <div class="clearfix visible-sm-block"></div>
           <!-- /.col -->
           <div class="col-md-3 col-sm-6 col-xs-12">
               <a href="users.html">
                   <div class="info-box">
                       <span class="info-box-icon bg-yellow"><img src="img/user.png" /></span>

                       <div class="info-box-content">

                           <span class="info-box-number">USER</span>
                       </div>
                       <!-- /.info-box-content -->
                   </div>
               </a>
               <!-- /.info-box -->
           </div>
            </div>
<section class="content">
   <?php
  if ($_SESSION[leveluser]=='1'){
    ?>
   <div class="col-md-6">
       <div class="box box-info">
           <div class="box-header with-border">
               <h3 class="box-title">Last Login</h3>

               <div class="box-tools pull-right">
                   <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                   </button>
                   <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
               </div>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
               <div class="table-responsive">
                   <table class="table no-margin">
                       <thead>
                           <tr>
                               <th>No</th>
                               <th>Nama Lengkap</th>
                               <th>Tgl Login</th>
                               <th>Jam Login</th>
                               <th>Jam Logout</th>
                               <th>Status</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php 
        $p      = new Paging;
        $batas  = 40;
        $posisi = $p->cariPosisi($batas);
        
          $tampil=mysql_query("SELECT * FROM tbl_log ORDER BY id_log DESC LIMIT 0,4");
        $no = $posisi+1;
        $no1 = 0; 
        while($r=mysql_fetch_array($tampil)){
        
        $no1++; 
        echo"
                  <tr>
                    <td>$no1</td>
                    <td>$r[username]</td>
                    <td>$r[tanggal]</td>
                    <td>$r[jamin]</td>
          <td>$r[jamout]</td>";
          if($r[status]=='online'){
          echo"<td><span class='label label-success'>$r[status]</span></td>"; 
          }else{
          echo"<td><span class='label label-danger'>$r[status]</span></td>";    
          }
          
                  echo"</tr>
                  
                 ";
        }
        ?>

                       </tbody>
                   </table>
               </div>
               <!-- /.table-responsive -->
           </div>
           <!-- /.box-body -->

           <!-- /.box-footer -->
       </div>
   </div>
   
   <?php
  }
  ?>
 <?php
  if ($_SESSION[leveluser]=='1'){
    ?>

   <div class="col-md-6">
       <!-- USERS LIST -->
       <div class="box box-danger">
           <div class="box-header with-border">
               <h3 class="box-title">Members</h3>

               <div class="box-tools pull-right">
                   <span class="label label-danger">
                       <?php
          $jml_user=mysql_query("SELECT COUNT(username)AS jml FROM users WHERE blokir='N' ");
          $w=mysql_fetch_array($jml_user);
          echo"$w[jml] Members";
          ?>
                   </span>
                   <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                   </button>
                   <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                   </button>
               </div>
           </div>
           <!-- /.box-header -->
           <div class="box-body no-padding">
               <ul class="users-list clearfix">
                   <?php 
        $tampil=mysql_query("SELECT * FROM users,tbl_level WHERE users.level=tbl_level.id_level AND users.blokir='N' ORDER BY nama_lengkap ");
        while($r=mysql_fetch_array($tampil)){
         echo"  
                    <li>";
          if($r[foto]==''){
                      echo"<img src=images/user_blank.jpg alt='Blank Image'  > ";
          }else{
            echo"<img src='images/user/small_$r[foto]' alt='$r[username]' >";
          }
                      echo"<a class='users-list-name' href='editdata-users-$r[username].html'>$r[nama_lengkap]</a>
                      <span class='users-list-date'>$r[nama_level] </br> $r[region]</span>
                    </li>";
        }
                    ?>
               </ul>
               <!-- /.users-list -->
           </div>
           <!-- /.box-body -->
           <div class="box-footer text-center">
               <a href="javascript:void(0)" onclick="location.href='users.html'" class="uppercase">View All Users</a>

           </div>
           <!-- /.box-footer -->
       </div>
       <!--/.box -->
   </div>

   <?php    
  }
  ?>


        </section>   <!-- /.col -->
      
   </section>
    

<?php 
}elseif ($module==$modul){
  include "$dir_modul";
}

/*// Bagian tipe
elseif ($_GET['module']=='tipe'){
  // if ($_SESSION['leveluser']=='1'  ){
    include "modul/tipe/tipe.php";
  // }
}

// Bagian jenis
elseif ($_GET['module']=='jenis'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/jenis/jenis.php";
  // }
}

// Bagian kantor bayar
elseif ($_GET['module']=='kantor_bayar'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' || $_SESSION['leveluser']=='3'){
    include "modul/kantor_bayar/kantor_bayar.php";
  // }
}

// Bagian perusahaan
elseif ($_GET['module']=='perusahaan'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' || $_SESSION['leveluser']=='3'){
    include "modul/kantor_bayar/kantor_bayar.php";
  // }
}

// Bagian nasabah
elseif ($_GET['module']=='nasabah_pensiun'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' || $_SESSION['leveluser']=='3' || $_SESSION['leveluser']=='4' ){
    include "modul/nasabah/nasabah.php";
  // }
}

// Bagian nasabah
elseif ($_GET['module']=='nasabah_umum'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' || $_SESSION['leveluser']=='3' || $_SESSION['leveluser']=='4'  ){
    include "modul/nasabah/nasabah.php";
  // }
}

// Bagian nasabah
elseif ($_GET['module']=='nasabah_mikro'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' || $_SESSION['leveluser']=='3' || $_SESSION['leveluser']=='4'  ){
    include "modul/nasabah/nasabah.php";
  // }
}

// Bagian Wilayah
elseif ($_GET['module']=='wilayah'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4'  ){
    include "modul/wilayah/wilayah.php";
  // }
}

// Bagian Kelompok
elseif ($_GET['module']=='kelompok'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4'  ){
    include "modul/kelompok/kelompok.php";
  // }
}

// Bagian transaksi Pensiun
elseif ($_GET['module']=='transaksi_pensiun'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/transaksi_pensiun/transaksi.php";
  // }
}

// Bagian transaksi umum
elseif ($_GET['module']=='transaksi_umum'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2'  ){
    include "modul/transaksi_umum/transaksi_umum.php";
  // }
}

// Bagian transaksi mikro
elseif ($_GET['module']=='transaksi_mikro'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4'  ){
    include "modul/transaksi_mikro/transaksi_mikro.php";
  // }
}

// Bagian Company Info
elseif ($_GET['module']=='company_info'){
  // if ($_SESSION['leveluser']=='1'  ){
    include "modul/company_info/company_info.php";
  // }
}

// Bagian Jabatan
elseif ($_GET['module']=='jabatan'){
  // if ($_SESSION['leveluser']=='1'  ){
    include "modul/jabatan/jabatan.php";
  // }
}

// Bagian pinjaman_pensiun
elseif ($_GET['module']=='pinjaman_pensiun'){
  // if ($_SESSION['leveluser']=='1'  ){
    include "modul/pinjaman_pensiun/pinjaman_pensiun.php";
  // }
}

// Bagian pinjaman_umum
elseif ($_GET['module']=='pinjaman_umum'){
  // if ($_SESSION['leveluser']=='1'  ){
    include "modul/pinjaman_umum/pinjaman_umum.php";
  // }
}

// Bagian pinjaman_mikro
elseif ($_GET['module']=='pinjaman_mikro'){
  // if ($_SESSION['leveluser']=='1'  ){
    include "modul/pinjaman_mikro/pinjaman_mikro.php";
  // }
}

// Bagian general jurnal
elseif ($_GET['module']=='general_jurnal'){
  // if ($_SESSION['leveluser']=='1'  ){
    include "modul/general_jurnal/general_jurnal2.php";
  // }
}

// Bagian angsuran pensiun
elseif ($_GET['module']=='angsuran_pensiun'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/angsuran_pensiun/angsuran.php";
  // }
}

// Bagian angsuran umum
elseif ($_GET['module']=='angsuran_umum'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2'  ){
    include "modul/angsuran_umum/angsuran.php";
  // }
}

// Bagian angsuran mikro
elseif ($_GET['module']=='angsuran_mikro'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4'  ){
    include "modul/angsuran_mikro/angsuran.php";
  // }
}

// Bagian pelunasan mikro
elseif ($_GET['module']=='pelunasan_mikro'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4'  ){
    include "modul/pelunasan_mikro/pelunasan.php";
  // }
}

// Bagian pelunasan umum
elseif ($_GET['module']=='pelunasan_umum'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4'  ){
    include "modul/pelunasan_umum/pelunasan.php";
  // }
}

// Bagian realisasi tagihan mikro
elseif ($_GET['module']=='realisasi_tagihan_mikro'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4'  ){
    include "modul/realisasi_tagihan_mikro/realisasi_tagihan_mikro.php";
  // }
}

// Bagian realisasi tagihan umum
elseif ($_GET['module']=='realisasi_tagihan_umum'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4'  ){
    include "modul/realisasi_tagihan_umum/realisasi_tagihan_umum.php";
  // }
}

// Bagian laporan penyaluran kredit pensiun
elseif ($_GET['module']=='laporan_penyaluran_kredit_pensiun'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/laporan_penyaluran_kredit_pensiun/laporan_penyaluran_kredit_pensiun.php";
  // }
}
// Bagian laporan_pelunasan_kredit_pensiun
elseif ($_GET['module']=='laporan_pelunasan_kredit_pensiun'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/laporan_pelunasan_kredit_pensiun/laporan_pelunasan_kredit_pensiun.php";
  // }
}
// Bagian laporan_setor_sendiri_kredit_pensiun
elseif ($_GET['module']=='laporan_setor_sendiri_kredit_pensiun'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/laporan_setor_sendiri_kredit_pensiun/laporan_setor_sendiri_kredit_pensiun.php";
  // }
}
// Bagian laporan_daftar_nominatif_pensiun
elseif ($_GET['module']=='laporan_daftar_nominatif_pensiun'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/laporan_daftar_nominatif_pensiun/laporan_daftar_nominatif_pensiun.php";
  // }
}
// Bagian laporan_daftar_pelunasan_pensiun
elseif ($_GET['module']=='laporan_daftar_pelunasan_pensiun'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/laporan_daftar_pelunasan_pensiun/laporan_daftar_pelunasan_pensiun.php";
  // }
}
// Bagian laporan_daftar_tagihan_pensiun
elseif ($_GET['module']=='laporan_daftar_tagihan_pensiun'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/laporan_daftar_tagihan_pensiun/laporan_daftar_tagihan_pensiun.php";
  // }
}


// Bagian laporan penyaluran kredit umum
elseif ($_GET['module']=='laporan_penyaluran_kredit_umum'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2'  ){
    include "modul/laporan_penyaluran_kredit_umum/laporan_penyaluran_kredit_umum.php";
  // }
}
// Bagian laporan_pelunasan_kredit_umum
elseif ($_GET['module']=='laporan_pelunasan_kredit_umum'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' ){
    include "modul/laporan_pelunasan_kredit_umum/laporan_pelunasan_kredit_umum.php";
  // }
}
// Bagian laporan_setor_sendiri_kredit_umum
elseif ($_GET['module']=='laporan_setor_sendiri_kredit_umum'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' ){
    include "modul/laporan_setor_sendiri_kredit_umum/laporan_setor_sendiri_kredit_umum.php";
  // }
}
// Bagian laporan_daftar_nominatif_umum
elseif ($_GET['module']=='laporan_daftar_nominatif_umum'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' ){
    include "modul/laporan_daftar_nominatif_umum/laporan_daftar_nominatif_umum.php";
  // }
}
// Bagian laporan_daftar_pelunasan_umum
elseif ($_GET['module']=='laporan_daftar_pelunasan_umum'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' ){
    include "modul/laporan_daftar_pelunasan_umum/laporan_daftar_pelunasan_umum.php";
  // }
}
// Bagian laporan_daftar_tagihan_umum
elseif ($_GET['module']=='laporan_daftar_tagihan_umum'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' ){
    include "modul/laporan_daftar_tagihan_umum/laporan_daftar_tagihan_umum.php";
  // }
}
// Bagian cetak_bukti_angsuran_umum
elseif ($_GET['module']=='cetak_bukti_angsuran_umum'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' ){
    include "modul/cetak_bukti_angsuran_umum/cetak_bukti_angsuran_umum.php";
  // }
}


// Bagian laporan penyaluran kredit mikro
elseif ($_GET['module']=='laporan_penyaluran_kredit_mikro'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4' ){
    include "modul/laporan_penyaluran_kredit_mikro/laporan_penyaluran_kredit_mikro.php";
  // }
}
// Bagian laporan_pelunasan_kredit_mikro
elseif ($_GET['module']=='laporan_pelunasan_kredit_mikro'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4' ){
    include "modul/laporan_pelunasan_kredit_mikro/laporan_pelunasan_kredit_mikro.php";
  // }
}
// Bagian laporan_setor_sendiri_kredit_mikro
elseif ($_GET['module']=='laporan_setor_sendiri_kredit_mikro'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4' ){
    include "modul/laporan_setor_sendiri_kredit_mikro/laporan_setor_sendiri_kredit_mikro.php";
  // }
}
// Bagian laporan_daftar_nominatif_mikro
elseif ($_GET['module']=='laporan_daftar_nominatif_mikro'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4' ){
    include "modul/laporan_daftar_nominatif_mikro/laporan_daftar_nominatif_mikro.php";
  // }
}
// Bagian laporan_daftar_pelunasan_mikro
elseif ($_GET['module']=='laporan_daftar_pelunasan_mikro'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4' ){
    include "modul/laporan_daftar_pelunasan_mikro/laporan_daftar_pelunasan_mikro.php";
  // }
}
// Bagian laporan_daftar_tagihan_mikro
elseif ($_GET['module']=='laporan_daftar_tagihan_mikro'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4' ){
    include "modul/laporan_daftar_tagihan_mikro/laporan_daftar_tagihan_mikro.php";
  // }
}
// Bagian cetak_bukti_angsuran_mikro
elseif ($_GET['module']=='cetak_bukti_angsuran_mikro'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4' ){
    include "modul/cetak_bukti_angsuran_mikro/cetak_bukti_angsuran_mikro.php";
  // }
}

// Bagian cetak_form_terima_bagi_hasil_mikro
elseif ($_GET['module']=='cetak_form_terima_bagi_hasil_mikro'){
  // if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4' ){
    include "modul/cetak_form_terima_bagi_hasil_mikro/cetak_form_terima_bagi_hasil_mikro.php";
  // }
}


// Bagian no perkiraan
elseif ($_GET['module']=='no_perkiraan'){
  // if ($_SESSION['leveluser']=='1'  ){
    include "modul/no_perkiraan/no_perkiraan.php";
  // }
}

// Bagian sub group perkiraan
elseif ($_GET['module']=='sub_group_perkiraan'){
  // if ($_SESSION['leveluser']=='1'  ){
    include "modul/sub_group_perkiraan/sub_group_perkiraan.php";
  // }
}

// Bagian setting coa
elseif ($_GET['module']=='setting_coa'){
  // if ($_SESSION['leveluser']=='1'  ){
    include "modul/setting_coa/setting_coa.php";
  // }
}

// Bagian Layout
elseif ($_GET['module']=='layout'){
  // if ($_SESSION['leveluser']=='1'){
    include "modul/layout/layout.php";
  // }
}

// Bagian Hak Akses
elseif ($_GET['module']=='hak_akses'){
  // if ($_SESSION['leveluser']=='1'){
    include "modul/hak_akses/hak_akses.php";
  // }
}

// Bagian Group Menu
elseif ($_GET['module']=='group_menu'){
  // if ($_SESSION['leveluser']=='1'){
    include "modul/group_menu/group_menu.php";
  // }
}

// Bagian Menu
elseif ($_GET['module']=='menu'){
//  if ($_SESSION['leveluser']=='1'){
    include "modul/menu/menu.php";
//  }
}

// Bagian Log User
elseif ($_GET['module']=='log_user'){
//  if ($_SESSION['leveluser']=='1'){
    include "modul/log_user/log_user.php";
//  }
}

// Bagian User
elseif ($_GET['module']=='users'){
   include "modul/users/users.php";
 }*/



// Apabila modul tidak ditemukan
else{ ?>
   <section class="content-header">
       <h1>

       </h1>

   </section>

   <!-- Main content -->
   <section class="content">

       <div class="error-page">
           <h2 class="headline text-red"></h2>

           <div class="error-content">
               <h3><i class="fa fa-warning text-red"></i> Oops!Modul <b>
                       <?php echo"$_GET[module] " ?></b> Belum Lengkap.</h3>



           </div>
       </div>
       <!-- /.error-page -->

   </section>
   <?php
}


?>