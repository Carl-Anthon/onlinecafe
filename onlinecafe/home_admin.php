<?php 
session_start();
include('connection.php');

if (isset($_POST['delete'])) {
    $id = intval($_POST['id']);
    $stmt = $bd->prepare("DELETE FROM orderditems WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            background: url('https://www.toptal.com/designers/subtlepatterns/patterns/grid.png'); /* Technology-themed background */
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #333;
        }
        #container {
            margin: 0 auto;
            width: 90%;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .admin-text {
            font-size: 38px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .delete-button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .delete-button:hover {
            background-color: #ff1a1a;
        }
    </style>
    
</head>

<body>
<div id="container">
    <div class="header">
        <div class="admin-text">
            <strong>Admin</strong>
        </div>
        <div class="logo">
          
        </div>
    </div>
    <table id="orderTable">
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php
        $stmt = $bd->prepare("SELECT * FROM orderditems");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['customer']) . '</td>';
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
            echo '<td>' . htmlspecialchars($row['price']) . '</td>';
            echo '<td>' . htmlspecialchars($row['total']) . '</td>';
            echo '<td>';
            echo '<form method="post" action="" style="display:inline-block;">';
            echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">';
            echo '<button type="submit" name="delete" class="delete-button">Delete</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>
</body>
</html>
