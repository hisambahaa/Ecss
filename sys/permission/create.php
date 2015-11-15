<?php require_once('../../config/boot.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
 $roles = implode(',',$_POST['prem_role_ids']);
  $insertSQL = sprintf("INSERT INTO sys_permission (prem_name, prem_url, prem_categ_id, prem_role_ids, prem_created_by) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['prem_name'], "text"),
                       GetSQLValueString($_POST['prem_url'], "text"),
                       GetSQLValueString($_POST['prem_categ_id'], "int"),
                       GetSQLValueString($roles, "text"),
                       GetSQLValueString($_POST['prem_created_by'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
  $deleteGoTo = "index.php";
        if (isset($_SERVER['QUERY_STRING'])) {
          $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
          $deleteGoTo .= $_SERVER['QUERY_STRING'];
        }
        header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_role = "SELECT role_id, role_name FROM sys_role";
$get_role = mysql_query($query_get_role, $dares_conn) or die(mysql_error());
$row_get_role = mysql_fetch_assoc($get_role);
$totalRows_get_role = mysql_num_rows($get_role);

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_cat = "SELECT * FROM sys_permission_category";
$get_cat = mysql_query($query_get_cat, $dares_conn) or die(mysql_error());
$row_get_cat = mysql_fetch_assoc($get_cat);
$totalRows_get_cat = mysql_num_rows($get_cat);
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
      <td><input type="text" name="prem_name" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prem_url:</td>
      <td><input type="text" name="prem_url" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prem_categ_id:</td>
      <td><select name="prem_categ_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_get_cat['categ_id']?>" ><?php echo $row_get_cat['categ_name']?></option>
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
        <option value="<?php echo $row_get_role['role_id']?>" ><?php echo $row_get_role['role_name']?></option>
        <?php
} while ($row_get_role = mysql_fetch_assoc($get_role));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="prem_created_by" value="<?php echo $_SESSION['User_id']; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($get_role);

mysql_free_result($get_cat);
?>
