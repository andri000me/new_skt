<meta http-equiv="cache-control" content="no-cache">
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
       GENERAL JURNAL 
        
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
            <!--  <h3 class="box-title"><input type="button" onclick="location.href='<?php echo "tambah-general-jurnal.html ";?>';" value="Tambah" class="btn bg-purple btn-flat margin"/></h3>-->
			 <?php
			 }else{
				echo""; 
			 }
			?>	
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<div class="table-responsive" id="dg_jurnal_control">
			 <table   id="dg_jurnal" 
						class="easyui-datagrid"
						title="Data Jurnal" 
						style="width:auto; height: auto;" 
						
						url="<?php echo 'modul/general_jurnal/aksi_general_jurnal.php?module=general_jurnal&act=getdatajurnal&id='.$r[ftNoJurnal];?>" 
						pagination="true" rownumbers="true" 
						fitColumns="true" singleSelect="true" collapsible="true" showFooter="true"
						sortName="ftNoJurnal" sortOrder="DESC"
						toolbar="#tb_jurnal"
						striped="true">
					<thead>
						<tr>
							<th data-options="field:'fnid', sortable:'true',halign:'center', align:'center'" hidden="false">ID</th>
							<th data-options="field:'ftNoJurnal', width:'17', halign:'center', align:'center'">No Jurnal</th>
							<th data-options="field:'fdTglJurnal', width:'20', halign:'center', align:'center'">Tanggal</th>
							<th data-options="field:'ftNobukti', width:'30', halign:'center', align:'left'">No Bukti</th>
							<th data-options="field:'ftNotes',width:'20', halign:'center', align:'left'" >Keterangan</th>
							<th data-options="field:'fcDebit',width:'20', halign:'center', align:'left'" >Debit</th>
							<th data-options="field:'fcKredit',width:'20', halign:'center', align:'center'">Kredit</th>
						</tr>
						
					</thead>
					
					</table>
				<!-- Toolbar -->
				<div id="tb_jurnal" style="height: 35px;">
				   <div style="vertical-align: middle; display: inline; padding-top: 15px;">
					<a href="tambah-general-jurnal.html" class="easyui-linkbutton" iconCls="icon-add" plain="true" >Add </a>
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="update_jurnal()">Edit</a>
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="hapus_jurnal()">Hapus</a>
				   </div>	
				<div class="pull-right" style="vertical-align: middle;">
					<div class="input-group" style="display: inline;">
					<select id="getField" name="getField" style="width:195px; height:25px" class="easyui-validatebox" required="true">
						<option value="0"> -- Pilih Kategori --</option>	
						<?php       
					 $tampil=mysql_query("SELECT COLUMN_NAME field,
											CASE COLUMN_NAME 
											WHEN 'ftNoJurnal' THEN 'No Jurnal'
											WHEN 'fdTglJurnal' THEN 'Tgl Jurnal'
											WHEN 'ftNobukti' THEN 'No Bukti'
											WHEN 'fcDebit' THEN 'Debit'
											WHEN 'fcKredit' THEN 'Kredit'
											WHEN 'ftNotes' THEN 'Keterangan'
											END AS alias
											 FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='db_skt' AND 									TABLE_NAME = 'txjurnalumum' AND COLUMN_NAME NOT IN('fnid','fnStatus','ftCreated_User','fdCreated_date','ftModified_User','fdModified_date','ftBranchCode')");
							 while($r=mysql_fetch_array($tampil)){
					   echo "<option value='$r[field]'>$r[alias]</option>"; }
					?>
				    </select>	
					</div>
					
					<input name="search_jurnal" id="search_jurnal" size="20" placeholder="Search"style="line-height:25px;border:1px solid #ccc">
					<a href="javascript:void(0);" id="btn_filter" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Cari</a>
					
					<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-clear" plain="false" onclick="clearSearch()">Hapus Filter</a>
				</div>
			  </div>
		  </div>
		  <br>
		  <table   id="dg_jurnal_detail" 
						class="easyui-datagrid"
						title="Detail Jurnal" 
						style="width:auto; height: auto;" 
						
						pagination="true" rownumbers="true" 
						fitColumns="true" singleSelect="true" collapsible="true" collapsed="true"
						sortName="ftNoJurnal" sortOrder="DESC"
						toolbar="#tb_jurnal_detail"
						striped="true">
					<thead>
						<tr>
							<th data-options="field:'fnid', sortable:'true',halign:'center', align:'center'" hidden="false">ID</th>
							<th data-options="field:'ftNoJurnal', width:'17', halign:'center', align:'center'">No Jurnal</th>
							<th data-options="field:'ftKodePerkiraan', width:'20', halign:'center', align:'center'">Kode Perkiraan</th>
							<th data-options="field:'ftNamaPerkiraan', width:'30', halign:'center', align:'left'">Nama Perkiraan</th>
							<th data-options="field:'ftDebit',width:'20', halign:'center', align:'left'" >Debit</th>
							<th data-options="field:'ftKredit',width:'20', halign:'center', align:'center'">Kredit</th>
						</tr>
						
					</thead>
					
					</table>
				<!-- Toolbar -->
			<div id="tb_jurnal_detail" style="height: 35px;">
				<div style="vertical-align: middle; display: inline; padding-top: 15px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="create_detail()">Add </a>
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="update_detail()">Edit</a>
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="hapus_detail()">Hapus</a>
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
 <!--  Dialog Form -->			
<div id="dialog-form" class="easyui-dialog" show= "blind" hide= "blind" modal="true" resizable="false" style="width:370px; height:300px; padding-left:20px; padding-top:20px; " closed="true" buttons="#dialog-buttons" style="display: none;">
	<form id="form" method="post" novalidate>
		<table style="height:200px" >
			
			<tr style="height:35px">
				<td>Kode Perkiraan </td>
				<td>:</td>
				<td>
					<select id="ftKodePerkiraan" name="ftKodePerkiraan" style="width:195px; height:25px" class="easyui-validatebox" required="true">
					<option value="0"> -- Pilih Kode Perkiraan --</option>	
				   <?php       
					 $tampil=mysql_query("SELECT ftNamaPerkiraan,ftKodePerkiraan FROM tlnoperkiraan WHERE fnStatus =1 ");
					 	     while($r=mysql_fetch_array($tampil)){
					   echo "<option value='$r[ftKodePerkiraan]'>$r[ftKodePerkiraan]</option>"; }
					?>
                </select>	
				</td>	
			</tr>
			<tr style="height:35px">
				<td> Nama Perkiraan </td>
				<td>:</td>
				<td>
					<input  id="ftNamaPerkiraan" name="ftNamaPerkiraan"  style="width:195px; height:25px" readonly=true />
				</td>	
			</tr>
			<tr style="height:35px">
				<td>Debit</td>
				<td>:</td>
				<td>
				<input class="easyui-numberbox" id="ftDebit" name="ftDebit" data-options="precision:0,groupSeparator:',',decimalSeparator:'.'" class="easyui-validatebox" required="true" style="width:195px; height:25px"  />
				</td>
			</tr>
			<tr style="height:35px">
				<td>Kredit</td>
				<td>:</td>
				<td>
				<input class="easyui-numberbox" id="ftKredit" name="ftKredit" data-options="precision:0,groupSeparator:',',decimalSeparator:'.'" class="easyui-validatebox" required="true" style="width:195px; height:25px"  />		
				</td>
			</tr>
		</table>
	</form>
</div>

			<!-- Dialog Button -->
			<div id="dialog-buttons">
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">Simpan</a>
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Batal</a>
			</div>
 
<?php
    break;
 case "tambah":
	$tgl = date("d");
	$bln = date("m");
	$thn = date("Y");
	$thn2 = substr($thn, -2);
	$cariid=mysql_query("SELECT max(ftNoJurnal) as notrans FROM txjurnalumum");
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
   <div class="box box-default">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Input General Jurnal</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
	<form action="aksi-tambah-general-jurnal.html" method="post" name="frmJurnal" id="frmJurnal" class="form-horizontal" enctype="multipart/form-data" onSubmit="return validate(this)">
      <input id="idf" name="idf[]" value="1" type="hidden" />  
      <input id="id" value="1" type="hidden" />                
    <div class="box-body">  
       <div class="form-group">
            <label for="NamaLengkap" class="control-label col-xs-2">No Jurnal<span style="color:red;">*</span></label>
            <div class="col-xs-2">
              <input placeholder="No Jurnal" class="form-control " name="ftNoJurnal" type="text"  id="ftNoJurnal" value="<?php echo "JU$thn2$bln$unik2"; ?>" readonly=true />
            </div>
        </div> 
       
        <div class="form-group">
          <label for="NamaLengkap" class="control-label col-xs-2">Tanggal<span style="color:red;">*</span></label>
            <div class="col-xs-2">
                <div class="input-group date ">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar "></i>
                  </div>
                  <input placeholder="YYYY-MM-DD" type="text" class="form-control pull-right " value=""  name="fdTglJurnal" id="fdTglJurnal">
                </div>
             </div>
        </div> 
        
        <div class="form-group">
            <label for="NamaLengkap" class="control-label col-xs-2">No Bukti<span style="color:red;">*</span></label>
            <div class="col-xs-2">
                <input placeholder="No Bukti" class="form-control" name="ftNobukti" type="text"  id="ftNobukti" value=""  />
            </div>
        </div> 
        
        <div class="form-group">
            <label for="NamaLengkap" class="control-label col-xs-2">Keterangan<span style="color:red;">*</span></label>
            <div class="col-xs-8">
               <textarea name="ftNotes" class="form-control " id="ftNotes" placeholder="Keterangan" ></textarea>
            </div>
        </div> 
      </div>  
        
      <div class="form-group">
        <label for="NamaLengkap" class="control-label col-xs-2 ckeditor"></label>
          <div class="col-xs-9">
            <a class="btn btn-primary btn-sm"  onclick="addRincian();" ><i class="glyphicon glyphicon-plus"></i> Tambah Rincian</a> </div>
          </div>  
        
        <div id="divAkun"></div>
        
        <div class="form-group">
           <label class="control-label col-xs-2 ckeditor"></label>
           <div class="col-xs-9">
		        
                <a href='general-jurnal.html' class="btn btn-danger"><i class="glyphicon glyphicon-hand-left"></i>
                    Cancel
                </a>&nbsp;&nbsp;<button type="submit" class="btn btn-success pull-right"><i class="glyphicon glyphicon-floppy-disk"></i>
                    Simpan
                </button><br><br>
            </div>
		   </div>
		
      </form>
      </div>
      </div>
	<?php  		  
     break;
     case "edit":
	 $edit = mysql_query("SELECT * FROM txjurnalumum WHERE fnid='$_GET[fnid]'");
     $r    = mysql_fetch_array($edit);
      ?>
   <div class="box box-default">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Input General Jurnal</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
	<form action="aksi-edit-general-jurnal.html" method="post" name="frmJurnal" id="frmJurnal" class="form-horizontal" enctype="multipart/form-data" onSubmit="return validate(this)">
            
    <div class="box-body">  
       <div class="form-group">
            <label  class="control-label col-xs-2">No Jurnal<span style="color:red;">*</span></label>
            <div class="col-xs-2">
              <input placeholder="No Jurnal" class="form-control " name="ftNoJurnal" type="text"  id="ftNoJurnal" value="<?php echo $r['ftNoJurnal'] ?>"  readonly=true />
			  <input type="hidden" name="fnid" class="form-control" value="<?php echo $r['fnid'] ?>"  >
			  
            </div>
        </div> 
       
        <div class="form-group">
          <label class="control-label col-xs-2">Tanggal<span style="color:red;">*</span></label>
            <div class="col-xs-2">
                <div class="input-group date ">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar "></i>
                  </div>
                  <input placeholder="YYYY-MM-DD" type="text" class="form-control pull-right " value="<?php echo $r['fdTglJurnal'] ?>"  name="fdTglJurnal" id="fdTglJurnal">
                </div>
             </div>
        </div> 
        
        <div class="form-group">
            <label  class="control-label col-xs-2">No Bukti<span style="color:red;">*</span></label>
            <div class="col-xs-2">
                <input placeholder="No Bukti" class="form-control" name="ftNobukti" type="text"  id="ftNobukti" value="<?php echo $r['ftNobukti'] ?>"  />
            </div>
        </div> 
        
        <div class="form-group">
            <label class="control-label col-xs-2">Keterangan<span style="color:red;">*</span></label>
            <div class="col-xs-8">
               <textarea name="ftNotes" class="form-control " id="ftNotes" placeholder="Keterangan" ><?php echo $r['ftNotes'] ?></textarea>
            </div>
        </div> 
              
		
        <div id="showTable">
		<!-- Start Show Tabel-->	
		<div class="box-body">
		<div class="table-responsive" style="margin-left:235px;">
              <table   id="dg" 
						class="easyui-datagrid"
						title="Data Detail Jurnal" 
						style="width:90%; height: auto;" 
						url="<?php echo 'modul/general_jurnal/aksi_general_jurnal.php?module=general_jurnal&act=getdata&id='.$r[ftNoJurnal];?>" 
						pagination="true" rownumbers="true" 
						fitColumns="true" singleSelect="true" collapsible="true" showFooter="true"
						sortName="ftKodePerkiraan" sortOrder="DESC"
						toolbar="#tb"
						striped="true"
						>
					<thead>
						<tr>
							<th data-options="field:'fnid', sortable:'true',halign:'center', align:'center'" hidden="false">ID</th>
							<th data-options="field:'ftNoJurnal', width:'17', halign:'center', align:'center'">No Jurnal</th>
							<th data-options="field:'ftKodePerkiraan', width:'20', halign:'center', align:'center'">Kode Perkiraan</th>
							<th data-options="field:'ftNamaPerkiraan', width:'30', halign:'center', align:'left'">Nama Perkiraan</th>
							<th data-options="field:'ftDebit',width:'20', halign:'center', align:'left'" >Debit</th>
							<th data-options="field:'ftKredit',width:'20', halign:'center', align:'center'">Kredit</th>
						</tr>
						
					</thead>
					
					</table>
					
				<!-- Toolbar -->
			<div id="tb" style="height: 35px;">
				<div style="vertical-align: middle; display: inline; padding-top: 15px;">
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="create()">Add </a>
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="update()">Edit</a>
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="hapus()">Hapus</a>
				</div>
				
			</div>	
	      </div>			
	    </div>		
		<!-- End Show Tabel-->	
		</div>
        
        <div class="form-group">
           <label class="control-label col-xs-2 ckeditor"></label>
           <div class="col-xs-9">
                <a href='general-jurnal.html' class="btn btn-danger"><i class="glyphicon glyphicon-hand-left"></i>
                    Cancel
                </a>&nbsp;&nbsp;<button type="submit" class="btn btn-success pull-right"><i class="glyphicon glyphicon-floppy-disk"></i>
                    Update
                </button><br><br>
            </div>
		   </div>
		 </div>   
      </form>
      </div>
      </div>
	  
	  <!--  Dialog Form -->			
<div id="dialog-form" class="easyui-dialog" show= "blind" hide= "blind" modal="true" resizable="false" style="width:370px; height:300px; padding-left:20px; padding-top:20px; " closed="true" buttons="#dialog-buttons" style="display: none;">
	<form id="form" method="post" novalidate>
		<table style="height:200px" >
			
			<tr style="height:35px">
				<td>Kode Perkiraan </td>
				<td>:</td>
				<td>
					<select id="ftKodePerkiraan" name="ftKodePerkiraan" style="width:195px; height:25px" class="easyui-validatebox" required="true">
					<option value="0"> -- Pilih Kode Perkiraan --</option>	
				   <?php       
					 $tampil=mysql_query("SELECT ftNamaPerkiraan,ftKodePerkiraan FROM tlnoperkiraan WHERE fnStatus =1 ");
					 	     while($r=mysql_fetch_array($tampil)){
					   echo "<option value='$r[ftKodePerkiraan]'>$r[ftKodePerkiraan]</option>"; }
					?>
                </select>	
				</td>	
			</tr>
			<tr style="height:35px">
				<td> Nama Perkiraan </td>
				<td>:</td>
				<td>
					<input  id="ftNamaPerkiraan" name="ftNamaPerkiraan"  style="width:195px; height:25px" readonly=true />
				</td>	
			</tr>
			<tr style="height:35px">
				<td>Debit</td>
				<td>:</td>
				<td>
				<input class="easyui-numberbox" id="ftDebit" name="ftDebit" data-options="precision:0,groupSeparator:',',decimalSeparator:'.'" class="easyui-validatebox" required="true" style="width:195px; height:25px"  />
				</td>
			</tr>
			<tr style="height:35px">
				<td>Kredit</td>
				<td>:</td>
				<td>
				<input class="easyui-numberbox" id="ftKredit" name="ftKredit" data-options="precision:0,groupSeparator:',',decimalSeparator:'.'" class="easyui-validatebox" required="true" style="width:195px; height:25px"  />		
				</td>
			</tr>
		</table>
	</form>
</div>

			<!-- Dialog Button -->
			<div id="dialog-buttons">
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">Simpan</a>
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')">Batal</a>
			</div>
	  <?php
    break;  
	 }
   }
  ?>

