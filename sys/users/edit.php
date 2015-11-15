<?php require_once('../../Connections/dares_conn.php'); ?>
<?php
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE sys_users SET user_name=%s, user_pwd=%s, user_role_ids=%s, user_fullname=%s, user_email=%s, user_mobile=%s, user_photo=%s, user_state=%s, user_sex=%s WHERE user_id=%s",
                       GetSQLValueString($_POST['user_name'], "text"),
                       GetSQLValueString($_POST['user_pwd'], "text"),
                       GetSQLValueString($_POST['user_role_ids'], "text"),
                       GetSQLValueString($_POST['user_fullname'], "text"),
                       GetSQLValueString($_POST['user_email'], "text"),
                       GetSQLValueString($_POST['user_mobile'], "text"),
                       GetSQLValueString($_POST['user_photo'], "text"),
                       GetSQLValueString(isset($_POST['user_state']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['user_sex'], "text"),
                       GetSQLValueString($_POST['user_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
}

$colname_get_user = "-1";
if (isset($_GET['userid'])) {
  $colname_get_user = $_GET['userid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_user = sprintf("SELECT * FROM sys_users WHERE user_id = %s", GetSQLValueString($colname_get_user, "int"));
$get_user = mysql_query($query_get_user, $dares_conn) or die(mysql_error());
$row_get_user = mysql_fetch_assoc($get_user);
$totalRows_get_user = mysql_num_rows($get_user);

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_role = "SELECT * FROM sys_role";
$get_role = mysql_query($query_get_role, $dares_conn) or die(mysql_error());
$row_get_role = mysql_fetch_assoc($get_role);
$totalRows_get_role = mysql_num_rows($get_role);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">User_name:</td>
      <td><input type="text" name="user_name" value="<?php echo htmlentities($row_get_user['user_name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">User_pwd:</td>
      <td><input type="text" name="user_pwd" value="<?php echo htmlentities($row_get_user['user_pwd'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">User_role_ids:</td>
      <td><select name="user_role_ids">
        <?php 
do {  
?>
        <option value="<?php echo $row_get_role['role_id']?>" <?php if (!(strcmp($row_get_role['role_id'], htmlentities($row_get_user['user_role_ids'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_get_role['role_name']?></option>
        <?php
} while ($row_get_role = mysql_fetch_assoc($get_role));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">User_fullname:</td>
      <td><input type="text" name="user_fullname" value="<?php echo htmlentities($row_get_user['user_fullname'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">User_email:</td>
      <td><input type="text" name="user_email" value="<?php echo htmlentities($row_get_user['user_email'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">User_mobile:</td>
      <td><input type="text" name="user_mobile" value="<?php echo htmlentities($row_get_user['user_mobile'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">User_photo:</td>
      <td><input type="text" name="user_photo" value="<?php echo htmlentities($row_get_user['user_photo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">User_state:</td>
      <td><input type="checkbox" name="user_state" value=""  <?php if (!(strcmp(htmlentities($row_get_user['user_state'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">User_sex:</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="user_sex" value="1" <?php if (!(strcmp(htmlentities($row_get_user['user_sex'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?> />
            ذكر</td>
        </tr>
        <tr>
          <td><input type="radio" name="user_sex" value="0" <?php if (!(strcmp(htmlentities($row_get_user['user_sex'], ENT_COMPAT, 'utf-8'),0))) {echo "checked=\"checked\"";} ?> />
            انثى</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="user_id" value="<?php echo $row_get_user['user_id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($get_user);

mysql_free_result($get_role);
?>
