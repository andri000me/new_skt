   <?php
   include "config/config.php";
   include "config/library.php";
   include "config/fungsi_indotgl.php";
   include "config/fungsi_combobox.php";
   include "config/class_paging.php";

   // Bagian Home
   if ($_GET['module']=='home'){
   ?>


   <section class="content-header">
       <h1>

           <small>MMS version 1.0</small>
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
    
     if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' || $_SESSION['leveluser']=='3' || $_SESSION['leveluser']=='4'){
  ?>

           <div class="col-md-3 col-sm-6 col-xs-12">
               <a href="tipe.html">
                   <div class="info-box">
                       <span class="info-box-icon bg-aqua"><img src="img/u.png" width="80%" /></span>

                       <div class="info-box-content">

                           <span class="info-box-number">TIPE</span>
                       </div>
                       <!-- /.info-box-content -->
                   </div>
               </a>
               <!-- /.info-box -->
           </div>
           <!-- /.col -->
           <div class="col-md-3 col-sm-6 col-xs-12">
               <a href="jenis.html">
                   <div class="info-box">
                       <span class="info-box-icon bg-aqua"><img src="img/m.png" width="80%"/></span>

                       <div class="info-box-content">

                           <span class="info-box-number">JENIS</span>
                       </div>
                       <!-- /.info-box-content -->
                   </div>
               </a>
               <!-- /.info-box -->
           </div>
           <!-- /.col -->
           <div class="col-md-3 col-sm-6 col-xs-12">
               <a href="kantor-bayar.html">
                   <div class="info-box">
                       <span class="info-box-icon bg-red"><img src="img/p.png" width="80%" /></span>

                       <div class="info-box-content">

                           <span class="info-box-number">KANTOR BAYAR</span>
                       </div>
                       <!-- /.info-box-content -->
                   </div>
               </a>
               <!-- /.info-box -->
           </div>
           <!-- /.col -->
           <div class="col-md-3 col-sm-6 col-xs-12">
               <a href="nasabah.html">
                   <div class="info-box">
                       <span class="info-box-icon bg-green"><img src="img/profil.png" width=50px /></span>

                       <div class="info-box-content">

                           <span class="info-box-number">NASABAH</span>
                       </div>
                       <!-- /.info-box-content -->
                   </div>
               </a>
               <!-- /.info-box -->
           </div>

           <div class="col-md-3 col-sm-6 col-xs-12">
               <a href="pinjaman-pensiun.html">
                   <div class="info-box">
                       <span class="info-box-icon bg-aqua"><img src="img/pensiun.png" width=70px /></span>

                       <div class="info-box-content">

                           <span class="info-box-number">PINJAMAN PENSIUN</span>
                       </div>
                       <!-- /.info-box-content -->
                   </div>
               </a>
               <!-- /.info-box -->
           </div>
           <!-- /.col -->
           <div class="col-md-3 col-sm-6 col-xs-12">
               <a href="pinjaman-umum.html">
                   <div class="info-box">
                       <span class="info-box-icon bg-brown"><img src="img/umum.png" width=40px /></span>

                       <div class="info-box-content">

                           <span class="info-box-number">PINJAMAN UMUM</span>
                       </div>
                       <!-- /.info-box-content -->
                   </div>
               </a>
               <!-- /.info-box -->
           </div>
           <!-- /.col -->
           <div class="col-md-3 col-sm-6 col-xs-12">
               <a href="pinjaman-mikro.html">
                   <div class="info-box">
                       <span class="info-box-icon bg-yellow"><img src="img/mikro.png" width=70px /></span>

                       <div class="info-box-content">

                           <span class="info-box-number">PINJAMAN MIKRO</span>
                       </div>
                       <!-- /.info-box-content -->
                   </div>
               </a>
               <!-- /.info-box -->
           </div>
           <!-- /.col -->
           <div class="col-md-3 col-sm-6 col-xs-12">
               <a href="company-info.html">
                   <div class="info-box">
                       <span class="info-box-icon bg-brown"><img src="img/company.png" width=60px /></span>

                       <div class="info-box-content">

                           <span class="info-box-number">COMPANY INFO</span>
                       </div>
                       <!-- /.info-box-content -->
                   </div>
               </a>
               <!-- /.info-box -->
           </div>

           <!-- /.col -->
           <div class="col-md-3 col-sm-6 col-xs-12">
               <a href="jabatan.html">
                   <div class="info-box">
                       <span class="info-box-icon bg-green"><img src="img/jabatan.png" width=60px /></span>

                       <div class="info-box-content">

                           <span class="info-box-number">JABATAN</span>
                       </div>
                       <!-- /.info-box-content -->
                   </div>
               </a>
               <!-- /.info-box -->
           </div>
           <?php
     }
   
  ?>


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

           <!-- /.col -->
       </div>
   </section>
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
        
          $tampil=mysql_query("SELECT * FROM tbl_log ORDER BY id_log DESC LIMIT 0,6");
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
 
}



