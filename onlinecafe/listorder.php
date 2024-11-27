<?php
if (isset($_GET['id'])) {
    include('connection.php');
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM orderditems WHERE transactioncode = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td><div align="left">    ' . $row['name'] . '    ' . '</div></td>';
        echo '<td>' . 'M' . $row['price'] . '.00' . '</td>';
        echo '<td>' . $row['quantity'] . '</td>';
        echo '</tr>';
    }
}
?>
<br>
<?php
if (isset($_GET['id'])) {
    include('connection.php');
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM orderditems WHERE transactioncode = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $var = $row['customer'];
    $stmt2 = $conn->prepare("SELECT * FROM members WHERE id = ?");
    $stmt2->bind_param("s", $var);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $row2 = $result2->fetch_assoc();
}
?>
<br>
