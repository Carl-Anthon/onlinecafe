<?php
// Database configuration settings
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "wings";
$prefix = ""; // If you have a table prefix, you can set it here

// Attempt to create a connection to the database
$bd = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

// Check if the connection was successful
if ($bd->connect_error) {
    die("Could not connect to the database: " . $bd->connect_error);
}

// Connection was successful
// You can now proceed with database operations

// Don't forget to close the connection when you're done
// $bd->close();
?>
