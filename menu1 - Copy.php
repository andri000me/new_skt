<?php
error_reporting(0);
include "../config/koneksi.php";

// Start Menu Master
$cek=umenu_akses("?module=teknik",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='1'   ){
echo " <li class='";if ($_GET[module]=='tipe' || $_GET[module]=='jenis' || $_GET[module]=='kantor_bayar' || $_GET[module]=='nasabah' || $_GET[module]=='wilayah' || $_GET[module]=='kelompok' ){
  echo"active ";
}else{  echo""; }
  echo"treeview'>
          <a href='#'>
            <i class='fa fa-key'></i>
            <span>Master</span>
            <span class='pull-right-container'>
             <i class='fa fa-angle-left pull-right'></i>
            </span>
          </a>
          <ul class='treeview-menu'>
            <li><a href=tipe.html><i class='fa fa-circle-o text-aqua'></i>Tipe</a></li>
            <li><a href=jenis.html><i class='fa fa-circle-o text-aqua'></i>Jenis</a></li>
            <li><a href=kantor-bayar.html><i class='fa fa-circle-o text-aqua'></i>Kantor Bayar</a></li>
            <li><a href=nasabah.html><i class='fa fa-circle-o text-aqua'></i>Nasabah</a></li>
            <li><a href=wilayah.html><i class='fa fa-circle-o text-aqua'></i>Wilayah</a></li>
            <li><a href=kelompok.html><i class='fa fa-circle-o text-aqua'></i>Kelompok</a></li>
          </ul>
        </li>";
}
// End Menu Master
/*
$cek=umenu_akses("?module=teknik",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='1'   ){
echo " <li class='";if ($_GET[module]=='transaksi_pensiun' || $_GET[module]=='transaksi_umum' || $_GET[module]=='transaksi_mikro' || $_GET[module]=='angsuran_pensiun' || $_GET[module]=='angsuran_umum' || $_GET[module]=='angsuran_mikro'){
  echo"active ";
}else{  echo""; }
  echo"treeview'>
          <a href='#'>
            <i class='fa fa-newspaper-o'></i>
            <span>Transaksi</span>
            <span class='pull-right-container'>
             <i class='fa fa-angle-left pull-right'></i>
            </span>
          </a>
      
          <ul class='treeview-menu'>
            <li><a href=transaksi.html><i class='fa fa-circle-o text-aqua'></i>Pinjaman Pensiun</a></li>
            <li><a href=transaksi-umum.html><i class='fa fa-circle-o text-success'></i>Pinjaman Umum</a></li>
      <li><a href=transaksi-mikro.html><i class='fa fa-circle-o text-warning'></i>Pinjaman Mikro</a></li>
            <li><a href='angsuran-pensiun.html'><i class='fa fa-circle-o text-danger'></i><span>Angsuran Pensiun</span></a></li>
      <li><a href='angsuran-umum.html'><i class='fa fa-circle-o text-danger'></i><span>Angsuran Umum</span></a></li>
      <li><a href='angsuran-mikro.html'><i class='fa fa-circle-o text-danger'></i><span>Angsuran Mikro</span></a></li>
          </ul>
        </li>";
}

*/



echo "  
    ";
