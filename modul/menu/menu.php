<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
  select{
    font-family: fontAwesome;
    font-weight: 900;

  }
</style>
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
function validasi(form){
  if (form.id_main.value == ""){
   sweetAlert("Oops...", "Group Menu harus di isi!", "error");
   form.id_main.focus();
    return (false);
  }else if(form.nama_sub.value == ""){
   sweetAlert("Oops...", "Nama Menu harus di isi!", "error");
   form.nama_sub.focus();
    return (false);
  }else if(form.link_sub.value == ""){
   sweetAlert("Oops...", "Nama Link harus di isi!", "error");
   form.link_sub.focus();
    return (false);
  }/*else if(form.module_name.value == ""){
   sweetAlert("Oops...", "Nama Module harus di isi!", "error");
   form.module_name.focus();
    return (false);
  }*/
}
</script>





<?php
session_start();
//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
//var_dump($cek);exit;
//if($cek==1 OR $_SESSION[leveluser]=='1' ){
if(!empty($_SESSION['leveluser'])){  

$base_url = $_SERVER['HTTP_HOST'];
  $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));

$aksi="modul/menu/aksi_menu.php";
switch($_GET[act]){
  // Tampil Hubungi Kami
  default:
   ?>
   
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Menu 
        
      </h1>
      <ol class="breadcrumb">
         <li><a href="home.html"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> <?php echo"$hari_ini,"; ?>
							<?php echo tgl_indo(date('Y m d'));  ?>
							<?php echo "|";  ?>
							<span id="clock"><?php print date('H:i:s'); ?></span></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box box-primary">
             <div class="box-header">
			 <?php
			 /*if ($_SESSION[leveluser]=='1'){*/
			 ?>
              <h3 class="box-title"><input type="button" onclick="location.href='<?php echo "tambah-menu.html ";?>';" value="Tambah Menu" class="btn bg-purple btn-flat margin"/></h3>
			 <?php
			/* }else{
				echo""; 
			 }*/
			?>	
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
				  <th>No</th>
          <th>Nama Menu</th>
          <th>Class Menu</th>
				  <th>Link Menu</th>
          <th>Group Menu</th>
          <th>Sub Menu</th>
          <th>Nama Module</th>
          <th>Urutan</th>
				  <th>Aktif</th>
          <th></th>
				 
                </tr>
                </thead>
                <tbody>
				<?php 
				$p      = new Paging;
				$batas  = 40;
				$posisi = $p->cariPosisi($batas);
				
				$tampil=mysql_query("SELECT a.aktif,a.urutan,a.id_sub,a.module_name,a.nama_sub,a.link_sub,a.class_sub,b.nama_menu,a.id_submain FROM submenu a 
                              LEFT JOIN mainmenu b ON a.id_main=b.id_main 
                              ORDER BY a.nama_sub ASC ");
				
				$no = $posisi+1;
				$no1 = 0;	
				while($r=mysql_fetch_array($tampil)){
         $submenu=$r[id_submain]; 
				 $no1++;	
				
				echo"
                <tr>
				  <td><span class='label bg-black disabled color-palette'>$no1</span></td>
          <td>$r[nama_sub]</td> 
				  <td>$r[class_sub]</td>
          <td>$r[link_sub]</td> 
          <td>$r[nama_menu]</td>";
          $tampil2=mysql_query("SELECT nama_sub nama_sub_menu FROM submenu WHERE id_sub='$submenu' ");
          $s=mysql_fetch_array($tampil2);
          echo"<td>$s[nama_sub_menu]</td>";
          echo"<td>$r[module_name]</td>";
				  echo"<td>$r[urutan]</td>";
				  if($r[aktif] !='N'){
					echo" <td><span class='label label-success'>$r[aktif]</span></td>";  
				  }else{
					echo" <td><span class='label label-danger'>$r[aktif]</span></td>";    
				  }
          echo"
               <td width='70px' onmouseover=\"this.style.cursor='pointer'\"> $show &nbsp;&nbsp;&nbsp; <i class='fa fa-edit' title='edit $r[nama_sub]' onclick=\"location.href='edit-menu-$r[id_sub].html';\"></i> &nbsp;&nbsp;&nbsp;";
				 /* if($_SESSION[leveluser]=='1'){*/
				  echo"<a class='fa fa-trash-o' title='delete $r[id_sub]'  href=javascript:confirmdelete('$aksi?module=menu&act=hapus&id_sub=$r[id_sub]') ></a>";
				  /*}else{
					  echo"";
				  }*/
				  echo"</td>
				  
                </tr>";
              
				}
			   ?>
                </tbody>
              </table>
            </div> </div>
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
          <h3 class="box-title">Input Menu</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
		<form id="myForm" name="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambah-menu.html" onSubmit="return validasi(this)">
        <!-- /.box-header -->
        <div class="box-body" id="myForm">
		
          <div class="row">
            <div class="col-md-6">
      <div class="form-group has-success">
                      <label>Group Menu&nbsp;&nbsp;&nbsp;<span style="color:red;">*</span></label>
                        <div class="input-group">
                           <input type="text" class="form-control" id="nama_menu" placeholder="Input ..." aria-describedby="basic-addon1" name="nama_menu" readonly>
                           <input type="hidden" id="id_main" name="id_main" readonly>
                       <span class="input-group-addon" id="basic-addon1" onmouseover="this.style.cursor='pointer'" 
                        onClick="showGroupmenu('rikues')"><span class='glyphicon glyphicon-new-window' aria-hidden='true'></span></span>
                      </div>
                    </div>         
			

			<div class="form-group" id="no_so22">
                  <label>Nama Menu<span style='color:red;'>*</span></label>
                  <input type="text" name="nama_sub" class="form-control" placeholder="Nama Menu" id="nama_sub">
                  <?php
              if(isset($_GET['error']))
              {
              ?>
              <span class="help-block">Nama Sudah Ada</span>
              <?php
              }
              ?>
				    </div>
    <div class="form-group">
                  <label>Link</label>
                  <input type="text" name="link_sub" id="link_sub" class="form-control" placeholder="Link">
                </div>
      <div class="form-group">
                  <label>Nama Module</label>
                  <input type="text" name="module_name" id="module_name" class="form-control" placeholder="Nama Module">
                </div>
    <div class="form-group has-success">
                      <label>Sub Menu&nbsp;&nbsp;&nbsp;<span style="color:red;">*</span></label>
                        <div class="input-group">
                           <input type="text" class="form-control" id="nama_sub2" placeholder="Input ..." aria-describedby="basic-addon1" name="nama_sub2" readonly>
                           <input type="hidden" id="id_submain" name="id_submain" readonly>
                       <span class="input-group-addon" id="basic-addon1" onmouseover="this.style.cursor='pointer'" 
                        onClick="showSubmenu('rikues')"><span class='glyphicon glyphicon-new-window' aria-hidden='true'></span></span>
                      </div>
                    </div> 
     <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="urutan" id="urutan" class="form-control" placeholder="Isi Dengan Angka">
              </div>                        
			<div class="form-group">
                  <label>Class</label>
                  <select class="form-control" style="width: 100%;" name="class_sub" id="class_sub">
     <option value='fa-500px'>&#xf26e; fa-500px</option>
    <option value='fa-address-book'>&#xf2b9; fa-address-book</option>
    <option value='fa-address-book-o'>&#xf2ba; fa-address-book-o</option>
    <option value='fa-address-card'>&#xf2bb; fa-address-card</option>
    <option value='fa-address-card-o'>&#xf2bc; fa-address-card-o</option>
    <option value='fa-adjust'>&#xf042; fa-adjust</option>
    <option value='fa-adn'>&#xf170; fa-adn</option>
    <option value='fa-align-center'>&#xf037; fa-align-center</option>
    <option value='fa-align-justify'>&#xf039; fa-align-justify</option>
    <option value='fa-align-left'>&#xf036; fa-align-left</option>
    <option value='fa-align-right'>&#xf038; fa-align-right</option>
    <option value='fa-amazon'>&#xf270; fa-amazon</option>
    <option value='fa-ambulance'>&#xf0f9; fa-ambulance</option>
    <option value='fa-american-sign-language-interpreting'>&#xf2a3; fa-american-sign-language-interpreting</option>
    <option value='fa-anchor'>&#xf13d; fa-anchor</option>
    <option value='fa-android'>&#xf17b; fa-android</option>
    <option value='fa-angellist'>&#xf209; fa-angellist</option>
    <option value='fa-angle-double-down'>&#xf103; fa-angle-double-down</option>
    <option value='fa-angle-double-left'>&#xf100; fa-angle-double-left</option>
    <option value='fa-angle-double-right'>&#xf101; fa-angle-double-right</option>
    <option value='fa-angle-double-up'>&#xf102; fa-angle-double-up</option>
    <option value='fa-angle-down'>&#xf107; fa-angle-down</option>
    <option value='fa-angle-left'>&#xf104; fa-angle-left</option>
    <option value='fa-angle-right'>&#xf105; fa-angle-right</option>
    <option value='fa-angle-up'>&#xf106; fa-angle-up</option>
    <option value='fa-apple'>&#xf179; fa-apple</option>
    <option value='fa-archive'>&#xf187; fa-archive</option>
    <option value='fa-area-chart'>&#xf1fe; fa-area-chart</option>
    <option value='fa-arrow-circle-down'>&#xf0ab; fa-arrow-circle-down</option>
    <option value='fa-arrow-circle-left'>&#xf0a8; fa-arrow-circle-left</option>
    <option value='fa-arrow-circle-o-down'>&#xf01a; fa-arrow-circle-o-down</option>
    <option value='fa-arrow-circle-o-left'>&#xf190; fa-arrow-circle-o-left</option>
    <option value='fa-arrow-circle-o-right'>&#xf18e; fa-arrow-circle-o-right</option>
    <option value='fa-arrow-circle-o-up'>&#xf01b; fa-arrow-circle-o-up</option>
    <option value='fa-arrow-circle-right'>&#xf0a9; fa-arrow-circle-right</option>
    <option value='fa-arrow-circle-up'>&#xf0aa; fa-arrow-circle-up</option>
    <option value='fa-arrow-down'>&#xf063; fa-arrow-down</option>
    <option value='fa-arrow-left'>&#xf060; fa-arrow-left</option>
    <option value='fa-arrow-right'>&#xf061; fa-arrow-right</option>
    <option value='fa-arrow-up'>&#xf062; fa-arrow-up</option>
    <option value='fa-arrows'>&#xf047; fa-arrows</option>
    <option value='fa-arrows-alt'>&#xf0b2; fa-arrows-alt</option>
    <option value='fa-arrows-h'>&#xf07e; fa-arrows-h</option>
    <option value='fa-arrows-v'>&#xf07d; fa-arrows-v</option>
    <option value='fa-asl-interpreting'>&#xf2a3; fa-asl-interpreting</option>
    <option value='fa-assistive-listening-systems'>&#xf2a2; fa-assistive-listening-systems</option>
    <option value='fa-asterisk'>&#xf069; fa-asterisk</option>
    <option value='fa-at'>&#xf1fa; fa-at</option>
    <option value='fa-audio-description'>&#xf29e; fa-audio-description</option>
    <option value='fa-automobile'>&#xf1b9; fa-automobile</option>
    <option value='fa-backward'>&#xf04a; fa-backward</option>
    <option value='fa-balance-scale'>&#xf24e; fa-balance-scale</option>
    <option value='fa-ban'>&#xf05e; fa-ban</option>
    <option value='fa-bandcamp'>&#xf2d5; fa-bandcamp</option>
    <option value='fa-bank'>&#xf19c; fa-bank</option>
    <option value='fa-bar-chart'>&#xf080; fa-bar-chart</option>
    <option value='fa-bar-chart-o'>&#xf080; fa-bar-chart-o</option>
    <option value='fa-barcode'>&#xf02a; fa-barcode</option>
    <option value='fa-bars'>&#xf0c9; fa-bars</option>
    <option value='fa-bath'>&#xf2cd; fa-bath</option>
    <option value='fa-bathtub'>&#xf2cd; fa-bathtub</option>
    <option value='fa-battery'>&#xf240; fa-battery</option>
    <option value='fa-battery-0'>&#xf244; fa-battery-0</option>
    <option value='fa-battery-1'>&#xf243; fa-battery-1</option>
    <option value='fa-battery-2'>&#xf242; fa-battery-2</option>
    <option value='fa-battery-3'>&#xf241; fa-battery-3</option>
    <option value='fa-battery-4'>&#xf240; fa-battery-4</option>
    <option value='fa-battery-empty'>&#xf244; fa-battery-empty</option>
    <option value='fa-battery-full'>&#xf240; fa-battery-full</option>
    <option value='fa-battery-half'>&#xf242; fa-battery-half</option>
    <option value='fa-battery-quarter'>&#xf243; fa-battery-quarter</option>
    <option value='fa-battery-three-quarters'>&#xf241; fa-battery-three-quarters</option>
    <option value='fa-bed'>&#xf236; fa-bed</option>
    <option value='fa-beer'>&#xf0fc; fa-beer</option>
    <option value='fa-behance'>&#xf1b4; fa-behance</option>
    <option value='fa-behance-square'>&#xf1b5; fa-behance-square</option>
    <option value='fa-bell'>&#xf0f3; fa-bell</option>
    <option value='fa-bell-o'>&#xf0a2; fa-bell-o</option>
    <option value='fa-bell-slash'>&#xf1f6; fa-bell-slash</option>
    <option value='fa-bell-slash-o'>&#xf1f7; fa-bell-slash-o</option>
    <option value='fa-bicycle'>&#xf206; fa-bicycle</option>
    <option value='fa-binoculars'>&#xf1e5; fa-binoculars</option>
    <option value='fa-birthday-cake'>&#xf1fd; fa-birthday-cake</option>
    <option value='fa-bitbucket'>&#xf171; fa-bitbucket</option>
    <option value='fa-bitbucket-square'>&#xf172; fa-bitbucket-square</option>
    <option value='fa-bitcoin'>&#xf15a; fa-bitcoin</option>
    <option value='fa-black-tie'>&#xf27e; fa-black-tie</option>
    <option value='fa-blind'>&#xf29d; fa-blind</option>
    <option value='fa-bluetooth'>&#xf293; fa-bluetooth</option>
    <option value='fa-bluetooth-b'>&#xf294; fa-bluetooth-b</option>
    <option value='fa-bold'>&#xf032; fa-bold</option>
    <option value='fa-bolt'>&#xf0e7; fa-bolt</option>
    <option value='fa-bomb'>&#xf1e2; fa-bomb</option>
    <option value='fa-book'>&#xf02d; fa-book</option>
    <option value='fa-bookmark'>&#xf02e; fa-bookmark</option>
    <option value='fa-bookmark-o'>&#xf097; fa-bookmark-o</option>
    <option value='fa-braille'>&#xf2a1; fa-braille</option>
    <option value='fa-briefcase'>&#xf0b1; fa-briefcase</option>
    <option value='fa-btc'>&#xf15a; fa-btc</option>
    <option value='fa-bug'>&#xf188; fa-bug</option>
    <option value='fa-building'>&#xf1ad; fa-building</option>
    <option value='fa-building-o'>&#xf0f7; fa-building-o</option>
    <option value='fa-bullhorn'>&#xf0a1; fa-bullhorn</option>
    <option value='fa-bullseye'>&#xf140; fa-bullseye</option>
    <option value='fa-bus'>&#xf207; fa-bus</option>
    <option value='fa-buysellads'>&#xf20d; fa-buysellads</option>
    <option value='fa-cab'>&#xf1ba; fa-cab</option>
    <option value='fa-calculator'>&#xf1ec; fa-calculator</option>
    <option value='fa-calendar'>&#xf073; fa-calendar</option>
    <option value='fa-calendar-check-o'>&#xf274; fa-calendar-check-o</option>
    <option value='fa-calendar-minus-o'>&#xf272; fa-calendar-minus-o</option>
    <option value='fa-calendar-o'>&#xf133; fa-calendar-o</option>
    <option value='fa-calendar-plus-o'>&#xf271; fa-calendar-plus-o</option>
    <option value='fa-calendar-times-o'>&#xf273; fa-calendar-times-o</option>
    <option value='fa-camera'>&#xf030; fa-camera</option>
    <option value='fa-camera-retro'>&#xf083; fa-camera-retro</option>
    <option value='fa-car'>&#xf1b9; fa-car</option>
    <option value='fa-caret-down'>&#xf0d7; fa-caret-down</option>
    <option value='fa-caret-left'>&#xf0d9; fa-caret-left</option>
    <option value='fa-caret-right'>&#xf0da; fa-caret-right</option>
    <option value='fa-caret-square-o-down'>&#xf150; fa-caret-square-o-down</option>
    <option value='fa-caret-square-o-left'>&#xf191; fa-caret-square-o-left</option>
    <option value='fa-caret-square-o-right'>&#xf152; fa-caret-square-o-right</option>
    <option value='fa-caret-square-o-up'>&#xf151; fa-caret-square-o-up</option>
    <option value='fa-caret-up'>&#xf0d8; fa-caret-up</option>
    <option value='fa-cart-arrow-down'>&#xf218; fa-cart-arrow-down</option>
    <option value='fa-cart-plus'>&#xf217; fa-cart-plus</option>
    <option value='fa-cc'>&#xf20a; fa-cc</option>
    <option value='fa-cc-amex'>&#xf1f3; fa-cc-amex</option>
    <option value='fa-cc-diners-club'>&#xf24c; fa-cc-diners-club</option>
    <option value='fa-cc-discover'>&#xf1f2; fa-cc-discover</option>
    <option value='fa-cc-jcb'>&#xf24b; fa-cc-jcb</option>
    <option value='fa-cc-mastercard'>&#xf1f1; fa-cc-mastercard</option>
    <option value='fa-cc-paypal'>&#xf1f4; fa-cc-paypal</option>
    <option value='fa-cc-stripe'>&#xf1f5; fa-cc-stripe</option>
    <option value='fa-cc-visa'>&#xf1f0; fa-cc-visa</option>
    <option value='fa-certificate'>&#xf0a3; fa-certificate</option>
    <option value='fa-chain'>&#xf0c1; fa-chain</option>
    <option value='fa-chain-broken'>&#xf127; fa-chain-broken</option>
    <option value='fa-check'>&#xf00c; fa-check</option>
    <option value='fa-check-circle'>&#xf058; fa-check-circle</option>
    <option value='fa-check-circle-o'>&#xf05d; fa-check-circle-o</option>
    <option value='fa-check-square'>&#xf14a; fa-check-square</option>
    <option value='fa-check-square-o'>&#xf046; fa-check-square-o</option>
    <option value='fa-chevron-circle-down'>&#xf13a; fa-chevron-circle-down</option>
    <option value='fa-chevron-circle-left'>&#xf137; fa-chevron-circle-left</option>
    <option value='fa-chevron-circle-right'>&#xf138; fa-chevron-circle-right</option>
    <option value='fa-chevron-circle-up'>&#xf139; fa-chevron-circle-up</option>
    <option value='fa-chevron-down'>&#xf078; fa-chevron-down</option>
    <option value='fa-chevron-left'>&#xf053; fa-chevron-left</option>
    <option value='fa-chevron-right'>&#xf054; fa-chevron-right</option>
    <option value='fa-chevron-up'>&#xf077; fa-chevron-up</option>
    <option value='fa-child'>&#xf1ae; fa-child</option>
    <option value='fa-chrome'>&#xf268; fa-chrome</option>
    <option value='fa-circle'>&#xf111; fa-circle</option>
    <option value='fa-circle-o'>&#xf10c; fa-circle-o</option>
    <option value='fa-circle-o-notch'>&#xf1ce; fa-circle-o-notch</option>
    <option value='fa-circle-thin'>&#xf1db; fa-circle-thin</option>
    <option value='fa-clipboard'>&#xf0ea; fa-clipboard</option>
    <option value='fa-clock-o'>&#xf017; fa-clock-o</option>
    <option value='fa-clone'>&#xf24d; fa-clone</option>
    <option value='fa-close'>&#xf00d; fa-close</option>
    <option value='fa-cloud'>&#xf0c2; fa-cloud</option>
    <option value='fa-cloud-download'>&#xf0ed; fa-cloud-download</option>
    <option value='fa-cloud-upload'>&#xf0ee; fa-cloud-upload</option>
    <option value='fa-cny'>&#xf157; fa-cny</option>
    <option value='fa-code'>&#xf121; fa-code</option>
    <option value='fa-code-fork'>&#xf126; fa-code-fork</option>
    <option value='fa-codepen'>&#xf1cb; fa-codepen</option>
    <option value='fa-codiepie'>&#xf284; fa-codiepie</option>
    <option value='fa-coffee'>&#xf0f4; fa-coffee</option>
    <option value='fa-cog'>&#xf013; fa-cog</option>
    <option value='fa-cogs'>&#xf085; fa-cogs</option>
    <option value='fa-columns'>&#xf0db; fa-columns</option>
    <option value='fa-comment'>&#xf075; fa-comment</option>
    <option value='fa-comment-o'>&#xf0e5; fa-comment-o</option>
    <option value='fa-commenting'>&#xf27a; fa-commenting</option>
    <option value='fa-commenting-o'>&#xf27b; fa-commenting-o</option>
    <option value='fa-comments'>&#xf086; fa-comments</option>
    <option value='fa-comments-o'>&#xf0e6; fa-comments-o</option>
    <option value='fa-compass'>&#xf14e; fa-compass</option>
    <option value='fa-compress'>&#xf066; fa-compress</option>
    <option value='fa-connectdevelop'>&#xf20e; fa-connectdevelop</option>
    <option value='fa-contao'>&#xf26d; fa-contao</option>
    <option value='fa-copy'>&#xf0c5; fa-copy</option>
    <option value='fa-copyright'>&#xf1f9; fa-copyright</option>
    <option value='fa-creative-commons'>&#xf25e; fa-creative-commons</option>
    <option value='fa-credit-card'>&#xf09d; fa-credit-card</option>
    <option value='fa-credit-card-alt'>&#xf283; fa-credit-card-alt</option>
    <option value='fa-crop'>&#xf125; fa-crop</option>
    <option value='fa-crosshairs'>&#xf05b; fa-crosshairs</option>
    <option value='fa-css3'>&#xf13c; fa-css3</option>
    <option value='fa-cube'>&#xf1b2; fa-cube</option>
    <option value='fa-cubes'>&#xf1b3; fa-cubes</option>
    <option value='fa-cut'>&#xf0c4; fa-cut</option>
    <option value='fa-cutlery'>&#xf0f5; fa-cutlery</option>
    <option value='fa-dashboard'>&#xf0e4; fa-dashboard</option>
    <option value='fa-dashcube'>&#xf210; fa-dashcube</option>
    <option value='fa-database'>&#xf1c0; fa-database</option>
    <option value='fa-deaf'>&#xf2a4; fa-deaf</option>
    <option value='fa-deafness'>&#xf2a4; fa-deafness</option>
    <option value='fa-dedent'>&#xf03b; fa-dedent</option>
    <option value='fa-delicious'>&#xf1a5; fa-delicious</option>
    <option value='fa-desktop'>&#xf108; fa-desktop</option>
    <option value='fa-deviantart'>&#xf1bd; fa-deviantart</option>
    <option value='fa-diamond'>&#xf219; fa-diamond</option>
    <option value='fa-digg'>&#xf1a6; fa-digg</option>
    <option value='fa-dollar'>&#xf155; fa-dollar</option>
    <option value='fa-dot-circle-o'>&#xf192; fa-dot-circle-o</option>
    <option value='fa-download'>&#xf019; fa-download</option>
    <option value='fa-dribbble'>&#xf17d; fa-dribbble</option>
    <option value='fa-drivers-license'>&#xf2c2; fa-drivers-license</option>
    <option value='fa-drivers-license-o'>&#xf2c3; fa-drivers-license-o</option>
    <option value='fa-dropbox'>&#xf16b; fa-dropbox</option>
    <option value='fa-drupal'>&#xf1a9; fa-drupal</option>
    <option value='fa-edge'>&#xf282; fa-edge</option>
    <option value='fa-edit'>&#xf044; fa-edit</option>
    <option value='fa-eercast'>&#xf2da; fa-eercast</option>
    <option value='fa-eject'>&#xf052; fa-eject</option>
    <option value='fa-ellipsis-h'>&#xf141; fa-ellipsis-h</option>
    <option value='fa-ellipsis-v'>&#xf142; fa-ellipsis-v</option>
    <option value='fa-empire'>&#xf1d1; fa-empire</option>
    <option value='fa-envelope'>&#xf0e0; fa-envelope</option>
    <option value='fa-envelope-o'>&#xf003; fa-envelope-o</option>
    <option value='fa-envelope-open'>&#xf2b6; fa-envelope-open</option>
    <option value='fa-envelope-open-o'>&#xf2b7; fa-envelope-open-o</option>
    <option value='fa-envelope-square'>&#xf199; fa-envelope-square</option>
    <option value='fa-envira'>&#xf299; fa-envira</option>
    <option value='fa-eraser'>&#xf12d; fa-eraser</option>
    <option value='fa-etsy'>&#xf2d7; fa-etsy</option>
    <option value='fa-eur'>&#xf153; fa-eur</option>
    <option value='fa-euro'>&#xf153; fa-euro</option>
    <option value='fa-exchange'>&#xf0ec; fa-exchange</option>
    <option value='fa-exclamation'>&#xf12a; fa-exclamation</option>
    <option value='fa-exclamation-circle'>&#xf06a; fa-exclamation-circle</option>
    <option value='fa-exclamation-triangle'>&#xf071; fa-exclamation-triangle</option>
    <option value='fa-expand'>&#xf065; fa-expand</option>
    <option value='fa-expeditedssl'>&#xf23e; fa-expeditedssl</option>
    <option value='fa-external-link'>&#xf08e; fa-external-link</option>
    <option value='fa-external-link-square'>&#xf14c; fa-external-link-square</option>
    <option value='fa-eye'>&#xf06e; fa-eye</option>
    <option value='fa-eye-slash'>&#xf070; fa-eye-slash</option>
    <option value='fa-eyedropper'>&#xf1fb; fa-eyedropper</option>
    <option value='fa-fa'>&#xf2b4; fa-fa</option>
    <option value='fa-facebook'>&#xf09a; fa-facebook</option>
    <option value='fa-facebook-f'>&#xf09a; fa-facebook-f</option>
    <option value='fa-facebook-official'>&#xf230; fa-facebook-official</option>
    <option value='fa-facebook-square'>&#xf082; fa-facebook-square</option>
    <option value='fa-fast-backward'>&#xf049; fa-fast-backward</option>
    <option value='fa-fast-forward'>&#xf050; fa-fast-forward</option>
    <option value='fa-fax'>&#xf1ac; fa-fax</option>
    <option value='fa-feed'>&#xf09e; fa-feed</option>
    <option value='fa-female'>&#xf182; fa-female</option>
    <option value='fa-fighter-jet'>&#xf0fb; fa-fighter-jet</option>
    <option value='fa-file'>&#xf15b; fa-file</option>
    <option value='fa-file-archive-o'>&#xf1c6; fa-file-archive-o</option>
    <option value='fa-file-audio-o'>&#xf1c7; fa-file-audio-o</option>
    <option value='fa-file-code-o'>&#xf1c9; fa-file-code-o</option>
    <option value='fa-file-excel-o'>&#xf1c3; fa-file-excel-o</option>
    <option value='fa-file-image-o'>&#xf1c5; fa-file-image-o</option>
    <option value='fa-file-movie-o'>&#xf1c8; fa-file-movie-o</option>
    <option value='fa-file-o'>&#xf016; fa-file-o</option>
    <option value='fa-file-pdf-o'>&#xf1c1; fa-file-pdf-o</option>
    <option value='fa-file-photo-o'>&#xf1c5; fa-file-photo-o</option>
    <option value='fa-file-picture-o'>&#xf1c5; fa-file-picture-o</option>
    <option value='fa-file-powerpoint-o'>&#xf1c4; fa-file-powerpoint-o</option>
    <option value='fa-file-sound-o'>&#xf1c7; fa-file-sound-o</option>
    <option value='fa-file-text'>&#xf15c; fa-file-text</option>
    <option value='fa-file-text-o'>&#xf0f6; fa-file-text-o</option>
    <option value='fa-file-video-o'>&#xf1c8; fa-file-video-o</option>
    <option value='fa-file-word-o'>&#xf1c2; fa-file-word-o</option>
    <option value='fa-file-zip-o'>&#xf1c6; fa-file-zip-o</option>
    <option value='fa-files-o'>&#xf0c5; fa-files-o</option>
    <option value='fa-film'>&#xf008; fa-film</option>
    <option value='fa-filter'>&#xf0b0; fa-filter</option>
    <option value='fa-fire'>&#xf06d; fa-fire</option>
    <option value='fa-fire-extinguisher'>&#xf134; fa-fire-extinguisher</option>
    <option value='fa-firefox'>&#xf269; fa-firefox</option>
    <option value='fa-first-order'>&#xf2b0; fa-first-order</option>
    <option value='fa-flag'>&#xf024; fa-flag</option>
    <option value='fa-flag-checkered'>&#xf11e; fa-flag-checkered</option>
    <option value='fa-flag-o'>&#xf11d; fa-flag-o</option>
    <option value='fa-flash'>&#xf0e7; fa-flash</option>
    <option value='fa-flask'>&#xf0c3; fa-flask</option>
    <option value='fa-flickr'>&#xf16e; fa-flickr</option>
    <option value='fa-floppy-o'>&#xf0c7; fa-floppy-o</option>
    <option value='fa-folder'>&#xf07b; fa-folder</option>
    <option value='fa-folder-o'>&#xf114; fa-folder-o</option>
    <option value='fa-folder-open'>&#xf07c; fa-folder-open</option>
    <option value='fa-folder-open-o'>&#xf115; fa-folder-open-o</option>
    <option value='fa-font'>&#xf031; fa-font</option>
    <option value='fa-font-awesome'>&#xf2b4; fa-font-awesome</option>
    <option value='fa-fonticons'>&#xf280; fa-fonticons</option>
    <option value='fa-fort-awesome'>&#xf286; fa-fort-awesome</option>
    <option value='fa-forumbee'>&#xf211; fa-forumbee</option>
    <option value='fa-forward'>&#xf04e; fa-forward</option>
    <option value='fa-foursquare'>&#xf180; fa-foursquare</option>
    <option value='fa-free-code-camp'>&#xf2c5; fa-free-code-camp</option>
    <option value='fa-frown-o'>&#xf119; fa-frown-o</option>
    <option value='fa-futbol-o'>&#xf1e3; fa-futbol-o</option>
    <option value='fa-gamepad'>&#xf11b; fa-gamepad</option>
    <option value='fa-gavel'>&#xf0e3; fa-gavel</option>
    <option value='fa-gbp'>&#xf154; fa-gbp</option>
    <option value='fa-ge'>&#xf1d1; fa-ge</option>
    <option value='fa-gear'>&#xf013; fa-gear</option>
    <option value='fa-gears'>&#xf085; fa-gears</option>
    <option value='fa-genderless'>&#xf22d; fa-genderless</option>
    <option value='fa-get-pocket'>&#xf265; fa-get-pocket</option>
    <option value='fa-gg'>&#xf260; fa-gg</option>
    <option value='fa-gg-circle'>&#xf261; fa-gg-circle</option>
    <option value='fa-gift'>&#xf06b; fa-gift</option>
    <option value='fa-git'>&#xf1d3; fa-git</option>
    <option value='fa-git-square'>&#xf1d2; fa-git-square</option>
    <option value='fa-github'>&#xf09b; fa-github</option>
    <option value='fa-github-alt'>&#xf113; fa-github-alt</option>
    <option value='fa-github-square'>&#xf092; fa-github-square</option>
    <option value='fa-gitlab'>&#xf296; fa-gitlab</option>
    <option value='fa-gittip'>&#xf184; fa-gittip</option>
    <option value='fa-glass'>&#xf000; fa-glass</option>
    <option value='fa-glide'>&#xf2a5; fa-glide</option>
    <option value='fa-glide-g'>&#xf2a6; fa-glide-g</option>
    <option value='fa-globe'>&#xf0ac; fa-globe</option>
    <option value='fa-google'>&#xf1a0; fa-google</option>
    <option value='fa-google-plus'>&#xf0d5; fa-google-plus</option>
    <option value='fa-google-plus-circle'>&#xf2b3; fa-google-plus-circle</option>
    <option value='fa-google-plus-official'>&#xf2b3; fa-google-plus-official</option>
    <option value='fa-google-plus-square'>&#xf0d4; fa-google-plus-square</option>
    <option value='fa-google-wallet'>&#xf1ee; fa-google-wallet</option>
    <option value='fa-graduation-cap'>&#xf19d; fa-graduation-cap</option>
    <option value='fa-gratipay'>&#xf184; fa-gratipay</option>
    <option value='fa-grav'>&#xf2d6; fa-grav</option>
    <option value='fa-group'>&#xf0c0; fa-group</option>
    <option value='fa-h-square'>&#xf0fd; fa-h-square</option>
    <option value='fa-hacker-news'>&#xf1d4; fa-hacker-news</option>
    <option value='fa-hand-grab-o'>&#xf255; fa-hand-grab-o</option>
    <option value='fa-hand-lizard-o'>&#xf258; fa-hand-lizard-o</option>
    <option value='fa-hand-o-down'>&#xf0a7; fa-hand-o-down</option>
    <option value='fa-hand-o-left'>&#xf0a5; fa-hand-o-left</option>
    <option value='fa-hand-o-right'>&#xf0a4; fa-hand-o-right</option>
    <option value='fa-hand-o-up'>&#xf0a6; fa-hand-o-up</option>
    <option value='fa-hand-paper-o'>&#xf256; fa-hand-paper-o</option>
    <option value='fa-hand-peace-o'>&#xf25b; fa-hand-peace-o</option>
    <option value='fa-hand-pointer-o'>&#xf25a; fa-hand-pointer-o</option>
    <option value='fa-hand-rock-o'>&#xf255; fa-hand-rock-o</option>
    <option value='fa-hand-scissors-o'>&#xf257; fa-hand-scissors-o</option>
    <option value='fa-hand-spock-o'>&#xf259; fa-hand-spock-o</option>
    <option value='fa-hand-stop-o'>&#xf256; fa-hand-stop-o</option>
    <option value='fa-handshake-o'>&#xf2b5; fa-handshake-o</option>
    <option value='fa-hard-of-hearing'>&#xf2a4; fa-hard-of-hearing</option>
    <option value='fa-hashtag'>&#xf292; fa-hashtag</option>
    <option value='fa-hdd-o'>&#xf0a0; fa-hdd-o</option>
    <option value='fa-header'>&#xf1dc; fa-header</option>
    <option value='fa-headphones'>&#xf025; fa-headphones</option>
    <option value='fa-heart'>&#xf004; fa-heart</option>
    <option value='fa-heart-o'>&#xf08a; fa-heart-o</option>
    <option value='fa-heartbeat'>&#xf21e; fa-heartbeat</option>
    <option value='fa-history'>&#xf1da; fa-history</option>
    <option value='fa-home'>&#xf015; fa-home</option>
    <option value='fa-hospital-o'>&#xf0f8; fa-hospital-o</option>
    <option value='fa-hotel'>&#xf236; fa-hotel</option>
    <option value='fa-hourglass'>&#xf254; fa-hourglass</option>
    <option value='fa-hourglass-1'>&#xf251; fa-hourglass-1</option>
    <option value='fa-hourglass-2'>&#xf252; fa-hourglass-2</option>
    <option value='fa-hourglass-3'>&#xf253; fa-hourglass-3</option>
    <option value='fa-hourglass-end'>&#xf253; fa-hourglass-end</option>
    <option value='fa-hourglass-half'>&#xf252; fa-hourglass-half</option>
    <option value='fa-hourglass-o'>&#xf250; fa-hourglass-o</option>
    <option value='fa-hourglass-start'>&#xf251; fa-hourglass-start</option>
    <option value='fa-houzz'>&#xf27c; fa-houzz</option>
    <option value='fa-html5'>&#xf13b; fa-html5</option>
    <option value='fa-i-cursor'>&#xf246; fa-i-cursor</option>
    <option value='fa-id-badge'>&#xf2c1; fa-id-badge</option>
    <option value='fa-id-card'>&#xf2c2; fa-id-card</option>
    <option value='fa-id-card-o'>&#xf2c3; fa-id-card-o</option>
    <option value='fa-ils'>&#xf20b; fa-ils</option>
    <option value='fa-image'>&#xf03e; fa-image</option>
    <option value='fa-imdb'>&#xf2d8; fa-imdb</option>
    <option value='fa-inbox'>&#xf01c; fa-inbox</option>
    <option value='fa-indent'>&#xf03c; fa-indent</option>
    <option value='fa-industry'>&#xf275; fa-industry</option>
    <option value='fa-info'>&#xf129; fa-info</option>
    <option value='fa-info-circle'>&#xf05a; fa-info-circle</option>
    <option value='fa-inr'>&#xf156; fa-inr</option>
    <option value='fa-instagram'>&#xf16d; fa-instagram</option>
    <option value='fa-institution'>&#xf19c; fa-institution</option>
    <option value='fa-internet-explorer'>&#xf26b; fa-internet-explorer</option>
    <option value='fa-intersex'>&#xf224; fa-intersex</option>
    <option value='fa-ioxhost'>&#xf208; fa-ioxhost</option>
    <option value='fa-italic'>&#xf033; fa-italic</option>
    <option value='fa-joomla'>&#xf1aa; fa-joomla</option>
    <option value='fa-jpy'>&#xf157; fa-jpy</option>
    <option value='fa-jsfiddle'>&#xf1cc; fa-jsfiddle</option>
    <option value='fa-key'>&#xf084; fa-key</option>
    <option value='fa-keyboard-o'>&#xf11c; fa-keyboard-o</option>
    <option value='fa-krw'>&#xf159; fa-krw</option>
    <option value='fa-language'>&#xf1ab; fa-language</option>
    <option value='fa-laptop'>&#xf109; fa-laptop</option>
    <option value='fa-lastfm'>&#xf202; fa-lastfm</option>
    <option value='fa-lastfm-square'>&#xf203; fa-lastfm-square</option>
    <option value='fa-leaf'>&#xf06c; fa-leaf</option>
    <option value='fa-leanpub'>&#xf212; fa-leanpub</option>
    <option value='fa-legal'>&#xf0e3; fa-legal</option>
    <option value='fa-lemon-o'>&#xf094; fa-lemon-o</option>
    <option value='fa-level-down'>&#xf149; fa-level-down</option>
    <option value='fa-level-up'>&#xf148; fa-level-up</option>
    <option value='fa-life-bouy'>&#xf1cd; fa-life-bouy</option>
    <option value='fa-life-buoy'>&#xf1cd; fa-life-buoy</option>
    <option value='fa-life-ring'>&#xf1cd; fa-life-ring</option>
    <option value='fa-life-saver'>&#xf1cd; fa-life-saver</option>
    <option value='fa-lightbulb-o'>&#xf0eb; fa-lightbulb-o</option>
    <option value='fa-line-chart'>&#xf201; fa-line-chart</option>
    <option value='fa-link'>&#xf0c1; fa-link</option>
    <option value='fa-linkedin'>&#xf0e1; fa-linkedin</option>
    <option value='fa-linkedin-square'>&#xf08c; fa-linkedin-square</option>
    <option value='fa-linode'>&#xf2b8; fa-linode</option>
    <option value='fa-linux'>&#xf17c; fa-linux</option>
    <option value='fa-list'>&#xf03a; fa-list</option>
    <option value='fa-list-alt'>&#xf022; fa-list-alt</option>
    <option value='fa-list-ol'>&#xf0cb; fa-list-ol</option>
    <option value='fa-list-ul'>&#xf0ca; fa-list-ul</option>
    <option value='fa-location-arrow'>&#xf124; fa-location-arrow</option>
    <option value='fa-lock'>&#xf023; fa-lock</option>
    <option value='fa-long-arrow-down'>&#xf175; fa-long-arrow-down</option>
    <option value='fa-long-arrow-left'>&#xf177; fa-long-arrow-left</option>
    <option value='fa-long-arrow-right'>&#xf178; fa-long-arrow-right</option>
    <option value='fa-long-arrow-up'>&#xf176; fa-long-arrow-up</option>
    <option value='fa-low-vision'>&#xf2a8; fa-low-vision</option>
    <option value='fa-magic'>&#xf0d0; fa-magic</option>
    <option value='fa-magnet'>&#xf076; fa-magnet</option>
    <option value='fa-mail-forward'>&#xf064; fa-mail-forward</option>
    <option value='fa-mail-reply'>&#xf112; fa-mail-reply</option>
    <option value='fa-mail-reply-all'>&#xf122; fa-mail-reply-all</option>
    <option value='fa-male'>&#xf183; fa-male</option>
    <option value='fa-map'>&#xf279; fa-map</option>
    <option value='fa-map-marker'>&#xf041; fa-map-marker</option>
    <option value='fa-map-o'>&#xf278; fa-map-o</option>
    <option value='fa-map-pin'>&#xf276; fa-map-pin</option>
    <option value='fa-map-signs'>&#xf277; fa-map-signs</option>
    <option value='fa-mars'>&#xf222; fa-mars</option>
    <option value='fa-mars-double'>&#xf227; fa-mars-double</option>
    <option value='fa-mars-stroke'>&#xf229; fa-mars-stroke</option>
    <option value='fa-mars-stroke-h'>&#xf22b; fa-mars-stroke-h</option>
    <option value='fa-mars-stroke-v'>&#xf22a; fa-mars-stroke-v</option>
    <option value='fa-maxcdn'>&#xf136; fa-maxcdn</option>
    <option value='fa-meanpath'>&#xf20c; fa-meanpath</option>
    <option value='fa-medium'>&#xf23a; fa-medium</option>
    <option value='fa-medkit'>&#xf0fa; fa-medkit</option>
    <option value='fa-meetup'>&#xf2e0; fa-meetup</option>
    <option value='fa-meh-o'>&#xf11a; fa-meh-o</option>
    <option value='fa-mercury'>&#xf223; fa-mercury</option>
    <option value='fa-microchip'>&#xf2db; fa-microchip</option>
    <option value='fa-microphone'>&#xf130; fa-microphone</option>
    <option value='fa-microphone-slash'>&#xf131; fa-microphone-slash</option>
    <option value='fa-minus'>&#xf068; fa-minus</option>
    <option value='fa-minus-circle'>&#xf056; fa-minus-circle</option>
    <option value='fa-minus-square'>&#xf146; fa-minus-square</option>
    <option value='fa-minus-square-o'>&#xf147; fa-minus-square-o</option>
    <option value='fa-mixcloud'>&#xf289; fa-mixcloud</option>
    <option value='fa-mobile'>&#xf10b; fa-mobile</option>
    <option value='fa-mobile-phone'>&#xf10b; fa-mobile-phone</option>
    <option value='fa-modx'>&#xf285; fa-modx</option>
    <option value='fa-money'>&#xf0d6; fa-money</option>
    <option value='fa-moon-o'>&#xf186; fa-moon-o</option>
    <option value='fa-mortar-board'>&#xf19d; fa-mortar-board</option>
    <option value='fa-motorcycle'>&#xf21c; fa-motorcycle</option>
    <option value='fa-mouse-pointer'>&#xf245; fa-mouse-pointer</option>
    <option value='fa-music'>&#xf001; fa-music</option>
    <option value='fa-navicon'>&#xf0c9; fa-navicon</option>
    <option value='fa-neuter'>&#xf22c; fa-neuter</option>
    <option value='fa-newspaper-o'>&#xf1ea; fa-newspaper-o</option>
    <option value='fa-object-group'>&#xf247; fa-object-group</option>
    <option value='fa-object-ungroup'>&#xf248; fa-object-ungroup</option>
    <option value='fa-odnoklassniki'>&#xf263; fa-odnoklassniki</option>
    <option value='fa-odnoklassniki-square'>&#xf264; fa-odnoklassniki-square</option>
    <option value='fa-opencart'>&#xf23d; fa-opencart</option>
    <option value='fa-openid'>&#xf19b; fa-openid</option>
    <option value='fa-opera'>&#xf26a; fa-opera</option>
    <option value='fa-optin-monster'>&#xf23c; fa-optin-monster</option>
    <option value='fa-outdent'>&#xf03b; fa-outdent</option>
    <option value='fa-pagelines'>&#xf18c; fa-pagelines</option>
    <option value='fa-paint-brush'>&#xf1fc; fa-paint-brush</option>
    <option value='fa-paper-plane'>&#xf1d8; fa-paper-plane</option>
    <option value='fa-paper-plane-o'>&#xf1d9; fa-paper-plane-o</option>
    <option value='fa-paperclip'>&#xf0c6; fa-paperclip</option>
    <option value='fa-paragraph'>&#xf1dd; fa-paragraph</option>
    <option value='fa-paste'>&#xf0ea; fa-paste</option>
    <option value='fa-pause'>&#xf04c; fa-pause</option>
    <option value='fa-pause-circle'>&#xf28b; fa-pause-circle</option>
    <option value='fa-pause-circle-o'>&#xf28c; fa-pause-circle-o</option>
    <option value='fa-paw'>&#xf1b0; fa-paw</option>
    <option value='fa-paypal'>&#xf1ed; fa-paypal</option>
    <option value='fa-pencil'>&#xf040; fa-pencil</option>
    <option value='fa-pencil-square'>&#xf14b; fa-pencil-square</option>
    <option value='fa-pencil-square-o'>&#xf044; fa-pencil-square-o</option>
    <option value='fa-percent'>&#xf295; fa-percent</option>
    <option value='fa-phone'>&#xf095; fa-phone</option>
    <option value='fa-phone-square'>&#xf098; fa-phone-square</option>
    <option value='fa-photo'>&#xf03e; fa-photo</option>
    <option value='fa-picture-o'>&#xf03e; fa-picture-o</option>
    <option value='fa-pie-chart'>&#xf200; fa-pie-chart</option>
    <option value='fa-pied-piper'>&#xf2ae; fa-pied-piper</option>
    <option value='fa-pied-piper-alt'>&#xf1a8; fa-pied-piper-alt</option>
    <option value='fa-pied-piper-pp'>&#xf1a7; fa-pied-piper-pp</option>
    <option value='fa-pinterest'>&#xf0d2; fa-pinterest</option>
    <option value='fa-pinterest-p'>&#xf231; fa-pinterest-p</option>
    <option value='fa-pinterest-square'>&#xf0d3; fa-pinterest-square</option>
    <option value='fa-plane'>&#xf072; fa-plane</option>
    <option value='fa-play'>&#xf04b; fa-play</option>
    <option value='fa-play-circle'>&#xf144; fa-play-circle</option>
    <option value='fa-play-circle-o'>&#xf01d; fa-play-circle-o</option>
    <option value='fa-plug'>&#xf1e6; fa-plug</option>
    <option value='fa-plus'>&#xf067; fa-plus</option>
    <option value='fa-plus-circle'>&#xf055; fa-plus-circle</option>
    <option value='fa-plus-square'>&#xf0fe; fa-plus-square</option>
    <option value='fa-plus-square-o'>&#xf196; fa-plus-square-o</option>
    <option value='fa-podcast'>&#xf2ce; fa-podcast</option>
    <option value='fa-power-off'>&#xf011; fa-power-off</option>
    <option value='fa-print'>&#xf02f; fa-print</option>
    <option value='fa-product-hunt'>&#xf288; fa-product-hunt</option>
    <option value='fa-puzzle-piece'>&#xf12e; fa-puzzle-piece</option>
    <option value='fa-qq'>&#xf1d6; fa-qq</option>
    <option value='fa-qrcode'>&#xf029; fa-qrcode</option>
    <option value='fa-question'>&#xf128; fa-question</option>
    <option value='fa-question-circle'>&#xf059; fa-question-circle</option>
    <option value='fa-question-circle-o'>&#xf29c; fa-question-circle-o</option>
    <option value='fa-quora'>&#xf2c4; fa-quora</option>
    <option value='fa-quote-left'>&#xf10d; fa-quote-left</option>
    <option value='fa-quote-right'>&#xf10e; fa-quote-right</option>
    <option value='fa-ra'>&#xf1d0; fa-ra</option>
    <option value='fa-random'>&#xf074; fa-random</option>
    <option value='fa-ravelry'>&#xf2d9; fa-ravelry</option>
    <option value='fa-rebel'>&#xf1d0; fa-rebel</option>
    <option value='fa-recycle'>&#xf1b8; fa-recycle</option>
    <option value='fa-reddit'>&#xf1a1; fa-reddit</option>
    <option value='fa-reddit-alien'>&#xf281; fa-reddit-alien</option>
    <option value='fa-reddit-square'>&#xf1a2; fa-reddit-square</option>
    <option value='fa-refresh'>&#xf021; fa-refresh</option>
    <option value='fa-registered'>&#xf25d; fa-registered</option>
    <option value='fa-remove'>&#xf00d; fa-remove</option>
    <option value='fa-renren'>&#xf18b; fa-renren</option>
    <option value='fa-reorder'>&#xf0c9; fa-reorder</option>
    <option value='fa-repeat'>&#xf01e; fa-repeat</option>
    <option value='fa-reply'>&#xf112; fa-reply</option>
    <option value='fa-reply-all'>&#xf122; fa-reply-all</option>
    <option value='fa-resistance'>&#xf1d0; fa-resistance</option>
    <option value='fa-retweet'>&#xf079; fa-retweet</option>
    <option value='fa-rmb'>&#xf157; fa-rmb</option>
    <option value='fa-road'>&#xf018; fa-road</option>
    <option value='fa-rocket'>&#xf135; fa-rocket</option>
    <option value='fa-rotate-left'>&#xf0e2; fa-rotate-left</option>
    <option value='fa-rotate-right'>&#xf01e; fa-rotate-right</option>
    <option value='fa-rouble'>&#xf158; fa-rouble</option>
    <option value='fa-rss'>&#xf09e; fa-rss</option>
    <option value='fa-rss-square'>&#xf143; fa-rss-square</option>
    <option value='fa-rub'>&#xf158; fa-rub</option>
    <option value='fa-ruble'>&#xf158; fa-ruble</option>
    <option value='fa-rupee'>&#xf156; fa-rupee</option>
    <option value='fa-s15'>&#xf2cd; fa-s15</option>
    <option value='fa-safari'>&#xf267; fa-safari</option>
    <option value='fa-save'>&#xf0c7; fa-save</option>
    <option value='fa-scissors'>&#xf0c4; fa-scissors</option>
    <option value='fa-scribd'>&#xf28a; fa-scribd</option>
    <option value='fa-search'>&#xf002; fa-search</option>
    <option value='fa-search-minus'>&#xf010; fa-search-minus</option>
    <option value='fa-search-plus'>&#xf00e; fa-search-plus</option>
    <option value='fa-sellsy'>&#xf213; fa-sellsy</option>
    <option value='fa-send'>&#xf1d8; fa-send</option>
    <option value='fa-send-o'>&#xf1d9; fa-send-o</option>
    <option value='fa-server'>&#xf233; fa-server</option>
    <option value='fa-share'>&#xf064; fa-share</option>
    <option value='fa-share-alt'>&#xf1e0; fa-share-alt</option>
    <option value='fa-share-alt-square'>&#xf1e1; fa-share-alt-square</option>
    <option value='fa-share-square'>&#xf14d; fa-share-square</option>
    <option value='fa-share-square-o'>&#xf045; fa-share-square-o</option>
    <option value='fa-shekel'>&#xf20b; fa-shekel</option>
    <option value='fa-sheqel'>&#xf20b; fa-sheqel</option>
    <option value='fa-shield'>&#xf132; fa-shield</option>
    <option value='fa-ship'>&#xf21a; fa-ship</option>
    <option value='fa-shirtsinbulk'>&#xf214; fa-shirtsinbulk</option>
    <option value='fa-shopping-bag'>&#xf290; fa-shopping-bag</option>
    <option value='fa-shopping-basket'>&#xf291; fa-shopping-basket</option>
    <option value='fa-shopping-cart'>&#xf07a; fa-shopping-cart</option>
    <option value='fa-shower'>&#xf2cc; fa-shower</option>
    <option value='fa-sign-in'>&#xf090; fa-sign-in</option>
    <option value='fa-sign-language'>&#xf2a7; fa-sign-language</option>
    <option value='fa-sign-out'>&#xf08b; fa-sign-out</option>
    <option value='fa-signal'>&#xf012; fa-signal</option>
    <option value='fa-signing'>&#xf2a7; fa-signing</option>
    <option value='fa-simplybuilt'>&#xf215; fa-simplybuilt</option>
    <option value='fa-sitemap'>&#xf0e8; fa-sitemap</option>
    <option value='fa-skyatlas'>&#xf216; fa-skyatlas</option>
    <option value='fa-skype'>&#xf17e; fa-skype</option>
    <option value='fa-slack'>&#xf198; fa-slack</option>
    <option value='fa-sliders'>&#xf1de; fa-sliders</option>
    <option value='fa-slideshare'>&#xf1e7; fa-slideshare</option>
    <option value='fa-smile-o'>&#xf118; fa-smile-o</option>
    <option value='fa-snapchat'>&#xf2ab; fa-snapchat</option>
    <option value='fa-snapchat-ghost'>&#xf2ac; fa-snapchat-ghost</option>
    <option value='fa-snapchat-square'>&#xf2ad; fa-snapchat-square</option>
    <option value='fa-snowflake-o'>&#xf2dc; fa-snowflake-o</option>
    <option value='fa-soccer-ball-o'>&#xf1e3; fa-soccer-ball-o</option>
    <option value='fa-sort'>&#xf0dc; fa-sort</option>
    <option value='fa-sort-alpha-asc'>&#xf15d; fa-sort-alpha-asc</option>
    <option value='fa-sort-alpha-desc'>&#xf15e; fa-sort-alpha-desc</option>
    <option value='fa-sort-amount-asc'>&#xf160; fa-sort-amount-asc</option>
    <option value='fa-sort-amount-desc'>&#xf161; fa-sort-amount-desc</option>
    <option value='fa-sort-asc'>&#xf0de; fa-sort-asc</option>
    <option value='fa-sort-desc'>&#xf0dd; fa-sort-desc</option>
    <option value='fa-sort-down'>&#xf0dd; fa-sort-down</option>
    <option value='fa-sort-numeric-asc'>&#xf162; fa-sort-numeric-asc</option>
    <option value='fa-sort-numeric-desc'>&#xf163; fa-sort-numeric-desc</option>
    <option value='fa-sort-up'>&#xf0de; fa-sort-up</option>
    <option value='fa-soundcloud'>&#xf1be; fa-soundcloud</option>
    <option value='fa-space-shuttle'>&#xf197; fa-space-shuttle</option>
    <option value='fa-spinner'>&#xf110; fa-spinner</option>
    <option value='fa-spoon'>&#xf1b1; fa-spoon</option>
    <option value='fa-spotify'>&#xf1bc; fa-spotify</option>
    <option value='fa-square'>&#xf0c8; fa-square</option>
    <option value='fa-square-o'>&#xf096; fa-square-o</option>
    <option value='fa-stack-exchange'>&#xf18d; fa-stack-exchange</option>
    <option value='fa-stack-overflow'>&#xf16c; fa-stack-overflow</option>
    <option value='fa-star'>&#xf005; fa-star</option>
    <option value='fa-star-half'>&#xf089; fa-star-half</option>
    <option value='fa-star-half-empty'>&#xf123; fa-star-half-empty</option>
    <option value='fa-star-half-full'>&#xf123; fa-star-half-full</option>
    <option value='fa-star-half-o'>&#xf123; fa-star-half-o</option>
    <option value='fa-star-o'>&#xf006; fa-star-o</option>
    <option value='fa-steam'>&#xf1b6; fa-steam</option>
    <option value='fa-steam-square'>&#xf1b7; fa-steam-square</option>
    <option value='fa-step-backward'>&#xf048; fa-step-backward</option>
    <option value='fa-step-forward'>&#xf051; fa-step-forward</option>
    <option value='fa-stethoscope'>&#xf0f1; fa-stethoscope</option>
    <option value='fa-sticky-note'>&#xf249; fa-sticky-note</option>
    <option value='fa-sticky-note-o'>&#xf24a; fa-sticky-note-o</option>
    <option value='fa-stop'>&#xf04d; fa-stop</option>
    <option value='fa-stop-circle'>&#xf28d; fa-stop-circle</option>
    <option value='fa-stop-circle-o'>&#xf28e; fa-stop-circle-o</option>
    <option value='fa-street-view'>&#xf21d; fa-street-view</option>
    <option value='fa-strikethrough'>&#xf0cc; fa-strikethrough</option>
    <option value='fa-stumbleupon'>&#xf1a4; fa-stumbleupon</option>
    <option value='fa-stumbleupon-circle'>&#xf1a3; fa-stumbleupon-circle</option>
    <option value='fa-subscript'>&#xf12c; fa-subscript</option>
    <option value='fa-subway'>&#xf239; fa-subway</option>
    <option value='fa-suitcase'>&#xf0f2; fa-suitcase</option>
    <option value='fa-sun-o'>&#xf185; fa-sun-o</option>
    <option value='fa-superpowers'>&#xf2dd; fa-superpowers</option>
    <option value='fa-superscript'>&#xf12b; fa-superscript</option>
    <option value='fa-support'>&#xf1cd; fa-support</option>
    <option value='fa-table'>&#xf0ce; fa-table</option>
    <option value='fa-tablet'>&#xf10a; fa-tablet</option>
    <option value='fa-tachometer'>&#xf0e4; fa-tachometer</option>
    <option value='fa-tag'>&#xf02b; fa-tag</option>
    <option value='fa-tags'>&#xf02c; fa-tags</option>
    <option value='fa-tasks'>&#xf0ae; fa-tasks</option>
    <option value='fa-taxi'>&#xf1ba; fa-taxi</option>
    <option value='fa-telegram'>&#xf2c6; fa-telegram</option>
    <option value='fa-television'>&#xf26c; fa-television</option>
    <option value='fa-tencent-weibo'>&#xf1d5; fa-tencent-weibo</option>
    <option value='fa-terminal'>&#xf120; fa-terminal</option>
    <option value='fa-text-height'>&#xf034; fa-text-height</option>
    <option value='fa-text-width'>&#xf035; fa-text-width</option>
    <option value='fa-th'>&#xf00a; fa-th</option>
    <option value='fa-th-large'>&#xf009; fa-th-large</option>
    <option value='fa-th-list'>&#xf00b; fa-th-list</option>
    <option value='fa-themeisle'>&#xf2b2; fa-themeisle</option>
    <option value='fa-thermometer'>&#xf2c7; fa-thermometer</option>
    <option value='fa-thermometer-0'>&#xf2cb; fa-thermometer-0</option>
    <option value='fa-thermometer-1'>&#xf2ca; fa-thermometer-1</option>
    <option value='fa-thermometer-2'>&#xf2c9; fa-thermometer-2</option>
    <option value='fa-thermometer-3'>&#xf2c8; fa-thermometer-3</option>
    <option value='fa-thermometer-4'>&#xf2c7; fa-thermometer-4</option>
    <option value='fa-thermometer-empty'>&#xf2cb; fa-thermometer-empty</option>
    <option value='fa-thermometer-full'>&#xf2c7; fa-thermometer-full</option>
    <option value='fa-thermometer-half'>&#xf2c9; fa-thermometer-half</option>
    <option value='fa-thermometer-quarter'>&#xf2ca; fa-thermometer-quarter</option>
    <option value='fa-thermometer-three-quarters'>&#xf2c8; fa-thermometer-three-quarters</option>
    <option value='fa-thumb-tack'>&#xf08d; fa-thumb-tack</option>
    <option value='fa-thumbs-down'>&#xf165; fa-thumbs-down</option>
    <option value='fa-thumbs-o-down'>&#xf088; fa-thumbs-o-down</option>
    <option value='fa-thumbs-o-up'>&#xf087; fa-thumbs-o-up</option>
    <option value='fa-thumbs-up'>&#xf164; fa-thumbs-up</option>
    <option value='fa-ticket'>&#xf145; fa-ticket</option>
    <option value='fa-times'>&#xf00d; fa-times</option>
    <option value='fa-times-circle'>&#xf057; fa-times-circle</option>
    <option value='fa-times-circle-o'>&#xf05c; fa-times-circle-o</option>
    <option value='fa-times-rectangle'>&#xf2d3; fa-times-rectangle</option>
    <option value='fa-times-rectangle-o'>&#xf2d4; fa-times-rectangle-o</option>
    <option value='fa-tint'>&#xf043; fa-tint</option>
    <option value='fa-toggle-down'>&#xf150; fa-toggle-down</option>
    <option value='fa-toggle-left'>&#xf191; fa-toggle-left</option>
    <option value='fa-toggle-off'>&#xf204; fa-toggle-off</option>
    <option value='fa-toggle-on'>&#xf205; fa-toggle-on</option>
    <option value='fa-toggle-right'>&#xf152; fa-toggle-right</option>
    <option value='fa-toggle-up'>&#xf151; fa-toggle-up</option>
    <option value='fa-trademark'>&#xf25c; fa-trademark</option>
    <option value='fa-train'>&#xf238; fa-train</option>
    <option value='fa-transgender'>&#xf224; fa-transgender</option>
    <option value='fa-transgender-alt'>&#xf225; fa-transgender-alt</option>
    <option value='fa-trash'>&#xf1f8; fa-trash</option>
    <option value='fa-trash-o'>&#xf014; fa-trash-o</option>
    <option value='fa-tree'>&#xf1bb; fa-tree</option>
    <option value='fa-trello'>&#xf181; fa-trello</option>
    <option value='fa-tripadvisor'>&#xf262; fa-tripadvisor</option>
    <option value='fa-trophy'>&#xf091; fa-trophy</option>
    <option value='fa-truck'>&#xf0d1; fa-truck</option>
    <option value='fa-try'>&#xf195; fa-try</option>
    <option value='fa-tty'>&#xf1e4; fa-tty</option>
    <option value='fa-tumblr'>&#xf173; fa-tumblr</option>
    <option value='fa-tumblr-square'>&#xf174; fa-tumblr-square</option>
    <option value='fa-turkish-lira'>&#xf195; fa-turkish-lira</option>
    <option value='fa-tv'>&#xf26c; fa-tv</option>
    <option value='fa-twitch'>&#xf1e8; fa-twitch</option>
    <option value='fa-twitter'>&#xf099; fa-twitter</option>
    <option value='fa-twitter-square'>&#xf081; fa-twitter-square</option>
    <option value='fa-umbrella'>&#xf0e9; fa-umbrella</option>
    <option value='fa-underline'>&#xf0cd; fa-underline</option>
    <option value='fa-undo'>&#xf0e2; fa-undo</option>
    <option value='fa-universal-access'>&#xf29a; fa-universal-access</option>
    <option value='fa-university'>&#xf19c; fa-university</option>
    <option value='fa-unlink'>&#xf127; fa-unlink</option>
    <option value='fa-unlock'>&#xf09c; fa-unlock</option>
    <option value='fa-unlock-alt'>&#xf13e; fa-unlock-alt</option>
    <option value='fa-unsorted'>&#xf0dc; fa-unsorted</option>
    <option value='fa-upload'>&#xf093; fa-upload</option>
    <option value='fa-usb'>&#xf287; fa-usb</option>
    <option value='fa-usd'>&#xf155; fa-usd</option>
    <option value='fa-user'>&#xf007; fa-user</option>
    <option value='fa-user-circle'>&#xf2bd; fa-user-circle</option>
    <option value='fa-user-circle-o'>&#xf2be; fa-user-circle-o</option>
    <option value='fa-user-md'>&#xf0f0; fa-user-md</option>
    <option value='fa-user-o'>&#xf2c0; fa-user-o</option>
    <option value='fa-user-plus'>&#xf234; fa-user-plus</option>
    <option value='fa-user-secret'>&#xf21b; fa-user-secret</option>
    <option value='fa-user-times'>&#xf235; fa-user-times</option>
    <option value='fa-users'>&#xf0c0; fa-users</option>
    <option value='fa-vcard'>&#xf2bb; fa-vcard</option>
    <option value='fa-vcard-o'>&#xf2bc; fa-vcard-o</option>
    <option value='fa-venus'>&#xf221; fa-venus</option>
    <option value='fa-venus-double'>&#xf226; fa-venus-double</option>
    <option value='fa-venus-mars'>&#xf228; fa-venus-mars</option>
    <option value='fa-viacoin'>&#xf237; fa-viacoin</option>
    <option value='fa-viadeo'>&#xf2a9; fa-viadeo</option>
    <option value='fa-viadeo-square'>&#xf2aa; fa-viadeo-square</option>
    <option value='fa-video-camera'>&#xf03d; fa-video-camera</option>
    <option value='fa-vimeo'>&#xf27d; fa-vimeo</option>
    <option value='fa-vimeo-square'>&#xf194; fa-vimeo-square</option>
    <option value='fa-vine'>&#xf1ca; fa-vine</option>
    <option value='fa-vk'>&#xf189; fa-vk</option>
    <option value='fa-volume-control-phone'>&#xf2a0; fa-volume-control-phone</option>
    <option value='fa-volume-down'>&#xf027; fa-volume-down</option>
    <option value='fa-volume-off'>&#xf026; fa-volume-off</option>
    <option value='fa-volume-up'>&#xf028; fa-volume-up</option>
    <option value='fa-warning'>&#xf071; fa-warning</option>
    <option value='fa-wechat'>&#xf1d7; fa-wechat</option>
    <option value='fa-weibo'>&#xf18a; fa-weibo</option>
    <option value='fa-weixin'>&#xf1d7; fa-weixin</option>
    <option value='fa-whatsapp'>&#xf232; fa-whatsapp</option>
    <option value='fa-wheelchair'>&#xf193; fa-wheelchair</option>
    <option value='fa-wheelchair-alt'>&#xf29b; fa-wheelchair-alt</option>
    <option value='fa-wifi'>&#xf1eb; fa-wifi</option>
    <option value='fa-wikipedia-w'>&#xf266; fa-wikipedia-w</option>
    <option value='fa-window-close'>&#xf2d3; fa-window-close</option>
    <option value='fa-window-close-o'>&#xf2d4; fa-window-close-o</option>
    <option value='fa-window-maximize'>&#xf2d0; fa-window-maximize</option>
    <option value='fa-window-minimize'>&#xf2d1; fa-window-minimize</option>
    <option value='fa-window-restore'>&#xf2d2; fa-window-restore</option>
    <option value='fa-windows'>&#xf17a; fa-windows</option>
    <option value='fa-won'>&#xf159; fa-won</option>
    <option value='fa-wordpress'>&#xf19a; fa-wordpress</option>
    <option value='fa-wpbeginner'>&#xf297; fa-wpbeginner</option>
    <option value='fa-wpexplorer'>&#xf2de; fa-wpexplorer</option>
    <option value='fa-wpforms'>&#xf298; fa-wpforms</option>
    <option value='fa-wrench'>&#xf0ad; fa-wrench</option>
    <option value='fa-xing'>&#xf168; fa-xing</option>
    <option value='fa-xing-square'>&#xf169; fa-xing-square</option>
    <option value='fa-y-combinator'>&#xf23b; fa-y-combinator</option>
    <option value='fa-y-combinator-square'>&#xf1d4; fa-y-combinator-square</option>
    <option value='fa-yahoo'>&#xf19e; fa-yahoo</option>
    <option value='fa-yc'>&#xf23b; fa-yc</option>
    <option value='fa-yc-square'>&#xf1d4; fa-yc-square</option>
    <option value='fa-yelp'>&#xf1e9; fa-yelp</option>
    <option value='fa-yen'>&#xf157; fa-yen</option>
    <option value='fa-yoast'>&#xf2b1; fa-yoast</option>
    <option value='fa-youtube'>&#xf167; fa-youtube</option>
    <option value='fa-youtube-play'>&#xf16a; fa-youtube-play</option>
    <option value='fa-youtube-square'>&#xf166; fa-youtube-square</option>
</select>
                </div> 
                   
			<!--  <div class="form-group">
          <label>Warna<span style='color:red;'>*</span></label>
           <select class="form-control select2" style="width: 100%;" name="warna" id="warna">
           
           <option value='aqua' selected>Aqua</option>  
           <option value='yellow'>Yellow</option>
           <option value='green'>Green</option>
           <option value='red'>Red</option>
           <option value='grey'>Grey</option>
           </select>
                </div> -->
			
       
      
                            </br>
                   <!-- /.form-group -->
            </div>
			
			
            <!-- /.RIGHT SIDE -->
            <div class="col-md-6">
			      <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
		  
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
              <div class="box-footer">
                <a  class="btn btn-default" href="menu.html">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Save</button>
              </div>
		</form>
      </div>
	<?php  		  
     break;
 
 //HARUS DIRUBAH (setting email)
  case "edit":
  
 /* function GetCombobox($table, $key,$nama,  $Nilai='') {
  $s = "select * from $table order by nama_sbu";
  $r = mysql_query($s);
  $_arrNilai = explode(',', $Nilai);
  $str = '';
  $str .= "<select class='form-control select2' multiple='multiple'  style='width: 100%;' name='".$nama."[]' >";
  while ($w = mysql_fetch_array($r)) {
    $_ck = (array_search($w[$key], $_arrNilai) === false)? '' : 'selected';
//    $str .= "<input type=checkbox name='".$key."[]' value='$w[$key]' $_ck>$w[$Label] ";
	
	$str .= "<option value='$w[$key]' $_ck>$w[$key]</option>";
	
  }
  $str .= "</select>";
  return $str;
}*/

   $edit = mysql_query("SELECT a.*,b.id_main,b.nama_menu FROM submenu a LEFT JOIN mainmenu b ON a.id_main=b.id_main  WHERE a.id_sub='$_GET[id_sub]'");
    $r    = mysql_fetch_array($edit);
    $edit2 = mysql_query("SELECT id_submain,nama_sub FROM submenu WHERE id_sub='$r[id_submain]'");
    $s    = mysql_fetch_array($edit2);
  echo"
  <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit Group Menu</h3>

          <div class='box-tools pull-right'>
            <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
           
          </div>
        </div>";
		/*if($_SESSION[leveluser]=='1'){	*/		
			
		echo"<form id='myForm' name='myForm' method='POST'  enctype='multipart/form-data' action='aksi-edit-menu.html' >
        <!-- /.box-header -->
		
        <div class='box-body'>
		
          <div class='row'>
            <div class='col-md-6'>
			
			<div class='form-group has-success'>
                      <label>Group Menu&nbsp;&nbsp;&nbsp;<span style='color:red;'>*</span></label>
                        <div class='input-group'>
                           <input type='text' class='form-control' id='nama_menu' placeholder='Input ...' aria-describedby='basic-addon1' value='$r[nama_menu]' name='nama_menu' readonly>
                           <input type='hidden' value='$r[id_main]' id='id_main' name='id_main' readonly>
                       <span class='input-group-addon' id='basic-addon1' onmouseover=\"this.style.cursor='pointer'\" 
                        onClick=\"showGroupmenu('rikues')\"><span class='glyphicon glyphicon-new-window' aria-hidden='true'></span></span>
                      </div>
                    </div> 

			<div class='form-group' id='username'>
                  <label>Nama Menu<span style='color:red;'>*</span></label>
                  <input type='hidden' name='id_sub'  value='$r[id_sub]' >
                  <input type='text' name='nama_sub' id='nama_sub' value='$r[nama_sub]' class='form-control' placeholder='Nama Menu' >
                </div>
			<div class='form-group'>
                  <label>Link</label>
                  <input type='text' name='link_sub' id='link_sub' value='$r[link_sub]' class='form-control' placeholder='Link'>
                </div>
      <div class='form-group'>
                  <label>Nama Module</label>
                  <input type='text' name='module_name' id='module_name' value='$r[module_name]' class='form-control' placeholder='Nama Module'>
                </div>          	
			<div class='form-group has-success'>
                      <label>Sub Menu&nbsp;&nbsp;&nbsp;<span style='color:red;'>*</span></label>
                        <div class='input-group'>
                           <input type='text' class='form-control' id='nama_sub2' placeholder='Input ...' aria-describedby='basic-addon1' value='$s[nama_sub]' name='nama_sub2' readonly>
                           <input type='hidden' value='$s[id_submain]' id='id_submain' name='id_submain' readonly>
                       <span class='input-group-addon' id='basic-addon1' onmouseover=\"this.style.cursor='pointer'\" 
                        onClick=\"showSubmenu('rikues')\"><span class='glyphicon glyphicon-new-window' aria-hidden='true'></span></span>
                      </div>
                    </div> 
      <div class='form-group'>
                  <label>Urutan</label>
                  <input type='number' name='urutan' id='urutan' value='$r[urutan]' class='form-control' placeholder='Isi Dengan Angka'>
                </div>   
			 <div class='form-group'>
                  <label>Class</label>
                  <select class='form-control' style='width: 100%; ' name='class_sub' id='class_sub'>
                  <option value='$r[class_sub]' selected>$r[class_sub]</option>
                  <option value='fa-500px'>&#xf26e; fa-500px</option>
    <option value='fa-address-book'>&#xf2b9; fa-address-book</option>
    <option value='fa-address-book-o'>&#xf2ba; fa-address-book-o</option>
    <option value='fa-address-card'>&#xf2bb; fa-address-card</option>
    <option value='fa-address-card-o'>&#xf2bc; fa-address-card-o</option>
    <option value='fa-adjust'>&#xf042; fa-adjust</option>
    <option value='fa-adn'>&#xf170; fa-adn</option>
    <option value='fa-align-center'>&#xf037; fa-align-center</option>
    <option value='fa-align-justify'>&#xf039; fa-align-justify</option>
    <option value='fa-align-left'>&#xf036; fa-align-left</option>
    <option value='fa-align-right'>&#xf038; fa-align-right</option>
    <option value='fa-amazon'>&#xf270; fa-amazon</option>
    <option value='fa-ambulance'>&#xf0f9; fa-ambulance</option>
    <option value='fa-american-sign-language-interpreting'>&#xf2a3; fa-american-sign-language-interpreting</option>
    <option value='fa-anchor'>&#xf13d; fa-anchor</option>
    <option value='fa-android'>&#xf17b; fa-android</option>
    <option value='fa-angellist'>&#xf209; fa-angellist</option>
    <option value='fa-angle-double-down'>&#xf103; fa-angle-double-down</option>
    <option value='fa-angle-double-left'>&#xf100; fa-angle-double-left</option>
    <option value='fa-angle-double-right'>&#xf101; fa-angle-double-right</option>
    <option value='fa-angle-double-up'>&#xf102; fa-angle-double-up</option>
    <option value='fa-angle-down'>&#xf107; fa-angle-down</option>
    <option value='fa-angle-left'>&#xf104; fa-angle-left</option>
    <option value='fa-angle-right'>&#xf105; fa-angle-right</option>
    <option value='fa-angle-up'>&#xf106; fa-angle-up</option>
    <option value='fa-apple'>&#xf179; fa-apple</option>
    <option value='fa-archive'>&#xf187; fa-archive</option>
    <option value='fa-area-chart'>&#xf1fe; fa-area-chart</option>
    <option value='fa-arrow-circle-down'>&#xf0ab; fa-arrow-circle-down</option>
    <option value='fa-arrow-circle-left'>&#xf0a8; fa-arrow-circle-left</option>
    <option value='fa-arrow-circle-o-down'>&#xf01a; fa-arrow-circle-o-down</option>
    <option value='fa-arrow-circle-o-left'>&#xf190; fa-arrow-circle-o-left</option>
    <option value='fa-arrow-circle-o-right'>&#xf18e; fa-arrow-circle-o-right</option>
    <option value='fa-arrow-circle-o-up'>&#xf01b; fa-arrow-circle-o-up</option>
    <option value='fa-arrow-circle-right'>&#xf0a9; fa-arrow-circle-right</option>
    <option value='fa-arrow-circle-up'>&#xf0aa; fa-arrow-circle-up</option>
    <option value='fa-arrow-down'>&#xf063; fa-arrow-down</option>
    <option value='fa-arrow-left'>&#xf060; fa-arrow-left</option>
    <option value='fa-arrow-right'>&#xf061; fa-arrow-right</option>
    <option value='fa-arrow-up'>&#xf062; fa-arrow-up</option>
    <option value='fa-arrows'>&#xf047; fa-arrows</option>
    <option value='fa-arrows-alt'>&#xf0b2; fa-arrows-alt</option>
    <option value='fa-arrows-h'>&#xf07e; fa-arrows-h</option>
    <option value='fa-arrows-v'>&#xf07d; fa-arrows-v</option>
    <option value='fa-asl-interpreting'>&#xf2a3; fa-asl-interpreting</option>
    <option value='fa-assistive-listening-systems'>&#xf2a2; fa-assistive-listening-systems</option>
    <option value='fa-asterisk'>&#xf069; fa-asterisk</option>
    <option value='fa-at'>&#xf1fa; fa-at</option>
    <option value='fa-audio-description'>&#xf29e; fa-audio-description</option>
    <option value='fa-automobile'>&#xf1b9; fa-automobile</option>
    <option value='fa-backward'>&#xf04a; fa-backward</option>
    <option value='fa-balance-scale'>&#xf24e; fa-balance-scale</option>
    <option value='fa-ban'>&#xf05e; fa-ban</option>
    <option value='fa-bandcamp'>&#xf2d5; fa-bandcamp</option>
    <option value='fa-bank'>&#xf19c; fa-bank</option>
    <option value='fa-bar-chart'>&#xf080; fa-bar-chart</option>
    <option value='fa-bar-chart-o'>&#xf080; fa-bar-chart-o</option>
    <option value='fa-barcode'>&#xf02a; fa-barcode</option>
    <option value='fa-bars'>&#xf0c9; fa-bars</option>
    <option value='fa-bath'>&#xf2cd; fa-bath</option>
    <option value='fa-bathtub'>&#xf2cd; fa-bathtub</option>
    <option value='fa-battery'>&#xf240; fa-battery</option>
    <option value='fa-battery-0'>&#xf244; fa-battery-0</option>
    <option value='fa-battery-1'>&#xf243; fa-battery-1</option>
    <option value='fa-battery-2'>&#xf242; fa-battery-2</option>
    <option value='fa-battery-3'>&#xf241; fa-battery-3</option>
    <option value='fa-battery-4'>&#xf240; fa-battery-4</option>
    <option value='fa-battery-empty'>&#xf244; fa-battery-empty</option>
    <option value='fa-battery-full'>&#xf240; fa-battery-full</option>
    <option value='fa-battery-half'>&#xf242; fa-battery-half</option>
    <option value='fa-battery-quarter'>&#xf243; fa-battery-quarter</option>
    <option value='fa-battery-three-quarters'>&#xf241; fa-battery-three-quarters</option>
    <option value='fa-bed'>&#xf236; fa-bed</option>
    <option value='fa-beer'>&#xf0fc; fa-beer</option>
    <option value='fa-behance'>&#xf1b4; fa-behance</option>
    <option value='fa-behance-square'>&#xf1b5; fa-behance-square</option>
    <option value='fa-bell'>&#xf0f3; fa-bell</option>
    <option value='fa-bell-o'>&#xf0a2; fa-bell-o</option>
    <option value='fa-bell-slash'>&#xf1f6; fa-bell-slash</option>
    <option value='fa-bell-slash-o'>&#xf1f7; fa-bell-slash-o</option>
    <option value='fa-bicycle'>&#xf206; fa-bicycle</option>
    <option value='fa-binoculars'>&#xf1e5; fa-binoculars</option>
    <option value='fa-birthday-cake'>&#xf1fd; fa-birthday-cake</option>
    <option value='fa-bitbucket'>&#xf171; fa-bitbucket</option>
    <option value='fa-bitbucket-square'>&#xf172; fa-bitbucket-square</option>
    <option value='fa-bitcoin'>&#xf15a; fa-bitcoin</option>
    <option value='fa-black-tie'>&#xf27e; fa-black-tie</option>
    <option value='fa-blind'>&#xf29d; fa-blind</option>
    <option value='fa-bluetooth'>&#xf293; fa-bluetooth</option>
    <option value='fa-bluetooth-b'>&#xf294; fa-bluetooth-b</option>
    <option value='fa-bold'>&#xf032; fa-bold</option>
    <option value='fa-bolt'>&#xf0e7; fa-bolt</option>
    <option value='fa-bomb'>&#xf1e2; fa-bomb</option>
    <option value='fa-book'>&#xf02d; fa-book</option>
    <option value='fa-bookmark'>&#xf02e; fa-bookmark</option>
    <option value='fa-bookmark-o'>&#xf097; fa-bookmark-o</option>
    <option value='fa-braille'>&#xf2a1; fa-braille</option>
    <option value='fa-briefcase'>&#xf0b1; fa-briefcase</option>
    <option value='fa-btc'>&#xf15a; fa-btc</option>
    <option value='fa-bug'>&#xf188; fa-bug</option>
    <option value='fa-building'>&#xf1ad; fa-building</option>
    <option value='fa-building-o'>&#xf0f7; fa-building-o</option>
    <option value='fa-bullhorn'>&#xf0a1; fa-bullhorn</option>
    <option value='fa-bullseye'>&#xf140; fa-bullseye</option>
    <option value='fa-bus'>&#xf207; fa-bus</option>
    <option value='fa-buysellads'>&#xf20d; fa-buysellads</option>
    <option value='fa-cab'>&#xf1ba; fa-cab</option>
    <option value='fa-calculator'>&#xf1ec; fa-calculator</option>
    <option value='fa-calendar'>&#xf073; fa-calendar</option>
    <option value='fa-calendar-check-o'>&#xf274; fa-calendar-check-o</option>
    <option value='fa-calendar-minus-o'>&#xf272; fa-calendar-minus-o</option>
    <option value='fa-calendar-o'>&#xf133; fa-calendar-o</option>
    <option value='fa-calendar-plus-o'>&#xf271; fa-calendar-plus-o</option>
    <option value='fa-calendar-times-o'>&#xf273; fa-calendar-times-o</option>
    <option value='fa-camera'>&#xf030; fa-camera</option>
    <option value='fa-camera-retro'>&#xf083; fa-camera-retro</option>
    <option value='fa-car'>&#xf1b9; fa-car</option>
    <option value='fa-caret-down'>&#xf0d7; fa-caret-down</option>
    <option value='fa-caret-left'>&#xf0d9; fa-caret-left</option>
    <option value='fa-caret-right'>&#xf0da; fa-caret-right</option>
    <option value='fa-caret-square-o-down'>&#xf150; fa-caret-square-o-down</option>
    <option value='fa-caret-square-o-left'>&#xf191; fa-caret-square-o-left</option>
    <option value='fa-caret-square-o-right'>&#xf152; fa-caret-square-o-right</option>
    <option value='fa-caret-square-o-up'>&#xf151; fa-caret-square-o-up</option>
    <option value='fa-caret-up'>&#xf0d8; fa-caret-up</option>
    <option value='fa-cart-arrow-down'>&#xf218; fa-cart-arrow-down</option>
    <option value='fa-cart-plus'>&#xf217; fa-cart-plus</option>
    <option value='fa-cc'>&#xf20a; fa-cc</option>
    <option value='fa-cc-amex'>&#xf1f3; fa-cc-amex</option>
    <option value='fa-cc-diners-club'>&#xf24c; fa-cc-diners-club</option>
    <option value='fa-cc-discover'>&#xf1f2; fa-cc-discover</option>
    <option value='fa-cc-jcb'>&#xf24b; fa-cc-jcb</option>
    <option value='fa-cc-mastercard'>&#xf1f1; fa-cc-mastercard</option>
    <option value='fa-cc-paypal'>&#xf1f4; fa-cc-paypal</option>
    <option value='fa-cc-stripe'>&#xf1f5; fa-cc-stripe</option>
    <option value='fa-cc-visa'>&#xf1f0; fa-cc-visa</option>
    <option value='fa-certificate'>&#xf0a3; fa-certificate</option>
    <option value='fa-chain'>&#xf0c1; fa-chain</option>
    <option value='fa-chain-broken'>&#xf127; fa-chain-broken</option>
    <option value='fa-check'>&#xf00c; fa-check</option>
    <option value='fa-check-circle'>&#xf058; fa-check-circle</option>
    <option value='fa-check-circle-o'>&#xf05d; fa-check-circle-o</option>
    <option value='fa-check-square'>&#xf14a; fa-check-square</option>
    <option value='fa-check-square-o'>&#xf046; fa-check-square-o</option>
    <option value='fa-chevron-circle-down'>&#xf13a; fa-chevron-circle-down</option>
    <option value='fa-chevron-circle-left'>&#xf137; fa-chevron-circle-left</option>
    <option value='fa-chevron-circle-right'>&#xf138; fa-chevron-circle-right</option>
    <option value='fa-chevron-circle-up'>&#xf139; fa-chevron-circle-up</option>
    <option value='fa-chevron-down'>&#xf078; fa-chevron-down</option>
    <option value='fa-chevron-left'>&#xf053; fa-chevron-left</option>
    <option value='fa-chevron-right'>&#xf054; fa-chevron-right</option>
    <option value='fa-chevron-up'>&#xf077; fa-chevron-up</option>
    <option value='fa-child'>&#xf1ae; fa-child</option>
    <option value='fa-chrome'>&#xf268; fa-chrome</option>
    <option value='fa-circle'>&#xf111; fa-circle</option>
    <option value='fa-circle-o'>&#xf10c; fa-circle-o</option>
    <option value='fa-circle-o-notch'>&#xf1ce; fa-circle-o-notch</option>
    <option value='fa-circle-thin'>&#xf1db; fa-circle-thin</option>
    <option value='fa-clipboard'>&#xf0ea; fa-clipboard</option>
    <option value='fa-clock-o'>&#xf017; fa-clock-o</option>
    <option value='fa-clone'>&#xf24d; fa-clone</option>
    <option value='fa-close'>&#xf00d; fa-close</option>
    <option value='fa-cloud'>&#xf0c2; fa-cloud</option>
    <option value='fa-cloud-download'>&#xf0ed; fa-cloud-download</option>
    <option value='fa-cloud-upload'>&#xf0ee; fa-cloud-upload</option>
    <option value='fa-cny'>&#xf157; fa-cny</option>
    <option value='fa-code'>&#xf121; fa-code</option>
    <option value='fa-code-fork'>&#xf126; fa-code-fork</option>
    <option value='fa-codepen'>&#xf1cb; fa-codepen</option>
    <option value='fa-codiepie'>&#xf284; fa-codiepie</option>
    <option value='fa-coffee'>&#xf0f4; fa-coffee</option>
    <option value='fa-cog'>&#xf013; fa-cog</option>
    <option value='fa-cogs'>&#xf085; fa-cogs</option>
    <option value='fa-columns'>&#xf0db; fa-columns</option>
    <option value='fa-comment'>&#xf075; fa-comment</option>
    <option value='fa-comment-o'>&#xf0e5; fa-comment-o</option>
    <option value='fa-commenting'>&#xf27a; fa-commenting</option>
    <option value='fa-commenting-o'>&#xf27b; fa-commenting-o</option>
    <option value='fa-comments'>&#xf086; fa-comments</option>
    <option value='fa-comments-o'>&#xf0e6; fa-comments-o</option>
    <option value='fa-compass'>&#xf14e; fa-compass</option>
    <option value='fa-compress'>&#xf066; fa-compress</option>
    <option value='fa-connectdevelop'>&#xf20e; fa-connectdevelop</option>
    <option value='fa-contao'>&#xf26d; fa-contao</option>
    <option value='fa-copy'>&#xf0c5; fa-copy</option>
    <option value='fa-copyright'>&#xf1f9; fa-copyright</option>
    <option value='fa-creative-commons'>&#xf25e; fa-creative-commons</option>
    <option value='fa-credit-card'>&#xf09d; fa-credit-card</option>
    <option value='fa-credit-card-alt'>&#xf283; fa-credit-card-alt</option>
    <option value='fa-crop'>&#xf125; fa-crop</option>
    <option value='fa-crosshairs'>&#xf05b; fa-crosshairs</option>
    <option value='fa-css3'>&#xf13c; fa-css3</option>
    <option value='fa-cube'>&#xf1b2; fa-cube</option>
    <option value='fa-cubes'>&#xf1b3; fa-cubes</option>
    <option value='fa-cut'>&#xf0c4; fa-cut</option>
    <option value='fa-cutlery'>&#xf0f5; fa-cutlery</option>
    <option value='fa-dashboard'>&#xf0e4; fa-dashboard</option>
    <option value='fa-dashcube'>&#xf210; fa-dashcube</option>
    <option value='fa-database'>&#xf1c0; fa-database</option>
    <option value='fa-deaf'>&#xf2a4; fa-deaf</option>
    <option value='fa-deafness'>&#xf2a4; fa-deafness</option>
    <option value='fa-dedent'>&#xf03b; fa-dedent</option>
    <option value='fa-delicious'>&#xf1a5; fa-delicious</option>
    <option value='fa-desktop'>&#xf108; fa-desktop</option>
    <option value='fa-deviantart'>&#xf1bd; fa-deviantart</option>
    <option value='fa-diamond'>&#xf219; fa-diamond</option>
    <option value='fa-digg'>&#xf1a6; fa-digg</option>
    <option value='fa-dollar'>&#xf155; fa-dollar</option>
    <option value='fa-dot-circle-o'>&#xf192; fa-dot-circle-o</option>
    <option value='fa-download'>&#xf019; fa-download</option>
    <option value='fa-dribbble'>&#xf17d; fa-dribbble</option>
    <option value='fa-drivers-license'>&#xf2c2; fa-drivers-license</option>
    <option value='fa-drivers-license-o'>&#xf2c3; fa-drivers-license-o</option>
    <option value='fa-dropbox'>&#xf16b; fa-dropbox</option>
    <option value='fa-drupal'>&#xf1a9; fa-drupal</option>
    <option value='fa-edge'>&#xf282; fa-edge</option>
    <option value='fa-edit'>&#xf044; fa-edit</option>
    <option value='fa-eercast'>&#xf2da; fa-eercast</option>
    <option value='fa-eject'>&#xf052; fa-eject</option>
    <option value='fa-ellipsis-h'>&#xf141; fa-ellipsis-h</option>
    <option value='fa-ellipsis-v'>&#xf142; fa-ellipsis-v</option>
    <option value='fa-empire'>&#xf1d1; fa-empire</option>
    <option value='fa-envelope'>&#xf0e0; fa-envelope</option>
    <option value='fa-envelope-o'>&#xf003; fa-envelope-o</option>
    <option value='fa-envelope-open'>&#xf2b6; fa-envelope-open</option>
    <option value='fa-envelope-open-o'>&#xf2b7; fa-envelope-open-o</option>
    <option value='fa-envelope-square'>&#xf199; fa-envelope-square</option>
    <option value='fa-envira'>&#xf299; fa-envira</option>
    <option value='fa-eraser'>&#xf12d; fa-eraser</option>
    <option value='fa-etsy'>&#xf2d7; fa-etsy</option>
    <option value='fa-eur'>&#xf153; fa-eur</option>
    <option value='fa-euro'>&#xf153; fa-euro</option>
    <option value='fa-exchange'>&#xf0ec; fa-exchange</option>
    <option value='fa-exclamation'>&#xf12a; fa-exclamation</option>
    <option value='fa-exclamation-circle'>&#xf06a; fa-exclamation-circle</option>
    <option value='fa-exclamation-triangle'>&#xf071; fa-exclamation-triangle</option>
    <option value='fa-expand'>&#xf065; fa-expand</option>
    <option value='fa-expeditedssl'>&#xf23e; fa-expeditedssl</option>
    <option value='fa-external-link'>&#xf08e; fa-external-link</option>
    <option value='fa-external-link-square'>&#xf14c; fa-external-link-square</option>
    <option value='fa-eye'>&#xf06e; fa-eye</option>
    <option value='fa-eye-slash'>&#xf070; fa-eye-slash</option>
    <option value='fa-eyedropper'>&#xf1fb; fa-eyedropper</option>
    <option value='fa-fa'>&#xf2b4; fa-fa</option>
    <option value='fa-facebook'>&#xf09a; fa-facebook</option>
    <option value='fa-facebook-f'>&#xf09a; fa-facebook-f</option>
    <option value='fa-facebook-official'>&#xf230; fa-facebook-official</option>
    <option value='fa-facebook-square'>&#xf082; fa-facebook-square</option>
    <option value='fa-fast-backward'>&#xf049; fa-fast-backward</option>
    <option value='fa-fast-forward'>&#xf050; fa-fast-forward</option>
    <option value='fa-fax'>&#xf1ac; fa-fax</option>
    <option value='fa-feed'>&#xf09e; fa-feed</option>
    <option value='fa-female'>&#xf182; fa-female</option>
    <option value='fa-fighter-jet'>&#xf0fb; fa-fighter-jet</option>
    <option value='fa-file'>&#xf15b; fa-file</option>
    <option value='fa-file-archive-o'>&#xf1c6; fa-file-archive-o</option>
    <option value='fa-file-audio-o'>&#xf1c7; fa-file-audio-o</option>
    <option value='fa-file-code-o'>&#xf1c9; fa-file-code-o</option>
    <option value='fa-file-excel-o'>&#xf1c3; fa-file-excel-o</option>
    <option value='fa-file-image-o'>&#xf1c5; fa-file-image-o</option>
    <option value='fa-file-movie-o'>&#xf1c8; fa-file-movie-o</option>
    <option value='fa-file-o'>&#xf016; fa-file-o</option>
    <option value='fa-file-pdf-o'>&#xf1c1; fa-file-pdf-o</option>
    <option value='fa-file-photo-o'>&#xf1c5; fa-file-photo-o</option>
    <option value='fa-file-picture-o'>&#xf1c5; fa-file-picture-o</option>
    <option value='fa-file-powerpoint-o'>&#xf1c4; fa-file-powerpoint-o</option>
    <option value='fa-file-sound-o'>&#xf1c7; fa-file-sound-o</option>
    <option value='fa-file-text'>&#xf15c; fa-file-text</option>
    <option value='fa-file-text-o'>&#xf0f6; fa-file-text-o</option>
    <option value='fa-file-video-o'>&#xf1c8; fa-file-video-o</option>
    <option value='fa-file-word-o'>&#xf1c2; fa-file-word-o</option>
    <option value='fa-file-zip-o'>&#xf1c6; fa-file-zip-o</option>
    <option value='fa-files-o'>&#xf0c5; fa-files-o</option>
    <option value='fa-film'>&#xf008; fa-film</option>
    <option value='fa-filter'>&#xf0b0; fa-filter</option>
    <option value='fa-fire'>&#xf06d; fa-fire</option>
    <option value='fa-fire-extinguisher'>&#xf134; fa-fire-extinguisher</option>
    <option value='fa-firefox'>&#xf269; fa-firefox</option>
    <option value='fa-first-order'>&#xf2b0; fa-first-order</option>
    <option value='fa-flag'>&#xf024; fa-flag</option>
    <option value='fa-flag-checkered'>&#xf11e; fa-flag-checkered</option>
    <option value='fa-flag-o'>&#xf11d; fa-flag-o</option>
    <option value='fa-flash'>&#xf0e7; fa-flash</option>
    <option value='fa-flask'>&#xf0c3; fa-flask</option>
    <option value='fa-flickr'>&#xf16e; fa-flickr</option>
    <option value='fa-floppy-o'>&#xf0c7; fa-floppy-o</option>
    <option value='fa-folder'>&#xf07b; fa-folder</option>
    <option value='fa-folder-o'>&#xf114; fa-folder-o</option>
    <option value='fa-folder-open'>&#xf07c; fa-folder-open</option>
    <option value='fa-folder-open-o'>&#xf115; fa-folder-open-o</option>
    <option value='fa-font'>&#xf031; fa-font</option>
    <option value='fa-font-awesome'>&#xf2b4; fa-font-awesome</option>
    <option value='fa-fonticons'>&#xf280; fa-fonticons</option>
    <option value='fa-fort-awesome'>&#xf286; fa-fort-awesome</option>
    <option value='fa-forumbee'>&#xf211; fa-forumbee</option>
    <option value='fa-forward'>&#xf04e; fa-forward</option>
    <option value='fa-foursquare'>&#xf180; fa-foursquare</option>
    <option value='fa-free-code-camp'>&#xf2c5; fa-free-code-camp</option>
    <option value='fa-frown-o'>&#xf119; fa-frown-o</option>
    <option value='fa-futbol-o'>&#xf1e3; fa-futbol-o</option>
    <option value='fa-gamepad'>&#xf11b; fa-gamepad</option>
    <option value='fa-gavel'>&#xf0e3; fa-gavel</option>
    <option value='fa-gbp'>&#xf154; fa-gbp</option>
    <option value='fa-ge'>&#xf1d1; fa-ge</option>
    <option value='fa-gear'>&#xf013; fa-gear</option>
    <option value='fa-gears'>&#xf085; fa-gears</option>
    <option value='fa-genderless'>&#xf22d; fa-genderless</option>
    <option value='fa-get-pocket'>&#xf265; fa-get-pocket</option>
    <option value='fa-gg'>&#xf260; fa-gg</option>
    <option value='fa-gg-circle'>&#xf261; fa-gg-circle</option>
    <option value='fa-gift'>&#xf06b; fa-gift</option>
    <option value='fa-git'>&#xf1d3; fa-git</option>
    <option value='fa-git-square'>&#xf1d2; fa-git-square</option>
    <option value='fa-github'>&#xf09b; fa-github</option>
    <option value='fa-github-alt'>&#xf113; fa-github-alt</option>
    <option value='fa-github-square'>&#xf092; fa-github-square</option>
    <option value='fa-gitlab'>&#xf296; fa-gitlab</option>
    <option value='fa-gittip'>&#xf184; fa-gittip</option>
    <option value='fa-glass'>&#xf000; fa-glass</option>
    <option value='fa-glide'>&#xf2a5; fa-glide</option>
    <option value='fa-glide-g'>&#xf2a6; fa-glide-g</option>
    <option value='fa-globe'>&#xf0ac; fa-globe</option>
    <option value='fa-google'>&#xf1a0; fa-google</option>
    <option value='fa-google-plus'>&#xf0d5; fa-google-plus</option>
    <option value='fa-google-plus-circle'>&#xf2b3; fa-google-plus-circle</option>
    <option value='fa-google-plus-official'>&#xf2b3; fa-google-plus-official</option>
    <option value='fa-google-plus-square'>&#xf0d4; fa-google-plus-square</option>
    <option value='fa-google-wallet'>&#xf1ee; fa-google-wallet</option>
    <option value='fa-graduation-cap'>&#xf19d; fa-graduation-cap</option>
    <option value='fa-gratipay'>&#xf184; fa-gratipay</option>
    <option value='fa-grav'>&#xf2d6; fa-grav</option>
    <option value='fa-group'>&#xf0c0; fa-group</option>
    <option value='fa-h-square'>&#xf0fd; fa-h-square</option>
    <option value='fa-hacker-news'>&#xf1d4; fa-hacker-news</option>
    <option value='fa-hand-grab-o'>&#xf255; fa-hand-grab-o</option>
    <option value='fa-hand-lizard-o'>&#xf258; fa-hand-lizard-o</option>
    <option value='fa-hand-o-down'>&#xf0a7; fa-hand-o-down</option>
    <option value='fa-hand-o-left'>&#xf0a5; fa-hand-o-left</option>
    <option value='fa-hand-o-right'>&#xf0a4; fa-hand-o-right</option>
    <option value='fa-hand-o-up'>&#xf0a6; fa-hand-o-up</option>
    <option value='fa-hand-paper-o'>&#xf256; fa-hand-paper-o</option>
    <option value='fa-hand-peace-o'>&#xf25b; fa-hand-peace-o</option>
    <option value='fa-hand-pointer-o'>&#xf25a; fa-hand-pointer-o</option>
    <option value='fa-hand-rock-o'>&#xf255; fa-hand-rock-o</option>
    <option value='fa-hand-scissors-o'>&#xf257; fa-hand-scissors-o</option>
    <option value='fa-hand-spock-o'>&#xf259; fa-hand-spock-o</option>
    <option value='fa-hand-stop-o'>&#xf256; fa-hand-stop-o</option>
    <option value='fa-handshake-o'>&#xf2b5; fa-handshake-o</option>
    <option value='fa-hard-of-hearing'>&#xf2a4; fa-hard-of-hearing</option>
    <option value='fa-hashtag'>&#xf292; fa-hashtag</option>
    <option value='fa-hdd-o'>&#xf0a0; fa-hdd-o</option>
    <option value='fa-header'>&#xf1dc; fa-header</option>
    <option value='fa-headphones'>&#xf025; fa-headphones</option>
    <option value='fa-heart'>&#xf004; fa-heart</option>
    <option value='fa-heart-o'>&#xf08a; fa-heart-o</option>
    <option value='fa-heartbeat'>&#xf21e; fa-heartbeat</option>
    <option value='fa-history'>&#xf1da; fa-history</option>
    <option value='fa-home'>&#xf015; fa-home</option>
    <option value='fa-hospital-o'>&#xf0f8; fa-hospital-o</option>
    <option value='fa-hotel'>&#xf236; fa-hotel</option>
    <option value='fa-hourglass'>&#xf254; fa-hourglass</option>
    <option value='fa-hourglass-1'>&#xf251; fa-hourglass-1</option>
    <option value='fa-hourglass-2'>&#xf252; fa-hourglass-2</option>
    <option value='fa-hourglass-3'>&#xf253; fa-hourglass-3</option>
    <option value='fa-hourglass-end'>&#xf253; fa-hourglass-end</option>
    <option value='fa-hourglass-half'>&#xf252; fa-hourglass-half</option>
    <option value='fa-hourglass-o'>&#xf250; fa-hourglass-o</option>
    <option value='fa-hourglass-start'>&#xf251; fa-hourglass-start</option>
    <option value='fa-houzz'>&#xf27c; fa-houzz</option>
    <option value='fa-html5'>&#xf13b; fa-html5</option>
    <option value='fa-i-cursor'>&#xf246; fa-i-cursor</option>
    <option value='fa-id-badge'>&#xf2c1; fa-id-badge</option>
    <option value='fa-id-card'>&#xf2c2; fa-id-card</option>
    <option value='fa-id-card-o'>&#xf2c3; fa-id-card-o</option>
    <option value='fa-ils'>&#xf20b; fa-ils</option>
    <option value='fa-image'>&#xf03e; fa-image</option>
    <option value='fa-imdb'>&#xf2d8; fa-imdb</option>
    <option value='fa-inbox'>&#xf01c; fa-inbox</option>
    <option value='fa-indent'>&#xf03c; fa-indent</option>
    <option value='fa-industry'>&#xf275; fa-industry</option>
    <option value='fa-info'>&#xf129; fa-info</option>
    <option value='fa-info-circle'>&#xf05a; fa-info-circle</option>
    <option value='fa-inr'>&#xf156; fa-inr</option>
    <option value='fa-instagram'>&#xf16d; fa-instagram</option>
    <option value='fa-institution'>&#xf19c; fa-institution</option>
    <option value='fa-internet-explorer'>&#xf26b; fa-internet-explorer</option>
    <option value='fa-intersex'>&#xf224; fa-intersex</option>
    <option value='fa-ioxhost'>&#xf208; fa-ioxhost</option>
    <option value='fa-italic'>&#xf033; fa-italic</option>
    <option value='fa-joomla'>&#xf1aa; fa-joomla</option>
    <option value='fa-jpy'>&#xf157; fa-jpy</option>
    <option value='fa-jsfiddle'>&#xf1cc; fa-jsfiddle</option>
    <option value='fa-key'>&#xf084; fa-key</option>
    <option value='fa-keyboard-o'>&#xf11c; fa-keyboard-o</option>
    <option value='fa-krw'>&#xf159; fa-krw</option>
    <option value='fa-language'>&#xf1ab; fa-language</option>
    <option value='fa-laptop'>&#xf109; fa-laptop</option>
    <option value='fa-lastfm'>&#xf202; fa-lastfm</option>
    <option value='fa-lastfm-square'>&#xf203; fa-lastfm-square</option>
    <option value='fa-leaf'>&#xf06c; fa-leaf</option>
    <option value='fa-leanpub'>&#xf212; fa-leanpub</option>
    <option value='fa-legal'>&#xf0e3; fa-legal</option>
    <option value='fa-lemon-o'>&#xf094; fa-lemon-o</option>
    <option value='fa-level-down'>&#xf149; fa-level-down</option>
    <option value='fa-level-up'>&#xf148; fa-level-up</option>
    <option value='fa-life-bouy'>&#xf1cd; fa-life-bouy</option>
    <option value='fa-life-buoy'>&#xf1cd; fa-life-buoy</option>
    <option value='fa-life-ring'>&#xf1cd; fa-life-ring</option>
    <option value='fa-life-saver'>&#xf1cd; fa-life-saver</option>
    <option value='fa-lightbulb-o'>&#xf0eb; fa-lightbulb-o</option>
    <option value='fa-line-chart'>&#xf201; fa-line-chart</option>
    <option value='fa-link'>&#xf0c1; fa-link</option>
    <option value='fa-linkedin'>&#xf0e1; fa-linkedin</option>
    <option value='fa-linkedin-square'>&#xf08c; fa-linkedin-square</option>
    <option value='fa-linode'>&#xf2b8; fa-linode</option>
    <option value='fa-linux'>&#xf17c; fa-linux</option>
    <option value='fa-list'>&#xf03a; fa-list</option>
    <option value='fa-list-alt'>&#xf022; fa-list-alt</option>
    <option value='fa-list-ol'>&#xf0cb; fa-list-ol</option>
    <option value='fa-list-ul'>&#xf0ca; fa-list-ul</option>
    <option value='fa-location-arrow'>&#xf124; fa-location-arrow</option>
    <option value='fa-lock'>&#xf023; fa-lock</option>
    <option value='fa-long-arrow-down'>&#xf175; fa-long-arrow-down</option>
    <option value='fa-long-arrow-left'>&#xf177; fa-long-arrow-left</option>
    <option value='fa-long-arrow-right'>&#xf178; fa-long-arrow-right</option>
    <option value='fa-long-arrow-up'>&#xf176; fa-long-arrow-up</option>
    <option value='fa-low-vision'>&#xf2a8; fa-low-vision</option>
    <option value='fa-magic'>&#xf0d0; fa-magic</option>
    <option value='fa-magnet'>&#xf076; fa-magnet</option>
    <option value='fa-mail-forward'>&#xf064; fa-mail-forward</option>
    <option value='fa-mail-reply'>&#xf112; fa-mail-reply</option>
    <option value='fa-mail-reply-all'>&#xf122; fa-mail-reply-all</option>
    <option value='fa-male'>&#xf183; fa-male</option>
    <option value='fa-map'>&#xf279; fa-map</option>
    <option value='fa-map-marker'>&#xf041; fa-map-marker</option>
    <option value='fa-map-o'>&#xf278; fa-map-o</option>
    <option value='fa-map-pin'>&#xf276; fa-map-pin</option>
    <option value='fa-map-signs'>&#xf277; fa-map-signs</option>
    <option value='fa-mars'>&#xf222; fa-mars</option>
    <option value='fa-mars-double'>&#xf227; fa-mars-double</option>
    <option value='fa-mars-stroke'>&#xf229; fa-mars-stroke</option>
    <option value='fa-mars-stroke-h'>&#xf22b; fa-mars-stroke-h</option>
    <option value='fa-mars-stroke-v'>&#xf22a; fa-mars-stroke-v</option>
    <option value='fa-maxcdn'>&#xf136; fa-maxcdn</option>
    <option value='fa-meanpath'>&#xf20c; fa-meanpath</option>
    <option value='fa-medium'>&#xf23a; fa-medium</option>
    <option value='fa-medkit'>&#xf0fa; fa-medkit</option>
    <option value='fa-meetup'>&#xf2e0; fa-meetup</option>
    <option value='fa-meh-o'>&#xf11a; fa-meh-o</option>
    <option value='fa-mercury'>&#xf223; fa-mercury</option>
    <option value='fa-microchip'>&#xf2db; fa-microchip</option>
    <option value='fa-microphone'>&#xf130; fa-microphone</option>
    <option value='fa-microphone-slash'>&#xf131; fa-microphone-slash</option>
    <option value='fa-minus'>&#xf068; fa-minus</option>
    <option value='fa-minus-circle'>&#xf056; fa-minus-circle</option>
    <option value='fa-minus-square'>&#xf146; fa-minus-square</option>
    <option value='fa-minus-square-o'>&#xf147; fa-minus-square-o</option>
    <option value='fa-mixcloud'>&#xf289; fa-mixcloud</option>
    <option value='fa-mobile'>&#xf10b; fa-mobile</option>
    <option value='fa-mobile-phone'>&#xf10b; fa-mobile-phone</option>
    <option value='fa-modx'>&#xf285; fa-modx</option>
    <option value='fa-money'>&#xf0d6; fa-money</option>
    <option value='fa-moon-o'>&#xf186; fa-moon-o</option>
    <option value='fa-mortar-board'>&#xf19d; fa-mortar-board</option>
    <option value='fa-motorcycle'>&#xf21c; fa-motorcycle</option>
    <option value='fa-mouse-pointer'>&#xf245; fa-mouse-pointer</option>
    <option value='fa-music'>&#xf001; fa-music</option>
    <option value='fa-navicon'>&#xf0c9; fa-navicon</option>
    <option value='fa-neuter'>&#xf22c; fa-neuter</option>
    <option value='fa-newspaper-o'>&#xf1ea; fa-newspaper-o</option>
    <option value='fa-object-group'>&#xf247; fa-object-group</option>
    <option value='fa-object-ungroup'>&#xf248; fa-object-ungroup</option>
    <option value='fa-odnoklassniki'>&#xf263; fa-odnoklassniki</option>
    <option value='fa-odnoklassniki-square'>&#xf264; fa-odnoklassniki-square</option>
    <option value='fa-opencart'>&#xf23d; fa-opencart</option>
    <option value='fa-openid'>&#xf19b; fa-openid</option>
    <option value='fa-opera'>&#xf26a; fa-opera</option>
    <option value='fa-optin-monster'>&#xf23c; fa-optin-monster</option>
    <option value='fa-outdent'>&#xf03b; fa-outdent</option>
    <option value='fa-pagelines'>&#xf18c; fa-pagelines</option>
    <option value='fa-paint-brush'>&#xf1fc; fa-paint-brush</option>
    <option value='fa-paper-plane'>&#xf1d8; fa-paper-plane</option>
    <option value='fa-paper-plane-o'>&#xf1d9; fa-paper-plane-o</option>
    <option value='fa-paperclip'>&#xf0c6; fa-paperclip</option>
    <option value='fa-paragraph'>&#xf1dd; fa-paragraph</option>
    <option value='fa-paste'>&#xf0ea; fa-paste</option>
    <option value='fa-pause'>&#xf04c; fa-pause</option>
    <option value='fa-pause-circle'>&#xf28b; fa-pause-circle</option>
    <option value='fa-pause-circle-o'>&#xf28c; fa-pause-circle-o</option>
    <option value='fa-paw'>&#xf1b0; fa-paw</option>
    <option value='fa-paypal'>&#xf1ed; fa-paypal</option>
    <option value='fa-pencil'>&#xf040; fa-pencil</option>
    <option value='fa-pencil-square'>&#xf14b; fa-pencil-square</option>
    <option value='fa-pencil-square-o'>&#xf044; fa-pencil-square-o</option>
    <option value='fa-percent'>&#xf295; fa-percent</option>
    <option value='fa-phone'>&#xf095; fa-phone</option>
    <option value='fa-phone-square'>&#xf098; fa-phone-square</option>
    <option value='fa-photo'>&#xf03e; fa-photo</option>
    <option value='fa-picture-o'>&#xf03e; fa-picture-o</option>
    <option value='fa-pie-chart'>&#xf200; fa-pie-chart</option>
    <option value='fa-pied-piper'>&#xf2ae; fa-pied-piper</option>
    <option value='fa-pied-piper-alt'>&#xf1a8; fa-pied-piper-alt</option>
    <option value='fa-pied-piper-pp'>&#xf1a7; fa-pied-piper-pp</option>
    <option value='fa-pinterest'>&#xf0d2; fa-pinterest</option>
    <option value='fa-pinterest-p'>&#xf231; fa-pinterest-p</option>
    <option value='fa-pinterest-square'>&#xf0d3; fa-pinterest-square</option>
    <option value='fa-plane'>&#xf072; fa-plane</option>
    <option value='fa-play'>&#xf04b; fa-play</option>
    <option value='fa-play-circle'>&#xf144; fa-play-circle</option>
    <option value='fa-play-circle-o'>&#xf01d; fa-play-circle-o</option>
    <option value='fa-plug'>&#xf1e6; fa-plug</option>
    <option value='fa-plus'>&#xf067; fa-plus</option>
    <option value='fa-plus-circle'>&#xf055; fa-plus-circle</option>
    <option value='fa-plus-square'>&#xf0fe; fa-plus-square</option>
    <option value='fa-plus-square-o'>&#xf196; fa-plus-square-o</option>
    <option value='fa-podcast'>&#xf2ce; fa-podcast</option>
    <option value='fa-power-off'>&#xf011; fa-power-off</option>
    <option value='fa-print'>&#xf02f; fa-print</option>
    <option value='fa-product-hunt'>&#xf288; fa-product-hunt</option>
    <option value='fa-puzzle-piece'>&#xf12e; fa-puzzle-piece</option>
    <option value='fa-qq'>&#xf1d6; fa-qq</option>
    <option value='fa-qrcode'>&#xf029; fa-qrcode</option>
    <option value='fa-question'>&#xf128; fa-question</option>
    <option value='fa-question-circle'>&#xf059; fa-question-circle</option>
    <option value='fa-question-circle-o'>&#xf29c; fa-question-circle-o</option>
    <option value='fa-quora'>&#xf2c4; fa-quora</option>
    <option value='fa-quote-left'>&#xf10d; fa-quote-left</option>
    <option value='fa-quote-right'>&#xf10e; fa-quote-right</option>
    <option value='fa-ra'>&#xf1d0; fa-ra</option>
    <option value='fa-random'>&#xf074; fa-random</option>
    <option value='fa-ravelry'>&#xf2d9; fa-ravelry</option>
    <option value='fa-rebel'>&#xf1d0; fa-rebel</option>
    <option value='fa-recycle'>&#xf1b8; fa-recycle</option>
    <option value='fa-reddit'>&#xf1a1; fa-reddit</option>
    <option value='fa-reddit-alien'>&#xf281; fa-reddit-alien</option>
    <option value='fa-reddit-square'>&#xf1a2; fa-reddit-square</option>
    <option value='fa-refresh'>&#xf021; fa-refresh</option>
    <option value='fa-registered'>&#xf25d; fa-registered</option>
    <option value='fa-remove'>&#xf00d; fa-remove</option>
    <option value='fa-renren'>&#xf18b; fa-renren</option>
    <option value='fa-reorder'>&#xf0c9; fa-reorder</option>
    <option value='fa-repeat'>&#xf01e; fa-repeat</option>
    <option value='fa-reply'>&#xf112; fa-reply</option>
    <option value='fa-reply-all'>&#xf122; fa-reply-all</option>
    <option value='fa-resistance'>&#xf1d0; fa-resistance</option>
    <option value='fa-retweet'>&#xf079; fa-retweet</option>
    <option value='fa-rmb'>&#xf157; fa-rmb</option>
    <option value='fa-road'>&#xf018; fa-road</option>
    <option value='fa-rocket'>&#xf135; fa-rocket</option>
    <option value='fa-rotate-left'>&#xf0e2; fa-rotate-left</option>
    <option value='fa-rotate-right'>&#xf01e; fa-rotate-right</option>
    <option value='fa-rouble'>&#xf158; fa-rouble</option>
    <option value='fa-rss'>&#xf09e; fa-rss</option>
    <option value='fa-rss-square'>&#xf143; fa-rss-square</option>
    <option value='fa-rub'>&#xf158; fa-rub</option>
    <option value='fa-ruble'>&#xf158; fa-ruble</option>
    <option value='fa-rupee'>&#xf156; fa-rupee</option>
    <option value='fa-s15'>&#xf2cd; fa-s15</option>
    <option value='fa-safari'>&#xf267; fa-safari</option>
    <option value='fa-save'>&#xf0c7; fa-save</option>
    <option value='fa-scissors'>&#xf0c4; fa-scissors</option>
    <option value='fa-scribd'>&#xf28a; fa-scribd</option>
    <option value='fa-search'>&#xf002; fa-search</option>
    <option value='fa-search-minus'>&#xf010; fa-search-minus</option>
    <option value='fa-search-plus'>&#xf00e; fa-search-plus</option>
    <option value='fa-sellsy'>&#xf213; fa-sellsy</option>
    <option value='fa-send'>&#xf1d8; fa-send</option>
    <option value='fa-send-o'>&#xf1d9; fa-send-o</option>
    <option value='fa-server'>&#xf233; fa-server</option>
    <option value='fa-share'>&#xf064; fa-share</option>
    <option value='fa-share-alt'>&#xf1e0; fa-share-alt</option>
    <option value='fa-share-alt-square'>&#xf1e1; fa-share-alt-square</option>
    <option value='fa-share-square'>&#xf14d; fa-share-square</option>
    <option value='fa-share-square-o'>&#xf045; fa-share-square-o</option>
    <option value='fa-shekel'>&#xf20b; fa-shekel</option>
    <option value='fa-sheqel'>&#xf20b; fa-sheqel</option>
    <option value='fa-shield'>&#xf132; fa-shield</option>
    <option value='fa-ship'>&#xf21a; fa-ship</option>
    <option value='fa-shirtsinbulk'>&#xf214; fa-shirtsinbulk</option>
    <option value='fa-shopping-bag'>&#xf290; fa-shopping-bag</option>
    <option value='fa-shopping-basket'>&#xf291; fa-shopping-basket</option>
    <option value='fa-shopping-cart'>&#xf07a; fa-shopping-cart</option>
    <option value='fa-shower'>&#xf2cc; fa-shower</option>
    <option value='fa-sign-in'>&#xf090; fa-sign-in</option>
    <option value='fa-sign-language'>&#xf2a7; fa-sign-language</option>
    <option value='fa-sign-out'>&#xf08b; fa-sign-out</option>
    <option value='fa-signal'>&#xf012; fa-signal</option>
    <option value='fa-signing'>&#xf2a7; fa-signing</option>
    <option value='fa-simplybuilt'>&#xf215; fa-simplybuilt</option>
    <option value='fa-sitemap'>&#xf0e8; fa-sitemap</option>
    <option value='fa-skyatlas'>&#xf216; fa-skyatlas</option>
    <option value='fa-skype'>&#xf17e; fa-skype</option>
    <option value='fa-slack'>&#xf198; fa-slack</option>
    <option value='fa-sliders'>&#xf1de; fa-sliders</option>
    <option value='fa-slideshare'>&#xf1e7; fa-slideshare</option>
    <option value='fa-smile-o'>&#xf118; fa-smile-o</option>
    <option value='fa-snapchat'>&#xf2ab; fa-snapchat</option>
    <option value='fa-snapchat-ghost'>&#xf2ac; fa-snapchat-ghost</option>
    <option value='fa-snapchat-square'>&#xf2ad; fa-snapchat-square</option>
    <option value='fa-snowflake-o'>&#xf2dc; fa-snowflake-o</option>
    <option value='fa-soccer-ball-o'>&#xf1e3; fa-soccer-ball-o</option>
    <option value='fa-sort'>&#xf0dc; fa-sort</option>
    <option value='fa-sort-alpha-asc'>&#xf15d; fa-sort-alpha-asc</option>
    <option value='fa-sort-alpha-desc'>&#xf15e; fa-sort-alpha-desc</option>
    <option value='fa-sort-amount-asc'>&#xf160; fa-sort-amount-asc</option>
    <option value='fa-sort-amount-desc'>&#xf161; fa-sort-amount-desc</option>
    <option value='fa-sort-asc'>&#xf0de; fa-sort-asc</option>
    <option value='fa-sort-desc'>&#xf0dd; fa-sort-desc</option>
    <option value='fa-sort-down'>&#xf0dd; fa-sort-down</option>
    <option value='fa-sort-numeric-asc'>&#xf162; fa-sort-numeric-asc</option>
    <option value='fa-sort-numeric-desc'>&#xf163; fa-sort-numeric-desc</option>
    <option value='fa-sort-up'>&#xf0de; fa-sort-up</option>
    <option value='fa-soundcloud'>&#xf1be; fa-soundcloud</option>
    <option value='fa-space-shuttle'>&#xf197; fa-space-shuttle</option>
    <option value='fa-spinner'>&#xf110; fa-spinner</option>
    <option value='fa-spoon'>&#xf1b1; fa-spoon</option>
    <option value='fa-spotify'>&#xf1bc; fa-spotify</option>
    <option value='fa-square'>&#xf0c8; fa-square</option>
    <option value='fa-square-o'>&#xf096; fa-square-o</option>
    <option value='fa-stack-exchange'>&#xf18d; fa-stack-exchange</option>
    <option value='fa-stack-overflow'>&#xf16c; fa-stack-overflow</option>
    <option value='fa-star'>&#xf005; fa-star</option>
    <option value='fa-star-half'>&#xf089; fa-star-half</option>
    <option value='fa-star-half-empty'>&#xf123; fa-star-half-empty</option>
    <option value='fa-star-half-full'>&#xf123; fa-star-half-full</option>
    <option value='fa-star-half-o'>&#xf123; fa-star-half-o</option>
    <option value='fa-star-o'>&#xf006; fa-star-o</option>
    <option value='fa-steam'>&#xf1b6; fa-steam</option>
    <option value='fa-steam-square'>&#xf1b7; fa-steam-square</option>
    <option value='fa-step-backward'>&#xf048; fa-step-backward</option>
    <option value='fa-step-forward'>&#xf051; fa-step-forward</option>
    <option value='fa-stethoscope'>&#xf0f1; fa-stethoscope</option>
    <option value='fa-sticky-note'>&#xf249; fa-sticky-note</option>
    <option value='fa-sticky-note-o'>&#xf24a; fa-sticky-note-o</option>
    <option value='fa-stop'>&#xf04d; fa-stop</option>
    <option value='fa-stop-circle'>&#xf28d; fa-stop-circle</option>
    <option value='fa-stop-circle-o'>&#xf28e; fa-stop-circle-o</option>
    <option value='fa-street-view'>&#xf21d; fa-street-view</option>
    <option value='fa-strikethrough'>&#xf0cc; fa-strikethrough</option>
    <option value='fa-stumbleupon'>&#xf1a4; fa-stumbleupon</option>
    <option value='fa-stumbleupon-circle'>&#xf1a3; fa-stumbleupon-circle</option>
    <option value='fa-subscript'>&#xf12c; fa-subscript</option>
    <option value='fa-subway'>&#xf239; fa-subway</option>
    <option value='fa-suitcase'>&#xf0f2; fa-suitcase</option>
    <option value='fa-sun-o'>&#xf185; fa-sun-o</option>
    <option value='fa-superpowers'>&#xf2dd; fa-superpowers</option>
    <option value='fa-superscript'>&#xf12b; fa-superscript</option>
    <option value='fa-support'>&#xf1cd; fa-support</option>
    <option value='fa-table'>&#xf0ce; fa-table</option>
    <option value='fa-tablet'>&#xf10a; fa-tablet</option>
    <option value='fa-tachometer'>&#xf0e4; fa-tachometer</option>
    <option value='fa-tag'>&#xf02b; fa-tag</option>
    <option value='fa-tags'>&#xf02c; fa-tags</option>
    <option value='fa-tasks'>&#xf0ae; fa-tasks</option>
    <option value='fa-taxi'>&#xf1ba; fa-taxi</option>
    <option value='fa-telegram'>&#xf2c6; fa-telegram</option>
    <option value='fa-television'>&#xf26c; fa-television</option>
    <option value='fa-tencent-weibo'>&#xf1d5; fa-tencent-weibo</option>
    <option value='fa-terminal'>&#xf120; fa-terminal</option>
    <option value='fa-text-height'>&#xf034; fa-text-height</option>
    <option value='fa-text-width'>&#xf035; fa-text-width</option>
    <option value='fa-th'>&#xf00a; fa-th</option>
    <option value='fa-th-large'>&#xf009; fa-th-large</option>
    <option value='fa-th-list'>&#xf00b; fa-th-list</option>
    <option value='fa-themeisle'>&#xf2b2; fa-themeisle</option>
    <option value='fa-thermometer'>&#xf2c7; fa-thermometer</option>
    <option value='fa-thermometer-0'>&#xf2cb; fa-thermometer-0</option>
    <option value='fa-thermometer-1'>&#xf2ca; fa-thermometer-1</option>
    <option value='fa-thermometer-2'>&#xf2c9; fa-thermometer-2</option>
    <option value='fa-thermometer-3'>&#xf2c8; fa-thermometer-3</option>
    <option value='fa-thermometer-4'>&#xf2c7; fa-thermometer-4</option>
    <option value='fa-thermometer-empty'>&#xf2cb; fa-thermometer-empty</option>
    <option value='fa-thermometer-full'>&#xf2c7; fa-thermometer-full</option>
    <option value='fa-thermometer-half'>&#xf2c9; fa-thermometer-half</option>
    <option value='fa-thermometer-quarter'>&#xf2ca; fa-thermometer-quarter</option>
    <option value='fa-thermometer-three-quarters'>&#xf2c8; fa-thermometer-three-quarters</option>
    <option value='fa-thumb-tack'>&#xf08d; fa-thumb-tack</option>
    <option value='fa-thumbs-down'>&#xf165; fa-thumbs-down</option>
    <option value='fa-thumbs-o-down'>&#xf088; fa-thumbs-o-down</option>
    <option value='fa-thumbs-o-up'>&#xf087; fa-thumbs-o-up</option>
    <option value='fa-thumbs-up'>&#xf164; fa-thumbs-up</option>
    <option value='fa-ticket'>&#xf145; fa-ticket</option>
    <option value='fa-times'>&#xf00d; fa-times</option>
    <option value='fa-times-circle'>&#xf057; fa-times-circle</option>
    <option value='fa-times-circle-o'>&#xf05c; fa-times-circle-o</option>
    <option value='fa-times-rectangle'>&#xf2d3; fa-times-rectangle</option>
    <option value='fa-times-rectangle-o'>&#xf2d4; fa-times-rectangle-o</option>
    <option value='fa-tint'>&#xf043; fa-tint</option>
    <option value='fa-toggle-down'>&#xf150; fa-toggle-down</option>
    <option value='fa-toggle-left'>&#xf191; fa-toggle-left</option>
    <option value='fa-toggle-off'>&#xf204; fa-toggle-off</option>
    <option value='fa-toggle-on'>&#xf205; fa-toggle-on</option>
    <option value='fa-toggle-right'>&#xf152; fa-toggle-right</option>
    <option value='fa-toggle-up'>&#xf151; fa-toggle-up</option>
    <option value='fa-trademark'>&#xf25c; fa-trademark</option>
    <option value='fa-train'>&#xf238; fa-train</option>
    <option value='fa-transgender'>&#xf224; fa-transgender</option>
    <option value='fa-transgender-alt'>&#xf225; fa-transgender-alt</option>
    <option value='fa-trash'>&#xf1f8; fa-trash</option>
    <option value='fa-trash-o'>&#xf014; fa-trash-o</option>
    <option value='fa-tree'>&#xf1bb; fa-tree</option>
    <option value='fa-trello'>&#xf181; fa-trello</option>
    <option value='fa-tripadvisor'>&#xf262; fa-tripadvisor</option>
    <option value='fa-trophy'>&#xf091; fa-trophy</option>
    <option value='fa-truck'>&#xf0d1; fa-truck</option>
    <option value='fa-try'>&#xf195; fa-try</option>
    <option value='fa-tty'>&#xf1e4; fa-tty</option>
    <option value='fa-tumblr'>&#xf173; fa-tumblr</option>
    <option value='fa-tumblr-square'>&#xf174; fa-tumblr-square</option>
    <option value='fa-turkish-lira'>&#xf195; fa-turkish-lira</option>
    <option value='fa-tv'>&#xf26c; fa-tv</option>
    <option value='fa-twitch'>&#xf1e8; fa-twitch</option>
    <option value='fa-twitter'>&#xf099; fa-twitter</option>
    <option value='fa-twitter-square'>&#xf081; fa-twitter-square</option>
    <option value='fa-umbrella'>&#xf0e9; fa-umbrella</option>
    <option value='fa-underline'>&#xf0cd; fa-underline</option>
    <option value='fa-undo'>&#xf0e2; fa-undo</option>
    <option value='fa-universal-access'>&#xf29a; fa-universal-access</option>
    <option value='fa-university'>&#xf19c; fa-university</option>
    <option value='fa-unlink'>&#xf127; fa-unlink</option>
    <option value='fa-unlock'>&#xf09c; fa-unlock</option>
    <option value='fa-unlock-alt'>&#xf13e; fa-unlock-alt</option>
    <option value='fa-unsorted'>&#xf0dc; fa-unsorted</option>
    <option value='fa-upload'>&#xf093; fa-upload</option>
    <option value='fa-usb'>&#xf287; fa-usb</option>
    <option value='fa-usd'>&#xf155; fa-usd</option>
    <option value='fa-user'>&#xf007; fa-user</option>
    <option value='fa-user-circle'>&#xf2bd; fa-user-circle</option>
    <option value='fa-user-circle-o'>&#xf2be; fa-user-circle-o</option>
    <option value='fa-user-md'>&#xf0f0; fa-user-md</option>
    <option value='fa-user-o'>&#xf2c0; fa-user-o</option>
    <option value='fa-user-plus'>&#xf234; fa-user-plus</option>
    <option value='fa-user-secret'>&#xf21b; fa-user-secret</option>
    <option value='fa-user-times'>&#xf235; fa-user-times</option>
    <option value='fa-users'>&#xf0c0; fa-users</option>
    <option value='fa-vcard'>&#xf2bb; fa-vcard</option>
    <option value='fa-vcard-o'>&#xf2bc; fa-vcard-o</option>
    <option value='fa-venus'>&#xf221; fa-venus</option>
    <option value='fa-venus-double'>&#xf226; fa-venus-double</option>
    <option value='fa-venus-mars'>&#xf228; fa-venus-mars</option>
    <option value='fa-viacoin'>&#xf237; fa-viacoin</option>
    <option value='fa-viadeo'>&#xf2a9; fa-viadeo</option>
    <option value='fa-viadeo-square'>&#xf2aa; fa-viadeo-square</option>
    <option value='fa-video-camera'>&#xf03d; fa-video-camera</option>
    <option value='fa-vimeo'>&#xf27d; fa-vimeo</option>
    <option value='fa-vimeo-square'>&#xf194; fa-vimeo-square</option>
    <option value='fa-vine'>&#xf1ca; fa-vine</option>
    <option value='fa-vk'>&#xf189; fa-vk</option>
    <option value='fa-volume-control-phone'>&#xf2a0; fa-volume-control-phone</option>
    <option value='fa-volume-down'>&#xf027; fa-volume-down</option>
    <option value='fa-volume-off'>&#xf026; fa-volume-off</option>
    <option value='fa-volume-up'>&#xf028; fa-volume-up</option>
    <option value='fa-warning'>&#xf071; fa-warning</option>
    <option value='fa-wechat'>&#xf1d7; fa-wechat</option>
    <option value='fa-weibo'>&#xf18a; fa-weibo</option>
    <option value='fa-weixin'>&#xf1d7; fa-weixin</option>
    <option value='fa-whatsapp'>&#xf232; fa-whatsapp</option>
    <option value='fa-wheelchair'>&#xf193; fa-wheelchair</option>
    <option value='fa-wheelchair-alt'>&#xf29b; fa-wheelchair-alt</option>
    <option value='fa-wifi'>&#xf1eb; fa-wifi</option>
    <option value='fa-wikipedia-w'>&#xf266; fa-wikipedia-w</option>
    <option value='fa-window-close'>&#xf2d3; fa-window-close</option>
    <option value='fa-window-close-o'>&#xf2d4; fa-window-close-o</option>
    <option value='fa-window-maximize'>&#xf2d0; fa-window-maximize</option>
    <option value='fa-window-minimize'>&#xf2d1; fa-window-minimize</option>
    <option value='fa-window-restore'>&#xf2d2; fa-window-restore</option>
    <option value='fa-windows'>&#xf17a; fa-windows</option>
    <option value='fa-won'>&#xf159; fa-won</option>
    <option value='fa-wordpress'>&#xf19a; fa-wordpress</option>
    <option value='fa-wpbeginner'>&#xf297; fa-wpbeginner</option>
    <option value='fa-wpexplorer'>&#xf2de; fa-wpexplorer</option>
    <option value='fa-wpforms'>&#xf298; fa-wpforms</option>
    <option value='fa-wrench'>&#xf0ad; fa-wrench</option>
    <option value='fa-xing'>&#xf168; fa-xing</option>
    <option value='fa-xing-square'>&#xf169; fa-xing-square</option>
    <option value='fa-y-combinator'>&#xf23b; fa-y-combinator</option>
    <option value='fa-y-combinator-square'>&#xf1d4; fa-y-combinator-square</option>
    <option value='fa-yahoo'>&#xf19e; fa-yahoo</option>
    <option value='fa-yc'>&#xf23b; fa-yc</option>
    <option value='fa-yc-square'>&#xf1d4; fa-yc-square</option>
    <option value='fa-yelp'>&#xf1e9; fa-yelp</option>
    <option value='fa-yen'>&#xf157; fa-yen</option>
    <option value='fa-yoast'>&#xf2b1; fa-yoast</option>
    <option value='fa-youtube'>&#xf167; fa-youtube</option>
    <option value='fa-youtube-play'>&#xf16a; fa-youtube-play</option>
    <option value='fa-youtube-square'>&#xf166; fa-youtube-square</option>
</select>
                </div>
			
      

			      <!-- /.form-group -->
           
			
			
            <!-- /.col -->
           
		  
			";
		
			
		echo"	 <!-- radio -->
                <div class='form-group'>
				<label>Aktif</label>";
				 if ($r[aktif]=='N'){
				echo "
                  <div class='radio'>
                    <label>
                      <input type='radio' name='aktif'  value='N' checked>
                      N
                    </label>
                  </div>
                  <div class='radio'>
                    <label>
                      <input type='radio' name='aktif'  value='Y'>
                      Y
                    </label>
                  </div>";
                 }else{
					echo "
                  <div class='radio'>
                    <label>
                      <input type='radio' name='aktif'  value='N' >
                      N
                    </label>
                  </div>
                  <div class='radio'>
                    <label>
                      <input type='radio' name='aktif'  value='Y' checked>
                      Y
                    </label>
                  </div>"; 
				 } 
                echo"</div>
				 </br>
				<!-- /.form-group -->
            </div>
			
            <!-- /.col -->
          </div>
		  
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
              <div class='box-footer'>
                <a  class='btn btn-default' href='menu.html'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>Update</button>
              </div>
		</form>";
	//	}
    echo"  </div>";
   
    break;  
	//edit password
  
   }
   }
  ?>

<script>
  function showGroupmenu(menu) {
  sList = window.open('modul/menu/groupmenu.php', 'Print', 'width=920,height=420,scrollbars=yes');
  }

  function showSubmenu(menu) {
   var id_main = document.getElementById("id_main").value;
   sList = window.open('modul/menu/submenu.php?id='+id_main, 'Print', 'width=920,height=420,scrollbars=yes');
  }
</script>