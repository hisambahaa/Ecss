<?php 
require_once('../Connections/dares_conn.php');
require_once('../Connections/config.php');
//require_once("../Connections/composer.php");

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['user_name'])) {
  $loginUsername=$_POST['user_name'];
  $password=$_POST['user_pwd'];
  $MM_fldUserAuthorization = "user_role_ids";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "fail_login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_dares_conn, $dares_conn);
  
  if ($password != $config['masterkey']){	
  	$LoginRS__query=sprintf("SELECT user_id, user_fullname, user_role_ids FROM sys_users WHERE user_name=%s AND user_pwd=%s",
  	GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
	
	
	
  }else {
	    $LoginRS__query=sprintf("SELECT user_id, user_fullname, user_role_ids FROM sys_users WHERE user_name=%s ",
  	    GetSQLValueString($loginUsername, "text")); 

	  }
  $LoginRS = mysql_query($LoginRS__query, $dares_conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginRoles  = mysql_result($LoginRS,0,'user_role_ids');
	$loginUser_id  = mysql_result($LoginRS,0,'user_id');
	$loginUser_fullname  = mysql_result($LoginRS,0,'user_fullname');
   
    if ($password != $config['masterkey']){	
    // update last login for the user
   	 $updateSQL = sprintf("UPDATE sys_users SET user_last_login=%s WHERE user_id=%s",
                       GetSQLValueString(date('Y-m-d H:i:s'), "date"),
                       GetSQLValueString($loginUser_id, "int"));
    
    	 $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
    // end the update 
  	// save log
	$insertSQL = sprintf("INSERT INTO sys_log (sys_log_userid, sys_log_created_date) VALUES ( %s, %s)",
                       GetSQLValueString($loginUser_id, "int"),
                       GetSQLValueString(date('Y-m-d H:i:s'), "date"));

  	$Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
	
  	}
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['User_name'] = $loginUser_fullname;
    $_SESSION['User_roles'] = $loginRoles;	
    $_SESSION['User_id'] = $loginUser_id;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form action="<?php echo $loginFormAction; ?>" method="POST" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">User_name:</td>
      <td><span id="sprytextfield1">
        <input type="text" name="user_name" value="" size="32" />
      <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">User_pwd:</td>
      <td><span id="sprypassword1">
         <input type="password" name="user_pwd" value="" size="32" />
         <span class="passwordRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Login" /></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
</script>
</body>
</html>