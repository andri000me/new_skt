 
	
	
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
  if (form.ffBunga.value == ""){
   sweetAlert("Oops...", "Suku bunga harus di isi!", "error");
   form.ffBunga.focus();
    return (false);
  }else if (form.ffAdm.value == ""){
   sweetAlert("Oops...", "Adm harus di isi!", "error");
   form.ffAdm.focus();
    return (false);
  }else if (form.ffAsuransi.value == ""){
   sweetAlert("Oops...", "Asuransi harus di isi!", "error");
   form.ffAsuransi.focus();
    return (false);
  }else if (form.fcMaterai.value == ""){
   sweetAlert("Oops...", "Materai harus di isi!", "error");
   form.fcMaterai.focus();
    return (false);
  }else if (form.fcAdmAngsuran.value == ""){
   sweetAlert("Oops...", "Adm Angsuran harus di isi!", "error");
   form.fcAdmAngsuran.focus();
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
include "config/control.php";

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
       FORM PINJAMAN MIKRO
        
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
              <h3 class="box-title"><input type="button" onclick="location.href='<?php echo "tambah-pinjaman-mikro.html ";?>';" value="Tambah" class="btn bg-purple btn-flat margin"/></h3>
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
                  <th style="color:#4375c6;">Suku Bunga</th>
				  <th style="color:#4375c6;">Adm</th>
				  <th style="color:#4375c6;">Asuransi</th>
				  <th style="color:#4375c6;">Materai</th>
				  <th style="color:#4375c6;">Adm Angsuran</th>
				  <th style="color:#4375c6;">Aktif</th>
			      <th></th>
				 
                </tr>
                </thead>
                <tbody>
				<?php 
				$p      = new Paging;
				$batas  = 40;
				$posisi = $p->cariPosisi($batas);
				if($_SESSION[leveluser]=='1'){
				$tampil=mysql_query("SELECT * FROM tlbiayaadmmikro  ORDER BY fnid ");
				}else{
				$tampil=mysql_query("SELECT * FROM tlbiayaadmmikro  ORDER BY fnid ");
				}
				$no = $posisi+1;
				$no1 = 0;	
				while($r=mysql_fetch_array($tampil)){
				 $no1++;	
				$fcMaterai = number_format ($r[fcMaterai], 0, ',', ',');
				$fcAdmAngsuran = number_format ($r[fcAdmAngsuran], 0, ',', ',');
				echo"
                <tr>
				  <td><span class='label bg-black disabled color-palette'>$no1</span></td>
          <td style='color:#4375c6;'>$r[ffBunga] %</td>
          <td style='color:#4375c6;'>$r[ffAdm] %</td> 
				  <td style='color:#4375c6;'>$r[ffAsuransi] %</td> 
				  <td style='color:#4375c6;'>$fcMaterai</td>
				  <td style='color:#4375c6;'>$fcAdmAngsuran</td>
				  <td style='color:#4375c6;'>$r[aktif]</td>
          <td width='70px' onmouseover=\"this.style.cursor='pointer'\"><span class='label bg-gray disabled color-palette'><i class='fa fa-check-square-o' title='Aktifkan $r[fnid]' onclick=\"location.href='aktif-pinjaman-mikro-$r[fnid].html';\"></i> &nbsp;&nbsp;&nbsp; 
			     <i class='fa fa-edit' title='edit $r[fnid]' onclick=\"location.href='edit-pinjaman-mikro-$r[fnid].html';\"></i> &nbsp;&nbsp;&nbsp;";
				//  if($_SESSION[leveluser]=='1'){
				  echo"<a class='fa fa-trash-o' title='delete $r[fnid]'  href=javascript:confirmdelete('aksi-delete-pinjaman-mikro-$r[fnid].html') ></a>";
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
  
  <form id="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambah-pinjaman-mikro.html" onSubmit="return validasi(this)">
  
   
		  <div class="box-body" >
		  
		<div class="col-md-6">
		 <div class="box-header with-border">
          <h3 class="box-title">Input Pinjaman Mikro</h3>
        </div>
		 <div class="box box-success">
           <div class="box-body ">
											
			<div class="form-group has-success" >
                  <label>Suku Bunga (%)<span style="color:red;">*</span></label>
                  <input type="text" name="ffBunga" class="form-control" placeholder="Input ..." id="ffBunga" onkeyup='jwfunction(this,event)' onkeypress='return isNumberKey(event)' maxlength='5'>
			 </div>
			
			 <div class="form-group has-success">
                  <label>Adm (%)<span style="color:red;">*</span></label>
                  <input type="text" name="ffAdm" id="ffAdm" class="form-control" placeholder="Input ..." onkeyup='jwfunction(this,event)' onkeypress='return isNumberKey(event)' maxlength='5'>
                </div>
			
			<div class="form-group has-success" >
                  <label>Asuransi (%)<span style="color:red;">*</span></label>
                  <input type="text" name="ffAsuransi" class="form-control" placeholder="Input ..." id="ffAsuransi" onkeyup='jwfunction(this,event)' onkeypress='return isNumberKey(event)' maxlength='5'>
			  </div> 
			<div class="form-group has-success" >
                  <label>Materai<span style="color:red;">*</span></label>
                  <input type="text" name="fcMaterai" class="form-control" placeholder="Input ..." id="fcMaterai" onkeyup='jwfunction(this,event)' onkeypress='return isNumberKey(event)' maxlength='7'>
			  </div>   
			<div class="form-group has-success" >
                  <label>Adm Angsuran<span style="color:red;">*</span></label>
                  <input type="text" name="fcAdmAngsuran" class="form-control" placeholder="Input ..." id="fcAdmAngsuran" onkeyup='jwfunction(this,event)' onkeypress='return isNumberKey(event)' maxlength='7'>
			  </div>      
			 <div class="box-footer">
                <a  class="btn btn-default" href="pinjaman-mikro.html">Cancel</a>
				 <button type="submit" name="submit" class="btn btn-info pull-right">Save</button>
             </div>	  
			  
			</div>
		   <!-- /.box-body -->
		   </div>
		    
		  </div>
		   
		  </div>
		  
		  
	
     <!-- /.box-header -->
       
        
		  
	  </form>
	  
	<?php  		  
     break;
 
 //HARUS DIRUBAH (setting email)
  case "edit":


   $edit = mysql_query("SELECT * FROM tlbiayaadmmikro WHERE fnid='$_GET[fnid]'");
   $r    = mysql_fetch_array($edit);
   $fcMaterai = number_format ($r[fcMaterai], 0, ',', ',');
   $fcAdmAngsuran = number_format ($r[fcAdmAngsuran], 0, ',', ',');
  echo"
  <form id='myForm' method='POST' enctype='multipart/form-data' action='aksi-edit-pinjaman-mikro.html' onSubmit='return validasi(this)'>
  
     <div class='box-body' >
		  
		<div class='col-md-6'>
		 <div class='box-header with-border'>
          <h3 class='box-title'>Edit Pinjaman Mikro</h3>
        </div>
		 <div class='box box-success'>
           <div class='box-body '>
			<div class='form-group has-success' >
                  <label>Suku Bunga (%)<span style='color:red;''>*</span></label>
				  <input type=hidden name=id value='$r[fnid]'>
                 
                  <input type='text' name='ffBunga' value='$r[ffBunga]' class='form-control' value='' placeholder='Input ...'' onkeyup='jwfunction(this,event)' onkeypress='return isNumberKey(event)' maxlength='5'>
			 </div>
			
			 <div class='form-group has-success'>
                  <label>Adm (%)<span style='color:red;''>*</span></label>
                  <input type='text' name='ffAdm' id='ffAdm' value='$r[ffAdm]' class='form-control' placeholder='Input ...' onkeyup='jwfunction(this,event)' onkeypress='return isNumberKey(event)' maxlength='5'>
                </div>
			
			<div class='form-group has-success' >
                  <label>Asuransi (%)<span style='color:red;''>*</span></label>
                  <input type='text' name='ffAsuransi' value='$r[ffAsuransi]' class='form-control' placeholder='Input ...' id='ffAsuransi' onkeyup='jwfunction(this,event)' onkeypress='return isNumberKey(event)' maxlength='5'>
			  </div> 
			<div class='form-group has-success' >
                  <label>Materai<span style='color:red;''>*</span></label>
                  <input type='text' name='fcMaterai' value='$fcMaterai'class='form-control' placeholder='Input ...' id='fcMaterai' onkeyup='jwfunction(this,event)' onkeypress='return isNumberKey(event)' maxlength='7'>
			  </div> 
			<div class='form-group has-success' >
                  <label>Adm Angsuran<span style='color:red;''>*</span></label>
                  <input type='text' name='fcAdmAngsuran' value='$fcAdmAngsuran'class='form-control' placeholder='Input ...' id='fcAdmAngsuran' onkeyup='jwfunction(this,event)' onkeypress='return isNumberKey(event)' maxlength='7'>
			  </div>    
			 <div class='box-footer'>
                <a  class='btn btn-default' href='pinjaman-mikro.html'>Cancel</a>
				 <button type='submit' name='submit' class='btn btn-info pull-right'>Save</button>
             </div>	  
			  
			</div>
		   <!-- /.box-body -->
		   </div>
		    
		  </div>
		   
		  </div>
        
		  
	  </form>";
   
    break;  
	//edit password
  
   }
   }
  ?>

 