 
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
  if (form.ftLoan_No.value == ""){
  swal({title: "Oops...",text: "No Pinjaman harus di isi!",type:"error",closeOnConfirm: false},
	function(){swal.close();$('#ftLoan_No').focus();});
    return (false);  
	}else if (form.fnPaymentMethod.value == ""){
  swal({title: "Oops...",text: "Metode harus di isi!",type:"error",closeOnConfirm: false},
	function(){swal.close();$('#fnPaymentMethod').focus();});
    return (false);  
	}     
   
 }
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
*:focus {
  border: 2px dashed yellow;
  background-color: yellow;
}
</style>


<?php
include "control.php";
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
       FORM PELUNASAN MIKRO
        
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
              <h3 class="box-title"><input type="button" onclick="location.href='<?php echo "tambah-pelunasan-mikro.html ";?>';" value="Tambah" class="btn bg-purple btn-flat margin"/></h3>
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
                  <th>No Transaksi Angsuran</th>
                  <th>Tgl Angsuran</th>
				  <th>Nama Nasabah</th>
				  <th>No Rekening</th>
				  <th>Jumlah Dibayar</th>
				  <th>Metode</th>
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
				$tampil=mysql_query("SELECT a.*,b.ftNamaNasabah,b.ftAlamat  FROM txpelunasan_mikro_hdr a LEFT JOIN tlnasabah b ON a.ftCustomer_Code=b.ftNoRekening ORDER BY a.fnid DESC  ");
				}else{
				$tampil=mysql_query("SELECT a.*,b.ftNamaNasabah,b.ftAlamat  FROM txpelunasan_mikro_hdr a LEFT JOIN tlnasabah b ON a.ftCustomer_Code=b.ftNoRekening ORDER BY a.fnid DESC ");
				}
				$no = $posisi+1;
				$no1 = 0;	
				while($r=mysql_fetch_array($tampil)){
				$jumlahbayar = number_format ($r[fcTotalAngsuran], 0, ',', '.');	
				$tgl_angsuran = substr($r[fdTrans_date],0,10);
				 $no1++;	
				
				echo"
                <tr>
				  <td><span class='label bg-black disabled color-palette'>$no1</span></td>
                  <td>$r[ftTrans_No]</td>
                  <td>$tgl_angsuran</td> 
				  <td>$r[ftNamaNasabah]</td>
                  <td>$r[ftCustomer_Code]</td> 
				  <td>$jumlahbayar</td>";
				  //Metode
				  if($r[fnPaymentMethod]==1){
                  echo"<td>PELUNASAN</td>"; 
				  }else{
					echo"<td>SETOR SENDIRI</td>";  
				  }
				 //Status
				if($r[fnStatus]==1){
                  echo"<td><span class='label label-success'>Posted</span></td>"; 
				  }else{
					echo"<td><span class='label label-danger'>Batal</span></td>";  
				  }
				  
				echo"				 				  
                  <td width='70px'><span class='label bg-gray disabled color-palette' onmouseover=\"this.style.cursor='pointer'\"><i class='fa fa-search' title='Edit $r[ftTrans_No]' onclick=\"location.href='edit-pelunasan-mikro-$r[fnid].html';\"></i> &nbsp;&nbsp;&nbsp;  
				  ";
				//  if($_SESSION[leveluser]=='1'){
				  echo"<a class='fa fa-trash-o' title='delete $r[ftNamaNasabah]'  href=javascript:confirmdelete('aksi-delete-pelunasan-mikro-$r[fnid].html') ></a>";
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
  <form id="myForm" autocomplete="off" name="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambah-pelunasan-mikro.html" onSubmit="return validasi(this)">
  <section class="content">
   <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Input Pelunasan Mikro</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
		
        <!-- /.box-header -->
        <div class="box-body" >
		
          <div class="row">
            <div class="col-md-6">
			
			<div class="form-group has-warning" >
			<script>
				  function getPelunasanBulanMikro(x) {
				  var getftTrans_No= document.getElementById("ftTrans_No").value;
				  var tahun = x.substring(2,4);
				  var bulan = x.substring(5,7);
				  var firstCode = getftTrans_No.substring(0,2);
				  var lastCode = getftTrans_No.substring(6,10);
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
					$query = "SELECT max(fnid) AS last FROM txangsuran_mikro_hdr  ";
					$hasil = mysql_query($query);
					$data  = mysql_fetch_array($hasil);
					$lastNoTransaksi = $data['last'];
					$number = range(1,9999);
					$newID = sprintf("%04s", $lastNoTransaksi);
					
					//$cariid=mysql_query("SELECT max(ftTrans_No) as notrans FROM txpelunasan_mikro_hdr");
					$cariid=mysql_query("SELECT (ftTrans_No) AS notrans FROM txpelunasan_mikro_hdr WHERE LENGTH(ftTrans_No)>=10 ORDER BY RIGHT(ftTrans_No,4) DESC LIMIT 1 ");
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
					<input type="text" name="ftTrans_No" class="form-control " value=<?php echo "PELM$thn2$bln$unik2"; ?> placeholder="Input ..." id="ftTrans_No" readonly=true>
			     
			 </div>
			
			 <div class="form-group has-warning" id="tgl_pinjam" >
                <label>Tgl Angsuran</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right"  value=<?php echo "$thn-$bln-$tgl"; ?> name="fdTrans_date" id="fdTrans_date" onchange="getPelunasanBulanMikro(this.value);">
                </div>
                <!-- /.input group -->
              </div> 	
			
			<div class="form-group has-warning" >
                  <label>Saldo Simpanan</label>
                  <input type="text" name="fcSimpanan" class="form-control" placeholder="Input ..." id="fcSimpanan" readonly=true>
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
		 
		 
		  <div class="box-body" >
		<div class="col-md-6">
		
           
			 <div class="box box-success">
           
            <div class="box-body ">
           
			<!--  <div class="form-group has-success" >
			  <label> No Rekening&nbsp;&nbsp;&nbsp;<span style="color:red;">*</span></label>
			 <div class="input-group">
              <input type="text" class="form-control" name="ftCustomer_Code" id="ftCustomer_Code"  placeholder="Input ..."   readonly=true>
                <span class="input-group-addon "><a href="#" class="small-box-footer " onClick="showPinjamanmikro('rikues')"><b>SEARCH</b></a></span>
              </div></div> -->

            <div class="form-group has-success">
	          <label>No Rekening&nbsp;&nbsp;&nbsp;<span style="color:red;">*</span></label>
	            <div class="input-group">
	           	   <input type="text" class="form-control" id="ftCustomer_Code" placeholder="Input ..." aria-describedby="basic-addon1" name="ftCustomer_Code" readonly>
	           <span class="input-group-addon" id="basic-addon1" onmouseover="this.style.cursor='pointer'" 
	            onClick="showPinjamanmikro('rikues')"><span class='glyphicon glyphicon-new-window' aria-hidden='true'></span></span>
	          </div>
	        </div>   

			<div class="form-group has-success" >
                  <label>Nama</label>
                  <input type="text" name="ftNamaNasabah" id="ftNamaNasabah" class="form-control" value="" placeholder="Input ..." readonly=true>
			 </div>
			<div class="form-group has-success" >
                  <label>Nama Kelompok</label>
                  <input type="text" name="ftNamaKelompok" id="ftNamaKelompok" class="form-control" value="" placeholder="Input ..." readonly=true>
			 </div> 
			 <div class="form-group has-success" >
                  <!-- <label>Alamat</label> -->
				  <input type="hidden" class="form-control" rows="6" placeholder="" name="ftAlamat" id="ftAlamat" readonly=true>
				<!--  <input type="text" name="ftAlamat" id="ftAlamat" class="form-control" value="" placeholder="Input ..." > -->
				  
             </div>
			 <div class="form-group has-success" >
                </div>
			   </div>
			   <!-- /.box-body -->
         </div>
		 
		  <div class="box box-success">
           
            <div class="box-body ">
			  
			 <!-- <div class="form-group has-success" >
			  <label> No Pinjaman&nbsp;&nbsp;&nbsp;<span style="color:red;">*</span></label>
			 <div class="input-group">
              <input type="text" class="form-control" name="ftLoan_No" id="ftLoan_No"  placeholder="Input ..."   readonly=true>
                <span class="input-group-addon "><a href="#" class="small-box-footer " onClick="showPinjamanmikro('rikues')"><b>SEARCH</b></a></span>
              </div></div> -->
			<div class="form-group ">
                  <label>No Pinjaman&nbsp;&nbsp;&nbsp;<span style="color:red;">*</span></label>
                  <input type="text" name="ftLoan_No" id="ftLoan_No" class="form-control" placeholder="Input ..." readonly=true>
                </div>
			 <div class="form-group ">
                  <label>Plafon Pinjaman</label>
                  <input type="text" name="fcPlafond" id="fcPlafond" class="form-control" placeholder="Input ..." readonly=true>
                </div>
			
			
			 <div class="row ">
                <div class="col-xs-4 ">
				<label>Bunga / JW</label>
                  <input type="text" class="form-control" placeholder=".00" name="ffBunga"readonly=true>
                </div>
                <div class="col-xs-8">
				<label>&nbsp;</label>
                  <input type="text" class="form-control" placeholder=".00" name="fnJW" readonly=true>
                </div>               
              </div></br>  

			<div class="form-group " >
                  <label>Saldo Akhir</label>
                  <input type="text" name="fcOutstanding" class="form-control" placeholder="Input ..." id="fcOutstanding" readonly=true>
			 </div>
		    </div>
		    <!-- /.box-body -->
          </div>
		  
		 
		  </div>
		  
		  <div class="col-md-6">
		  
		 <div class="box box-danger">
            <div class="box-body">
              
               <div class="form-group" id="divisi2">
                <label>Metode&nbsp;&nbsp;&nbsp;<span style="color:red;">*</span></label>
                <select class="form-control select2" style="width: 100%;" name="fnPaymentMethod" id="fnPaymentMethod" readonly>
                  <option selected="selected" value="1">PELUNASAN</option>
				  
                </select>
              </div>
               
			   <div class="form-group">
				<label>Pokok</label>
                  <input type="text" class="form-control" placeholder="Input ..." name="fcPokokAngsuran" id="fcPokokAngsuran" readonly=true>
                </div>
			  
			     <div class="form-group">
				<label>Bunga</label>
                  <input type="text" class="form-control" placeholder="Input ..." name="fcBunganAngsuran" id="fcBunganAngsuran" readonly=true>
                </div>
			  
			   <div class="form-group">
				<label>Adm</label>
                  <input type="text" class="form-control" placeholder="Input ..." name="fcAdmAngsuran" id="fcAdmAngsuran" readonly=true>
                </div>
				 <div class="form-group">
				<label>Pblt</label>
                  <input type="text" class="form-control" placeholder="Input ..."  id="fcPbltAngsuran" name="fcPbltAngsuran" onkeypress="return isNumberKey(event)" onkeyup="funcPblt(this,event)" disabled=true>
                </div>
				 <div class="form-group">
				<label>Tabungan</label>
                  <input type="text" class="form-control" placeholder="Input ..."  name="fcTabAngsuran" id="fcTabAngsuran" readonly=true>
                </div>
				 <div class="form-group">
				<label>Jumlah</label>
                  <input type="text" class="form-control" placeholder="Input ..."  name="fcTotalAngsuran" id="fcTotalAngsuran" readonly=true>
                </div>
				 <div class="form-group">
				<label>Potongan</label>
                  <input type="text" class="form-control" placeholder="Input ..." name="fcDiskon" id="fcDiskon" onkeypress="return isNumberKey(event)" onkeyup="myFunction(this,event)">
                </div>
				 <div class="form-group">
				<label>Jumlah Dibayar</label>
                  <input type="text" class="form-control" placeholder="Input ..."  name="fcPayment" id="fcPayment" readonly=true>
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
                <a  class="btn btn-default" href="pelunasan-mikro.html">Cancel</a>
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


   $edit = mysql_query("SELECT a.*,b.ftNamaNasabah,b.ftAlamat,b.ftNamaKelompok FROM txpelunasan_mikro_hdr a LEFT JOIN tlnasabah b ON a.ftCustomer_Code=b.ftNoRekening WHERE a.fnid='$_GET[fnid]'");
    $r    = mysql_fetch_array($edit);
	$saldosimpanan = number_format ($r[fcSimpanan], 0, ',', '.');
	$plafonpinjaman = number_format ($r[fcPlafond], 0, ',', '.');
	$saldoakhir = number_format ($r[fcOutstanding], 0, ',', '.');
	$pokok = number_format ($r[fcPokokAngsuran], 0, ',', '.');
	$bunga = number_format ($r[fcBunganAngsuran], 0, ',', '.');
	$adm = number_format ($r[fcAdmAngsuran], 0, ',', '.');
	$pblt = number_format ($r[fcPbltAngsuran], 0, ',', '.');
	$tabungan = number_format ($r[fcTabAngsuran], 0, ',', '.');
	$jumlah = number_format ($r[fcTotalAngsuran], 0, ',', '.');
	$potongan = number_format ($r[fcDiskon], 0, ',', '.');
	$jumlahdibayar = number_format ($r[fcPayment], 0, ',', '.');
?>	
  <form id="myForm" name="myForm" method="POST" enctype="multipart/form-data" action="aksi-edit-pelunasan-mikro.html" onSubmit="return validasi(this)">
  <div id="printr">
  <section class="content">
   <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">
		  <?php
		  if($r['fnStatus']==1){
			echo"<span class='label label-success'>Status : Posted</span>";
		}else{
			echo"<span class='label label-danger'>Status : Batal</span>";
		}
		echo"&nbsp;&nbsp;&nbsp;<span onclick=\"printContent('printr')\" class='label label-info'>Print</span>
		  </h3>";
		  ?>
		  

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
		
        <!-- /.box-header -->
        <div class="box-body" >
		
          <div class="row">
            <div class="col-md-6">
			
			<div class="form-group has-warning" >
                  <label>No Transaksi</label>
					<input type="hidden" name="id" class="form-control " value=<?php echo "$r[fnid]"; ?>  >
					<input type="text" name="ftTrans_No" class="form-control " value=<?php echo "$r[ftTrans_No]"; ?>  placeholder="Input ..." id="ftTrans_No" readonly=true>
			     
			 </div>
			
			 <div class="form-group has-warning" id="tgl_pinsjam" >
                <label>Tgl Angsuran</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="fdTrans_date"  value=<?php echo "$r[fdTrans_date]"; ?> readonly=true>
                </div>
                <!-- /.input group -->
              </div> 	
			
			<div class="form-group has-warning" >
                  <label>Saldo Simpanan</label>
                  <input type="text" name="fcSimpanan" class="form-control" placeholder="Input ..." id="fcSimpanan" value=<?php echo "$saldosimpanan"; ?> readonly=true>
			  </div>
			  <!-- /.form-group -->
            </div>
			 <!-- /.RIGHT SIDE -->
            <div class="col-md-6">
			
			<div class="form-group has-warning" >
                  <label>Keterangan</label>
				  <textarea class="form-control" rows="9" placeholder="Enter ..." name="ftNotes" readonly=true><?php echo "$r[ftNotes]"; ?> </textarea>
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
           <div class="form-group has-success" >
                  <label>No Rekening</label>
                  <input type="text" name="ftCustomer_Code" id="ftCustomer_Code" class="form-control"  value=<?php echo "$r[ftCustomer_Code]"; ?> readonly=true>
			 </div>
			<div class="form-group has-success" >
                  <label>Nama</label>
                  <input type="text" name="ftNamaNasabah" id="ftNamaNasabah" class="form-control"  placeholder="Input ..." value="<?php echo $r[ftNamaNasabah]; ?> " readonly=true>
			 </div>
			 <div class="form-group has-success" >
                  <label>Nama Kelompok</label>
                  <input type="text" name="ftNamaKelompok" id="ftNamaKelompok" class="form-control"  placeholder="Input ..." value="<?php echo $r[ftNamaKelompok]; ?> " readonly=true>
			 </div>
			 <div class="form-group has-success" >
                  <!-- <label>Alamat</label> -->
				  <input type="hidden" class="form-control" rows="6" placeholder="" name="ftAlamat" id="ftAlamat" readonly=true>
				<!--  <input type="text" name="ftAlamat" id="ftAlamat" class="form-control" value="" placeholder="Input ..." > -->
				  
             </div>
			 <div class="form-group has-success" >
                </div>
			   </div>
			   <!-- /.box-body -->
         </div>
		 
		  <div class="box box-success">
           
            <div class="box-body ">
			  
			
			<div class="form-group ">
                  <label>No Pinjaman</label>
                  <input type="text" name="ftLoan_No" id="ftLoan_No" class="form-control" placeholder="Input ..." value=<?php echo "$r[ftLoan_No]"; ?> readonly=true>
                </div>
			 <div class="form-group ">
                  <label>Plafon Pinjaman</label>
                  <input type="text" name="fcPlafond" id="fcPlafond" class="form-control" placeholder="Input ..." value=<?php echo "$plafonpinjaman"; ?> readonly=true>
                </div>
			
			
			 <div class="row ">
                <div class="col-xs-4 ">
				<label>Bunga / JW</label>
                  <input type="text" class="form-control" placeholder=".00" name="ffBunga" value=<?php echo "$r[ffBunga]"; ?> readonly=true>
                </div>
                <div class="col-xs-8">
				<label>&nbsp;</label>
                  <input type="text" class="form-control" placeholder=".00" name="fnJW" value=<?php echo "$r[fnJW]"; ?> readonly=true>
                </div>               
              </div></br>  

			<div class="form-group " >
                  <label>Saldo Akhir</label>
                  <input type="text" name="fcOutstanding" class="form-control" placeholder="Input ..." id="fcOutstanding" value=<?php echo "$saldoakhir"; ?> readonly=true>
			 </div>
			
			
			
            </div>
			
			
            <!-- /.box-body -->
          </div>
		  
		 
		  </div>
		  
		  <div class="col-md-6">
		  
		 <div class="box box-danger">
            <div class="box-body">
              
              
             
			   <div class="form-group">
				<label>Metode</label>
                  <input type="text" class="form-control" placeholder="Input ..." name="fnPaymentMethod" value="<?php 
				  if($r[fnPaymentMethod]==1){
				  echo "PELUNASAN"; 
				  }else{
					  echo "SETOR SENDIRI";  
				  }
				  ?>"  readonly=true>
                </div>
				
			   <div class="form-group">
				<label>Pokok</label>
                  <input type="text" class="form-control" placeholder="Input ..." name="fcPokokAngsuran" value=<?php echo "$pokok"; ?> readonly=true>
                </div>
			     <div class="form-group">
				<label>Bunga</label>
                  <input type="text" class="form-control" placeholder="Input ..." name="fcBunganAngsuran" value=<?php echo "$bunga"; ?> readonly=true>
                </div>
			  
			   <div class="form-group">
				<label>Adm</label>
                  <input type="text" class="form-control" placeholder="Input ..." name="fcAdmAngsuran" value=<?php echo "$adm"; ?> readonly=true>
                </div>
				 <div class="form-group">
				<label>Pblt</label>
                  <input type="text" class="form-control" placeholder="Input ..."  name="fcPbltAngsuran" value=<?php echo "$pblt"; ?> readonly=true>
                </div>
				 <div class="form-group">
				<label>Tabungan</label>
                  <input type="text" class="form-control" placeholder="Input ..."  name="fcTabAngsuran" value=<?php echo "$tabungan"; ?> readonly=true>
                </div>
				 <div class="form-group">
				<label>Jumlah</label>
                  <input type="text" class="form-control" placeholder="Input ..."  name="fcTotalAngsuran" value=<?php echo "$jumlah"; ?> readonly=true>
                </div>
				 <div class="form-group">
				<label>Potongan</label>
                  <input type="text" class="form-control" placeholder="Input ..." name="fcDiskon" value=<?php echo "$potongan"; ?> readonly=true>
                </div>
				 <div class="form-group">
				<label>Jumlah Dibayar</label>
                  <input type="text" class="form-control" placeholder="Input ..."  name="fcPayment" value=<?php echo "$jumlahdibayar"; ?> readonly=true>
                </div>
              
            </div>
            <!-- /.box-body -->
          </div>
		  
		 
		 

		  </div>
		  
		  </div>
		 </div> 
		  
	
     <!-- /.box-header -->
        <div class="box-body" >
	    <div class="row">
            <div class="col-md-6">
		 <div class="box-footer">
                <a  class="btn btn-default" href="pelunasan-mikro.html">Cancel</a>
             </div>	
			  <!-- /.form-group -->
            </div>
			 <!-- /.RIGHT SIDE -->
            <div class="col-md-6">
			 <div class="box-footer">
               <button type="submit" class="btn btn-info pull-right">Reject</button>
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
	//edit password
  
   }
   }
  ?>

