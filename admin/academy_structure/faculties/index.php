<?php 

require_once('../../../config/boot.php');

$input = array_merge($_GET ,$_POST);


/**  start pagination */
$pagination_per_page  = 10;
$pagination_target    = 'index.php';
$page                 = 0;
if (isset($_GET['page'])) $page = $_GET['page'];
$pagination_start     = $page * $pagination_per_page;
/** end pagination */

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_faculty = "SELECT academy_structure_faculty . * , sys_users.user_fullname
FROM academy_structure_faculty
INNER JOIN sys_users ON sys_users.user_id = academy_structure_faculty.faculty_created_by
ORDER BY academy_structure_faculty.faculty_id DESC";
$query_get_faculty_limit = sprintf("%s LIMIT %d, %d", $query_get_faculty, $pagination_start, $pagination_per_page);
$get_faculty_recordset = mysql_query($query_get_faculty, $dares_conn) or die(mysql_error());
$get_faculty_recordset_limit = mysql_query($query_get_faculty_limit, $dares_conn) or die(mysql_error());

$row_get_faculty = mysql_fetch_assoc($get_faculty_recordset_limit);
$total = mysql_num_rows($get_faculty_recordset_limit);
$pagination_total = mysql_num_rows($get_faculty_recordset);




// html page title
$pageTitle='الكليات';
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
          <?php 
          generate_breadcrumbs([
          $ecss_lang['HOME']=>'admin/index.php',
          'الهيكل'=>'admin/academy_structure/faculties/index.php',
          $pageTitle=>'admin/academy_structure/faculties/index.php',

          ]) ?>
          <div class="row">
           <div class="col-md-12">
             <a href="create.php" class="btn btn-primary pull-left">
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
                <td><input type="checkbox" value='<?php echo $row_get_faculty['faculty_id']; ?>' name='table_records[]' class='flat'></td>
                <td><?php echo $row_get_faculty['faculty_id']; ?></td>
                <td><?php echo $row_get_faculty['faculty_name']; ?></td>
                <td><?php echo $row_get_faculty['user_fullname']; ?></td>
                <td><?php echo $row_get_faculty['faculty_created_date']; ?></td>
                <td>
                  <a href="../years/index.php?faculty_id=<?php echo $row_get_faculty['faculty_id']; ?>" class="btn btn-default btn-xs">
                  <i class="fa fa-calendar"></i>
                   السنوات الدراسية
                   </a>
                   <a href="edit.php?faculty_id=<?php echo $row_get_faculty['faculty_id'] ?>" class='btn btn-success btn-xs'>
                    <i class="fa fa-edit"></i>
                     <?php echo $ecss_lang['EDIT'] ?>
                   </a>
                   <a href="delete.php?faculty_id=<?php echo $row_get_faculty['faculty_id'] ?>" class='btn btn-danger btn-xs'>
                    <i class="fa fa-trash"></i>
                     <?php echo $ecss_lang['DELETE'] ?>
                   </a>
                  </td>
              </tr>
              <?php } while ($row_get_faculty = mysql_fetch_assoc($get_faculty_recordset_limit)); ?>
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
mysql_free_result($get_faculty_recordset_limit);
?>
