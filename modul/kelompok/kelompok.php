
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
  if (form.ftKodeKelompok.value == ""){
   sweetAlert("Oops...", "Kode Kelompok harus di isi!", "error");
   form.ftKodeKelompok.focus();
    return (false);
  }else if (form.ftNamaKelompok.value == ""){
   sweetAlert("Oops...", "Nama Kelompok harus di isi!", "error");
   form.ftNamaKelompok.focus();
    return (false);
  }else if (form.ftKodeWilayah.value == ""){
   sweetAlert("Oops...", "Kode Wilayah harus di isi!", "error");
   form.ftKodeWilayah.focus();
    return (false);
  }else if (form.fnStatus.value == ""){
   sweetAlert("Oops...", "Status harus di isi!", "error");
   form.fnStatus.focus();
    return (false);
  }else if (form.ftBranch_Code.value == ""){
   sweetAlert("Oops...", "Cabang harus di isi!", "error");
   form.ftBranch_Code.focus();
    return (false);
  }     
   
 }
</script>
<style>
 .btnprint{
   background-color:#4CAF50;
   border:none;
   color:white;
   padding:8px 22px;
   text-align:center;
   text-decoration:none;
   display:inline-block;
   font-size:16px;
   font-weight:bold;
   border-radius: 5px;
 }
 .btnexport{
   background-color:#4CAF50;
   border:none;
   color:white;
   padding:8px 22px;
   text-align:center;
   text-decoration:none;
   display:inline-block;
   font-size:16px;
   font-weight:bold;
   border-radius: 5px;
 }

 
</style>




<?php

