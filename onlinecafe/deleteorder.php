<?php
if (isset($_GET['id'])) {
    include('connection.php');
    
    $id = $_GET['id'];
    // Assuming $conn is your mysqli connection variable from 'connection.php'
    $stmt = $bd->prepare("DELETE FROM orderditems WHERE id = ?");
    $stmt->bind_param("i", $id); // 'i' denotes the variable type is integer
    $stmt->execute();
    
    header("location: order.php");
    exit();
}
?>
