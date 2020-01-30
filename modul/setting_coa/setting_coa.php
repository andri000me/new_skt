
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
function validasi(form){
  if (form.ftCOA_No.value == ""){
   sweetAlert("Oops...", "Kode harus di isi!", "error");
   form.ftCOA_No.focus();
    return (false);
  }else if (form.ftCOA_LinkGL.value == ""){
   sweetAlert("Oops...", "Keterangan harus di isi!", "error");
   form.ftCOA_LinkGL.focus();
    return (false);
  }else if (form.ftKodePerkiraan.value == ""){
   sweetAlert("Oops...", "No Perkiraan harus di isi!", "error");
   form.ftKodePerkiraan.focus();
    return (false);
  }else if (form.ftModul.value == ""){
   sweetAlert("Oops...", "Modul harus di isi!", "error");
   form.ftModul.focus();
    return (false);
  }     
   
 }
</script>





<?php

//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
//if($cek==1 OR $_SESSION[leveluser]=='1' || $_SESSION[leveluser]=='2'  || $_SESSION[leveluser]=='3' || $_SESSION[leveluser]=='4' || $_SESSION[leveluser]=='5'  || $_SESSION[leveluser]=='6' || $_SESSION[leveluser]=='7'){
if(!empty($_SESSION['leveluser'])){  
$base_url = $_SERVER['HTTP_HOST'];
  $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));

