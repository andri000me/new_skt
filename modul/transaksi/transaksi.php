
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
  if (form.ftNoRekening.value == ""){
   sweetAlert("Oops...", "No Rekening harus di isi!", "error");
   form.ftNoRekening.focus();
    return (false);
  }else if (form.ftNamaNasabah.value == ""){
   sweetAlert("Oops...", "Nama Nasabah harus di isi!", "error");
   form.ftNamaNasabah.focus();
    return (false);
  }else if (form.fnStatus.value == ""){
   sweetAlert("Oops...", "Status harus di isi!", "error");
   form.fnStatus.focus();
    return (false);
  }else if (form.ftCabang.value == ""){
   sweetAlert("Oops...", "Cabang harus di isi!", "error");
   form.ftCabang.focus();
    return (false);
  }     
   
 }
</script>





<?php
include "control.php";
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
       FORM TRANSAKSI
        
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
              <h3 class="box-title"><input type="button" onclick="location.href='<?php echo "tambah-transaksi.html ";?>';" value="Tambah" class="btn bg-purple btn-flat margin"/></h3>
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
                  <th>No Rekening</th>
                  <th>Nama Nasabah</th>
				  <th>Alamat</th>
				  <th>Kota</th>
				  <th>Propinsi</th>
				  <th>Tipe Nasabah</th>
				  <th>Jenis</th>
				  <th>Dapem</th>
				  <th>Kantor Bayar</th>
				  <th>Gaji</th>
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
				$tampil=mysql_query("SELECT * FROM tlnasabah  ORDER BY ftNamaNasabah ");
				}else{
				$tampil=mysql_query("SELECT * FROM tlnasabah  ORDER BY ftNamaNasabah ");
				}
				$no = $posisi+1;
				$no1 = 0;	
				while($r=mysql_fetch_array($tampil)){
				 $no1++;	
				
				echo"
                <tr>
				  <td><span class='label bg-black disabled color-palette'>$no1</span></td>
                  <td>$r[ftNoRekening]</td>
                  <td>$r[ftNamaNasabah]</td> 
				  <td>$r[ftAlamat]</td>
                  <td>$r[ftKota]</td> 
				  <td>$r[ftPropinsi]</td>
                  <td>$r[fnTipeNasabah]</td> 
				  <td>$r[ftJenis]</td>
                  <td>$r[ftDapem]</td> 
				  <td>$r[ftKantorBayar]</td>
                  <td>$r[fcGaji]</td> 
				  <td>$r[fnStatus]</td>
                  <td>$r[ftCabang]</td> 
				  
								 				  
                  <td width='70px' onmouseover=\"this.style.cursor='pointer'\"><span class='label bg-gray disabled color-palette'><i class='fa fa-edit' title='edit $r[ftNamaNasabah]' onclick=\"location.href='edit-nasabah-$r[fnId].html';\"></i> &nbsp;&nbsp;&nbsp;  
				  ";
				//  if($_SESSION[leveluser]=='1'){
				  echo"<a class='fa fa-trash-o' title='delete $r[ftNamaNasabah]'  href=javascript:confirmdelete('aksi-delete-nasabah-$r[fnId].html') ></a>";
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
  <form id="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambah-transaksi.html" onSubmit="return validasi(this)">
  <section class="content">
   <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Input Transaksi</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
		
        <!-- /.box-header -->
        <div class="box-body" ">
		
          <div class="row">
            <div class="col-md-6">
			
			<div class="form-group has-warning" >
                  <label>No Transaksi</label>
				  <?php
					$tgl_sekarang = date("Y-m-d H:i:s");
					$tgl = date("d");
					$bln = date("m");
					$thn = date("Y");
					$no = "00001";
					// cari id transaksi terakhir yang berawalan tanggal hari ini
					$query = "SELECT max(fnid) AS last FROM txpinjaman_hdr ";
					$hasil = mysql_query($query);
					$data  = mysql_fetch_array($hasil);
					$lastNoTransaksi = $data['last'];
					$number = range(1,9999);
					$newID = sprintf("%05s", $lastNoTransaksi);
					
				
						echo" <input type='text' name='ftTrans_No' class='form-control' value='PJ$tgl$bln$newID' placeholder='Input ...' id='ftTrans_No' disabled>";
					
					 
					 ?>
                 
			 </div>
			
			 <div class="form-group has-warning" id="tgl_pinsjam" >
                <label>Tgl Pinjam</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="fdTrans_date" id="fdTrans_date">
                </div>
                <!-- /.input group -->
              </div> 	
			
			<div class="form-group has-warning" >
                  <label>Saldo Simpanan</label>
                  <input type="text" name="ftAlamat" class="form-control" placeholder="Input ..." id="ftAlamat">
			  </div>
			  <!-- /.form-group -->
            </div>
			 <!-- /.RIGHT SIDE -->
            <div class="col-md-6">
			
			<div class="form-group has-warning" >
                  <label>Keterangan</label>
				  <textarea class="form-control" rows="9" placeholder="Enter ..."></textarea>
             </div>
			
            <!-- /.END RIGHT SIDE -->
            </div>
            <!-- /.col -->
          </div>
		  
          <!-- /.row -->
        </div>
       
		 </div>
		 </section>
		 
		 
		  <div class="box-body" >
		<div class="col-md-6">
		 <div class="box box-success">
           
            <div class="box-body ">
           
			 <div class="form-group has-success">
                <label><span style="color:red;">*</span> No Rekening</label>
                <select class="form-control select2" style="width: 100%;" name="ftNoRekening" id="ftNoRekening">
                  <?php		
				 $tampil=mysql_query("SELECT ftNoRekening FROM tlnasabah WHERE fnStatus='1' ORDER BY ftNoRekening");
				 echo "<option value='' selected>-- Pilih --</option>";
				   while($r=mysql_fetch_array($tampil)){
				   echo "<option value='$r[ftNoRekening]'>$r[ftNoRekening]</option>"; }
				   ?>
                </select>
              </div>	
			
			 <div class="form-group has-success" id="ftNamaNasabah">
                  
                </div>
			<div class="box box-success">
			</div>
			  
			<div class="form-group has-success" >
                  <label>Pokok Pelunasan</label>
                  <input type="text" name="ftNoRekening" class="form-control" placeholder="Input ..." id="ftNoRekening">
			 </div>
			
			 <div class="form-group has-success">
                  <label>Bunga Pelunasan</label>
                  <input type="text" name="ftNamaNasabah" id="ftNamaNasabah" class="form-control" placeholder="Input ...">
                </div>
			
			<div class="form-group has-success" >
                  <label>Adm Pelunasan</label>
                  <input type="text" name="ftAlamat" class="form-control" placeholder="Input ..." id="ftAlamat">
			  </div> 

			<div class="form-group has-success" >
                  <label>Pblt Pelunasan</label>
                  <input type="text" name="ftNoRekening" class="form-control" placeholder="Input ..." id="ftNoRekening">
			 </div>
			
			 <div class="form-group has-success">
                  <label>Total Pelunasan</label>
                  <input type="text" name="ftNamaNasabah" id="ftNamaNasabah" class="form-control" placeholder="Input ...">
                </div>
			<div class="box box-warning">
			</div>
			
			<div class="form-group has-warning" >
                  <label>Plafond Pinjaman [Rp]</label>
                  <input type="text" name="ftAlamat" class="form-control" placeholder="Input ..." id="ftAlamat">
			  </div> 
			<div class="form-group has-warning" >
                  <label>Bunga [%]</label>
                  <input type="text" name="ftAlamat" class="form-control" placeholder="Input ..." id="ftAlamat">
			  </div> 
			 <div class="row">
                <div class="col-xs-4 has-warning">
				<label class="control-label" for="inputSuccess">Jangka Waktu</label>
                  <input type="text" class="form-control" placeholder="Input ...">
                </div>
                <div class="col-xs-8 has-warning">
				<label>&nbsp;</label>
                  <input type="text" class="form-control" placeholder=".00">
                </div>               
              </div>
			
            </div>
			
			
            <!-- /.box-body -->
          </div>
		  
		 
		  </div>
		  
		  <div class="col-md-6">
		  
		 <div class="box box-danger">
            <div class="box-body">
              
                <div class="form-group">
				<label>Plafond Pinjaman</label>
                  <input type="text" class="form-control" placeholder="Input ...">
                </div>
               
			   <div class="row">
                <div class="col-xs-4">
				<label>Potongan Adm [%]</label>
                  <input type="text" class="form-control" placeholder="Input ...">
                </div>
                <div class="col-xs-8">
				<label>&nbsp;</label>
                  <input type="text" class="form-control" placeholder=".00">
                </div>               
              </div></br>
			  
			     <div class="row">
                <div class="col-xs-4">
				<label>Potongan Asuransi [%]</label>
                  <input type="text" class="form-control" placeholder="Input ...">
                </div>
                <div class="col-xs-8">
				<label>&nbsp;</label>
                  <input type="text" class="form-control" placeholder=".00">
                </div>               
              </div></br>
			  
			   <div class="form-group">
				<label>Pembulatan</label>
                  <input type="text" class="form-control" placeholder="Input ...">
                </div>
				 <div class="form-group">
				<label>Pelunasan</label>
                  <input type="text" class="form-control" placeholder="Input ...">
                </div>
				 <div class="form-group">
				<label>Simpanan</label>
                  <input type="text" class="form-control" placeholder="Input ...">
                </div>
				 <div class="form-group">
				<label>Terima Bersih</label>
                  <input type="text" class="form-control" placeholder="Input ...">
                </div>
              
            </div>
            <!-- /.box-body -->
          </div>
		  
		  
		  <div class="box box-primary">
            <div class="box-body">
              
                <div class="form-group">
				<label>Pokok Angsuran</label>
                  <input type="text" class="form-control" placeholder="Input ...">
                </div>
              
			   <div class="form-group">
				<label>Bunga</label>
                  <input type="text" class="form-control" placeholder="Input ...">
                </div>
				 <div class="form-group">
				<label>Admin</label>
                  <input type="text" class="form-control" placeholder="Input ...">
                </div>
				 <div class="form-group">
				<label>Pblt</label>
                  <input type="text" class="form-control" placeholder="Input ...">
                </div>
				 <div class="form-group">
				<label>Tabungan Bersih</label>
                  <input type="text" class="form-control" placeholder="Input ...">
                </div>
				 <div class="form-group">
				<label>Jumlah Angsuran</label>
                  <input type="text" class="form-control" placeholder="Input ...">
                </div>
              
            </div>
            <!-- /.box-body -->
          </div>
		 

		  </div>
		  
		  </div>
		  
		  
	
     <!-- /.box-header -->
        <div class="box-body" >
	    <div class="row">
            <div class="col-md-6">
		 <div class="box-footer">
                <a  class="btn btn-default" href="transaksi.html">Cancel</a>
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
		  <!-- /.row -->
        </div>
        
		  
	  </form>
	<?php  		  
     break;
 
 //HARUS DIRUBAH (setting email)
  case "edit":


   $edit = mysql_query("SELECT * FROM tlnasabah WHERE fnId='$_GET[fnId]'");
    $r    = mysql_fetch_array($edit);
  echo"
  <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit Nasabah</h3>

          <div class='box-tools pull-right'>
            <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
           
          </div>
        </div>";
			
			
		echo"<form id='form' method='POST'  enctype='multipart/form-data' action='aksi-edit-nasabah.html' onSubmit='return validasi(this)'>
        <!-- /.box-header -->
		
        <div class='box-body'>
		 <input type=hidden name=id value=$r[fnId]>
          <div class='row'>
            <div class='col-md-6'>
			
			
			<div class='form-group' >
                  <label>No Rekening</label>
                  <input type='text' name='ftNoRekening' id='ftNoRekening' value='$r[ftNoRekening]' class='form-control' placeholder='Input ...' >
                </div>
				
			
			 <div class='form-group'>
                  <label>Nama Nasabah</label>
                  <input type='text' name='ftNamaNasabah' id='ftNamaNasabah' value='$r[ftNamaNasabah]' class='form-control' placeholder='Enter ...'>
                </div>
			
			<div class='form-group' >
                  <label>Alamat</label>
                  <input type='text' name='ftAlamat' id='ftAlamat' value='$r[ftAlamat]' class='form-control' placeholder='Input ...' >
                </div>
				
			
			 <div class='form-group'>
                  <label>Kota</label>
                  <input type='text' name='ftKota' id='ftKota' value='$r[ftKota]' class='form-control' placeholder='Enter ...'>
                </div>
			
			<div class='form-group' >
                  <label>Propinsi</label>
                  <input type='text' name='ftPropinsi' id='ftPropinsi' value='$r[ftPropinsi]' class='form-control' placeholder='Input ...' >
                </div>
				
			
			 <div class='form-group'>
                  <label>Tipe Nasabah</label>
                  
				   <select class='form-control select2'  style='width: 100%;' name='fnTipeNasabah' id='fnTipeNasabah'>";
				 $tampil=mysql_query("SELECT * FROM tltipenasabah  ORDER BY ftTipe");
				 if ($r[fnTipeNasabah]==''){
				 echo"<option selected='selected' value=''>-- Pilih --</option>";}
				  while($w=mysql_fetch_array($tampil)){
					if ($r[fnTipeNasabah]==$w[fnId]){
					echo"<option value='$w[fnId]' selected>$w[ftTipe]</option>";}
					 else{
				  echo"<option value='$w[fnId]'>$w[ftTipe]</option>";}}
				  echo"</select>
                </div>
			
			 
			
			
           
             
              <!-- /.form-group -->
            </div>
			
			
            <!-- /.col -->
			 <!-- /.RIGHT SIDE -->
            <div class='col-md-6'>
		<div class='form-group' >
                  <label>Jenis</label>
                 
				    <select class='form-control select2'  style='width: 100%;' name='ftJenis' id='ftJenis'>";
				 $tampil=mysql_query("SELECT * FROM tljenispensiun  ORDER BY ftNamaJenis");
				 if ($r[ftJenis]==''){
				 echo"<option selected='selected' value=''>-- Pilih --</option>";}
				  while($w=mysql_fetch_array($tampil)){
					if ($r[ftJenis]==$w[ftKodeJenis]){
					echo"<option value='$w[ftKodeJenis]' selected>$w[ftNamaJenis]</option>";}
					 else{
				  echo"<option value='$w[ftKodeJenis]'>$w[ftNamaJenis]</option>";}}
				  echo"</select>
                </div>
				
			
			 <div class='form-group'>
                  <label>Dapem</label>
                  <input type='text' name='ftDapem' id='ftDapem' value='$r[ftDapem]' class='form-control' placeholder='Enter ...'>
                </div>
			
			<div class='form-group' >
                  <label>Kantor Bayar</label>
                  
				   <select class='form-control select2'  style='width: 100%;' name='ftKantorBayar' id='ftKantorBayar'>";
				 $tampil=mysql_query("SELECT * FROM tlkantorbayar  ORDER BY ftNamaKantorBayar");
				 if ($r[ftKantorBayar]==''){
				 echo"<option selected='selected' value=''>-- Pilih --</option>";}
				  while($w=mysql_fetch_array($tampil)){
					if ($r[ftKantorBayar]==$w[ftKodeKantorBayar]){
					echo"<option value='$w[ftKodeKantorBayar]' selected>$w[ftNamaKantorBayar]</option>";}
					 else{
				  echo"<option value='$w[ftKodeKantorBayar]'>$w[ftNamaKantorBayar]</option>";}}
				  echo"</select>
                </div>
				
			
			 <div class='form-group'>
                  <label>Gaji</label>
                  <input type='text' name='fcGaji' id='fcGaji' value='$r[fcGaji]' class='form-control' placeholder='Enter ...'>
                </div>
			
			<div class='form-group'>
                  <label>Status</label>
                  <input type='text' name='fnStatus' id='fnStatus'  value='$r[fnStatus]' class='form-control' placeholder='Input ...' >
                </div>
			
			<div class='form-group'>
                  <label>Cabang</label>
                  <input type='text' name='ftCabang' value='$r[ftCabang]' id='ftCabang' class='form-control' placeholder='Input ...'>
                </div> 
            
			
			
			  
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
                <a  class='btn btn-default' href='nasabah.html'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>Update</button>
              </div>
		</form>";
		
    echo"  </div>";
   
    break;  
	//edit password
  
   }
   }
  ?>

