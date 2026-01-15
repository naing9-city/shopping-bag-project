<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	date_default_timezone_set('Asia/Kolkata');// change according timezone
	$currentTime = date('d-m-Y h:i:s A', time());


	if (isset($_POST['submit'])) {
		$sql = mysqli_query($con, "SELECT password FROM  admin where password='" . md5($_POST['password']) . "' && username='" . $_SESSION['alogin'] . "'");
		$num = mysqli_fetch_array($sql);
		if ($num > 0) {
			$con = mysqli_query($con, "update admin set password='" . md5($_POST['newpassword']) . "', updationDate='$currentTime' where username='" . $_SESSION['alogin'] . "'");
			$_SESSION['msg'] = "Password Changed Successfully !!";
		} else {
			$_SESSION['msg'] = "Old Password not match !!";
		}
	}
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin | Change Password</title>
		<!-- Bootstrap for grid fallback/utilities if needed, but we rely on premium CSS -->
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<!-- Premium Admin CSS -->
		<link type="text/css" href="css/admin-premium.css" rel="stylesheet">
		<script type="text/javascript">
			function valid() {
				if (document.chngpwd.password.value == "") {
					alert("Current Password Filed is Empty !!");
					document.chngpwd.password.focus();
					return false;
				}
				else if (document.chngpwd.newpassword.value == "") {
					alert("New Password Filed is Empty !!");
					document.chngpwd.newpassword.focus();
					return false;
				}
				else if (document.chngpwd.confirmpassword.value == "") {
					alert("Confirm Password Filed is Empty !!");
					document.chngpwd.confirmpassword.focus();
					return false;
				}
				else if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
					alert("Password and Confirm Password Field do not match  !!");
					document.chngpwd.confirmpassword.focus();
					return false;
				}
				return true;
			}
		</script>
	</head>

	<body>
		<?php include('include/header.php'); ?>

		<div class="dashboard-wrapper">
			<?php include('include/sidebar.php'); ?>

			<div class="premium-content">
				<div class="premium-content-header">
					<h1 class="page-title">Change Password</h1>
				</div>

				<div class="premium-card">
					<?php if (isset($_POST['submit'])) { ?>
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<?php echo htmlentities($_SESSION['msg']); ?>		<?php echo htmlentities($_SESSION['msg'] = ""); ?>
						</div>
					<?php } ?>

					<form class="premium-form" name="chngpwd" method="post" onSubmit="return valid();">
						<div class="premium-form-group">
							<label class="premium-label" for="basicinput">Current Password</label>
							<input type="password" placeholder="Enter your current Password" name="password"
								class="premium-input" required>
						</div>

						<div class="premium-form-group">
							<label class="premium-label" for="basicinput">New Password</label>
							<input type="password" placeholder="Enter your new Password" name="newpassword"
								class="premium-input" required>
						</div>

						<div class="premium-form-group">
							<label class="premium-label" for="basicinput">Confirm New Password</label>
							<input type="password" placeholder="Enter your new Password again" name="confirmpassword"
								class="premium-input" required>
						</div>

						<div class="premium-form-group">
							<button type="submit" name="submit" class="premium-submit-btn">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<?php include('include/footer.php'); ?>

		<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	</body>

	</html>
<?php } ?>