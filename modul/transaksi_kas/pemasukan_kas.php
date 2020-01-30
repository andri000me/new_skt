
<link rel="stylesheet" type="text/css" href="assets/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="assets/easyui/themes/icon.css">
<script type="text/javascript" src="js/pemisah_angka.js"></script>
<script src="js/jquery-1.8.3.min.js"></script>

<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="js/number_format.js"></script>		

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
$cek=user_akses($_GET[module],$_SESSION[sessid]);
//if($cek==1 OR $_SESSION[leveluser]=='1' || $_SESSION[leveluser]=='2'  || $_SESSION[leveluser]=='3' || $_SESSION[leveluser]=='4' || $_SESSION[leveluser]=='5'  || $_SESSION[leveluser]=='6' || $_SESSION[leveluser]=='7'){
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
       PEMASUKAN KAS TUNAI 
        
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
						title="Data Transaksi Pemasukan Kasbon" 
						style="width:auto; height: auto;" 
						url="modul/transaksi_kas/aksi_pemasukan_kas.php?module=transaksi_kas&act=getdata" 
						pagination="true" rownumbers="true" 
						fitColumns="true" singleSelect="true" collapsible="true"
						sortName="tgl_catat" sortOrder="DESC"
						toolbar="#tb"
						striped="true">
					<thead>
						<tr>
							<th data-options="field:'id', sortable:'true',halign:'center', align:'center'" hidden="false">ID</th>
							<th data-options="field:'id_txt', width:'17', halign:'center', align:'center'">Kode Transaksi</th>
							<th data-options="field:'tgl_transaksi',halign:'center', align:'center'" hidden="true">Tanggal</th>
							<th data-options="field:'tgl_transaksi_txt', width:'20', halign:'center', align:'center'">Tanggal Transaksi</th>
							<th data-options="field:'ket', width:'30', halign:'center', align:'left'">Uraian</th>
							<th data-options="field:'kas_id',width:'20', halign:'center', align:'center'" hidden="true" >Untuk Kas</th>
							<th data-options="field:'kas_id_txt',width:'20', halign:'center', align:'left'" >Untuk Kas</th>
							<th data-options="field:'akun_id',width:'20', halign:'center', align:'center'" hidden="true">Dari Akun</th>
							<th data-options="field:'akun_id_txt',width:'20', halign:'center', align:'center'">Dari Akun</th>
							<th data-options="field:'jumlah', width:'15', halign:'center', align:'right'">Jumlah</th>
							<th data-options="field:'user', width:'15', halign:'center', align:'center'">User </th>
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
<div id="dialog-form" class="easyui-dialog" show= "blind" hide= "blind" modal="true" resizable="false" style="width:370px; height:300px; padding-left:20px; padding-top:20px; " closed="true" buttons="#dialog-buttons" style="display: none;">
	<form id="form" method="post" novalidate>
		<table style="height:200px" >
			<tr style="height:35px">
				<td>Tanggal Transaksi </td>
				<td>:</td>
				<td>
					<div class="input-group date dtpicker col-md-5" style="z-index: 9999 !important;">
						<input type="text" name="tgl_transaksi" id="tgl_transaksi_txt" style="width:150px; height:25px" required="true" readonly="readonly" />
						
						<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
					</div>
				</td>	
			</tr>
			<tr style="height:35px">
				<td>Jumlah </td>
				<td>:</td>
				<td>
					<input class="easyui-numberbox" id="jumlah" name="jumlah" data-options="precision:0,groupSeparator:',',decimalSeparator:'.'" class="easyui-validatebox" required="true" style="width:195px; height:25px"  />
				</td>	
			</tr>
			<tr style="height:35px">
				<td> Keterangan </td>
				<td>:</td>
				<td>
					<input id="ket" name="ket" style="width:190px; height:20px" >
				</td>	
			</tr>
			<tr style="height:35px">
				<td>Dari Akun</td>
				<td>:</td>
				<td>
				<select id="akun_id" name="akun_id" style="width:195px; height:25px" class="easyui-validatebox" required="true">
					<option value="0"> -- Pilih Jenis Akun --</option>	
				   <?php       
					 $tampil=mysql_query("SELECT ftNamaPerkiraan,ftKodePerkiraan FROM tlnoperkiraan WHERE fnStatus =1 ");
					 	     while($r=mysql_fetch_array($tampil)){
					   echo "<option value='$r[ftKodePerkiraan]'>$r[ftNamaPerkiraan]</option>"; }
					?>
                </select>	
				</td>
			</tr>
			<tr style="height:35px">
				<td>Untuk Kas</td>
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

		var win = window.open('modul/transaksi_kas/aksi_pemasukan_kas.php?module=transaksi_kas&act=cetak&kode_transaksi=' + kode_transaksi + '&tgl_dari=' + tgl_dari + '&tgl_sampai=' + tgl_sampai);
		if (win) {
			win.focus();
		} else {
			alert('Popup jangan di block');
		}
	}
	
	function create(){
		$("#dialog-form").dialog("open").dialog("setTitle","Tambah Data");
	//	$('#tgl_transaksi_txt').datepicker({format: "yyyy-mm-dd",showAnim:"drop",autoclose: true});
		$('#form').form('clear');
		$('#tgl_transaksi_txt').val('<?php echo $tanggal;?>');
		$('#tgl_transaksi').val('<?php echo $tanggal;?>');
		$('#kas option[value="0"]').prop('selected', true);
		$('#akun_id option[value="0"]').prop('selected', true);
		$('#jumlah ~ span input').keyup(function(){
			var val_jumlah = $(this).val();
			$('#jumlah').numberbox('setValue', number_format(val_jumlah));
		});
		url = "modul/transaksi_kas/aksi_pemasukan_kas.php?module=transaksi_kas&act=create" 
		
	}
	
	function update(){
		var row = jQuery('#dg').datagrid('getSelected');
		if(row){
			jQuery('#dialog-form').dialog('open').dialog('setTitle','Edit Data Setoran');
			jQuery('#form').form('load',row);
			url = 'modul/transaksi_kas/aksi_pemasukan_kas.php?module=transaksi_kas&act=update&id=' + row.id;
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
		var kas = $("#kas").val();
		var akun_id = $("#akun_id").val();
		var string = $("#form").serialize();
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
						url		: "modul/transaksi_kas/aksi_pemasukan_kas.php?module=transaksi_kas&act=delete&id="+row.id,
						
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
	
</script> 			
<?php     
     break;
	
    }
  }
?>	





