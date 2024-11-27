<?php
require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Wings Cafe</title>

<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="style.css" rel="stylesheet" type="text/css" />

<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : 'src/loading.gif',
        closeImage   : 'src/closelabel.png'
      });
    });
</script>

<script type="text/javascript">
function validateForm() {
  var a = document.forms["abcd"]["num"].value;
  if ((a == null || a == "")) {
    alert("You must enter your student #");
    return false;
  }

  if (document.abcd.checkbox.checked == false) {
    alert('Please agree to the terms and conditions of this company');
    return false;
  } else {
    return true;
  }
}
</script>

</head>
<body>
<div id="container">
  <div id="header_section">
    <div style="float:right; margin-right:30px;">
      <?php 
      include('connection.php');
      $id=$_SESSION['SESS_MEMBER_ID'];
      $resulta = $bd->query("SELECT * FROM members WHERE id = '$id'");
      while($row = $resulta->fetch_assoc()) {
          echo $row['name'] .' '. $row['surname'];
      }
      ?>&nbsp;<a href="logout.php" id="logout-button">Logout</a>
    </div> 
  </div>
  <div id="menu_bg">
    <div id="menu">
      <ul>
        <div style="float:left">
          <input name="time" type="text" id="txt" style="border: 0px none; font-size: 25px; margin-top: -5px; height: 23px; width: 130px; background-color:#000000; color:#FF0000; font-stretch:wider" readonly/>
        </div> 
      </ul>
    </div>
  </div>
  <div id="header"> </div>
  <div id="content">
    <div id="content_left">
      <div class="text">Select From Menu Below</div>
      
      <!-- Search Bar -->
      <form method="post" action="" style="margin-bottom: 20px;">
        <input type="text" name="search_query" placeholder="Search products..." style="width: 200px; padding: 5px;" />
        <input type="submit" name="search" value="Search" />
      </form>

      <div class="view1">
        <?php
        include('connection.php');

        if (isset($_POST['search']) && !empty($_POST['search_query'])) {
          $search_query = $bd->real_escape_string($_POST['search_query']);
          $result2 = $bd->query("SELECT * FROM products WHERE name LIKE '%$search_query%'");
        } else {
          $result2 = $bd->query("SELECT * FROM products");
        }

        while($row2 = $result2->fetch_assoc()) {
          $id = $row2['id'];
          $result3 = $bd->query("SELECT * FROM products WHERE product_id='$id'");
          $row3 = $result3->fetch_assoc();
          echo '<div class="box">';
          echo '<a rel="facebox" href="portal.php?id=' . $row3["product_id"] . '">';
          echo '<img src="images/bgr/' . $row3['product_photo'] . '" width="75px" height="75px" /></a>';
          echo '<div class="textbox">' . $row3['name'] . '</div>';
          echo '</div>';
        }
        ?>
      </div>
    </div>

    <div id="content_right">
      <form method="post" action="confirm.php" name="abcd" onsubmit="return validateForm()">
        <input name="id" type="hidden" value="<?php echo $_SESSION['SESS_MEMBER_ID']; ?>" />
        <input name="transactioncode" type="hidden" value="<?php echo $_SESSION['SESS_FIRST_NAME']; ?>" />
        <h2>Order Details</h2>
        <table width="335" border="1" cellpadding="0" cellspacing="0" style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:10px;">
          <tr>
            <td width="90"><div align="center"><strong>Product Name </strong></div></td>
            <td width="27"><div align="center"><strong>Qty</strong></div></td>
            <td width="45"><div align="center"><strong>Price</strong></div></td>
            <td width="46"><div align="center"><strong>Total</strong></div></td>
            <td width="29"><div align="center"><strong>Delete</strong></div></td>
          </tr>
          <?php
          include('connection.php');
          $memid = $_SESSION['SESS_FIRST_NAME'];
          $resulta = $bd->query("SELECT * FROM orderditems WHERE transactioncode = '$memid'");
          while($row = $resulta->fetch_assoc()) {
            echo '<tr>';
            echo '<td><div align="center">'.$row['name'].'</div></td>';
            echo '<td><div align="center">'.$row['quantity'].'</div></td>';
            echo '<td><div align="center">'.$row['price'].'</div></td>';
            echo '<td><div align="center">'.$row['total'].'</div></td>';
            echo '<td><div align="center"><a href=deleteorder.php?id=' . $row["id"] . '>Cancel</a></div></td>';
            echo '</tr>';
          }
          ?>
          <tr>
            <td colspan="4"><div align="right">Total Price: </div></td>
            <td colspan="2"><div align="left">
            <?php
            $result = $bd->query("SELECT sum(total) FROM orderditems WHERE transactioncode = '$memid'");
            while($rows = $result->fetch_assoc()) {
              echo '<input name="total" type="text" size="10" value="'.$rows['sum(total)'].'"/>'; 
            }
            ?>
            </div></td>
          </tr>
        </table>
        <p>&nbsp;</p>
        <p><br /></p>
        <table width="273" border="0" cellpadding="0" cellspacing="0" style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:10px;">
          <tr>
            <td colspan="2">
              <label>
                <input type="checkbox" name="checkbox" value="checkbox" />
                I Agree to the <a rel="facebox" href="terms.php">Terms and Conditions</a> of this company
              </label>
            </td>
          </tr>
        </table><br />
        <input name="" type="submit" value="Confirm Order" />
      </form>
    </div>
    <div id="card"></div>
  </div>
  <div id="container_end"></div> 
</div>
<div id="footer">
  <div class="middle">Copyright © Wings Cafe 2024</div>
  <div class="button"></div>
</div>
</body>
</html>
