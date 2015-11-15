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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE subject_lesson SET lesson_name=%s, lesson_order=%s, lesson_type=%s, lesson_state=%s WHERE lesson_id=%s",
                       GetSQLValueString($_POST['lesson_name'], "text"),
                       GetSQLValueString($_POST['lesson_order'], "int"),
                       GetSQLValueString($_POST['lesson_type'], "int"),
                       GetSQLValueString(isset($_POST['lesson_state']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['lesson_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO subject_lesson (lesson_name, lesson_sub_id, lesson_order, lesson_type, lesson_state, lesson_created_by) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['lesson_name'], "text"),
                       GetSQLValueString($_POST['lesson_sub_id'], "int"),
                       GetSQLValueString($_POST['lesson_order'], "int"),
                       GetSQLValueString($_POST['lesson_type'], "int"),
                       GetSQLValueString(isset($_POST['lesson_state']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['lesson_created_by'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
}

$colname_get_all_lesson = "-1";
if (isset($_GET['subid'])) {
  $colname_get_all_lesson = $_GET['subid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_all_lesson = sprintf("SELECT * FROM subject_lesson WHERE lesson_sub_id = %s", GetSQLValueString($colname_get_all_lesson, "int"));
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
<form method="post" name="form2" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Lesson_name:</td>
      <td><input type="text" name="lesson_name" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Lesson_order:</td>
      <td><input type="text" name="lesson_order" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Lesson_type:</td>
      <td><input type="text" name="lesson_type" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Lesson_state:</td>
      <td><input type="checkbox" name="lesson_state" value="" ></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <input type="hidden" name="lesson_sub_id" value="<?php echo $_GET['subid']; ?>">
  <input type="hidden" name="lesson_created_by" value="<?php echo $_SESSION['User_id']; ?>">
  <input type="hidden" name="MM_insert" value="form2">
</form>
<p>&nbsp;</p>
<?php do { ?>
  <table align="center">
    <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
      <tr valign="baseline">
        <td nowrap align="right">Lesson_name:</td>
        <td><input type="text" name="lesson_name" value="<?php echo htmlentities($row_get_all_lesson['lesson_name'], ENT_COMPAT, ''); ?>" size="32"></td>
      </tr>
  <!--    <div class="form-group">
                                    <label class="control-label col-md-3" for="last-name">Last Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="text" id="last-name2" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
      </div>-->
      
      <tr valign="baseline">
        <td nowrap align="right">Lesson_order:</td>
        <td><input type="text" name="lesson_order" value="<?php echo htmlentities($row_get_all_lesson['lesson_order'], ENT_COMPAT, ''); ?>" size="32"></td>
      </tr>
      
      
      <tr valign="baseline">
        <td nowrap align="right">Lesson_type:</td>
        <td><input type="text" name="lesson_type" value="<?php echo htmlentities($row_get_all_lesson['lesson_type'], ENT_COMPAT, ''); ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">Lesson_state:</td>
        <td><input type="checkbox" name="lesson_state" value=""  <?php if (!(strcmp(htmlentities($row_get_all_lesson['lesson_state'], ENT_COMPAT, ''),"1"))) {echo "checked=\"checked\"";} ?>></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">&nbsp;</td>
        <td><input type="submit" value="Update record"></td>
      </tr>
      <input type="hidden" name="MM_update" value="form1">
      <input type="hidden" name="lesson_id" value="<?php echo $row_get_all_lesson['lesson_id']; ?>">
    </form>
  </table>
  <?php } while ($row_get_all_lesson = mysql_fetch_assoc($get_all_lesson));
  mysql_data_seek($get_all_lesson , 0); 
  $row_get_all_lesson = mysql_fetch_assoc($get_all_lesson);?>
<p>&nbsp;</p>
</body>
</html>	
<?php mysql_free_result($get_all_lesson);?>