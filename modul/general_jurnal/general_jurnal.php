<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<script src="dist/sweetalert.min.js"></script>
<script type="text/javascript" src="js/pemisah_angka.js"></script>
<script src="js/jquery-1.8.3.min.js"></script>

<?php

//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
//if($cek==1 OR $_SESSION[leveluser]=='1' || $_SESSION[leveluser]=='2'  || $_SESSION[leveluser]=='3' || $_SESSION[leveluser]=='4' || $_SESSION[leveluser]=='5'  || $_SESSION[leveluser]=='6' || $_SESSION[leveluser]=='7'){
if(!empty($_SESSION['leveluser'])){      
/*
$base_url = $_SERVER['HTTP_HOST'];
  $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));

$aksi="modul/users/aksi_users.php";*/
switch($_GET[act]){
  // Tampil Hubungi Kami
  default:
   ?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        FORM NASABAH

    </h1>
    <ol class="breadcrumb">
        <li><a href="home.html"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">
            <?php echo"$hari_ini,"; ?>
            <?php echo tgl_indo(date('Y m d'));  ?>
            <?php echo "|";  ?>
            <span id="clock">
                <?php print date('H:i:s'); ?></span></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box-body">
        <div class="col-xs-12">

            <!-- /.box -->

            <div class="box box-primary">
                <div class="box-header">
                    
                </div>
                <!-- /.box-header -->
                <div class="box-body">
            <!-- ==========================================================  -->
            <form action="" method="post" name="frmJurnal" id="frmJurnal" class="form-horizontal" enctype="multipart/form-data">
  
  <input id="idf" value="1" type="hidden" />                
       
        
     <div class="box-body">  
       <div class="form-group">
            <label for="NamaLengkap" class="control-label col-xs-2">No Jurnal</label>
            <div class="col-xs-2">
                
                <input placeholder="No Jurnal" class="form-control input-sm" name="ftNoJurnal" type="text"  id="ftNoJurnal" value=""  />
               
            </div>
        </div> 
       
          <div class="form-group">
            <label for="NamaLengkap" class="control-label col-xs-2">Tanggal</label>
            <div class="col-xs-2">
                
                <input placeholder="YYYY-MM-DD" class="form-control input-sm tgl" name="fdTglJurnal" type="text"  id="fdTglJurnal" value=""  />
               
            </div>
        </div> 
        
        <div class="form-group">
            <label for="NamaLengkap" class="control-label col-xs-2">No Bukti</label>
            <div class="col-xs-2">
                
                <input placeholder="No Bukti" class="form-control input-sm" name="ftNobukti" type="text"  id="ftNobukti" value=""  />
               
            </div>
        </div> 
        
        <div class="form-group">
            <label for="NamaLengkap" class="control-label col-xs-2">Keterangan</label>
            <div class="col-xs-8">
                
               <textarea name="ftNotes" class="form-control input-sm" id="ftNotes" placeholder="Keterangan" ></textarea>
               
            </div>
        </div> 
      </div>  
        
      <?php 
//$arrCG=$coa->tampilCG("",0,0);
            $sl_coa="<select name=coa[] class=form-control input-sm>";
         //   $sl_coa.= "<option value=''>-- Pilih --</option>";
                            $tampil=mysql_query("SELECT * FROM tlnoperkiraan ORDER BY ftKodePerkiraan DESC ");
                            
                            while ($row = mysql_fetch_assoc($tampil)) 
                                {

                                    $ip=$row['ftKodePerkiraan'];
                                //    $sl_coa.= "<option value=''>-- Pilih --</option>";
                                    $sl_coa.= "<option value=$ip>&nbsp;&nbsp;&nbsp;&nbsp;".$row['ftKodePerkiraan']."-".$row['ftNamaPerkiraan']."</option>";
                                }
                           
            $sl_coa.="</select>";
      
  ?>  
      
      <div class="form-group">
        <label for="NamaLengkap" class="control-label col-xs-2 ckeditor"></label>
         
           <div class="col-xs-9">
                <a class="btn btn-primary btn-sm"  onclick="addRincian('<?php echo $sl_coa;?>'); return false;"><i class="glyphicon glyphicon-plus"></i> Tambah Rincian</a> </div>
        </div>  
        
        <div id="divAkun">
        </div>
        
        <div class="form-group">
           <label for="NamaLengkap" class="control-label col-xs-2 ckeditor"></label>
           <div class="col-xs-9">
                <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i>
                    Simpan Transaksi Jurnal Umum
                </button>
            </div>
        </div>
      </form>
            <!-- ==========================================================  -->        
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->



<?php
    break;
   }
   }
 
  ?>




<script>
function addRincian(sl_coa) {
    var max=10;
    var idf = document.getElementById("idf").value;
    var i = idf * 1;
 //   console.log(i);
    if(i <= max){
   
    stre="<div class='form-group'  id='srow" + idf + "'><div class='controls'>";
    stre=stre+"<label for='NamaLengkap' class='control-label col-xs-2 ckeditor'></label>";
    stre=stre+" <div class='col-xs-2'>";
    stre=stre+sl_coa;
    stre=stre+"</div>";
    stre=stre+" <div class='col-xs-2'>";
    stre=stre+"<input placeholder='Nama Perkiraan'  type='text' class='form-control input-sm' name='ftNamaPerkiraan[]'   />";
    stre=stre+"</div>";
    stre=stre+" <div class='col-xs-2'>";
    stre=stre+"<input placeholder='Debet'  type='text' class='form-control input-sm' name='debet[]'   />";
    stre=stre+"</div>";
    stre=stre+" <div class='col-xs-2'>";
    stre=stre+"<input placeholder='Kredit'  type='text' class='form-control input-sm' name='kredit[]'   />";
    stre=stre+"</div>";
 
    stre=stre+"<div class='col-xs-1'> <button type='button' class='btn btn-danger btn-sm' title='Hapus Rincian !' onclick='removeFormField(\"#srow" + idf + "\"); return false;'><i class='glyphicon glyphicon-remove'></i></button></div> </div>";
    $("#divAkun").append(stre);

    idf = (idf-1) + 2;
    document.getElementById("idf").value = idf;
    }
}
function removeFormField(idf) {
    $(idf).remove();
}
</script>