<script>
function validate(form){
  if (form.ftNoJurnal.value == ""){
   sweetAlert("Oops...", "No Jurnal harus di isi!", "error");
   form.ftNoJurnal.focus();
    return (false);
  }else if (form.fdTglJurnal.value == ""){
   sweetAlert("Oops...", "Tanggal harus di isi!", "error");
   form.fdTglJurnal.focus();
    return (false);
  }else if (form.ftNobukti.value == ""){
   sweetAlert("Oops...", "No Bukti harus di isi!", "error");
   form.ftNobukti.focus();
    return (false);
  }else if (form.ftNotes.value == ""){
   sweetAlert("Oops...", "Keterangan harus di isi!", "error");
   form.ftNotes.focus();
    return (false);
  }     
}

function number_format (number, decimals, dec_point, thousands_sep) {
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
	prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
	sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
	dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
	s = '',
	toFixedFix = function (n, prec) {
	  var k = Math.pow(10, prec);
	  return '' + Math.round(n * k) / k;
	};
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
	s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
	s[1] = s[1] || '';
	s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}
		
function addRincian() {
	
	var max=10;
    var idf = document.getElementById("idf").value;
    var id = document.getElementById("id").value;
    var i = idf * 1;
    if(i <= max){
     
    stre="<div class='form-group'  id='srow" + idf + "'><div class='controls'>";
    stre=stre+"<label for='NamaLengkap' class='control-label col-xs-2 ckeditor'>"+ idf +"</label>";
    stre=stre+" <div class='col-xs-2'><div class='input-group'>";
    stre=stre+"<input type='text' class='form-control' name='ftKodePerkiraan[]' id='ftKodePerkiraan" + idf + "'  placeholder='Kode Perkiraan'  readonly><span class='input-group-addon '><a href='#' class='small-box-footer' onClick='showperkiraaan(\"" + idf + "\")'><b>SEARCH</b></a></span>";
    stre=stre+"</div></div>";
    stre=stre+" <div class='col-xs-2'>";
    stre=stre+"<input placeholder='Nama Perkiraan'  type='text' class='form-control ' name='ftNamaPerkiraan[]' id='ftNamaPerkiraan" + idf + "'  readonly/>";
    stre=stre+"</div>";
    stre=stre+" <div class='col-xs-2'>";
    stre=stre+"<input placeholder='Debet'  type='text' class='form-control ' name='ftDebit[]'   />";
    stre=stre+"</div>";
    stre=stre+" <div class='col-xs-2'>";
    stre=stre+"<input placeholder='Kredit'  type='text' class='form-control ' name='ftKredit[]'   />";
    stre=stre+"</div>";
 
    stre=stre+"<div class='col-xs-1'> <button type='button' class='btn btn-danger btn-sm' title='Hapus Rincian" +idf +" !' onclick='removeFormField(\"#srow" + idf + "\"); return false;'><i class='glyphicon glyphicon-remove'></i></button></div> </div>";
    $("#divAkun").append(stre);
     idf = (idf*1) + 1;
     document.getElementById("idf").value = idf;
    }
}
function removeFormField(idf) {
	window.parent.caches.delete(idf)
    $(idf).remove();
}
function showperkiraaan(idf) {
  var elements = document.getElementsByTagName("NamaLengkap");
  var id=  [];
  var id=  ["srow1","srow2","srow3","srow4","srow5","srow6","srow7","srow8","srow9","srow10"];
  var b = document.getElementById("idf").value * 1;
   console.log(idf);
for(var i = 0; i < id.length; i++){
    sList= window.open('modul/general_jurnal/formsearch.php?idf='+idf, 'Print', 'width=920,height=420,scrollbars=yes');
   }
}
$('#ftKodePerkiraan').change(function(){
		val_ftKodePerkiraan = $(this).val();
		$.ajax({
			url: 'modul/general_jurnal/aksi_general_jurnal.php?module=general_jurnal&act=getDataPerkiraan',
			type: 'POST',
			dataType: 'html',
			data: {ftKodePerkiraan: val_ftKodePerkiraan},
		})
		.done(function(result) {
		    $('#ftNamaPerkiraan').val(result)
		})
		.fail(function() {
			alert('Kesalahan Konekasi, silahkan ulangi beberapa saat lagi.');
		});		
	});
