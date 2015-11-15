<?php 

require_once('../../../config/boot.php');
use \McKay\Flash;


$createFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $createFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  
  $faculty_name =  GetSQLValueString($_POST['faculty_name'], "text");
  $user_id = GetSQLValueString($_SESSION['User_id'], "int");

  if(empty($faculty_name)) {
    header('location: create.php');
    exit;
  }
  $insert = sprintf("INSERT INTO academy_structure_faculty (faculty_name, faculty_created_by) VALUES (%s, %s)",
   $faculty_name,
   $user_id);

  

  mysql_select_db($database_dares_conn, $dares_conn);
  $result = mysql_query($insert, $dares_conn) or die(mysql_error());
  if($result) {
    Flash::success($ecss_lang['ACADEMY_STRUCTURE']['FACULTY']['ADD_SUCCESS']);
    header('location: index.php');
    exit;
  }
  
}


// html page title
$pageTitle='إضافة كلية';
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
          <form class="form-horizontal form-label-left" method='POST' action='<?php echo $createFormAction ?>' data-parsley-validate>
                                <?php require_once('_fields.php') ?>
            <input type="hidden" name="MM_insert" value="form1" />
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
