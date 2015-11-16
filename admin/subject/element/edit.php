<?php require_once('../../../config/boot.php'); ?>
<?php use \McKay\Flash;?>
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
  $updateSQL = sprintf("UPDATE subject_element SET element_title=%s, element_order=%s, element_type=%s, element_value=%s WHERE element_id=%s",
                       GetSQLValueString($_POST['element_title'], "text"),
                       GetSQLValueString($_POST['element_order'], "int"),
                       GetSQLValueString($_POST['element_type'], "text"),
                       GetSQLValueString($_POST['element_value'], "text"),
                       GetSQLValueString($_POST['element_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_get_all_element = "-1";
if (isset($_GET['elemid'])) {
  $colname_get_all_element = $_GET['elemid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_all_element = sprintf("SELECT * FROM subject_element WHERE element_id = %s", GetSQLValueString($colname_get_all_element, "int"));
$get_all_element = mysql_query($query_get_all_element, $dares_conn) or die(mysql_error());
$row_get_all_element = mysql_fetch_assoc($get_all_element);
$totalRows_get_all_element = mysql_num_rows($get_all_element);
?>
<?php 
// html page title
$pageTitle=$ecss_lang['Subject']['Element']['UPDATE_ELEMENT'];
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';
?>
<!-- page content -->

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height:600px;">
        <div class="x_title">
          <h2><?php echo $ecss_lang['Subject']['Element']['UPDATE_ELEMENT'] ?></h2>
           <div class="clearfix"></div>
         </div>
         <div class="x_content">

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <div class="form-group">
          <label class="control-label col-md-3" for="element_title">
          <?php echo $ecss_lang['Subject']['Element']['ELEMENT_NAME'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
            <input type="text" name="element_title" value="<?php echo htmlentities($row_get_all_element['element_title'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
          </div>
  </div>
  <div class="form-group">
          <label class="control-label col-md-3" for="element_order">
          <?php echo $ecss_lang['ORDER'];?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
            <td><input type="text" name="element_order" value="<?php echo htmlentities($row_get_all_element['element_order'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
          </div>
  </div>
  <div class="form-group">
          <label class="control-label col-md-3" for="element_type">
          <?php echo $ecss_lang['Subject']['Element']['ELEMENT_TYPE'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
            <input type="text" name="element_type" value="<?php echo htmlentities($row_get_all_element['element_type'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
          </div>
  </div>
  <div class="form-group">
          <label class="control-label col-md-3" for="element_value">
          <?php echo $ecss_lang['Subject']['Element']['ELEMENT_VALUE'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
            <input type="text" name="element_value" value="<?php echo htmlentities($row_get_all_element['element_value'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
          </div>
  </div>
  <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success pull-left">
                <i class="fa fa-save"></i> <?php echo $ecss_lang['UPDATE'] ?>
                </button>
            </div>
        </div>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="element_id" value="<?php echo $row_get_all_element['element_id']; ?>" />
</form>
<p>&nbsp;</p>
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/icheck/icheck.min.js"></script>

<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>
<?php
mysql_free_result($get_all_element);
?>
