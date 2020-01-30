	  <!-- Tampil SO-->
  <div class="modal fade" id="viewso" role="dialog">
    <div class="modal-dialog">
     <!-- Modal content-->
        <div class="modal-content">
		  <div class="modal-header">
			 <button type="button" class="close" data-dismiss="modal">&times;</button>
			 <h4 class="modal-title">Pilih Tanggal</h4>
		  </div>
		<div class="modal-body">
			  <div class="table-responsive">
       <form enctype="multipart/form-data" method="POST" autocomplete="off" action="excel/export_cetak_bukti_angsuran_umum.php"  id="myForm">
       <div class="form-group">
                  <label>Nama Kantor Bayar<span style="color:red;">*</span></label>
                  
                  <select class="form-control select2" style="width: 100%;" name="ftNamaKantorBayar" id="ftNamaKantorBayar">
                            <?php       
                             $tampil=mysql_query("SELECT ftNamaKantorBayar FROM tlkantorbayar WHERE  fnStatus=1 ORDER BY ftNamaKantorBayar ASC ");
                             echo "<option value='' selected>-- Pilih --</option>";
                               while($r=mysql_fetch_array($tampil)){
                               echo "<option value='$r[ftNamaKantorBayar]'>$r[ftNamaKantorBayar]</option>"; }
                               ?>
                        </select> 
                </div>
	   <div class="form-group">
                <label>Date</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tgl" class="form-control pull-right" id="kelompok_date">
                </div>
                <!-- /.input group -->
              </div>
	   <div class="box-footer">
                <a  class="btn btn-default" onclick="window.history.go(-0); return false;">Cancel</a>
                <button type="submit" class="btn btn-info pull-right" >Export</button>
              </div>
			</form>  
			  
			  </div>
		</div>
        </div>
    </div>
 </div>
   <!-- END -->  