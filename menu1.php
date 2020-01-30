<?php
error_reporting(0);
include "../config/koneksi.php";
$module=$_GET['module'];
$session=$_SESSION[leveluser];

$menuGroupQry = mysql_query("SELECT * FROM mainmenu WHERE id_main in (SELECT distinct a.id_main FROM submenu a
                                        inner join hak_akses b on a.id_sub = b.sub_id WHERE b.user_level_id = '".$session."'
                                  ) AND aktif='Y' order by urutan asc");
while($r=mysql_fetch_array($menuGroupQry)){
echo " <li class='";
        if($module=$module2){
          echo"active ";
        }else{  echo""; }
echo" treeview'>
          <a href='#'>
            <i class='fa $r[class]'></i>
            <span>$r[nama_menu]</span>
            <span class='pull-right-container'>
             <i class='fa fa-angle-left pull-right'></i>
            </span>
          </a>
          <ul class='treeview-menu'>";
            $menuQry          = "SELECT a.* FROM submenu a
                              INNER JOIN hak_akses b
                              ON a.id_sub = b.sub_id
                              LEFT JOIN mainmenu c
                              ON a.id_main = c.id_main
                              WHERE b.user_level_id = '$session' 
                              AND a.id_main=$r[id_main] AND a.id_submain=0 AND a.aktif='Y'
                              ORDER BY a.urutan ASC,a.nama_sub DESC";
            $sub      = mysql_query($menuQry);
       
           while($w=mysql_fetch_array($sub)){
              echo "<li><a href='$w[link_sub]'><i class='fa $w[class_sub]'></i>$w[nama_sub]</a>";
              $sub2 = mysql_query("SELECT * FROM submenu a 
                                  INNER JOIN hak_akses b
                                  ON a.id_sub = b.sub_id WHERE id_submain=$w[id_sub] AND id_submain!=0 GROUP BY module_name");
              $jml2=mysql_num_rows($sub2);
            
        if ($jml2 > 0){
       
          echo "
          <ul class='treeview-menu'>";
          while($s=mysql_fetch_array($sub2)){
          echo "<li><a href='$s[link_sub]'><i class='fa fa-circle-o text-red'></i>$s[nama_sub]</a></li>";
        }
        echo "</ul>";
        }
        echo "</li>";
           }
         echo "
              </ul>
            </li>";
        }        
           

?>