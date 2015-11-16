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
  $updateSQL = sprintf("UPDATE sys_permission_category SET categ_name=%s WHERE categ_id=%s",
                       GetSQLValueString($_POST['categ_name'], "text"),
                       GetSQLValueString($_POST['categ_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_get_cat = "-1";
if (isset($_GET['categ_id'])) {
  $colname_get_cat = $_GET['categ_id'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_cat = sprintf("SELECT * FROM sys_permission_category WHERE categ_id = %s", GetSQLValueString($colname_get_cat, "int"));
$get_cat = mysql_query($query_get_cat, $dares_conn) or die(mysql_error());
$row_get_cat = mysql_fetch_assoc($get_cat);
$totalRows_get_cat = mysql_num_rows($get_cat);
?>
<?php 
// html page title
$pageTitle=$ecss_lang['sys']['perm_cat']['UPDATE_CAT'];
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';
?>
<!-- page content -->

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height:600px;">
        <div class="x_title">
          <h2><?php echo $ecss_lang['sys']['perm_cat']['UPDATE_CAT'] ?></h2>
           <div class="clearfix"></div>
         </div>
         <div class="row">
           <div class="col-md-12">
           </div>
         </div>
          <div class="x_content">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">

   <?php require_once('_fields.php') ?>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="categ_id" value="<?php echo $row_get_cat['categ_id']; ?>" />
</form>
<p>&nbsp;</p>
<!-- icheck -->
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/validator/validator.js"></script>
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/icheck/icheck.min.js"></script>

<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>
<?php
mysql_free_result($get_cat);
?>
