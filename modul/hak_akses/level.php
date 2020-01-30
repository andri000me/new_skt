<?php
session_start(); 
error_reporting(0);
include("../../config/config.php");
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
		<title>User Level</title>
		<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    	 <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
   		 <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
			
		<script>
		/*$(document).ready(function()
		{ 
			   $(document).bind("contextmenu",function(e){
					  return false;
			   }); 
		});*/
		function pick(a, b) {
		  if (window.opener && !window.opener.closed){
			window.opener.document.myForm.user_level_id.value = a;
			window.opener.document.myForm.nama_level.value = b;
			
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
			font-size:10pt;
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
			 <h4 class="modal-title">User Level</h4>
		  </div>
		<div class="box-body">
			<div class="table-responsive">
<table id="formsearch" class="table table-striped " onmouseover="this.style.cursor='pointer'">
            
	  <thead>
		<tr>
		 <th align="center">No</th><th align="center">User Level</th>
		 </tr>
		</thead>
		
		<tbody>
				<?php 
				
				$tampil=mysql_query("SELECT * FROM tbl_level WHERE aktif='Y' ORDER BY nama_level ASC ");
				
				$no1 = 0;	
				while($r=mysql_fetch_array($tampil)){
				$no2=htmlentities($r['id_level']);
				$no3=htmlentities($r['nama_level']);
				$no1++;	
				
				echo"
                <tr bgcolor='#d5e8e4' onmouseover=\"bgColor='#FFFF9E'\" onmouseout=\"bgColor='#d5e8e4'\" onclick=\"pick('$no2','$no3')\">
				  <td>$no1</td>
				  <td>$no3</td>   
				 </tr>";
              
				}
			
			   ?>
               
               
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