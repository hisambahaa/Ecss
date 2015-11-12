<?php 

require_once('../../Connections/boot.php');

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO academy_structure_year (year_name, year_faculty_id, year_created_by) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['year_name'], "text"),
                       GetSQLValueString($_POST['year_faculty_id'], "int"),
                       GetSQLValueString($_SESSION['User_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE academy_structure_year SET year_name=%s WHERE year_id=%s",
                       GetSQLValueString($_POST['year_name'], "text"),
                       GetSQLValueString($_POST['year_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
}

$colname_get_year = "-1";
if (isset($_GET['fid'])) {
  $colname_get_year = $_GET['fid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_year = sprintf("SELECT * FROM academy_structure_year WHERE year_faculty_id = %s", GetSQLValueString($colname_get_year, "int"));
$get_year = mysql_query($query_get_year, $dares_conn) or die(mysql_error());
$row_get_year = mysql_fetch_assoc($get_year);
$totalRows_get_year = mysql_num_rows($get_year);
// html page title
$pageTitle='بلانكك';
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';

?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Year_name:</td>
      <td><span id="sprytextfield1">
        <input type="text" name="year_name" value="" size="32" />
      <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="year_faculty_id" value="<?php echo $_GET['fid']; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<!-- update -->
<table align="center">
	<tr valign="baseline">
        <td nowrap="nowrap" align="right">Year_name:</td>
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td></td>
  </tr>
<?php do { ?>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
   
      <tr valign="baseline">
        <td><input type="text" name="year_name" value="<?php echo htmlentities($row_get_year['year_name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        <td><a href="term.php?yid=<?php echo $row_get_year['year_id']; ?>">term</a></td>
        <td><input type="submit" value="Update record" /></td>
      </tr>
    <input type="hidden" name="MM_update" value="form2" />
    <input type="hidden" name="year_id" value="<?php echo $row_get_year['year_id']; ?>" />
  </form>
  <?php } while ($row_get_year = mysql_fetch_assoc($get_year)); ?>
</table>
<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>

<?php
mysql_free_result($get_year);
?>
