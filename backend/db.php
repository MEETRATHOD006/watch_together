<?php
$host = "192.168.1.4";
$user = "root";
$password = "8594";
$dbname = "watch_together";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Origin: *");  // Or specify a specific domain instead of *
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
error_reporting(0); // Disable error reporting
ini_set('display_errors', 0); // Prevent errors from being displayed


// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
