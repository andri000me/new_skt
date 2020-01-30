<?php
//include("modul/transaksi/formsearch.php");

?>
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<script src="dist/sweetalert.min.js"></script>
<script type="text/javascript" src="js/pemisah_angka.js"></script>
<script src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery-maskmoney-master/src/jquery.maskMoney.js"></script>
<script>
function confirmdelete(delUrl) {
   if (confirm("Anda yakin ingin menghapus?")) {
      document.location = delUrl;
   }
}
</script>
<script type="text/javascript">
function validasi(form){
  if (form.ftCustomer_Code.value == ""){
	swal({title: "Oops...",text: "No Rekening harus di isi!",type:"error",closeOnConfirm: false},
	function(){swal.close();$('#ftCustomer_Code').focus();});
    return (false);
  }else if (form.ftNamaNasabah.value == ""){
	swal({title: "Oops...",text: "Nama Nasabah harus di isi!",type:"error",closeOnConfirm: false},
	function(){swal.close();$('#ftNamaNasabah').focus();});
    return (false);
  }else if (form.fcPlafond.value == ""){
	swal({title: "Oops...",text: "Plafond Pinjaman harus di isi!",type:"error",closeOnConfirm: false},
	function(){swal.close();$('#fcPlafond').focus();});
    return (false);
  }else if (form.fnJW.value == ""){
	swal({title: "Oops...",text: "Jangka Waktu harus di isi!",type:"error",closeOnConfirm: false},
	function(){swal.close();$('#fnJW').focus();});
    return (false);
  }
   
 }
</script>

<script type="text/javascript"> 
  $(document).ready(function() {
  // view so	  
    $(".search").focusin(function() {
    $("#viewsearch").modal('show'); // ini fungsi untuk menampilkan modal
    $('#formsearch').DataTable(); // fungsi ini untuk memanggil datatable 
  });

 });

</script>
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>


		
 <style type="text/css">
