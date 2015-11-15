<?php require_once('../../config/boot.php'); ?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO subject_element (element_title, element_lesson_id, element_order, element_type, element_value, element_created_by) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['element_title'], "text"),
                       GetSQLValueString($_POST['element_lesson_id'], "int"),
                       GetSQLValueString($_POST['element_order'], "int"),
                       GetSQLValueString($_POST['element_type'], "text"),
                       GetSQLValueString($_POST['element_value'], "text"),
                       GetSQLValueString($_POST['element_created_by'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE subject_element SET element_title=%s, element_lesson_id=%s, element_order=%s, element_type=%s, element_value=%s, element_created_by=%s WHERE element_id=%s",
                       GetSQLValueString($_POST['element_title'], "text"),
                       GetSQLValueString($_POST['element_lesson_id'], "int"),
                       GetSQLValueString($_POST['element_order'], "int"),
                       GetSQLValueString($_POST['element_type'], "text"),
                       GetSQLValueString($_POST['element_value'], "text"),
                       GetSQLValueString($_POST['element_created_by'], "int"),
                       GetSQLValueString($_POST['element_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
}

$colname_get_all_element = "-1";
if (isset($_GET['lid'])) {
  $colname_get_all_element = $_GET['lid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_all_element = sprintf("SELECT * FROM subject_element WHERE element_lesson_id = %s", GetSQLValueString($colname_get_all_element, "int"));
$get_all_element = mysql_query($query_get_all_element, $dares_conn) or die(mysql_error());
$row_get_all_element = mysql_fetch_assoc($get_all_element);
$totalRows_get_all_element = mysql_num_rows($get_all_element);
 //require_once('../../config/boot.php'); ?>
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
      <td nowrap="nowrap" align="right">Element_title:</td>
      <td><input type="text" name="element_title" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Element_order:</td>
      <td><input type="text" name="element_order" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Element_type:</td>
      <td><input type="text" name="element_type" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Element_value:</td>
      <td><input type="text" name="element_value" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="element_lesson_id" value="<?php $_GET['lid']; ?>" />
  <input type="hidden" name="element_created_by" value="<?php $_SESSION['User_id']; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<!--view-->

<p>&nbsp;</p>
<!--update-->
    <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Element_title:</td>
          <td nowrap="nowrap" align="right">Element_order:</td>
          <td nowrap="nowrap" align="right">Element_type:</td>
          <td nowrap="nowrap" align="right">Element_value:</td>
          <td nowrap="nowrap" align="right">&nbsp;</td>
        </tr>
  <?php do { ?>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
        <tr valign="baseline">
          <td><input type="text" name="element_title" value="<?php echo htmlentities($row_get_all_element['element_title'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
          <td><input type="text" name="element_order" value="<?php echo htmlentities($row_get_all_element['element_order'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
          <td><input type="text" name="element_type" value="<?php echo htmlentities($row_get_all_element['element_type'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
          <td><input type="text" name="element_value" value="<?php echo htmlentities($row_get_all_element['element_value'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
          <td><input type="submit" value="Update record" /></td>
        </tr>
        <input type="hidden" name="element_lesson_id" value="<?php $_GET['lid'];?>" />
        <input type="hidden" name="element_created_by" value="<?php $_SESSION['User_id']; ?>" />
        <input type="hidden" name="MM_update" value="form2" />
        <input type="hidden" name="element_id" value="<?php echo $row_get_all_element['element_id']; ?>" />
      </form>
    <?php } while ($row_get_all_element = mysql_fetch_assoc($get_all_element));
	mysql_data_seek($get_all_element,0);
	$row_get_all_element = mysql_fetch_assoc($get_all_element);
	 ?>
    </table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($get_all_element);
?>
