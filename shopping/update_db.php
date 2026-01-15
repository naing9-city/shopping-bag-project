<?php
include('includes/config.php');
// Add userImage column if it doesn't exist
$sql = "SHOW COLUMNS FROM users LIKE 'userImage'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) == 0) {
    $alter = "ALTER TABLE users ADD userImage VARCHAR(255) AFTER contactno";
    if (mysqli_query($con, $alter)) {
        echo "Column userImage added successfully.";
    } else {
        echo "Error adding column: " . mysqli_error($con);
    }
} else {
    echo "Column userImage already exists.";
}

// Ensure directory exists
$target_dir = "assets/images/users/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
    echo "Directory created.";
}
?>