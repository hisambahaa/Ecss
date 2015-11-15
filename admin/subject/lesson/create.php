<?php require_once('../../../config/boot.php');
use \McKay\Flash;

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
  $insertSQL = sprintf("INSERT INTO subject_lesson (lesson_name, lesson_sub_id, lesson_order, lesson_type, lesson_state, lesson_created_by) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['lesson_name'], "text"),
                       GetSQLValueString($_POST['lesson_sub_id'], "int"),
                       GetSQLValueString($_POST['lesson_order'], "int"),
                       GetSQLValueString($_POST['lesson_type'], "int"),
                       GetSQLValueString($_POST['lesson_state'], "int"),
                       GetSQLValueString($_POST['lesson_created_by'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'].'subid='.$_POST['lesson_sub_id'];
  }
  Flash::success("تم اضافة الدرس بنجاح");
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php 
// html page title
$pageTitle='إضافة درس';
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';
?>
<!-- page content -->

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height:600px;">
        <div class="x_title">
          <h2>الدروس</h2>
           <div class="clearfix"></div>
         </div>
         <div class="x_content">
         
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" class="form-horizontal form-label-left" data-parsley-validate>

     <div class="form-group">
          <label class="control-label col-md-3" for="faculty_name">
          Lesson_name<?php //echo $ecss_lang['ACADEMY_NAME'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
              <input type="text" name='lesson_name' id="lesson_name" required="required" class="form-control col-md-7 col-xs-12" />
          </div>
      </div>
      
      <div class="form-group">
          <label class="control-label col-md-3" for="faculty_name">
          Lesson_order<?php //echo $ecss_lang['ACADEMY_NAME'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
              <input type="text" name='lesson_order' id="lesson_order" required="required" class="form-control col-md-7 col-xs-12" />
          </div>
      </div>
      
      <div class="form-group">
          <label class="control-label col-md-3" for="faculty_name">
          Lesson_type<?php //echo $ecss_lang['ACADEMY_NAME'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
              <select name="lesson_type">
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>درس</option>
        <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>مقدمة</option>
      </select>
          </div>
      </div>
      
      <div class="form-group">
          <label class="control-label col-md-3" for="faculty_name">
          Lesson_state<?php //echo $ecss_lang['ACADEMY_NAME'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
          <select name="lesson_state">
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>نشط</option>
        <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>غير نشط</option>
      </select>
          </div>
      </div>

  <div class="ln_solid"></div>
   <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <a href='index.php?subid=<?php echo $_GET['subid']; ?>' class="btn btn-default pull-left">
                <i class="fa fa-close"></i> <?php echo $ecss_lang['CANCEL'] ?></a>
                <button type="submit" class="btn btn-success pull-left">
                <i class="fa fa-save"></i> <?php echo $ecss_lang['SUBMIT'] ?>
                </button>
            </div>
        </div>
        
  <input type="hidden" name="lesson_sub_id" value="<?php echo $_GET['subid']; ?>" />
  <input type="hidden" name="lesson_created_by" value="1" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/icheck/icheck.min.js"></script>

<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>
