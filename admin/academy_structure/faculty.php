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
 require_once('../../Connections/perm.php'); ?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO academy_structure_faculty (faculty_name, faculty_created_by) VALUES (%s, %s)",
                       GetSQLValueString($_POST['faculty_name'], "text"),
                       GetSQLValueString($_SESSION['User_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
}

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_faculty = "SELECT * FROM academy_structure_faculty";
$get_faculty = mysql_query($query_get_faculty, $dares_conn) or die(mysql_error());
$row_get_faculty = mysql_fetch_assoc($get_faculty);
$totalRows_get_faculty = mysql_num_rows($get_faculty);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Faculty_name:</td>
      <td><span id="sprytextfield1">
        <input type="text" name="faculty_name" value="" size="32" />
      <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<table align="center">
  <tr>
    <td>faculty_id</td>
    <td>faculty_name</td>
    <td>faculty_created_by</td>
    <td>faculty_created_date</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><a href="year.php?fid=<?php echo $row_get_faculty['faculty_id']; ?>">years</a></td>
      <td><?php echo $row_get_faculty['faculty_name']; ?></td>
      <td><?php echo $row_get_faculty['faculty_created_by']; ?></td>
      <td><?php echo $row_get_faculty['faculty_created_date']; ?></td>
    </tr>
    <?php } while ($row_get_faculty = mysql_fetch_assoc($get_faculty)); ?>
</table>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
</body>
</html>
<?php
mysql_free_result($get_faculty);
?>
