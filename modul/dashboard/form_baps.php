
	  
	  <!-- Tampil SO-->
  <div class="modal fade" id="viewbaps" role="dialog">
    <div class="modal-dialog">
     <!-- Modal content-->
        <div class="modal-content">
		  <div class="modal-header">
			 <button type="button" class="close" data-dismiss="modal">&times;</button>
			 <h4 class="modal-title">VIEW BAPS</h4>
		  </div>
		<div class="modal-body">
			  <div class="table-responsive">
       <table id="formbaps" class="table  table-striped ">
            
	  <thead>
		<tr>
		 <th>No</th><th></th><th>Nomor Internal User</th><th>Nomor SO</th><th>Judul Pekerjaan</th><th>Nominal BAPS</th>
		  <th>Layanan</th><th>Progress Aktivasi</th><th>Aging</th><th>Masa Berlaku Pekerjaan</th><th>Tahun</th>
		 </tr>
		</thead>
		<tbody>
				<?php 
				
				$tampil=mysql_query("SELECT * FROM view_tbl_teknik WHERE aktif='Y' AND nominal_pkt NOT IN('0','') AND tahun='$_GET[act]' ORDER BY id_teknik DESC");
				$date1 = date("Y-m-d");
				$date2=$r["masa_berlaku_pekerjaan"];
			    
				$no1 = 0;	
				while($r=mysql_fetch_array($tampil)){
				$hasil_tgl=$r[aging];
				$nominal_pkt = number_format ($r[nominal_pkt], 0, ',', '.');
				$no1++;	
				$progress=$r[progress_aktivasi] ; 
				echo"
                <tr>
				  <td><span class='label bg-black '>$no1</span></td>
				  <td width='10px'><span class='label label-success'><i class='fa fa-search' onclick=\"window.open('detail-dashboard-$r[id_teknik].html');\" title='View Data $r[no_so]'></i> </span></td>
				  <td><b>$r[no_in_user]</b></td>   
				  <td>$r[no_so]</td> 
				  <td>$r[judul_pekerjaan]</td>
				  <td>$nominal_pkt</td>
				   <td>$r[layanan]</td>";
				  if($progress == 'Instalasi'){
					echo"<td><span class='label label-danger'>$progress </span></td>";
				  }else if($progress == 'Survey'){
					echo"<td><span class='label badge-pink'>$progress </span></td>";  
				  }else if($progress == 'Test Commisioning'){
					echo"<td><span class='label badge-warning'>$progress </span></td>";  
				  }else if($progress == 'Laporan Pekerjaan'){
					echo"<td><span class='label badge-inverse'>$progress </span></td>";  
				  }else if($progress == 'BAUK'  OR $progress == 'BAPS'){
					 echo"<td><span class='label badge-success'>$progress </span></td>";   
				  }else if($progress == 'CANCEL'){
					 echo"<td><span class='label badge-abu'>$progress </span></td>";   
				  }else{
					 echo"<td>$progress</td>";   
				  }
				  if($hasil_tgl < 0 ){
					echo"<td><span class='label bg-gray disabled color-palette'>$hasil_tgl</span></td>";  
				  }else if ($hasil_tgl < 15 ){
					echo"<td><span class='label label-danger'>$hasil_tgl</span></td>";    
				  }else if($hasil_tgl<30){
					echo"<td><span class='label label-warning'>$hasil_tgl</span></td>";   
				 }else {
					echo"<td><span class='label label-success'>$hasil_tgl</span></td>";   
				 
				  }
                  
                 
				  if($hasil_tgl < 0 ){
					echo"<td><span class='label bg-gray disabled color-palette'>$r[masa_berlaku_pekerjaan] </span></td>";  
				  }else if ($hasil_tgl < 15 ){
					echo"<td><span class='label label-danger'>$r[masa_berlaku_pekerjaan] </span></td>";    
				  }else if($hasil_tgl<30){
					echo"<td><span class='label label-warning'>$r[masa_berlaku_pekerjaan] </span></td>";   
				 }else {
					echo"<td><span class='label label-success'>$r[masa_berlaku_pekerjaan] </span></td>";   
				 
				  }
                  
                  echo"
				 <td>$r[tahun]</td>
				 
                
				  
                </tr>";
              
				}
			
			   ?>
               
               
                </tbody>
		</table>
			  </div>
		</div>
        </div>
    </div>
 </div>
   <!-- END -->  