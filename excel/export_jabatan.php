<?php
session_start();
include "../config/config.php";

$fullname	= $_SESSION['fullname'];
$time=date("h:i:s a");
$time2=date('Y-m-d (H:i:s)');
$tanggal=date('d-F-Y');
$tanggal2=date('Y-m-d');
header("Content-Type: application/msexcel");
header('Content-Disposition: attachment; filename="Export Jabatan ' .$time2.'.xls"');
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Export Jabatan</title>
    <style type="text/css"></style>
</head>

<body>
    <span>Export Jabatan</span><br>
    <span>DATE :
        <?php echo $tanggal;?> </span><br>
    <span>TIME :
        <?php echo $time;?> </span><br>

    <table border="1" width="100%">
        <tr>
            <td width="50" height="50"><b>No</b></td>
            <td width="200"><b>NAMA</b></td>
            <td width="200"><b>JABATAN</b></td>
            <td width="200"><b>NIK</b></td>

        </tr>
        <?php 


	$tampil=mysql_query("SELECT ftNamaDirektur, ftJabatanDIrektur, ftNIKDirektur
							FROM tljabatan
							UNION ALL
							SELECT ftNamaKabidOps, ftJabatanKabidOps, ftNIKKabidOps
							FROM tljabatan
							UNION ALL
							SELECT ftNamaAdmKredit, ftJabatanAdmKredit, ftNIKAdmKredit
							FROM tljabatan
							UNION ALL
							SELECT ftNamaSimpanan, ftNIKSimpanan, ftJabatanSimpanan
							FROM tljabatan  
							UNION ALL
							SELECT ftNamaKasir,ftJabatanKasir ,ftNIKKasir
							FROM tljabatan  
							UNION ALL
							SELECT ftNamaAkuntansi,ftJabatanAkuntansi ,ftNIKAkuntansi
							FROM tljabatan ");

$exequeabsdetail = mysql_query($strsql);
while($row = mysql_fetch_array($tampil)){
//	 $tgl_pengajuan=tgl_indo($row[tgl_pengajuan]);
	?>
        <tr>
            <td>
                <?php echo ++$c ?>
            </td>
            <td>
                <?php echo $row['ftNamaDirektur'];?>
            </td>
            <td>
                <?php echo $row['ftJabatanDIrektur'];?>
            </td>
            <td>
                <?php echo $row['ftNIKDirektur'];?>
            </td>




        </tr>
        <?php } ?>
    </table>
</body>

</html>