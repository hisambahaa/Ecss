<?php

require_once('../../Connections/boot.php');

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE academy_structure_department SET dep_name=%s WHERE dep_id=%s",
   GetSQLValueString($_POST['dep_name'], "text"),
   GetSQLValueString($_POST['dep_id'], "int"));
  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO academy_structure_department (dep_id, dep_name, dep_term_id, dep_created_by) VALUES (6, %s, %s, %s)",
   GetSQLValueString($_POST['dep_name'], "text"),
   GetSQLValueString($_POST['dep_term_id'], "int"),
   GetSQLValueString($_SESSION['User_id'], "int"));
  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
}

$colname_get_department = "-1";
if (isset($_GET['tid'])) {
  $colname_get_department = $_GET['tid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_department = sprintf("SELECT * FROM academy_structure_department WHERE dep_term_id = %s", GetSQLValueString($colname_get_department, "int"));
$get_department = mysql_query($query_get_department, $dares_conn) or die(mysql_error());
$row_get_department = mysql_fetch_assoc($get_department);
$totalRows_get_department = mysql_num_rows($get_department);

// html page title
$pageTitle='بلانكك';
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';

?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Dep_name:</td>
      <td><span id="sprytextfield1">
        <input type="text" name="dep_name" value="" size="32" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="Insert record" /></td>
      </tr>
    </table>
    <input type="hidden" name="dep_term_id" value="<?php echo $_GET['tid']; ?>" />
    <input type="hidden" name="MM_insert" value="form1" />
  </form>
  <p>&nbsp;</p>
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Dep_name:</td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
    </tr>
    <?php do { ?>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
      <tr valign="baseline">
        <td><input type="text" name="dep_name" value="<?php echo htmlentities($row_get_department['dep_name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        <td><input type="submit" value="Update record" /></td>
      </tr>
      <input type="hidden" name="MM_update" value="form2" />
      <input type="hidden" name="dep_id" value="<?php echo $row_get_department['dep_id']; ?>" />
    </form>
    <?php } while ($row_get_department = mysql_fetch_assoc($get_department)); ?>
  </table>
  <?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>

  <?php
  mysql_free_result($get_department);
  ?>
