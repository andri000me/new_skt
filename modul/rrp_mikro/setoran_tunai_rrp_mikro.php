<script src="plugins/jQuery/jquery-2.2.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>


 <style>
	.custom-combobox {
		position: relative;
		display: inline-block;
	}
	.custom-combobox-toggle {
		position: absolute;
		top: 0;
		bottom: 0;
		margin-left: -1px;
		padding: 0;
	}
	.custom-combobox-input {
		margin: 0;
		padding: 5px 10px;
	}
	</style>
<style type="text/css">
td, div { 
	font-family: "Arial","​Helvetica","​sans-serif";
}
.datagrid-header-row * {
	font-weight: bold;
}
.messager-window * a:focus, .messager-window * span:focus {
	color: blue;
	font-weight: bold;
}
.daterangepicker * {
	font-family: "Source Sans Pro","Arial","​Helvetica","​sans-serif";
	box-sizing: border-box;
}
.glyphicon	{
	font-family: "Glyphicons Halflings"
}
</style>

<?php

//cek hak akses user
//$cek=user_akses($_GET[module],$_SESSION[sessid]);
if(!empty($_SESSION['leveluser'])){  
$base_url = $_SERVER['HTTP_HOST'];
$iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
$aksi="modul/users/aksi_users.php";

// buaat tanggal sekarang
$tanggal = date('Y-m-d H:i');

switch($_GET[act]){
  // Tampil Hubungi Kami
  default:
   ?>
   
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       TRANSAKSI SETORAN RRP MIKRO 
        
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
              <table   id="dg" 
						class="easyui-datagrid"
						title="Data Transaksi Setoran RRP Mikro" 
						style="width:auto; height: auto;" 
						url="getdata-setoran-tunai-rrp-mikro.html" 
						pagination="true" rownumbers="true" 
						fitColumns="true" singleSelect="true" collapsible="true"
						sortName="tgl_transaksi" sortOrder="DESC"
						toolbar="#tb"
						striped="true">
					<thead>
						<tr>
							<th data-options="field:'id', sortable:'true',halign:'center', align:'center'" hidden="true">ID</th>
							<th data-options="field:'id_txt', width:'17', halign:'center', align:'center'">Kode Transaksi</th>
							<th data-options="field:'tgl_transaksi',halign:'center', align:'center'" hidden="true">Tanggal</th>
							<th data-options="field:'tgl_transaksi_txt', width:'25', halign:'center', align:'center'">Tanggal Transaksi</th>
							<th data-options="field:'rek', width:'35',halign:'center', align:'left'">No Rek Anggota</th>
							<th data-options="field:'nama', width:'35',halign:'center', align:'left'">Nama Anggota</th>
							<th data-options="field:'wilayah', width:'35',halign:'center', align:'left'">Wilayah</th>
							<th data-options="field:'kelompok', width:'35',halign:'center', align:'left'">Kelompok</th>
							<!-- <th data-options="field:'kas_id', width:'15',halign:'center', align:'left'" hidden="true">Simpan ke Kas</th>
							<th data-options="field:'kas_id_txt', width:'15',halign:'center', align:'left'">Simpan ke Kas</th> -->
							<!-- <th data-options="field:'jenis_id',halign:'center', align:'center'" hidden="true">Jenis</th>
							<th data-options="field:'jenis_id_txt', width:'20',halign:'center', align:'left'">Jenis Simpanan</th> -->
							<th data-options="field:'jumlah', width:'15', halign:'center', align:'right'">Jumlah</th>
							<th data-options="field:'ket', width:'15', halign:'center', align:'left'" hidden="true">Keterangan</th>
							<th data-options="field:'user', width:'15', halign:'center', align:'center'">User </th>
							<th data-options="field:'kas_id',halign:'center', align:'center'" hidden="true">Jenis Kas</th>
							<th data-options="field:'nama_penyetor',halign:'center', align:'center'" hidden="true">Nama Penyetor</th>
							<th data-options="field:'no_identitas',halign:'center', align:'center'" hidden="true">No. Identitas</th>
							<th data-options="field:'alamat',halign:'center', align:'center'" hidden="true">alamat</th>
							<th data-options="field:'nota', halign:'center', align:'center'">Cetak Nota</th>
						</tr>
					</thead>
					</table>
					
				<!-- Toolbar -->
			<div id="tb" style="height: 35px;">
				<div style="vertical-align: middle; display: inline; padding-top: 15px;">
					<button class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="create()">Tambah </button>
					<button class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="update()">Edit</button>
					<button class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="hapus()">Hapus</button>
				</div>
				<div class="pull-right" style="vertical-align: middle;">
					<div id="filter_tgl" class="input-group" style="display: inline;">
						<button class="btn btn-default" id="daterange-btn" style="line-height:16px;border:1px solid #ccc">
							<i class="fa fa-calendar"></i> <span id="reportrange"><span>Pilih Tanggal</span></span>
							<i class="fa fa-caret-down"></i>
						</button>
					</div>
					
					<span>Cari :</span>
					<input name="kode_transaksi" id="kode_transaksi" size="20" placeholder="[Kode Transaksi]"style="line-height:25px;border:1px solid #ccc">
					<a href="javascript:void(0);" id="btn_filter" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Cari</a>
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="cetak()">Cetak Laporan</a>
					<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-clear" plain="false" onclick="clearSearch()">Hapus Filter</a>
				</div>
			</div>	
<!--  Dialog Form -->			
<div id="dialog-form" class="easyui-dialog" show= "blind" hide= "blind" modal="true" resizable="false" style="width:480px; height:520px; padding-left:20px; padding-top:20px; " closed="true" buttons="#dialog-buttons" style="display: none;">
	<form id="form" method="post" novalidate>
	
					<table>
						<tr style="height:35px">
							<td>Tanggal Transaksi </td>
							<td>:</td>
							<td>
								<div class="input-group date dtpicker col-md-5" style="z-index: 9999 !important;">
									<input type="text" name="tgl_transaksi_txt" id="tgl_transaksi_txt" style="width:150px; height:25px" required="true" readonly="readonly" />
									<input type="hidden" name="tgl_transaksi" id="tgl_transaksi" />
									<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
								</div>
							</td>	
						</tr>
						
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

					   	<?php
						//	$tgl_sekarang = date("Y-m-d H:i:s");
							$tgl = date("d");
							$bln = date("m");
							$thn = date("Y");
							$thn2 = substr($thn, -2);
							$no = "0001";

							$cariid=mysql_query("SELECT max(ftTrans_No) as notrans FROM tbl_trans_rrp");
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

						<tr style="height:35px;display:;" >
							<td>No Transaksi</td>
							<td>:</td>
							<td>
								<input type="text" id="notrans" name="notrans" style="width:190px; height:20px" >
							</td>	
						</tr>

						<!-- <tr style="height:40px">
							<td><label for="type">Identitas Penyetor</label></td>
						</tr>
						<tr style="height:35px">
							<td> Nama Penyetor</td>
							<td>:</td>
							<td>
								<input id="nama_penyetor" name="nama_penyetor" style="width:190px; height:20px" class="easyui-validatebox " required="true">
							</td>	
						</tr>
						<tr style="height:35px">
							<td>Nomor Identitas</td>
							<td>:</td>
							<td>
								<input id="no_identitas" name="no_identitas" style="width:190px; height:20px" class="easyui-validatebox " required="true">
							</td>	
						</tr>
						<tr style="height:35px">
							<td>Alamat</td>
							<td>:</td>
							<td>
								<textarea name="alamat" cols="30" rows="1" style="width:190px;" id="alamat" name="alamat" class="easyui-validatebox " required="true"></textarea>
							</td>	
						</tr>
						<tr style="height:40px">
							<td colspan="2"><label for="type">Identitas Penerima</label></td>
						</tr> -->
						
						<tr id="temp_wilayah" style="height:35px;">
							<td>Wilayah</td>
							<td>:</td>
							<td>
								<select id="wilayah" name="wilayah" style="width:195px; height:25px" class="easyui-validatebox " required="true">
									<option value="0"> -- Pilih Wilayah --</option>
									<?php       
                             $tampil=mysql_query("SELECT ftNamaWilayah,ftKodeWilayah FROM tlwilayah WHERE fnStatus =1 ORDER BY ftNamaWilayah DESC");
                            
                               while($r=mysql_fetch_array($tampil)){
                               echo "<option value='$r[ftKodeWilayah]'>$r[ftNamaWilayah]</option>"; }
                               ?>
								</select>
							</td>	
						</tr>
						<tr id="temp_kelompok" style="height:35px">
							<td>Kelompok</td>
							<td>:</td>
							<td>
								<select id="ftKodeKelompok" name="ftKodeKelompok" style="width:195px; height:25px" class="easyui-validatebox " required="true">
									<option value="0"> -- Pilih Kelompok --</option>
									
								</select>
							</td>	
						</tr>
					
						<tr id="temp_anggota" style="height:35px">
							<td>Nama Anggota</td>
							<td>:</td>
							<td>
								<input id="anggota_id" name="anggota_id" style="width:195px; height:25px" class="easyui-combogrid" class="easyui-validatebox" required="true" >
								
							</td>	
						</tr>
						<tr id="temp_anggota2" style="height:35px;display:none">
							<td>Nama Anggota</td>
							<td>:</td>
							<td>
								<input id="anggota_id_txt" name="anggota_id_txt" style="width:195px; height:25px"  >
							</td>	
						</tr>
						
						<!-- <tr style="height:35px">
							<td>Jenis Simpanan</td>
							<td>:</td>
							<td>
								<select id="jenis_id" name="jenis_id" style="width:195px; height:25px" class="easyui-validatebox " required="true">
									<option value="0"> -- Pilih Simpanan --</option>
									<?php       
									 $tampil=mysql_query("SELECT id,jns_simpan,jumlah FROM jns_simpan WHERE tampil ='Y' ");
											 while($r=mysql_fetch_array($tampil)){
									   echo "<option value='$r[id]'>$r[jns_simpan]</option>"; }
									?>
								</select>
							</td>	
						</tr> -->
						<tr style="height:35px">
							<td>Jumlah RRP</td>
							<td>:</td>
							<td>
								<input class="easyui-numberbox" id="jumlah" name="jumlah" data-options="precision:0,groupSeparator:',',decimalSeparator:'.'" class="easyui-validatebox" required="true" style="width:195px; height:25px"  />
							</td>	
						</tr>
						<tr style="height:35px">
							<td>Keterangan</td>
							<td>:</td>
							<td>
								<input id="ket" name="ket" style="width:190px; height:20px" >
							</td>	
						</tr>
						<tr style="height:35px">
							<td>Simpan Ke Kas</td>
							<td>:</td>
							<td>
								<select id="kas" name="kas_id" style="width:195px; height:25px" class="easyui-validatebox" required="true">
									<option value="0"> -- Pilih Kas --</option>			
									<?php       
									 $tampil=mysql_query("SELECT id,nama FROM nama_kas_tbl WHERE aktif ='Y' ");
											 while($r=mysql_fetch_array($tampil)){
									   echo "<option value='$r[id]'>$r[nama]</option>"; }
									?>
								</select>
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


	


<script>
var url;
	$(document).ready(function() {
	
	$('#wilayah').change(function(){
		 var wilayah = $("#wilayah").val();
			$.ajax({
			type: "GET", 	
			url: "modul/rrp_mikro/showkelompok.php?wilayah="+wilayah,
		//	data: "wilayah="+wilayah,
		//	dataType: 'json',
			cache: false,
			success: function(msg){
			$("#ftKodeKelompok").html(msg);
			}
		});
	 });
	 
	 $('#ftKodeKelompok').change(function(){
		var kelompok = $("#ftKodeKelompok").val();
		$('#anggota_id').combogrid({
		panelWidth:400,
		url: 'modul/rrp_mikro/aksi_setoran_tunai_rrp_mikro.php?module=setoran_tunai_rrp_mikro&act=getDataAnggota&kel='+kelompok,
		idField:'id',
		valueField:'id',
		textField:'nama',
		mode:'remote',
		fitColumns:true,
		columns:[[
		{field:'id',title:'ID', hidden: true},
		{field:'kode_anggota', title:'ID', align:'center', width:15},
		{field:'nama',title:'Nama Anggota',align:'left',width:15},
		{field:'kota',title:'Kota',align:'left',width:10}
		]],
		onSelect: function(record){
			var val_anggota_id = $('input[name=anggota_id]').val();
			$('#anggota_id2').val(val_anggota_id);
			
			$.ajax({
				url: 'modul/rrp_mikro/aksi_setoran_tunai_rrp_mikro.php?module=setoran_tunai_rrp_mikro&act=getDataAnggota_id&anggota=' + val_anggota_id,
				type: 'POST',
				dataType: 'html',
				data: {anggota_id: val_anggota_id},
			})
			.done(function(result) {
				
				$('#anggota_poto').html(result);
			})
			.fail(function() {
				alert('Koneksi error, silahkan ulangi.')
			});
		}
	});
	 });
	
	
	$('#jenis_id').change(function(){
		val_jenis_id = $(this).val();
		$.ajax({
			url: 'getdata-jenis.html',
			type: 'POST',
			dataType: 'html',
			data: {jenis_id: val_jenis_id},
		})
		.done(function(result) {
			$('#jumlah').numberbox('setValue', result);
			$('#jumlah ~ span input').focus();
			$('#jumlah ~ span input').select();	
		})
		.fail(function() {
			alert('Kesalahan Konekasi, silahkan ulangi beberapa saat lagi.');
		});		
	});
	 
 	
	$('.dtpicker').datepicker({format: "yyyy-mm-dd",showAnim:"drop",autoclose: true});
		
	$("#kode_transaksi").keyup(function(event){
			if(event.keyCode == 13){
				$("#btn_filter").click();
			}
		});
		
	$("#kode_transaksi").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});
	fm_filter_tgl();	
	}); // ready
	
	function fm_filter_tgl() {
	$('#daterange-btn').daterangepicker({
		ranges: {
			'Hari ini': [moment(), moment()],
			'Kemarin': [moment().subtract('days', 1), moment().subtract('days', 1)],
			'7 Hari yang lalu': [moment().subtract('days', 6), moment()],
			'30 Hari yang lalu': [moment().subtract('days', 29), moment()],
			'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
			'Bulan kemarin': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
			'Tahun ini': [moment().startOf('year').startOf('month'), moment().endOf('year').endOf('month')],
			'Tahun kemarin': [moment().subtract('year', 1).startOf('year').startOf('month'), moment().subtract('year', 1).endOf('year').endOf('month')]
		},
		showDropdowns: true,
		format: 'YYYY-MM-DD',
		startDate: moment().startOf('year').startOf('month'),
		endDate: moment().endOf('year').endOf('month')
	},
		function(start, end) {
			$('#reportrange span').html(start.format('D MMM YYYY') + ' - ' + end.format('D MMM YYYY'));
			doSearch();
		});
	}

	function doSearch(){
			$('#dg').datagrid('load',{
			kode_transaksi: $('#kode_transaksi').val(),
			tgl_dari: 	$('input[name=daterangepicker_start]').val(),
			tgl_sampai: $('input[name=daterangepicker_end]').val()
		});
	}
	
	function clearSearch(){
		location.reload();
	}
			
	function cetak () {
		var kode_transaksi 	= $('#kode_transaksi').val();
		var tgl_dari			= $('input[name=daterangepicker_start]').val();
		var tgl_sampai			= $('input[name=daterangepicker_end]').val();

		var win = window.open('modul/rrp_mikro/aksi_setoran_tunai_rrp_mikro.php?module=setoran_tunai_rrp_mikro&act=cetak&kode_transaksi=' + kode_transaksi + '&tgl_dari=' + tgl_dari + '&tgl_sampai=' + tgl_sampai);
		if (win) {
			win.focus();
		} else {
			alert('Popup jangan di block');
		}
	}
	
	
	
	function create(){
		$('#dialog-form').dialog('open').dialog('setTitle','Tambah Data');
		$('#form').form('clear');
		$('#anggota_id ~ span span a').show();
		$('#anggota_id ~ span input').removeAttr('disabled');
		$('#anggota_id ~ span input').focus();
		
		$('#tgl_transaksi_txt').val('<?php echo $tanggal;?>');
		$('#tgl_transaksi').val('<?php echo $tanggal;?>');
		$('#wilayah option[value="0"]').prop('selected', true);
		$('#ftKodeKelompok option[value="0"]').prop('selected', true);
		$('#kas option[value="0"]').prop('selected', true);
		$('#jenis_id option[value="0"]').prop('selected', true);
		$('#jumlah ~ span input').keyup(function(){
			var val_jumlah = $(this).val();
			$('#jumlah').numberbox('setValue', number_format(val_jumlah));
		});
		url = "modul/rrp_mikro/aksi_setoran_tunai_rrp_mikro.php?module=setoran_tunai_rrp_mikro&act=create" 
		
	}
	
	function update(){
		var row = jQuery('#dg').datagrid('getSelected');
		if(row){
			jQuery('#dialog-form').dialog('open').dialog('setTitle','Edit Data Setoran');
			jQuery('#form').form('load',row);
			$('#temp_wilayah').css("display","none");
			$('#temp_kelompok').css("display","none")
			$('#temp_anggota').css("display","none")	
			$('#temp_anggota2').css("display","")	
			$('#anggota_id_txt').attr('disabled', true);
			url = 'modul/rrp_mikro/aksi_setoran_tunai_rrp_mikro.php?module=setoran_tunai_rrp_mikro&act=update&id=' + row.id;
			$('#jumlah ~ span input').keyup(function(){
				var val_jumlah = $(this).val();
				$('#jumlah').numberbox('setValue', number_format(val_jumlah));
			});
			
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
		var wilayah = $("#wilayah").val();
		if(wilayah == 0) {
			$.messager.show({
				title:'<div><i class="fa fa-warning"></i> Peringatan ! </div>',
				msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Wilayah belum dipilih.</div>',
				timeout:2000,
				showType:'slide'
			});
			$("#wilayah").focus();
			return false;
		}
		var ftKodeKelompok = $("#ftKodeKelompok").val();
		if(ftKodeKelompok == 0) {
			$.messager.show({
				title:'<div><i class="fa fa-warning"></i> Peringatan ! </div>',
				msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Kelompok belum dipilih.</div>',
				timeout:2000,
				showType:'slide'
			});
			$("#ftKodeKelompok").focus();
			return false;
		}
		var kas = $("#kas").val();
		var akun_id = $("#akun_id").val();
		if(kas == 0) {
			$.messager.show({
				title:'<div><i class="fa fa-warning"></i> Peringatan ! </div>',
				msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Simpan Ke Kas belum dipilih.</div>',
				timeout:2000,
				showType:'slide'
			});
			$("#kas").focus();
			return false;
		}

		if(akun_id == 0) {
			$.messager.show({
				title:'<div><i class="fa fa-warning"></i> Peringatan ! </div>',
				msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Jenis Akun belum dipilih.</div>',
				timeout:2000,
				showType:'slide'
			});
			$("#akun_id").focus();
			return false;
		}

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
					}
				}
			});
		} else {
			$.messager.show({
				title:'<div><i class="fa fa-info"></i> Informasi</div>',
				msg: '<div class="text-red"><i class="fa fa-ban"></i> Maaf, Lengkapi seluruh pengisian data.</div>',
				timeout:2000,
				showType:'slide'
			});
		}
	}
				
	function hapus(){  
		var row = $('#dg').datagrid('getSelected');  
		if (row){ 
			$.messager.confirm('Konfirmasi','Apakah Anda akan menghapus data kode transaksi : <code>' + row.id_txt + '</code> ?',function(r){  
				if (r){  
					$.ajax({
						type	: "POST",
						url		: "modul/rrp_mikro/aksi_setoran_tunai_rrp_mikro.php?module=setoran_tunai_rrp_mikro&act=delete&id="+row.id,
						
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
	
</script> 	
  	
<?php     
     break;
	
    }
  }
?>	





