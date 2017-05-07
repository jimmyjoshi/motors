<?php
require_once('includes/master.class.php');
$object = new Master;
$status = $object->checkUser();

if($status)
{
	header("location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Forgot Password | The Art </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/gr_custom.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-box-body">
  <h4 class="goback"><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>">Go back</a></h4>
   <div class="login-logo">
    <a href="index.php"><img class="logo" src="../images/the art logo web.png" alt=""></a>
  </div>
    <p class="login-box-msg">Recover Password</p>
    
    <?php
		if(isset($_GET['status'])  && $_GET['status'] == 0  )
		{
			echo '<p class="login-box-msg"><div class="alert alert-danger alert-dismissible"><h5>No Register User Found - Please try with Other Email Id !</h5></div></p>';
		}
		
		if(isset($_GET['status'])  && $_GET['status'] == 1  )
		{
			echo '<p class="login-box-msg"><div class="alert alert-success alert-dismissible"><h5>We have send you an Email with New Password Please check.</h5></div></p>';
		}
    ?>
   

    <form action="forgotpassword.php" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="emailid" class="form-control" placeholder="Email" required="required">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
		<div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Recover</button>
        </div>
      </div>
    </form>

    <div class="social-auth-links text-center"></div>
    
    <a style="" href="index.php">Login</a><br>
    <a style="" href="register.php" class="text-center">Register a new membership</a>
    
    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
