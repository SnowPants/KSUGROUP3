<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "shit";
$db_name = "login";

try {
    // Create a PDO connection to the MySQL database
    $db = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // If connection is successful, no need to output any message
} catch(PDOException $e) {
    // If an error occurs during database connection, catch the exception and log the error message
    error_log("Database connection failed: " . $e->getMessage(), 0);
    die("Connection failed: Please check database configuration");
}
?>
