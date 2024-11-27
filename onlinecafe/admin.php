<?php
session_start();

include("connection.php");

if (isset($_POST['email']) && isset($_POST['password'])) {
    $id = $_POST['email'];
    $password = $_POST['password'];
    $id = mysqli_real_escape_string($bd, $id);
    $password = mysqli_real_escape_string($bd, $password);

    $sql = "select * from users where email = '$id' and password = '$password'";
    $result = mysqli_query($bd, $sql);
    $count = mysqli_num_rows($result);
    if($count ==1){
        session_regenerate_id();
        $member = mysqli_fetch_assoc($result);
        $_SESSION['SESS_MEMBER_ID'] = $member['id'];
        $_SESSION['SESS_FIRST_NAME'] = $member['username'];
        session_write_close();
        header("location:home_admin.php");
    }
    else{
        echo "<h4 style='color:red;'>";
        echo "Please enter your correct login details!!!";
        echo "</h4>";
    }
} else {
    echo "<h4 style='color:red;'>";
    echo "Please enter your correct login details!!!";
    echo "</h4>";
}
?>
