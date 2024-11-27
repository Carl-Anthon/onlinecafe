<?php
// Start session
session_start();

// Connect to mysql server
include('connection.php');

$errmsg_arr = array();

// Validation error flag
$errflag = false;

// Function to sanitize values received from the form. Prevents SQL injection
// Now, this function is not needed because we will use prepared statements

// Sanitize the POST values
function createRandomPassword() {
    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '';
    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}
$confirmation = createRandomPassword();

// Use mysqli_real_escape_string only if you are not using prepared statements
// $login = mysqli_real_escape_string($bd, $_POST['user']);
// $password = mysqli_real_escape_string($bd, $_POST['password']);

// Create prepared statement
$qry = "SELECT * FROM members WHERE email = ? AND password = ?";
$stmt = $bd->prepare($qry);

// Check if prepare was successful
if ($stmt === false) {
    die("Prepare failed: " . $bd->error);
}

// Bind parameters and execute
$stmt->bind_param('ss', $_POST['user'], $_POST['password']);
$result = $stmt->execute();

// Check whether the query was successful or not
if ($result) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Login Successful
        session_regenerate_id();
        $member = $result->fetch_assoc();
        $_SESSION['SESS_MEMBER_ID'] = $member['id'];
        $_SESSION['SESS_FIRST_NAME'] = $confirmation;
        
        session_write_close();
        header("location: order.php");
        exit();
    } else {
        // Login failed
        $errmsg_arr[] = 'Invalid Email add or password';
        $errflag = true;
    }
} else {
    die("Execute failed: " . $stmt->error);
}

// Check for any validation errors
if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: loginindex.php");
    exit();
}

// Close statement
$stmt->close();

// Close database connection
$bd->close();
?>
