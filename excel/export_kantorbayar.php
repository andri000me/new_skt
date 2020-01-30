<?php
session_start();
include "../config/config.php";

$fullname	= $_SESSION['fullname'];
$time=date("h:i:s a");
$time2=date('Y-m-d (H:i:s)');
$tanggal=date('d-F-Y');
$tanggal2=date('Y-m-d');
header("Content-Type: application/msexcel");
header('Content-Disposition: attachment; filename="Export Kantor Bayar ' .$time2.'.xls"');
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Export Kantor Bayar</title>
    <style type="text/css"></style>
</head>

<body>
    <span>Export Kantor Bayar</span><br>
    <span>DATE :
        <?php echo $tanggal;?> </span><br>
    <span>TIME :
        <?php echo $time;?> </span><br>

    <table border="1" width="100%">
        <tr>
            <td width="50" height="50"><b>No</b></td>
            <td width="150"><b>CABANG</b></td>
            <td width="200"><b>KODE KANTOR BAYAR</b></td>
            <td width="200"><b>NAMA KANTOR BAYAR</b></td>
            <td width="100"><b>STATUS</b></td>

        </tr>
        <?php 


	$tampil=mysql_query("SELECT ftcabang, ftKodeKantorBayar, ftNamaKantorBayar,
								CASE 
								WHEN fnStatus = 1 THEN 'AKTIF' ELSE 'TIDAK AKTIF' 
								END AS ftStatus
								FROM tlkantorbayar  ORDER BY ftKodeKantorBayar
								");

$exequeabsdetail = mysql_query($strsql);
while($row = mysql_fetch_array($tampil)){
//	 $tgl_pengajuan=tgl_indo($row[tgl_pengajuan]);
	?>
        <tr>
            <td>
                <?php echo ++$c ?>
            </td>
            <td>
                <?php echo $row['ftcabang'];?>
            </td>
            <td>
                <?php echo $row['ftKodeKantorBayar'];?>
            </td>
            <td>
                <?php echo $row['ftNamaKantorBayar'];?>
            </td>
            <td>
                <?php echo $row['ftStatus'];?>
            </td>



        </tr>
        <?php } ?>
    </table>
</body>

</html>