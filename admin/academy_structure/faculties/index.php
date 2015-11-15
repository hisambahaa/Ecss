<?php 

require_once('../../../config/boot.php');



$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

/**  start pagination */
$pagination_per_page  = 20;
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
$pagination_total = mysql_num_rows($get_faculty_recordset);




// html page title
$pageTitle='بلانكك';
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
         <div class="row">
           <div class="col-md-12">
             <a href="create.php" class="btn btn-primary pull-left">
               <i class="fa fa-plus"></i> <?php echo $ecss_lang['ADD_NEW'] ?>
             </a>
           </div>
         </div>
          <div class="x_content">
          
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
                <td><input type="checkbox" name='table_records' class='flat'></td>
                <td>1</td>
                <td><?php echo $row_get_faculty['faculty_name']; ?></td>
                <td><?php echo $row_get_faculty['user_fullname']; ?></td>
                <td><?php echo $row_get_faculty['faculty_created_date']; ?></td>
                <td>
                  <a href="year.php?fid=<?php echo $row_get_faculty['faculty_id']; ?>" class="btn btn-default btn-xs">
                  <i class="fa fa-calendar"></i>
                   السنوات الدراسية
                   </a>
                   <a href="" class='btn btn-success btn-xs'>
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