// Start Menu Transaksi
$cek=umenu_akses("?module=teknik",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='1' ){
echo "<li class='";if ($_GET[module]=='transaksi_pensiun' || $_GET[module]=='transaksi_umum' || $_GET[module]=='transaksi_mikro' || $_GET[module]=='angsuran_pensiun' || $_GET[module]=='angsuran_umum' || $_GET[module]=='angsuran_mikro' || $_GET[module]=='pelunasan_mikro' || $_GET[module]=='general_jurnal'){
  echo"active ";
}else{  echo""; }
  echo"treeview'>
          <a href='#'>
            <i class='fa fa-newspaper-o'></i> <span>Transaksi</span>
            <span class='pull-right-container'>
              <i class='fa fa-angle-left pull-right'></i>
            </span>
          </a>
          <ul class=treeview-menu>";
            $cek=umenu_akses("?module=teknik",$_SESSION[sessid]);
      if($cek==1 OR $_SESSION[leveluser]=='1'   ){
      echo " <li class='";if ($_GET[module]=='transaksi_pensiun' || $_GET[module]=='angsuran_pensiun' ){
        echo"active ";
      }else{  echo""; }
        echo"treeview'>
          <a href='#'>
            <i class='fa fa-calendar-o'></i>
            <span>Pensiun</span>
            <span class='pull-right-container'>
             <i class='fa fa-angle-left pull-right'></i>
            </span>
          </a>
          <ul class='treeview-menu'>
            <li><a href=transaksi.html><i class='fa fa-circle-o text-aqua'></i>Pinjaman Pensiun</a></li>
            <li><a href='angsuran-pensiun.html'><i class='fa fa-circle-o text-danger'></i><span>Angsuran Pensiun</span></a></li>
      </ul>
    
        </li>";
}

        echo"  </ul>
    <ul class=treeview-menu>";
            $cek=umenu_akses("?module=teknik",$_SESSION[sessid]);
      if($cek==1 OR $_SESSION[leveluser]=='1'   ){
      echo " <li class='";if ($_GET[module]=='transaksi_umum' || $_GET[module]=='angsuran_umum' ){
        echo"active ";
      }else{  echo""; }
        echo"treeview'>
          <a href='#'>
            <i class='fa fa-calendar-o'></i>
            <span>Umum</span>
            <span class='pull-right-container'>
             <i class='fa fa-angle-left pull-right'></i>
            </span>
          </a>
          <ul class='treeview-menu'>
            <li><a href=transaksi-umum.html><i class='fa fa-circle-o text-aqua'></i>Pinjaman Umum</a></li>
            <li><a href='angsuran-umum.html'><i class='fa fa-circle-o text-danger'></i><span>Angsuran Umum</span></a></li>
      </ul>
    
        </li>";
}

        echo"  </ul>
    
    <ul class=treeview-menu>";
            $cek=umenu_akses("?module=teknik",$_SESSION[sessid]);
      if($cek==1 OR $_SESSION[leveluser]=='1'   ){
      echo " <li class='";if ($_GET[module]=='transaksi_mikro' || $_GET[module]=='angsuran_mikro' || $_GET[module]=='pelunasan_mikro'){
        echo"active ";
      }else{  echo""; }
        echo"treeview'>
          <a href='#'>
            <i class='fa fa-calendar-o'></i>
            <span>Mikro</span>
            <span class='pull-right-container'>
             <i class='fa fa-angle-left pull-right'></i>
            </span>
          </a>
          <ul class='treeview-menu'>
            <li><a href=transaksi-mikro.html><i class='fa fa-circle-o text-aqua'></i>Pinjaman Mikro</a></li>
            <li><a href='angsuran-mikro.html'><i class='fa fa-circle-o text-danger'></i><span>Angsuran Mikro</span></a></li>
            <li><a href='pelunasan-mikro.html'><i class='fa fa-circle-o text-danger'></i><span>Pelunasan Mikro</span></a></li>
      </ul>
    
        </li>";
}

       echo"  </ul>
    <ul class=treeview-menu>";
            $cek=umenu_akses("?module=general_jurnal",$_SESSION[sessid]);
      if($cek==1 OR $_SESSION[leveluser]=='1'   ){
      echo " <li class='";if ($_GET[module]=='general_jurnal'){
        echo"active ";
      }else{  echo""; }
        echo"treeview'>
          <a href='#'>
            <i class='fa fa-calendar-o'></i>
            <span>Akuntansi</span>
            <span class='pull-right-container'>
             <i class='fa fa-angle-left pull-right'></i>
            </span>
          </a>
          <ul class='treeview-menu'>
            <li><a href=general-jurnal.html><i class='fa fa-circle-o text-aqua'></i>a. General Jurnal</a></li>
            
      </ul>
    
        </li>";
}

        echo"  </ul>
        </li>"; 
}
// END Menu Transaksi

