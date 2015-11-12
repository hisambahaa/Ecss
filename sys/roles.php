<?php

require_once "../Connections/boot.php";
// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="dublicate.php";
  $loginUsername = $_POST['role_name'];
  $LoginRS__query = sprintf("SELECT role_name FROM sys_role WHERE role_name=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_dares_conn, $dares_conn);
  $LoginRS=mysql_query($LoginRS__query, $dares_conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}
?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO sys_role (role_name, role_created_by) VALUES (%s, %s)",
                       GetSQLValueString($_POST['role_name'], "text"),
                       GetSQLValueString($_POST['role_created_by'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE sys_role SET role_name=%s WHERE role_id=%s",
                       GetSQLValueString($_POST['role_name'], "text"),
                       GetSQLValueString($_POST['role_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
}

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
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Role_name:</td>
      <td><span id="sprytextfield1">
        <input type="text" name="role_name" value="" size="32" />
      <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="role_created_by" value="<?php echo $_SESSION['User_id']; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
    <table align="center" dir="rtl">
    <tr>    	
        <td align="center">Role_name</td>
        <td align="center">Update</td>
    </tr>
<?php do { ?>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
      <tr valign="baseline">
        <td><input type="text" name="role_name" value="<?php echo htmlentities($row_get_role['role_name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        <td><input type="submit" value="Update record" /></td>
      </tr>
    <input type="hidden" name="MM_update" value="form2" />
    <input type="hidden" name="role_id" value="<?php echo $row_get_role['role_id']; ?>" />
  </form>
  <?php } while ($row_get_role = mysql_fetch_assoc($get_role)); ?>
  
    </table>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
</body>
</html>
<?php
mysql_free_result($get_role);

mysql_free_result($get_prem_by_self_page);
?>
