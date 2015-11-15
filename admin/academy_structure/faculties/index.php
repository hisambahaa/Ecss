<?php 

require_once('../../../config/boot.php');



$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}



mysql_select_db($database_dares_conn, $dares_conn);
$query_get_faculty = "SELECT academy_structure_faculty . * , sys_users.user_fullname
FROM academy_structure_faculty
INNER JOIN sys_users ON sys_users.user_id = academy_structure_faculty.faculty_created_by
ORDER BY academy_structure_faculty.faculty_id DESC";
$get_faculty = mysql_query($query_get_faculty, $dares_conn) or die(mysql_error());
$row_get_faculty = mysql_fetch_assoc($get_faculty);
$totalRows_get_faculty = mysql_num_rows($get_faculty);

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
          <div class="row">
        
          </div>
          <p>&nbsp;</p>
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
              <?php } while ($row_get_faculty = mysql_fetch_assoc($get_faculty)); ?>
            </tbody>
          </table>

        </div>
      </div>


<!-- icheck -->
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/validator/validator.js"></script>
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/icheck/icheck.min.js"></script>
<script>
 $(document).ready(function () {

                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });

                 // initialize the validator function
        validator.message['date'] = 'not a real date';

        // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
        $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);

        $('.multi.required')
            .on('keyup blur', 'input', function () {
                validator.checkField.apply($(this).siblings().last()[0]);
            });

        // bind the validation to the form submit event
        //$('#send').click('submit');//.prop('disabled', true);

        $('form').submit(function (e) {
            e.preventDefault();
            var submit = true;
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }

            if (submit)
                this.submit();
            return false;
        });
            });

 

</script>
<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>
<?php
mysql_free_result($get_faculty);
?>
