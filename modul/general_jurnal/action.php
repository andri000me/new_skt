<?php
error_reporting(0);
include "../../config/config.php";
$i = $_GET['i'];
//var_dump($i);exit;
$startDate = substr($jumlah,0,8);
$timetarget = substr($jumlah,9,-2);
$timetarget2 = substr($jumlah,-1);
$date2 = date("Y-m-d", strtotime($startDate));
$date = new DateTime($date2);

$i='';

?>
 
            <?php
            $sl_coa="<select name='ftKodePerkiraan[]' id='ftKodePerkiraan' class='form-control input-sm'>";
            $tampil=mysql_query("SELECT * FROM tlnoperkiraan ORDER BY ftKodePerkiraan DESC ");
            $tampil2=mysql_fetch_array($tampil);
        //    var_dump($tampil2);exit;
         //   if(count($tampil)>0)
         //       {
                    while ($row = mysql_fetch_assoc($tampil)) { 
                      
                            $kode=$row['ftKodePerkiraan'];
                        //    $sl_coa.="<option value='$row[ftKodePerkiraan]' >$row[ftKodePerkiraan]</option>";
                            
                        //    $arrCOA=$coa->tampilCOA($kelompok,"",0,0);
                            if($i)
                                {
                                    foreach($kode as $rc)
                                        {
                                         //   $kode=$rc['ftKodePerkiraan'];
                                            $sl_coa.="<option value=$kode>$rc[ftKodePerkiraan]</option>";
                                        }   
                                }
                              
                        }
                   $sl_coa.="</select>";
                   echo $sl_coa;
            //    }
                ?>
            