// Start Menu Laporan
$cek=umenu_akses("?module=teknik",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='1' ){
echo "<li class='";if ($_GET[module]=='laporan_penyaluran_kredit_pensiun' || $_GET[module]=='laporan_pelunasan_kredit_pensiun' || $_GET[module]=='laporan_setor_sendiri_kredit_pensiun' || $_GET[module]=='laporan_daftar_nominatif_pensiun' || $_GET[module]=='laporan_daftar_pelunasan_pensiun' || $_GET[module]=='laporan_daftar_tagihan_pensiun' || $_GET[module]=='laporan_penyaluran_kredit_umum' || $_GET[module]=='laporan_pelunasan_kredit_umum' || $_GET[module]=='laporan_setor_sendiri_kredit_umum' || $_GET[module]=='laporan_daftar_nominatif_umum' || $_GET[module]=='laporan_daftar_pelunasan_umum' || $_GET[module]=='laporan_daftar_tagihan_umum' || $_GET[module]=='laporan_penyaluran_kredit_mikro' || $_GET[module]=='laporan_pelunasan_kredit_mikro' || $_GET[module]=='laporan_setor_sendiri_kredit_mikro' || $_GET[module]=='laporan_daftar_nominatif_mikro' || $_GET[module]=='laporan_daftar_pelunasan_mikro' || $_GET[module]=='laporan_daftar_tagihan_mikro'){
  echo"active ";
}else{  echo""; }
  echo"treeview'>
          <a href='#'>
            <i class='fa fa-clipboard'></i> <span>Laporan</span>
            <span class='pull-right-container'>
              <i class='fa fa-angle-left pull-right'></i>
            </span>
          </a>
          <ul class=treeview-menu>";
            $cek=umenu_akses("?module=teknik",$_SESSION[sessid]);
      if($cek==1 OR $_SESSION[leveluser]=='1'   ){
      echo " <li class='";if ($_GET[module]=='laporan_penyaluran_kredit_pensiun' || $_GET[module]=='laporan_pelunasan_kredit_pensiun' || $_GET[module]=='laporan_setor_sendiri_kredit_pensiun' || $_GET[module]=='laporan_daftar_nominatif_pensiun' || $_GET[module]=='laporan_daftar_pelunasan_pensiun' || $_GET[module]=='laporan_daftar_tagihan_pensiun' ){
        echo"active ";
      }else{  echo""; }
        echo"treeview'>
          <a href='#'>
            <i class='fa fa-calendar-o'></i>
            <span>Pensiun</span>
            <span class='pull-right-container'>
             <i class='fa fa-angle-left pull-right'></i>
            </span>
          </a>
          <ul class='treeview-menu'>
            <li><a href=laporan-penyaluran-kredit-pensiun.html><i class='fa fa-circle-o text-aqua'></i>Penyaluran Kredit Pensiun</a></li>
            <li><a href='laporan-pelunasan-kredit-pensiun.html'><i class='fa fa-circle-o text-danger'></i><span>Pelunasan Kredit Pensiun</span></a></li>
      <li><a href=laporan-setor-sendiri-kredit-pensiun.html><i class='fa fa-circle-o text-aqua'></i>Setor Sendiri Kredit Pensiun</a></li>
            <li><a href='laporan-daftar-nominatif-pensiun.html'><i class='fa fa-circle-o text-danger'></i><span>Daftar Nominatif Pensiun</span></a></li>
      <li><a href=laporan-daftar-pelunasan-pensiun.html><i class='fa fa-circle-o text-aqua'></i>Daftar Pelunasan Pensiun</a></li>
            <li><a href='laporan-daftar-tagihan-pensiun.html'><i class='fa fa-circle-o text-danger'></i><span>Daftar Tagihan Pensiun</span></a></li>
      </ul>
    
        </li>";
}

        echo"  </ul>
    <ul class=treeview-menu>";
            $cek=umenu_akses("?module=teknik",$_SESSION[sessid]);
      if($cek==1 OR $_SESSION[leveluser]=='1'   ){
      echo " <li class='";if ($_GET[module]=='laporan_penyaluran_kredit_umum' || $_GET[module]=='laporan_pelunasan_kredit_umum' || $_GET[module]=='laporan_setor_sendiri_kredit_umum' || $_GET[module]=='laporan_daftar_nominatif_umum' || $_GET[module]=='laporan_daftar_pelunasan_umum' || $_GET[module]=='laporan_daftar_tagihan_umum' ){
        echo"active ";
      }else{  echo""; }
        echo"treeview'>
          <a href='#'>
            <i class='fa fa-calendar-o'></i>
            <span>Umum</span>
            <span class='pull-right-container'>
             <i class='fa fa-angle-left pull-right'></i>
            </span>
          </a>
          <ul class='treeview-menu'>
            <li><a href=laporan-penyaluran-kredit-umum.html><i class='fa fa-circle-o text-aqua'></i>Penyaluran Kredit Umum</a></li>
            <li><a href='laporan-pelunasan-kredit-umum.html'><i class='fa fa-circle-o text-danger'></i><span>Pelunasan Kredit Umum</span></a></li>
      <li><a href=laporan-setor-sendiri-kredit-umum.html><i class='fa fa-circle-o text-aqua'></i>Setor Sendiri Kredit Umum</a></li>
            <li><a href='laporan-daftar-nominatif-umum.html'><i class='fa fa-circle-o text-danger'></i><span>Daftar Nominatif Umum</span></a></li>
      <li><a href=laporan-daftar-pelunasan-umum.html><i class='fa fa-circle-o text-aqua'></i>Daftar Pelunasan Umum</a></li>
            <li><a href='laporan-daftar-tagihan-umum.html'><i class='fa fa-circle-o text-danger'></i><span>Daftar Tagihan Umum</span></a></li>
      </ul>
    
        </li>";
}

        echo"  </ul>
    
    <ul class=treeview-menu>";
            $cek=umenu_akses("?module=teknik",$_SESSION[sessid]);
      if($cek==1 OR $_SESSION[leveluser]=='1'   ){
      echo " <li class='";if ($_GET[module]=='laporan_penyaluran_kredit_mikro' || $_GET[module]=='laporan_pelunasan_kredit_mikro' || $_GET[module]=='laporan_setor_sendiri_kredit_mikro' || $_GET[module]=='laporan_daftar_nominatif_mikro' || $_GET[module]=='laporan_daftar_pelunasan_mikro' || $_GET[module]=='laporan_daftar_tagihan_mikro' ){
        echo"active ";
      }else{  echo""; }
        echo"treeview'>
          <a href='#'>
            <i class='fa fa-calendar-o'></i>
            <span>Mikro</span>
            <span class='pull-right-container'>
             <i class='fa fa-angle-left pull-right'></i>
            </span>
          </a>
          <ul class='treeview-menu'>
      <li><a href=laporan-penyaluran-kredit-mikro.html><i class='fa fa-circle-o text-aqua'></i>Penyaluran Kredit Mikro<span style='color:red;'> *</span></a></li>
      <li><a href='laporan-pelunasan-kredit-mikro.html'><i class='fa fa-circle-o text-danger'></i><span>Pelunasan Kredit Mikro</span></a></li>
      <li><a href=laporan-setor-sendiri-kredit-mikro.html><i class='fa fa-circle-o text-aqua'></i>Setor Sendiri Kredit Mikro<span style='color:red;'> *</span></a></li>
      <li><a href='laporan-daftar-nominatif-mikro.html'><i class='fa fa-circle-o text-danger'></i><span>Daftar Nominatif Mikro<span style='color:red;'> *</span></span></a></li>
      <li><a href=laporan-daftar-pelunasan-mikro.html><i class='fa fa-circle-o text-aqua'></i>Daftar Pelunasan Mikro</a></li>
      <li><a href='laporan-daftar-tagihan-mikro.html'><i class='fa fa-circle-o text-danger'></i><span>Daftar Tagihan Mikro</span></a></li>
      </ul>
    
        </li>";
}

        echo"  </ul>
        </li>"; 
}
// END Menu Laporan

