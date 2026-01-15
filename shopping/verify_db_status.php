<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($con, "SHOW TABLES LIKE 'products'");
if (mysqli_num_rows($result) > 0) {
    echo "Table 'products' exists.\n";
    $count = mysqli_query($con, "SELECT count(*) as total FROM products");
    $data = mysqli_fetch_assoc($count);
    echo "Total products: " . $data['total'] . "\n";
} else {
    echo "Table 'products' does NOT exist.\n";
}

$tables = mysqli_query($con, "SHOW TABLES");
echo "Tables in DB:\n";
while ($row = mysqli_fetch_array($tables)) {
    echo $row[0] . "\n";
}
?>