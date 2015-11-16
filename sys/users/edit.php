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
  $updateSQL = sprintf("UPDATE sys_users SET user_name=%s, user_pwd=%s, user_role_ids=%s, user_fullname=%s, user_email=%s, user_mobile=%s, user_photo=%s, user_state=%s, user_sex=%s WHERE user_id=%s",
                       GetSQLValueString($_POST['user_name'], "text"),
                       GetSQLValueString($_POST['user_pwd'], "text"),
                       GetSQLValueString($_POST['user_role_ids'], "text"),
                       GetSQLValueString($_POST['user_fullname'], "text"),
                       GetSQLValueString($_POST['user_email'], "text"),
                       GetSQLValueString($_POST['user_mobile'], "text"),
                       GetSQLValueString($_POST['user_photo'], "text"),
                       GetSQLValueString(isset($_POST['user_state']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['user_sex'], "text"),
                       GetSQLValueString($_POST['user_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
}

$colname_get_user = "-1";
if (isset($_GET['userid'])) {
  $colname_get_user = $_GET['userid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_user = sprintf("SELECT * FROM sys_users WHERE user_id = %s", GetSQLValueString($colname_get_user, "int"));
$get_user = mysql_query($query_get_user, $dares_conn) or die(mysql_error());
$row_get_user = mysql_fetch_assoc($get_user);
$totalRows_get_user = mysql_num_rows($get_user);

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_role = "SELECT * FROM sys_role";
$get_role = mysql_query($query_get_role, $dares_conn) or die(mysql_error());
$row_get_role = mysql_fetch_assoc($get_role);
$totalRows_get_role = mysql_num_rows($get_role);
?>
<?php 
// html page title
$pageTitle=$ecss_lang['sys']['User']['LIST_USER'] ;
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';
?>
<!-- page content -->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height:600px;">
        <div class="x_title">
          <h2><?php echo $ecss_lang['sys']['User']['EDIT_USER'] ?></h2>
           <div class="clearfix"></div>
         </div>

          <div class="x_content">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" class="form-horizontal" data-parsley-validate="" novalidate="">
  
    <div class="form-group">
          <label class="control-label col-md-3" for="user_name">
          <?php echo $ecss_lang['NAME'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
              <input type="text" name='user_name' id="user_name" value="<?php echo htmlentities($row_get_user['user_name'], ENT_COMPAT, 'utf-8'); ?>" required="required" class="form-control col-md-7 col-xs-12" />
          </div>
      </div>
      
      <div class="form-group">
          <label class="control-label col-md-3" for="user_pwd">
          <?php echo $ecss_lang['sys']['User']['USER_PASSWORD'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
              <input type="text" name='user_pwd' id="user_pwd" value="<?php echo htmlentities($row_get_user['user_pwd'], ENT_COMPAT, 'utf-8'); ?>" required="required" class="form-control col-md-7 col-xs-12" />
          </div>
      </div>
      
      <div class="form-group">
          <label class="control-label col-md-3" for="user_pwd">
          <?php echo $ecss_lang['GROUPS'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
          <select name="user_role_ids[]"  class="select2_multiple form-control" multiple="multiple">
                  <?php do {  ?>
                  <option value="<?php echo $row_get_role['role_id']?>" <?php if (!(strcmp($row_get_role['role_id'], htmlentities($row_get_user['user_role_ids'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_get_role['role_name']?></option>
                  <?php } while ($row_get_role = mysql_fetch_assoc($get_role)); ?>
          </select>
          </div>
      </div>
                
      <div class="form-group">
          <label class="control-label col-md-3" for="user_fullname">
          <?php echo $ecss_lang['NAME'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
              <input type="text" name='user_fullname' id="user_fullname" value="<?php echo htmlentities($row_get_user['user_fullname'], ENT_COMPAT, 'utf-8'); ?>" required="required" class="form-control col-md-7 col-xs-12" />
          </div>
      </div>
      
      <div class="form-group">
          <label class="control-label col-md-3" for="user_email">
          <?php echo $ecss_lang['EMAIL'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
              <input type="text" name='user_email' id="user_email" value="<?php echo htmlentities($row_get_user['user_email'], ENT_COMPAT, 'utf-8'); ?>"  required="required" class="form-control col-md-7 col-xs-12" />
          </div>
      </div>
      
      <div class="form-group">
          <label class="control-label col-md-3" for="user_mobile">
          <?php echo $ecss_lang['PHONE'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
              <input type="text" name='user_mobile' id="user_mobile" value="<?php echo htmlentities($row_get_user['user_mobile'], ENT_COMPAT, 'utf-8'); ?>" required="required" class="form-control col-md-7 col-xs-12" />
          </div>
      </div>      
                          
      <div class="form-group">
          <label class="control-label col-md-3" for="user_photo">
          <?php echo $ecss_lang['PHOTO'] ?>
          <span class="required">*</span>
          </label>
          <div class="col-md-7">
              <input type="file" name='user_photo' id="user_photo" value="<?php echo htmlentities($row_get_user['user_photo'], ENT_COMPAT, 'utf-8'); ?>"  required="required" class="form-control col-md-7 col-xs-12" />
          </div>
      </div>
                    
      <div class="form-group">
      <label class="control-label col-md-3" for="user_state">
          <?php echo $ecss_lang['STATE'] ?>
          <span class="required">*</span>
      </label>
          <div class="col-md-7">
            <input type="checkbox" class="flat" name='user_state' id="user_state" <?php if (!(strcmp(htmlentities($row_get_user['user_state'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?>><?php echo $ecss_lang['ACTIVE'] ?>
          </div>
      </div>
      
      <div class="form-group">
          <label class="control-label col-md-3" for="user_sex">
          <?php echo $ecss_lang['SEX'] ?>
          <span class="required">*</span>
          </label>
          
          <div class="col-md-7">
              <?php echo $ecss_lang['MALE'] ?>:<input type="radio" class="flat" name="user_sex" id="genderM" value="1" <?php if (!(strcmp(htmlentities($row_get_user['user_sex'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?> required /> 
              <?php echo $ecss_lang['FEMALE'] ?>:<input type="radio" class="flat" name="user_sex" id="genderF" value="0" <?php if (!(strcmp(htmlentities($row_get_user['user_sex'], ENT_COMPAT, 'utf-8'),0))) {echo "checked=\"checked\"";} ?>/>
          </div>
	</div>
    

  <div class="ln_solid"></div>
   <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <a href='index.php' class="btn btn-default pull-left">
                <i class="fa fa-close"></i> <?php echo $ecss_lang['CANCEL'] ?></a>
                <button type="submit" class="btn btn-success pull-left">
                <i class="fa fa-save"></i> <?php echo $ecss_lang['SUBMIT'] ?>
                </button>
            </div>
        </div>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="user_id" value="<?php echo $row_get_user['user_id']; ?>" />
</form>
<!-- icheck -->
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/validator/validator.js"></script>
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/icheck/icheck.min.js"></script>
<script>
            $(document).ready(function () {
                $(".select2_multiple").select2({
                    placeholder: "يمكن الاختيار اكثر من اختيار",
                    allowClear: true
                });
            });
        </script>
<script src= <?php echo $config['http_base_url'].'/admin/template/js/select/select2.full.js' ?>></script>
<link href="<?php echo $config['http_base_url'].'/admin/template/css/select/select2.min.css'; ?>" rel="stylesheet">
<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>
<?php
mysql_free_result($get_user);

mysql_free_result($get_role);
?>
