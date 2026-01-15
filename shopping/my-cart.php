<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['submit'])) {
	if (!empty($_SESSION['cart'])) {
		foreach ($_POST['quantity'] as $key => $val) {
			if ($val == 0) {
				unset($_SESSION['cart'][$key]);
			} else {
				$_SESSION['cart'][$key]['quantity'] = $val;

			}
		}
		echo "<script>alert('Your Cart hasbeen Updated');</script>";
	}
}
// Code for Remove a Product from Cart
if (isset($_POST['remove_code'])) {

	if (!empty($_SESSION['cart'])) {
		foreach ($_POST['remove_code'] as $key) {

			unset($_SESSION['cart'][$key]);
		}
		echo "<script>alert('Your Cart has been Updated');</script>";
	}
}
// code for insert product in order table


if (isset($_POST['ordersubmit'])) {

	if (strlen($_SESSION['login']) == 0) {
		header('location:login.php');
	} else {

		$quantity = $_POST['quantity'];
		$pdd = $_SESSION['pid'];
		$value = array_combine($pdd, $quantity);


		foreach ($value as $qty => $val34) {



			mysqli_query($con, "insert into orders(userId,productId,quantity) values('" . $_SESSION['id'] . "','$qty','$val34')");
			header('location:payment-method.php');
		}
	}
}

// code for billing address updation
if (isset($_POST['update'])) {
	$baddress = $_POST['billingaddress'];
	$bstate = $_POST['bilingstate'];
	$bcity = $_POST['billingcity'];
	$bpincode = $_POST['billingpincode'];
	$query = mysqli_query($con, "update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',billingPincode='$bpincode' where id='" . $_SESSION['id'] . "'");
	if ($query) {
		echo "<script>alert('Billing Address has been updated');</script>";
	}
}


