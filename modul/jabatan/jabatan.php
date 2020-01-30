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
        // if (form.ftNamaDirektur.value == ""){
        //  sweetAlert("Oops...", "Nama Direktur harus di isi!", "error");
        //  form.ftNamaDirektur.focus();
        //   return (false);
        // }     

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
        FORM JABATAN

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
    //   if ($_SESSION[leveluser]=='1'){
       ?>
                        <li>
                            <h3 class="box-title"><input type="button" onclick="location.href='<?php echo " tambah-jabatan.html ";?>';" value="Tambah" class="btn bg-purple btn-flat margin" /></h3>
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
                            <h3 class="box-title"><input type="button" onclick="location.href='<?php echo " excel/export_jabatan.php ";?>';" value="Export" class="btn bg-purple btn-flat margin" /></h3>
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
                                    <th style="color:#4375c6;">Nama Direktur</th>
                                    <th style="color:#4375c6;">NIK</th>
                                    <th style="color:#338452;">Nama Kabid Operasi</th>
                                    <th style="color:#338452;">NIK Kabid Operasi</th>
                                    <th style="color:#7e3384;">Nama Adm Kredit</th>
                                    <th style="color:#7e3384;">NIK Adm Kredit</th>
                                    <th style="color:#69b231;">Nama Simpanan</th>
                                    <th style="color:#69b231;">NIK Simpanan</th>
                                    <th style="color:#b23131;">Nama Kasir</th>
                                    <th style="color:#b23131;">NIK Kasir</th>
                                    <th style="color:#4375c6;">Nama Akuntansi</th>
                                    <th style="color:#4375c6;">NIK Akuntansi</th>

                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
        $p      = new Paging;
        $batas  = 40;
        $posisi = $p->cariPosisi($batas);
        if($_SESSION[leveluser]=='1'){
        $tampil=mysql_query("SELECT * FROM tljabatan  ORDER BY fnid ");
        }else{
        $tampil=mysql_query("SELECT * FROM tljabatan  ORDER BY fnid ");
        }
        $no = $posisi+1;
        $no1 = 0; 
        while($r=mysql_fetch_array($tampil)){
         $no1++;  
        
        echo"
                <tr>
          <td><span class='label bg-black disabled color-palette'>$no1</span></td>
                  <td style='color:#4375c6;'>$r[ftNamaDirektur]</td>
                  <td style='color:#4375c6;'>$r[ftNIKDirektur]</td> 
          <td style='color:#338452;'>$r[ftNamaKabidOps]</td> 
          <td style='color:#338452;'>$r[ftNIKKabidOps]</td>
                  <td style='color:#7e3384;'>$r[ftNamaAdmKredit]</td> 
          <td style='color:#7e3384;'>$r[ftNIKAdmKredit]</td> 
                  <td style='color:#69b231;'>$r[ftNamaSimpanan]</td>
                  <td style='color:#69b231;'>$r[ftNIKSimpanan]</td> 
          <td style='color:#b23131;'>$r[ftNamaKasir]</td> 
          <td style='color:#b23131;'>$r[ftNIKKasir]</td>
                  <td style='color:#4375c6;'>$r[ftNamaAkuntansi]</td> 
          <td style='color:#4375c6;'>$r[ftNIKAkuntansi]</td> 
          
                          
                  <td width='70px' onmouseover=\"this.style.cursor='pointer'\"><span class='label bg-gray disabled color-palette'><i class='fa fa-edit' title='edit $r[fnid]' onclick=\"location.href='edit-jabatan-$r[fnid].html';\"></i> &nbsp;&nbsp;&nbsp;  
          ";
        //  if($_SESSION[leveluser]=='1'){
          echo"<a class='fa fa-trash-o' title='delete $r[fnid]'  href=javascript:confirmdelete('aksi-delete-jabatan-$r[fnid].html') ></a>";
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
<form id="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambah-jabatan.html" onSubmit="return validasi(this)">


    <div class="box-body">

        <div class="col-md-6">
            <div class="box-header with-border">
                <h3 class="box-title">Input Direktur</h3>
            </div>
            <div class="box box-success">
                <div class="box-body ">
                    <div class="form-group has-success">
                        <label>Nama<span style="color:red;">*</span></label>
                        <input type="text" name="ftNamaDirektur" class="form-control" placeholder="Input ..." id="ftNamaDirektur" required>
                    </div>

                    <div class="form-group has-success">
                        <label>Nik<span style="color:red;">*</span></label>
                        <input type="text" name="ftNIKDirektur" id="ftNIKDirektur" class="form-control" placeholder="Input ..." required>
                    </div>

                    <div class="form-group has-success">
                        <label>Jabatan<span style="color:red;">*</span></label>
                        <input type="text" name="ftJabatanDIrektur" class="form-control" placeholder="Input ..." id="ftJabatanDIrektur" required>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>


            <div class="box-header with-border">
                <h3 class="box-title">Input Adm Kredit</h3>
            </div>
            <div class="box box-primary">
                <div class="box-body">

                    <div class="form-group has-success">
                        <label>Nama<span style="color:red;">*</span></label>
                        <input type="text" name="ftNamaAdmKredit" class="form-control" placeholder="Input ..." id="ftNamaAdmKredit" required>
                    </div>

                    <div class="form-group has-success">
                        <label>Nik<span style="color:red;">*</span></label>
                        <input type="text" name="ftNIKAdmKredit" id="ftNIKAdmKredit" class="form-control" placeholder="Input ..." required>
                    </div>

                    <div class="form-group has-success">
                        <label>Jabatan<span style="color:red;">*</span></label>
                        <input type="text" name="ftJabatanAdmKredit" class="form-control" placeholder="Input ..." id="ftJabatanAdmKredit" required>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>


            <div class="box-header with-border">
                <h3 class="box-title">Input Kasir</h3>
            </div>
            <div class="box box-warning">
                <div class="box-body">

                    <div class="form-group has-success">
                        <label>Nama<span style="color:red;">*</span></label>
                        <input type="text" name="ftNamaKasir" class="form-control" placeholder="Input ..." id="ftNamaKasir" required>
                    </div>

                    <div class="form-group has-success">
                        <label>Nik<span style="color:red;">*</span></label>
                        <input type="text" name="ftNIKKasir" id="ftNIKKasir" class="form-control" placeholder="Input ..." required>
                    </div>

                    <div class="form-group has-success">
                        <label>Jabatan<span style="color:red;">*</span></label>
                        <input type="text" name="ftJabatanKasir" class="form-control" placeholder="Input ..." id="ftJabatanKasir" required>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>

        </div>

        <div class="col-md-6">
            <div class="box-header with-border">
                <h3 class="box-title">Input Kabid Operasi</h3>
            </div>
            <div class="box box-danger">
                <div class="box-body">

                    <div class="form-group has-success">
                        <label>Nama<span style="color:red;">*</span></label>
                        <input type="text" name="ftNamaKabidOps" class="form-control" placeholder="Input ..." id="ftNamaKabidOps" required>
                    </div>

                    <div class="form-group has-success">
                        <label>Nik<span style="color:red;">*</span></label>
                        <input type="text" name="ftNIKKabidOps" id="ftNIKKabidOps" class="form-control" placeholder="Input ..." required>
                    </div>

                    <div class="form-group has-success">
                        <label>Jabatan<span style="color:red;">*</span></label>
                        <input type="text" name="ftJabatanKabidOps" class="form-control" placeholder="Input ..." id="ftJabatanKabidOps" required>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>

            <div class="box-header with-border">
                <h3 class="box-title">Input Simpanan</h3>
            </div>
            <div class="box box-info">
                <div class="box-body">

                    <div class="form-group has-success">
                        <label>Nama<span style="color:red;">*</span></label>
                        <input type="text" name="ftNamaSimpanan" class="form-control" placeholder="Input ..." id="ftNamaSimpanan" required>
                    </div>

                    <div class="form-group has-success">
                        <label>Nik<span style="color:red;">*</span></label>
                        <input type="text" name="ftNIKSimpanan" id="ftNIKSimpanan" class="form-control" placeholder="Input ..." required>
                    </div>

                    <div class="form-group has-success">
                        <label>Jabatan<span style="color:red;">*</span></label>
                        <input type="text" name="ftJabatanSimpanan" class="form-control" placeholder="Input ..." id="ftJabatanSimpanan" required>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>

            <div class="box-header with-border">
                <h3 class="box-title">Input Akutansi</h3>
            </div>
            <div class="box box-success">
                <div class="box-body">

                    <div class="form-group has-success">
                        <label>Nama<span style="color:red;">*</span></label>
                        <input type="text" name="ftNamaAkuntansi" class="form-control" placeholder="Input ..." id="ftNamaAkuntansi" required>
                    </div>

                    <div class="form-group has-success">
                        <label>Nik<span style="color:red;">*</span></label>
                        <input type="text" name="ftNIKAkuntansi" id="ftNIKAkuntansi" class="form-control" placeholder="Input ..." required>
                    </div>

                    <div class="form-group has-success">
                        <label>Jabatan<span style="color:red;">*</span></label>
                        <input type="text" name="ftJabatanAkuntansi" class="form-control" placeholder="Input ..." id="ftJabatanAkuntansi" required>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>


        </div>

    </div>



    <!-- /.box-header -->
    <div class="box-body">

        <div class="col-md-6">
            <div class="box-footer">
                <a class="btn btn-default" href="jabatan.html">Cancel</a>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.RIGHT SIDE -->
        <div class="col-md-6">
            <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-info pull-right">Save</button>
            </div>
            <!-- /.END RIGHT SIDE -->
        </div>
        <!-- /.col -->

        <!-- /.row -->
    </div>


</form>
<?php       
     break;
 
 //HARUS DIRUBAH (setting email)
  case "edit":


   $edit = mysql_query("SELECT * FROM tljabatan WHERE fnid='$_GET[fnid]'");
    $r    = mysql_fetch_array($edit);
  echo"
  <form id='myForm' method='POST' enctype='multipart/form-data' action='aksi-edit-jabatan.html' onSubmit='return validasi(this)'>
  
   
      <div class='box-body' >
    <input type=hidden name=id value='$r[fnid]'>  
    <div class='col-md-6'>
     <div class='box-header with-border'>
          <h3 class='box-title'>Input Direktur</h3>
        </div>
     <div class='box box-success'>
           <div class='box-body '>
      <div class='form-group has-success' >
                  <label>Nama<span style='color:red;''>*</span></label>
                  <input type='text' name='ftNamaDirektur' class='form-control' value='$r[ftNamaDirektur]' placeholder='Input ...' id='ftNamaDirektur' required>
       </div>
      
       <div class='form-group has-success'>
                  <label>Nik<span style='color:red;''>*</span></label>
                  <input type='text' name='ftNIKDirektur' id='ftNIKDirektur' class='form-control' value='$r[ftNIKDirektur]' placeholder='Input ...' required>
                </div>
      
      <div class='form-group has-success' >
                  <label>Jabatan<span style='color:red;''>*</span></label>
                  <input type='text' name='ftJabatanDIrektur' class='form-control' value='$r[ftJabatanDIrektur]' placeholder='Input ...' id='ftJabatanDIrektur' required>
        </div> 
      </div>
       <!-- /.box-body -->
       </div>
       
        
       <div class='box-header with-border'>
          <h3 class='box-title'>Input Adm Kredit</h3>
        </div>
       <div class='box box-primary'>
       <div class='box-body'>
              
              <div class='form-group has-success' >
                  <label>Nama<span style='color:red;''>*</span></label>
                  <input type='text' name='ftNamaAdmKredit' class='form-control' value='$r[ftNamaAdmKredit]' placeholder='Input ...' id='ftNamaAdmKredit' required>
       </div>
      
       <div class='form-group has-success'>
                  <label>Nik<span style='color:red;''>*</span></label>
                  <input type='text' name='ftNIKAdmKredit' id='ftNIKAdmKredit' class='form-control' value='$r[ftNIKAdmKredit]' placeholder='Input ...' required>
                </div>
      
      <div class='form-group has-success' >
                  <label>Jabatan<span style='color:red;''>*</span></label>
                  <input type='text' name='ftJabatanAdmKredit' class='form-control' value='$r[ftJabatanAdmKredit]' placeholder='Input ...' id='ftJabatanAdmKredit' required>
        </div>
              
            </div>
            <!-- /.box-body -->
          </div>
       
       
       <div class='box-header with-border'>
          <h3 class='box-title'>Input Kasir</h3>
        </div>
       <div class='box box-warning'>
       <div class='box-body'>
              
              <div class='form-group has-success' >
                  <label>Nama<span style='color:red;''>*</span></label>
                  <input type='text' name='ftNamaKasir' class='form-control' value='$r[ftNamaKasir]' placeholder='Input ...' id='ftNamaKasir' required>
       </div>
      
       <div class='form-group has-success'>
                  <label>Nik<span style='color:red;''>*</span></label>
                  <input type='text' name='ftNIKKasir' id='ftNIKKasir' class='form-control' value='$r[ftNIKKasir]' placeholder='Input ...' required>
                </div>
      
      <div class='form-group has-success' >
                  <label>Jabatan<span style='color:red;''>*</span></label>
                  <input type='text' name='ftJabatanKasir' class='form-control' value='$r[ftJabatanKasir]' placeholder='Input ...' id='ftJabatanKasir' required>
        </div>
              
            </div>
            <!-- /.box-body -->
          </div>
       
      </div>
      
      <div class='col-md-6'>
       <div class='box-header with-border'>
          <h3 class='box-title'>Input Kabid Operasi</h3>
        </div>
     <div class='box box-danger'>
            <div class='box-body'>
              
                <div class='form-group has-success' >
                  <label>Nama<span style='color:red;''>*</span></label>
                  <input type='text' name='ftNamaKabidOps' class='form-control' value='$r[ftNamaKabidOps]' placeholder='Input ...' id='ftNamaKabidOps' required>
       </div>
      
       <div class='form-group has-success'>
                  <label>Nik<span style='color:red;''>*</span></label>
                  <input type='text' name='ftNIKKabidOps' id='ftNIKKabidOps' class='form-control' value='$r[ftNIKKabidOps]' placeholder='Input ...' required>
                </div>
      
      <div class='form-group has-success' >
                  <label>Jabatan<span style='color:red;''>*</span></label>
                  <input type='text' name='ftJabatanKabidOps' class='form-control' value='$r[ftJabatanKabidOps]' placeholder='Input ...' id='ftJabatanKabidOps' required>
        </div>
              
            </div>
            <!-- /.box-body -->
          </div>
      
      <div class='box-header with-border'>
          <h3 class='box-title'>Input Simpanan</h3>
        </div>
      <div class='box box-info'>
            <div class='box-body'>
              
                <div class='form-group has-success' >
                  <label>Nama<span style='color:red;''>*</span></label>
                  <input type='text' name='ftNamaSimpanan' class='form-control' value='$r[ftNamaSimpanan]' placeholder='Input ...' id='ftNamaSimpanan' required>
       </div>
      
       <div class='form-group has-success'>
                  <label>Nik<span style='color:red;''>*</span></label>
                  <input type='text' name='ftNIKSimpanan' id='ftNIKSimpanan' class='form-control' value='$r[ftNIKSimpanan]' placeholder='Input ...' required>
                </div>
      
      <div class='form-group has-success' >
                  <label>Jabatan<span style='color:red;''>*</span></label>
                  <input type='text' name='ftJabatanSimpanan' class='form-control' value='$r[ftJabatanSimpanan]' placeholder='Input ...' id='ftJabatanSimpanan' required>
        </div>
              
            </div>
            <!-- /.box-body -->
          </div>
      
       <div class='box-header with-border'>
          <h3 class='box-title'>Input Akutansi</h3>
        </div>
      <div class='box box-success'>
            <div class='box-body'>
              
                <div class='form-group has-success' >
                  <label>Nama<span style='color:red;''>*</span></label>
                  <input type='text' name='ftNamaAkuntansi' class='form-control' value='$r[ftNamaAkuntansi]' placeholder='Input ...' id='ftNamaAkuntansi' required>
       </div>
      
       <div class='form-group has-success'>
                  <label>Nik<span style='color:red;''>*</span></label>
                  <input type='text' name='ftNIKAkuntansi' id='ftNIKAkuntansi' class='form-control' value='$r[ftNIKAkuntansi]' placeholder='Input ...' required>
                </div>
      
      <div class='form-group has-success' >
                  <label>Jabatan<span style='color:red;''>*</span></label>
                  <input type='text' name='ftJabatanAkuntansi' class='form-control' value='$r[ftJabatanAkuntansi]' placeholder='Input ...' id='ftJabatanAkuntansi' required>
        </div>
              
            </div>
            <!-- /.box-body -->
          </div>
     

      </div>
      
      </div>
      
      
  
     <!-- /.box-header -->
        <div class='box-body' >
      
         <div class='col-md-6'>
           <div class='box-footer'>
                <a  class='btn btn-default' href='jabatan.html'>Cancel</a>
             </div> 
        <!-- /.form-group -->
            </div>
       <!-- /.RIGHT SIDE -->
            <div class='col-md-6'>
       <div class='box-footer'>
               <button type='submit' class='btn btn-info pull-right'>Save</button>
              </div>  
       <!-- /.END RIGHT SIDE -->
            </div>
            <!-- /.col -->
         
      <!-- /.row -->
        </div>
        
      
    </form>";
   
    break;  
  //edit password
  
   }
   }
  ?>
  <script>
$('.btnprint').click(function() {
     window.open ('print-jabatan.html','_blank');
   });
</script>