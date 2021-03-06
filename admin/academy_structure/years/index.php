<?php 

require_once('../../../config/boot.php');
use \McKay\Flash;

$input = array_merge($_GET ,$_POST);
$faculty_id = $input['faculty_id'];
/**  start pagination */
$pagination_per_page  = 10;
$pagination_target    = 'index.php';
$page                 = 0;
if (isset($_GET['page'])) $page = $_GET['page'];
$pagination_start     = $page * $pagination_per_page;
/** end pagination */



// check if the faculty exists first
if(!$facultyRow = db_row_exists('academy_structure_faculty' ,'faculty_id',$faculty_id ,['faculty_name'])) {
  Flash::warning(trans('ACADEMY_STRUCTURE.YEAR.FACULTY_DONT_EXIST'));
  header('location:../faculties/index.php');
  exit;
}


$query_get_year = sprintf("SELECT year_name,user_fullname ,year_id,year_name,year_created_date,
    year_faculty_id FROM academy_structure_year asy 
  LEFT JOIN academy_structure_faculty asf ON asy.year_faculty_id=asf.faculty_id 
  LEFT JOIN sys_users su ON asy.year_created_by=su.user_id 
  WHERE year_faculty_id = %s GROUP BY asy.year_id"
  , GetSQLValueString($faculty_id, "int"));
$query_get_year_limit = sprintf("%s LIMIT %d, %d", $query_get_year, $pagination_start, $pagination_per_page);
$get_year_recordset = mysql_query($query_get_year, $dares_conn) or die(mysql_error());

$get_year_recordset_limit = mysql_query($query_get_year_limit, $dares_conn) or die(mysql_error());
$row_get_year = mysql_fetch_assoc($get_year_recordset_limit);
$total = mysql_num_rows($get_year_recordset_limit);
$pagination_total = mysql_num_rows($get_year_recordset_limit);


// html page title
$pageTitle='السنوات الدراسية';
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';
?>
<!-- page content -->

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height:600px;">
        <div class="x_title">
          <h2><?php echo $pageTitle ?></h2>
           <div class="clearfix"></div>
         </div>
         
          <div class="x_content">
          <?php 
          generate_breadcrumbs([
          trans('HOME')=>'admin/index.php',
          trans('ACADEMY_STRUCTURE.STRUCTURE')=>'admin/academy_structure/faculties/index.php',
          trans('ACADEMY_STRUCTURE.FACULTY.FACULTIES')=>'admin/academy_structure/faculties/index.php',
          $facultyRow['faculty_name']=>'admin/academy_structure/faculties/edit.php?faculty_id='.$facultyRow['faculty_id'],
          trans('ACADEMY_STRUCTURE.YEAR.YEARS')=>'admin/academy_structure/years/index.php',
          ]) ?>
          <div class="row">
           <div class="col-md-12">
             <a href="create.php?faculty_id=<?php echo $facultyRow['faculty_id'] ?>" class="btn btn-primary pull-left">
               <i class="fa fa-plus"></i> <?php echo $ecss_lang['ADD_NEW'] ?>
             </a>
             <div class="clearfix"></div>
             <br>
           </div>
         </div>
          <?php if(!empty($total)): ?>
            <form action="delete.php?action=mass-delete" method='POST'>
          <table align="center" class="table table-striped responsive-utilities table-bordered jambo_table bulk_action">
            <thead>
              <tr class="headings">
                <th><input type="checkbox" class='flat' id='check-all'></th>
                <th>رقم</th>
                <th>اسم</th>
                <th>بواسطة </th>
                <th>تاريخ الانشاء</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php do { ?>
              <tr>
                <td><input type="checkbox" value='<?php echo $row_get_year['year_id']; ?>' name='table_records[]' class='flat'></td>
                <td><?php echo $row_get_year['year_id']; ?></td>
                <td><?php echo $row_get_year['year_name']; ?></td>
                <td><?php echo $row_get_year['user_fullname']; ?></td>
                <td><?php echo $row_get_year['year_created_date']; ?></td>
                <td>
                  <a href="../terms/index.php?year_id=<?php echo $row_get_year['year_id']; ?>" class="btn btn-default btn-xs">
                  <i class="fa fa-calendar"></i>
                   <?php echo trans('ACADEMY_STRUCTURE.TERM.TERMS') ?>
                   </a>
                   <a href="edit.php?year_id=<?php echo $row_get_year['year_id'] ?>&faculty_id=<?php echo $row_get_year['year_faculty_id'] ?>" class='btn btn-success btn-xs'>
                    <i class="fa fa-edit"></i>
                     <?php echo $ecss_lang['EDIT'] ?>
                   </a>
                   <a href="delete.php?year_id=<?php echo $row_get_year['year_id'] ?>&action=delete" class='btn btn-danger btn-xs'>
                    <i class="fa fa-trash"></i>
                     <?php echo $ecss_lang['DELETE'] ?>
                   </a>
                  </td>
              </tr>
              <?php } while ($row_get_year = mysql_fetch_assoc($get_year_recordset_limit)); ?>
            </tbody>
          </table>
          <button class="btn btn-danger">
            <i class="fa fa-trash"></i>
            <?php echo $ecss_lang['DELETE_ALL'] ?>
          </button>
          <input type="hidden" name='action' value='mass-delete'>
          </form>


        <?php else: ?>
          <div class="alert alert-info">
            <i class="fa fa-info-circle"></i> <?php echo $ecss_lang['ACADEMY_STRUCTURE']['FACULTY']['NO_ITEMS'] ?>
          </div>
        <?php endif; ?>

          <?php generate_pagination($pagination_target ,$pagination_total ,$pagination_per_page); ?>
</div>
        </div>
      </div>


<!-- icheck -->
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/validator/validator.js"></script>
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/icheck/icheck.min.js"></script>

<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>
<?php
mysql_free_result($get_year_recordset_limit);
?>