$aksi="modul/users/aksi_users.php";
switch($_GET[act]){
  // Tampil Hubungi Kami
  default:
   ?>
   
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       FORM DAFTAR COA SETTING
        
      </h1>
      <ol class="breadcrumb">
         <li><a href="home.html"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> <?php echo"$hari_ini,"; ?>
							<?php echo tgl_indo(date('Y m d'));  ?>
							<?php echo "|";  ?>
							<span id="clock"><?php print date('H:i:s'); ?></span></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box box-primary">
             <div class="box-header">
			 <?php
			// if ($_SESSION[leveluser]=='1'){
			 ?>
              <h3 class="box-title"><input type="button" onclick="location.href='<?php echo "tambah-setting-coa.html ";?>';" value="Tambah" class="btn bg-purple btn-flat margin"/></h3>
			 <?php
			 // }else{
				// echo""; 
			 // }
			?>	
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>No</th>
                  <th>Kode</th>
                  <th>Modul</th>
				  <th>Keterangan</th>
				  <th>No Perkiraan</th>
				  <th>Nama Perkiraan</th>
				  <th></th>
				 
                </tr>
                </thead>
                <tbody>
				<?php 
				$p      = new Paging;
				$batas  = 40;
				$posisi = $p->cariPosisi($batas);
				if($_SESSION[leveluser]=='1'){
				$tampil=mysql_query("SELECT * FROM tlcoa_seting a LEFT JOIN tlnoperkiraan b ON b.ftKodePerkiraan=a.ftKodePerkiraan ORDER BY a.ftKodePerkiraan ");
				}else{
				$tampil=mysql_query("SELECT * FROM tlcoa_seting a LEFT JOIN tlnoperkiraan b ON b.ftKodePerkiraan=a.ftKodePerkiraan ORDER BY a.ftKodePerkiraan ");
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
                  <td>$r[ftCOA_No]</td>
                  <td>$r[ftModul]</td> 
				  <td>$r[ftCOA_LinkGL]</td>
                  <td>$r[ftKodePerkiraan]</td> 
				  <td>$r[ftNamaPerkiraan]</td>  
                  <td width='70px' onmouseover=\"this.style.cursor='pointer'\"><span class='label bg-gray disabled color-palette'><i class='fa fa-edit' title='edit $r[ftCOA_No]' onclick=\"location.href='edit-setting-coa-$r[ftCOA_No].html';\"></i> &nbsp;&nbsp;&nbsp;  
				  ";
				 // if($_SESSION[leveluser]=='1'){
				  echo"<a class='fa fa-trash-o' title='delete $r[ftCOA_No]'  href=javascript:confirmdelete('aksi-delete-setting-coa-$r[ftCOA_No].html') ></a>";
				  // }else{
					 //  echo"";
				  // }
				  echo"</span></td>
				  
                </tr>";
              
				}
			   ?>
               
               
                </tbody>
           
              </table>
            </div> </div>
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
          <h3 class="box-title">Input COA Setting</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
		<form id="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambah-setting-coa.html" onSubmit="return validasi(this)">
        <!-- /.box-header -->
        <div class="box-body" id="myForm">
		
          <div class="row">
            <div class="col-md-6">
			
			<div class="form-group" >
                  <label>Kode<span style='color:red;'>*</span></label>
                  <input type="text" name="ftCOA_No" class="form-control" placeholder="Input ..." id="ftCOA_No">
				  
                </div>
				
			<div class="form-group" >
                  <label>Keterangan<span style='color:red;'>*</span></label>
                  <input type="text" name="ftCOA_LinkGL" class="form-control" placeholder="Input ..." id="ftCOA_LinkGL">
				  
                </div>

			<div class="form-group">
                  <label>No Perkiraan<span style='color:red;'>*</span></label>
                  <select class="form-control select2" style="width: 100%;" name="ftKodePerkiraan" id="ftKodePerkiraan">
					<?php		
				 $tampil=mysql_query("SELECT * FROM tlnoperkiraan  ORDER BY ftKodePerkiraan");
				 echo "<option value='' selected>-- Pilih --</option>";
				   while($r=mysql_fetch_array($tampil)){
				   echo "<option value='$r[ftKodePerkiraan]'>$r[ftKodePerkiraan]</option>"; }
				   ?>
                </select>
                </div>
			
			 <div class="form-group">
                  <label>Modul<span style='color:red;'>*</span></label>
                  <input type="text" name="ftModul" id="ftModul" class="form-control" placeholder="Input ...">
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
                <a  class="btn btn-default" href="setting-coa.html">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Save</button>
              </div>
		</form>
      </div>
	<?php  		  
     break;
 
 //HARUS DIRUBAH (setting email)
  case "edit":


   $edit = mysql_query("SELECT * FROM tlcoa_seting WHERE ftCOA_No='$_GET[ftCOA_No]'");
    $r    = mysql_fetch_array($edit);
  echo"
  <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit COA Setting</h3>

          <div class='box-tools pull-right'>
            <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
           
          </div>
        </div>";
			
			
		echo"<form id='form' method='POST'  enctype='multipart/form-data' action='aksi-edit-setting-coa.html' onSubmit='return validasi(this)'>
        <!-- /.box-header -->
		
        <div class='box-body'>
		        <div class='row'>
            <div class='col-md-6'>
			
			
			<div class='form-group' >
                  <label>Kode<span style='color:red;'>*</span></label>
                  <input type='text' name='ftCOA_No'  value='$r[ftCOA_No]' class='form-control' placeholder='Input ...' readonly=yes>
                </div>
				
			
			 <div class='form-group'>
                  <label>Keterangan<span style='color:red;'>*</span></label>
                  <input type='text' name='ftCOA_LinkGL' id='ftCOA_LinkGL' value='$r[ftCOA_LinkGL]' class='form-control' placeholder='Enter ...'>
                </div>
				
			
			 <div class='form-group'>
                  <label>No Perkiraan<span style='color:red;'>*</span></label>
                  
				   <select class='form-control select2'  style='width: 100%;' name='ftKodePerkiraan' id='ftKodePerkiraan'>";
				 
				 $tampil=mysql_query("SELECT ftKodePerkiraan FROM tlnoperkiraan  ORDER BY ftKodePerkiraan");
				 if ($r[ftKodePerkiraan]==''){
				 echo"<option selected='selected' value=''>-- Pilih --</option>";}
				  while($w=mysql_fetch_array($tampil)){
					if ($r[ftKodePerkiraan]==$w[ftKodePerkiraan]){
					echo"<option value='$w[ftKodePerkiraan]' selected>$w[ftKodePerkiraan]</option>";}
					 else{
				  echo"<option value='$w[ftKodePerkiraan]'>$w[ftKodePerkiraan]</option>";}}
				  echo"</select>
                </div>
			
			 <div class='form-group'>
                  <label>Modul<span style='color:red;'>*</span></label>
                  <input type='text' name='ftModul' id='ftModul' value='$r[ftModul]' class='form-control' placeholder='Enter ...'>
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
                <a  class='btn btn-default' href='setting-coa.html'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>Update</button>
              </div>
		</form>";
		
    echo"  </div>";
   
    break;  
	//edit password
  
   }
   }
  ?>

