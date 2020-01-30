<style>
.inputstl { 
    padding: 9px; 
    border: solid 1px #B3FFB3; 
    outline: 0; 
    background: -webkit-gradient(linear, left top, left 25, from(#FFFFFF), color-stop(4%, #A4FFA4), to(#FFFFFF)); 
    background: -moz-linear-gradient(top, #FFFFFF, #A4FFA4 1px, #FFFFFF 25px); 
    box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px; 
    -moz-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px; 
    -webkit-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px; 

    } 
   
</style>

  <div class="modal fade" id="tutup_hari" role="dialog">
    <div class="modal-dialog">
     <!-- Modal content-->
        <div class="modal-content">
		  <div class="modal-header">
			 <button type="button" class="close animated rotateIn" data-dismiss="modal">&times;</button>
			 <h4 class="modal-title">TUTUP HARI</h4>
		  </div>
		<div class="modal-body">
			 <!--  <div class="table-responsive"> -->
       <form enctype="multipart/form-data" method="POST" action="modul/close/aksi_close.php"  id="myForm" autocomplete="off">
	   <div class="row">


                <div class="col-xs-6">
        <label>Start Date</label>
                  <?php   
          $query=mysql_fetch_array(mysql_query("SELECT fnid,fnStatus,fdDateFrom,fdDateEnd FROM txtutup_hari ORDER BY fnid DESC LIMIT 0, 1"));
          $id=$query['fnid'];
          $startdate=substr($query['fdDateFrom'],0,10);
          
          $enddate=substr($query['fdDateEnd'],0,10);
                  echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type='hidden' name='id' value='$id' >
                  <input type='text' name='startdate' value='$startdate' class='form-control' placeholder='Input ...' id='startdate' readonly=true>";
        ?>   
                </div>
                <div class="col-xs-6">

                  <label>End Date</label>
                 <input type="text" name="enddate" id="enddate" class="form-control inputstl" value="<?php echo $enddate ?>" >

                </div>               
              </div></br>
	   <div class="box-footer">
                <a  class="btn btn-default" onclick="window.history.go(-0); return false;">Cancel</a>
                <button type="submit" class="btn btn-info pull-right" >Save</button>
              </div>
			</form>  
			  
			  <!-- </div> -->
		</div>
        </div>
    </div>
 </div>
   <!-- END -->  

