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
        <title>Dashboard | Manoj Motors</title>
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
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Dashboard</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				    <div class="row">

                    <?php 
                        if($_SESSION['role'] == 1)
                        {
                        $statstics = $object->getAdminDashboardStatstics();
                    ?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-user" aria-hidden="true"></i></span>
                                <div class="info-box-content">
                                    <a href="users.php">
                                        <span class="info-box-text">Total Dealers</span>
                                        <span class="info-box-number"><?php echo $statstics['dealers'];?></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-paint-brush" aria-hidden="true"></i></span>
                                <div class="info-box-content">
                                    <a href="media.php">
                                        <span class="info-box-text">Total Sales Executives</span>
                                        <span class="info-box-number"><?php echo $statstics['executives'];?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-file-image-o" aria-hidden="true"></i></span>
                                <div class="info-box-content">
                                    <a href="media.php?type=graphic">
                                        <span class="info-box-text">Uploaded Graphics</span>
                                        <span class="info-box-number">test</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    
                        <div class="clearfix visible-sm-block"></div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-file-video-o" aria-hidden="true"></i></span>
                                <div class="info-box-content">
                                    <a href="media.php?type=video">
                                        <span class="info-box-text">Uploaded Videos</span>
                                        <span class="info-box-number">test</span>
                                    </a>
                                </div>
                            </div>
                        </div>  
                        
                    <?php } ?>

                    <?php 
                        if($_SESSION['role'] == 0)
                        {
                        $statstics = $object->getUserDashboardStatstics($_SESSION['user_id']);
                    ?>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-paint-brush" aria-hidden="true"></i></span>
                                <div class="info-box-content">
                                    <a href="media.php">
                                        <span class="info-box-text">Uploaded Paints</span>
                                        <span class="info-box-number"><?php echo $statstics['image_count'];?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-file-image-o" aria-hidden="true"></i></span>
                                <div class="info-box-content">
                                    <a href="media.php?type=graphic">
                                        <span class="info-box-text">Uploaded Graphics</span>
                                        <span class="info-box-number"><?php echo $statstics['graphic_count'];?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    
                        <div class="clearfix visible-sm-block"></div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-file-video-o" aria-hidden="true"></i></span>
                                <div class="info-box-content">
                                    <a href="media.php?type=video">
                                        <span class="info-box-text">Uploaded Videos</span>
                                        <span class="info-box-number"><?php echo $statstics['video_count'];?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                </section>
            </div>
            
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
    </body>
</html>
