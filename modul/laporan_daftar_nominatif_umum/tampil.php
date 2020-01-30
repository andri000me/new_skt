<?php
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_rupiah.php";
$allDate = $_GET['allDate'];

$startDate = substr($allDate,0,10);
$endDate = substr($allDate,-10);

 
?>
 <style type="text/css">

 </style>
<?php
$header=mysql_query("SELECT b.ftKantorBayar AS ftKantorBayar,a.fdTrans_date FROM txpinjaman_umum_hdr a LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening WHERE a.fnStatus <> 9 AND b.ftKantorBayar !='' AND a.fdTrans_date <= '$endDate' GROUP BY ftKantorBayar ");
              //while($w=mysql_fetch_array($header)){
                $ketemu=mysql_num_rows($header);
                while($w=mysql_fetch_array($header)){
                      $d=$w[ftKantorBayar];
                    //$e=$w[fdTrans_date];
                      $e=$endDate;

$temp ="<center><b>LAPORAN DAFTAR NOMINATIF UMUM<br>TANGGAL : $e<br>Kantor Bayar : $d";
$temp .="</b></center><table  id='table' class='table table-bordered table-striped' border=1 width=100%>
        <thead>
        <tr class='info'>
			<th colspan='2'><div align='center'>NOMOR</div></th>
			<th width='8%'><div align='center'>TANGGAL</div></th>
			<th width='9%' rowspan='2'><div align='center'>NAMA</div></th>
			<th width='8%' rowspan='2'><div align='center'>JW</div></th>
			<th width='6%' rowspan='2'><div align='center'>SB</div></th>
			<th width='10%' rowspan='2'><div align='center'>PLAFOND</div></th>
			<th width='13%'><div align='center'>SALDO</div></th>
			<th width='3%' rowspan='2'><div align='center'>PENYALURAN</div></th>
			<th width='3%' rowspan='2'><div align='center'>RETURN</div></th>
			<th colspan='2'><div align='center'>POKOK</div></th>
			<th width='3%'><div align='center'>SETOR</div></th>
			<th width='3%' rowspan='2'><div align='center'>TAGIHAN</div></th>
			<th colspan='2'><div align='center'>MUTASI MEMO</div></th>
			<th width='3%'><div align='center'>SALDO</div></th>
		  </tr>
		 <tr class='info'>
			<th width='10%'><div align='center'>URT</div></th>
			<th width='9%'><div align='center'>REKENING</div></th>
			<th><div align='center'>TRANS</div></th>
			<th><div align='center'>AWAL</div></th>
			<th width='3%'><div align='center'>PEMBARUAN</div></th>
			<th width='3%'><div align='center'>PENUTUPAN</div></th>
			<th><div align='center'>SENDIRI</div></th>
			<th width='3%'><div align='center'>DEBIT</div></th>
			<th width='3%'><div align='center'>KREDIT</div></th>
			<th><div align='center'>AKHIR</div></th>
		  </tr>
            <thead>
            <tbody>";           

//$tampil=mysql_query("SELECT * FROM txpinjaman_umum_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
$tampil=mysql_query("SELECT a.ftNoRekening, a.ftNamaNasabah, a.ftKantorBayar, c.fdTrans_date,FORMAT(c.fcPlafond,0) AS fcPlafond,c.fnJW, c.ffBunga,
b.*
FROM tlnasabah a
LEFT JOIN ( 
        SELECT yy.ftCustomer_Code, FORMAT(SUM(yy.fcSaldoAwal),0) AS fcSaldoAwal, FORMAT(SUM(yy.fcPinjaman),0) AS fcPinjaman, FORMAT(SUM(yy.fcRetur),0) AS fcRetur, 
        FORMAT(SUM(yy.fcTagihan),0) AS fcTagihan,
        FORMAT(SUM(yy.fcPelunasan),0) AS fcPelunasan, FORMAT(SUM(yy.fcSetorSendiri),0) AS fcSetorSendiri ,
        FORMAT(SUM(yy.fcSaldoAwal)+SUM(yy.fcPinjaman)+SUM(yy.fcRetur) - (SUM(yy.fcTagihan)+SUM(yy.fcPelunasan)+SUM(yy.fcSetorSendiri)),0) AS fcSaldoAkhir
        FROM (
                SELECT xx.ftCustomer_Code, SUM(xx.fcSaldoAwal) AS fcSaldoAwal, 0 AS fcPinjaman, 0 AS fcRetur, 0 AS fcTagihan,
                0 AS fcPelunasan, 0 AS fcSetorSendiri
                FROM (
                        SELECT ftCustomer_Code, fcPlafond AS fcSaldoAwal
                        FROM txpinjaman_umum_hdr
                        WHERE fnstatus = 1 
                        AND fdTrans_date < '$startDate' 
                        

                        UNION ALL

                        SELECT ftCustomer_Code, -fcPokokAngsuran
                        FROM txangsuran_umum_hdr
                        WHERE fnstatus = 1 
                        AND fdTrans_date < '$startDate' 
                       
                ) xx
                GROUP BY xx.ftCustomer_Code

                UNION ALL

                SELECT xx.ftCustomer_Code, 0, SUM(xx.fcPinjaman) AS fcPinjaman, SUM(xx.fcRetur) AS fcRetur, SUM(xx.fcTagihan) AS fcTagihan,
                SUM(xx.fcPelunasan) AS fcPelunasan, SUM(xx.fcSetorSendiri) AS fcSetorSendiri
                FROM (
                        SELECT ftCustomer_Code, fcPlafond AS fcPinjaman, 0 AS fcRetur, 0 AS fcTagihan, 0 AS fcPelunasan , 0 AS fcSetorSendiri
                        FROM txpinjaman_umum_hdr
                        WHERE fnstatus = 1 
                        AND fdTrans_date BETWEEN '$startDate' AND '$endDate' 
                        

                        UNION ALL

                        SELECT ftCustomer_Code, 0 AS fcPinjaman, 0 AS fcRetur, 0 AS fcTagihan, 0 AS fcPelunasan ,fcPokokAngsuran AS fcSetorSendiri
                        FROM txangsuran_umum_hdr
                        WHERE fnstatus = 1 
                        AND fdTrans_date BETWEEN '$startDate' AND '$endDate' 
                        

                ) xx
                GROUP BY xx.ftCustomer_Code
        ) yy
        GROUP BY yy.ftCustomer_Code
    ) b ON a.ftNoRekening = b.ftCustomer_Code
LEFT JOIN (
        SELECT ftCustomer_Code, fdTrans_date, fnJW, ffBunga, fcPlafond
        FROM txpinjaman_umum_hdr WHERE fcOutstanding <> 0
        AND fnstatus = 1

) c ON a.ftNoRekening =c.ftCustomer_Code

WHERE IFNULL(c.fcPlafond,0) <> 0 and a.ftKantorBayar='$d' ORDER BY a.ftNoRekening ASC
");
//print_r($tampil);exit;
	$no1 = 0;
	while($r=mysql_fetch_array($tampil)){
		
				 $no1++;	
				
 $temp .="   <tr>
        <td>$no1</td>
        <td>$r[ftCustomer_Code]</td>
        <td>$r[fdTrans_date]</td>
        <td>$r[ftNamaNasabah]</td>
        <td>$r[fnJW]</td>
        <td>$r[ffBunga]</td>
        <td>$r[fcPlafond]</td>
        <td>$r[fcSaldoAwal]</td>
        <td>$r[fcPinjaman]</td>
        <td>$r[fcRetur]</td>
        <td>$TAB</td>
        <td>$r[fcPelunasan]</td>
        <td>$r[fcSetorSendiri]</td>
        <td>$r[fcTagihan]</td>
        <td>$ASS</td>
        <td>$PPAP</td>
        <td>$r[fcSaldoAkhir]</td>
        
    </tr>";
	}
	$temp .="</tbody>
	</table>";
	echo $temp;
  }
?>