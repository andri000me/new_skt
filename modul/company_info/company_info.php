
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
  if (form.ftCompany_Code.value == ""){
   sweetAlert("Oops...", "Kode Perusahaan harus di isi!", "error");
   form.ftCompany_Code.focus();
    return (false);
  } else if (form.ftCompany_Name.value == ""){
   sweetAlert("Oops...", "Nama Perusahaan harus di isi!", "error");
   form.ftCompany_Name.focus();
    return (false);
  } else if (form.ftCompany_Address.value == ""){
   sweetAlert("Oops...", "Alamat harus di isi!", "error");
   form.ftCompany_Address.focus();
    return (false);
  } else if (form.ftCity.value == ""){
   sweetAlert("Oops...", "Kota harus di isi!", "error");
   form.ftCity.focus();
    return (false);
  } else if (form.ftZip_code.value == ""){
   sweetAlert("Oops...", "Kode Pos harus di isi!", "error");
   form.ftZip_code.focus();
    return (false);
  } else if (form.ftBranch_Code.value == ""){
   sweetAlert("Oops...", "Cabang harus di isi!", "error");
   form.ftBranch_Code.focus();
    return (false);
  } else if (form.ftCountry.value == ""){
   sweetAlert("Oops...", "Negara harus di isi!", "error");
   form.ftCountry.focus();
    return (false);
  }      
   
 }
</script>

