<?php
require_once('includes/master.class.php');
$object = new Master;

$status = $object->validateSession();

if($_SESSION['role'] != 1)
{
    header('location:dashboard.php');
}

$users = $object->getAllDealers();   

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Manage Dealers |  Manoj Motors</title>
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
                <!-- Content Header (Page header) -->
                <section class="content-header">
                   <table id="mediaTable">
                       <thead>
                        <tr>
                            <td>Sr</td>
                            <td>Username</td>
                            <td>Name</td>
                            <td>Address</td>
                            <td>City</td>
                            <td>Area</td>
                            <td>Mobile</td>
                            <td>Tin No</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $sr = 1;
                                foreach($users as $user)
                                {
                            ?>
                                <tr id="item-<?php echo $user['id'];?>">
                                    <td><?php echo $sr;?></td>
                                    <td><?php echo $user['username'];?></td>
                                    <td><?php echo $user['nickname'];?></td>
                                    <td><?php echo $user['add1'];?></td>
                                    <td><?php echo $user['city'];?></td>
                                    <td><?php echo $user['area'];?></td>
                                    <td><?php echo $user['tel'];?></td>
                                    <td><?php echo $user['tinno'];?></td>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" data-status="<?php echo $user['status'];?>" data-id="<?php echo $user['id'];?>" class="inactive-item">
                                            <?php 
                                                if($user['status'] == 1) 
                                                { 
                                                    echo "Inactive"; 
                                                }
                                                else
                                                {
                                                    echo "Activate";
                                                }
                                            ?>
                                        </a>
                                        <a href="javascript:void(0);" data-id="<?php echo $user['id'];?>" class="delete-item">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php   
                                $sr++;
                                }
                            ?>
                        </tbody>
                   </table>
                </section>

                <!-- Main content -->
               
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
            <script>
            $(function () {
                $("#mediaTable").DataTable();
              });
        jQuery(document).ready(function()
        {
            jQuery(document).on('click', '.inactive-item', function()
            {
                updateUser(this);
            });

            jQuery(document).on("click", '.delete-item', function()
            {
                var element = this;
                
                swal({
                  title: "Are you sure?",
                  text: "You want recover this user back !",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes, delete it!",
                  closeOnConfirm: false
                },
                function(){
                    removeMedia(element);
                            
                  swal("Deleted!", "User has been deleted.", "success");
                });
                console.log(this);
            });
        });

function updateUser(element)     
{
    var id              = jQuery(element).attr('data-id'),
        currentStatus   = jQuery(element).attr('data-status'),
        updateStatus    = 0;

    if(currentStatus == 0)
    {
        updateStatus = 1;
    }

    jQuery.ajax(
    {
        url: "updateUser.php",
        type: 'POST',
        dataType: 'JSON',
        data: {
            'user_id': id,
            'status': updateStatus
        },
        success: function(data)
        {
            if(data.status == true)
            {
                swal("Updated!", "User status been updated Successfully. Please Reload the Page", "success");
                setTimeout(function()
                {
                    location.reload();
                }, 3000);
            }
            else
            {
                sweetAlert("Oops...", "Something went wrong!", "error");
            }
        },
        error: function(data)
        {
            sweetAlert("Oops...", "Something went wrong!", "error");
        }
    });
}

function removeMedia(element)
{
    var id = jQuery(element).attr('data-id');
    
    jQuery.ajax(
    {
        url: "removeUser.php",
        type: 'POST',
        dataType: 'JSON',
        data: {
            'id': id
        },
        success: function(data)
        {
            if(data.status == true)
            {
                jQuery("#item-"+id).remove();
            }
            else
            {
                sweetAlert("Oops...", "Something went wrong!", "error");
            }
        },
        error: function(data)
        {
            sweetAlert("Oops...", "Something went wrong!", "error");
        }
    });
}
</script>
    </body>
</html>
