<?php
session_start();  
error_reporting(0);
include("../../config/config.php");
$kantorBayar=$_GET['kantorBayar'];


?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />       
        <title>Tabel Nasabah</title>
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
         <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
         <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
        
        <script>
        
        function pick(a) {
          if (window.opener && !window.opener.closed){
            window.opener.document.myForm.nasabah.value = a;
            
          }
          window.close();
        }
        </script>
        <style type="text/css">
tfoot {
    display: table-header-group;
}
</style>
        <style>
            a:hover, a:visited, a:link, a:active
            {
                text-decoration: none;
            }
            td
            {
            font-family:Tahoma;
            font-size:12pt;
            }
        </style>
    </head>
    <body>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        <div class="box box-primary">
         <div class="box-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title">Tabel Nasabah</h4>
          </div>
        <div class="box-body">
            <div class="table-responsive">
<table id="formsearch" class="table table-striped " onmouseover="this.style.cursor='pointer'">
            
      <thead>
        <tr>
         <th align="center" >No</th><th align="center">No Rekening</th><th align="center">Nama Nasabah</th><th align="center">Tipe Nasabah</th>
         </tr>
        </thead>
        
        <tbody>
                <?php 
                //include("../../config/config.php");
                
                $tampil=mysql_query("SELECT fnTipeNasabah,ftNamaNasabah,ftNoRekening,ftKantorBayar FROM tlnasabah WHERE  fnStatus=1 
                ANd ftKantorBayar LIKE '%".$kantorBayar."%' ORDER BY ftNamaNasabah DESC ");
                $no1 = 0;   
                while($r=mysql_fetch_array($tampil)){
                $no2=htmlentities($r['ftNamaNasabah']);
                $no1++; 
                  echo"
                <tr bgcolor='#d5e8e4' onmouseover=\"bgColor='#FFFF9E'\" onmouseout=\"bgColor='#d5e8e4'\" onclick=\"pick('$no2')\">
                  <td width='40px'>$no1</td>
                  <td>$r[ftNoRekening]</td>   
                  <td width='500px'>$r[ftNamaNasabah]</td>
                  <td width='500px'>$r[fnTipeNasabah]</td>
                  </tr>";
              } ?>
                </tbody>
        </table>
            </div>
            </div>
            </div>
          </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>  
    </body>
</html>
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- page script -->
    <script>
        $(function() {
            $("#formsearch").DataTable();
           
        });
  </script>
      