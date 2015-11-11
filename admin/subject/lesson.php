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
  $insertSQL = sprintf("INSERT INTO subject_lesson (lesson_name, lesson_unit_id, lesson_order, lesson_type, lesson_state, lesson_created_by) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['lesson_name'], "text"),
                       GetSQLValueString($_POST['lesson_unit_id'], "int"),
                       GetSQLValueString($_POST['lesson_order'], "int"),
                       GetSQLValueString($_POST['lesson_type'], "int"),
                       GetSQLValueString($_POST['lesson_state'], "int"),
                       GetSQLValueString($_SESSION['User_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE subject_lesson SET lesson_name=%s, lesson_unit_id=%s, lesson_order=%s, lesson_type=%s, lesson_state=%s WHERE lesson_id=%s",
                       GetSQLValueString($_POST['lesson_name'], "text"),
                       GetSQLValueString($_POST['lesson_unit_id'], "int"),
                       GetSQLValueString($_POST['lesson_order'], "int"),
                       GetSQLValueString($_POST['lesson_type'], "int"),
                       GetSQLValueString($_POST['lesson_state'], "int"),
                       GetSQLValueString($_POST['lesson_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
}

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_all_unit = "SELECT * FROM subject_unit";
$get_all_unit = mysql_query($query_get_all_unit, $dares_conn) or die(mysql_error());
$row_get_all_unit = mysql_fetch_assoc($get_all_unit);
$totalRows_get_all_unit = mysql_num_rows($get_all_unit);

$colname_get_all_lesson = "-1";
if (isset($_GET['uid'])) {
  $colname_get_all_lesson = $_GET['uid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_all_lesson = sprintf("SELECT * FROM subject_lesson WHERE lesson_unit_id = %s", GetSQLValueString($colname_get_all_lesson, "int"));
$get_all_lesson = mysql_query($query_get_all_lesson, $dares_conn) or die(mysql_error());
$row_get_all_lesson = mysql_fetch_assoc($get_all_lesson);
$totalRows_get_all_lesson = mysql_num_rows($get_all_lesson);
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
      <td nowrap="nowrap" align="right">Lesson_name:</td>
      <td><input type="text" name="lesson_name" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Lesson_unit_id:</td>
      <td><select name="lesson_unit_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_get_all_unit['unit_id']?>" ><?php echo $row_get_all_unit['unit_name']?></option>
        <?php
} while ($row_get_all_unit = mysql_fetch_assoc($get_all_unit));
mysql_data_seek($get_all_unit,0);
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Lesson_order:</td>
      <td><input type="text" name="lesson_order" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Lesson_type:</td>
      <td><input type="text" name="lesson_type" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Lesson_state:</td>
      <td><input type="text" name="lesson_state" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="lesson_created_by" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>

<!--update form-->

    <table align="center">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Lesson_name:</td>
        <td nowrap="nowrap" align="right">Lesson_unit_id:</td>
        <td nowrap="nowrap" align="right">Lesson_order:</td>
        <td nowrap="nowrap" align="right">Lesson_type:</td>
        <td nowrap="nowrap" align="right">Lesson_state:</td>
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td nowrap="nowrap" align="right">&nbsp;</td>
        
      </tr>
<?php do { ?>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
      <tr valign="baseline">
        <td><input type="text" name="lesson_name" value="<?php echo htmlentities($row_get_all_lesson['lesson_name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        <td><select name="lesson_unit_id">
          <?php 
do {  
?>
          <option value="<?php echo $row_get_all_unit['unit_id']?>" <?php if (!(strcmp($row_get_all_unit['unit_id'], htmlentities($row_get_all_lesson['lesson_unit_id'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_get_all_unit['unit_name']?></option>
          <?php
} while ($row_get_all_unit = mysql_fetch_assoc($get_all_unit));
mysql_data_seek($get_all_unit,0);
?>
        </select></td>
        <td><input type="text" name="lesson_order" value="<?php echo htmlentities($row_get_all_lesson['lesson_order'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        <td><input type="text" name="lesson_type" value="<?php echo htmlentities($row_get_all_lesson['lesson_type'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        <td><input type="text" name="lesson_state" value="<?php echo htmlentities($row_get_all_lesson['lesson_state'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        <td><a href="element.php?lid=<?php echo $row_get_all_lesson['lesson_id']; ?>">go to</a></td>
        <td><input type="submit" value="Update record" /></td>
      </tr>
    <input type="hidden" name="MM_update" value="form2" />
    <input type="hidden" name="lesson_id" value="<?php echo $row_get_all_lesson['lesson_id']; ?>" />
  </form>
  <?php } while ($row_get_all_lesson = mysql_fetch_assoc($get_all_lesson)); ?>
    </table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($get_all_unit);

mysql_free_result($get_all_lesson);
?>