.modal-open{overflow:hidden}.modal{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1050;display:none;overflow:hidden;-webkit-overflow-scrolling:touch;outline:0}.modal.fade .modal-dialog{-webkit-transition:-webkit-transform .3s ease-out;-o-transition:-o-transform .3s ease-out;transition:transform .3s ease-out;-webkit-transform:translate(0,-25%);-ms-transform:translate(0,-25%);-o-transform:translate(0,-25%);transform:translate(0,-25%)}.modal.in .modal-dialog{-webkit-transform:translate(0,0);-ms-transform:translate(0,0);-o-transform:translate(0,0);transform:translate(0,0)}.modal-open .modal{overflow-x:hidden;overflow-y:auto}.modal-dialog{position:relative;width:auto;margin:10px}.modal-content{position:relative;background-color:#fff;-webkit-background-clip:padding-box;background-clip:padding-box;border:1px solid #999;border:1px solid rgba(0,0,0,.2);border-radius:6px;outline:0;-webkit-box-shadow:0 3px 9px rgba(0,0,0,.5);box-shadow:0 3px 9px rgba(0,0,0,.5)}.modal-backdrop{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1040;background-color:#000}.modal-backdrop.fade{filter:alpha(opacity=0);opacity:0}.modal-backdrop.in{filter:alpha(opacity=50);opacity:.5}.modal-header{padding:15px;border-bottom:1px solid #e5e5e5}.modal-header .close{margin-top:-2px}.modal-title{margin:0;line-height:1.42857143}.modal-body{position:relative;padding:15px}.modal-footer{padding:15px;text-align:right;border-top:1px solid #e5e5e5}.modal-footer .btn+.btn{margin-bottom:0;margin-left:5px}.modal-footer .btn-group .btn+.btn{margin-left:-1px}.modal-footer .btn-block+.btn-block{margin-left:0}.modal-scrollbar-measure{position:absolute;top:-9999px;width:50px;height:50px;overflow:scroll}@media (min-width:768px){.modal-dialog{width:1200px;margin:30px auto}.modal-content{-webkit-box-shadow:0 5px 15px rgba(0,0,0,.5);box-shadow:0 5px 15px rgba(0,0,0,.5)}.modal-sm{width:300px}}@media (min-width:992px){.modal-lg{width:900px}}

*:focus {
  border: 2px dashed yellow;
  background-color: yellow;
}
.badge {
  padding: 1px 9px 2px;
  font-size: 24.025px;
  font-weight: bold;
  white-space: nowrap;
  color: #ffffff;
  background-color: #999999;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  border-radius: 10px;
}
.badge:hover {
  color: #ffffff;
  text-decoration: none;
  cursor: pointer;
}
.badge-error {
  background-color: #b94a48;
}
.badge-error:hover {
  background-color: #953b39;
}
.badge-warning {
  background-color: #c67605;
    color:white;
}
.badge-warning:hover {
  background-color: #d3aa06;
}
.badge-success {
  background-color: green;
   color:white;
}
.badge-success:hover {
  background-color: #468847;
}
.badge-info {
  background-color: #3a87ad;
}
.badge-info:hover {
  background-color: #2d6987;
}
.badge-inverse {
  background-color: #9b0499;
  color:white;
}
.badge-inverse:hover {
  background-color: #c107bf;
}
.badge-pink {
  background-color: #ef239a;
  color:white;
}
.badge-pink:hover {
  background-color: #ed38a2;
}
.badge-red {
  background-color: #cc0428;
  color:white;
}
.badge-red:hover {
  background-color: #f93b4b;
}
.badge-brown {
  background-color: #96610d;
}
.badge-brown:hover {
  background-color: #1a1a1a;
 }
 .badge-abu {
  background-color: #636b62;
   color:white;
}
.badge-abu:hover {
  background-color: #727a71;
</style>


<?php
include "control.php";
//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
//if($cek==1 OR $_SESSION[leveluser]=='1' || $_SESSION[leveluser]=='2' ){
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
       FORM PINJAMAN UMUM
        
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
			// if ($_SESSION[leveluser]=='1' || $_SESSION[leveluser]=='2'){
			 ?>
              <h3 class="box-title"><input type="button" onclick="location.href='<?php echo "tambah-transaksiumum.html ";?>';" value="Tambah" class="btn bg-purple btn-flat margin"/></h3>
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
                  <th>No Transaksi</th>
				  <th>Tgl Pinjam</th>
				  <th>No Rekening</th>
				  <th>Nama</th>
				  <th>Plafond Pinjaman</th>
				   <th>Status</th>
				  
				 
				   <th></th>
				 
                </tr>
                </thead>
                <tbody>
				<?php 
				$p      = new Paging;
				$batas  = 40;
				$posisi = $p->cariPosisi($batas);
				if($_SESSION[leveluser]=='1'){
				$tampil=mysql_query("SELECT * FROM vdaftarpinjamanumum  ORDER BY fnid DESC ");
				}else{
				$tampil=mysql_query("SELECT * FROM vdaftarpinjamanumum  ORDER BY fnid DESC");
				}
				$no = $posisi+1;
				$no1 = 0;	
				while($r=mysql_fetch_array($tampil)){
					$fcPlafond = number_format ($r[fcPlafond], 0, ',', '.');	
				 $no1++;	
				
				echo"
                <tr>
				  <td><span class='label bg-black disabled color-palette'>$no1</span></td>
          <td>$r[ftTrans_No]</td>
          <td>$r[fdTrans_date]</td> 
				  <td>$r[ftCustomer_Code]</td> 
				  <td>$r[ftNamaNasabah]</td> 
				  <td>$fcPlafond</td>"; 
                  //Status
				if($r[fnStatus]==1){
                  echo"<td><span class='label label-success'>Posted</span></td>"; 
				  }else{
					echo"<td><span class='label label-danger'>Batal</span></td>";  
				  }
				  
								 				  
                  echo"<td width='70px' onmouseover=\"this.style.cursor='pointer'\"><span class='label bg-gray disabled color-palette'><i class='fa fa-search' title='View $r[ftTrans_No]' onclick=\"location.href='edit-transaksiumum-$r[fnid].html';\"></i> &nbsp;&nbsp;&nbsp;  
				  ";
				//  if($_SESSION[leveluser]=='1'){
				  echo"<a class='fa fa-trash-o' title='delete $r[ftTrans_No]'  href=javascript:confirmdelete('aksi-delete-transaksiumum-$r[fnid].html') ></a>";
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
  <form id="myForm" autocomplete="off" name="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambah-transaksiumum.html" onSubmit="return validasi(this)">
  <div class="card card-body ">
  <section class="content">
   <div class="box box-info ">
        <div class="box-header with-border">
          <h3 class="box-title">Input Transaksi Umum</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
		  
        </div>
		
        <!-- /.box-header -->
        <div class="box-body" >
		
          <div class="row">
            <div class="col-md-6">
			
			<div class="form-group has-warning " >
			<script>
				  function getBulanUmum(x) {
				  var getftTrans_No= document.getElementById("ftTrans_No").value;
				  var tahun = x.substring(2,4);
				  var bulan = x.substring(5,7);
				  var firstCode = getftTrans_No.substring(0,3);
				  var lastCode = getftTrans_No.substring(7,11);
				  var newCode = firstCode + tahun + bulan + lastCode;
				  document.getElementById("ftTrans_No").value=newCode;
				 }
		   </script>
               <label>No Transaksi</label>
				  <?php
				//	$tgl_sekarang = date("Y-m-d H:i:s");
					$tgl = date("d");
					$bln = date("m");
					$thn = date("Y");
					$thn2 = substr($thn, -2);
					$no = "0001";
					// cari id transaksi terakhir yang berawalan tanggal hari ini
					$query = "SELECT max(fnid) AS last FROM txpinjaman_umum_hdr  ";
					$hasil = mysql_query($query);
					$data  = mysql_fetch_array($hasil);
					$lastNoTransaksi = $data['last'];
					$number = range(1,9999);
					$newID = sprintf("%04s", $lastNoTransaksi);
					
					$cariid=mysql_query("SELECT max(ftTrans_No) as notrans FROM txpinjaman_umum_hdr");
					$cari=mysql_fetch_array($cariid);
					$id=$cari['notrans'];
					$pot=substr($id,-4);
					$unik=(string)$pot+1;
					
					if(strlen($unik)==1){
						$unik2='000'.$unik;
					}else if (strlen($unik)==2){
						$unik2='00'.$unik;
					}else if (strlen($unik)==3){
						$unik2='0'.$unik;
					}else{
						$unik2=$unik;
					}
					
					?>
						 <input type="text" name="ftTrans_No" class="form-control " value=<?php echo "PJU$thn2$bln$unik2"; ?> placeholder="Input ..." id="ftTrans_No" readonly=true>
			</div>
			<div class="form-group has-warning" id="tgl_pinjam" >
                <label>Tgl Pinjam</label>
                <div class="input-group date ">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar "></i>
                  </div>
                  <input type="text" class="form-control pull-right " value=<?php echo "$thn-$bln-$tgl"; ?> name="fdTrans_date" id="fdTrans_date" onchange="getBulanUmum(this.value);">
                </div>
                <!-- /.input group -->
              </div> 	
			
			<div class="form-group has-warning" >
                  <label>Saldo Simpanan</label>
                  <input type="text" name="fcSaldosimpanan" class="form-control" placeholder="Input ..." id="fcSaldosimpanan" readonly=true>
			  </div>
			  <!-- /.form-group -->
            </div>
			 <!-- /.RIGHT SIDE -->
            <div class="col-md-6">
			
			<div class="form-group has-warning" >
                  <label>Keterangan</label>
				  <textarea class="form-control" rows="9" placeholder="Enter ..." name="ftNotes"></textarea>
             </div>
			
            <!-- /.END RIGHT SIDE -->
            </div>
            <!-- /.col -->
          </div>
		  
          <!-- /.row -->
        </div>
       
		 </div>
		 </section>
		 </div>
		 
		  <div class="box-body" >
		<div class="col-md-6">
		 <div class="box box-success">
           
      <div class="box-body ">
      <!-- <div class="form-group has-success" >
			  <label>No Rekening&nbsp;&nbsp;&nbsp;<span style="color:red;">*</span></label>
			 <div class="input-group">
              <input type="text" class="form-control" name="ftCustomer_Code" id="ftCustomer_Code"  placeholder="Input ..."  readonly=true>
                <span class="input-group-addon "><a href="#" class="small-box-footer " onClick="showSouvenir('rikues')"><b>SEARCH</b></a></span>
              </div></div> -->	
       <div class="form-group has-success">
            <label>No Rekening&nbsp;&nbsp;&nbsp;<span style="color:red;">*</span></label>
              <div class="input-group">
                 <input type="text" class="form-control" id="ftCustomer_Code" placeholder="Input ..." aria-describedby="basic-addon1" name="ftCustomer_Code" readonly>
             <span class="input-group-addon" id="basic-addon1" onmouseover="this.style.cursor='pointer'" 
              onClick="showSouvenir('rikues')"><span class='glyphicon glyphicon-new-window' aria-hidden='true'></span></span>
            </div>
          </div> 
                
			<div class="form-group has-success" >
                  <label>Nama&nbsp;&nbsp;&nbsp;<span style="color:red;">*</span></label>
                  <input type="text" name="ftNamaNasabah" id="ftNamaNasabah" class="form-control" value="" placeholder="Input ..." readonly=true>
			 </div>
			 <div class="form-group has-success" >
                  <label>Alamat</label>
				  <textarea class="form-control" rows="12" placeholder="" name="ftAlamat" id="ftAlamat" readonly=true></textarea>
				<!--  <input type="text" name="ftAlamat" id="ftAlamat" class="form-control" value="" placeholder="Input ..." > -->
				  
             </div>
			 <div class="form-group has-success" >
                </div>
			   </div>
			   <!-- /.box-body -->
         </div>
		 
		 <div class="box box-warning">
            <div class="box-body">
              
                <div class="form-group has-warning" >
                  <label>Plafond Pinjaman [Rp]&nbsp;&nbsp;&nbsp;<span style="color:red;">*</span></label>
                  <input type="text" name="fcPlafond" class="form-control" value="" placeholder="Input ..." id="fcPlafond"  onkeypress="return isNumberKey(event)" onkeyup="myFunction(this,event)" disabled=true>
			  </div> 
			  
			<div class="form-group has-warning" >
                  <label>Bunga [%]</label>
			<?php	  
			$p=mysql_fetch_array(mysql_query("SELECT ffBunga FROM tlbiayaadmumum WHERE aktif='Y'"));
                  echo"<input type='text' name='ffBunga' value='$p[ffBunga]' class='form-control' placeholder='Input ...' id='ffBunga' onkeyup=\"jwfunction(this,event)\" onkeypress=\"return isNumberKey(event)\" maxlength=\"4\" disabled=true>";
			?>	  
			  </div> 
		 
			  <div class="form-group has-warning" >
			 <div class="row">
                <div class="col-xs-6 ">
				<label class="control-label" for="inputSuccess">Jangka Waktu&nbsp;&nbsp;&nbsp;<span style="color:red;">*</span></label>
                  <input type="text" name="fnJW" id="fnJW" class="form-control" value="" placeholder="Input ..." onkeyup="jwfunction(this,event)" onkeypress="return isNumberKey(event)" maxlength="2" disabled=true>
                </div>
                <div class="col-xs-2 has-warning"></br></br>
				<label >Bulan</label>
                </div>
                </div>               
              </div>
              
            </div>
            <!-- /.box-body -->
         </div>
		 
		 <div class="box box-primary">
            <div class="box-body">
              
                <div class="form-group">
				<label>Pokok Angsuran</label>
                  <input type="text" name="fcPokokAngsuran" id="fcPokokAngsuran" class="form-control " value="0"  placeholder="0" readonly=true>
                </div>
              
			   <div class="form-group">
				<label>Bunga Angsuran</label>
                  <input type="text" name="fcBunganAngsuran" id="fcBunganAngsuran"  class="form-control" value="0" placeholder="0" readonly=true>
                </div>
				 <div class="form-group">
				<label>Admin Angsuran</label>
				<?php	  
				  $p=mysql_fetch_array(mysql_query("SELECT fcAdmAngsuran FROM tlbiayaadmumum WHERE aktif='Y'"));
				 $val= number_format( $p['fcAdmAngsuran'] , 0 , ',' , ',' );
                  echo"<input type='text' name='fcAdmAngsuran' value='$val' class='form-control' placeholder='Input ...' id='fcAdmAngsuran' onkeyup=\"jwfunction(this,event)\" onkeypress=\"return isNumberKey(event)\" maxlength=\"9\" disabled=true>";
				?>	
                </div>
				 <div class="form-group">
				<label>Pblt Angsuran</label>
                  <input type="text" class="form-control" name="fcPbltAngsuran" id="fcPbltAngsuran" value="0" placeholder="0" readonly=true>
                </div>
				 <div class="form-group">
				<label>Tabungan Angsuran</label>
                  <input type="text" class="form-control" name="fcTabAngsuran" id="fcTabAngsuran" value="" onkeyup="jwfunction(this,event)" onkeypress="return isNumberKey(event)" placeholder="0" maxlength="20" disabled=true>
                </div>
				 <div class="form-group">
				<label>Total Angsuran</label>
                  <input type="text"  name="fcTotalAngsuran" id="fcTotalAngsuran"  class="form-control" placeholder="0" readonly=true>
                </div>
              
            </div>
            <!-- /.box-body -->
         </div>
		  
		 
		  </div>
		  
		  <div class="col-md-6">
		  
		  
		  <div class="box box-success">
            <div class="box-body">
              
               <div class="form-group has-success" >
                  <label>No Pinjaman</label>
                  <input type="text" name="ftTrans_No_old" value="0" class="form-control"  id="ftTrans_No_old" readonly=true>
			 </div>
			 
			 <div class="form-group has-success" >
                  <label>Pokok Pelunasan</label>
                  <input type="text" name="fcTotalPelunasanPokok" value="0" class="form-control"  id="fcTotalPelunasanPokok" readonly=true>
			 </div>
			
			 <div class="form-group has-success">
                  <label>Bunga Pelunasan</label>
                  <input type="text" name="fcTotalPelunasanBunga" value="0" id="fcTotalPelunasanBunga" class="form-control"  readonly=true>
                </div>
			
			<div class="form-group has-success" >
                  <label>Adm Pelunasan</label>
                  <input type="text" name="fcTotalPelunasanAdm" value="0" class="form-control"  id="fcTotalPelunasanAdm" readonly=true>
			  </div> 

			<div class="form-group has-success" >
                  <label>Pblt Pelunasan</label>
                  <input type="text" name="fcTotalPelunasanPblt" value="0" class="form-control"  id="fcTotalPelunasanPblt" readonly=true>
			 </div>

       <div class="form-group has-success" >
                  <label>Tabungan Pelunasan</label>
                  <input type="text" name="fcTotalPelunasanTab" value="0" class="form-control"  id="fcTotalPelunasanTab" readonly=true>
			 </div>

			 <div class="form-group has-success">
                  <label>Total Pelunasan</label>
                  <input type="text" name="fcTotalPelunasan" value="0" id="fcTotalPelunasan" class="form-control"  readonly=true>
                </div>
              
            </div>
            <!-- /.box-body -->
         </div>
		  
		 <div class="box box-danger">
            <div class="box-body">
			
                <div class="form-group">
				<label>Plafond Pinjaman</label>
                 <!--<span  id="fcPlafondoutput" class="form-control" ></span> -->
				 <input type="text" name="fcPlafondoutput" id="fcPlafondoutput" value="" class="form-control" placeholder="Input ..." readonly=true>
				  
                </div>
               
			   <div class="row">
                <div class="col-xs-4">
				<label>Potongan Adm [%]</label>
                  <?php	  
				  $p=mysql_fetch_array(mysql_query("SELECT ffAdm FROM tlbiayaadmumum WHERE aktif='Y'"));
                  echo"<input type='text' name='ffAdm' value='$p[ffAdm]' class='form-control' placeholder='Input ...' id='ffAdm' onkeypress='return isNumberKey(event)' onkeyup='myFunction(this,event)'>";
				?>	 
                </div>
                <div class="col-xs-8">
				<label>&nbsp;</label>
                  <input type="text" name="fcAdm" id="fcAdm" class="form-control" placeholder=".00" readonly=true>
                </div>               
              </div></br>

        <div class="row">
                <div class="col-xs-4">
        <label>Potongan Provisi [%]</label>
                  <?php   
          $p=mysql_fetch_array(mysql_query("SELECT ffProvisi FROM tlbiayaadmumum WHERE aktif='Y'"));
                  echo"<input type='text' name='ffProvisi' value='$p[ffProvisi]' class='form-control' placeholder='Input ...' id='ffProvisi' readonly=true>";
        ?>   
                </div>
                <div class="col-xs-8">
        <label>&nbsp;</label>
                  <input type="text" name="fcProvisi" id="fcProvisi" class="form-control" placeholder=".00" readonly=true>
                </div>               
              </div></br>      
			  
			     <div class="row">
                <div class="col-xs-4">
				<label>Potongan Asuransi [%]</label>
                    <?php	  
				  $p=mysql_fetch_array(mysql_query("SELECT ffAsuransi FROM tlbiayaadmumum WHERE aktif='Y'"));
                  echo"<input type='text' name='ffAsuransi' value='$p[ffAsuransi]' class='form-control' placeholder='Input ...' id='ffAsuransi' readonly=true>";
				?>	
                </div>
                <div class="col-xs-8">
				<label>&nbsp;</label>
                  <input type="text" name="fcAsuransi" id="fcAsuransi"  class="form-control" placeholder=".00" readonly=true>
                </div>               
              </div></br>

        <div class="row">
                <div class="col-xs-4">
        <label>Potongan PPAP [%]</label>
                    <?php   
          $p=mysql_fetch_array(mysql_query("SELECT ffPpap FROM tlbiayaadmumum WHERE aktif='Y'"));
                  echo"<input type='text' name='ffPpap' value='$p[ffPpap]' class='form-control' placeholder='Input ...' id='ffPpap' readonly=true>";
        ?>  
                </div>
                <div class="col-xs-8">
        <label>&nbsp;</label>
                  <input type="text" name="fcPpap" id="fcPpap"  class="form-control" placeholder=".00" readonly=true>
                </div>               
              </div></br>      

			   <div class="form-group">
				<label>Materai</label>
                  <?php	  
				  $p=mysql_fetch_array(mysql_query("SELECT fcMaterai FROM tlbiayaadmumum WHERE aktif='Y'"));
				  $materai= number_format( $p['fcMaterai'] , 0 , ',' , ',' );
                  echo"<input type='text' name='fcMaterai' value='$materai' class='form-control' placeholder='Input ...' id='fcMaterai' onkeyup=\"functionSim(this,event)\" onkeypress=\"return isNumberKey(event)\" maxlength=7>";
				?>	
                </div>
        <div class="form-group">
        <label>RRP DS</label>
                  <input type="text" class="form-control"  name="fcRrp" id="fcRrp" placeholder="0" onkeyup="functionSim(this,event)" onkeypress="return isNumberKey(event)"  maxlength=10>
                </div>        
			   <div class="form-group">
				<label>Pembulatan</label>
                  <input type="text" class="form-control" name="fcPblt" id="fcPblt" placeholder="0" onkeyup="functionSim(this,event)"  onkeypress="return isNumberKey(event)" >
                </div>
				 <div class="form-group">
				<label>Pelunasan</label>
                  <input type="text" class="form-control"  name="fcPelunasan" id="fcPelunasan" placeholder="0" readonly=true>
                </div>
				<div class="form-group">
				<label>Diskon Pelunasan</label>
                  <input type="text" class="form-control"  name="fcDiskon" id="fcDiskon" placeholder="0" onkeyup="functionSim(this,event)" onkeypress="return isNumberKey(event)"  maxlength=10>
                </div>
				 <div class="form-group">
				<label>Simpanan</label>
                  <input type="text" class="form-control"  name="fcSimpanan" id="fcSimpanan" placeholder="0" onkeyup="functionSim(this,event)"  onkeypress="return isNumberKey(event)" maxlength=10>
                </div>
				
				 <div class="form-group">
				<label>Terima Bersih</label>
                  <input type="text" name="fcTerimaBersih" id="fcTerimaBersih" class="form-control" placeholder="Input ..." readonly=true>
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
                <a  class="btn btn-default" href="transaksi-umum.html">Cancel</a>
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


   $edit = mysql_query("SELECT * FROM txpinjaman_umum_hdr WHERE fnid='$_GET[fnid]'");
    $r    = mysql_fetch_array($edit);
	$SaldoSimpanan = number_format ($r[fcSimpanan], 0, ',', '.');
	$PlafondPinjaman = number_format ($r[fcPlafond], 0, ',', '.');
	$PokokAngsuran = number_format ($r[fcPokokAngsuran], 0, ',', '.');
	$BungaAngsuran = number_format ($r[fcBunganAngsuran], 0, ',', '.');
	$AdminAngsuran = number_format ($r[fcAdmAngsuran], 0, ',', '.');
	$PbltAngsuran = number_format ($r[fcPbltAngsuran], 0, ',', '.');
	$TabunganAngsuran = number_format ($r[fcTabAngsuran], 0, ',', '.');
	$TotalAngsuran = number_format ($r[fcTotalAngsuran], 0, ',', '.');
	
	
	
  echo"
    <form id='myForm' name='myForm' method='POST' enctype='multipart/form-data' action='aksi-edit-transaksiumum.html' >
 <div id='printr'>
 <section class='content'>
   <div class='box box-info'>
        <div class='box-header with-border'>
          <h3 class='box-title'>";
		if($r['fnStatus']==1){
			echo"<span class='label label-success'>Status : Posted</span>";
		}else{
			echo"<span class='label label-danger'>Status : Batal</span>";
		}
		 echo"&nbsp;&nbsp;&nbsp;<span onclick=\"printContent('printr')\" class='label label-info'>Print</span>
		  </h3>

          <div class='box-tools pull-right'>
            <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
           
          </div>
        </div>
		
        <!-- /.box-header -->
        <div class='box-body' '>
		
          <div class='row'>
            <div class='col-md-6'>
			
			<div class='form-group has-warning' >
                  <label>No Transaksi</label>
				  <input type='hidden' name='id' class='form-control' value='$r[fnid]'  >
				 <input type='text' name='ftTrans_No' class='form-control ' value='$r[ftTrans_No]' placeholder='Input ...' id='ftTrans_No' readonly=true>
			 </div>
			
			 <div class='form-group has-warning' id='tgl_pinjam' >
                <label>Tgl Pinjam</label>
                <div class='input-group date '>
                  <div class='input-group-addon'>
                    <i class='fa fa-calendar '></i>
                  </div>
                  <input type='text' class='form-control' name='fdTrans_date'  value='$r[fdTrans_date]' readonly=true>
                </div>
                <!-- /.input group -->
              </div> 	
			
			<div class='form-group has-warning' >
                  <label>Saldo Simpanan</label>
                  <input type='text' name='fcSaldosimpanan' class='form-control' placeholder='Input ...' id='fcSaldosimpanan' value='$SaldoSimpanan'  readonly=true>
			  </div>
			  <!-- /.form-group -->
            </div>
			 <!-- /.RIGHT SIDE -->
            <div class='col-md-6'>
			
			<div class='form-group has-warning' >
                  <label>Keterangan</label>
				  <textarea class='form-control' rows='9' placeholder='Enter ...' name='ftNotes' readonly=true> $r[ftNotes]</textarea>
             </div>
			
            <!-- /.END RIGHT SIDE -->
            </div>
            <!-- /.col -->
          </div>
		  
          <!-- /.row -->
        </div>
       
		 </div>
		 </section>
		 
		 
		  <div class='box-body' >
		<div class='col-md-6'>
		 <div class='box box-success'>
           
            <div class='box-body '>
            <div class='form-group has-success' >
			  <label><span style='color:red;'>*</span> No Rekening</label>
			 <div class='input-group'>
              <input type='text' class='form-control' name='ftCustomer_Code' id='ftCustomer_Code' value='$r[ftCustomer_Code]'  placeholder='Input ...' readonly=true >
                <span class='input-group-addon '><a href='#' class='small-box-footer ' onClick='showSouvenir('rikues')'><b>SEARCH</b></a></span>
              </div></div>";
			$tampil2=mysql_query("SELECT ftNamaNasabah,ftNoRekening,ftAlamat FROM tlnasabah WHERE ftNoRekening='$r[ftCustomer_Code]'   ");
			$w=mysql_fetch_array($tampil2); 
			  
		echo"	<div class='form-group has-success' >
                  <label>Nama</label>
                  <input type='text' name='ftNamaNasabah' id='ftNamaNasabah' class='form-control' value='$w[ftNamaNasabah]' placeholder='Input ...' readonly=true>
			 </div>
			 <div class='form-group has-success' >
                  <label>Alamat</label>
				  <textarea class='form-control' rows='12' placeholder='' name='ftAlamat' id='ftAlamat' readonly=true>$w[ftAlamat]</textarea>
				<!--  <input type='text' name='ftAlamat' id='ftAlamat' class='form-control' value='' placeholder='Input ...' > -->
				  
             </div>
			 <div class='form-group has-success' >
                </div>
			   </div>
			   <!-- /.box-body -->
         </div>
		 
		 <div class='box box-warning'>
            <div class='box-body'>
              
                <div class='form-group has-warning' >
                  <label>Plafond Pinjaman [Rp]</label>
                  <input type='text' name='fcPlafond' class='form-control' value='$PlafondPinjaman' placeholder='Input ...' id='fcPlafond' onkeyup='myFunction()'  onkeypress='return isNumberKey(event)' readonly=true>
			  </div> 
			  
			<div class='form-group has-warning' >
                  <label>Bunga [%]</label>";
				$p=mysql_fetch_array(mysql_query("SELECT ffBunga FROM tlbiayaadmumum WHERE aktif='Y'"));
                  echo"<input type='text' name='ffBunga' value='$p[ffBunga]' class='form-control' placeholder='Input ...' id='ffBunga' readonly=true>
			 
			  </div> 
		
			  
			  <div class='form-group has-warning' >
			 <div class='row'>
                <div class='col-xs-6 '>
				<label class='control-label' for='inputSuccess'>Jangka Waktu</label>
                  <input type='text' name='fnJW' id='fnJW' value='$r[fnJW]' class='form-control' placeholder='Input ...' onkeyup='jwfunction()' onkeypress='return isNumberKey(event)' readonly=true>
                </div>
                <div class='col-xs-2 has-warning'></br></br>
				<label >Bulan</label>
                </div>
                </div>               
              </div>
              
            </div>
            <!-- /.box-body -->
         </div>
		 
		 <div class='box box-primary'>
            <div class='box-body'>
              
                <div class='form-group'>
				<label>Pokok Angsuran</label>
                  <input type='text' name='fcPokokAngsuran' id='fcPokokAngsuran' value='$PokokAngsuran' class='form-control '   placeholder='0' readonly=true>
                </div>
              
			   <div class='form-group'>
				<label>Bunga Angsuran</label>
                  <input type='text' name='fcBunganAngsuran' id='fcBunganAngsuran' value='$BungaAngsuran'  class='form-control'  placeholder='0' readonly=true>
                </div>
				 <div class='form-group'>
				<label>Admin Angsuran</label>
					  
				  <input type='text' name='fcAdmAngsuran' value='$AdminAngsuran'  class='form-control' placeholder='Input ...' id='fcAdmAngsuran' readonly=true>
                </div>
				 <div class='form-group'>
				<label>Pblt Angsuran</label>
                  <input type='text' class='form-control' name='fcPbltAngsuran' id='fcPbltAngsuran' value='$PbltAngsuran'  placeholder='0' readonly=true>
                </div>
				 <div class='form-group'>
				<label>Tabungan Angsuran</label>
                  <input type='text' class='form-control' name='fcTabAngsuran' id='fcTabAngsuran' value='$TabunganAngsuran'  onkeyup='functionTabAng()'  onkeypress='return isNumberKey(event)' placeholder='0' readonly=true>
                </div>
				 <div class='form-group'>
				<label>Total Angsuran</label>
                  <input type='text'  name='fcTotalAngsuran' id='fcTotalAngsuran' value='$TotalAngsuran'  class='form-control' placeholder='0' readonly=true>
                </div>
              
            </div>
            <!-- /.box-body -->
         </div>
		  
		 
		  </div>
		  
		  <div class='col-md-6'>
		  
		  
		  <div class='box box-success'>
            <div class='box-body'>
              
               <div class='form-group has-success' >
                  <label>No Pinjaman</label>
                  <input type='text' name='ftTrans_No_old' class='form-control' value='$r[ftTrans_No]' id='ftTrans_No_old' readonly=true>
			         </div>";
               
			$tampil3=mysql_query("SELECT ftLoan_No,fcPlafond,fcPokokAngsuran,fcBunganAngsuran,fcAdmAngsuran,fcPbltAngsuran,fcTabAngsuran,fcTotalAngsuran,ftLoan_No_Old FROM txangsuran_umum_hdr WHERE ftLoan_No='$r[ftTrans_No]'   ");
			$s=mysql_fetch_array($tampil3); 
			$PokokPelunasan = number_format ($s[fcPlafond], 0, ',', '.');
			$BungaPelunasan = number_format ($s[fcBunganAngsuran], 0, ',', '.');
			$AdmPelunasan = number_format ($s[fcAdmAngsuran], 0, ',', '.');
			$PbltPelunasan = number_format ($s[fcPbltAngsuran], 0, ',', '.');
			$TotalPelunasan = number_format ($s[fcTotalAngsuran], 0, ',', '.'); 
			
			$PlafondPinjaman = number_format ($r[fcPlafond], 0, ',', '.');
			$PotonganAdm = number_format ($r[fcAdm], 0, ',', '.');
			$PotonganAsuransi = number_format ($r[fcAsuransi], 0, ',', '.');
      $PotonganProvisi= number_format ($r[fcProvisi], 0, ',', '.');
      $PotonganPpap= number_format ($r[fcPpap], 0, ',', '.');
			$Materai = number_format ($r[fcMaterai], 0, ',', '.');
      $Rrp = number_format ($r[fcRrp], 0, ',', '.');
			$Pembulatan = number_format ($r[fcPblt], 0, ',', '.');
			$Pelunasan = number_format ($r[fcPelunasan], 0, ',', '.');
			$Simpanan = number_format ($r[fcSimpanan], 0, ',', '.');
			$Diskon = number_format ($r[fcDiskon], 0, ',', '.');
      $TerimaBersih = number_format ($r[fcTerimaBersih], 0, ',', '.');
      $fcTabAngsuran = number_format ($s[fcTabAngsuran], 0, ',', '.');
		echo"
			 
			 <div class='form-group has-success' >
                  <label>Pokok Pelunasan</label>
                  <input type='text' name='fcTotalPelunasanPokok' value='$PokokPelunasan'  class='form-control'  id='fcTotalPelunasanPokok' readonly=true>
			 </div>
			
			 <div class='form-group has-success'>
                  <label>Bunga Pelunasan</label>
                  <input type='text' name='fcTotalPelunasanBunga' value='$BungaPelunasan' id='fcTotalPelunasanBunga' class='form-control'  readonly=true>
                </div>
			
			<div class='form-group has-success' >
                  <label>Adm Pelunasan</label>
                  <input type='text' name='fcTotalPelunasanAdm' value='$AdmPelunasan'  class='form-control'  id='fcTotalPelunasanAdm' readonly=true>
			  </div> 

			<div class='form-group has-success' >
                  <label>Pblt Pelunasan</label>
                  <input type='text' name='fcTotalPelunasanPblt' value='$PbltPelunasan'  class='form-control'  id='fcTotalPelunasanPblt' readonly=true>
       </div>
       
       <div class='form-group has-success' >
        <label>Tabungan Pelunasan</label>
        <input type='text' name='fcTotalPelunasanTab' value='$fcTabAngsuran'  class='form-control'  id='fcTotalPelunasanTab' readonly=true>
      </div>
			
			 <div class='form-group has-success'>
                  <label>Total Pelunasan</label>
                  <input type='text' name='fcTotalPelunasan' value='$TotalPelunasan'  id='fcTotalPelunasan' class='form-control'  readonly=true>
                </div>
              
            </div>
            <!-- /.box-body -->
         </div>
		  
		 <div class='box box-danger'>
            <div class='box-body'>
			
                <div class='form-group'>
				<label>Plafond Pinjaman</label>
                 <!--<span  id='fcPlafondoutput' class='form-control' ></span> -->
				 <input type='text' name='fcPlafondoutput' id='fcPlafondoutput' value='$PlafondPinjaman'  class='form-control' placeholder='Input ...' readonly=true>
				  
                </div>
               
			   <div class='row'>
                <div class='col-xs-4'>
				<label>Potongan Adm [%]</label>
                 <input type='text' name='ffAdm' value='$r[ffAdm]' class='form-control' placeholder='Input ...' id='ffAdm' readonly=true>
                </div>
                <div class='col-xs-8'>
				<label>&nbsp;</label>
                  <input type='text' name='fcAdm' id='fcAdm' value='$PotonganAdm' class='form-control' placeholder='.00' readonly=true>
                </div>               
              </div></br>

         <div class='row'>
                <div class='col-xs-4'>
        <label>Potongan Provisi [%]</label>
                 <input type='text' name='ffProvisi' value='$r[ffProvisi]' class='form-control' placeholder='Input ...' id='ffProvisi' readonly=true>
                </div>
                <div class='col-xs-8'>
        <label>&nbsp;</label>
                  <input type='text' name='fcProvisi' id='fcProvisi' value='$PotonganProvisi' class='form-control' placeholder='.00' readonly=true>
                </div>               
              </div></br>     
			  
			     <div class='row'>
                <div class='col-xs-4'>
				<label>Potongan Asuransi [%]</label>
                    <input type='text' name='ffAsuransi' value='$r[ffAsuransi]' class='form-control' placeholder='Input ...' id='ffAsuransi' readonly=true>
                </div>
                <div class='col-xs-8'>
				<label>&nbsp;</label>
                  <input type='text' name='fcAsuransi' id='fcAsuransi' value='$PotonganAsuransi' class='form-control' placeholder='.00' readonly=true>
                </div>               
              </div></br>

        <div class='row'>
                <div class='col-xs-4'>
        <label>Potongan PPAP [%]</label>
                 <input type='text' name='ffPpap' value='$r[ffPpap]' class='form-control' placeholder='Input ...' id='ffPpap' readonly=true>
                </div>
                <div class='col-xs-8'>
        <label>&nbsp;</label>
                  <input type='text' name='fcPpap' id='fcPpap' value='$PotonganPpap' class='form-control' placeholder='.00' readonly=true>
                </div>               
              </div></br>         

			   <div class='form-group'>
				<label>Materai</label>
                 <input type='text' name='fcMaterai' value='$Materai' class='form-control' placeholder='Input ...' id='fcMaterai' readonly=true>
                </div>
         <div class='form-group'>
        <label>RRP</label>
                 <input type='text' name='fcRrp' value='$Rrp' class='form-control' placeholder='Input ...' id='fcMaterai' readonly=true>
                </div>       
			   <div class='form-group'>
				<label>Pembulatan</label>
                  <input type='text' class='form-control' name='fcPblt' id='fcPblt' value='$Pembulatan' placeholder='0' readonly=true>
                </div>
				 <div class='form-group'>
				<label>Pelunasan</label>
                  <input type='text' class='form-control'  name='fcPelunasan' id='fcPelunasan' value='$Pelunasan' placeholder='0' readonly=true>
                </div>
				 <div class='form-group'>
				<label>Simpanan</label>
                  <input type='text' class='form-control'  name='fcSimpanan' id='fcSimpanan' value='$Simpanan' placeholder='0' readonly=true>
                </div>
				 <div class='form-group'>
				<label>Diskon</label>
                  <input type='text' class='form-control'  name='fcDiskon' id='fcDiskon' value='$Diskon' placeholder='0' readonly=true>
                </div>
				 <div class='form-group'>
				<label>Terima Bersih</label>
                  <input type='text' name='fcTerimaBersih' id='fcTerimaBersih' value='$TerimaBersih' class='form-control' placeholder='Input ...' readonly=true>
                </div>";
				
				
			
			
              
           echo" </div>
            <!-- /.box-body -->
          </div>
		  
		  
		  
		 

		  </div>
		  
		  </div>
		  </div>
		  
		  
	
     <!-- /.box-header -->
        <div class='box-body' >
	    <div class='row'>
            <div class='col-md-6'>
		 <div class='box-footer'>
                <a  class='btn btn-default' href='transaksi-umum.html'>Cancel</a>
             </div>	
			  <!-- /.form-group -->
            </div>
			 <!-- /.RIGHT SIDE -->
            <div class='col-md-6'>
			  <div class='box-footer'>
                 <button type='submit' class='btn btn-info pull-right'>Reject</button>
             </div>		
			 <!-- /.END RIGHT SIDE -->
            </div>
			
            <!-- /.col -->
          </div>
		  <!-- /.row -->
        </div>
        
		  
	  </form>";
   
    break;  
	//edit password
  
   }
   }
  ?>

