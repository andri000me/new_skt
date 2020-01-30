<?php
include "../../config/config.php";
$edit = mysql_query("SELECT * FROM tbl_teknik WHERE id_teknik='$_GET[id]'");
$r    = mysql_fetch_array($edit); 
if($r[layanan]=='Sewa & Jasa Pelayanan'){
?>
 <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
    
$(document).ready(function() {

	rincian_baukk.hidden = false;
    no_baukk.hidden = false;
	tgl_baukk.hidden = false;
	rincian_bauk22.hidden = false;
    no_bauk22.hidden = false;
	tgl_bauk22.hidden = false;
	rincian_bauk33.hidden = false;
    no_bauk33.hidden = false;
	tgl_bauk33.hidden = false;
	rincian_bauk44.hidden = false;
    no_bauk44.hidden = false;
	tgl_bauk44.hidden = false;
	rincian_bauk55.hidden = false;
    no_bauk55.hidden = false;
	tgl_bauk55.hidden = false;
	rincian_bauk66.hidden = false;
    no_bauk66.hidden = false;
	tgl_bauk66.hidden = false;
	rincian_bauk77.hidden = false;
    no_bauk77.hidden = false;
	tgl_bauk77.hidden = false;
	rincian_bauk88.hidden = false;
    no_bauk88.hidden = false;
	tgl_bauk88.hidden = false;
	rincian_bauk99.hidden = false;
    no_bauk99.hidden = false;
	tgl_bauk99.hidden = false;
	rincian_bauk100.hidden = false;
    no_bauk100.hidden = false;
	tgl_bauk100.hidden = false;
	rincian_bauk111.hidden = false;
    no_bauk111.hidden = false;
	tgl_bauk111.hidden = false;
	rincian_bauk122.hidden = false;
    no_bauk122.hidden = false;
	tgl_bauk122.hidden = false;
	doc_baukk.hidden = false;
	doc_bauk22.hidden = false;
	doc_bauk33.hidden = false;
	doc_bauk44.hidden = false;
	doc_bauk55.hidden = false;
	doc_bauk66.hidden = false;
	doc_bauk77.hidden = false;
	doc_bauk88.hidden = false;
	doc_bauk99.hidden = false;
	doc_bauk100.hidden = false;
	doc_bauk111.hidden = false;
	doc_bauk122.hidden = false;
	
	$('#layanan').change(function() { 
	var elem = document.getElementById("myForm");
	if(elem.layanan.value == "Aktivasi"){
	rincian_baukk.hidden = true;
    no_baukk.hidden = true;
	tgl_baukk.hidden = true;	
	rincian_bauk22.hidden = true;
    no_bauk22.hidden = true;
	tgl_bauk22.hidden = true;
	rincian_bauk33.hidden = true;
    no_bauk33.hidden = true;
	tgl_bauk33.hidden = true;
	rincian_bauk44.hidden = true;
    no_bauk44.hidden = true;
	tgl_bauk44.hidden = true;
	rincian_bauk55.hidden = true;
    no_bauk55.hidden = true;
	tgl_bauk55.hidden = true;
	rincian_bauk66.hidden = true;
    no_bauk66.hidden = true;
	tgl_bauk66.hidden = true;
	rincian_bauk77.hidden = true;
    no_bauk77.hidden = true;
	tgl_bauk77.hidden = true;
	rincian_bauk88.hidden = true;
    no_bauk88.hidden = true;
	tgl_bauk88.hidden = true;
	rincian_bauk99.hidden = true;
    no_bauk99.hidden = true;
	tgl_bauk99.hidden = true;
	rincian_bauk100.hidden = true;
    no_bauk100.hidden = true;
	tgl_bauk100.hidden = true;
	rincian_bauk111.hidden = true;
    no_bauk111.hidden = true;
	tgl_bauk111.hidden = true;
	rincian_bauk122.hidden = true;
    no_bauk122.hidden = true;
	tgl_bauk122.hidden = true;	
	doc_baukk.hidden = true;
	doc_bauk22.hidden = true;
	doc_bauk33.hidden = true;
	doc_bauk44.hidden = true;
	doc_bauk55.hidden = true;
	doc_bauk66.hidden = true;
	doc_bauk77.hidden = true;
	doc_bauk88.hidden = true;
	doc_bauk99.hidden = true;
	doc_bauk100.hidden = true;
	doc_bauk111.hidden = true;
	doc_bauk122.hidden = true;
	var layanan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/teknik/addprog.php',
			data: 'layanan=' + layanan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#animasi').html('<img src="images/loader3.gif"  width=15>');	
			},
			success: function(response) {
				$('#progress_aktivasi').html(response);
				animasi.hidden = true;
			}
		});	
	}else if(elem.layanan.value == "Supply Material"){
			rincian_baukk.hidden = true;
			no_baukk.hidden = true;
			tgl_baukk.hidden = true;	
			rincian_bauk22.hidden = true;
			no_bauk22.hidden = true;
			tgl_bauk22.hidden = true;
			rincian_bauk33.hidden = true;
			no_bauk33.hidden = true;
			tgl_bauk33.hidden = true;
			rincian_bauk44.hidden = true;
			no_bauk44.hidden = true;
			tgl_bauk44.hidden = true;
			rincian_bauk55.hidden = true;
			no_bauk55.hidden = true;
			tgl_bauk55.hidden = true;
			rincian_bauk66.hidden = true;
			no_bauk66.hidden = true;
			tgl_bauk66.hidden = true;
			rincian_bauk77.hidden = true;
			no_bauk77.hidden = true;
			tgl_bauk77.hidden = true;
			rincian_bauk88.hidden = true;
			no_bauk88.hidden = true;
			tgl_bauk88.hidden = true;
			rincian_bauk99.hidden = true;
			no_bauk99.hidden = true;
			tgl_bauk99.hidden = true;
			rincian_bauk100.hidden = true;
			no_bauk100.hidden = true;
			tgl_bauk100.hidden = true;
			rincian_bauk111.hidden = true;
			no_bauk111.hidden = true;
			tgl_bauk111.hidden = true;
			rincian_bauk122.hidden = true;
			no_bauk122.hidden = true;
			tgl_bauk122.hidden = true;	
			doc_baukk.hidden = true;
			doc_bauk22.hidden = true;
			doc_bauk33.hidden = true;
			doc_bauk44.hidden = true;
			doc_bauk55.hidden = true;
			doc_bauk66.hidden = true;
			doc_bauk77.hidden = true;
			doc_bauk88.hidden = true;
			doc_bauk99.hidden = true;
			doc_bauk100.hidden = true;
			doc_bauk111.hidden = true;
			doc_bauk122.hidden = true;
	var layanan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/teknik/addprog2.php',
			data: 'layanan=' + layanan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#animasi').html('<img src="images/loader3.gif"  width=15>');	
			},
			success: function(response) {
				$('#progress_aktivasi').html(response);
				animasi.hidden = true;
			}
		});		
	}else  if(elem.layanan.value == "Sewa & Jasa Pelayanan"){
		
		rincian_baukk.hidden = false;
		no_baukk.hidden = false;
		tgl_baukk.hidden = false;
		rincian_bauk22.hidden = false;
		no_bauk22.hidden = false;
		tgl_bauk22.hidden = false;
		rincian_bauk33.hidden = false;
		no_bauk33.hidden = false;
		tgl_bauk33.hidden = false;
		rincian_bauk44.hidden = false;
		no_bauk44.hidden = false;
		tgl_bauk44.hidden = false;
		rincian_bauk55.hidden = false;
		no_bauk55.hidden = false;
		tgl_bauk55.hidden = false;
		rincian_bauk66.hidden = false;
		no_bauk66.hidden = false;
		tgl_bauk66.hidden = false;
		rincian_bauk77.hidden = false;
		no_bauk77.hidden = false;
		tgl_bauk77.hidden = false;
		rincian_bauk88.hidden = false;
		no_bauk88.hidden = false;
		tgl_bauk88.hidden = false;
		rincian_bauk99.hidden = false;
		no_bauk99.hidden = false;
		tgl_bauk99.hidden = false;
		rincian_bauk100.hidden = false;
		no_bauk100.hidden = false;
		tgl_bauk100.hidden = false;
		rincian_bauk111.hidden = false;
		no_bauk111.hidden = false;
		tgl_bauk111.hidden = false;
		rincian_bauk122.hidden = false;
		no_bauk122.hidden = false;
		tgl_bauk122.hidden = false;	
		doc_baukk.hidden = false;
		doc_bauk22.hidden = false;
		doc_bauk33.hidden = false;
		doc_bauk44.hidden = false;
		doc_bauk55.hidden = false;
		doc_bauk66.hidden = false;
		doc_bauk77.hidden = false;
		doc_bauk88.hidden = false;
		doc_bauk99.hidden = false;
		doc_bauk100.hidden = false;
		doc_bauk111.hidden = false;
		doc_bauk122.hidden = false;
	var layanan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/teknik/addprog3.php',
			data: 'layanan=' + layanan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#animasi').html('<img src="images/loader3.gif"  width=15>');	
			},
			success: function(response) {
				$('#progress_aktivasi').html(response);
				animasi.hidden = true;
			}
		});		
	}else  if(elem.layanan.value == ""){
		rincian_bauk22.hidden = true;
    no_bauk22.hidden = true;
	tgl_bauk22.hidden = true;
	rincian_bauk33.hidden = true;
    no_bauk33.hidden = true;
	tgl_bauk33.hidden = true;
	rincian_bauk44.hidden = true;
    no_bauk44.hidden = true;
	tgl_bauk44.hidden = true;
	rincian_bauk55.hidden = true;
    no_bauk55.hidden = true;
	tgl_bauk55.hidden = true;
	rincian_bauk66.hidden = true;
    no_bauk66.hidden = true;
	tgl_bauk66.hidden = true;
	rincian_bauk77.hidden = true;
    no_bauk77.hidden = true;
	tgl_bauk77.hidden = true;
	rincian_bauk88.hidden = true;
    no_bauk88.hidden = true;
	tgl_bauk88.hidden = true;
	rincian_bauk99.hidden = true;
    no_bauk99.hidden = true;
	tgl_bauk99.hidden = true;
	rincian_bauk100.hidden = true;
    no_bauk100.hidden = true;
	tgl_bauk100.hidden = true;
	rincian_bauk111.hidden = true;
    no_bauk111.hidden = true;
	tgl_bauk111.hidden = true;
	rincian_bauk122.hidden = true;
    no_bauk122.hidden = true;
	tgl_bauk122.hidden = true;
	doc_baukk.hidden = true;
	doc_bauk22.hidden = true;
	doc_bauk33.hidden = true;
	doc_bauk44.hidden = true;
	doc_bauk55.hidden = true;
	doc_bauk66.hidden = true;
	doc_bauk77.hidden = true;
	doc_bauk88.hidden = true;
	doc_bauk99.hidden = true;
	doc_bauk100.hidden = true;
	doc_bauk111.hidden = true;
	doc_bauk122.hidden = true;
	
	var layanan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/teknik/addprog4.php',
			data: 'layanan=' + layanan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#animasi').html('<img src="images/loader3.gif"  width=15>');	
			},
			success: function(response) {
				$('#progress_aktivasi').html(response);
				animasi.hidden = true;
			}
		});		
	}
    });
});

