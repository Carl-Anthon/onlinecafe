<?php
session_start();

include('connection.php');
$memid=$_POST['id'];
$qty=$_POST['quantity'];
$name=$_POST['name'];
$transcode=$_POST['transcode'];
$id = isset($_POST['butadd']) ? $_POST['butadd'] : null;

//$ids=$_POST['ids'];

			$pprice = (int)$_REQUEST['price'];
			$pn = $_REQUEST['name'];
  $total= $pprice * $qty;
 
  $stmt = $bd->prepare("INSERT INTO orderditems (customer, quantity, price, total, name, transactioncode) VALUES(?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("iidiss", $memid, $qty, $pprice, $total, $pn, $transcode);
  $stmt->execute();
  header("location: order.php");












?> 