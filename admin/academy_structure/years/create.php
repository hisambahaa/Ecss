<?php 

require_once('../../../config/boot.php');
use \McKay\Flash;


$input = array_merge($_GET ,$_POST);
$faculty_id = $input['faculty_id'];

if(!$facultyRow = db_row_exists('academy_structure_faculty' ,'faculty_id',$faculty_id ,['faculty_name'])) {
  Flash::warning(trans('ACADEMY_STRUCTURE.YEAR.FACULTY_DONT_EXIST'));
  header('location:../faculties/index.php');
  exit;
}


$createFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $createFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  
  $year_name =  GetSQLValueString($_POST['year_name'], "text");
  $user_id = GetSQLValueString($_SESSION['User_id'], "int");

  if(empty($year_name)) {
    header('location: create.php');
    exit;
  }
  $insert = sprintf("INSERT INTO academy_structure_year (year_name,year_faculty_id, year_created_by) VALUES (%s ,%s ,%s)",
   $year_name,
   $facultyRow['faculty_id'],
   $user_id);

  
  $result = mysql_query($insert, $dares_conn) or die(mysql_error());
  if($result) {
    Flash::success($ecss_lang['ACADEMY_STRUCTURE']['YEAR']['ADD_SUCCESS']);
    header('location: index.php?faculty_id=' . $facultyRow['faculty_id']);
    exit;
  }
  
}


// html page title
$pageTitle='إضافة سنة';
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';
?>
<!-- page content -->

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height:600px;">
        <div class="x_title">
          <h2><?php echo trans('ACADEMY_STRUCTURE.YEAR.YEARS') ?></h2>
           <div class="clearfix"></div>
         </div>
         <div class="x_content">
          <form class="form-horizontal form-label-right" method='POST' action='<?php echo $createFormAction ?>' data-parsley-validate>
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
