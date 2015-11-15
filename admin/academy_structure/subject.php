<?php

require_once('../../config/boot.php');

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
 require_once('../../config/perm.php'); ?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO academy_structre_subject (sub_name, sub_term_id, sub_hour, sub_code, sub_description, sub_type, sub_created_by) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['sub_name'], "text"),
                       GetSQLValueString($_POST['sub_term_id'], "int"),
                       GetSQLValueString($_POST['sub_hour'], "int"),
                       GetSQLValueString($_POST['sub_code'], "text"),
                       GetSQLValueString($_POST['sub_description'], "text"),
                       GetSQLValueString($_POST['sub_type'], "int"),
                       GetSQLValueString($_SESSION['User_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE academy_structre_subject SET sub_name=%s, sub_hour=%s, sub_code=%s, sub_description=%s, sub_type=%s WHERE sub_id=%s",
                       GetSQLValueString($_POST['sub_name'], "text"),
                       GetSQLValueString($_POST['sub_hour'], "int"),
                       GetSQLValueString($_POST['sub_code'], "text"),
                       GetSQLValueString($_POST['sub_description'], "text"),
                       GetSQLValueString($_POST['sub_type'], "int"),
                       GetSQLValueString($_POST['sub_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
}

$colname_get_subjects = "-1";
if (isset($_GET['tid'])) {
  $colname_get_subjects = $_GET['tid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_subjects = sprintf("SELECT * FROM academy_structre_subject WHERE sub_term_id = %s", GetSQLValueString($colname_get_subjects, "int"));
$get_subjects = mysql_query($query_get_subjects, $dares_conn) or die(mysql_error());
$row_get_subjects = mysql_fetch_assoc($get_subjects);
$totalRows_get_subjects = mysql_num_rows($get_subjects);


// html page title
$pageTitle='بلانكك';
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';


?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sub_name:</td>
      <td><input type="text" name="sub_name" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sub_hour:</td>
      <td><select name="sub_hour">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sub_code:</td>
      <td><input type="text" name="sub_code" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Sub_description:</td>
      <td><textarea name="sub_description" cols="50" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sub_type:</td>
      <td><select name="sub_type">
        <option value="1">1</option>
        <option value="2">2</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="sub_term_id" value="<?php echo $_GET['tid']; ?>" />
  <input type="hidden" name="sub_created_by" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
    <table align="center">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Sub_name:</td>
        <td nowrap="nowrap" align="right">Sub_hour:</td>
        <td nowrap="nowrap" align="right">Sub_code:</td>
        <td nowrap="nowrap" align="right">Sub_description:</td>
        <td nowrap="nowrap" align="right">Sub_type:</td>
        <td nowrap="nowrap" align="right">link</td>
        <td nowrap="nowrap" align="right">&nbsp;</td>
      </tr>
<?php do { ?>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
      <tr valign="baseline">
        <td><input type="text" name="sub_name" value="<?php echo htmlentities($row_get_subjects['sub_name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        <td><select name="sub_hour">
          <option value="1" <?php if (!(strcmp(1, htmlentities($row_get_subjects['sub_hour'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>1</option>
          <option value="2" <?php if (!(strcmp(2, htmlentities($row_get_subjects['sub_hour'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>2</option>
          <option value="3" <?php if (!(strcmp(3, htmlentities($row_get_subjects['sub_hour'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>3</option>
          <option value="4" <?php if (!(strcmp(4, htmlentities($row_get_subjects['sub_hour'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>4</option>
          <option value="5" <?php if (!(strcmp(5, htmlentities($row_get_subjects['sub_hour'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>5</option>
        </select></td>
        <td><input type="text" name="sub_code" value="<?php echo htmlentities($row_get_subjects['sub_code'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        <td><input type="text" name="sub_description" value="<?php echo htmlentities($row_get_subjects['sub_description'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        <td><select name="sub_type">
          <option value="1" <?php if (!(strcmp(1, htmlentities($row_get_subjects['sub_type'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>1</option>
          <option value="2" <?php if (!(strcmp(2, htmlentities($row_get_subjects['sub_type'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>2</option>
        </select></td>
        <td><a href="../subject/lesson.php?subid=<?php echo $row_get_subjects['sub_id']; ?>">go to</a></td>
        <td><input type="submit" value="Update record" /></td>
      </tr>
    <input type="hidden" name="MM_update" value="form2" />
    <input type="hidden" name="sub_id" value="<?php echo $row_get_subjects['sub_id']; ?>" />
  </form>
  <?php } while ($row_get_subjects = mysql_fetch_assoc($get_subjects)); ?>
    </table>
<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>

<?php
mysql_free_result($get_subjects);
?>
