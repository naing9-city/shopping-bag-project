<div class="premium-sidebar">
	<div class="premium-menu-section">
		<div class="premium-menu-title">Main</div>
		<ul class="premium-menu-list">
			<li class="premium-menu-item">
				<a href="dashboard.php" class="premium-menu-link">
					<i class="icon-dashboard"></i> Dashboard
				</a>
			</li>
		</ul>

		<div class="premium-menu-title">Order Management</div>
		<ul class="premium-menu-list">
			<li class="premium-menu-item">
				<a href="todays-orders.php" class="premium-menu-link">
					<i class="icon-tasks"></i> Today's Orders
					<?php
					$f1 = "00:00:00";
					$from = date('Y-m-d') . " " . $f1;
					$t1 = "23:59:59";
					$to = date('Y-m-d') . " " . $t1;
					$result = mysqli_query($con, "SELECT * FROM Orders where orderDate Between '$from' and '$to'");
					$num_rows1 = mysqli_num_rows($result);
					if ($num_rows1 > 0) { ?>
						<span class="badge"><?php echo htmlentities($num_rows1); ?></span>
					<?php } ?>
				</a>
			</li>
			<li class="premium-menu-item">
				<a href="pending-orders.php" class="premium-menu-link">
					<i class="icon-tasks"></i> Pending Orders
					<?php
					$status = 'Delivered';
					$ret = mysqli_query($con, "SELECT * FROM Orders where orderStatus!='$status' || orderStatus is null ");
					$num = mysqli_num_rows($ret);
					if ($num > 0) { ?>
						<span class="badge"><?php echo htmlentities($num); ?></span>
					<?php } ?>
				</a>
			</li>
			<li class="premium-menu-item">
				<a href="delivered-orders.php" class="premium-menu-link">
					<i class="icon-inbox"></i> Delivered Orders
					<?php
					$status = 'Delivered';
					$rt = mysqli_query($con, "SELECT * FROM Orders where orderStatus='$status'");
					$num1 = mysqli_num_rows($rt);
					if ($num1 > 0) { ?>
						<span class="badge" style="background:#2ecc71;"><?php echo htmlentities($num1); ?></span>
					<?php } ?>
				</a>
			</li>
		</ul>

		<div class="premium-menu-title">Catalog</div>
		<ul class="premium-menu-list">
			<li class="premium-menu-item">
				<a href="category.php" class="premium-menu-link">
					<i class="icon-folder-close"></i> Create Category
				</a>
			</li>
			<li class="premium-menu-item">
				<a href="subcategory.php" class="premium-menu-link">
					<i class="icon-sitemap"></i> Sub Category
				</a>
			</li>
			<li class="premium-menu-item">
				<a href="insert-product.php" class="premium-menu-link">
					<i class="icon-plus"></i> Insert Product
				</a>
			</li>
			<li class="premium-menu-item">
				<a href="manage-products.php" class="premium-menu-link">
					<i class="icon-table"></i> Manage Products
				</a>
			</li>
		</ul>

		<div class="premium-menu-title">Users</div>
		<ul class="premium-menu-list">
			<li class="premium-menu-item">
				<a href="manage-users.php" class="premium-menu-link">
					<i class="icon-group"></i> Manage Users
				</a>
			</li>
			<li class="premium-menu-item">
				<a href="user-logs.php" class="premium-menu-link">
					<i class="icon-laptop"></i> User Login Log
				</a>
			</li>
		</ul>

		<div class="premium-menu-title">Account</div>
		<ul class="premium-menu-list">
			<li class="premium-menu-item">
				<a href="logout.php" class="premium-menu-link">
					<i class="icon-signout"></i> Logout
				</a>
			</li>
		</ul>
	</div>
</div>