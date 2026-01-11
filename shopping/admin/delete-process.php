<?php
include('include/config.php');
$sql = "DELETE FROM users WHERE id='" . $_GET["id"] . "'";
if (mysqli_query($con, $sql)) {
    echo'<script type="text/JavaScript">';
    echo 'alert("Record deleted successfully")';
    echo'</script>';
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
mysqli_close($con);
?>