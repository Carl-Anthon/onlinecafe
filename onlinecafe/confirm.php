<?php 
require_once('auth.php');
?>
<form method="post" action="">
<?php
$total = $_POST['total'];
$transactioncode = $_POST['transactioncode'];
?>
<input name="transactioncode" type="hidden" value="<?php echo $transactioncode; ?>" />
<input name="total" type="hidden" value="<?php echo $total; ?>" />
</form>
<?php
include('connection.php');
$total = $_POST['total'];
$transactiondate = date("m/d/Y");
$transactioncode = $_POST['transactioncode'];	

$stmt = $bd->prepare("INSERT INTO wings_orders (total, transactiondate, transactioncode) VALUES(?, ?, ?)");
$stmt->bind_param("sss", $total, $transactiondate, $transactioncode);
$stmt->execute();

// Redirect to the home page after the order is confirmed
header("Location: contact.php"); // Replace 'index.php' with the actual home page URL
exit();
?>