function create(){
		$("#dialog-form").dialog("open").dialog("setTitle","Tambah Data");
	    $('#form').form('clear');
		var ftNoJurnal=document.getElementById("ftNoJurnal").value;
	    $('#ftKodePerkiraan option[value="0"]').prop('selected', true);
		$('#ftNamaPerkiraan').val();
		$('#ftDebit ~ span input').keyup(function(){
			var val_ftDebit = $(this).val();
			$('#ftDebit').numberbox('setValue', number_format(val_ftDebit));
		});
		$('#ftKredit ~ span input').keyup(function(){
			var val_ftKredit = $(this).val();
			$('#ftKredit').numberbox('setValue', number_format(val_ftKredit));
		});
		url = "modul/general_jurnal/aksi_general_jurnal.php?module=general_jurnal&act=createrincian&ftNoJurnal="+ftNoJurnal 
}
function create_detail(){
		var row = jQuery('#dg_jurnal').datagrid('getSelected');
		if(row){
		var ftNoJurnal=row.ftNoJurnal;
		$("#dialog-form").dialog("open").dialog("setTitle","Tambah Data");
	    $('#form').form('clear');
		$('#ftKodePerkiraan option[value="0"]').prop('selected', true);
		$('#ftNamaPerkiraan').val();
		$('#ftDebit ~ span input').keyup(function(){
			var val_ftDebit = $(this).val();
			$('#ftDebit').numberbox('setValue', number_format(val_ftDebit));
		});
		$('#ftKredit ~ span input').keyup(function(){
			var val_ftKredit = $(this).val();
			$('#ftKredit').numberbox('setValue', number_format(val_ftKredit));
		});
		url = "modul/general_jurnal/aksi_general_jurnal.php?module=general_jurnal&act=createrincian&ftNoJurnal="+ftNoJurnal 
		}else {
			$.messager.show({
				title:'<div><i class="fa fa-warning"></i> Peringatan !</div>',
				msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Klik Data Jurnal terlebih dahulu </div>',
				timeout:2000,
				showType:'slide'
			});
	    }
}
function update_jurnal(){
		var row = jQuery('#dg_jurnal').datagrid('getSelected');
		if(row){
			document.location.href = "edit-general-jurnal-"+ row.fnid +".html";    
		}else {
			$.messager.show({
				title:'<div><i class="fa fa-warning"></i> Peringatan !</div>',
				msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Data harus dipilih terlebih dahulu </div>',
				timeout:2000,
				showType:'slide'
			});
	    }
	}
	function update(){
		var row = jQuery('#dg').datagrid('getSelected');
	    if(row){
			jQuery('#dialog-form').dialog('open').dialog('setTitle','Edit Data');
			jQuery('#form').form('load',row);
			
			$('#ftDebit ~ span input').keyup(function(){
			var val_ftDebit = $(this).val();
			$('#ftDebit').numberbox('setValue', number_format(val_ftDebit));
			});
			$('#ftKredit ~ span input').keyup(function(){
				var val_ftKredit = $(this).val();
				$('#ftKredit').numberbox('setValue', number_format(val_ftKredit));
			});
			url = 'modul/general_jurnal/aksi_general_jurnal.php?module=general_jurnal&act=updaterincian&fnid=' + row.fnid+'&ftNoJurnal='+row.ftNoJurnal;
		}else {
			$.messager.show({
				title:'<div><i class="fa fa-warning"></i> Peringatan !</div>',
				msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Data harus dipilih terlebih dahulu </div>',
				timeout:2000,
				showType:'slide'
			});
	    }
	}
