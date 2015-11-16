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
  $updateSQL = sprintf("UPDATE subject_lesson SET lesson_name=%s, lesson_order=%s, lesson_type=%s, lesson_state=%s WHERE lesson_id=%s",
                       GetSQLValueString($_POST['lesson_name'], "text"),
                       GetSQLValueString($_POST['lesson_order'], "int"),
                       GetSQLValueString($_POST['lesson_type'], "int"),
                       GetSQLValueString($_POST['lesson_state'], "int"),
                       GetSQLValueString($_POST['lesson_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  Flash::success($ecss_lang['Subject']['Lesson']['EDIT_SUCCESS']);
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_get_lesson_by_lesid = "-1";
if (isset($_GET['lesid'])) {
  $colname_get_lesson_by_lesid = $_GET['lesid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_lesson_by_lesid = sprintf("SELECT * FROM subject_lesson WHERE lesson_id = %s", GetSQLValueString($colname_get_lesson_by_lesid, "int"));
$get_lesson_by_lesid = mysql_query($query_get_lesson_by_lesid, $dares_conn) or die(mysql_error());
$row_get_lesson_by_lesid = mysql_fetch_assoc($get_lesson_by_lesid);
$totalRows_get_lesson_by_lesid = mysql_num_rows($get_lesson_by_lesid);
?>

<?php 
// html page title
$pageTitle=$ecss_lang['Subject']['Lesson']['UPDATE_LESSON'];
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';
?>
<!-- page content -->

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height:600px;">
        <div class="x_title">
          <h2><?php echo $ecss_lang['Subject']['Lesson']['UPDATE_LESSON'] ?></h2>
           <div class="clearfix"></div>
         </div>
         <div class="x_content">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" class="form-horizontal form-label-left" data-parsley-validate>
  
       <div class="form-group">
          <label class="control-label col-md-3" for="lesson_name">
          <?php echo $ecss_lang['Subject']['Lesson']['LESSON_NAME'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
              <input type="text" name='lesson_name' id="lesson_name" value="<?php echo htmlentities($row_get_lesson_by_lesid['lesson_name'], ENT_COMPAT, 'utf-8'); ?>" required="required" class="form-control col-md-7 col-xs-12" />
          </div>
      </div>
      
      <div class="form-group">
          <label class="control-label col-md-3" for="lesson_order">
          <?php echo $ecss_lang['ORDER'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
              <input type="text" name='lesson_order' id="lesson_order" value="<?php echo htmlentities($row_get_lesson_by_lesid['lesson_order'], ENT_COMPAT, 'utf-8'); ?>" required="required" class="form-control col-md-7 col-xs-12" />
          </div>
      </div>
      
      <div class="form-group">
          <label class="control-label col-md-3" for="lesson_type">
          <?php echo $ecss_lang['TYPE'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
              <select name="lesson_type" class="form-control">
        <option value="1" <?php if (!(strcmp(1, htmlentities($row_get_lesson_by_lesid['lesson_type'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $ecss_lang['Subject']['Lesson']['LESSON_TYPE_1'];?></option>
        <option value="0" <?php if (!(strcmp(0, htmlentities($row_get_lesson_by_lesid['lesson_type'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $ecss_lang['Subject']['Lesson']['LESSON_TYPE_0'];?></option>
      </select>
          </div>
      </div>
      
      <div class="form-group">
          <label class="control-label col-md-3" for="Lesson_state">
          <?php echo $ecss_lang['STATE'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
             <select name="lesson_state" class="form-control">
        <option value="1" <?php if (!(strcmp(1, htmlentities($row_get_lesson_by_lesid['lesson_state'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $ecss_lang['ACTIVE'];?></option>
        <option value="0" <?php if (!(strcmp(0, htmlentities($row_get_lesson_by_lesid['lesson_state'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $ecss_lang['NOT_ACTIVE'];?></option>
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
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="lesson_id" value="<?php echo $row_get_lesson_by_lesid['lesson_id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($get_lesson_by_lesid);
?>
