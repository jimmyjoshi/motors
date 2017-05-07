_<?php
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
  <title>TheArt | Registration Page</title>
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
<body class="hold-transition register-page">
 <div class="layer">
<div class="register-box">
  <div class="register-box-body">
   <h4 class="goback"><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>">Go back</a></h4>
   <div class="register-logo">
    <a href="index.php"><img class="logo" src="../images/the art logo web.png" alt=""></a>
  </div>
    <h3 class="login-box-msg">Register a new membership</h3>

    <div class="col-md-12">
    	<div class="row">
    		<div class="col-md-6">
    			<p>
    				Login Panel Advantages
    				<ul>
    					<li>Upload Paints/Graphic/Videos</li>
    					<li>Manage Paints/Graphic/Videos</li>
    				</ul>
    			</p>
    		</div>
    		<div class="col-md-6">
	    		<form action="registeruser.php" method="post">
	    		  <div class="form-group has-feedback">
	    		    <input type="text" class="form-control" name="first_name" placeholder="First Name" required="required" > 
	    		    <span class="glyphicon glyphicon-user form-control-feedback"></span>
	    		  </div>
	    		  <div class="form-group has-feedback">
	    		    <input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required">
	    		    <span class="glyphicon glyphicon-user form-control-feedback"></span>
	    		  </div>
                   <div class="form-group has-feedback">
	    		    <input type="text" class="form-control" name="nick_name" placeholder="Nick Name" required="required">
	    		    <span class="glyphicon glyphicon-user form-control-feedback"></span>
	    		  </div>
	    		  <div class="form-group has-feedback">
	    		    <input type="email" class="form-control" name="email_id" placeholder="Email" required="required">
	    		    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	    		  </div>
	    		  <div class="form-group has-feedback">
	    		    <input type="password" class="form-control" name="password" placeholder="Password" required="required">
	    		    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	    		  </div>
	    		    <div class="col-xs-8">
	    		      <div class="checkbox icheck">
	    		        <label>
	    		          <input type="checkbox" name="agree" required="required"> I agree to the <a href="#">terms</a>
	    		        </label>
	    		      </div>
	    		    </div>
	    		    <!-- /.col -->
	    		    <div class="col-xs-4 nopad">
	    		      <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
	    		    </div>
	    		    
	    		    <div class="form-group has-feedback col-md-12 nopad">
               
	    		    	<a class="gr_full" href="index.php" class="text-center">I already have a membership</a>
	    		  	</div>
	    		</form>
	    	</div>
	    </div>
    </div>
   

   <!-- <div class="social-auth-links text-center"></div>

    <a style="width:100%" href="index.php" class="text-center">&nbsp;</a>-->
    
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
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