function update_detail(){
		var row = jQuery('#dg_jurnal_detail').datagrid('getSelected');
		//console.log(row);
	    if(row){
			jQuery('#dialog-form').dialog('open').dialog('setTitle','Edit Data');
			jQuery('#form').form('load',row);
			
			$('#ftDebit ~ span input').keyup(function(){
			var val_ftDebit = $(this).val();
			$('#ftDebit').numberbox('setValue', number_format(val_ftDebit));
			});
			$('#ftKredit ~ span input').keyup(function(){
				var val_ftKredit = $(this).val();
				$('#ftKredit').numberbox('setValue', number_format(val_ftKredit));
			});
			url = 'modul/general_jurnal/aksi_general_jurnal.php?module=general_jurnal&act=updaterincian&fnid=' + row.fnid+'&ftNoJurnal='+row.ftNoJurnal;
		}else {
			$.messager.show({
				title:'<div><i class="fa fa-warning"></i> Peringatan !</div>',
				msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Data harus dipilih terlebih dahulu </div>',
				timeout:2000,
				showType:'slide'
			});
	    }
	}	
function save() {
		var string = $("#form").serialize();
		var ftKodePerkiraan = $("#ftKodePerkiraan").val();
		if(ftKodePerkiraan == 0) {
			$.messager.show({
				title:'<div><i class="fa fa-warning"></i> Peringatan ! </div>',
				msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Kode Perkiraan belum dipilih.</div>',
				timeout:2000,
				showType:'slide'
			});
			$("#ftKodePerkiraan").focus();
			return false;
		}
		//console.log(string);
		var isValid = $('#form').form('validate');
		if (isValid) {
			$.ajax({
				type	: "POST",
				url: url,
				data	: string,
				success	: function(result){
					var result = eval('('+result+')');
					$.messager.show({
						title:'<div><i class="fa fa-info"></i> Informasi</div>',
						msg: result.msg,
						timeout:2000,
						showType:'slide'
					});
					if(result.ok) {
						jQuery('#dialog-form').dialog('close');
						//clearSearch();
						$('#dg').datagrid('reload');
						$('#dg_jurnal_detail').datagrid('reload');
						$('#dg_jurnal').datagrid('reload');
					}
				}
			});
		} else {
			$.messager.show({
				title:'<div><i class="fa fa-info"></i> Informasi</div>',
				msg: 'Silahkan lengkapi data.',
				timeout:2000,
				showType:'slide'
			});
		}
	}