</script>

<?php
}else{
?>

 <script type="text/javascript">
    
$(document).ready(function() {

	rincian_baukk.hidden = true;
    no_baukk.hidden = true;
	tgl_baukk.hidden = true;
	rincian_bauk22.hidden = true;
    no_bauk22.hidden = true;
	tgl_bauk22.hidden = true;
	rincian_bauk33.hidden = true;
    no_bauk33.hidden = true;
	tgl_bauk33.hidden = true;
	rincian_bauk44.hidden = true;
    no_bauk44.hidden = true;
	tgl_bauk44.hidden = true;
	rincian_bauk55.hidden = true;
    no_bauk55.hidden = true;
	tgl_bauk55.hidden = true;
	rincian_bauk66.hidden = true;
    no_bauk66.hidden = true;
	tgl_bauk66.hidden = true;
	rincian_bauk77.hidden = true;
    no_bauk77.hidden = true;
	tgl_bauk77.hidden = true;
	rincian_bauk88.hidden = true;
    no_bauk88.hidden = true;
	tgl_bauk88.hidden = true;
	rincian_bauk99.hidden = true;
    no_bauk99.hidden = true;
	tgl_bauk99.hidden = true;
	rincian_bauk100.hidden = true;
    no_bauk100.hidden = true;
	tgl_bauk100.hidden = true;
	rincian_bauk111.hidden = true;
    no_bauk111.hidden = true;
	tgl_bauk111.hidden = true;
	rincian_bauk122.hidden = true;
    no_bauk122.hidden = true;
	tgl_bauk122.hidden = true;
	doc_baukk.hidden = true;
	doc_bauk22.hidden = true;
	doc_bauk33.hidden = true;
	doc_bauk44.hidden = true;
	doc_bauk55.hidden = true;
	doc_bauk66.hidden = true;
	doc_bauk77.hidden = true;
	doc_bauk88.hidden = true;
	doc_bauk99.hidden = true;
	doc_bauk100.hidden = true;
	doc_bauk111.hidden = true;
	doc_bauk122.hidden = true;
	
	
	$('#layanan').change(function() { 
	var elem = document.getElementById("myForm");
	if(elem.layanan.value == "Aktivasi"){
	rincian_baukk.hidden = true;
    no_baukk.hidden = true;
	tgl_baukk.hidden = true;	
	rincian_bauk22.hidden = true;
    no_bauk22.hidden = true;
	tgl_bauk22.hidden = true;
	rincian_bauk33.hidden = true;
    no_bauk33.hidden = true;
	tgl_bauk33.hidden = true;
	rincian_bauk44.hidden = true;
    no_bauk44.hidden = true;
	tgl_bauk44.hidden = true;
	rincian_bauk55.hidden = true;
    no_bauk55.hidden = true;
	tgl_bauk55.hidden = true;
	rincian_bauk66.hidden = true;
    no_bauk66.hidden = true;
	tgl_bauk66.hidden = true;
	rincian_bauk77.hidden = true;
    no_bauk77.hidden = true;
	tgl_bauk77.hidden = true;
	rincian_bauk88.hidden = true;
    no_bauk88.hidden = true;
	tgl_bauk88.hidden = true;
	rincian_bauk99.hidden = true;
    no_bauk99.hidden = true;
	tgl_bauk99.hidden = true;
	rincian_bauk100.hidden = true;
    no_bauk100.hidden = true;
	tgl_bauk100.hidden = true;
	rincian_bauk111.hidden = true;
    no_bauk111.hidden = true;
	tgl_bauk111.hidden = true;
	rincian_bauk122.hidden = true;
    no_bauk122.hidden = true;
	tgl_bauk122.hidden = true;
	doc_baukk.hidden = true;
	doc_bauk22.hidden = true;
	doc_bauk33.hidden = true;
	doc_bauk44.hidden = true;
	doc_bauk55.hidden = true;
	doc_bauk66.hidden = true;
	doc_bauk77.hidden = true;
	doc_bauk88.hidden = true;
	doc_bauk99.hidden = true;
	doc_bauk100.hidden = true;
	doc_bauk111.hidden = true;
	doc_bauk122.hidden = true;
	var layanan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/teknik/addprog.php',
			data: 'layanan=' + layanan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#animasi').html('<img src="images/loader3.gif"  width=15>');	
			},
			success: function(response) {
				$('#progress_aktivasi').html(response);
				animasi.hidden = true;
			}
		});	
	}else if(elem.layanan.value == "Supply Material"){
			rincian_baukk.hidden = true;
			no_baukk.hidden = true;
			tgl_baukk.hidden = true;	
			rincian_bauk22.hidden = true;
			no_bauk22.hidden = true;
			tgl_bauk22.hidden = true;
			rincian_bauk33.hidden = true;
			no_bauk33.hidden = true;
			tgl_bauk33.hidden = true;
			rincian_bauk44.hidden = true;
			no_bauk44.hidden = true;
			tgl_bauk44.hidden = true;
			rincian_bauk55.hidden = true;
			no_bauk55.hidden = true;
			tgl_bauk55.hidden = true;
			rincian_bauk66.hidden = true;
			no_bauk66.hidden = true;
			tgl_bauk66.hidden = true;
			rincian_bauk77.hidden = true;
			no_bauk77.hidden = true;
			tgl_bauk77.hidden = true;
			rincian_bauk88.hidden = true;
			no_bauk88.hidden = true;
			tgl_bauk88.hidden = true;
			rincian_bauk99.hidden = true;
			no_bauk99.hidden = true;
			tgl_bauk99.hidden = true;
			rincian_bauk100.hidden = true;
			no_bauk100.hidden = true;
			tgl_bauk100.hidden = true;
			rincian_bauk111.hidden = true;
			no_bauk111.hidden = true;
			tgl_bauk111.hidden = true;
			rincian_bauk122.hidden = true;
			no_bauk122.hidden = true;
			tgl_bauk122.hidden = true;	
			doc_baukk.hidden = true;
			doc_bauk22.hidden = true;
			doc_bauk33.hidden = true;
			doc_bauk44.hidden = true;
			doc_bauk55.hidden = true;
			doc_bauk66.hidden = true;
			doc_bauk77.hidden = true;
			doc_bauk88.hidden = true;
			doc_bauk99.hidden = true;
			doc_bauk100.hidden = true;
			doc_bauk111.hidden = true;
			doc_bauk122.hidden = true;
	var layanan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/teknik/addprog2.php',
			data: 'layanan=' + layanan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#animasi').html('<img src="images/loader3.gif"  width=15>');	
			},
			success: function(response) {
				$('#progress_aktivasi').html(response);
				animasi.hidden = true;
			}
		});		
	}else  if(elem.layanan.value == "Sewa & Jasa Pelayanan"){
		
		rincian_baukk.hidden = false;
		no_baukk.hidden = false;
		tgl_baukk.hidden = false;
		rincian_bauk22.hidden = false;
		no_bauk22.hidden = false;
		tgl_bauk22.hidden = false;
		rincian_bauk33.hidden = false;
		no_bauk33.hidden = false;
		tgl_bauk33.hidden = false;
		rincian_bauk44.hidden = false;
		no_bauk44.hidden = false;
		tgl_bauk44.hidden = false;
		rincian_bauk55.hidden = false;
		no_bauk55.hidden = false;
		tgl_bauk55.hidden = false;
		rincian_bauk66.hidden = false;
		no_bauk66.hidden = false;
		tgl_bauk66.hidden = false;
		rincian_bauk77.hidden = false;
		no_bauk77.hidden = false;
		tgl_bauk77.hidden = false;
		rincian_bauk88.hidden = false;
		no_bauk88.hidden = false;
		tgl_bauk88.hidden = false;
		rincian_bauk99.hidden = false;
		no_bauk99.hidden = false;
		tgl_bauk99.hidden = false;
		rincian_bauk100.hidden = false;
		no_bauk100.hidden = false;
		tgl_bauk100.hidden = false;
		rincian_bauk111.hidden = false;
		no_bauk111.hidden = false;
		tgl_bauk111.hidden = false;
		rincian_bauk122.hidden = false;
		no_bauk122.hidden = false;
		tgl_bauk122.hidden = false;	
		doc_baukk.hidden = false;
		doc_bauk22.hidden = false;
		doc_bauk33.hidden = false;
		doc_bauk44.hidden = false;
		doc_bauk55.hidden = false;
		doc_bauk66.hidden = false;
		doc_bauk77.hidden = false;
		doc_bauk88.hidden = false;
		doc_bauk99.hidden = false;
		doc_bauk100.hidden = false;
		doc_bauk111.hidden = false;
		doc_bauk122.hidden = false;
	var layanan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/teknik/addprog3.php',
			data: 'layanan=' + layanan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#animasi').html('<img src="images/loader3.gif"  width=15>');	
			},
			success: function(response) {
				$('#progress_aktivasi').html(response);
				animasi.hidden = true;
			}
		});		
	}else  if(elem.layanan.value == ""){
		rincian_bauk22.hidden = true;
    no_bauk22.hidden = true;
	tgl_bauk22.hidden = true;
	rincian_bauk33.hidden = true;
    no_bauk33.hidden = true;
	tgl_bauk33.hidden = true;
	rincian_bauk44.hidden = true;
    no_bauk44.hidden = true;
	tgl_bauk44.hidden = true;
	rincian_bauk55.hidden = true;
    no_bauk55.hidden = true;
	tgl_bauk55.hidden = true;
	rincian_bauk66.hidden = true;
    no_bauk66.hidden = true;
	tgl_bauk66.hidden = true;
	rincian_bauk77.hidden = true;
    no_bauk77.hidden = true;
	tgl_bauk77.hidden = true;
	rincian_bauk88.hidden = true;
    no_bauk88.hidden = true;
	tgl_bauk88.hidden = true;
	rincian_bauk99.hidden = true;
    no_bauk99.hidden = true;
	tgl_bauk99.hidden = true;
	rincian_bauk100.hidden = true;
    no_bauk100.hidden = true;
	tgl_bauk100.hidden = true;
	rincian_bauk111.hidden = true;
    no_bauk111.hidden = true;
	tgl_bauk111.hidden = true;
	rincian_bauk122.hidden = true;
    no_bauk122.hidden = true;
	tgl_bauk122.hidden = true;	
	doc_baukk.hidden = true;
	doc_bauk22.hidden = true;
	doc_bauk33.hidden = true;
	doc_bauk44.hidden = true;
	doc_bauk55.hidden = true;
	doc_bauk66.hidden = true;
	doc_bauk77.hidden = true;
	doc_bauk88.hidden = true;
	doc_bauk99.hidden = true;
	doc_bauk100.hidden = true;
	doc_bauk111.hidden = true;
	doc_bauk122.hidden = true;
	var layanan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/teknik/addprog4.php',
			data: 'layanan=' + layanan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#animasi').html('<img src="images/loader3.gif"  width=15>');	
			},
			success: function(response) {
				$('#progress_aktivasi').html(response);
				animasi.hidden = true;
			}
		});		
	}
    });
	
});

</script>
<?php
}
?>

