<?php
session_start();

include('connection.php');

$name = $_POST['name'];
$surname = $_POST['surname'];
$contacts = $_POST['contacts'];
$password = $_POST['password'];
$email = $_POST['email'];

// Assuming $con is a mysqli connection object from 'connection.php'
$sql = "INSERT INTO members (name, surname, contacts, password, email) VALUES (?, ?, ?, ?, ?)";

$stmt = $bd->prepare($sql);
if ($stmt) {
    // Bind parameters to the prepared statement as strings 'ssssss'
    $stmt->bind_param('sssss', $name, $surname, $contacts, $password, $email);
    
    // Execute the prepared statement
    if ($stmt->execute()) {
        header("location: loginindex.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close the prepared statement
    $stmt->close();
} else {
    echo "Error: " . $bd->error;
}

// Close the database connection
$con->close();
?>
