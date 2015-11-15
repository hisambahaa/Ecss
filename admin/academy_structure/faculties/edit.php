<?php 

require_once('../../../config/boot.php');
use \McKay\Flash;

$faculty_id =  GetSQLValueString($_GET['faculty_id'], "int");

$updateFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $updateFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  
  $faculty_name =  GetSQLValueString($_POST['faculty_name'], "text");
  

  if(empty($faculty_name)) {
    header('location: create.php');
    exit;
  }
  $update = sprintf("UPDATE academy_structure_faculty SET faculty_name=%s WHERE faculty_id",$faculty_name ,$faculty_id);

  

  mysql_select_db($database_dares_conn, $dares_conn);
  $query = mysql_query($update, $dares_conn) or die(mysql_error());
  if($query) {
    Flash::success($ecss_lang['ACADEMY_STRUCTURE']['FACULTY']['ADD_SUCCESS']);
    header('location: index.php');
    exit;
  }
  
}

  $select = sprintf('SELECT faculty_id ,faculty_name FROM academy_structure_faculty WHERE faculty_id=%s' ,$faculty_id);

  mysql_select_db($database_dares_conn, $dares_conn);
  $query = mysql_query($select, $dares_conn) or die(mysql_error());
  $faculty = mysql_fetch_array($query);

  
// html page title
$pageTitle='تعديل كلية ' . $faculty['faculty_name'];
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';
?>
<!-- page content -->

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height:600px;">
        <div class="x_title">
          <h2>الكليات</h2>
           <div class="clearfix"></div>
         </div>
         <div class="x_content">
          <form class="form-horizontal form-label-left" method='POST' action='<?php echo $updateFormAction ?>' data-parsley-validate>
                                <?php require_once('_fields.php') ?>
            <input type="hidden" name="MM_update" value="form" />
          </form>
         
          </div>
          <p>&nbsp;</p>
          

        </div>
      </div>


<!-- icheck -->

<script src="<?php echo $config['http_base_url'] ?>admin/template/js/icheck/icheck.min.js"></script>

<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>
<?php
mysql_free_result($get_faculty);
?>
