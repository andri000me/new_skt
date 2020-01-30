 <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
 <script src="dist/sweetalert.min.js"></script>
 <script type="text/javascript" src="js/pemisah_angka.js"></script>
 <script src="js/jquery-1.8.3.min.js"></script>
 <script>
     function confirmdelete(delUrl) {
         if (confirm("Anda yakin ingin menghapus?")) {
             document.location = delUrl;
         }
     }
 </script>
 <script type="text/javascript">
     function validasi(form) {
         if (form.ftKodePerkiraan.value == "") {
             sweetAlert("Oops...", "Kode Perkiraan harus di isi!", "error");
             form.ftKodePerkiraan.focus();
             return (false);
         } else if (form.ftNamaPerkiraan.value == "") {
             sweetAlert("Oops...", "Nama Perkiraan harus di isi!", "error");
             form.ftNamaPerkiraan.focus();
             return (false);
         } else if (form.ftKodeKategori.value == "") {
             sweetAlert("Oops...", "Sub Group Perkiraan harus di isi!", "error");
             form.ftKodeKategori.focus();
             return (false);
         } else if (form.fnStatus.value == "") {
             sweetAlert("Oops...", "Status harus di isi!", "error");
             form.fnStatus.focus();
             return (false);
         }

     }
 </script>





 <?php