// Start Menu Setting
$cek=umenu_akses("?module=setting",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='1' ){
echo "<li class='";if ($_GET[module]=='pinjaman_umum' OR $_GET[module]=='pinjaman_mikro' OR $_GET[module]=='pinjaman_pensiun' OR $_GET[module]=='company_info' OR $_GET[module]=='jabatan' OR $_GET[module]=='users' || $_GET[module]=='no_perkiraan' || $_GET[module]=='setting_coa' || $_GET[module]=='sub_group_perkiraan'){
  echo"active ";
}else{  echo""; }
  echo"treeview'>
          <a href='#'>
            <i class='fa fa-wrench'></i> <span>Setting</span>
            <span class='pull-right-container'>
              <i class='fa fa-angle-left pull-right'></i>
            </span>
          </a>
          <ul class=treeview-menu>";
            $cek=umenu_akses("?module=teknik",$_SESSION[sessid]);
      if($cek==1 OR $_SESSION[leveluser]=='1'   ){
      echo " <li class='";if ($_GET[module]=='pinjaman_umum' || $_GET[module]=='pinjaman_mikro' || $_GET[module]=='pinjaman_pensiun'  ){
        echo"active ";
      }else{  echo""; }
        echo"treeview'>
          <a href='#'>
            <i class='fa fa-calendar-o'></i>
            <span>Administrasi</span>
            <span class='pull-right-container'>
             <i class='fa fa-angle-left pull-right'></i>
            </span>
          </a>
          <ul class='treeview-menu'>
            <li><a href=pinjaman-pensiun.html><i class='fa fa-circle-o text-aqua'></i>Pinjaman Pensiun</a></li>
            <li><a href=pinjaman-umum.html><i class='fa fa-circle-o text-aqua'></i>Pinjaman Umum</a></li>
      <li><a href=pinjaman-mikro.html><i class='fa fa-circle-o text-aqua'></i>Pinjaman Mikro</a></li>
            
          </ul>
    <li><a href='company-info.html'><i class='fa fa-university'></i><span>Company Info</span></a></li>
    <li><a href='jabatan.html'><i class='fa fa-sitemap'></i><span>Jabatan</span></a></li>
    <li><a href='no-perkiraan.html'><i class='fa fa-calendar-o'></i><span>No Perkiraan Info</span></a></li>
    <li><a href='sub-group-perkiraan.html'><i class='fa fa-balance-scale'></i><span>Sub Group Perkiraan</span></a></li>
    <li><a href='setting-coa.html'><i class='fa fa-university'></i><span>Setting COA Info</span></a></li>
    <li><a href='users.html'><i class='fa fa-user-plus'></i><span>Users</span></a></li>
        </li>";
}

        echo"  </ul>
        </li>"; 
}
// End Menu Transaksi
?>