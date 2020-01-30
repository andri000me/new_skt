<?php
	function tgl_indo_true($tgl){
	
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);

			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	
	function tgl_indo($tgl){
		$query=mysql_fetch_array(mysql_query("SELECT fnid,fnStatus,fdDateFrom,fdDateEnd FROM txtutup_hari ORDER BY fnid DESC LIMIT 0, 1"));
	  	$startdate=substr($query['fdDateFrom'],0,10);
	  			$tanggal = substr($startdate,8,2);
				$bulan = getBulan(substr($startdate,5,2));
				$tahun = substr($startdate,0,4);
				/*$tanggal = substr($tgl,8,2);
				$bulan = getBulan(substr($tgl,5,2));
				$tahun = substr($tgl,0,4);*/

				return $tanggal.' '.$bulan.' '.$tahun;		 
		}
	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			} 
?>
