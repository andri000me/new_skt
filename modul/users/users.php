
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
  if (form.username.value == ""){
   sweetAlert("Oops...", "Username harus di isi!", "error");
   form.username.focus();
    return (false);
  }else if (form.password.value == ""){
   sweetAlert("Oops...", "Password harus di isi!", "error");
   form.password.focus();
    return (false);
  }else if (form.nama_lengkap.value == ""){
   sweetAlert("Oops...", "Nama Lengkap harus di isi!", "error");
   form.nama_lengkap.focus();
    return (false);
  }else if (form.email.value == ""){
   sweetAlert("Oops...", "Email harus di isi!", "error");
   form.email.focus();
    return (false);
  }else if (form.level.value == ""){
   sweetAlert("Oops...", "Level harus di isi!", "error");
   form.level.focus();
    return (false);
  }      
   
 }
</script>





<?php
session_start();
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
       Data Users 
        
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
			 if ($_SESSION[leveluser]=='1'){
			 ?>
              <h3 class="box-title"><input type="button" onclick="location.href='<?php echo "tambahdata-users.html ";?>';" value="Tambah Users" class="btn bg-purple btn-flat margin"/></h3>
			 <?php
			 }else{
				echo""; 
			 }
			?>	
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>No</th>
                  
                  <th>Nama Lengkap</th>
                  <th>Email</th>
				  <th>Level</th>
				  <th>Foto</th>
                  <th>Blokir</th>
				   <th></th>
				 
                </tr>
                </thead>
                <tbody>
				<?php 
				$p      = new Paging;
				$batas  = 40;
				$posisi = $p->cariPosisi($batas);
				if($_SESSION[leveluser]=='1'){
				$tampil=mysql_query("SELECT * FROM users,tbl_level WHERE users.level=tbl_level.id_level ORDER BY nama_lengkap ");
				}else{
				$tampil=mysql_query("SELECT * FROM users,tbl_level WHERE users.level=tbl_level.id_level AND username='$_SESSION[username]' ORDER BY nama_lengkap ");	
				}
				$no = $posisi+1;
				$no1 = 0;	
				while($r=mysql_fetch_array($tampil)){
				 $no1++;	
				
				echo"
                <tr>
				  <td><span class='label bg-black disabled color-palette'>$no1</span></td>
                  
                  <td>$r[nama_lengkap]</td> 
				  <td>$r[email]</td>
          <td>$r[nama_level]</td> 
				  ";
				  if($r[foto]==''){
					 echo"<td><img src=images/user_blank.jpg width='40px'></td>";  
				  }else{
					 echo"<td><img src='images/user/$r[foto]' width='40px'></td>";  
				  }
				  if($r[blokir]=='N'){
					echo" <td><span class='label label-success'>$r[blokir]</span></td>";  
				  }else{
					echo" <td><span class='label label-danger'>$r[blokir]</span></td>";    
				  }
				  echo"
                  
				 				  
                  <td width='70px'><span class='label bg-gray disabled color-palette' onmouseover=\"this.style.cursor='pointer'\"><i class='fa fa-edit' title='edit $r[username]' onclick=\"location.href='editdata-users-$r[username].html';\"></i> &nbsp;&nbsp;&nbsp;  
				  <i class='fa fa-key' title='ganti password $r[username]' onclick=\"location.href='editpass-users-$r[username].html';\"></i>
                  &nbsp;&nbsp;&nbsp;";
				  if($_SESSION[leveluser]=='1'){
				  echo"<a class='fa fa-trash-o' title='delete $r[username]'  href=javascript:confirmdelete('$aksi?module=users&act=hapus&username=$r[username]') ></a>";
				  }else{
					  echo"";
				  }
				  echo"</span></td>
				  
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
          <h3 class="box-title">Input Data Users</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
		<form id="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambahdata-users.html" onSubmit="return validasi(this)">
        <!-- /.box-header -->
        <div class="box-body" id="myForm">
		
          <div class="row">
            <div class="col-md-6">
			
			<div class="form-group" id="no_so22">
                  <label>Username<span style='color:red;'>*</span></label>
                  <input type="text" name="username" class="form-control" placeholder="Input ..." id="username">
                  <?php
              if(isset($_GET['error']))
              {
              ?>
              <span class="help-block">Username Sudah Ada</span>
              <?php
              }
              ?>
				  
                </div>
			<div class="form-group">
                  <label>Password<span style='color:red;'>*</span></label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Input ...">
                </div>  
			 <div class="form-group">
                  <label>Nama Lengkap<span style='color:red;'>*</span></label>
                  <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Enter ...">
                </div>
			 
			<div class="form-group">
                  <label>Email<span style='color:red;'>*</span></label>
                  <input type="text" name="email" id="email" class="form-control" placeholder="Input ...">
                </div> 
			<div class="form-group">
                  <label>Telepon</label>
                  <input type="text" name="no_telp" id="no_telp" class="form-control" placeholder="Input ...">
                </div> 	</br>
			             <!-- /.form-group -->
            </div>
			
			
            <!-- /.RIGHT SIDE -->
            <div class="col-md-6">
			
			<div class="form-group">
                  <label for="exampleInputFile">Upload Foto</label>
                  <input type="file" id="fupload" name="fupload">
                  <p class="help-block">Upload foto anda.</p>
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
			  
			
			
    
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
		  
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
              <div class="box-footer">
                <a  class="btn btn-default" href="users.html">Cancel</a>
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

   $edit = mysql_query("SELECT * FROM users WHERE username='$_GET[username]'");
    $r    = mysql_fetch_array($edit);
  echo"
  <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit Data Users</h3>

          <div class='box-tools pull-right'>
            <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
           
          </div>
        </div>";
		if($_SESSION[leveluser]=='1'){			
			
		echo"<form id='form' method='POST'  enctype='multipart/form-data' action='aksi-editdata-users.html' >
        <!-- /.box-header -->
		
        <div class='box-body'>
		
          <div class='row'>
            <div class='col-md-6'>
			
			
			<div class='form-group' id='username'>
                  <label>Username<span style='color:red;'>*</span></label>
                  <input type='text' name='username'  value='$r[username]' class='form-control' placeholder='Input ...' readonly>
                </div>
				
			
			 <div class='form-group'>
                  <label>Nama Lengkap<span style='color:red;'>*</span></label>
                  <input type='text' name='nama_lengkap'  value='$r[nama_lengkap]' class='form-control' placeholder='Enter ...'>
                </div>
			
			<div class='form-group'>
                  <label>Email<span style='color:red;'>*</span></label>
                  <input type='text' name='email' id='email'  value='$r[email]' class='form-control' placeholder='Input ...' >
                </div>
			
			<div class='form-group'>
                  <label>Telepon</label>
                  <input type='text' name='no_telp' value='$r[no_telp]' class='form-control' placeholder='Input ...'>
                </div>  
			<div class='form-group'>
                  ";
				  if($r[foto]==''){
					 echo"<img src='images/user_blank.jpg' width='80px'>";  
				  }else{
					 echo"<img src='images/user/$r[foto]' width='80px'>";   
				  }
				  echo"
                </div> 
			 <div class='form-group'>
                  <label for='exampleInputFile'>Ganti Foto</label>
                  <input type='file' name='fupload' id='fupload'>
                  <p class='help-block'>Upload foto anda.</p>
                </div> 	
			
           
             
              <!-- /.form-group -->
            </div>
			
			
            <!-- /.col -->
            <div class='col-md-6'>
		
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
              </div>";
			  
			// <div class='form-group'>";
			// $d = GetCombobox('tbl_sbu','nama_sbu','region',$r[region]);
   //              echo"<label>Regional (Label)</label>
   //              $d
   //            </div>
			
		echo"	 <!-- radio -->
                <div class='form-group'>
				<label>Status Users</label>";
				 if ($r[blokir]=='N'){
				echo "
                  <div class='radio'>
                    <label>
                      <input type='radio' name='blokir'  value='N' checked>
                      Aktif
                    </label>
                  </div>
                  <div class='radio'>
                    <label>
                      <input type='radio' name='blokir'  value='Y'>
                      Non Aktif
                    </label>
                  </div>";
                 }else{
					echo "
                  <div class='radio'>
                    <label>
                      <input type='radio' name='blokir'  value='N' >
                      Aktif
                    </label>
                  </div>
                  <div class='radio'>
                    <label>
                      <input type='radio' name='blokir'  value='Y' checked>
                      Non Aktif
                    </label>
                  </div>"; 
				 } 
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
                <a  class='btn btn-default' href='users.html'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>Update</button>
              </div>
		</form>";
		}else{
		echo"<form id='form' method='POST'  enctype='multipart/form-data' action='aksi-editdata-users.html' >
        <!-- /.box-header -->
		 <input type=hidden name=username value=$r[username]>
		 <input type=hidden name=nama_lengkap value=$r[nama_lengkap]>
		 <input type=hidden name=email value=$r[email]>
        <div class='box-body'>
		
          <div class='row'>
            <div class='col-md-6'>
			
			
			<div class='form-group' >
                  <label>Username</label>
                  <input type='text' name='username'  value='$r[username]' class='form-control' placeholder='Input ...' readonly>
                </div>
				
							
			 <div class='form-group'>
                  <label>Nama Lengkap</label>
                  <input type='text' name='nama_lengkap'  value='$r[nama_lengkap]' class='form-control' placeholder='Input ...' readonly>
                </div>
			
			<div class='form-group'>
                  <label>Email</label>
                  <input type='text' name='email' id='email'  value='$r[email]' class='form-control' placeholder='Input ...' readonly>
                </div>
			
			<div class='form-group'>
                  <label>Telepon</label>
                  <input type='text' name='no_telp' value='$r[no_telp]' class='form-control' placeholder='Input ...'>
                </div>  
			<div class='form-group'>
                  ";
				  if($r[foto]==''){
					 echo"<img src='images/user_blank.jpg' width='80px'>";  
				  }else{
					 echo"<img src='images/user/$r[foto]' width='80px'>";  
				  }
				  echo"
                </div> 
			 <div class='form-group'>
                  <label for='exampleInputFile'>Ganti Foto</label>
                  <input type='file' name='fupload' id='fupload'>
                  <p class='help-block'>Upload foto anda.</p>
                </div> 	
			 
			  <input type=hidden name=level value=$r[level]>
			   <input type=hidden name=region value=$r[region]>
			    <input type=hidden name=blokir value=$r[blokir]>
				 
           
             
              <!-- /.form-group -->
            </div>
			
			
            <!-- /.col -->
            <div class='col-md-6'>
		
			
				
				<!-- /.form-group -->
            </div>
			
            <!-- /.col -->
          </div>
		  
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
              <div class='box-footer'>
                <a  class='btn btn-default' href='users.html'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>Update</button>
              </div>
		</form>";	
		}
    echo"  </div>";
   
    break;  
	//edit password
  case "editpass":
  
   $edit = mysql_query("SELECT * FROM users WHERE username='$_GET[username]'");
    $r    = mysql_fetch_array($edit);
  echo"
  <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit Password Users</h3>

          <div class='box-tools pull-right'>
            <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
           
          </div>
        </div>
		<form id='form' method='POST'  enctype='multipart/form-data' action='aksi-editpass-users.html' >
        <!-- /.box-header -->
		 <input type=hidden name=username value=$r[username]>
        <div class='box-body'>
		
          <div class='row'>
            <div class='col-md-6'>
			<div class='form-group'>
                  <label>Password</label>
                  <input type='password' name='password' id='password'  value='$r[password]' class='form-control' placeholder='Input ...' >
                </div>
			
           
             
              <!-- /.form-group -->
            </div>
			
			
            <!-- /.col -->
            <div class='col-md-6'>
			
			 	
			<!-- /.form-group -->
            </div>
			
            <!-- /.col -->
          </div>
		  
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
              <div class='box-footer'>
                <a  class='btn btn-default' href='users.html'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>update</button>
              </div>
		</form>
      </div>";
   
    break;  
   }
   }
  ?>

