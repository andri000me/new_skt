<?php
session_start();  
error_reporting(0);
include("../../config/config.php");
$namakelompok=$_GET['x'];
//var_dump($namakelompok);exit;
//$d=$_GET[id];

/*
if(!isset($_SESSION['full_name'])){
echo"Anda Belum Login atau koneksi telah timeout Silakan  ";
echo"<A HREF='../index.php?mod=logout&semua=olo'>Login</A>";
exit;
}
*/

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
            window.opener.document.myForm.kelompok.value = a;
            
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
<table id="formsearch" class="table table-striped " >
            
      <thead>
        <tr>
         <th align="center" >No</th><th align="center">Cabang</th><th align="center">Kode Kelompok</th><th align="center">Nama Kelompok</th><th align="center">Kode Wilayah</th>
         </tr>
        </thead>
        
        <tbody>
                <?php 
                //include("../../config/config.php");
                $tampil=mysql_query("SELECT ftBranch_Code,ftKodeWilayah,ftNamaKelompok,ftKodeKelompok FROM tlkelompok WHERE  fnStatus=1 ORDER BY ftNamaKelompok DESC ");
                $no1 = 0;   
                while($r=mysql_fetch_array($tampil)){
                $no1++; 
                  echo"
                <tr>
                  <td width='40px'>$no1</td>
                  <td>$r[ftBranch_Code]</td>   
                  <td>$r[ftKodeKelompok]</td> 
                  <td width='500px'>";?>
                   <a HREF="javascript:pick('<?php echo htmlentities($r['ftNamaKelompok']);?>'  )" style="text-decoration: none">
                <?php echo  $r['ftNamaKelompok']; ?>
                 </a>
                <?php echo"</td>
                  <td width='60px'>$r[ftKodeWilayah]</td>
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
      