// Bagian tipe
elseif ($_GET['module']=='tipe'){
  if ($_SESSION['leveluser']=='1'  ){
    include "modul/tipe/tipe.php";
  }
}

// Bagian jenis
elseif ($_GET['module']=='jenis'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/jenis/jenis.php";
  }
}

// Bagian kantor bayar
elseif ($_GET['module']=='kantor_bayar'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' || $_SESSION['leveluser']=='3'){
    include "modul/kantor_bayar/kantor_bayar.php";
  }
}

// Bagian perusahaan
elseif ($_GET['module']=='perusahaan'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' || $_SESSION['leveluser']=='3'){
    include "modul/kantor_bayar/kantor_bayar.php";
  }
}

// Bagian nasabah
elseif ($_GET['module']=='nasabah_pensiun'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' || $_SESSION['leveluser']=='3' || $_SESSION['leveluser']=='4' ){
    include "modul/nasabah/nasabah.php";
  }
}

// Bagian nasabah
elseif ($_GET['module']=='nasabah_umum'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' || $_SESSION['leveluser']=='3' || $_SESSION['leveluser']=='4'  ){
    include "modul/nasabah/nasabah.php";
  }
}

// Bagian nasabah
elseif ($_GET['module']=='nasabah_mikro'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' || $_SESSION['leveluser']=='3' || $_SESSION['leveluser']=='4'  ){
    include "modul/nasabah/nasabah.php";
  }
}

// Bagian Wilayah
elseif ($_GET['module']=='wilayah'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4'  ){
    include "modul/wilayah/wilayah.php";
  }
}

// Bagian Kelompok
elseif ($_GET['module']=='kelompok'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4'  ){
    include "modul/kelompok/kelompok.php";
  }
}

// Bagian transaksi Pensiun
elseif ($_GET['module']=='transaksi_pensiun'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/transaksi_pensiun/transaksi.php";
  }
}

// Bagian transaksi umum
elseif ($_GET['module']=='transaksi_umum'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2'  ){
    include "modul/transaksi_umum/transaksi_umum.php";
  }
}

// Bagian transaksi mikro
elseif ($_GET['module']=='transaksi_mikro'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4'  ){
    include "modul/transaksi_mikro/transaksi_mikro.php";
  }
}

// Bagian Company Info
elseif ($_GET['module']=='company_info'){
  if ($_SESSION['leveluser']=='1'  ){
    include "modul/company_info/company_info.php";
  }
}

// Bagian Jabatan
elseif ($_GET['module']=='jabatan'){
  if ($_SESSION['leveluser']=='1'  ){
    include "modul/jabatan/jabatan.php";
  }
}

// Bagian pinjaman_pensiun
elseif ($_GET['module']=='pinjaman_pensiun'){
  if ($_SESSION['leveluser']=='1'  ){
    include "modul/pinjaman_pensiun/pinjaman_pensiun.php";
  }
}

// Bagian pinjaman_umum
elseif ($_GET['module']=='pinjaman_umum'){
  if ($_SESSION['leveluser']=='1'  ){
    include "modul/pinjaman_umum/pinjaman_umum.php";
  }
}

// Bagian pinjaman_mikro
elseif ($_GET['module']=='pinjaman_mikro'){
  if ($_SESSION['leveluser']=='1'  ){
    include "modul/pinjaman_mikro/pinjaman_mikro.php";
  }
}

// Bagian general jurnal
elseif ($_GET['module']=='general_jurnal'){
  if ($_SESSION['leveluser']=='1'  ){
    include "modul/general_jurnal/general_jurnal2.php";
  }
}

// Bagian angsuran pensiun
elseif ($_GET['module']=='angsuran_pensiun'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/angsuran_pensiun/angsuran.php";
  }
}

// Bagian angsuran umum
elseif ($_GET['module']=='angsuran_umum'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2'  ){
    include "modul/angsuran_umum/angsuran.php";
  }
}

// Bagian angsuran mikro
elseif ($_GET['module']=='angsuran_mikro'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4'  ){
    include "modul/angsuran_mikro/angsuran.php";
  }
}

// Bagian pelunasan mikro
elseif ($_GET['module']=='pelunasan_mikro'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4'  ){
    include "modul/pelunasan_mikro/pelunasan.php";
  }
}