<script>
  $(function () {
	//Money Euro
    $("[data-mask]").inputmask();  
   });
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
       FORM COMPANY INFO 
        
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
              <h3 class="box-title"><input type="button" onclick="location.href='<?php echo "tambah-company-info.html ";?>';" value="Tambah" class="btn bg-purple btn-flat margin"/></h3>
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
                  <th>Kode Perusahaan</th>
                  <th>Nama Perusahaan</th>
                  <th>Alamat</th>
				  <th>Kota</th>
          <th>Cabang</th>
				  <th>Kode Pos</th>
				  <th>Negara</th>
				  <th>Telepon</th>
				  <th>Fax</th>
				  <th>Aktif</th>
				   <th></th>
				 
                </tr>
                </thead>
                <tbody>
				<?php 
				$p      = new Paging;
				$batas  = 40;
				$posisi = $p->cariPosisi($batas);
				if($_SESSION[leveluser]=='1'){
				$tampil=mysql_query("SELECT * FROM tscompany_info  ORDER BY fnid ");
				}else{
				$tampil=mysql_query("SELECT * FROM tscompany_info  ORDER BY fnid ");
				}
				$no = $posisi+1;
				$no1 = 0;	
				while($r=mysql_fetch_array($tampil)){
				 $no1++;	
				
				echo"
                <tr>
				  <td><span class='label bg-black disabled color-palette'>$no1</span></td>
          <td>$r[ftCompany_Code]</td>
          <td>$r[ftCompany_Name]</td> 
				  <td>$r[ftCompany_Address]</td>
          <td>$r[ftCity]</td>
          <td>$r[ftBranch_Code]</td> 
				  <td>$r[ftZip_code]</td>
          <td>$r[ftCountry]</td> 
				  <td>$r[ftTelephone]</td>
          <td>$r[ftFax]</td> 
					<td>$r[aktif]</td>			 				  
          <td width='70px'>
				  
          <span class='label bg-gray disabled color-palette' onmouseover=\"this.style.cursor='pointer'\"><i class='fa fa-check-square-o' title='Aktifkan $r[ftCompany_Name]' onclick=\"location.href='aktif-company-info-$r[fnid].html';\"></i> &nbsp;&nbsp;&nbsp; 
           <i class='fa fa-edit' title='edit $r[ftCompany_Name]' onclick=\"location.href='edit-company-info-$r[fnid].html';\"></i> &nbsp;&nbsp;&nbsp;";

				//  if($_SESSION[leveluser]=='1'){
				  echo"<a class='fa fa-trash-o' title='delete $r[ftCompany_Name]'  href=javascript:confirmdelete('aksi-delete-company-info-$r[fnid].html') ></a>";
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
  <form id="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambah-company-info.html" onSubmit="return validasi(this)">
  <section class="content">
   <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Input Company Info</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
		
        <!-- /.box-header -->
        <div class="box-body">
		
          <div class= "row">
            <div class="col-md-6">
			
			
			<div class="form-group has-warning" >
                  <label>Kode Perusahaan<span style='color:red;'>*</span></label>
                  <input type="text" name="ftCompany_Code" class="form-control" placeholder="Input ..." id="ftCompany_Code">
			  </div>
			<div class="form-group has-warning" >
                  <label>Nama Perusahaan<span style='color:red;'>*</span></label>
                  <input type="text" name="ftCompany_Name" class="form-control" placeholder="Input ..." id="ftCompany_Name">
			  </div>
			 <div class="form-group has-warning" >
                  <label>Alamat<span style='color:red;'>*</span></label>
                  <textarea class="form-control" rows="5" name="ftCompany_Address" id="ftCompany_Address" placeholder="Input ..."></textarea>
			  </div>
			 <div class="form-group has-warning" >
                  <label>Kota<span style='color:red;'>*</span></label>
                  <input type="text" name="ftCity" class="form-control" placeholder="Input ..." id="ftCity">
			  </div>
			 <div class="form-group has-warning" >
                  <label>Kode Pos<span style='color:red;'>*</span></label>
                  <input type="text" name="ftZip_code" onkeypress="return hanyaAngka(event)" class="form-control" placeholder="Number Only" id="ftZip_code" maxlength='5'>
			  </div>
			 <div class="form-group has-warning" >
                  <label>Cabang<span style='color:red;'>*</span></label>
                  <input type="text" name="ftBranch_Code" class="form-control" placeholder="Input ..." id="ftBranch_Code">
			  </div>
			  <!-- /.form-group -->
            </div>
			
			
			
			 <!-- /.RIGHT SIDE -->
            <div class="col-md-6">
			<div class="form-group has-warning" >
                  <label>Negara<span style='color:red;'>*</span></label>
                  <input type="text" name="ftCountry" class="form-control" placeholder="Input ..." id="ftCountry">
			  </div>
			<div class="form-group has-warning" >
                  <label>Telepon</label>
				   <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" name="ftTelephone" data-inputmask='"mask": "999-999-999-999"' data-mask >
                </div>
                 
			  </div>
			 <div class="form-group has-warning" >
                  <label>Fax</label>
				   <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-fax"></i>
                  </div>
                  <input type="text" class="form-control" name="ftFax" data-inputmask='"mask": "999-999-999"' data-mask>
                </div>
                
			  </div>
			<div class="form-group has-warning" >
                  <label>Special Notes</label>
				  <textarea class="form-control" name="ftSpecial_Notes" rows="9" placeholder="Input ..."></textarea>
             </div>
			
            <!-- /.END RIGHT SIDE -->
            </div>
			
			
            <!-- /.col -->
          </div>
		  
		  
          <!-- /.row -->
        </div>
       
	    <div class="row">
            <div class="col-md-6">
		 <div class="box-footer">
                <a  class="btn btn-default" href="company-info.html">Cancel</a>
             </div>	
			  <!-- /.form-group -->
            </div>
			 <!-- /.RIGHT SIDE -->
            <div class="col-md-6">
			 <div class="box-footer">
               <button type="submit" class="btn btn-info pull-right">Save</button>
              </div>	
			 <!-- /.END RIGHT SIDE -->
            </div>
            <!-- /.col -->
          </div>
	   
		 </div>
		 
		
		 </section>
	
		  
	  </form>
	<?php  		  
     break;
 
 //HARUS DIRUBAH (setting email)
  case "edit":


   $edit = mysql_query("SELECT * FROM tscompany_info WHERE fnid='$_GET[fnid]'");
    $s    = mysql_fetch_array($edit);
  echo"
   <form id='myForm' method='POST' enctype='multipart/form-data' action='aksi-edit-company-info.html' onSubmit='return validasi(this)'>
  <section class='content'>
   <div class='box box-info'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit Company Info</h3>

          <div class='box-tools pull-right'>
            <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
           
          </div>
        </div>
		
        <!-- /.box-header -->
        <div class='box-body'>
		
          <div class= 'row'>
            <div class='col-md-6'>
			
			
			<div class='form-group has-warning' >
                  <label>Kode Perusahaan<span style='color:red;'>*</span></label>
				   <input type=hidden name=id value='$s[fnid]'>
                  <input type='text' name='ftCompany_Code' class='form-control' value='$s[ftCompany_Code]' placeholder='Input ...' id='ftCompany_Code'>
			  </div>
			<div class='form-group has-warning' >
                  <label>Nama Perusahaan<span style='color:red;'>*</span></label>
                  <input type='text' name='ftCompany_Name' class='form-control' value='$s[ftCompany_Name]' placeholder='Input ...' id='ftCompany_Name'>
			  </div>
			 <div class='form-group has-warning' >
                  <label>Alamat<span style='color:red;'>*</span></label>
                  <textarea class='form-control' rows='5' name='ftCompany_Address' id='ftCompany_Address'  placeholder='Input ...'>$s[ftCompany_Address]</textarea>
			  </div>
			 <div class='form-group has-warning' >
                  <label>Kota<span style='color:red;'>*</span></label>
                  <input type='text' name='ftCity' class='form-control' value='$s[ftCity]' placeholder='Input ...' id='ftCity'>
			  </div>
			 <div class='form-group has-warning' >
                  <label>Kode Pos<span style='color:red;'>*</span></label>
                  <input type='text' name='ftZip_code' onkeypress='return hanyaAngka(event)' class='form-control' value='$s[ftZip_code]' placeholder='Input ...' id='ftZip_code' maxlength='5'>
			  </div>
			<div class='form-group has-warning' >
                  <label>Cabang<span style='color:red;'>*</span></label>
                  <input type='text' name='ftBranch_Code' class='form-control' value='$s[ftBranch_Code]' placeholder='Input ...' id='ftBranch_Code'>
			  </div> 
			  <!-- /.form-group -->
            </div>
			
			
			
			 <!-- /.RIGHT SIDE -->
            <div class='col-md-6'>
			<div class='form-group has-warning' >
                  <label>Negara<span style='color:red;'>*</span></label>
                  <input type='text' name='ftCountry' class='form-control' value='$s[ftCountry]' placeholder='Input ...' id='ftCountry'>
			  </div>
			<div class='form-group has-warning' >
                  <label>Telepon</label>
				   <div class='input-group'>
                  <div class='input-group-addon'>
                    <i class='fa fa-phone'></i>
                  </div>
                  <input type='text' class='form-control' name='ftTelephone' value='$s[ftTelephone]' data-inputmask=''mask': '999-999-999-999'' data-mask>
                </div>
                 
			  </div>
			 <div class='form-group has-warning' >
                  <label>Fax</label>
				   <div class='input-group'>
                  <div class='input-group-addon'>
                    <i class='fa fa-fax'></i>
                  </div>
                  <input type='text' class='form-control' name='ftFax' value='$s[ftFax]' data-inputmask=''mask': '999-999-999'' data-mask>
                </div>
                
			  </div>
			<div class='form-group has-warning' >
                  <label>Special Notes</label>
				  <textarea class='form-control' name='ftSpecial_Notes' rows='9' placeholder='Input ...'>$s[ftSpecial_Notes] </textarea>
             </div>
			
            <!-- /.END RIGHT SIDE -->
            </div>
			
			
            <!-- /.col -->
          </div>
		  
		  
          <!-- /.row -->
        </div>
       
	    <div class='row'>
            <div class='col-md-6'>
		 <div class='box-footer'>
                <a  class='btn btn-default' href='company-info.html'>Cancel</a>
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
          </div>
	   
		 </div>
		 
		
		 </section>
	
		  
	  </form>";
   
    break;  
	//edit password
  
   }
   }
  ?>
<script>
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
	</script>
