<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SKT | Sistem Koperasi Terpadu</title>
  <link rel="shortcut icon" href="img/logo_martabe.png" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
   <!-- login css -->
  <link rel="stylesheet" href="css/login.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- sweet alert -->
  <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
    <script src="dist/sweetalert.min.js"></script>
  
  <script type="text/javascript">
  function ceklogin(){
	  var formlogin= document.getElementById("formlogin");
	  if (formlogin.username.value==""){
		   sweetAlert("Masukan Username Anda");
		  return false;
	  }else if(formlogin.password.value==""){
		   sweetAlert("Masukan Password Anda");
		  return false;
	  }
  }
  </script>
  
</head>
<body >
<div class="container">
  
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    
    <div class="col-md-4">
      <section class="login-form">
	 
        <form method="post" action="verifikasi.php" role="login">
		    <p class="login-box-msg"><b><span style="color:#969292;">Sistem Koperasi Terpadu (SKT)</span></b></p>
        <!--  <img src="http://i.imgur.com/RcmcLv4.png" class="img-responsive" alt="" />-->
          <input type="username" name="username" placeholder="Username" required class="form-control input-lg"  />
          
          <input type="password" name="password" class="form-control input-lg" id="password" placeholder="Password" required="" />
          
          
          <div class="pwstrength_viewport_progress"></div>
          
          
          <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Sign in</button>
         
          
        </form>
        
        <div class="form-links">
         
        </div>
      </section>  
      </div>
      
      <div class="col-md-4"></div>
      

  </div>
  
  
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