//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
//if($cek==1 OR $_SESSION[leveluser]=='1' || $_SESSION[leveluser]=='4'){
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
       FORM KELOMPOK 
        
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
			// if ($_SESSION[leveluser]=='1' || $_SESSION[leveluser]=='4'){
			 ?>
              <h3 class="box-title"><input type="button" onclick="location.href='<?php echo "tambah-kelompok.html ";?>';" value="Tambah" class="btn bg-purple btn-flat margin"/></h3>
              <h3 class="box-title"><input type="button" onclick="location.href='<?php echo "print-kelompok.html ";?>';" value="Print Kelompok" class="btn bg-purple btn-flat margin"/></h3>
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
          <th>Kode Kelompok</th>
          <th>Nama Kelompok</th>
          <th>Kode Wilayah</th>
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
				$tampil=mysql_query("SELECT * FROM tlkelompok  ORDER BY fnId ");
				}else{
				$tampil=mysql_query("SELECT * FROM tlkelompok  ORDER BY fnId ");
				}
				$no = $posisi+1;
				$no1 = 0;	
				while($r=mysql_fetch_array($tampil)){
				 $no1++;	
				
				echo"
                <tr>
				  <td><span class='label bg-black disabled color-palette'>$no1</span></td>
                  <td>$r[ftKodeKelompok]</td>
                  <td>$r[ftNamaKelompok]</td>
                  <td>$r[ftKodeWilayah]</td>";
				if($r[fnStatus]==0){
					echo"<td>Tidak Aktif</td>";
				}else if($r[fnStatus]==1){
					echo"<td>Aktif</td>";
				}		
				echo"  <td>$r[ftBranch_Code]</td> 
				  
								 				  
                  <td width='70px' onmouseover=\"this.style.cursor='pointer'\"><span class='label bg-gray disabled color-palette'><i class='fa fa-edit' title='edit $r[ftNamaKelompok]' onclick=\"location.href='edit-kelompok-$r[fnId].html';\"></i> &nbsp;&nbsp;&nbsp;  
				  ";
				//  if($_SESSION[leveluser]=='1'){
				  echo"<a class='fa fa-trash-o' title='delete $r[ftNamaKelompok]'  href=javascript:confirmdelete('aksi-delete-kelompok-$r[fnId].html') ></a>";
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
          <h3 class="box-title">Input Kelompok</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
		<form id="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambah-kelompok.html" onSubmit="return validasi(this)">
        <!-- /.box-header -->
        <div class="box-body" id="myForm">
		
          <div class="row">
            <div class="col-md-6">
			
			<div class="form-group" >
                  <label>Kode Kelompok<span style="color:red;">*</span></label>
                  <input type="text" name="ftKodeKelompok" class="form-control" placeholder="Input ..." id="ftKodeKelompok">
				  
                </div>
			
			 <div class="form-group">
                  <label>Nama Kelompok<span style="color:red;">*</span></label>
                  <input type="text" name="ftNamaKelompok" id="ftNamaKelompok" class="form-control" placeholder="Input ...">

                </div>
			 <div class="form-group">
                  <label>Kode Wilayah<span style="color:red;">*</span></label>
                  
                  <select class="form-control select2" style="width: 100%;" name="ftKodeWilayah" id="ftKodeWilayah">
                            <?php       
                             $tampil=mysql_query("SELECT ftKodeWilayah,ftNamaWilayah FROM tlwilayah WHERE fnStatus =1 ");
                             echo "<option value='' selected>-- Pilih --</option>";
                               while($r=mysql_fetch_array($tampil)){
                               echo "<option value='$r[ftKodeWilayah]'>$r[ftNamaWilayah]</option>"; }
                               ?>
                        </select>
                </div>
      <div class="form-group">
                  <label>Nama AO</label>
                  <input type="text" name="ftNamaAO" id="ftNamaAO" class="form-control" placeholder="Input ...">

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
           echo "<input type='text' name='ftBranch_Code' id='ftBranch_Code' value='$r[ftBranch_Code]' class='form-control' placeholder='Input ...'' readonly>"; 
           ?>
         
                </div>  </br>
			<div class="form-group " >
            
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
                <a  class="btn btn-default" href="kelompok.html">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Save</button>
              </div>
		</form>
      </div>
	<?php  		  
     break;
 
 //HARUS DIRUBAH (setting email)
  case "edit":


   $edit = mysql_query("SELECT * FROM tlkelompok WHERE fnId='$_GET[fnId]'");
    $r    = mysql_fetch_array($edit);
  echo"
  <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit Kelompok</h3>

          <div class='box-tools pull-right'>
            <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
           
          </div>
        </div>";
			
			
		echo"<form id='form' method='POST'  enctype='multipart/form-data' action='aksi-edit-kelompok.html' onSubmit='return validasi(this)'>
        <!-- /.box-header -->
		
        <div class='box-body'>
		 <input type=hidden name=id value=$r[fnId]>
          <div class='row'>
            <div class='col-md-6'>
			
			
			<div class='form-group' >
                  <label>Kode Kelompok<span style='color:red;'>*</span></label>
                  <input type='text' name='ftKodeKelompok' id='ftKodeKelompok' value='$r[ftKodeKelompok]' class='form-control' placeholder='Input ...' >
                </div>
				
			
			 <div class='form-group'>
                  <label>Nama Kelompok<span style='color:red;'>*</span></label>
                  <input type='text' name='ftNamaKelompok' id='ftNamaKelompok' value='$r[ftNamaKelompok]' class='form-control' placeholder='Enter ...'>
                </div>
			<div class='form-group'>
                  <label>Kode Wilayah<span style='color:red;'>*</span></label>
                 
                  <select class='form-control select2'  style='width: 100%;' name='ftKodeWilayah' id='ftKodeWilayah'>";
                     $tampil=mysql_query("SELECT ftKodeWilayah,ftNamaWilayah FROM tlwilayah WHERE fnStatus=1  ORDER BY ftKodeWilayah");
                     if ($r[ftKodeWilayah]==''){
                     echo"<option selected='selected' value=''>-- Pilih --</option>";}
                      while($w=mysql_fetch_array($tampil)){
                      if ($r[ftKodeWilayah]==$w[ftKodeWilayah]){
                      echo"<option value='$w[ftKodeWilayah]' selected>$w[ftNamaWilayah]</option>";}
                       else{
                      echo"<option value='$w[ftKodeWilayah]'>$w[ftNamaWilayah]</option>";}}
                      echo"</select>
                </div>
      <div class='form-group'>
                  <label>Nama AO</label>
                  <input type='text' name='ftNamaAO' id='ftNamaAO' value='$r[ftNamaAO]' class='form-control' placeholder='Enter ...'>
                </div>          
			<div class='form-group'>
                  <label>Status<span style='color:red;'>*</span></label>
                 <select class='form-control select2'  style='width: 100%;' name='fnStatus_edit' id='fnStatus_edit'>";
				 
				 if ($r[fnStatus]==''){
				 echo"<option  value='' selected>-- Pilih --</option>
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
           echo "<input type='text' name='ftBranch_Code' id='ftBranch_Code' value='$r[ftBranch_Code]' class='form-control' placeholder='Input ...'' readonly> 
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
                <a  class='btn btn-default' href='kelompok.html'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>Update</button>
              </div>
		</form>";
		
    echo"  </div>";
   
    break;  
	case "print":
  ?>
   <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Print Kelompok</h3>
     </div>
    

  <!-- Header -->
   <div class="box box-solid">
    <div class="box-body layout-top-nav">
      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container-fluid">
              <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse">
              <form id="myForm" autocomplete="off" name="myForm" method="POST" enctype="multipart/form-data" >

      <div class="box-header">
      <h3 class="box-title">

          <select  style="width: 400px;font-size: 12px;" class="btn bg-purple dropdown-toggle select2" name="ftKodeWilayah" id="ftKodeWilayah" onchange="tampilWilayah()">
                            <?php       
                             $tampil=mysql_query("SELECT ftKodeWilayah FROM tlwilayah WHERE fnStatus =1 ");
                             echo "<option value='' selected>-- Pilih Wilayah--</option>";
                               while($r=mysql_fetch_array($tampil)){
                               echo "<option value='$r[ftKodeWilayah]'>$r[ftKodeWilayah]</option>"; }
                               ?>
                        </select>

          </h3>
       <h3 class="box-title">&nbsp;&nbsp;&nbsp;
          <button class="btnprint bg-purple"><span>Print</span></button>
          </h3>
            </div>

  </form>
              </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>          
      
    </div>
  </div>
  <!-- end header -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box box-primary" id='printr'>
  <pre class="prettyprint" id="tes">

</pre>       </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  <div id="tes"></div>
    <!-- /.content -->
  <!-- ===================================================================== -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
      </div>
  <?php       
     break;
 
 //HARUS DIRUBAH (setting email)
  
   }
   }
  ?>

<script>
function printContent(el){
  var restorepage = document.body.innerHTML;
  var printcontent = document.getElementById(el).innerHTML;
  document.body.innerHTML = printcontent;
  window.print();
  document.body.innerHTML = restorepage;
}

function showKelompok(menu) {
  sList = window.open('modul/kelompok/tampilkelompok.php', 'Print', 'width=920,height=420,scrollbars=yes');
  }

  $('.btnprint').click(function(){
  var printme = document.getElementById('printr');
  var wme = window.open("","","width=900,height=700");
  wme.document.write(printme.outerHTML);
  wme.document.close();
  wme.focus();
  wme.print();
  wme.close();
});

  function tampilWilayah(){

  var wil=$('#ftKodeWilayah').val();
  /*console.log(wil);    */

      $.ajax({
      type: 'GET',
      url: 'modul/kelompok/tampil.php ',
      data: 'wilayah='+ wil, 
        dataType: 'html',
        success: function(response) {
        $('#tes').html(response);
      }
    
    })
   
}
</script>