function hapus_detail (){  
		var row = $('#dg_jurnal_detail').datagrid('getSelected');  
		if (row){ 
			$.messager.confirm('Konfirmasi','Apakah Anda akan menghapus data kode perkiraan : <code>' + row.ftKodePerkiraan + '</code> ?',function(r){  
				if (r){  
					$.ajax({
						type	: "POST",
						url		: "modul/general_jurnal/aksi_general_jurnal.php?module=general_jurnal&act=deleterincian&fnid="+row.fnid+'&ftNoJurnal='+row.ftNoJurnal,
						
						success	: function(result){
							var result = eval('('+result+')');
							$.messager.show({
								title:'<div><i class="fa fa-info"></i> Informasi</div>',
								msg: result.msg,
								timeout:2000,
								showType:'slide'
							});
							if(result.ok) {
								$('#dg_jurnal_detail').datagrid('reload');
							}
						},
						error : function (){
							$.messager.show({
								title:'<div><i class="fa fa-warning"></i> Peringatan !</div>',
								msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Terjadi kesalahan koneksi, silahkan muat ulang !</div>',
								timeout:2000,
								showType:'slide'
							});
						}
					});  
				}  
			}); 
		}  else {
			$.messager.show({
				title:'<div><i class="fa fa-warning"></i> Peringatan !</div>',
				msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Data harus dipilih terlebih dahulu </div>',
				timeout:2000,
				showType:'slide'
			});	
		}
		$('.messager-button a:last').focus();
	}
	
