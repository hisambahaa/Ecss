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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO subject_element (element_title, element_lesson_id, element_order, element_type, element_value, element_created_by) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['element_title'], "text"),
                       GetSQLValueString($_POST['element_lesson_id'], "int"),
                       GetSQLValueString($_POST['element_order'], "int"),
                       GetSQLValueString($_POST['element_type'], "text"),
                       GetSQLValueString($_POST['element_value'], "text"),
                       GetSQLValueString($_POST['element_created_by'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'].'lesid='.$_POST['element_lesson_id'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php 
// html page title
$pageTitle=$ecss_lang['Subject']['Element']['ADD_ELEMENT'];
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';
?>
<!-- page content -->

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height:600px;">
        <div class="x_title">
          <h2> <?php echo $ecss_lang['Subject']['Element']['ADD_ELEMENT'] ?></h2>
           <div class="clearfix"></div>
         </div>
         <div class="x_content">

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" class="form-horizontal form-label-left" data-parsley-validate">
  <div class="form-group">
          <label class="control-label col-md-3" for="element_title">
          <?php echo $ecss_lang['Subject']['Element']['ELEMENT_NAME']; ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
              <input type="text" name='element_title' id="element_title" required="required" class="form-control col-md-7 col-xs-12" />
          </div>
      </div>

      <div class="form-group">
          <label class="control-label col-md-3" for="element_order">
          <?php echo $ecss_lang['ORDER'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
              <input type="text" name='element_order' id="element_order" required="required" class="form-control col-md-7 col-xs-12" />
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-md-3" for="element_type">
          <?php echo $ecss_lang['Subject']['Element']['ELEMENT_TYPE']; ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
              <input type="text" name='element_type' id="element_type" required="required" class="form-control col-md-7 col-xs-12" />
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-md-3" for="element_value">
          <?php echo $ecss_lang['Subject']['Element']['ELEMENT_VALUE']; ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
              <input type="text" name='element_value' id="element_value" required="required" class="form-control col-md-7 col-xs-12" />
          </div>
      </div>
      <div class="ln_solid"></div>
   <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <a href='index.php?lesid=<?php echo $_GET['lesid']; ?>' class="btn btn-default pull-left">
                  <i class="fa fa-close"></i> <?php echo $ecss_lang['CANCEL'] ?>
                </a>
                <button type="submit" class="btn btn-success pull-left">
                <i class="fa fa-save"></i> <?php echo $ecss_lang['SUBMIT'] ?>
                </button>
            </div>
        </div>
  <input type="hidden" name="element_lesson_id" value="<?php echo $_GET['lesid']; ?>" />
  <input type="hidden" name="element_created_by" value="<?php echo $_SESSION['User_id']; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/icheck/icheck.min.js"></script>

<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>
