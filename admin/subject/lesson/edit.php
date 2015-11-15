<?php require_once('../../../Connections/dares_conn.php'); ?>
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
  $updateSQL = sprintf("UPDATE subject_lesson SET lesson_name=%s, lesson_order=%s, lesson_type=%s, lesson_state=%s WHERE lesson_id=%s",
                       GetSQLValueString($_POST['lesson_name'], "text"),
                       GetSQLValueString($_POST['lesson_order'], "int"),
                       GetSQLValueString($_POST['lesson_type'], "int"),
                       GetSQLValueString($_POST['lesson_state'], "int"),
                       GetSQLValueString($_POST['lesson_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_get_lesson_by_lesid = "-1";
if (isset($_GET['lesid'])) {
  $colname_get_lesson_by_lesid = $_GET['lesid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_lesson_by_lesid = sprintf("SELECT * FROM subject_lesson WHERE lesson_id = %s", GetSQLValueString($colname_get_lesson_by_lesid, "int"));
$get_lesson_by_lesid = mysql_query($query_get_lesson_by_lesid, $dares_conn) or die(mysql_error());
$row_get_lesson_by_lesid = mysql_fetch_assoc($get_lesson_by_lesid);
$totalRows_get_lesson_by_lesid = mysql_num_rows($get_lesson_by_lesid);
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
      <td><input type="text" name="lesson_name" value="<?php echo htmlentities($row_get_lesson_by_lesid['lesson_name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Lesson_order:</td>
      <td><input type="text" name="lesson_order" value="<?php echo htmlentities($row_get_lesson_by_lesid['lesson_order'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Lesson_type:</td>
      <td><select name="lesson_type">
        <option value="1" <?php if (!(strcmp(1, htmlentities($row_get_lesson_by_lesid['lesson_type'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>درس</option>
        <option value="0" <?php if (!(strcmp(0, htmlentities($row_get_lesson_by_lesid['lesson_type'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>مقدمة</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Lesson_state:</td>
      <td><select name="lesson_state">
        <option value="1" <?php if (!(strcmp(1, htmlentities($row_get_lesson_by_lesid['lesson_state'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>نشط</option>
        <option value="0" <?php if (!(strcmp(0, htmlentities($row_get_lesson_by_lesid['lesson_state'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>غير نشط</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="lesson_id" value="<?php echo $row_get_lesson_by_lesid['lesson_id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($get_lesson_by_lesid);
?>