function hapus_jurnal(){  
		var row = $('#dg_jurnal').datagrid('getSelected');  
		if (row){ 
			$.messager.confirm('Konfirmasi','Apakah Anda akan menghapus data : <code>' + row.ftNoJurnal + '</code> ?',function(r){  
				if (r){  
					$.ajax({
						type	: "POST",
						url		: "aksi-delete-general-jurnal-"+row.fnid+".html",
						
						success	: function(result){
							var result = eval('('+result+')');
							$.messager.show({
								title:'<div><i class="fa fa-info"></i> Informasi</div>',
								msg: result.msg,
								timeout:2000,
								showType:'slide'
							});
							if(result.ok) {
								$('#dg_jurnal').datagrid('reload');
							}
						},
						error : function (){
							$.messager.show({
								title:'<div><i class="fa fa-warning"></i> Peringatan !</div>',
								msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Terjadi kesalahan koneksi, silahkan muat ulang !</div>',
								timeout:2000,
								showType:'slide'
							});
						}
					});  
				}  
			}); 
		}  else {
			$.messager.show({
				title:'<div><i class="fa fa-warning"></i> Peringatan !</div>',
				msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Data harus dipilih terlebih dahulu </div>',
				timeout:2000,
				showType:'slide'
			});	
		}
		$('.messager-button a:last').focus();
	}	
