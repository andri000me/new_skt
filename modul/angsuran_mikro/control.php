<script>
function showPinjamanmikro(menu) {
	sList = window.open('search-rekening-mikro.html', 'Print', 'width=920,height=420,scrollbars=yes');
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

function myFunctionAdm(ctrl, event) {
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
			//alert(x1 + '======' + x3);

		var fcPokokAngsuran = document.getElementById("fcPokokAngsuran").value;
		var conv_fcPokokAngsuran = parseInt(fcPokokAngsuran.replace(/,/g, ""));
		var fcBunganAngsuran = document.getElementById("fcBunganAngsuran").value;
		var conv_fcBunganAngsuran = parseInt(fcBunganAngsuran.replace(/,/g, ""));
		var fcPbltAngsuran = document.getElementById("fcPbltAngsuran").value;
		var conv_fcPbltAngsuran = parseInt(fcPbltAngsuran.replace(/,/g, ""));
		var fcDiskon = document.getElementById("fcDiskon").value;
		var conv_fcDiskon = parseInt(fcDiskon.replace(/,/g, ""));

		var fcDiskon = document.getElementById("fcDiskon").value;
			if(fcDiskon != ""){var fcDiskon2= fcDiskon;}else{var fcDiskon2="0";}
		var conv_fcDiskon = parseInt(fcDiskon2.replace(/,/g, ""));

		var fcAdmAngsuran = document.getElementById("fcAdmAngsuran").value;
			if(fcAdmAngsuran != ""){var fcAdmAngsuran2= fcAdmAngsuran;}else{var fcAdmAngsuran2="0";}
		var conv_fcAdmAngsuran = parseInt(fcAdmAngsuran2.replace(/,/g, ""));

		var fcTabAngsuran = document.getElementById("fcTabAngsuran").value;
			if(fcTabAngsuran != ""){var fcTabAngsuran2= fcTabAngsuran;}else{var fcTabAngsuran2="0";}
		var conv_fcTabAngsuran = parseInt(fcTabAngsuran2.replace(/,/g, ""));

		var total_ang = document.getElementById("fcTotalAngsuran").value;
		var conv_total_ang = parseInt(total_ang.replace(/,/g, ""));

			jumlah=(conv_fcPokokAngsuran) + (conv_fcBunganAngsuran) + (conv_fcPbltAngsuran) + (conv_fcAdmAngsuran) + (conv_fcTabAngsuran) ;
			total_bayar= jumlah - conv_fcDiskon;
			conv_total_bayar=total_bayar.formatMoney();
			conv_jumlah=jumlah.formatMoney();
			this.$(this.fcTotalAngsuran).val(conv_jumlah);
			this.$(this.fcPayment).val(conv_total_bayar);
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
		  //alert(x1 + '======' + x3);

		var diskon = document.getElementById("fcDiskon").value;
		var conv_diskon = diskon.replace(/,/g, "");
		var total_ang = document.getElementById("fcTotalAngsuran").value;
		var conv_total_ang = total_ang.replace(/,/g, "");

		total_bayar=conv_total_ang-conv_diskon;
		conv_total_bayar=total_bayar.formatMoney();
		this.$(this.fcPayment).val(conv_total_bayar);
		}
</script>
