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
        if (form.ftNoRekening.value == "") {
            swal({
                    title: "Oops...",
                    text: "No Rekening harus di isi!",
                    type: "error",
                    closeOnConfirm: false
                },
                function() {
                    swal.close();
                    $('#ftNoRekening').focus();
                });
            return (false);
        } else if (form.ftNamaNasabah.value == "") {
            swal({
                    title: "Oops...",
                    text: "Nama Nasabah harus di isi!",
                    type: "error",
                    closeOnConfirm: false
                },
                function() {
                    swal.close();
                    $('#ftNamaNasabah').focus();
                });
            return (false);
        } else if (form.ftStatusRumah.value == "") {
            swal({
                    title: "Oops...",
                    text: "Status Rumah harus di isi!",
                    type: "error",
                    closeOnConfirm: false
                },
                function() {
                    swal.close();
                    $('#ftStatusRumah').focus();
                });
            return (false);
        } else if (form.fnStatusnasabah.value == "") {
            swal({
                    title: "Oops...",
                    text: "Status Nasabah harus di isi!",
                    type: "error",
                    closeOnConfirm: false
                },
                function() {
                    swal.close();
                    $('#fnStatusnasabah').focus();
                });
            return (false);
        } else if (form.ftJenis.value == "") {
            swal({
                    title: "Oops...",
                    text: "Jenis harus di isi!",
                    type: "error",
                    closeOnConfirm: false
                },
                function() {
                    swal.close();
                    $('#ftJenis').focus();
                });
            return (false);
        } else if (form.ftKantorBayar.value == "") {
            swal({
                    title: "Oops...",
                    text: "Kantor Bayar harus di isi!",
                    type: "error",
                    closeOnConfirm: false
                },
                function() {
                    swal.close();
                    $('#ftKantorBayar').focus();
                });
            return (false);
        } else if (form.ftCabang.value == "") {
            swal({
                    title: "Oops...",
                    text: "Cabang harus di isi!",
                    type: "error",
                    closeOnConfirm: false
                },
                function() {
                    swal.close();
                    $('#ftCabang').focus();
                });
            return (false);
        }else if (form.ftSubCabang.value == "") {
            swal({
                    title: "Oops...",
                    text: "Wilayah harus di isi!",
                    type: "error",
                    closeOnConfirm: false
                },
                function() {
                    swal.close();
                    $('#ftSubCabang').focus();
                });
            return (false);
        }else if (form.ftNamaKelompok.value == "") {
            swal({
                    title: "Oops...",
                    text: "Kelompok harus di isi!",
                    type: "error",
                    closeOnConfirm: false
                },
                function() {
                    swal.close();
                    $('#ftNamaKelompok').focus();
                });
            return (false);
        }

    }

    function wilayah(){
     var wilayah = $("#ftSubCabang").val();
   //  console.log(wilayah);
        $.ajax({
        url: "modul/nasabah/showkelompok.php",
        data: "wilayah="+wilayah,
        cache: false,
        success: function(msg){
        //jika data sukses diambil dari server kita tampilkan
        //di <select id=kota>
        $("#ftNamaKelompok").html(msg);
        }
        });

 }
</script>
<style type="text/css">
    *:focus {
        border: 2px dashed yellow;
        background-color: #ffffff;
    }
</style>



<?php

