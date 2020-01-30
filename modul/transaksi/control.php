 <script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
//apabila terjadi event onchange terhadap object <select id=ftNoRekening>
$("#ftNoRekening").change(function(){
var elem = document.getElementById("myForm");
if(elem.ftNamaNasabah.value != ""){
ftAlamat2.hidden = true;
}
var ftNoRekening = $("#ftNoRekening").val();
	
$.ajax({
url: "modul/transaksi/load_transaksi.php?act=nasabah",
data: "ftNoRekening="+ftNoRekening,
cache: false,
success: function(msg){
//jika data sukses diambil dari server kita tampilkan
//di <select id=ftNamaNasabah>
$("#ftNamaNasabah").html(msg);
}
});
});

});
 
</script>