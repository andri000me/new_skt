<?php
session_start(); 
error_reporting(0);
include("../../config/config.php");
$d=$_GET['idf'];
?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />		
		<title>Tabel No Perkiraan</title>
	    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
	    <link rel="stylesheet" type="text/css" href="../../css/demo_page.css" type="text/css"  />
		<link rel="stylesheet" type="text/css" href="../../css/demo_table_jui.css" type="text/css"  />
	    <script type="text/javascript" language="javascript" src="../../js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="../../js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				oTable = $('#formsearch').dataTable({
					"sScrollX": "100%",
					"sScrollXInner": "100%",
					"bScrollCollapse": true,
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});
			} );
		</script>
		
<script type="text/javascript">
$(document).ready(function() {
    $('#formsearch tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="&nbsp;Search'+title+'" />' );
    });
});

</script>
<script>
	$(document).ready(function(){ 
		   $(document).bind("contextmenu",function(e){
				  return false;
		   }); 
	});
	
	function pick(a, b,c) {
		if (window.opener && !window.opener.closed){
			window.opener.document.getElementById("ftKodePerkiraan"+c).value = a;
			window.opener.document.getElementById("ftNamaPerkiraan"+c).value = b;
		  }
		window.close();
	}
</script>
		<style type="text/css">
			tfoot {display: table-header-group;}
		</style>
		<style>
			a:hover, a:visited, a:link, a:active{text-decoration: none;}td{font-family:Tahoma;font-size:8pt;}
		</style>
	</head>
	<body>
     <!-- Modal content-->
        <div class="modal-content">
		 <div class="modal-header">
			 <button type="button" class="close" data-dismiss="modal">&times;</button>
			 <h4 class="modal-title">Tabel No Perkiraan</h4>
		  </div>
		<div class="modal-body">
			  <div class="table-responsive">
<table id="formsearch" class="table table-striped " width="98%">
   <thead>
	 <tr><th align="center">No</th><th align="center">Kode Perkiraan</th><th align="center">Nama Perkiraan</th><th align="center">Kode Kategori</th>
	 </tr>
   </thead>
   <tbody>
	<?php 
		$tampil=mysql_query("SELECT ftKodePerkiraan,ftNamaPerkiraan,ftKodeKategori FROM tlnoperkiraan  ORDER BY ftKodePerkiraan ASC ");
		$no1 = 0;	
		while($r=mysql_fetch_array($tampil)){
		$no1++;	
		echo"
            <tr>
			  <td>$no1</td>
			  <td>";?>
			  <a HREF="javascript:pick( 
											'<?php echo htmlentities($r['ftKodePerkiraan']);?>',
											'<?php echo htmlentities($r['ftNamaPerkiraan']);?>',
											'<?php echo htmlentities($d);?>',
				
				)" style="text-decoration: none">
				 <?php echo $r['ftKodePerkiraan'];?>
			  </a>
			  <?php echo"</td>   
			 <td>$r[ftNamaPerkiraan]</td> 
			 <td width='500px'>$r[ftKodeKategori]</td>
	        </tr>";
     		}
	?>
               </tbody>
		     </table>
		   </div>
		 </div>
	   </div>
    </body>
</html>