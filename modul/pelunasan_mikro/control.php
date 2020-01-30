<script>
function showPinjamanmikro(menu) { 
	sList = window.open('modul/pelunasan_mikro/formsearch.php', 'Print', 'width=920,height=420,scrollbars=yes');
}
</script>

<script >
Number.prototype.formatMoney = function(places, symbol, thousand, decimal) {
	places = !isNaN(places = Math.abs(places)) ? places : 0;
	symbol = symbol !== undefined ? symbol : "";
	thousand = thousand || ",";
	decimal = decimal || ".";
	var number = this, 
	    negative = number < 0 ? "-" : "",
	    i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
	    j = (j = i.length) > 3 ? j % 3 : 0;
	return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
};

function isNumberKey(evt){
		 var charCode = (evt.which) ? evt.which : event.keyCode;
		 if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
		 return false;
		 return true;
		}	
function myFunction(ctrl, event) { 
		 var val = ctrl.value;
		  //alert(val);
		  val = val.replace(/,/g, "");
		  ctrl.value = "";
		  val += '';
		  x = val.split('.');
		  x1 = x[0];
		  x2 = x.length > 1 ? '.' + x[1] : '';
		  var rgx = /(\d+)(\d{3})/;
		  while (rgx.test(x1)) {
			  x1 = x1.replace(rgx, '$1' + ',' + '$2');
		  }
		  x3 = x2.length > 2 ? x2.substring(0,3) : x2;
		  ctrl.value = x1 + x3;
		 
		var diskon = document.getElementById("fcDiskon").value;
		var conv_diskon = diskon.replace(/,/g, "");
		var total_ang = document.getElementById("fcTotalAngsuran").value;
		var conv_total_ang = total_ang.replace(/,/g, "");
			total_bayar=conv_total_ang-conv_diskon;
			conv_total_bayar=total_bayar.formatMoney();	
			this.$(this.fcPayment).val(conv_total_bayar);
		}
function funcPblt(ctrl, event) { 
		 var val = ctrl.value;
		  //alert(val);
		  val = val.replace(/,/g, "");
		  ctrl.value = "";
		  val += '';
		  x = val.split('.');
		  x1 = x[0];
		  x2 = x.length > 1 ? '.' + x[1] : '';
		  var rgx = /(\d+)(\d{3})/;
		  while (rgx.test(x1)) {
			  x1 = x1.replace(rgx, '$1' + ',' + '$2');
		  }
		  x3 = x2.length > 2 ? x2.substring(0,3) : x2;
		  ctrl.value = x1 + x3;
		 
		var pokok = document.getElementById("fcPokokAngsuran").value;
		var conv_pokok = pokok.replace(/,/g, "")*1;
		var bunga = document.getElementById("fcBunganAngsuran").value;
		var conv_bunga = bunga.replace(/,/g, "")*1;
		var adm = document.getElementById("fcAdmAngsuran").value;
		var conv_adm = adm.replace(/,/g, "")*1;
		var tabungan = document.getElementById("fcTabAngsuran").value;
		var conv_tabungan = tabungan.replace(/,/g, "")*1;
		var diskon = document.getElementById("fcDiskon").value;
		var conv_diskon = diskon.replace(/,/g, "")*1;
		var pblt = document.getElementById("fcPbltAngsuran").value;
		var conv_pblt = pblt.replace(/,/g, "")*1;
		var total_ang = document.getElementById("fcTotalAngsuran").value;
		var conv_total_ang = total_ang.replace(/,/g, "")*1;

			total_angsuran=conv_pokok+conv_bunga+conv_adm+conv_tabungan+conv_pblt;
			conv_total_angsuran=total_angsuran.formatMoney();	

			total_bayar=total_angsuran-conv_diskon;
			conv_total_bayar=total_bayar.formatMoney();	
			this.$(this.fcTotalAngsuran).val(conv_total_angsuran);
			this.$(this.fcPayment).val(conv_total_bayar);
		}		
</script>    