function hapus(){  
		var row = $('#dg').datagrid('getSelected');  
		if (row){ 
			$.messager.confirm('Konfirmasi','Apakah Anda akan menghapus data kode perkiraan : <code>' + row.ftKodePerkiraan + '</code> ?',function(r){  
				if (r){  
					$.ajax({
						type	: "POST",
						url		: "modul/general_jurnal/aksi_general_jurnal.php?module=general_jurnal&act=deleterincian&fnid="+row.fnid+'&ftNoJurnal='+row.ftNoJurnal,
						
						success	: function(result){
							var result = eval('('+result+')');
							$.messager.show({
								title:'<div><i class="fa fa-info"></i> Informasi</div>',
								msg: result.msg,
								timeout:2000,
								showType:'slide'
							});
							if(result.ok) {
								$('#dg').datagrid('reload');
							}
						},
						error : function (){
							$.messager.show({
								title:'<div><i class="fa fa-warning"></i> Peringatan !</div>',
								msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Terjadi kesalahan koneksi, silahkan muat ulang !</div>',
								timeout:2000,
								showType:'slide'
							});
						}
					});  
				}  
			}); 
		}  else {
			$.messager.show({
				title:'<div><i class="fa fa-warning"></i> Peringatan !</div>',
				msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Data harus dipilih terlebih dahulu </div>',
				timeout:2000,
				showType:'slide'
			});	
		}
		$('.messager-button a:last').focus();
	}
	
