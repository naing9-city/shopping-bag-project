<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['submit'])) {
		$category = $_POST['category'];
		$subcat = $_POST['subcategory'];
		$productname = $_POST['productName'];
		$productcompany = $_POST['productCompany'];
		$productprice = $_POST['productprice'];
		$productpricebd = $_POST['productpricebd'];
		$productdescription = $_POST['productDescription'];
		$productscharge = $_POST['productShippingcharge'];
		$productavailability = $_POST['productAvailability'];
		$productimage1 = $_FILES["productimage1"]["name"];
		$productimage2 = $_FILES["productimage2"]["name"];
		$productimage3 = $_FILES["productimage3"]["name"];
		//for getting product id
		$query = mysqli_query($con, "select max(id) as pid from products");
		$result = mysqli_fetch_array($query);
		$productid = $result['pid'] + 1;
		$dir = "productimages/$productid";
		if (!is_dir($dir)) {
			mkdir("productimages/" . $productid);
		}

		move_uploaded_file($_FILES["productimage1"]["tmp_name"], "productimages/$productid/" . $_FILES["productimage1"]["name"]);
		move_uploaded_file($_FILES["productimage2"]["tmp_name"], "productimages/$productid/" . $_FILES["productimage2"]["name"]);
		move_uploaded_file($_FILES["productimage3"]["tmp_name"], "productimages/$productid/" . $_FILES["productimage3"]["name"]);
		$sql = mysqli_query($con, "insert into products(category,subCategory,productName,productCompany,productPrice,productDescription,shippingCharge,productAvailability,productImage1,productImage2,productImage3,productPriceBeforeDiscount) values('$category','$subcat','$productname','$productcompany','$productprice','$productdescription','$productscharge','$productavailability','$productimage1','$productimage2','$productimage3','$productpricebd')");
		$_SESSION['msg'] = "Product Inserted Successfully !!";

	}


	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin | Insert Product</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href="css/admin-premium.css" rel="stylesheet">
		<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
		<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
		<script>
			function getSubcat(val) {
				$.ajax({
					type: "POST",
					url: "get_subcat.php",
					data: 'cat_id=' + val,
					success: function (data) {
						$("#subcategory").html(data);
					}
				});
			}
			function selectCountry(val) {
				$("#search-box").val(val);
				$("#suggesstion-box").hide();
			}
		</script>
	</head>

	<body>
		<?php include('include/header.php'); ?>

		<div class="dashboard-wrapper">
			<?php include('include/sidebar.php'); ?>

			<div class="premium-content">
				<div class="premium-content-header">
					<h1 class="page-title">Insert Product</h1>
				</div>

				<div class="premium-card">
					<?php if (isset($_POST['submit'])) { ?>
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong>Well done!</strong>
							<?php echo htmlentities($_SESSION['msg']); ?>		<?php echo htmlentities($_SESSION['msg'] = ""); ?>
						</div>
					<?php } ?>

					<?php if (isset($_GET['del'])) { ?>
						<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong>Oh snap!</strong>
							<?php echo htmlentities($_SESSION['delmsg']); ?>		<?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
						</div>
					<?php } ?>

					<br />

					<form class="form-horizontal row-fluid" name="insertproduct" method="post"
						enctype="multipart/form-data">

						<div class="premium-form-group">
							<label class="premium-label" for="basicinput">Category</label>
							<div class="controls">
								<select name="category" class="premium-input span8 tip" onChange="getSubcat(this.value);"
									required>
									<option value="">Select Category</option>
									<?php $query = mysqli_query($con, "select * from category");
									while ($row = mysqli_fetch_array($query)) { ?>
										<option value="<?php echo $row['id']; ?>"><?php echo $row['categoryName']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="premium-form-group">
							<label class="premium-label" for="basicinput">Sub Category</label>
							<div class="controls">
								<select name="subcategory" id="subcategory" class="premium-input span8 tip" required>
								</select>
							</div>
						</div>

						<div class="premium-form-group">
							<label class="premium-label" for="basicinput">Product Name</label>
							<div class="controls">
								<input type="text" name="productName" placeholder="Enter Product Name"
									class="premium-input span8 tip" required>
							</div>
						</div>

						<div class="premium-form-group">
							<label class="premium-label" for="basicinput">Product Company</label>
							<div class="controls">
								<input type="text" name="productCompany" placeholder="Enter Product Comapny Name"
									class="premium-input span8 tip" required>
							</div>
						</div>

						<div class="premium-form-group">
							<label class="premium-label" for="basicinput">Product Price Before Discount</label>
							<div class="controls">
								<input type="text" name="productpricebd" placeholder="Enter Product Price"
									class="premium-input span8 tip" required>
							</div>
						</div>

						<div class="premium-form-group">
							<label class="premium-label" for="basicinput">Product Price After Discount(Selling
								Price)</label>
							<div class="controls">
								<input type="text" name="productprice" placeholder="Enter Product Price"
									class="premium-input span8 tip" required>
							</div>
						</div>

						<div class="premium-form-group">
							<label class="premium-label" for="basicinput">Product Description</label>
							<div class="controls">
								<textarea name="productDescription" placeholder="Enter Product Description" rows="6"
									class="premium-input span8 tip"></textarea>
							</div>
						</div>

						<div class="premium-form-group">
							<label class="premium-label" for="basicinput">Product Shipping Charge</label>
							<div class="controls">
								<input type="text" name="productShippingcharge" placeholder="Enter Product Shipping Charge"
									class="premium-input span8 tip" required>
							</div>
						</div>

						<div class="premium-form-group">
							<label class="premium-label" for="basicinput">Product Availability</label>
							<div class="controls">
								<select name="productAvailability" id="productAvailability" class="premium-input span8 tip"
									required>
									<option value="">Select</option>
									<option value="In Stock">In Stock</option>
									<option value="Out of Stock">Out of Stock</option>
								</select>
							</div>
						</div>

						<div class="premium-form-group">
							<label class="premium-label" for="basicinput">Product Image1</label>
							<div class="controls">
								<input type="file" name="productimage1" id="productimage1" value=""
									class="premium-input span8 tip" required>
							</div>
						</div>

						<div class="premium-form-group">
							<label class="premium-label" for="basicinput">Product Image2</label>
							<div class="controls">
								<input type="file" name="productimage2" class="premium-input span8 tip" required>
							</div>
						</div>

						<div class="premium-form-group">
							<label class="premium-label" for="basicinput">Product Image3</label>
							<div class="controls">
								<input type="file" name="productimage3" class="premium-input span8 tip">
							</div>
						</div>

						<div class="premium-form-group">
							<div class="controls">
								<button type="submit" name="submit" class="premium-submit-btn">Insert</button>
							</div>
						</div>
					</form>
				</div><!--/.premium-card-->

			</div><!--/.premium-content-->
		</div><!--/.dashboard-wrapper-->

		<?php include('include/footer.php'); ?>

		<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
		<script src="scripts/datatables/jquery.dataTables.js"></script>
		<script>
			$(document).ready(function () {
				$('.datatable-1').dataTable();
				$('.dataTables_paginate').addClass("btn-group datatable-pagination");
				$('.dataTables_paginate > a').wrapInner('<span />');
				$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
				$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
			});
		</script>
	</body>

	</html>
<?php } ?>