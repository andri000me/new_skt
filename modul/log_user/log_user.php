
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


<?php
session_start();
//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
//if($cek==1 OR $_SESSION[leveluser]=='1' ){
if(!empty($_SESSION['leveluser'])){  
$base_url = $_SERVER['HTTP_HOST'];
  $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));

$aksi="modul/log_user/aksi_log_user.php";
switch($_GET[act]){
  // Tampil Hubungi Kami
  default:
   ?>
   
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Data Log User 
        
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
			       </div>
            <!-- /.box-header -->
            <div class="box-body">
			<div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
				  <th>No</th>
          <th>Nama</th>
          <th>Email</th>
				  <th>Level</th>
          <th>IP</th>
          <th>OS</th>
          <th>Browser</th>
          <th>Device</th>
				  <th>Login</th>
         
				   <th></th>
				 
                </tr>
                </thead>
                <tbody>
				<?php 
				$p      = new Paging;
				$batas  = 40;
				$posisi = $p->cariPosisi($batas);
				
				$tampil=mysql_query("SELECT * FROM users,tbl_level WHERE users.level=tbl_level.id_level AND users.isLogin=1 ORDER BY users.level ASC ");
				
				$no = $posisi+1;
				$no1 = 0;	
				while($r=mysql_fetch_array($tampil)){
				 $no1++;	
				 $show="<button type='botton' class='btn btn-danger pull-right' title='Kill' onclick=\"location.href='kill-log-user-$r[username].html';\">Kill Process</button>";
         $log=$r[isLogin]='Yes';
				echo"
                <tr>
				  <td><span class='label bg-black disabled color-palette'>$no1</span></td>
          <td>$r[nama_lengkap]</td> 
				  <td>$r[email]</td>
          <td>$r[nama_level]</td> 
          <td>$r[ip]</td> 
          <td>$r[os]</td> 
          <td>$r[browser]</td> 
          <td>$r[device]</td> 
          <td>$log</td> 
				  <td width='70px'> $show &nbsp;&nbsp;&nbsp; ";
				  
				  echo"</td>
				  
                </tr>";
              
				}
			   ?>
               
               
                </tbody>
            <!--    <tfoot>
                <tr>
                  <th>Nomor Internal User</th>
                  <th>No. SO</th>
                  <th>Judul Pekerjaan</th>
                  <th>No. PKB/No PR</th>
                  <th>Tgl. PKB/Tgl. PR</th>
				  <th>Nominal</th>
                  <th>Nama Pelaksana Pekerjaan</th>
                  <th>Nama Pelanggan</th>
                  <th>SBU</th>
                  <th>Progress Aktivasi</th>
                </tr>
                </tfoot> -->
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
 case "tambahdata":
  ?>
   <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Input Data Layout</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
		<form id="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambahdata-layout.html" onSubmit="return validasi(this)">
        <!-- /.box-header -->
        <div class="box-body" id="myForm">
		
          <div class="row">
            <div class="col-md-6">
			
			<div class="form-group" id="no_so22">
                  <label>Nama<span style='color:red;'>*</span></label>
                  <input type="text" name="nama" class="form-control" placeholder="Input ..." id="nama">
                  <?php
              if(isset($_GET['error']))
              {
              ?>
              <span class="help-block">Nama Sudah Ada</span>
              <?php
              }
              ?>
				  
                </div>
			<div class="form-group">
                  <label>Url<span style='color:red;'>*</span></label>
                  <input type="text" name="url" id="url" class="form-control" placeholder="Input ...">
                </div> 
        <div class="form-group">
                <label>Level<span style='color:red;'>*</span></label>
                <select class="form-control select2" style="width: 100%;" name="level" id="level">
                  <?php   
         $tampil=mysql_query("SELECT * FROM tbl_level WHERE aktif='Y' ORDER BY nama_level");
         echo "<option value='' selected>-- Pilih --</option>";
           while($r=mysql_fetch_array($tampil)){
           echo "<option value='$r[id_level]'>$r[nama_level]</option>"; }
           ?>
        </select>
              </div>            
			 <div class="form-group">
          <label>Warna<span style='color:red;'>*</span></label>
           <select class="form-control select2" style="width: 100%;" name="warna" id="warna">
           
           <option value='aqua' selected>Aqua</option>  
           <option value='yellow'>Yellow</option>
           <option value='green'>Green</option>
           <option value='red'>Red</option>
           <option value='grey'>Grey</option>
           </select>
                </div>
			<div class="form-group">
                  <label for="exampleInputFile">Upload Foto</label>
                  <input type="file" id="fupload" name="fupload">
                  <p class="help-block">Upload gambar.</p>
                </div> 
       
      <div class="form-group">
                  <label>Urutan</label>
                  <input type="text" name="urut" id="urut" class="form-control" placeholder="Hanya Angka" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                </div>  </br>
                   <!-- /.form-group -->
            </div>
			
			
            <!-- /.RIGHT SIDE -->
            <div class="col-md-6">
			      <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
		  
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
              <div class="box-footer">
                <a  class="btn btn-default" href="layout.html">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Save</button>
              </div>
		</form>
      </div>
	<?php  		  
     break;
 
 //HARUS DIRUBAH (setting email)
  case "editdata":
  
  function GetCombobox($table, $key,$nama,  $Nilai='') {
  $s = "select * from $table order by nama_sbu";
  $r = mysql_query($s);
  $_arrNilai = explode(',', $Nilai);
  $str = '';
  $str .= "<select class='form-control select2' multiple='multiple'  style='width: 100%;' name='".$nama."[]' >";
  while ($w = mysql_fetch_array($r)) {
    $_ck = (array_search($w[$key], $_arrNilai) === false)? '' : 'selected';
//    $str .= "<input type=checkbox name='".$key."[]' value='$w[$key]' $_ck>$w[$Label] ";
	
	$str .= "<option value='$w[$key]' $_ck>$w[$key]</option>";
	
  }
  $str .= "</select>";
  return $str;
}

   $edit = mysql_query("SELECT * FROM tbl_icon_layout WHERE id='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
  echo"
  <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit Data layout</h3>

          <div class='box-tools pull-right'>
            <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
           
          </div>
        </div>";
		if($_SESSION[leveluser]=='1'){			
			
		echo"<form id='form' method='POST'  enctype='multipart/form-data' action='aksi-editdata-layout.html' >
        <!-- /.box-header -->
		
        <div class='box-body'>
		
          <div class='row'>
            <div class='col-md-6'>
			
			
			<div class='form-group' id='username'>
                  <label>Nama<span style='color:red;'>*</span></label>
                  <input type='hidden' name='id'  value='$r[id]' >
                  <input type='text' name='nama' id='nama' value='$r[nama]' class='form-control' placeholder='Input ...' >
                </div>
				
			
			 <div class='form-group'>
                  <label>Url<span style='color:red;'>*</span></label>
                  <input type='text' name='url' id='url' value='$r[url]' class='form-control' placeholder='Enter ...'>
                </div>
			
			<div class='form-group'>
                <label>Level<span style='color:red;'>*</span></label>
                <select class='form-control select2'  style='width: 100%;' name='level' id='level'>";
         $tampil=mysql_query("SELECT * FROM tbl_level WHERE aktif='Y' ORDER BY nama_level");
         if ($r[level]==''){
         echo"<option selected='selected' value=''>-- Pilih --</option>";}
          while($w=mysql_fetch_array($tampil)){
          if ($r[level]==$w[id_level]){
          echo"<option value='$w[id_level]' selected>$w[nama_level]</option>";}
           else{
          echo"<option value='$w[id_level]'>$w[nama_level]</option>";}}
          echo"</select>
              </div>
			
			<div class='form-group'>
                <label>Warna<span style='color:red;'>*</span></label>
                <select class='form-control select2'  style='width: 100%;' name='warna' id='warna'>";
                echo"<option value='$r[warna]' selected>$r[warna]</option>
                       <option value='aqua'>Aqua</option>  
                       <option value='yellow'>Yellow</option>
                       <option value='green'>Green</option>
                       <option value='red'>Red</option>
                       <option value='grey'>Grey</option>
          </select>
              </div> 
			
              <!-- /.form-group -->
            </div>
			
			
            <!-- /.col -->
            <div class='col-md-6'>
		  <div class='form-group'>
                  ";
          if($r[gambar]==''){
           echo"<img src='img/user_blank.jpg' width='80px'>";  
          }else{
           echo"<img src='img/$r[gambar]' width='80px'>";   
          }
          echo"
                </div> 
       <div class='form-group'>
                  <label for='exampleInputFile'>Ganti Gambar</label>
                  <input type='file' name='fupload' id='fupload'>
                  <p class='help-block'>Upload Gambar.</p>
                </div>  
			";
		
			
		echo"	 <!-- radio -->
                <div class='form-group'>
				<label>Tampilkan di Dashboard</label>";
				 if ($r[tampil]=='N'){
				echo "
                  <div class='radio'>
                    <label>
                      <input type='radio' name='tampil'  value='N' checked>
                      N
                    </label>
                  </div>
                  <div class='radio'>
                    <label>
                      <input type='radio' name='tampil'  value='Y'>
                      Y
                    </label>
                  </div>";
                 }else{
					echo "
                  <div class='radio'>
                    <label>
                      <input type='radio' name='tampil'  value='N' >
                      N
                    </label>
                  </div>
                  <div class='radio'>
                    <label>
                      <input type='radio' name='tampil'  value='Y' checked>
                      Y
                    </label>
                  </div>"; 
				 } 
                echo"</div>
				<div class='form-group'>
                  <label>Urutan</label>
                  <input type='text' name='urut' id='urut' value='$r[urut]' class='form-control' placeholder='Hanya Angka' onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                </div>  </br>
				<!-- /.form-group -->
            </div>
			
            <!-- /.col -->
          </div>
		  
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
              <div class='box-footer'>
                <a  class='btn btn-default' href='layout.html'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>Update</button>
              </div>
		</form>";
		}
    echo"  </div>";
   
    break;  
	//edit password
  
   }
   }
  ?>

