<?php
include('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $bd->prepare("DELETE FROM orderditems WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
}

header("location:home_admin.php");

?>