// code for Shipping address updation
if (isset($_POST['shipupdate'])) {
	$saddress = $_POST['shippingaddress'];
	$sstate = $_POST['shippingstate'];
	$scity = $_POST['shippingcity'];
	$spincode = $_POST['shippingpincode'];
	$query = mysqli_query($con, "update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='" . $_SESSION['id'] . "'");
	if ($query) {
		echo "<script>alert('Shipping Address has been updated');</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="MediaCenter, Template, eCommerce">
	<meta name="robots" content="all">

	<title>My Cart</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/red.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" href="assets/css/owl.transitions.css">
	<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
	<link href="assets/css/lightbox.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/rateit.css">
	<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

	<!-- Demo Purpose Only. Should be removed in production -->
	<link rel="stylesheet" href="assets/css/config.css">

	<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
	<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
	<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
	<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
	<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
	<!-- Demo Purpose Only. Should be removed in production : END -->


	<!-- Icons/Glyphs -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
	<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->


	<!-- Premium Login CSS (Shared for Cart) -->
	<link rel="stylesheet" href="assets/css/premium-login.css">

	<style>
		.address-form-card {
			background: #fff;
			padding: 30px;
			border-radius: 12px;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
			border: 1px solid rgba(0, 0, 0, 0.02);
			transition: all 0.3s ease;
		}

		.address-form-card:hover {
			box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2), 0 0 15px rgba(0, 0, 0, 0.1);
			transform: translateY(-2px);
			border-color: rgba(0, 0, 0, 0.2);
		}

		.address-form-card .section-title {
			margin-top: 0;
			margin-bottom: 25px;
			font-weight: 600;
			color: #333;
			font-size: 18px;
			border-bottom: 2px solid #f0f0f0;
			padding-bottom: 15px;
		}

		.address-form-card .form-control {
			border-radius: 6px;
			border: 1px solid #eee;
			padding: 12px;
			box-shadow: none;
			transition: all 0.3s ease;
		}

		.address-form-card .form-control:focus {
			border-color: #333;
			box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
		}

		.address-form-card .btn-primary {
			border-radius: 6px;
			height: 45px;
			font-weight: 600;
			font-size: 14px;
			letter-spacing: 0.5px;
			transition: all 0.3s ease;
			background-color: #333;
			border-color: #333;
		}
		
		.address-form-card .btn-primary:hover {
			background-color: #000;
			border-color: #000;
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
		}
	</style>

</head>

<body class="cnt-home premium-login-page">



	<!-- ============================================== HEADER ============================================== -->
	<header class="header-style-1">
		<?php include('includes/top-header.php'); ?>
		<?php include('includes/main-header.php'); ?>
		<?php include('includes/menu-bar.php'); ?>
	</header>
	<!-- ============================================== HEADER : END ============================================== -->
	<div class="breadcrumb">
		<div class="container">
			<div class="breadcrumb-inner">
				<ul class="list-inline list-unstyled">
					<li><a href="#">Home</a></li>
					<li class='active'>Shopping Cart</li>
				</ul>
			</div><!-- /.breadcrumb-inner -->
		</div><!-- /.container -->
	</div><!-- /.breadcrumb -->

	<div class="body-content outer-top-xs">
		<div class="container">
			<div class="row inner-bottom-sm">
				<div class="shopping-cart">
					<div class="col-md-12 col-sm-12 shopping-cart-table ">
						<div class="table-responsive">
							<form name="cart" method="post" action="my-cart.php">
								<?php
								if (!empty($_SESSION['cart'])) {
									?>
									<div class="shopping-cart-btn" style="margin-bottom: 20px;">
										<span class="">
											<a href="index.php" class="btn btn-upper btn-primary outer-left-xs">Continue
												Shopping</a>
											<input type="submit" name="submit" value="Update shopping cart"
												class="btn btn-upper btn-primary pull-right outer-right-xs">
										</span>
									</div><!-- /.shopping-cart-btn -->

									<table class="table table-bordered">
										<thead>
											<tr>
												<th class="cart-romove item">Remove</th>
												<th class="cart-description item">Image</th>
												<th class="cart-product-name item">Product Name</th>

												<th class="cart-qty item">Quantity</th>
												<th class="cart-sub-total item">Price Per unit</th>
												<th class="cart-sub-total item">Shipping Charge</th>
												<th class="cart-total last-item">Grandtotal</th>
											</tr>
										</thead><!-- /thead -->

										<tbody>
											<?php
											$pdtid = array();
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

													array_push($pdtid, $row['id']);
													//print_r($_SESSION['pid'])=$pdtid;exit;
													?>

													<tr>
														<td class="romove-item"><input type="checkbox" name="remove_code[]"
																value="<?php echo htmlentities($row['id']); ?>" /></td>
														<td class="cart-image">
															<a class="entry-thumbnail" href="detail.html">
																<img src="admin/productimages/<?php echo $row['id']; ?>/<?php echo $row['productImage1']; ?>"
																	alt="" width="114" height="146">
															</a>
														</td>
														<td class="cart-product-name-info">
															<h4 class='cart-product-description'><a
																	href="product-details.php?pid=<?php echo htmlentities($pd = $row['id']); ?>"><?php echo $row['productName'];

																		 $_SESSION['sid'] = $pd;
																		 ?></a></h4>
															<div class="row">
																<div class="col-sm-4">
																	<div class="rating rateit-small"></div>
																</div>
																<div class="col-sm-8">
																	<?php $rt = mysqli_query($con, "select * from productreviews where productId='$pd'");
																	$num = mysqli_num_rows($rt); {
																		?>
																		<div class="reviews">
																			( <?php echo htmlentities($num); ?> Reviews )
																		</div>
																	<?php } ?>
																</div>
															</div><!-- /.row -->

														</td>
														<td class="cart-product-quantity">
															<div class="quant-input">
																<div class="arrows">
																	<div class="arrow plus gradient"><span class="ir"><i
																				class="icon fa fa-sort-asc"></i></span></div>
																	<div class="arrow minus gradient"><span class="ir"><i
																				class="icon fa fa-sort-desc"></i></span></div>
																</div>
																<input type="text"
																	value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>"
																	name="quantity[<?php echo $row['id']; ?>]">

															</div>
														</td>
														<td class="cart-product-sub-total"><span
																class="cart-sub-total-price"><?php echo "MMK" . " " . $row['productPrice']; ?>.00</span>
														</td>
														<td class="cart-product-sub-total"><span
																class="cart-sub-total-price"><?php echo "MMK" . " " . $row['shippingCharge']; ?>.00</span>
														</td>

														<td class="cart-product-grand-total"><span
																class="cart-grand-total-price"><?php echo ($_SESSION['cart'][$row['id']]['quantity'] * $row['productPrice'] + $row['shippingCharge']); ?>.00</span>
														</td>
													</tr>

												<?php }
											}
											$_SESSION['pid'] = $pdtid;
											?>

										</tbody><!-- /tbody -->
									</table><!-- /table -->
							</div>

							<div class="col-md-4 col-sm-12 cart-shopping-total pull-right">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>

												<div class="cart-grand-total">
													Grand Total<span
														class="inner-left-md"><?php echo $_SESSION['tp'] = "$totalprice" . ".00"; ?></span>
												</div>
											</th>
										</tr>
									</thead><!-- /thead -->
									<tbody>
										<tr>
											<td>
												<div class="cart-checkout-btn pull-right">
													<button type="submit" name="ordersubmit" class="btn btn-primary">PROCCED
														TO
														CHEKOUT</button>

												</div>
											</td>
										</tr>
									</tbody><!-- /tbody -->
								</table>
							<?php } else {
									echo "Your shopping Cart is empty";
								} ?>
						</div>
					</div><!-- /.shopping-cart-table -->
					</form> <!-- Close Cart Form Here -->

					<div class="col-md-6 col-sm-12 estimate-ship-tax">
						<div class="checkout-box-2" style="background: transparent; padding: 0;">
							<?php
							if (strlen($_SESSION['login']) == 0) {
								echo '<div class="alert alert-info" role="alert" style="border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">Please <a href="login.php" class="alert-link">login</a> to update billing address.</div>';
							} else {
								$query = mysqli_query($con, "select * from users where id='" . $_SESSION['id'] . "'");
								while ($row = mysqli_fetch_array($query)) {
									?>
									<form method="post" class="address-form-card">
										<h4 class="section-title">Billing Address</h4>
										<div class="form-group">
											<label class="info-title" for="Billing Address"
												style="font-weight: 500; color: #666;">Address <span
													style="color:red">*</span></label>
											<textarea class="form-control unicase-form-control text-input" name="billingaddress"
												rows="3" required="required"
												style="resize: vertical;"><?php echo $row['billingAddress']; ?></textarea>
										</div>

										<div class="form-group">
											<label class="info-title" for="Billing State"
												style="font-weight: 500; color: #666;">State <span
													style="color:red">*</span></label>
											<input type="text" class="form-control unicase-form-control text-input"
												id="bilingstate" name="bilingstate" value="<?php echo $row['billingState']; ?>"
												required style="height: 45px; padding: 0 15px;">
										</div>
										<div class="form-group">
											<label class="info-title" for="Billing City"
												style="font-weight: 500; color: #666;">City <span
													style="color:red">*</span></label>
											<input type="text" class="form-control unicase-form-control text-input"
												id="billingcity" name="billingcity" required="required"
												value="<?php echo $row['billingCity']; ?>"
												style="height: 45px; padding: 0 15px;">
										</div>
										<div class="form-group">
											<label class="info-title" for="Billing Pincode"
												style="font-weight: 500; color: #666;">Pincode <span
													style="color:red">*</span></label>
											<input type="text" class="form-control unicase-form-control text-input"
												id="billingpincode" name="billingpincode" required="required"
												value="<?php echo $row['billingPincode']; ?>"
												style="height: 45px; padding: 0 15px;">
										</div>

										<button type="submit" name="update"
											class="btn-upper btn btn-primary checkout-page-button"
											style="width: 100%; margin-top: 20px;">Update
											Billing</button>
									</form>
								<?php }
							} ?>
						</div>
					</div>

					<div class="col-md-6 col-sm-12 estimate-ship-tax">
						<div class="checkout-box-2" style="background: transparent; padding: 0;">
							<?php
							if (strlen($_SESSION['login']) == 0) {
								echo '<div class="alert alert-info" role="alert" style="border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">Please <a href="login.php" class="alert-link">login</a> to update shipping address.</div>';
							} else {
								$query = mysqli_query($con, "select * from users where id='" . $_SESSION['id'] . "'");
								while ($row = mysqli_fetch_array($query)) {
									?>
									<form method="post" class="address-form-card">
										<h4 class="section-title">Shipping Address</h4>
										<div class="form-group">
											<label class="info-title" for="Shipping Address"
												style="font-weight: 500; color: #666;">Address <span
													style="color:red">*</span></label>
											<textarea class="form-control unicase-form-control text-input"
												name="shippingaddress" rows="3" required="required"
												style="resize: vertical;"><?php echo $row['shippingAddress']; ?></textarea>
										</div>

										<div class="form-group">
											<label class="info-title" for="Billing State"
												style="font-weight: 500; color: #666;">State <span
													style="color:red">*</span></label>
											<input type="text" class="form-control unicase-form-control text-input"
												id="shippingstate" name="shippingstate"
												value="<?php echo $row['shippingState']; ?>" required
												style="height: 45px; padding: 0 15px;">
										</div>
										<div class="form-group">
											<label class="info-title" for="Billing City"
												style="font-weight: 500; color: #666;">City <span
													style="color:red">*</span></label>
											<input type="text" class="form-control unicase-form-control text-input"
												id="shippingcity" name="shippingcity" required="required"
												value="<?php echo $row['shippingCity']; ?>"
												style="height: 45px; padding: 0 15px;">
										</div>
										<div class="form-group">
											<label class="info-title" for="Billing Pincode"
												style="font-weight: 500; color: #666;">Pincode <span
													style="color:red">*</span></label>
											<input type="text" class="form-control unicase-form-control text-input"
												id="shippingpincode" name="shippingpincode" required="required"
												value="<?php echo $row['shippingPincode']; ?>"
												style="height: 45px; padding: 0 15px;">
										</div>

										<button type="submit" name="shipupdate"
											class="btn-upper btn btn-primary checkout-page-button"
											style="width: 100%; margin-top: 20px;">Update
											Shipping</button>
									</form>
								<?php }
							} ?>
						</div>
					</div>
					<div class="clearfix"></div>
					<div style="margin-bottom: 50px;"></div>
				</div>
			</div>
		</div>
	</div>
	</div>

	<?php echo include('includes/brands-slider.php'); ?>
	</div>
	</div>
	<?php include('includes/footer.php'); ?>

	<script src="assets/js/jquery-1.11.1.min.js"></script>

	<script src="assets/js/bootstrap.min.js"></script>

	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>

	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
	<script src="assets/js/jquery.rateit.min.js"></script>
	<script type="text/javascript" src="assets/js/lightbox.min.js"></script>
	<script src="assets/js/bootstrap-select.min.js"></script>
	<script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.js"></script>

	<!-- For demo purposes – can be removed on production -->

	<script src="switchstylesheet/switchstylesheet.js"></script>

	<script>
		$(document).ready(function () {
			$(".changecolor").switchstylesheet({ seperator: "color" });
			$('.show-theme-options').click(function () {
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function () {
			$('.show-theme-options').delay(2000).trigger('click');
		});
	</script>
	<!-- For demo purposes – can be removed on production : End -->
</body>

</html>