function doSearch(){
	var e = document.getElementById("getField");
	var getField = e.options[e.selectedIndex].value;
	if(getField != 0){
		$('#dg_jurnal').datagrid('load',{
		getField : e.options[e.selectedIndex].value,
		search_jurnal  : $('input[name=search_jurnal]').val()
	});
	}else{
		$.messager.show({
				title:'<div><i class="fa fa-warning"></i> Peringatan !</div>',
				msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Silahkan pilih kategori searching terlebih dahulu </div>',
				timeout:2000,
				showType:'slide'
			});	
	}
}
	
function clearSearch(){
	location.reload();
//	$('#dg_jurnal').datagrid('reload');
}	
	
$( document ).ready(function() {
	var input = document.getElementById("search_jurnal");
	
	if(input != null){
	input.addEventListener("keyup", function(event) {
	  if (event.keyCode === 13) {
	   event.preventDefault();
	   document.getElementById("btn_filter").click();
	  }
	});	
	}	
	
	 $('#dg_jurnal').datagrid({
		onClickRow: function(){
			var row = $(this).datagrid('getSelected');  
			var p =$('#dg_jurnal_detail').datagrid('getPanel').panel('expand',true);
			$('#dg_jurnal_detail').datagrid(
				'load', 'modul/general_jurnal/aksi_general_jurnal.php?module=general_jurnal&act=getdata&id='+row.ftNoJurnal
			);
		},
		onDblClickRow: function(){
		//	console.log('dblclick row')
		}
	
	});
	$('#dg_jurnal_detail').datagrid({
			onDblClickRow: function(){
			var row = jQuery('#dg_jurnal_detail').datagrid('getSelected');	
			jQuery('#dialog-form').dialog('open').dialog('setTitle','Edit Data');
			jQuery('#form').form('load',row);
			
			$('#ftDebit ~ span input').keyup(function(){
			var val_ftDebit = $(this).val();
			$('#ftDebit').numberbox('setValue', number_format(val_ftDebit));
			});
			$('#ftKredit ~ span input').keyup(function(){
				var val_ftKredit = $(this).val();
				$('#ftKredit').numberbox('setValue', number_format(val_ftKredit));
			});
			url = 'modul/general_jurnal/aksi_general_jurnal.php?module=general_jurnal&act=updaterincian&fnid=' + row.fnid+'&ftNoJurnal='+row.ftNoJurnal;
					
				}
			
            });		
	$('#dg_jurnal').datagrid({
			onDblClickRow: function(){
			var row = jQuery('#dg_jurnal').datagrid('getSelected');
				document.location.href = "edit-general-jurnal-"+ row.fnid +".html";   
			}
			
            });		
    $('#dg').datagrid({
			onDblClickRow: function(){
			var row = jQuery('#dg').datagrid('getSelected');	
			jQuery('#dialog-form').dialog('open').dialog('setTitle','Edit Data');
			jQuery('#form').form('load',row);
			
			$('#ftDebit ~ span input').keyup(function(){
			var val_ftDebit = $(this).val();
			$('#ftDebit').numberbox('setValue', number_format(val_ftDebit));
			});
			$('#ftKredit ~ span input').keyup(function(){
				var val_ftKredit = $(this).val();
				$('#ftKredit').numberbox('setValue', number_format(val_ftKredit));
			});
			url = 'modul/general_jurnal/aksi_general_jurnal.php?module=general_jurnal&act=updaterincian&fnid=' + row.fnid+'&ftNoJurnal='+row.ftNoJurnal;
					
				}
			
            });	
			
	
	
 	});
	
</script>