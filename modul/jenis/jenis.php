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
         if (form.ftKodeJenis.value == "") {
             sweetAlert("Oops...", "Kode Jenis harus di isi!", "error");
             form.ftKodeJenis.focus();
             return (false);
         } else if (form.ftNamaJenis.value == "") {
             sweetAlert("Oops...", "Nama Jenis harus di isi!", "error");
             form.ftNamaJenis.focus();
             return (false);
         } else if (form.fnStatus.value == "") {
             sweetAlert("Oops...", "Status harus di isi!", "error");
             form.fnStatus.focus();
             return (false);
         } else if (form.ftCabang.value == "") {
             sweetAlert("Oops...", "Cabang harus di isi!", "error");
             form.ftCabang.focus();
             return (false);
         }

     }
 </script>





 <?php

//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
//if($cek==1 OR $_SESSION[leveluser]=='1' || $_SESSION[leveluser]=='3' ){
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
         FORM JENIS PENSIUN

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
      // if ($_SESSION[leveluser]=='1' || $_SESSION['leveluser']=='3'){
       ?>
                         <li>
                             <h3 class="box-title"><input type="button" onclick="location.href='<?php echo " tambah-jenis.html ";?>';" value="Tambah" class="btn bg-purple btn-flat margin" /></h3>
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
                             <h3 class="box-title"><input type="button" onclick="location.href='<?php echo " excel/export_jenis.php ";?>';" value="Export" class="btn bg-purple btn-flat margin" /></h3>
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
                                     <th>Kode Jenis</th>
                                     <th>Nama Jenis</th>
                                     <th>Status</th>
                                     <th>Cabang</th>

                                     <th></th>

                                 </tr>
                             </thead>
                             <tbody>
                                 <?php 
        $p      = new Paging;
        $batas  = 40;
        $posisi = $p->cariPosisi($batas);
        if($_SESSION[leveluser]=='1'){
        $tampil=mysql_query("SELECT * FROM tljenispensiun  ORDER BY ftKodeJenis ");
        }else{
        $tampil=mysql_query("SELECT * FROM tljenispensiun  ORDER BY ftKodeJenis ");
        }
        $no = $posisi+1;
        $no1 = 0; 
        while($r=mysql_fetch_array($tampil)){
         $no1++;  
        
        echo"
                <tr>
          <td><span class='label bg-black disabled color-palette'>$no1</span></td>
                  <td>$r[ftKodeJenis]</td>
                  <td>$r[ftNamaJenis]</td> 
          ";
        if($r[fnStatus]==0){
          echo"<td>Tidak Aktif</td>";
        }else if($r[fnStatus]==1){
          echo"<td>Aktif</td>";
        }   
        echo"
                  <td>$r[ftCabang]</td> 
          
                          
                  <td width='70px' onmouseover=\"this.style.cursor='pointer'\"><span class='label bg-gray disabled color-palette'><i class='fa fa-edit' title='edit $r[ftKodeJenis]' onclick=\"location.href='edit-jenis-$r[fnId].html';\"></i> &nbsp;&nbsp;&nbsp;  
          ";
        //  if($_SESSION[leveluser]=='1'){
          echo"<a class='fa fa-trash-o' title='delete $r[ftKodeJenis]'  href=javascript:confirmdelete('aksi-delete-jenis-$r[fnId].html') ></a>";
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
         <h3 class="box-title">Input Jenis</h3>

         <div class="box-tools pull-right">
             <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

         </div>
     </div>
     <form id="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambah-jenis.html" onSubmit="return validasi(this)">
         <!-- /.box-header -->
         <div class="box-body" id="myForm">

             <div class="row">
                 <div class="col-md-6">

                     <div class="form-group">
                         <label>Kode Jenis<span style='color:red;'>*</span></label>
                         <input type="text" name="ftKodeJenis" class="form-control" placeholder="Input ..." id="ftKodeJenis">

                     </div>

                     <div class="form-group">
                         <label>Nama Jenis<span style='color:red;'>*</span></label>
                         <input type="text" name="ftNamaJenis" id="ftNamaJenis" class="form-control" placeholder="Input ...">
                     </div>

                     <div class="form-group">
                  <label>Status<span style="color:red;">*</span></label>
                    <select class="form-control select2" style="width: 100%;" name="fnStatus" id="fnStatus">
                    <option value="1" selected>Aktif</option>
                    <option value="0">Tidak Aktif</option>
                    </select>
                            
                          </div> 
                <div class="form-group">
                            <label>Cabang<span style="color:red;">*</span></label>
                            
                            
                    <?php   
                    $tampil=mysql_query("SELECT ftBranch_Code FROM tscompany_info WHERE aktif ='Y'");
                    $r=mysql_fetch_array($tampil);
                     echo "<input type='text' name='ftCabang' id='ftCabang' value='$r[ftBranch_Code]' class='form-control' placeholder='Input ...'' readonly>"; 
                     ?>
         
                </div>  </br>
                     <div class="form-group ">

                     </div>

                     <!-- /.form-group -->
                 </div>



                 <!-- /.col -->
             </div>

             <!-- /.row -->
         </div>
         <!-- /.box-body -->
         <!-- /.box-body -->
         <div class="box-footer">
             <a class="btn btn-default" href="jenis.html">Cancel</a>
             <button type="submit" class="btn btn-info pull-right">Save</button>
         </div>
     </form>
 </div>
 <?php        
     break;
 
 //HARUS DIRUBAH (setting email)
  case "edit":


   $edit = mysql_query("SELECT * FROM tljenispensiun WHERE fnId='$_GET[fnId]'");
    $r    = mysql_fetch_array($edit);
  echo"
  <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit Jenis</h3>

          <div class='box-tools pull-right'>
            <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
           
          </div>
        </div>";
      
      
    echo"<form id='myForm_edit' method='POST'  enctype='multipart/form-data' action='aksi-edit-jenis.html' onSubmit='return validasi(this)'>
        <!-- /.box-header -->
    
        <div class='box-body'>
     <input type=hidden name=id value=$r[fnId]>
          <div class='row'>
            <div class='col-md-6'>
      
      
      <div class='form-group' >
                  <label>Kode Jenis<span style='color:red;'>*</span></label>
                  <input type='text' name='ftKodeJenis' id='ftKodeJenis' value='$r[ftKodeJenis]' class='form-control' placeholder='Input ...' >
                </div>
        
      
       <div class='form-group'>
                  <label>Nama Jenis<span style='color:red;'>*</span></label>
                  <input type='text' name='ftNamaJenis' id='ftNamaJenis' value='$r[ftNamaJenis]' class='form-control' placeholder='Enter ...'>
                </div>
      
      <div class='form-group'>
                  <label>Status<span style='color:red;'>*</span></label>
                  <select class='form-control select2'  style='width: 100%;' name='fnStatus_edit' id='fnStatus_edit'>";
         
         if ($r[fnStatus]==''){
         echo"<option selected='selected' value=''>-- Pilih --</option>
            <option  value='1'>Aktif</option>
            <option  value='0'>Tidak Aktif</option>";}
         
         else if ($r[fnStatus]=='1'){
          echo"<option value='1' selected>Aktif</option>
             <option value='0' >Tidak Aktif</option>";}
         else if ($r[fnStatus]=='0'){
          echo"<option value='0' selected>Tidak Aktif</option>
             <option value='1' >Aktif</option>";}  
          
          echo"</select>
                </div>
      
      <div class='form-group'>
                  <label>Cabang<span style='color:red;'>*</span></label>";
                 $tampil=mysql_query("SELECT ftBranch_Code FROM tscompany_info WHERE aktif ='Y'");
          $r=mysql_fetch_array($tampil);
           echo "<input type='text' name='ftCabang' id='ftCabang' value='$r[ftBranch_Code]' class='form-control' placeholder='Input ...'' readonly> 
                </div>    
      
      
           
             
              <!-- /.form-group -->
            </div>
      
      
            <!-- /.col -->
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
                <a  class='btn btn-default' href='jenis.html'>Cancel</a>
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
     window.open ('print-jenis.html','_blank');
   });
</script>