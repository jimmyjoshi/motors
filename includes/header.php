<link rel="stylesheet" href="dist/css/gr_custom.css">
            <header class="main-header">
				<!-- Logo -->
                <a href="dashboard.php" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>rt</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">
                        Manoj Motors
                    </span>
                </a>

                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                           <?php
                           /*
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!--<img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
                                    <span class="hidden-xs">
										<?php echo $_SESSION['first_name'] . ' '.$_SESSION['last_name'];?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
										<p>
                                            <?php echo $_SESSION['first_name'] . ' '.$_SESSION['last_name'];?>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>*/?>
                            <!--<li>
                                <a href="edit-user.php">Edit Profile</a>
                            </li>-->
                            <li>
                                <a href="edit-password.php">Update Password</a>
                            </li>
                            <li>
								<a href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>

                </nav>
            </header>