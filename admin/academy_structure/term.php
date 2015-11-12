<?php 

require_once('../../Connections/boot.php');

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO academy_structure_term (term_name, term_year_id, term_created_by) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['term_name'], "text"),
                       GetSQLValueString($_POST['term_year_id'], "int"),
                       GetSQLValueString($_SESSION['User_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE academy_structure_term SET term_name=%s WHERE term_id=%s",
                       GetSQLValueString($_POST['term_name'], "text"),
                       GetSQLValueString($_POST['term_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
}

$colname_get_term = "-1";
if (isset($_GET['yid'])) {
  $colname_get_term = $_GET['yid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_term = sprintf("SELECT * FROM academy_structure_term WHERE term_year_id = %s", GetSQLValueString($colname_get_term, "int"));
$get_term = mysql_query($query_get_term, $dares_conn) or die(mysql_error());
$row_get_term = mysql_fetch_assoc($get_term);
$totalRows_get_term = mysql_num_rows($get_term);

// html page title
$pageTitle='بلانكك';
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';

?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Term_name:</td>
      <td><span id="sprytextfield1">
        <input type="text" name="term_name" value="" size="32" />
      <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="term_year_id" value="<?php echo $_GET['yid']; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
    <table align="center">
      <tr valign="baseline">
        <td nowrap="nowrap" align="center">Term_name:</td>
        <td nowrap="nowrap" align="center">subject</td>
        <td nowrap="nowrap" align="center">department</td>
        <td nowrap="nowrap" align="center">&nbsp;</td>
      </tr>
<?php do { ?>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
      <tr valign="baseline">
        <td><input type="text" name="term_name" value="<?php echo htmlentities($row_get_term['term_name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        <td nowrap="nowrap" align="center"><a href="subject.php?tid=<?php echo $row_get_term['term_id']; ?>">subject</a></td>
        <td nowrap="nowrap" align="center"><a href="department.php?tid=<?php echo $row_get_term['term_id']; ?>">department</a></td>
        <td><input type="submit" value="Update record" /></td>
      </tr>
    <input type="hidden" name="MM_update" value="form2" />
    <input type="hidden" name="term_id" value="<?php echo $row_get_term['term_id']; ?>" />
  </form>
  <?php } while ($row_get_term = mysql_fetch_assoc($get_term)); ?>
    </table>
<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>

<?php
mysql_free_result($get_term);
?>