//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
//if($cek==1 OR $_SESSION[leveluser]=='1' || $_SESSION[leveluser]=='2'  || $_SESSION[leveluser]=='3' || $_SESSION[leveluser]=='4' || $_SESSION[leveluser]=='5'  || $_SESSION[leveluser]=='6' || $_SESSION[leveluser]=='7'){
if(!empty($_SESSION['leveluser'])){  
/*
$base_url = $_SERVER['HTTP_HOST'];
  $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));

$aksi="modul/users/aksi_users.php";*/
switch($_GET[act]){
  // Tampil Hubungi Kami
  default:
   ?>


 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         FORM DAFTAR NO PERKIRAAN

     </h1>
     <ol class="breadcrumb">
         <li><a href="home.html"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">
             <?php echo"$hari_ini,"; ?>
             <?php echo tgl_indo(date('Y m d'));  ?>
             <?php echo "|";  ?>
             <span id="clock">
                 <?php print date('H:i:s'); ?></span></li>
     </ol>
 </section>

 <!-- Main content -->
 <section class="content">
     <div class="row">
         <div class="col-xs-12">

             <!-- /.box -->

             <div class="box box-primary">
                 <div class="box-header">
                     <ul class="nav navbar-nav">
                         <?php
     //  if ($_SESSION[leveluser]=='1'){
       ?>
                         <li>
                             <h3 class="box-title"><input type="button" onclick="location.href='<?php echo " tambah-no-perkiraan.html ";?>';" value="Tambah" class="btn bg-purple btn-flat margin" /></h3>
                         </li>
                         <?php
       // }else{
       //  echo""; 
       // }
      ?>
                         <li>
                             <h3 class="box-title"><input type="button" id="printable" value="Print" class="btn btnprint bg-purple btn-flat margin" /></h3>
                         </li>
                         <li>
                             <h3 class="box-title"><input type="button" onclick="location.href='<?php echo " excel/export_noperkiraan.php ";?>';" value="Export" class="btn bg-purple btn-flat margin" /></h3>
                         </li>
                     </ul>
                 </div>
                 <!-- /.box-header -->
                 <div class="box-body">
                     <div class="table-responsive">
                         <table id="example1" class="table table-bordered table-striped">
                             <thead>
                                 <tr>
                                     <th>No</th>
                                     <th>Kode Perkiraan</th>
                                     <th>Nama Perkiraan</th>
                                     <th>Sub Group Perkiraan</th>
                                     <th>Status</th>
                                     <th></th>

                                 </tr>
                             </thead>
                             <tbody>
                                 <?php 
        $p      = new Paging;
        $batas  = 40;
        $posisi = $p->cariPosisi($batas);
        if($_SESSION[leveluser]=='1'){
        $tampil=mysql_query("SELECT * FROM tlnoperkiraan  ORDER BY ftKodePerkiraan ");
        }else{
        $tampil=mysql_query("SELECT * FROM tlnoperkiraan  ORDER BY ftKodePerkiraan ");
        }
        $no = $posisi+1;
        $no1 = 0; 
        while($r=mysql_fetch_array($tampil)){
         $no1++;  
        if( $r['fnStatus']==1){
            $aktif='Aktif';
          }else{
            $aktif='Tidak Aktif';
          }
        echo"
                <tr>
          <td><span class='label bg-black disabled color-palette'>$no1</span></td>
                  <td>$r[ftKodePerkiraan]</td>
                  <td>$r[ftNamaPerkiraan]</td> 
          <td>$r[ftKodeKategori]</td>
                  <td>$aktif</td> 
           
                  <td width='70px' onmouseover=\"this.style.cursor='pointer'\"><span class='label bg-gray disabled color-palette'><i class='fa fa-edit' title='edit $r[ftKodePerkiraan]' onclick=\"location.href='edit-no-perkiraan-$r[ftKodePerkiraan].html';\"></i> &nbsp;&nbsp;&nbsp;  
          ";
        //  if($_SESSION[leveluser]=='1'){
          echo"<a class='fa fa-trash-o' title='delete $r[ftKodePerkiraan]'  href=javascript:confirmdelete('aksi-delete-no-perkiraan-$r[ftKodePerkiraan].html') ></a>";
          // }else{
          //   echo"";
          // }
          echo"</span></td>
          
                </tr>";
              
        }
         ?>


                             </tbody>

                         </table>
                     </div>
                 </div>
                 <!-- /.box-body -->
             </div>
             <!-- /.box -->
         </div>
         <!-- /.col -->
     </div>
     <!-- /.row -->
 </section>
 <!-- /.content -->



 <?php
    break;
 case "tambah":
  ?>
 <div class="box box-default">
     <div class="box-header with-border">
         <h3 class="box-title">Input No Perkiraan</h3>

         <div class="box-tools pull-right">
             <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

         </div>
     </div>
     <form id="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambah-no-perkiraan.html" onSubmit="return validasi(this)">
         <!-- /.box-header -->
         <div class="box-body" id="myForm">

             <div class="row">
                 <div class="col-md-6">

                     <div class="form-group">
                         <label>Kode Perkiraan<span style='color:red;'>*</span></label>
                         <input type="text" name="ftKodePerkiraan" class="form-control" placeholder="Input ..." id="ftKodePerkiraan">

                     </div>

                     <div class="form-group">
                         <label>Nama Perkiraan<span style='color:red;'>*</span></label>
                         <input type="text" name="ftNamaPerkiraan" id="ftNamaPerkiraan" class="form-control" placeholder="Input ...">
                     </div>



                     <div class="form-group">
                         <label>Sub Group Perkiraan<span style='color:red;'>*</span></label>

                         <select class="form-control select2" style="width: 100%;" name="ftKodeKategori" id="ftKodeKategori">
                             <?php    
         $tampil=mysql_query("SELECT * FROM tlkategoriperkiraan WHERE fnStatus=1 ORDER BY ftCategoryName");
         echo "<option value='' selected>-- Pilih --</option>";
           while($r=mysql_fetch_array($tampil)){
           echo "<option value='$r[ftCategoryName]'>$r[ftCategoryName]</option>"; }
           ?>
                         </select>
                     </div>

                     <div class="form-group">
                         <label>Status<span style='color:red;'>*</span></label>
                         <select class="form-control select2" style="width: 100%;" name="fnStatus" id="fnStatus">
                             <option value="" selected>-- Pilih --</option>
                             <option value="1">Aktif</option>
                             <option value="0">Tidak Aktif</option>

                         </select>
                     </div>


                     <!-- /.form-group -->
                 </div>
                 <!-- /.RIGHT SIDE -->

                 <!-- /.col -->
             </div>

             <!-- /.row -->
         </div>
         <!-- /.box-body -->
         <!-- /.box-body -->
         <div class="box-footer">
             <a class="btn btn-default" href="no-perkiraan.html">Cancel</a>
             <button type="submit" class="btn btn-info pull-right">Save</button>
         </div>
     </form>
 </div>
 <?php        
     break;
 
 //HARUS DIRUBAH (setting email)
  case "edit":


   $edit = mysql_query("SELECT * FROM tlnoperkiraan WHERE ftKodePerkiraan='$_GET[ftKodePerkiraan]'");
    $r    = mysql_fetch_array($edit);
  echo"
  <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit No Perkiraan</h3>

          <div class='box-tools pull-right'>
            <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
           
          </div>
        </div>";
      
      
    echo"<form id='form' method='POST'  enctype='multipart/form-data' action='aksi-edit-no-perkiraan.html' onSubmit='return validasi(this)'>
        <!-- /.box-header -->
    
        <div class='box-body'>
     
          <div class='row'>
            <div class='col-md-6'>
      
      
      <div class='form-group' >
                  <label>Kode Perkiraan<span style='color:red;'>*</span></label>
                  <input type='text' name='ftKodePerkiraan' id='ftKodePerkiraan' value='$r[ftKodePerkiraan]' class='form-control' placeholder='Input ...' readonly=yes>
                </div>
        
      
       <div class='form-group'>
                  <label>Nama Perkiraan<span style='color:red;'>*</span></label>
                  <input type='text' name='ftNamaPerkiraan' id='ftNamaPerkiraan' value='$r[ftNamaPerkiraan]' class='form-control' placeholder='Enter ...'>
                </div>
        
      
       <div class='form-group'>
                  <label>Sub Group Perkiraan<span style='color:red;'>*</span></label>
                  
           
          
          <select class='form-control select2'  style='width: 100%;' name='ftKodeKategori' id='ftKodeKategori'>";
         $tampil=mysql_query("SELECT * FROM tlkategoriperkiraan WHERE fnStatus=1 ORDER BY ftCategoryName");
         if ($r[ftKodeKategori]==''){
         echo"<option selected='selected' value=''>-- Pilih --</option>";}
          while($w=mysql_fetch_array($tampil)){
          if ($r[ftKodeKategori]==$w[ftCategoryName]){
          echo"<option value='$w[ftCategoryName]' selected>$w[ftCategoryName]</option>";}
           else{
          echo"<option value='$w[ftCategoryName]'>$w[ftCategoryName]</option>";}}
          echo"</select>
                </div>
      
       <div class='form-group'>
                  <label>Status<span style='color:red;'>*</span></label>
                  
           <select class='form-control select2'  style='width: 100%;' name='fnStatus' id='fnStatus'>";
         
         if ($r[fnStatus]==''){
          
         echo"<option selected='selected' value=''>-- Pilih --</option>";}
          else{
            if( $r['fnStatus']==1){
            $aktif='Aktif';
          }else{
            $aktif='Tidak Aktif';
          }
          echo" <option value='$r[fnStatus]' selected>$aktif</option>
            <option value='1'>Aktif</option>
            <option value='0'>Tidak Aktif</option>
            ";}
          echo"</select>
                </div>
      
      
           
             
              <!-- /.form-group -->
            </div>
      
      
            <!-- /.col -->
       <!-- /.RIGHT SIDE -->
            <div class='col-md-6'>
    
            
      
      
        
      "; 
        
                echo"</div>
        
        <!-- /.form-group -->
            </div>
      
            <!-- /.col -->
          </div>
      
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
              <div class='box-footer'>
                <a  class='btn btn-default' href='no-perkiraan.html'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>Update</button>
              </div>
    </form>";
    
    echo"  </div>";
   
    break;  
  //edit password
  
   }
   }
  ?>
  <script>
$('.btnprint').click(function() {
     window.open ('print-no-perkiraan.html','_blank');
   });
</script>