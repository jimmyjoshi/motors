<?php
require_once('includes/master.class.php');
$object = new Master;

$status = $object->validateSession();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Create Offer | Manoj Motors</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="plugins/datatables/jquery.dataTables.min.css">
        <link rel="stylesheet" href="plugins/sweet-alert-box/sweetalert.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
			<?php require_once('includes/header.php');?>
            <!-- Left side column. contains the logo and sidebar -->
			<?php require_once('includes/left.side.bar.php');?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
            <section class="content-header">
      			<h1>Create Product</h1>
    		</section>
            	<section class="content">
            	<form action="save-product.php" method="post" class="form-horizontal" id="createProductForm">
                	<div class="col-md-6">	   
                		<div class="row">
                		    <div class="form-group">
                				<div class="col-md-4">
                					Product Name : 
                				</div>
                				<div class="col-md-8">
                					<input type="text" id="name" name="name" autocomplete="off" required="required" class="form-control">
                				</div>
                			</div>

                			<div class="form-group">
                				<div class="col-md-4">
                					Product Code : 
                				</div>
                				<div class="col-md-8">
                					<input type="text" id="code" name="code" autocomplete="off" required="required" class="form-control">
                				</div>
                			</div>

                            <div class="form-group">
                                <div class="col-md-4">
                                    Product Category : 
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="category" name="category" autocomplete="off" class="form-control">
                                </div>
                            </div>

                			<div class="form-group">
                				<div class="col-md-4">
                					Product Price : 
                				</div>
                				<div class="col-md-8">
                					<input type="text" id="price" name="price" autocomplete="off" required="required" class="form-control">
                				</div>
                			</div>
                            
                            <div class="form-group">
                				<div class="col-md-4">
                					Product Description : 
                				</div>
                				<div class="col-md-8">
                					<textarea name="description" id="description" class="form-control"></textarea>
                				</div>
                			</div>

                            <div class="form-group">
                				<div class="col-md-4"></div>
                				<div class="col-md-8">
                					<input type="submit" name="save" value="Save" class="btn btn-primary btn-flat">
                					<input type="reset" name="reset" value="Reset"  class="btn btn-primary btn-flat">
                				</div>
                			</div>
                		</div>	
                	</div>
                </form>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

			<?php require_once('includes/footer.php');?>

            <div class="control-sidebar-bg"></div>

        </div>
        <!-- ./wrapper -->
		
        <!-- jQuery 2.2.3 -->
        <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- Sparkline -->
        <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- ChartJS 1.0.1 -->
        <script src="plugins/chartjs/Chart.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!--<script src="dist/js/pages/dashboard2.js"></script>-->
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/sweet-alert-box/sweetalert-dev.js"></script>

    <script type="text/javascript">
    	jQuery(document).ready(function()
    	{
    		jQuery('#userProfileForm').submit(function() 
    		{
    			if(jQuery("#user_password").val().length < 4)  	
    			{
    				sweetAlert("Oops...", "Minimum 5 Character Required for Password !", "error");
    				jQuery("#user_password").focus();
    				return false;
    			}

    			if(jQuery("#user_password").val() != jQuery("#cnf_user_password").val())  	
    			{
    				sweetAlert("Oops...", "Password doesn't match with Confirm Password !", "error");
    				jQuery("#user_password").focus();
    				return false;
    			}
    		});
    	});

    </script>
    </body>
</html>
