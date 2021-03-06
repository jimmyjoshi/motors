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
  <title>Manoj Motors | Log in</title>
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
 <div class="layer">
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body">
  <!--<h4 class="goback"><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>">Go back</a></h4>-->
  	<div class="login-logo">
    <h2>Manoj Motors</h2>
  </div>
    <h3 class="login-box-msg">Sign in to start your session</h3>
    <?php
		if(isset($_GET['status'])  && $_GET['status'] == 0  )
		{
			echo '<p class="login-box-msg"><div class="alert alert-warning alert-dismissible"><h5>Unable to Signin - User not found or User is Not Active !</h5> </div></p>';
		}
		
		if(isset($_GET['status'])  && $_GET['status'] == 1  )
		{
			echo '<p class="login-box-msg"><div class="alert alert-warning alert-dismissible"><h5>User Activated, Please login with your Details</h5> </div></p>';
		}

    if(isset($_GET['status'])  && $_GET['status'] == 3  )
    {
      echo '<p class="login-box-msg"><div class="alert alert-danger alert-dismissible"><h5>User Already Registered ! Please try with Another Email Id</h5> </div></p>';
    }

    if(isset($_GET['status'])  && $_GET['status'] == 5  )
    {
      echo '<p class="login-box-msg"><div class="alert alert-success alert-dismissible"><h5>User Register Successfully ! Please Confirm your Email Address to Login into Application.</h5> </div></p>';
    }

    ?>
   

    <form action="validate.php" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="emailid" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
		<div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>

    <div class="social-auth-links text-center"></div>
    
    <a href="forgot-password.php">I forgot my password</a><br>
    <!--<a href="register.php" class="text-center">Register a new membership</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</div>
<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
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
