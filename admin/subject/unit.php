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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO subject_unit (unit_name, unit_sub_id, unit_order, unit_created_by) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['unit_name'], "text"),
                       GetSQLValueString($_POST['unit_sub_id'], "int"),
                       GetSQLValueString($_POST['unit_order'], "int"),
                       GetSQLValueString($_SESSION['User_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE subject_unit SET unit_name=%s, unit_order=%s WHERE unit_id=%s",
                       GetSQLValueString($_POST['unit_name'], "text"),
                       GetSQLValueString($_POST['unit_order'], "int"),
                       GetSQLValueString($_POST['unit_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
}


mysql_select_db($database_dares_conn, $dares_conn);
$query_get_all_subject = "SELECT * FROM academy_structre_subject";
$get_all_subject = mysql_query($query_get_all_subject, $dares_conn) or die(mysql_error());
$row_get_all_subject = mysql_fetch_assoc($get_all_subject);
$totalRows_get_all_subject = mysql_num_rows($get_all_subject);

$colname_get_all_unit = "-1";
if (isset($_GET['subid'])) {
  $colname_get_all_unit = $_GET['subid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_all_unit = sprintf("SELECT * FROM subject_unit WHERE unit_sub_id = %s", GetSQLValueString($colname_get_all_unit, "int"));
$get_all_unit = mysql_query($query_get_all_unit, $dares_conn) or die(mysql_error());
$row_get_all_unit = mysql_fetch_assoc($get_all_unit);
$totalRows_get_all_unit = mysql_num_rows($get_all_unit);
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
      <td nowrap="nowrap" align="right">Unit_name:</td>
      <td><input type="text" name="unit_name" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Unit_sub_id:</td>
      <td><select name="unit_sub_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_get_all_subject['sub_id']?>" ><?php echo $row_get_all_subject['sub_name']?></option>
        <?php
} while ($row_get_all_subject = mysql_fetch_assoc($get_all_subject));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Unit_order:</td>
      <td><input type="text" name="unit_order" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="unit_created_by" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<!-- view the table-->
<table border="1" align="center">
  <tr>
    <td>unit_id</td>
    <td>unit_name</td>
    <td>unit_sub_id</td>
    <td>unit_order</td>
    <td>unit_created_by</td>
    <td>unit_created_date</td>
  </tr>
  <?php do { ?>
<tr>
      <td><?php echo $row_get_all_unit['unit_id']; ?></td>
      <td><?php echo $row_get_all_unit['unit_name']; ?></td>
      <td><?php echo $row_get_all_unit['unit_sub_id']; ?></td>
      <td><?php echo $row_get_all_unit['unit_order']; ?></td>
      <td><?php echo $row_get_all_unit['unit_created_by']; ?></td>
      <td><?php echo $row_get_all_unit['unit_created_date']; ?></td>
  </tr>
    <?php } while ($row_get_all_unit = mysql_fetch_assoc($get_all_unit));
	mysql_data_seek($get_all_unit,0) ;
	$row_get_all_unit = mysql_fetch_assoc($get_all_unit);?>
</table>
    <table align="center">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Unit_name:</td>
        <td nowrap="nowrap" align="right">Unit_order:</td>
        <td nowrap="nowrap" align="right">link</td>
<?php do { ?>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
      <tr valign="baseline">
        <td><input type="text" name="unit_name" value="<?php echo htmlentities($row_get_all_unit['unit_name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        <td><input type="text" name="unit_order" value="<?php echo htmlentities($row_get_all_unit['unit_order'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        <td><a href="lesson.php?uid=<?php echo $row_get_all_unit['unit_id']; ?>">go to</a></td>
        <td><input type="submit" value="Update record" /></td>
    <input type="hidden" name="MM_update" value="form2" />
    <input type="hidden" name="unit_id" value="<?php echo $row_get_all_unit['unit_id']; ?>" />
      </tr>
  </form>
  <?php } while ($row_get_all_unit = mysql_fetch_assoc($get_all_unit)); ?>
    </table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($get_all_subject);

mysql_free_result($get_all_unit);
?>