//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
//if($cek==1 OR $_SESSION[leveluser]=='1' || $_SESSION[leveluser]=='2'  || $_SESSION[leveluser]=='3' || $_SESSION[leveluser]=='4' ){
if(!empty($_SESSION['leveluser'])){      
if($_GET[module]=='nasabah_pensiun'){
    $nasabah='PENSIUN';
    $tambah='tambah-nasabah-pensiun.html';
    $print='print-nasabah-pensiun.html';
    $export='excel/export_nasabah.php?act=PENSIUN';
    $edit='edit-nasabah-pensiun';
    $delete='aksi-delete-nasabah-pensiun';
}else if($_GET[module]=='nasabah_umum'){
    $nasabah='UMUM';
    $tambah='tambah-nasabah-umum.html';
    $print='print-nasabah-umum.html';
    $export='excel/export_nasabah.php?act=UMUM';
    $edit='edit-nasabah-umum';
    $delete='aksi-delete-nasabah-umum';
}else if($_GET[module]=='nasabah_mikro'){
    $nasabah='MIKRO';
    $tambah='tambah-nasabah-mikro.html';
    $print='print-nasabah-mikro.html';
    $export='excel/export_nasabah.php?act=MIKRO';
    $edit='edit-nasabah-mikro';
    $delete='aksi-delete-nasabah-mikro';
}       
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
        FORM NASABAH <?php echo $nasabah; ?>

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
			// if ($_SESSION[leveluser]=='1' || $_SESSION[leveluser]=='2' || $_SESSION[leveluser]=='3' || $_SESSION[leveluser]=='4'){
			 ?>
                        <li>
                            <h3 class="box-title"><input type="button" onclick="location.href='<?php echo $tambah ; ?>';" value="Tambah" class="btn bg-purple btn-flat margin" /></h3>
                        </li>

                        <?php
			 // }else{
				// echo""; 
			 // }
			?>
                        <li>
                            <h3 class="box-title"><input type="button" id="printable" value="Print" class="btn btnprint bg-purple btn-flat margin"  /></h3>
                        </li>
                        <li>
                            <h3 class="box-title"><input type="button" onclick="location.href='<?php echo $export;?>';" value="Export" class="btn bg-purple btn-flat margin" /></h3>
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
                                    <th>No Rekening</th>
                                    <th>Nama Nasabah</th>
                                    <th>No HP</th>
                                    <th>Tipe Nasabah</th>
                                    <th>Status Nasabah</th>
                                    <th>Pekerjaan</th>
                                    <th>Tempat TTL</th>
                                    <th>Status Rumah</th>
                                    <th>Tim Survey</th>
                                    <?php 
                                    if($nasabah!='MIKRO'){
                                        echo"<th>Kantor Bayar</th>";
                                    }else{
                                    ?>
                                    <th>Nama Kelompok</th>
                                    <th>Wilayah</th>
                                    <?php }?>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
				$p      = new Paging;
				$batas  = 40;
				$posisi = $p->cariPosisi($batas);
				/*if($_SESSION[leveluser]=='1'){
				$tampil=mysql_query("SELECT 
											fnId,
											ftNoRekening,	
											ftNamaNasabah,
											ftNohp,
											fnTipeNasabah,	
											CASE 
												WHEN fnStatus = 1 THEN 'AKTIF' ELSE 'TIDAK AKTIF' 
											END AS ftStatus,	
											ftPekerjaan,	
											ftTempatTglLahir,	
											ftStatusRumah,	
											ftTimSurvey,	
											ftNamaKelompok,	
											ftSubCabang
											FROM tlnasabah WHERE fnTipeNasabah='$nasabah'");
				}else{*/
				$tampil=mysql_query("SELECT 
											fnId,
											ftNoRekening,	
											ftNamaNasabah,
											ftNohp,
											fnTipeNasabah,	
											CASE 
												WHEN fnStatus = 1 THEN 'AKTIF' ELSE 'TIDAK AKTIF' 
											END AS ftStatus,	
											ftPekerjaan,	
											ftTempatTglLahir,	
											ftStatusRumah,	
											ftTimSurvey,	
											ftNamaKelompok,
                                            ftkantorbayar,	
											ftSubCabang
											FROM tlnasabah WHERE fnTipeNasabah='$nasabah'");
			//	}
				$no = $posisi+1;
				$no1 = 0;	
				while($r=mysql_fetch_array($tampil)){
				$tipe=$r['fnTipeNasabah'];
				$jenis=$r['ftJenis'];
				$kantor=$r['ftkantorbayar'];
				 $no1++;	
				$tipe2=mysql_fetch_array(mysql_query("SELECT ftTipe FROM tltipenasabah WHERE ftTipe='$tipe'"));
				$jenis2=mysql_fetch_array(mysql_query("SELECT ftNamaJenis FROM tljenispensiun WHERE ftKodeJenis='$jenis'"));
				$kantor2=mysql_fetch_array(mysql_query("SELECT ftNamaKantorBayar FROM tlkantorbayar WHERE ftKodeKantorBayar='$kantor'"));
				echo"
                <tr>
				  <td><span class='label bg-black disabled color-palette'>$no1</span></td>
                  <td>$r[ftNoRekening]</td>
                  <td>$r[ftNamaNasabah]</td> 
				  <td>$r[ftNohp]</td>
				  <td>$tipe2[ftTipe]</td>
				  <td>$r[ftStatus]</td>
				  <td>$r[ftPekerjaan]</td>
				  
                  <td>$r[ftTempatTglLahir]</td> 
				  <td>$r[ftStatusRumah]</td>
				  <td>$r[ftTimSurvey]</td>";
                  if($nasabah!='MIKRO'){
                        echo"<td>$kantor</td>";
                    }else{
				  echo"<td>$r[ftNamaKelompok]</td>
				  <td>$r[ftSubCabang]</td>";
				}				 				  
                 echo" <td width='70px'><span class='label bg-gray disabled color-palette' onmouseover=\"this.style.cursor='pointer'\"><i class='fa fa-edit' title='edit $r[ftNamaNasabah]' onclick=\"location.href='$edit-$r[fnId].html';\"></i> &nbsp;&nbsp;&nbsp;  
				  ";
				//  if($_SESSION[leveluser]=='1'){
				  echo"<a class='fa fa-trash-o' title='delete $r[ftNamaNasabah]'  href=javascript:confirmdelete('$delete-$r[fnId].html') ></a>";
				  // }else{
					 //  echo"";
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
        <h3 class="box-title">INPUT NASABAH <?php echo $_GET[tipe]; ?></h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

        </div>
    </div>
    <form id="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambah-nasabah-<?php echo $_GET[tipe2]; ?>.html" onSubmit="return validasi(this)">
        <!-- /.box-header -->
        <div class="box-body" id="myForm">

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label>No Rekening<span style='color:red;'>*</span></label>
                        <input type="text" name="ftNoRekening" class="form-control" placeholder="Input ..." id="ftNoRekening">

                    </div>

                    <div class="form-group">
                        <label>Nama Nasabah<span style='color:red;'>*</span></label>
                        <input type="text" name="ftNamaNasabah" id="ftNamaNasabah" class="form-control" placeholder="Input ...">
                    </div>

                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" name="ftPekerjaan" id="ftPekerjaan" class="form-control" placeholder="Input ...">
                    </div>

                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="ftTempatTglLahir" id="ftTempatTglLahir" class="form-control" placeholder="Input ...">
                    </div>
                    <div class="form-group " id="tgl_pinjam" >
                        <label>Tanggal Lahir</label>
                        <div class="input-group date ">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar "></i>
                          </div>
                          <input type="text" class="form-control pull-right "  name="ftTgl_Lahir" id="ftTgl_Lahir">
                        </div>
                        <!-- /.input group -->
                    </div>    

                    <div class="form-group">
                        <label>Status Rumah <span style='color:red;'>*</span></label>
                        <select class="form-control select2" style="width: 100%;" name="ftStatusRumah" id="ftStatusRumah" >
                            <option value="">-- Pilih --</option>
                            <option value="MILIK SENDIRI">MILIK SENDIRI</option>
                            <option value="SEWA">SEWA</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="ftAlamat" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    <?php if($_GET[tipe2]!='umum'){ 
                     echo"";
                    }else{ ?>
                    <div class="form-group">
                        <label>Alamat Saudara Terdekat</label>
                        <textarea class="form-control" name="ftAlamat2" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label>Kota</label>
                        <input type="text" name="ftKota" id="ftKota" class="form-control" placeholder="Input ...">
                    </div>

                    <div class="form-group">
                        <label>Propinsi</label>
                        <input type="text" name="ftPropinsi" class="form-control" placeholder="Input ..." id="ftPropinsi">

                    </div>

                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" name="ftJabatan" class="form-control" placeholder="Input ..." id="ftJabatan">

                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="ftNohp" class="form-control" placeholder="Input ..." id="ftNohp">

                    </div>



                    <!-- /.form-group -->
                </div>
                <!-- /.RIGHT SIDE -->
                <div class="col-md-6">


                    <div class="form-group">
                        <label>Status Nasabah<span style='color:red;'>*</span></label>
                        <select class="form-control select2" style="width: 100%;" name="fnStatusnasabah" id="fnStatusnasabah" >
                            <option value="">-- Pilih --</option>
                            <option value="TETAP">TETAP</option>
                            <option value="KONTRAK">KONTRAK</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tipe Nasabah</label>
                        <select class="form-control " style="width: 100%;" name="fnTipeNasabah" id="fnTipeNasabah" readonly>
                            <?php		
				echo "<option value='$_GET[tipe]' selected>$_GET[tipe]</option>"; 
				   ?>
                        </select>
                    </div>
                    <?php if($_GET[tipe2]!='pensiun'){ 
                     echo"";
                    }else{ ?>

                        <div class="form-group">
                        <label>Jenis<span style='color:red;'>*</span></label>
                        <select class="form-control select2" style="width: 100%;" name="ftJenis" id="ftJenis" >
                            <?php       
                 $tampil=mysql_query("SELECT * FROM tljenispensiun WHERE fnStatus=1  ORDER BY ftNamaJenis");
                 echo "<option value='' selected>-- Pilih --</option>";
                   while($r=mysql_fetch_array($tampil)){
                   echo "<option value='$r[ftKodeJenis]'>$r[ftNamaJenis]</option>"; }
                   ?>
                        </select>
                        </div>
                    
                   <?php } ?>
                    
                   <?php if($_GET[tipe2]!='mikro'){ 
                       ?>
                    <div class="form-group">
                        <label>Dapem</label>
                        <input type="text" name="ftDapem" id="ftDapem" class="form-control" placeholder="Input ...">
                    </div>

                    <div class="form-group">
                        <label>Kantor Bayar<span style='color:red;'>*</span></label>
                        <select class="form-control select2" style="width: 100%;" name="ftKantorBayar" id="ftKantorBayar">
                            <?php		
				 $tampil=mysql_query("SELECT * FROM tlkantorbayar WHERE fnStatus=1  ORDER BY ftNamaKantorBayar");
				 echo "<option value='' selected>-- Pilih --</option>";
				   while($r=mysql_fetch_array($tampil)){
                    $ftKantorBayar=$r['ftNamaKantorBayar'];
				   echo "<option value='$ftKantorBayar'>$ftKantorBayar</option>"; }
				   ?>
                        </select>

                    </div>
                <?php }else{ echo"";  } ?>
                    <div class="form-group">
                        <label>Gaji</label>
                        <input type="text" name="fcGaji" id="fcGaji" class="form-control" placeholder="Input ...">
                    </div>
                    <div class="form-group " id="tgl_pinjam" >
                        <label>Tanggal Gaji</label>
                        <div class="input-group date ">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar "></i>
                          </div>
                          <input type="text" class="form-control pull-right "  name="ftTgl_Gaji" id="ftTgl_Gaji">
                        </div>
                        <!-- /.input group -->
                    </div> 
                    <div class="form-group">
                        <label>Tim Survey</label>
                        <input type="text" name="ftTimSurvey" id="ftTimSurvey" class="form-control" placeholder="Input ...">
                    </div>
                    
                    <?php if($_GET[tipe2]!='mikro'){ 
                        echo"";
                        }else{ ?>
                    <div class="form-group">
                        <label>Regu</label>
                        <input type="text" name="ftRegu" id="ftRegu" class="form-control" placeholder="Input ...">
                    </div>                       
                    <div class="form-group">
                        <label>Wilayah <span style="color:red;">*</span></label>
                        <select class="form-control select2" style="width: 100%;" name="ftSubCabang" id="ftSubCabang" onchange="wilayah()">
                            <?php       
                             $tampil=mysql_query("SELECT ftNamaWilayah,ftKodeWilayah FROM tlwilayah WHERE fnStatus =1 ORDER BY ftNamaWilayah DESC");
                             echo "<option value='' selected>-- Pilih --</option>";
                               while($r=mysql_fetch_array($tampil)){
                               echo "<option value='$r[ftKodeWilayah]'>$r[ftNamaWilayah]</option>"; }
                               ?>
                        </select>
                    </div>    
                    <div class="form-group">
                        <label>Nama Kelompok <span style="color:red;">*</span></label>
                        <select class="form-control select2" style="width: 100%;" name="ftNamaKelompok" id="ftNamaKelompok">
                        <option value="" selected>-- Pilih --</option>
                            <!-- <?php       
                            // $tampil=mysql_query("SELECT ftNamaKelompok FROM tlkelompok WHERE fnStatus =1 ORDER BY ftNamaKelompok DESC");
                            // echo "<option value='' selected>-- Pilih --</option>";
                             //  while($r=mysql_fetch_array($tampil)){
                             //  echo "<option value='$r[ftNamaKelompok]'>$r[ftNamaKelompok]</option>"; }
                               ?> -->
                        </select>
                    </div> 
                    <?php    } ?>
                    <div class="form-group">
                        <label>Jaminan</label>
                        <input type="text" name="ftJaminan" id="ftJaminan" class="form-control" placeholder="Input ...">
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
                 
                </div> 
                    

                    <!-- /.END RIGHT SIDE -->
                </div>
                <!-- /.col -->
            </div>

            <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
        <div class="box-footer">
            <a class="btn btn-default" href="nasabah-<?php echo $_GET[tipe2]; ?>.html">Cancel</a>
            <button type="submit" class="btn btn-info pull-right">Save</button>
        </div>
    </form>
</div>
<?php  		  
     break;
 
 //HARUS DIRUBAH (setting email)
  case "edit":


   $edit = mysql_query("SELECT * FROM tlnasabah WHERE fnId='$_GET[fnId]'");
    $r    = mysql_fetch_array($edit);
  echo"
  <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>EDIT NASABAH $_GET[tipe]</h3>

          <div class='box-tools pull-right'>
            <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
           
          </div>
        </div>";
			
			
		echo"<form id='form' method='POST'  enctype='multipart/form-data' action='aksi-edit-nasabah-$_GET[tipe2].html' onSubmit='return validasi(this)'>
        <!-- /.box-header -->
		
        <div class='box-body'>
		 <input type=hidden name=id value=$r[fnId]>
          <div class='row'>
            <div class='col-md-6'>
			
			
			<div class='form-group' >
                  <label>No Rekening<span style='color:red;'>*</span></label>
                  <input type='text' name='ftNoRekening' id='ftNoRekening' value='$r[ftNoRekening]' class='form-control' placeholder='Input ...' >
                </div>
				
			
			 <div class='form-group'>
                  <label>Nama Nasabah<span style='color:red;'>*</span></label>
                  <input type='text' name='ftNamaNasabah' id='ftNamaNasabah' value='$r[ftNamaNasabah]' class='form-control' placeholder='Enter ...'>
                </div>
			
			<div class='form-group'>
                  <label>Pekerjaan</label>
                  <input type='text' name='ftPekerjaan' id='ftPekerjaan' value='$r[ftPekerjaan]' class='form-control' placeholder='Enter ...'>
                </div>
				
			<div class='form-group'>
                  <label>Tempat Lahir</label>
                  <input type='text' name='ftTempatTglLahir' id='ftTempatTglLahir ' value='$r[ftTempatTglLahir]' class='form-control' placeholder='Enter ...'>
                </div>

            <div class='form-group ' id='tgl_pinjam' >
                <label>Tanggal Lahir</label>
                <div class='input-group date '>
                  <div class='input-group-addon'>
                    <i class='fa fa-calendar '></i>
                  </div>
                  <input type='text' class='form-control pull-right ' value='$r[ftTgl_Lahir]' name='ftTgl_Lahir' id='ftTgl_Lahir'>
                </div>
                <!-- /.input group -->
            </div>    
				
			<div class='form-group'>
                  <label>Status Rumah<span style='color:red;'>*</span></label>
                  <select class='form-control select2'  style='width: 100%;' name='ftStatusRumah' id='ftStatusRumah'>";
				 
				 if ($r['ftStatusRumah']==''){
				 echo"<option selected='selected' value=''>-- Pilih --</option>
					  <option  value='MILIK SENDIRI'>MILIK SENDIRI</option>
					  <option  value='SEWA'>SEWA</option>";}
				 
				 else if ($r['ftStatusRumah']=='MILIK SENDIRI'){
					echo"<option value='$r[ftStatusRumah]' selected>MILIK SENDIRI</option>
						 <option value='SEWA' >SEWA</option>";}
				 else if ($r['ftStatusRumah']=='SEWA'){
					echo"<option value='$r[ftStatusRumah]' selected>SEWA</option>
						 <option value='MILIK SENDIRI' >MILIK SENDIRI</option>";}	 
					
				  echo"</select>
                </div>
			
			<div class='form-group' >
                  <label>Alamat</label>
				  <textarea class='form-control' name='ftAlamat'  rows='3' placeholder='Enter ...'>$r[ftAlamat]</textarea>
                </div>";
                if($_GET[tipe2]!='umum'){
                    echo"";
                }else{  
             echo"<div class='form-group' >
                  <label>Alamat Saudara Terdekat</label>
                  <textarea class='form-control' name='ftAlamat2'  rows='3' placeholder='Enter ...'>$r[ftAlamat2]</textarea>
                </div> ";  	
			}
			 echo"<div class='form-group'>
                  <label>Kota</label>
                  <input type='text' name='ftKota' id='ftKota' value='$r[ftKota]' class='form-control' placeholder='Enter ...'>
                </div>
			
			<div class='form-group' >
                  <label>Propinsi</label>
                  <input type='text' name='ftPropinsi' id='ftPropinsi' value='$r[ftPropinsi]' class='form-control' placeholder='Input ...' >
                </div>
				
			<div class='form-group' >
                  <label>Jabatan</label>
                  <input type='text' name='ftJabatan' id='ftJabatan' value='$r[ftJabatan]' class='form-control' placeholder='Input ...' >
                </div>
			 
			<div class='form-group' >
                  <label>No HP</label>
                  <input type='text' name='ftNohp' id='ftNohp' value='$r[ftNohp]' class='form-control' placeholder='Input ...' >
                </div>
			 
			
			
           
             
              <!-- /.form-group -->
            </div>
			
			
            <!-- /.col -->
			 <!-- /.RIGHT SIDE -->
            <div class='col-md-6'>
			
			<div class='form-group'>
                  <label>Status Nasabah<span style='color:red;'>*</span></label>
                  <select class='form-control select2'  style='width: 100%;' name='fnStatusnasabah' id='fnStatusnasabah'>";
				 
				 if ($r[fnStatusnasabah]==''){
				 echo"<option selected='selected' value=''>-- Pilih --</option>
					  <option  value='TETAP'>TETAP</option>
					  <option  value='KONTRAK'>KONTRAK</option>";}
				 
				 else if ($r[fnStatusnasabah]=='TETAP'){
					echo"<option value='$r[fnStatusnasabah]' selected>TETAP</option>
						 <option value='KONTRAK' >KONTRAK</option>";}
				 else if ($r[fnStatusnasabah]=='KONTRAK'){
					echo"<option value='$r[fnStatusnasabah]' selected>KONTRAK</option>
						 <option value='TETAP' >TETAP</option>";}	 
					
				  echo"</select>
                </div>
				
			<div class='form-group'>
                  <label>Tipe Nasabah</label>
                  
				   <select class='form-control'  style='width: 100%;' name='fnTipeNasabah' id='fnTipeNasabah' readonly>";
				 
					echo"<option value='$_GET[tipe]' selected>$_GET[tipe]</option>";
					
				  echo"</select>
                </div>";
		 if($_GET[tipe2]!='pensiun'){
                    echo"";
                }else{		
		echo"<div class='form-group' >
                  <label>Jenis<span style='color:red;'>*</span></label>
                 
				    <select class='form-control select2'  style='width: 100%;' name='ftJenis' id='ftJenis'>";
				 $tampil=mysql_query("SELECT * FROM tljenispensiun WHERE fnStatus=1  ORDER BY ftNamaJenis");
				 if ($r[ftJenis]==''){
				 echo"<option selected='selected' value=''>-- Pilih --</option>";}
				  while($w=mysql_fetch_array($tampil)){
					if ($r[ftJenis]==$w[ftKodeJenis]){
					echo"<option value='$w[ftKodeJenis]' selected>$w[ftNamaJenis]</option>";}
					 else{
				  echo"<option value='$w[ftKodeJenis]'>$w[ftNamaJenis]</option>";}}
				  echo"</select>
                </div>";
				}
			 if($_GET[tipe2]!='mikro'){ 
                       
			echo" <div class='form-group'>
                  <label>Dapem</label>
                  <input type='text' name='ftDapem' id='ftDapem' value='$r[ftDapem]' class='form-control' placeholder='Enter ...'>
                </div>
			
			<div class='form-group' >
                  <label>Kantor Bayar<span style='color:red;'>*</span></label>
                  
				   <select class='form-control select2'  style='width: 100%;' name='ftKantorBayar' id='ftKantorBayar'>";
				 $tampil=mysql_query("SELECT * FROM tlkantorbayar WHERE fnStatus=1  ORDER BY ftNamaKantorBayar");
				 if ($r[ftKantorBayar]==''){
				 echo"<option selected='selected' value=''>-- Pilih --</option>";}
				  while($w=mysql_fetch_array($tampil)){
                    $ftKantorBayar=$w['ftNamaKantorBayar'];
					if ($r[ftKantorBayar]==$w[ftKodeKantorBayar]){
					echo"<option value='$ftKantorBayar' selected>$ftKantorBayar</option>";}
					 else{
				  echo"<option value='$ftKantorBayar'>$ftKantorBayar</option>";}}
				  echo"</select>
                </div>";
				}else{
                    echo"";
                }
			
			 echo"<div class='form-group'>
                  <label>Gaji</label>
                  <input type='text' name='fcGaji' id='fcGaji' value='$r[fcGaji]' class='form-control' placeholder='Enter ...'>
                </div>
			<div class='form-group ' id='tgl_pinjam' >
                <label>Tanggal Gaji</label>
                <div class='input-group date '>
                  <div class='input-group-addon'>
                    <i class='fa fa-calendar '></i>
                  </div>
                  <input type='text' class='form-control pull-right ' value='$r[ftTgl_Gaji]' name='ftTgl_Gaji' id='ftTgl_Gaji'>
                </div>
                <!-- /.input group -->
            </div>
			<div class='form-group'>
                  <label>Tim Survey</label>
                  <input type='text' name='ftTimSurvey' id='ftTimSurvey' value='$r[ftTimSurvey]' class='form-control' placeholder='Enter ...'>
                </div>";
                if($_GET[tipe2]!='mikro'){
                    echo"";
                }else{
			echo"
                <div class='form-group'>
                  <label>Regu</label>
                  <input type='text' name='ftRegu' id='ftRegu' value='$r[ftRegu]' class='form-control' placeholder='Enter ...'>
                </div>
                <div class='form-group'>
                  <label>Wilayah</label>
                  
                  <select class='form-control select2'  style='width: 100%;' name='ftSubCabang' id='ftSubCabang'>";


                 $tampil3=mysql_query("SELECT ftNamaWilayah FROM tlwilayah WHERE fnStatus=1  ORDER BY ftNamaWilayah ");
               
                 if ($r[ftSubCabang] ==''){
                 echo"<option value='' selected >-- Pilih --</option>";
                      }
                  while($f=mysql_fetch_array($tampil3)){
                    if ($r[ftSubCabang]==$f[ftNamaWilayah]){
                    echo"<option value='$f[ftNamaWilayah]' selected>$f[ftNamaWilayah]</option>";
                        }else{
                  echo"<option value='$f[ftNamaWilayah]'>$f[ftNamaWilayah]</option>";
                     }
                 }
         //    }
                 echo"</select>
                </div>
			<div class='form-group'>
                  <label>Nama Kelompok</label>
                 
                  <select class='form-control select2'  style='width: 100%;' name='ftNamaKelompok' id='ftNamaKelompok'>";
                 $tampil=mysql_query("SELECT ftNamaKelompok FROM tlkelompok WHERE fnStatus=1 ORDER BY ftNamaKelompok  ");
               //    var_dump($r[ftNamaKelompok]);exit;
                 if ($r[ftNamaKelompok]==''){
                 echo"<option value='' selected>-- Pilih --</option>";
                    }
                  while($w=mysql_fetch_array($tampil)){
                    if ($r[ftNamaKelompok]==$w[ftNamaKelompok]){
                    echo"<option value='$w[ftNamaKelompok]' selected>$w[ftNamaKelompok]</option>";}
                     else{
                  echo"<option value='$w[ftNamaKelompok]'>$w[ftNamaKelompok]</option>";}}
                  echo"</select>
                </div>";
			}
			echo"<div class='form-group'>
                  <label>Jaminan</label>
                  <input type='text' name='ftJaminan' id='ftJaminan' value='$r[ftJaminan]' class='form-control' placeholder='Enter ...'>
                </div>
			
			<div class='form-group'>
                  <label>Status</label>
                  <select class='form-control select2'  style='width: 100%;' name='fnStatus' id='fnStatus'>";
				 
				 if ($r[fnStatus]==''){
				 echo"<option selected='selected' value=''>-- Pilih --</option>
					  <option  value='1'>Aktif</option>
					  <option  value='0'>Tidak Aktif</option>";}
				 
				 else if ($r[fnStatus]=='1'){
					echo"<option value='$w[fnStatus]' selected>Aktif</option>
						 <option value='0' >Tidak Aktif</option>";}
				 else if ($r[fnStatus]=='0'){
					echo"<option value='$w[fnStatus]' selected>Tidak Aktif</option>
						 <option value='1' >Aktif</option>";}	 
					
				  echo"</select>
                </div>
			
			<div class='form-group'>
                  <label>Cabang<span style='color:red;'>*</span></label>";
                   $tampil=mysql_query("SELECT ftBranch_Code FROM tscompany_info WHERE aktif ='Y'");
          $r=mysql_fetch_array($tampil);
           echo "<input type='text' name='ftCabang' id='ftCabang' value='$r[ftBranch_Code]' class='form-control' placeholder='Input ...'' readonly> 
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
                <a  class='btn btn-default' href='nasabah-$_GET[tipe2].html'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>Update</button>
              </div>
		</form>";
		
    echo"  </div>";
   
    break;  
	//edit password
  
   }
   }
 
  ?>


<?php 
//  }

  ?>

<script>
$('.btnprint').click(function() {
     window.open ('<?php echo $print; ?>','_blank');
   });
</script>