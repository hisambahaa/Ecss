<?php
require_once "../config/boot.php";
// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="dublicate.php";
  $loginUsername = $_POST['categ_name'];
  $LoginRS__query = sprintf("SELECT categ_name FROM sys_permission_category WHERE categ_name=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_dares_conn, $dares_conn);
  $LoginRS=mysql_query($LoginRS__query, $dares_conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO sys_permission_category (categ_name) VALUES (%s)",
                       GetSQLValueString($_POST['categ_name'], "text"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE sys_permission_category SET categ_name=%s WHERE categ_id=%s",
                       GetSQLValueString($_POST['categ_name'], "text"),
                       GetSQLValueString($_POST['categ_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
}

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_prem_categ = "SELECT * FROM sys_permission_category";
$get_prem_categ = mysql_query($query_get_prem_categ, $dares_conn) or die(mysql_error());
$row_get_prem_categ = mysql_fetch_assoc($get_prem_categ);
$totalRows_get_prem_categ = mysql_num_rows($get_prem_categ);
$pageTitle = "";
require_once $config['base_url'] . '/admin/template/includes/header.php';
?>

<div class="right_col" role="main">
  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel" style="min-height:600px;">
      <div class="x_title">
        <h2>الهيكل الاكاديمى والمحتوى العلمى</h2>
        <div class="clearfix"></div>
      </div>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Categ_name:</td>
      <td><span id="sprytextfield1">
        <input type="text" name="categ_name" value="" size="32" />
      <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>

    <table align="center">
      <tr valign="baseline">
        <td align="center">Categ_name:</td>
        <td align="center">&nbsp;</td>
      </tr>

<?php do { ?>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
      <tr valign="baseline">
        <td><input type="text" name="categ_name" value="<?php echo htmlentities($row_get_prem_categ['categ_name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>        
        <td><input type="submit" value="Update record" /></td>
      </tr>
    <input type="hidden" name="MM_update" value="form2" />
    <input type="hidden" name="categ_id" value="<?php echo $row_get_prem_categ['categ_id']; ?>" />
  </form>
  <?php } while ($row_get_prem_categ = mysql_fetch_assoc($get_prem_categ)); ?>
    </table>


</div>
</div>
</div>
</div>

<?php
require_once $config['base_url'] . '/admin/template/includes/footer.php';
mysql_free_result($get_prem_categ);
?>
