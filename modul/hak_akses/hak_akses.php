 <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
 <script src="dist/sweetalert.min.js"></script>
 <script type="text/javascript" src="js/pemisah_angka.js"></script>
 <script src="js/jquery-1.8.3.min.js"></script>
 <script>
     function confirmdelete(delUrl) {
         if (confirm("Anda yakin ingin menghapus?")) {
             document.location = delUrl;
         }
     }
 </script>
 <script type="text/javascript">
     function validasi(form) {
         if (form.user_level_id.value == "") {
             sweetAlert("Oops...", "Level User harus di isi!", "error");
             form.user_level_id.focus();
             return (false);
         } else if (form.nama_sub.value == "") {
             sweetAlert("Oops...", "Nama Menu harus di isi!", "error");
             form.nama_sub.focus();
             return (false);
         } 

     }
 </script>





 <?php

//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
//var_dump($_GET[module]);exit;
//if($cek==1 OR $_SESSION[leveluser]=='1' || $_SESSION[leveluser]=='2'  || $_SESSION[leveluser]=='3' || $_SESSION[leveluser]=='4' ){
if(!empty($_SESSION['leveluser'])){  
/*$base_url = $_SERVER['HTTP_HOST'];
  $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));

$aksi="modul/users/aksi_users.php";*/
switch($_GET[act]){
  // Tampil Hubungi Kami
  default:
   ?>


 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         HAK AKSES

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
     <div class="row">
         <div class="col-xs-12">

             <!-- /.box -->

             <div class="box box-primary">
                 <div class="box-header">
                     <ul class="nav navbar-nav">
                         <?php
      // if ($_SESSION[leveluser]=='1' || $_SESSION[leveluser]=='2' || $_SESSION[leveluser]=='3'){
         
       ?>
                         <li>
                             <h3 class="box-title"><input type="button" onclick="location.href='<?php echo " tambah-hak-akses.html ";?>';" value="Tambah" class="btn bg-purple btn-flat margin" /></h3>
                         </li>
                         <?php
          
       // }else{
       //  echo""; 
       // }
      ?>
                        
                     </ul>
                 </div>
                 <!-- /.box-header -->
                 <div class="box-body">
                     <div class="table-responsive">
                         <table id="example1" class="table table-bordered table-striped">
                             <thead>
                                 <tr>
                                     <th>No</th>
                                     <th>User Level</th>
                                     <th>Menu</th>
                                     <th>Group Menu</th>
                                     <th>Nama Modul</th>

                                     <th></th>

                                 </tr>
                             </thead>
                             <tbody>
                                 <?php 
        $p      = new Paging;
        $batas  = 40;
        $posisi = $p->cariPosisi($batas);
       
        $tampil=mysql_query("SELECT a.akses_id,b.nama_sub,b.module_name,c.nama_level,d.nama_menu FROM hak_akses a
                             LEFT JOIN submenu b
                             ON a.sub_id = b.id_sub
                             LEFT JOIN tbl_level c
                             ON a.user_level_id = c.id_level 
                             LEFT JOIN mainmenu d
                             ON b.id_main = d.id_main  
                             ORDER BY c.nama_level");
       
        $no = $posisi+1;
        $no1 = 0; 
        while($r=mysql_fetch_array($tampil)){
         $no1++;  
        
        echo"
                <tr>
          <td><span class='label bg-black disabled color-palette'>$no1</span></td>
                  <td>$r[nama_level]</td>
                  <td>$r[nama_sub]</td> 
                  <td>$r[nama_menu]</td>
                  <td>$r[module_name]</td>"; 
         
                echo"<td width='70px' onmouseover=\"this.style.cursor='pointer'\"><span class='label bg-gray disabled color-palette'><i class='fa fa-edit' title='Edit $r[akses_id]' onclick=\"location.href='edit-hak-akses-$r[akses_id].html';\"></i> &nbsp;&nbsp;&nbsp;";
                echo"<a class='fa fa-trash-o' title='Delete $r[nama_sub]'  href=javascript:confirmdelete('aksi-delete-hak-akses-$r[akses_id].html') ></a>";
                echo"</span></td>"; 
                echo"</tr>";
              
        }
         ?>


                             </tbody>

                         </table>
                     </div>
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
 case "tambah":
  ?>
 <div class="box box-default">
     <div class="box-header with-border">
         <h3 class="box-title">Input Hak Akses</h3>

         <div class="box-tools pull-right">
             <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

         </div>
     </div>
     
            <form id="myForm" autocomplete="off" name="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambah-hak-akses.html" onSubmit="return validasi(this)">
        
              <!-- /.box-header -->
         <div class="box-body" id="myForm">

             <div class="row">
                 <div class="col-md-6">

                     <div class="form-group has-success">
                      <label>Level User&nbsp;&nbsp;&nbsp;<span style="color:red;">*</span></label>
                        <div class="input-group">
                           <input type="text" class="form-control" id="nama_level" placeholder="Input ..." aria-describedby="basic-addon1" name="nama_level" readonly>
                           <input type="hidden" id="user_level_id" name="user_level_id" readonly>
                       <span class="input-group-addon" id="basic-addon1" onmouseover="this.style.cursor='pointer'" 
                        onClick="showLevel('rikues')"><span class='glyphicon glyphicon-new-window' aria-hidden='true'></span></span>
                      </div>
                    </div> 

                    <div class="form-group has-success">
                      <label>Nama Menu&nbsp;&nbsp;&nbsp;<span style="color:red;">*</span></label>
                        <div class="input-group">
                           <input type="text" class="form-control" id="nama_sub" placeholder="Input ..." aria-describedby="basic-addon1" name="nama_sub" readonly>
                           <input type="hidden" id="sub_id" name="sub_id" readonly>
                       <span class="input-group-addon" id="basic-addon1" onmouseover="this.style.cursor='pointer'" 
                        onClick="showMenu(user_level_id)" disabled><span class='glyphicon glyphicon-new-window' aria-hidden='true' ></span></span>
                      </div>
                    </div> 
                  </br>
                     <div class="form-group ">

                     </div>

                     <!-- /.form-group -->
                 </div>



                 <!-- /.col -->
             </div>

             <!-- /.row -->
         </div>
         <!-- /.box-body -->
         <!-- /.box-body -->
         <div class="box-footer">
         
             <a class="btn btn-default" href="hak-akses.html">Cancel</a>
        
             <button type="submit" class="btn btn-info pull-right">Save</button>
         </div>
     </form>
 </div>
 <?php        
     break;
 
 //HARUS DIRUBAH (setting email)
  case "edit":


 //  $edit = mysql_query("SELECT * FROM hak_akses WHERE akses_id='$_GET[akses_id]'");
   $edit = mysql_query("SELECT a.akses_id,a.user_level_id,a.sub_id,b.nama_sub,b.module_name,c.nama_level,d.nama_menu FROM hak_akses a
                             LEFT JOIN submenu b
                             ON a.sub_id = b.id_sub
                             LEFT JOIN tbl_level c
                             ON a.user_level_id = c.id_level 
                             LEFT JOIN mainmenu d
                             ON b.id_main = d.id_main 
                             WHERE a.akses_id='$_GET[akses_id]'");
    $r    = mysql_fetch_array($edit);
  echo"
  <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit Kantor Bayar</h3>

          <div class='box-tools pull-right'>
            <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
           
          </div>
        </div>
        <form id=\"myForm\" autocomplete=\"off\" name=\"myForm\" method=\"POST\" enctype=\"multipart/form-data\" action=\"aksi-edit-hak-akses.html\" onSubmit=\"return validasi(this)\">
        <div class='box-body'>
     <input type=hidden name='akses_id' value='$r[akses_id]'>
          <div class='row'>
            <div class='col-md-6'>
      
      
      <div class='form-group has-success'>
                      <label>Level User&nbsp;&nbsp;&nbsp;<span style='color:red;'>*</span></label>
                        <div class='input-group'>
                           <input type='text' class='form-control' id='nama_level' placeholder='Input ...' aria-describedby='basic-addon1' value='$r[nama_level]' name='nama_level' readonly>
                           <input type='hidden' value='$r[user_level_id]' id='user_level_id' name='user_level_id' readonly>
                       <span class='input-group-addon' id='basic-addon1' onmouseover=\"this.style.cursor='pointer'\" 
                        onClick=\"showLevel('rikues')\"><span class='glyphicon glyphicon-new-window' aria-hidden='true'></span></span>
                      </div>
                    </div> 

                    <div class='form-group has-success'>
                      <label>Nama Menu&nbsp;&nbsp;&nbsp;<span style='color:red;'>*</span></label>
                        <div class='input-group'>
                           <input type='text' class='form-control' id='nama_sub' value='$r[nama_sub]' placeholder='Input ...' aria-describedby='basic-addon1' name='nama_sub' readonly>
                           <input type='hidden' id='sub_id' name='sub_id' value='$r[sub_id]' readonly>
                       <span class='input-group-addon' id='basic-addon1' onmouseover=\"this.style.cursor='pointer'\" 
                        onClick=\"showMenu(user_level_id)\" disabled><span class='glyphicon glyphicon-new-window' aria-hidden='true' ></span></span>
                      </div>
                    </div> 
      
      
           
             
              <!-- /.form-group -->
            </div>
      
      
            <!-- /.col -->
            <div class='col-md-6'>
    
      
        
      "; 
        
                echo"</div>
        
        <!-- /.form-group -->
            </div>
      
            <!-- /.col -->
          </div>
      
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
              <div class='box-footer'>";
             
                echo"<a  class='btn btn-default' href='hak-akses.html'>Cancel</a>";
             
               echo" <button type='submit' class='btn btn-info pull-right'>Update</button>
              
              </div>
    </form>";
    
    echo"  </div>";
   
    break;  
  //edit password
  
   }
   }
  ?>
 <script>
  function showLevel(menu) {
  sList = window.open('modul/hak_akses/level.php', 'Print', 'width=920,height=420,scrollbars=yes');
  }

  function showMenu(menu) {
   var user_id = document.getElementById("user_level_id").value;
   sList = window.open('modul/hak_akses/menu.php?id='+user_id, 'Print', 'width=920,height=420,scrollbars=yes');
  }
</script>