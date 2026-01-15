<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$tables = [];
$result = mysqli_query($con, "SHOW TABLES");
while ($row = mysqli_fetch_array($result)) {
    $tables[] = $row[0];
}

echo "Found " . count($tables) . " tables in database.\n";

foreach ($tables as $table) {
    echo "Checking table '$table'... ";
    try {
        $check = mysqli_query($con, "SELECT 1 FROM `$table` LIMIT 1");
        if ($check) {
            echo "OK\n";
        } else {
            echo "FAILED (Query returned false)\n";
        }
    } catch (Throwable $e) {
        echo "ERROR: " . $e->getMessage() . "\n";
    }
}
?>