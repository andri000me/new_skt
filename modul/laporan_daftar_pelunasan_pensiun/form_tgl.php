
	  
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
       <form enctype="multipart/form-data" method="POST" action="excel/export_laporan_daftar_pelunasan_pensiun.php"  id="myForm">
	   <div class="form-group">
                <label>Date range:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="export" class="form-control pull-right" id="reservation">
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