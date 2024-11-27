<?php
//Start session
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Wings Cafe</title>
<!--sa poip up-->
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

// Password Strength Checker
function checkPasswordStrength(password) {
    const strengthIndicator = document.getElementById("password-strength");
    let strength = "";
    let color = "";

    if (password.length < 6) {
        strength = "Too short";
        color = "red";
    } else if (password.match(/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])/)) {
        strength = "Strong";
        color = "green";
    } else if (password.match(/(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])/) || 
               password.match(/(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])/)) {
        strength = "Medium";
        color = "orange";
    } else {
        strength = "Weak";
        color = "red";
    }

    strengthIndicator.textContent = strength;
    strengthIndicator.style.color = color;
}

// Validate Form
function validateForm() {
    var a = document.forms["abc"]["name"].value;
    var b = document.forms["abc"]["surname"].value;
    var d = document.forms["abc"]["email"].value;
    var e = document.forms["abc"]["password"].value;
    var f = document.forms["abc"]["ambot"].value;
    var g = document.forms["abc"]["contacts"].value;

    if ((a == null || a == "")) {
        alert("You must enter your first name");
        return false;
    }
    if ((b == null || b == "")) {
        alert("You must enter your last name");
        return false;
    }
    if ((d == null || d == "")) {
        alert("You must enter your email address");
        return false;
    }
    if ((e == null || e == "")) {
        alert("You must enter your password");
        return false;
    }
    if ((f == null || f == "")) {
        alert("You must retype your password");
        return false;
    }
    if ((g == null || g == "")) {
        alert("You must enter your contact number");
        return false;
    }

    if (e != f) {
        alert("Passwords do not match");
        return false;
    }

    var atpos = d.indexOf("@");
    var dotpos = d.lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= d.length) {
        alert("Not a valid email address");
        return false;
    }
}

$(document).ready(function() {
    // Restrict contact input to numbers only
    $("#contacts").keypress(function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            $("#errmsg").html("Number Only").show().fadeOut("slow");
            return false;
        }
    });
});
</script>
</head>

<body>
<div id="container">
  <div id="header_section"> 
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
  <div id="menu_bg">
    <div id="menu">
      <ul>
        <li><a href="index.php"  class="current">Home</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="loginindex.php">Order Now!</a></li>
        <li><a href="admin_index.php">Admin</a></li>
      </ul>
    </div>
  </div>
  <div id="content">
    <div style="width:400px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4); margin-top:20px; color:#000000;">
      <form id="form1" name="abc" method="post" action="addmem.php" onsubmit="return validateForm()">
        <div style="font-family:Arial, Helvetica, sans-serif; color:#000000; padding:5px; height:22px; width:390px;">
          <div style="float:left;"><strong>Members Registration of Wings Cafe</strong></div>
        </div>
        <table width="368" align="center">
          <tr>
            <td colspan="2">
              <div style="font-family:Arial, Helvetica, sans-serif; color:#FF0000; font-size:12px;">
                <?php
                if (isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0) {
                    echo '<ul class="err">';
                    foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
                        echo '<li>', $msg, '</li>';
                    }
                    echo '</ul>';
                    unset($_SESSION['ERRMSG_ARR']);
                }
                ?>
              </div>
            </td>
          </tr>
          <tr>
            <td width="120" valign="top"><div align="right">Firstname:</div></td>
            <td width="236"><input type="text" name="name"></td>
          </tr>
          <tr>
            <td valign="top"><div align="right">Lastname:</div></td>
            <td><input type="text" name="surname"></td>
          </tr>
          <tr>
            <td valign="top"><div align="right">Email:</div></td>
            <td><input type="text" name="email"></td>
          </tr>
          <tr>
            <td valign="top"><div align="right">Password:</div></td>
            <td>
              <input type="password" name="password" id="password" onkeyup="checkPasswordStrength(this.value)">
              <div id="password-strength" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#FF0000;"></div>
            </td>
          </tr>
          <tr>
            <td valign="top"><div align="right">Retype Password:</div></td>
            <td><input type="password" name="ambot"></td>
          </tr>
          <tr>
            <td valign="top"><div align="right">Contact Number:</div></td>
            <td>
              <input name="contacts" type="text" id="contacts" size="18">
              <span style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FF0000; font-weight:bold;" id="errmsg"></span>
            </td>
          </tr>
          <tr>
            <td valign="top">&nbsp;</td>
            <td>
              <input type="submit" value="Save">
              <input type="reset" name="Reset" value="Clear">
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  <div id="footer">
    <div class="top"></div>
    <div class="middle">Copyright © Wings Cafe 2024</div>
    <div class="button"></div>
  </div>
</div>
</body>
</html>
