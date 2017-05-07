<aside class="main-sidebar">
<section class="sidebar">
	<!-- Sidebar user panel -->
	<div class="user-panel">
		<div class="pull-left image">
			<!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
			<br>
		</div>
		<div class="pull-left info">
			<p><?php echo $_SESSION['first_name'] . ' '.$_SESSION['last_name'];?></p>
		</div>
	</div>
	<!-- sidebar menu: : style can be found in sidebar.less -->
	<ul class="sidebar-menu">
		<li class="header">MAIN NAVIGATION</li>

		<li class="active treeview">
			<a href = "dashboard.php">
				<i class="fa fa-dashboard"></i> <span>Dashboard</span>
			</a>
		</li>

		<li class="active treeview">
			<a href="products.php">
				<i class="fa fa-users"></i> <span>Manage Products</span>
			</a>
		</li>

		<li class="active treeview">
			<a href = "users.php?type=sales">
				<i class="fa fa-users"></i> <span>Manage Sales Executives</span>
			</a>
		</li>

		<li class="active treeview">
			<a href="dealers.php">
				<i class="fa fa-users"></i> <span>Manage Dealers</span>
			</a>
		</li>
		<li class="active treeview">
			<a href="dashboard.php">
				<i class="fa fa-users"></i> <span>Manage Orders</span>
			</a>
		</li>
		<li class="active treeview">
			<a href="offers.php">
				<i class="fa fa-users"></i> <span>Offers</span>
			</a>
		</li>
		<li class="active treeview">
			<a href="message.php">
				<i class="fa fa-users"></i> <span>Inbox</span>
			</a>
		</li>
		<li class="active treeview">
			<a href="create-message.php">
				<i class="fa fa-users"></i> <span>Compose</span>
			</a>
		</li>
	</ul>
</section>
</aside>

