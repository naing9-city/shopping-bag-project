<?php
if (isset($_GET['action'])) {
	if (!empty($_SESSION['cart'])) {
		foreach ($_POST['quantity'] as $key => $val) {
			if ($val == 0) {
				unset($_SESSION['cart'][$key]);
			} else {
				$_SESSION['cart'][$key]['quantity'] = $val;
			}
		}
	}
}
?>
<header class="header-style-1 premium-header">
	<div class="container-fluid">
		<div class="premium-navbar">
			<!-- Logo Section -->
			<div class="navbar-header">
				<a href="index.php" class="navbar-brand">
					<img src="assets/images/logo.svg" alt="Cherry Store" class="logo-img">
				</a>
			</div>



			<!-- Navigation Links -->
			<div class="navbar-menu">
				<ul class="nav navbar-nav">
					<li class="border-0"><a href="index.php">Home</a></li>
					<li class="border-0"><a href="contact-us.php">Contact</a></li>

					<!-- Related Buttons -->
					<li class="border-0"><a href="my-account.php" title="My Account"><i class="fa fa-user"></i></a></li>
					<li class="border-0"><a href="my-wishlist.php" title="Wishlist"><i class="fa fa-heart"></i></a></li>

					<!-- Shopping Cart Dropdown -->
					<li class="dropdown dropdown-cart border-0">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Cart">
							<i class="fa fa-shopping-cart cart-icon"
								style="color: #333 !important; font-size: 22px !important; visibility: visible !important; opacity: 1 !important;"></i>
							<?php if (!empty($_SESSION['cart'])) { ?>
								<span class="badge"
									style="background:#ff416c; position:relative; top:-10px; left:-5px;"><?php echo $_SESSION['qnty']; ?></span>
							<?php } ?>
						</a>

						<ul class="dropdown-menu dropdown-menu-right"
							style="min-width: 300px; padding: 20px; border-radius: 15px; border:none; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
							<?php
							if (!empty($_SESSION['cart'])) {
								$sql = "SELECT * FROM products WHERE id IN(";
								foreach ($_SESSION['cart'] as $id => $value) {
									$sql .= $id . ",";
								}
								$sql = substr($sql, 0, -1) . ") ORDER BY id ASC";
								$query = mysqli_query($con, $sql);
								$totalprice = 0;
								$totalqunty = 0;
								if (!empty($query)) {
									while ($row = mysqli_fetch_array($query)) {
										$quantity = $_SESSION['cart'][$row['id']]['quantity'];
										$subtotal = $_SESSION['cart'][$row['id']]['quantity'] * $row['productPrice'] + $row['shippingCharge'];
										$totalprice += $subtotal;
										$_SESSION['qnty'] = $totalqunty += $quantity;
										?>
										<li>
											<div class="cart-item product-summary"
												style="margin-bottom: 15px; border-bottom: 1px solid #f0f0f0; padding-bottom: 10px;">
												<div class="row">
													<div class="col-xs-4">
														<div class="image">
															<a href="product-details.php?pid=<?php echo $row['id']; ?>"><img
																	src="admin/productimages/<?php echo $row['id']; ?>/<?php echo $row['productImage1']; ?>"
																	width="50" height="50" alt="" style="border-radius: 8px;"></a>
														</div>
													</div>
													<div class="col-xs-8">
														<h5 class="name" style="margin:0 0 5px;"><a
																href="product-details.php?pid=<?php echo $row['id']; ?>"><?php echo $row['productName']; ?></a>
														</h5>
														<div class="price">
															MMK.<?php echo ($row['productPrice'] + $row['shippingCharge']); ?> x
															<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>
														</div>
													</div>
												</div>
											</div>
										</li>
									<?php }
								} ?>
								<div class="clearfix"></div>
								<div class="clearfix cart-total"
									style="background: #f9f9f9; padding: 10px; border-radius: 10px; margin-top: 10px;">
									<div class="pull-right">
										<span class="text" style="font-weight:600;">Total :</span>
										<span class='price'
											style="color:#ff416c; font-weight:700;">MMK.<?php echo $_SESSION['tp'] = "$totalprice" . ".00"; ?></span>
									</div>
									<div class="clearfix"></div>
									<a href="my-cart.php" class="btn btn-primary btn-block m-t-20"
										style="background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%); border:none; border-radius: 50px; margin-top: 15px;">Checkout</a>
								</div>
							<?php } else { ?>
								<li>
									<div class="cart-item product-summary">
										<div class="row">
											<div class="col-xs-12">
												Your Shopping Cart is Empty.
											</div>
										</div>
									</div>
								</li>
							<?php } ?>
						</ul>
					</li>

					<!-- Login/Logout -->
					<?php if (strlen($_SESSION['login']) == 0) { ?>
						<li class="border-0">
						<li class="border-0">
							<a href="login.php"
								style="display: inline-block !important; padding: 8px 25px !important; color: #fff !important; margin-left:10px; background: #111 !important; border-radius: 50px !important; font-weight: 600; text-transform: uppercase; font-size: 12px; letter-spacing: 1px; text-decoration: none !important; transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); box-shadow: 0 4px 10px rgba(0,0,0,0.15);">
								<i class="fa fa-user" style="margin-right:6px;"></i> Login
							</a>
						</li>
						</li>
					<?php } else { ?>
						<li class="border-0"><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</header>
<style>
	/* Additional Inline Fixes for Icons in Nav */
	.premium-navbar .navbar-nav>li>a i {
		font-size: 18px;
		color: #555;
		transition: color 0.3s;
	}

	.premium-navbar .navbar-nav>li>a:hover i {
		color: #ff416c;
	}

	/* Login Button Hover */
	/* Login Button Hover */
	.premium-navbar .navbar-nav>li>a[href="login.php"]:hover {
		background: #333 !important;
		transform: scale(1.08) !important;
		/* Slightly stronger pop */
		box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25) !important;
		color: #fff !important;
	}

	/* Remove any decorative lines (red line) from the button */
	.premium-navbar .navbar-nav>li>a[href="login.php"]:after,
	.premium-navbar .navbar-nav>li>a[href="login.php"]:before {
		display: none !important;
		content: none !important;
		width: 0 !important;
		height: 0 !important;
		opacity: 0 !important;
	}

	.premium-navbar .navbar-menu {
		flex-grow: 0;
		margin-left: 20px;
	}
</style>