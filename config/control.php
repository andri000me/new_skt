<script >
// Rubah ke format currency
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
	//=====
	  
	function jwfunction(ctrl, event) {
	// Fungsi untuk menampilkan koma secara otomatis ketika menginput angka		
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
	}
</script>   