// Bagian laporan penyaluran kredit pensiun
elseif ($_GET['module']=='laporan_penyaluran_kredit_pensiun'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/laporan_penyaluran_kredit_pensiun/laporan_penyaluran_kredit_pensiun.php";
  }
}
// Bagian laporan_pelunasan_kredit_pensiun
elseif ($_GET['module']=='laporan_pelunasan_kredit_pensiun'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/laporan_pelunasan_kredit_pensiun/laporan_pelunasan_kredit_pensiun.php";
  }
}
// Bagian laporan_setor_sendiri_kredit_pensiun
elseif ($_GET['module']=='laporan_setor_sendiri_kredit_pensiun'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/laporan_setor_sendiri_kredit_pensiun/laporan_setor_sendiri_kredit_pensiun.php";
  }
}
// Bagian laporan_daftar_nominatif_pensiun
elseif ($_GET['module']=='laporan_daftar_nominatif_pensiun'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/laporan_daftar_nominatif_pensiun/laporan_daftar_nominatif_pensiun.php";
  }
}
// Bagian laporan_daftar_pelunasan_pensiun
elseif ($_GET['module']=='laporan_daftar_pelunasan_pensiun'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/laporan_daftar_pelunasan_pensiun/laporan_daftar_pelunasan_pensiun.php";
  }
}
// Bagian laporan_daftar_tagihan_pensiun
elseif ($_GET['module']=='laporan_daftar_tagihan_pensiun'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='3'  ){
    include "modul/laporan_daftar_tagihan_pensiun/laporan_daftar_tagihan_pensiun.php";
  }
}


// Bagian laporan penyaluran kredit umum
elseif ($_GET['module']=='laporan_penyaluran_kredit_umum'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2'  ){
    include "modul/laporan_penyaluran_kredit_umum/laporan_penyaluran_kredit_umum.php";
  }
}
// Bagian laporan_pelunasan_kredit_umum
elseif ($_GET['module']=='laporan_pelunasan_kredit_umum'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' ){
    include "modul/laporan_pelunasan_kredit_umum/laporan_pelunasan_kredit_umum.php";
  }
}
// Bagian laporan_setor_sendiri_kredit_umum
elseif ($_GET['module']=='laporan_setor_sendiri_kredit_umum'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' ){
    include "modul/laporan_setor_sendiri_kredit_umum/laporan_setor_sendiri_kredit_umum.php";
  }
}
// Bagian laporan_daftar_nominatif_umum
elseif ($_GET['module']=='laporan_daftar_nominatif_umum'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' ){
    include "modul/laporan_daftar_nominatif_umum/laporan_daftar_nominatif_umum.php";
  }
}
// Bagian laporan_daftar_pelunasan_umum
elseif ($_GET['module']=='laporan_daftar_pelunasan_umum'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' ){
    include "modul/laporan_daftar_pelunasan_umum/laporan_daftar_pelunasan_umum.php";
  }
}
// Bagian laporan_daftar_tagihan_umum
elseif ($_GET['module']=='laporan_daftar_tagihan_umum'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='2' ){
    include "modul/laporan_daftar_tagihan_umum/laporan_daftar_tagihan_umum.php";
  }
}


// Bagian laporan penyaluran kredit mikro
elseif ($_GET['module']=='laporan_penyaluran_kredit_mikro'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4' ){
    include "modul/laporan_penyaluran_kredit_mikro/laporan_penyaluran_kredit_mikro.php";
  }
}
// Bagian laporan_pelunasan_kredit_mikro
elseif ($_GET['module']=='laporan_pelunasan_kredit_mikro'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4' ){
    include "modul/laporan_pelunasan_kredit_mikro/laporan_pelunasan_kredit_mikro.php";
  }
}
// Bagian laporan_setor_sendiri_kredit_mikro
elseif ($_GET['module']=='laporan_setor_sendiri_kredit_mikro'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4' ){
    include "modul/laporan_setor_sendiri_kredit_mikro/laporan_setor_sendiri_kredit_mikro.php";
  }
}
// Bagian laporan_daftar_nominatif_mikro
elseif ($_GET['module']=='laporan_daftar_nominatif_mikro'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4' ){
    include "modul/laporan_daftar_nominatif_mikro/laporan_daftar_nominatif_mikro.php";
  }
}
// Bagian laporan_daftar_pelunasan_mikro
elseif ($_GET['module']=='laporan_daftar_pelunasan_mikro'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4' ){
    include "modul/laporan_daftar_pelunasan_mikro/laporan_daftar_pelunasan_mikro.php";
  }
}
// Bagian laporan_daftar_tagihan_mikro
elseif ($_GET['module']=='laporan_daftar_tagihan_mikro'){
  if ($_SESSION['leveluser']=='1' || $_SESSION['leveluser']=='4' ){
    include "modul/laporan_daftar_tagihan_mikro/laporan_daftar_tagihan_mikro.php";
  }
}


// Bagian no perkiraan
elseif ($_GET['module']=='no_perkiraan'){
  if ($_SESSION['leveluser']=='1'  ){
    include "modul/no_perkiraan/no_perkiraan.php";
  }
}

// Bagian sub group perkiraan
elseif ($_GET['module']=='sub_group_perkiraan'){
  if ($_SESSION['leveluser']=='1'  ){
    include "modul/sub_group_perkiraan/sub_group_perkiraan.php";
  }
}

// Bagian setting coa
elseif ($_GET['module']=='setting_coa'){
  if ($_SESSION['leveluser']=='1'  ){
    include "modul/setting_coa/setting_coa.php";
  }
}

// Bagian User
elseif ($_GET['module']=='users'){
   include "modul/users/users.php";
 }



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