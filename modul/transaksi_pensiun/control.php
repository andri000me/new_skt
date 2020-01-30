<script>  
function showSouvenir(menu) {
	sList = window.open('modul/transaksi_pensiun/formsearch.php', 'Print', 'width=920,height=420,scrollbars=yes');
	}
</script>

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
	//=================================================================
	// Fungsi Plafond Pinjaman			
	function myFunction(ctrl, event) {
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
	//=================================================================	
		
		var plafond = document.getElementById("fcPlafond").value;
		var x = plafond.replace(/,/g, "");// hapus karakter koma	
		var adm = document.getElementById("ffAdm").value;
		var conv_adm = adm.replace(/,/g, "");// hapus karakter koma
		var asr = document.getElementById("ffAsuransi").value;
		var conv_asr = asr.replace(/,/g, "");// hapus karakter koma
		var mtr = document.getElementById("fcMaterai").value;
		var conv_mtr = mtr.replace(/,/g, "");// hapus karakter koma
		var pel = document.getElementById("fcPelunasan").value;
		var conv_pel = pel.replace(/,/g, "");// hapus karakter koma
		var provisi = document.getElementById("ffProvisi").value;
		var conv_provisi = provisi.replace(/,/g, "");// hapus karakter koma
		var ppap = document.getElementById("ffPpap").value;
		var conv_ppap = ppap.replace(/,/g, "");// hapus karakter koma
	//=================================================================
	//  Jika Plafond pinjaman kosong maka Jangka waktu di disable	
		if(x!=''){
			var open= document.getElementById("fnJW").disabled = false;
			var open2= document.getElementById("ffBunga").disabled = false;
			
			
		}else{
			var open= document.getElementById("fnJW").disabled = true;
			var open2= document.getElementById("ffBunga").disabled = true;
			
			this.$(this.fnJW).val(0);
		}
	//=================================================================	
		admhasil=conv_adm/100*x;// Menghitung Potongan Adm [%]
		conv_admhasil=admhasil.formatMoney();//convert Potongan Adm ke currency
		asrhasil=conv_asr/100*x;// Menghitung Potongan Asuransi [%]
		conv_asrhasil=asrhasil.formatMoney();//convert Potongan Asuransi ke currency
		admhasil=conv_adm/100*x;// Menghitung Potongan Adm [%]
		conv_admhasil=admhasil.formatMoney();//convert Potongan Adm ke currency

		provisihasil=conv_provisi/100*x;// Menghitung Potongan Provisi [%]
		conv_provisihasil=provisihasil.formatMoney();//convert Potongan Provisi ke currency
		ppaphasil=conv_ppap/100*x;// Menghitung Potongan PPAP [%]
		conv_ppaphasil=ppaphasil.formatMoney();//convert Potongan PPAP ke currency
		
		trmbersih=x-admhasil-asrhasil-conv_mtr-provisihasil-ppaphasil;// Menghitung terima bersih dari plafond pinjaman - Potongan Adm - Potongan Asuransi - Materai
		trmbersih2 =  Math.floor(trmbersih);// Pembulatan ke bawah Terima Bersih
	//=================================================================		
		// Cari selisih pembulatan terima bersih
		pbltp =  trmbersih2/100;//
		pbltp2 =  Math.floor(pbltp);//
		pbltp3 =  pbltp2*100;
		pbltp4 =  pbltp3-trmbersih2;
	//=================================================================	
		totalp =   x - admhasil - asrhasil - provisihasil - ppaphasil - conv_mtr - pbltp4 - conv_pel;// Hitung total terima bersih	(plafond pinjaman - Potongan Adm - Potongan Asuransi - Potongan Provisi - Potongan PPAP -Materai - selisih pembulatan - Pelunasan )
	//=================================================================		
		// pembulatan kebawah total terima bersih
	//	 hasil = (Math.floor(parseInt(totalp))%parseInt(100) == 0)? Math.floor(parseInt(totalp)) : Math.floor((parseInt(totalp)+parseInt(100)/2)/parseInt(100))*parseInt(100);
		 hasil = Math.ceil(totalp / 100) * 100;
		conv_totalp=hasil.formatMoney();//convert total terima bersih ke currency
	//	conv_totalp2 = conv_totalp.replace(/,/g, "");// hapus karakter koma
	//=================================================================		
		selisihsl =Math.ceil(hasil) - totalp ; // Pembulatan (selisih )
	/*	console.log(selisihsl);
		console.log(hasil);
		console.log(totalp);*/
		this.$(this.fcPlafondoutput).val(plafond);// Masukkan ke Plafond Pinjaman
		this.$(this.fcAdm).val(conv_admhasil);// Masukkan ke Potongan Administrasi
		this.$(this.fcAsuransi).val(conv_asrhasil);// Masukkan ke Potongan Asuransi
		this.$(this.fcProvisi).val(conv_provisihasil);// Masukkan ke Potongan Provisi
		this.$(this.fcPpap).val(conv_ppaphasil);// Masukkan ke Potongan PPAP
		this.$(this.fcTerimaBersih).val(conv_totalp);// Masukkan ke Terima Bersih
		this.$(this.fcPblt).val(selisihsl);// Masukan ke Pembulatan
		}
	//=================================================================		
	// Fungsi hanya Angka saja yang di input		
	function isNumberKey(evt){
		 var charCode = (evt.which) ? evt.which : event.keyCode;
		 if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
		 return false;
		 return true;
		}
	// Fungsi untuk menampilkan koma secara otomatis ketika menginput angka		
	function isCurency(ctrl,event){
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
		}		
	//=================================================================	
	// Fungsi untuk Jangka Waktu & Tabungan Angsuran	  
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

	//=================================================================
	//  Jika Jangka waktu kosong maka Tabungan Angsuran di disable	  
		var angs = document.getElementById("fnJW").value;
		if(angs!=''){
			var tab_angs= document.getElementById("fcTabAngsuran").disabled = false;
			var adm_angs= document.getElementById("fcAdmAngsuran").disabled = false;
			
		}else{
			var tab_angs= document.getElementById("fcTabAngsuran").disabled = true;
			var adm_angs= document.getElementById("fcAdmAngsuran").disabled = true;
			this.$(this.fcAdmAngsuran).val(0);
			this.$(this.fcTabAngsuran).val(0);
		}
	//=================================================================	
		var plafond = document.getElementById("fcPlafond").value;
		var pla = plafond.replace(/,/g, "");// hapus karakter koma
		var bng = document.getElementById("ffBunga").value;
		var adm_angs = document.getElementById("fcAdmAngsuran").value;
		var conv_adm_angs = adm_angs.replace(/,/g, "");// hapus karakter koma
		var tab_angss = document.getElementById("fcTabAngsuran").value;
		var conv_tab_angs = tab_angss.replace(/,/g, "");// hapus karakter koma
		var pblt_angs = document.getElementById("fcPbltAngsuran").value;
		
		pokok_ang=pla/angs;// Pokok angsuran = Plafond Pinjaman / Jangka Waktu 
		potong =  Math.ceil(pokok_ang);// Pokok Angsuran di bulatkan ke atas
		conv_potong=potong.formatMoney();// Pokok Angsuran di convert ke Currency
		bng_ang=pla*bng/100;// Bunga Angsuran = Plafond Pinjaman * Bunga / 100
		conv_bng_ang=bng_ang.formatMoney();// Bunga Angsuran di convert ke Currency
		adm_angs2=conv_adm_angs*1;//Convert Admin Angsuran ke Number
		total_ang=pokok_ang + bng_ang + adm_angs2;//Hitung Total Angsuran= Pokok angsuran + Bunga Angsuran + Admin Angsuran
		potong_tot = Math.ceil(total_ang);// Pembulatan keatas Total Angsuran
	//=================================================================	
		// Hitung Selisih dari Total Angsuran dan Pembulatan 	
		pblt =  potong_tot/100;
		pblt2 =  Math.ceil(pblt);
		pblt3 =  pblt2*100;
		pblt4 =  pblt3-potong_tot;
	//=================================================================		
		total =   bng_ang + adm_angs2 + potong + pblt4 ;//Hitung Total Angsuran= Pokok angsuran + Bunga Angsuran + Admin Angsuran + Pembulatan
	//=================================================================	
		// Pembulatan ke atas Total Angsuran 	
		hasil = (Math.ceil(parseInt(total))%parseInt(1000) == 0) ? Math.ceil(parseInt(total)) : Math.round((parseInt(total)+parseInt(1000)/2)/parseInt(1000))*parseInt(1000);
	//=================================================================	
		selisihasil = hasil - total + pblt4;// Hitung Total Selisih = Hasil Pembulatan Total Angsuran - Total Angsuran + Selisih Pokok Angsuran
		conv_tab_angs2=conv_tab_angs*1;
		totalhasil= hasil + conv_tab_angs2;// Total Angsuran + Tabungan Angsuran
		conv_pblt4=selisihasil.formatMoney();//Convert Selisih Hasil ke Currency
	//	console.log(conv_tab_angs);
		conv_total=totalhasil.formatMoney();//Convert Total Angsuran ke Currency
		this.$(this.fcPokokAngsuran).val(conv_potong);// Masukan ke Pokok Angsuran
		this.$(this.fcBunganAngsuran).val(conv_bng_ang);// Masukan ke Bunga Angsuran
		this.$(this.fcTotalAngsuran).val(conv_total);// Masukan ke Total Angsuran
		this.$(this.fcPbltAngsuran).val(conv_pblt4);// Masukan ke Pembulatan Angsuran
		
	}
	
	/*function functionTabAng(ctrl, event) {
				 //Check if arrow keys are pressed - we want to allow navigation around textbox using arrow keys
		  //alert(event.keyCode);
		//  var code = (event.keyCode) ? event.keyCode : event.which;

		//  if (code == 9 || code == 8 || code == 37 || code == 38 || code == 39 || code == 40)
		//  {
		//	  return;
		//  }
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
		
		var tabang = document.getElementById("fcTabAngsuran").value;
		var conv_tabang = tabang.replace(/,/g, "");
		var angs = document.getElementById("fnJW").value;
		var plafond = document.getElementById("fcPlafond").value;
		var pla = plafond.replace(/,/g, "");
		var bng = document.getElementById("ffBunga").value;
		var conv_bng = bng.replace(/,/g, "");
	//	console.log(conv_bng);
		var adm_angs = document.getElementById("fcAdmAngsuran").value;
		var conv_adm_angs = adm_angs.replace(/,/g, "");
		
		var pblt_angs = document.getElementById("fcPbltAngsuran").value;
		
		pokok_ang=pla/angs;
		potong =  Math.round(pokok_ang);
		conv_potong=potong.formatMoney();
		bng_ang=pla*conv_bng/100;
		conv_bng_ang=bng_ang.formatMoney();
		adm_angs2=conv_adm_angs*1;
		tabang2=conv_tabang*1;
		total_ang=pokok_ang + bng_ang + adm_angs2;
		potong_tot = Math.round(total_ang);
		pblt =  potong_tot/100;
		pblt2 =  Math.round(pblt);
		pblt3 =  pblt2*100;
		pblt4 =  pblt3-potong_tot;
		conv_pblt4=pblt4.formatMoney();
		total =   bng_ang + adm_angs2 + potong + pblt4+tabang2;
	//	console.log(bng_ang+"&nbsp;"+adm_angs2+"&nbsp;"+potong+"&nbsp;"+pblt4+"&nbsp;"+tabang2);
		conv_total=total.formatMoney();
		this.$(this.fcPokokAngsuran).val(conv_potong);
		this.$(this.fcBunganAngsuran).val(conv_bng_ang);
		this.$(this.fcTotalAngsuran).val(conv_total);
		this.$(this.fcPbltAngsuran).val(conv_pblt4);
	}*/
	//=================================================================	
	// Fungsi untuk Diskon Pelunasan & Simpanan		
	function functionSim(ctrl, event) {
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
	//=================================================================		  
		var sim = document.getElementById("fcSimpanan").value;// Get Simpanan
		var conv_sim = sim.replace(/,/g, "");// hapus karakter koma
		var x = document.getElementById("fcPlafond").value;// Get Plafond Pinjaman
		var conv_x = x.replace(/,/g, "");// hapus karakter koma
		var adm = document.getElementById("ffAdm").value;// Get Potongan Adm [%]
		var conv_adm = adm.replace(/,/g, "");// hapus karakter koma
		var asr = document.getElementById("ffAsuransi").value;// Get Potongan Asuransi [%]
		var conv_asr = asr.replace(/,/g, "");// hapus karakter koma
		var pblt = document.getElementById("fcPblt").value;// Get Pembulatan
		var conv_pblt = pblt.replace(/,/g, "");// hapus karakter koma
		var provisi = document.getElementById("ffProvisi").value;// Get Potongan Provisi [%]
		var conv_provisi = provisi.replace(/,/g, "");// hapus karakter koma
		var ppap = document.getElementById("ffPpap").value;// Get Potongan PPAP [%]
		var conv_ppap = ppap.replace(/,/g, "");// hapus karakter koma

		var mtr = document.getElementById("fcMaterai").value;// Get Materai
		var conv_mtr = mtr.replace(/,/g, "");// hapus karakter koma
		var rrp = document.getElementById("fcRrp").value;// Get RRP
		var conv_rrp = rrp.replace(/,/g, "");// hapus karakter koma
		var pel = document.getElementById("fcPelunasan").value;// Get Pelunasan
		var conv_pel = pel.replace(/,/g, "");// hapus karakter koma
		var dis = document.getElementById("fcDiskon").value;// Get Diskon Pelunasan
		var conv_dis = dis.replace(/,/g, "");// hapus karakter koma
		var terimabersih = document.getElementById("fcTerimaBersih").value;// Get Terima Bersih
		var conv_terimabersih = terimabersih.replace(/,/g, "");// hapus karakter koma
	//=================================================================
	//  Jika Plafond Pinjaman kosong maka Jangka Waktu di disable		
		if(x!=''){
			var open= document.getElementById("fnJW").disabled = false;
		}else{
			var open= document.getElementById("fnJW").disabled = true;
			this.$(this.fnJW).val(0);
		}
	//=================================================================	
		admhasil=conv_adm/100*conv_x;// Menghitung Potongan Adm [%]
		conv_admhasil=admhasil.formatMoney();//convert Potongan Adm ke currency
		asrhasil=conv_asr/100*conv_x;// Menghitung Potongan Asuransi [%]
		conv_asrhasil=asrhasil.formatMoney();//convert Potongan Asuransi ke currency

		provisihasil=conv_provisi/100*conv_x;// Menghitung Potongan Provisi [%]
		conv_provisihasil=provisihasil.formatMoney();//convert Potongan Provisi ke currency
		ppaphasil=conv_ppap/100*conv_x;// Menghitung Potongan PPAP [%]
		conv_ppaphasil=ppaphasil.formatMoney();//convert Potongan PAPP ke currency

		trmbersih=conv_x-admhasil-asrhasil-provisihasil-ppaphasil-conv_mtr-conv_rrp-conv_pblt;// Menghitung terima bersih dari plafond pinjaman - Potongan Adm - Potongan Asuransi - Potongan Provisi - Potongan PPAP - Materai
		trmbersih2 =  Math.floor(trmbersih);// Pembulatan ke bawah Terima Bersih
	//=================================================================		
		// Cari selisih pembulatan terima bersih
		pbltp =  trmbersih2/100;//
		pbltp2 =  Math.floor(pbltp);//
		pbltp3 =  pbltp2*100;
		pbltp4 =  pbltp3-trmbersih2;
	//=================================================================	
		totalp =   conv_x - (-conv_dis) - admhasil - asrhasil-provisihasil-ppaphasil-conv_mtr-conv_rrp- pbltp4-conv_pel-conv_sim-conv_pblt;// Hitung total terima bersih	(plafond pinjaman - Potongan Adm - Potongan Asuransi - Potongan Provisi - Potongan PPAP - Materai - selisih pembulatan - Pelunasan )
	//=================================================================		
		// pembulatan kebawah total terima bersih
		 hasil = (Math.floor(parseInt(totalp))%parseInt(100) == 0)? Math.floor(parseInt(totalp)) : Math.floor((parseInt(totalp)+parseInt(100)/2)/parseInt(100))*parseInt(100);
		conv_totalp=hasil.formatMoney();//convert total terima bersih ke currency
		this.$(this.fcPlafondoutput).val(conv_x);
		this.$(this.fcAdm).val(conv_admhasil);
		this.$(this.fcAsuransi).val(conv_asrhasil);
		this.$(this.fcProvisi).val(conv_provisihasil);
		this.$(this.fcPpap).val(conv_ppaphasil);
		this.$(this.fcTerimaBersih).val(conv_totalp);
	}
		
		</script>   