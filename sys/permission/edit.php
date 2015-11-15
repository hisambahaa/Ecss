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
  $roles = implode(',',$_POST['prem_role_ids']);
  $updateSQL = sprintf("UPDATE sys_permission SET prem_name=%s, prem_url=%s, prem_categ_id=%s, prem_role_ids=%s WHERE prem_id=%s",
                       GetSQLValueString($_POST['prem_name'], "text"),
                       GetSQLValueString($_POST['prem_url'], "text"),
                       GetSQLValueString($_POST['prem_categ_id'], "int"),
                       GetSQLValueString($roles, "text"),
                       GetSQLValueString($_POST['prem_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
   $deleteGoTo = "index.php";
        if (isset($_SERVER['QUERY_STRING'])) {
          $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
          $deleteGoTo .= $_SERVER['QUERY_STRING'];
        }
        header(sprintf("Location: %s", $deleteGoTo));
}

$colname_get_permissinon = "-1";
if (isset($_GET['permid'])) {
  $colname_get_permissinon = $_GET['permid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_permissinon = sprintf("SELECT * FROM sys_permission WHERE prem_id = %s", GetSQLValueString($colname_get_permissinon, "int"));
$get_permissinon = mysql_query($query_get_permissinon, $dares_conn) or die(mysql_error());
$row_get_permissinon = mysql_fetch_assoc($get_permissinon);
$totalRows_get_permissinon = mysql_num_rows($get_permissinon);

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_cat = "SELECT * FROM sys_permission_category";
$get_cat = mysql_query($query_get_cat, $dares_conn) or die(mysql_error());
$row_get_cat = mysql_fetch_assoc($get_cat);
$totalRows_get_cat = mysql_num_rows($get_cat);

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
      <td nowrap="nowrap" align="right">Prem_name:</td>
      <td><input type="text" name="prem_name" value="<?php echo htmlentities($row_get_permissinon['prem_name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prem_url:</td>
      <td><input type="text" name="prem_url" value="<?php echo htmlentities($row_get_permissinon['prem_url'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prem_categ_id:</td>
      <td><select name="prem_categ_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_get_cat['categ_id']?>" <?php if (!(strcmp($row_get_cat['categ_id'], htmlentities($row_get_permissinon['prem_categ_id'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_get_cat['categ_name']?></option>
        <?php
} while ($row_get_cat = mysql_fetch_assoc($get_cat));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prem_role_ids:</td>
      <td><select name="prem_role_ids[]" multiple="multiple">
        <?php 
do {  
?>
        <option value="<?php echo $row_get_role['role_id']?>" <?php if ((in_array($row_get_role['role_id'], explode(',',$row_get_permissinon['prem_role_ids'])))) {echo "SELECTED";} ?> ><?php echo $row_get_role['role_name']?></option>
        <?php
} while ($row_get_role = mysql_fetch_assoc($get_role));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="prem_id" value="<?php echo $row_get_permissinon['prem_id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($get_permissinon);

mysql_free_result($get_cat);

mysql_free_result($get_role);
?>
