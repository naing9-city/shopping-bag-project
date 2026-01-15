<?php
session_start();
error_reporting(0);
include('includes/config.php');
// Redirect logic removed to allow inline login

if (isset($_POST['update'])) {
	$name = $_POST['name'];
	$contactno = $_POST['contactno'];
	$query = mysqli_query($con, "update users set name='$name',contactno='$contactno' where id='" . $_SESSION['id'] . "'");
	if ($query) {
		echo "<script>alert('Your info has been updated');</script>";
	}

	// Image Upload Logic
	if (!empty($_FILES["userImage"]["name"])) {
		$imgFile = $_FILES['userImage']['name'];
		$tmp_dir = $_FILES['userImage']['tmp_name'];
		$imgSize = $_FILES['userImage']['size'];
		$upload_dir = 'assets/images/users/'; // upload directory

		$imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
		$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		$userimage = rand(1000, 1000000) . "." . $imgExt;

		if (in_array($imgExt, $valid_extensions)) {
			if ($imgSize < 5000000) {
				move_uploaded_file($tmp_dir, $upload_dir . $userimage);
				$sql = "update users set userImage='$userimage' where id='" . $_SESSION['id'] . "'";
				if (mysqli_query($con, $sql)) {
					echo "<script>alert('Profile Image updated successfully');</script>";
				}
			} else {
				echo "<script>alert('Sorry, your file is too large.');</script>";
			}
		} else {
			echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
		}
	}
}


date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date('d-m-Y h:i:s A', time());


