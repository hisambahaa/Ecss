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
  $updateSQL = sprintf("UPDATE sys_role SET role_name=%s WHERE role_id=%s",
                       GetSQLValueString($_POST['role_name'], "text"),
                       GetSQLValueString($_POST['role_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
    $deleteGoTo = "index.php";
        if (isset($_SERVER['QUERY_STRING'])) {
          $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
          $deleteGoTo .= $_SERVER['QUERY_STRING'];
        }
        header(sprintf("Location: %s", $deleteGoTo));
}

$colname_get_role = "-1";
if (isset($_GET['roleid'])) {
  $colname_get_role = $_GET['roleid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_role = sprintf("SELECT * FROM sys_role WHERE role_id = %s", GetSQLValueString($colname_get_role, "int"));
$get_role = mysql_query($query_get_role, $dares_conn) or die(mysql_error());
$row_get_role = mysql_fetch_assoc($get_role);
$totalRows_get_role = mysql_num_rows($get_role);
?>
<?php 
// html page title
$pageTitle='تعديل المجموعة';
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';
?>
<!-- page content -->
  <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height:600px;">
        <div class="x_title">
          <h2>تعديل المجموعة</h2>
           <div class="clearfix"></div>
         </div>
         <div class="row">
           <div class="col-md-12">
             
           </div>
         </div>
          <div class="x_content">
      
 <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" class="form-horizontal form-label-left" data-parsley-validate>
 
<div class="form-group">
    <label class="control-label col-md-3" for="faculty_name"><?php echo $ecss_lang['sys']['Role']['ROLE_NAME'] ?><span class="required">*</span>
    </label>
    <div class="col-md-7">
    <input type="text" name="role_name" value="<?php echo htmlentities($row_get_role['role_name'], ENT_COMPAT, 'utf-8'); ?>" required="required" class="form-control col-md-7 col-xs-12"  />
       </div>
</div>
<div class="ln_solid"></div>
<div class="form-group">
    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
        <a href='index.php' class="btn btn-default pull-left">
            <i class="fa fa-close"></i> <?php echo $ecss_lang['CANCEL'] ?></a>
            <button type="submit" class="btn btn-success pull-left">
                <i class="fa fa-save"></i> <?php echo $ecss_lang['UPDATE'] ?>
            </button>
        </div>
    </div>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="role_id" value="<?php echo $row_get_role['role_id']; ?>" />
</form>
<p>&nbsp;</p>
<!-- icheck -->
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/validator/validator.js"></script>
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/icheck/icheck.min.js"></script>

<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>
<?php
mysql_free_result($get_role);
?>
