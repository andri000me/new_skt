<?php
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_rupiah.php";

$ALLDate = $_GET['ALLDate'];
$startDate = substr($ALLDate,0,10);
$endDate = substr($ALLDate,18,10);
$kelompok = substr($ALLDate,28);

//var_dump($kelompok);
?>
 <style type="text/css">

 </style>
 <?php
if($kelompok !="all"){
    $header=mysql_query("SELECT b.ftKantorBayar AS ftKantorBayar,a.fdTrans_date FROM txpinjaman_umum_hdr a LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening WHERE a.fnStatus <> 9 AND  b.ftKantorBayar='$kelompok' AND a.fdTrans_date between <= '$endDate' GROUP BY ftKantorBayar ");
            $w=mysql_fetch_array($header);
            //$e=$w[fdTrans_date];
            $e=$endDate;

  $temp2 ="<center><b>LAPORAN DAFTAR NOMINATIF UMUM<br>TANGGAL : $e<br>Kantor Bayar :$kelompok";
   
  $temp2 .="</b></center><table  id='table' class='table table-bordered table-striped' border=1 width=100%>
        <thead>
         <tr class='info'>
			<th colspan='2'><div align='center'>NOMOR</div></th>
			<th width='8%'><div align='center'>TANGGAL</div></th>
			<th width='9%' rowspan='2'><div align='center'>NAMA</div></th>
			<th width='8%' rowspan='2'><div align='center'>JW </div></th>
			<th width='6%' rowspan='2'><div align='center'>Suku Bunga</div></th>
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



//$tampil=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
    $tampil=mysql_query("SELECT a.ftNoRekening, a.ftNamaNasabah, a.ftKantorBayar, c.fdTrans_date,c.fcPlafond AS fcPlafond,c.fnJW, c.ffBunga,
b.*
FROM tlnasabah a
LEFT JOIN ( 
        SELECT yy.ftCustomer_Code, SUM(yy.fcSaldoAwal) AS fcSaldoAwal, SUM(yy.fcPinjaman) AS fcPinjaman, SUM(yy.fcRetur) AS fcRetur, 
        SUM(yy.fcTagihan) AS fcTagihan,
        SUM(yy.fcPelunasan) AS fcPelunasan, SUM(yy.fcSetorSendiri) AS fcSetorSendiri ,
        SUM(yy.fcSaldoAwal)+SUM(yy.fcPinjaman)+SUM(yy.fcRetur) - (SUM(yy.fcTagihan)+SUM(yy.fcPelunasan)+SUM(yy.fcSetorSendiri)) AS fcSaldoAkhir
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

WHERE IFNULL(c.fcPlafond,0) <> 0 and a.ftKantorBayar='$kelompok' ORDER BY a.ftNoRekening ASC");
    $no1 = 0;
    while($r=mysql_fetch_array($tampil)){
           
        
                 $no1++;    
                
    $fcPlafond=format_rupiah($r[fcPlafond]);
	$fcSaldoAwal=format_rupiah($r[fcSaldoAwal]); 
	$fcPinjaman=format_rupiah($r[fcPinjaman]); 
	$fcRetur=format_rupiah($r[fcRetur]); 
	$fcPelunasan=format_rupiah($r[fcPelunasan]); 
	$fcSetorSendiri=format_rupiah($r[fcSetorSendiri]); 
	$fcTagihan=format_rupiah($r[fcTagihan]); 
    $fcSaldoAkhir=format_rupiah($r[fcSaldoAkhir]); 	
 $temp2 .=" <tr>
        <td>$no1</td>
        <td>$r[ftCustomer_Code]</td>
        <td>$r[fdTrans_date]</td>
        <td>$r[ftNamaNasabah]</td>
        <td>$r[fnJW]</td>
        <td>$r[ffBunga]</td>
        <td>$fcPlafond</td>
        <td>$fcSaldoAwal</td>
        <td>$fcPinjaman</td>
        <td>$fcRetur</td>
        <td>$TAB</td>
        <td>$fcPelunasan</td>
        <td>$fcSetorSendiri</td>
        <td>$fcTagihan</td>
        <td>$ASS</td>
        <td>$PPAP</td>
        <td>$fcSaldoAkhir</td>
        
    </tr>";
       
    $total_fcPlafond += $r['fcPlafond'];
    $total_fcSaldoAwal += $r['fcSaldoAwal'];
    $total_fcPinjaman += $r['fcPinjaman'];
    $total_fcRetur += $r['fcRetur'];
    $total_fcPelunasan += $r['fcPelunasan'];
    $total_fcSetorSendiri += $r['fcSetorSendiri'];
    $total_fcTagihan += $r['fcTagihan'];
    $total_fcSaldoAkhir += $r['fcSaldoAkhir'];
    
    }
    $total_fcPlafond=format_rupiah($total_fcPlafond);
    $total_fcSaldoAwal=format_rupiah($total_fcSaldoAwal);
    $total_fcPinjaman=format_rupiah($total_fcPinjaman);
    $total_fcRetur=format_rupiah($total_fcRetur);
    $total_fcPelunasan=format_rupiah($total_fcPelunasan);
    $total_fcSetorSendiri=format_rupiah($total_fcSetorSendiri);
    $total_fcTagihan=format_rupiah($total_fcTagihan);
    $total_fcSaldoAkhir=format_rupiah($total_fcSaldoAkhir);
   

$temp2 .="</tbody>
    <tfoot><tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>GRAND TOTAL -></th>
        <th>$total_fcPlafond</th>
        <th>$total_fcSaldoAwal</th>
        <th>$total_fcPinjaman</th>
        <th>$total_fcRetur</th>
        <th>$TAB</th>
        <th>$total_fcPelunasan</th>
        <th>$total_fcSetorSendiri</th>
        <th>$total_fcTagihan</th>
        <th>$ASS</th>
        <th>$PPAP</th>
        <th>$total_fcSaldoAkhir</th>
   </tr>
   </tfoot>
    </table>";
       
echo $temp2;
  } else{
    $header=mysql_query("SELECT b.ftKantorBayar AS ftKantorBayar,a.fdTrans_date FROM txpinjaman_umum_hdr a LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening WHERE a.fnStatus <> 9 AND b.ftKantorBayar !=''  AND a.fdTrans_date <= DATE_FORMAT('$endDate', '%Y-%m-%d') GROUP BY ftKantorBayar ");
              //while($w=mysql_fetch_array($header)){
                $ketemu=mysql_num_rows($header);
               while($w=mysql_fetch_array($header)){
            $d=$w[ftKantorBayar];
            $e=$w[fdTrans_date];
      
 
    
 $temp ="<center><b>LAPORAN PENYALURAN KREDIT UMUM<br>TANGGAL : $e<br>Kantor Bayar :$d";
   
  $temp .="</b></center><table  id='table' class='table table-bordered table-striped' border=1 width=100%>
        <thead>
        <tr class='info'>
			<th colspan='2'><div align='center'>NOMOR</div></th>
			<th width='8%'><div align='center'>TANGGAL</div></th>
			<th width='9%' rowspan='2'><div align='center'>NAMA</div></th>
			<th width='8%' rowspan='2'><div align='center'>JW </div></th>
			<th width='6%' rowspan='2'><div align='center'>Suku Bunga</div></th>
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



//$tampil=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
    $tampil=mysql_query("SELECT a.ftNoRekening, a.ftNamaNasabah, a.ftKantorBayar, c.fdTrans_date,c.fcPlafond AS fcPlafond,c.fnJW, c.ffBunga,
b.*
FROM tlnasabah a
LEFT JOIN ( 
        SELECT yy.ftCustomer_Code, SUM(yy.fcSaldoAwal) AS fcSaldoAwal, SUM(yy.fcPinjaman) AS fcPinjaman, SUM(yy.fcRetur) AS fcRetur, 
        SUM(yy.fcTagihan) AS fcTagihan,
        SUM(yy.fcPelunasan) AS fcPelunasan, SUM(yy.fcSetorSendiri) AS fcSetorSendiri ,
        SUM(yy.fcSaldoAwal)+SUM(yy.fcPinjaman)+SUM(yy.fcRetur) - (SUM(yy.fcTagihan)+SUM(yy.fcPelunasan)+SUM(yy.fcSetorSendiri)) AS fcSaldoAkhir
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

WHERE IFNULL(c.fcPlafond,0) <> 0 and a.ftKantorBayar='$d' ORDER BY a.ftNoRekening ASC");
//print_r($tampil);exit;
    $no1 = 0;
//   echo $tampil;exit;
    while($r=mysql_fetch_array($tampil)){
    $no1++;
    $fcPlafond=format_rupiah($r[fcPlafond]);
	$fcSaldoAwal=format_rupiah($r[fcSaldoAwal]); 
	$fcPinjaman=format_rupiah($r[fcPinjaman]); 
	$fcRetur=format_rupiah($r[fcRetur]); 
	$fcPelunasan=format_rupiah($r[fcPelunasan]); 
	$fcSetorSendiri=format_rupiah($r[fcSetorSendiri]); 
	$fcTagihan=format_rupiah($r[fcTagihan]); 
    $fcSaldoAkhir=format_rupiah($r[fcSaldoAkhir]); 	    
  $temp .="<tr>
        <td>$no1</td>
        <td>$r[ftCustomer_Code]</td>
        <td>$r[fdTrans_date]</td>
        <td>$r[ftNamaNasabah]</td>
        <td>$r[fnJW]</td>
        <td>$r[ffBunga]</td>
        <td>$fcPlafond</td>
        <td>$fcSaldoAwal</td>
        <td>$fcPinjaman</td>
        <td>$fcRetur</td>
        <td>$TAB</td>
        <td>$fcPelunasan</td>
        <td>$fcSetorSendiri</td>
        <td>$fcTagihan</td>
        <td>$ASS</td>
        <td>$PPAP</td>
        <td>$fcSaldoAkhir</td>
        
    </tr>";

   /* $total_nominal_pinjaman += $r['fcPlafond'];
    $total_fcAngsuran += $r['fcAngsuran'];
    $total_tabungan += $r['fcPlafond'];
    $total_fcTotalAngsuran += $r['fcTotalAngsuran'];
    $total_fcAdm += $r['fcAdm'];
    $total_fcMaterai += $r['fcMaterai'];
    $total_fcPblt += $r['fcPblt'];
    $total_fcTabAngsuran += $r['fcTabAngsuran'];
    $total_fcTotalPotongan += $r['fcTotalPotongan'];
    $total_fcTerimaBersih += $r['fcTerimaBersih'];*/
    }
   /* $total_nominal_pinjaman=format_rupiah($total_nominal_pinjaman);
    $total_fcAngsuran=format_rupiah($total_fcAngsuran);
    $total_tabungan=format_rupiah($total_tabungan);
    $total_fcTotalAngsuran=format_rupiah($total_fcTotalAngsuran);
    $total_fcAdm=format_rupiah($total_fcAdm);
    $total_fcMaterai=format_rupiah($total_fcMaterai);
    $total_fcPblt=format_rupiah($total_fcPblt);
    $total_fcTabAngsuran=format_rupiah($total_fcTabAngsuran);
    $total_fcTotalPotongan=format_rupiah($total_fcTotalPotongan);
    $total_fcTerimaBersih=format_rupiah($total_fcTerimaBersih);*/

$temp .="</tbody>
    
    </table>";


    

echo $temp;
}
  }     
    ?>