if (isset($_POST['submit'])) {
	$sql = mysqli_query($con, "SELECT password FROM  users where password='" . md5($_POST['cpass']) . "' && id='" . $_SESSION['id'] . "'");
	$num = mysqli_fetch_array($sql);
	if ($num > 0) {
		$con = mysqli_query($con, "update students set password='" . md5($_POST['newpass']) . "', updationDate='$currentTime' where id='" . $_SESSION['id'] . "'");
		echo "<script>alert('Password Changed Successfully !!');</script>";
	} else {
		echo "<script>alert('Current Password not match !!');</script>";
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

	<title>My Account</title>

	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Customizable CSS -->
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
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="assets/images/favicon.ico">
	<script type="text/javascript">
		function valid() {
			if (document.chngpwd.cpass.value == "") {
				alert("Current Password Filed is Empty !!");
				document.chngpwd.cpass.focus();
				return false;
			}
			else if (document.chngpwd.newpass.value == "") {
				alert("New Password Filed is Empty !!");
				document.chngpwd.newpass.focus();
				return false;
			}
			else if (document.chngpwd.cnfpass.value == "") {
				alert("Confirm Password Filed is Empty !!");
				document.chngpwd.cnfpass.focus();
				return false;
			}
			else if (document.chngpwd.newpass.value != document.chngpwd.cnfpass.value) {
				alert("Password and Confirm Password Field do not match  !!");
				document.chngpwd.cnfpass.focus();
				return false;
			}
			return true;
		}
	</script>

	<style>
		/* Premium Animation Only Styling */
		.panel-group .panel {
			/* border-radius: 12px; REMOVED static radius */
			/* border: none; REMOVED border override */
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
			/* Soft initial shadow kept for lift effect base */
			/* margin-bottom: 20px; REMOVED margin change */
			transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
			/* Smooth easing KEPT */
			/* overflow: hidden; */
		}

		.panel-group .panel:hover {
			box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
			/* Elevated shadow on hover KEPT */
			transform: translateY(-3px);
			/* Slight lift KEPT */
			z-index: 10;
			/* Ensure it floats above */
		}

		/* Reverted panel header styling to default (removed white bg/padding overrides) */

		/* Reverted badge/title styling to default */

		/* Sidebar Animation Only */
		.checkout-progress-sidebar .panel-group .panel {
			/* border-radius: 12px; REMOVED */
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
			transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
			/* Ensure sidebar animates too */
		}

		.checkout-progress-sidebar .panel-group .panel:hover {
			box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
			transform: translateY(-3px);
		}

		/* Reverted sidebar header/link styling */

		.nav-checkout-progress li a {
			transition: all 0.2s;
			/* Keep smooth transition for links */
		}

		.nav-checkout-progress li a:hover {
			padding-left: 5px;
			/* Keep slight slide effect */
		}
	</style>

</head>

<body class="cnt-home">
	<header class="header-style-1">

		<!-- ============================================== TOP MENU ============================================== -->
		<?php include('includes/top-header.php'); ?>
		<!-- ============================================== TOP MENU : END ============================================== -->
		<?php include('includes/main-header.php'); ?>
		<!-- ============================================== NAVBAR ============================================== -->
		<?php include('includes/menu-bar.php'); ?>
		<!-- ============================================== NAVBAR : END ============================================== -->

	</header>
	<!-- ============================================== HEADER : END ============================================== -->
	<div class="breadcrumb">
		<div class="container">
			<div class="breadcrumb-inner">
				<ul class="list-inline list-unstyled">
					<li><a href="#">Home</a></li>
					<li class='active'>Checkout</li>
				</ul>
			</div><!-- /.breadcrumb-inner -->
		</div><!-- /.container -->
	</div><!-- /.breadcrumb -->

	<div class="body-content outer-top-bd">
		<div class="container">
			<div class="checkout-box inner-bottom-sm">
				<div class="row">
					<div class="col-md-12">
						<?php if (strlen($_SESSION['login']) == 0) { ?>
							<div class="sign-in-page">
								<div class="row">
									<!-- Sign-in -->
									<div class="col-md-6 col-sm-6 sign-in">
										<h4 class="">Sign in</h4>
										<p class="">Hello, Welcome to your account.</p>
										<form class="register-form outer-top-xs" method="post" action="login.php">
											<span style="color:red;">
												<?php
												echo htmlentities($_SESSION['errmsg']);
												?>
												<?php
												echo htmlentities($_SESSION['errmsg'] = "");
												?>
											</span>
											<div class="form-group">
												<label class="info-title" for="exampleInputEmail1">Email Address
													<span>*</span></label>
												<input type="email" name="email"
													class="form-control unicase-form-control text-input"
													id="exampleInputEmail1">
											</div>
											<div class="form-group">
												<label class="info-title" for="exampleInputPassword1">Password
													<span>*</span></label>
												<input type="password" name="password"
													class="form-control unicase-form-control text-input"
													id="exampleInputPassword1">
											</div>
											<div class="radio outer-xs">
												<a href="forgot-password.php" class="forgot-password pull-right">Forgot your
													Password?</a>
											</div>
											<button type="submit" class="btn-upper btn btn-primary checkout-page-button"
												name="login">Login</button>
										</form>
									</div>
									<!-- Sign-in -->

									<!-- create a new account -->
									<div class="col-md-6 col-sm-6 create-new-account">
										<h4 class="checkout-subtitle">Create a new account</h4>
										<p class="text title-tag-line">Create your own Shopping account.</p>
										<form class="register-form outer-top-xs" role="form" method="post"
											action="login.php" name="register" onSubmit="return valid();">
											<!-- Note: Action points to login.php which handles registration too? login.php processes reg if 'submit' is set -->
											<div class="form-group">
												<label class="info-title" for="fullname">Full Name <span>*</span></label>
												<input type="text" class="form-control unicase-form-control text-input"
													id="fullname" name="fullname" required="required">
											</div>
											<div class="form-group">
												<label class="info-title" for="exampleInputEmail2">Email Address
													<span>*</span></label>
												<input type="email" class="form-control unicase-form-control text-input"
													id="email" onBlur="userAvailability()" name="emailid" required>
												<span id="user-availability-status1" style="font-size:12px;"></span>
											</div>
											<div class="form-group">
												<label class="info-title" for="contactno">Contact No. <span>*</span></label>
												<input type="text" class="form-control unicase-form-control text-input"
													id="contactno" name="contactno" maxlength="10" required>
											</div>
											<div class="form-group">
												<label class="info-title" for="password">Password. <span>*</span></label>
												<input type="password" class="form-control unicase-form-control text-input"
													id="password" name="password" required>
											</div>
											<div class="form-group">
												<label class="info-title" for="confirmpassword">Confirm Password.
													<span>*</span></label>
												<input type="password" class="form-control unicase-form-control text-input"
													id="confirmpassword" name="confirmpassword" required>
											</div>
											<button type="submit" name="submit"
												class="btn-upper btn btn-primary checkout-page-button" id="submit">Sign
												Up</button>
										</form>
									</div>
									<!-- create a new account -->
								</div><!-- /.row -->
							</div>
						<?php } else { ?>

							<div class="panel-group checkout-steps" id="accordion">
								<!-- checkout-step-01  -->
								<div class="panel panel-default checkout-step-01">

									<!-- panel-heading -->
									<div class="panel-heading">
										<h4 class="unicase-checkout-title">
											<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
												<span>1</span>My Profile
											</a>
										</h4>
									</div>
									<!-- panel-heading -->

									<div id="collapseOne" class="panel-collapse collapse in">

										<!-- panel-body  -->
										<div class="panel-body">
											<div class="row">
												<h4>Personal info</h4>
												<div class="col-md-12 col-sm-12 already-registered-login">

													<?php
													$query = mysqli_query($con, "select * from users where id='" . $_SESSION['id'] . "'");
													while ($row = mysqli_fetch_array($query)) {
														?>

														<form class="register-form" role="form" method="post"
															enctype="multipart/form-data">

															<!-- Profile Image Section -->
															<div class="form-group text-center"
																style="margin-bottom: 30px; position: relative;">
																<div
																	style="width: 150px; height: 150px; margin: 0 auto; position: relative; border-radius: 50%; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: 4px solid #fff;">
																	<?php
																	$userphoto = $row['userImage'];
																	if ($userphoto == ""):
																		?>
																		<img src="assets/images/no-image.png" class=""
																			alt="User Image"
																			style="width: 100%; height: 100%; object-fit: cover;">
																	<?php else: ?>
																		<img src="assets/images/users/<?php echo htmlentities($userphoto); ?>"
																			class="" alt="User Image"
																			style="width: 100%; height: 100%; object-fit: cover;">
																	<?php endif; ?>
																</div>
																<div style="margin-top: 15px;">
																	<label for="userImage" class="btn btn-sm btn-primary"
																		style="cursor: pointer;">
																		<i class="fa fa-camera"></i> Change Photo
																	</label>
																	<input type="file" name="userImage" id="userImage"
																		style="display: none;" onchange="this.form.submit()">
																</div>
															</div>

															<div class="form-group">
																<label class="info-title" for="name">Name<span>*</span></label>
																<input type="text"
																	class="form-control unicase-form-control text-input"
																	value="<?php echo $row['name']; ?>" id="name" name="name"
																	required="required">
															</div>

															<div class="form-group">
																<label class="info-title" for="exampleInputEmail1">Email Address
																	<span>*</span></label>
																<input type="email"
																	class="form-control unicase-form-control text-input"
																	id="exampleInputEmail1" value="<?php echo $row['email']; ?>"
																	readonly>
															</div>
															<div class="form-group">
																<label class="info-title" for="Contact No.">Contact No.
																	<span>*</span></label>
																<input type="text"
																	class="form-control unicase-form-control text-input"
																	id="contactno" name="contactno" required="required"
																	value="<?php echo $row['contactno']; ?>" maxlength="10">
															</div>
															<button type="submit" name="update"
																class="btn-upper btn btn-primary checkout-page-button">Update
																Info</button>
														</form>
													<?php } ?>
												</div>
												<!-- already-registered-login -->

											</div>
										</div>
										<!-- panel-body  -->

									</div><!-- row -->
								</div>
								<!-- checkout-step-01  -->
								<!-- checkout-step-02  -->
								<div class="panel panel-default checkout-step-02">
									<div class="panel-heading">
										<h4 class="unicase-checkout-title">
											<a data-toggle="collapse" class="collapsed" data-parent="#accordion"
												href="#collapseTwo">
												<span>2</span>Change Password
											</a>
										</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
										<div class="panel-body">

											<form class="register-form" role="form" method="post" name="chngpwd"
												onSubmit="return valid();">
												<div class="form-group">
													<label class="info-title" for="Current Password">Current
														Password<span>*</span></label>
													<input type="password"
														class="form-control unicase-form-control text-input" id="cpass"
														name="cpass" required="required">
												</div>



												<div class="form-group">
													<label class="info-title" for="New Password">New Password
														<span>*</span></label>
													<input type="password"
														class="form-control unicase-form-control text-input" id="newpass"
														name="newpass">
												</div>
												<div class="form-group">
													<label class="info-title" for="Confirm Password">Confirm Password
														<span>*</span></label>
													<input type="password"
														class="form-control unicase-form-control text-input" id="cnfpass"
														name="cnfpass" required="required">
												</div>
												<button type="submit" name="submit"
													class="btn-upper btn btn-primary checkout-page-button">Change </button>
											</form>




										</div>
									</div>
								</div>
								<!-- checkout-step-02  -->

							</div><!-- /.checkout-steps -->
						</div>
						<?php include('includes/myaccount-sidebar.php'); ?>
					<?php } ?> <!-- End else (logged in) -->
				</div><!-- /.row -->
			</div><!-- /.checkout-box -->
			<?php include('includes/brands-slider.php'); ?>

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
</body>

</html>