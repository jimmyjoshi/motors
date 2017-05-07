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
        <title>Upload Videos | theart.nyc</title>
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
        <link rel="stylesheet" href="plugins/dropzone/dropzone.css">
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
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Upload Media
                        <small>Dashboard</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Upload Video</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<form action="uploadmedia.php" class="tabone-form dropzone" id="myImageUploadZone">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" id="imagecontentPostTitle" class="form-control" value="Title" name="image_content_post_title"/>
                            </div>
                            <div class="col-md-4">
                                <input type="hidden" name="category" value="video">
                                <button type="button" class="gallery-post-btn btn btn-primary"> Save</button>
                            </div>
                        </div>
                    </div>
                      <div class="clearfix"></div>
                  </form>
                </section>
                
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
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!--<script src="dist/js/pages/dashboard2.js"></script>-->
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <script src="plugins/dropzone/dropzone.js"></script>
        <script src="plugins/sweet-alert-box/sweetalert-dev.js"></script>
    <script>
        Dropzone.autoDiscover = false;

        var galleryDropZone = new Dropzone("#myImageUploadZone", 
        {
            url:                "uploadmedia.php",
            maxFiles:           1,
            dictDefaultMessage: "Drop Files here or Click Here to Upload Images",
            addRemoveLinks:     true,
            uploadMultiple:     true,
            parallelUploads:    10,
            acceptedFiles:      ".mp4",
            addRemoveLinks:     false,
            autoProcessQueue:   false,
            success: function(file, response) 
            { 
                if(response.status == true)
                {
                    swal("Good job!", "Your Video Uploaded Succesfuly !", "success");
                    window.location.assign("media.php?type=video");
                }
            },
            error: function (file, response) 
            {
                file.previewElement.classList.add("dz-error");
                sweetAlert("Oops...", "Something went wrong!", "error");
            },
            complete: function()
            {
                if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
                {
                    var _this = this;
                    _this.removeAllFiles();
                }

                swal("Good job!", "Your Video Uploaded Succesfuly ! You will be redirct to Listing soon.", "success");
                setTimeout(function()
                {
                    window.location.assign("media.php?type=video");
                }, 8000);
            }
        });

      jQuery(document).ready(function()
      {
            jQuery(document).on('click', '.gallery-post-btn', function()
            {
                galleryDropZone.processQueue();   
            });
      });
    </script>
    </body>
</html>
