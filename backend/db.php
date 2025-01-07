<?php
$host = "dpg-ctukiatumphs73ep3pm0-a.oregon-postgres.render.com";
$user = "5432";
$password = "VsgM2ZrXMf8MONqLK2jCgACpXs8B3G9q";
$dbname = "watch_together";

// Set headers for CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Origin: *");  // Or specify a specific domain instead of *
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Disable error reporting for production environment
error_reporting(0); // Disable error reporting
ini_set('display_errors', 0); // Prevent errors from being displayed

// PostgreSQL connection string
$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

// Check the connection
if (!$conn) {
    die("Connection failed: " . pg_last_error());
} else {
    echo "Connected successfully to the database!";
}

?>
