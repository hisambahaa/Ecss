<?php 
require_once('../../Connections/boot.php');

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO academy_structure_faculty (faculty_name, faculty_created_by) VALUES (%s, %s)",
   GetSQLValueString($_POST['faculty_name'], "text"),
   GetSQLValueString($_SESSION['User_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
}

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_faculty = "SELECT academy_structure_faculty . * , sys_users.user_fullname
FROM academy_structure_faculty
INNER JOIN sys_users ON sys_users.user_id = academy_structure_faculty.faculty_created_by";
$get_faculty = mysql_query($query_get_faculty, $dares_conn) or die(mysql_error());
$row_get_faculty = mysql_fetch_assoc($get_faculty);
$totalRows_get_faculty = mysql_num_rows($get_faculty);
?>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<?php
$pageTitle='بلانكك';
require_once $config['base_url'].'/admin/template/includes/header.php'; ?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height:600px;">
        <div class="x_title">
          <h2>الكليات</h2>
           <div class="clearfix"></div>
         </div>
         
          <div class="row">
          <div class="col-sm-12 col-md-6 col-lg-6">
          <form action="<?php echo $editFormAction; ?>" method="post" class='form-group' name="form1" id="form1">
            <label class="col-sm-3 control-label">إسم الكلية</label>
            <div class="input-group">
              <input type="text" name="faculty_name" id="faculty_name" class="form-control">
              <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">اضافة</button> 
              </span>
            </div>

            <input type="hidden" name="MM_insert" value="form1" />
          </form>
          </div>
          </div>
          <p>&nbsp;</p>
          <table align="center" class="table table-striped responsive-utilities jambo_table bulk_action">
            <thead>
              <tr class="headings">
                <td></td>
                <td>رقم</td>
                <td>اسم</td>
                <td>بواسطة </td>
                <td>تاريخ الانشاء</td>
                <td>السنوات الدراسية</td>
              </tr>
            </thead>
            <tbody>
              <?php do { ?>
              <tr>
                <td><input type="checkbox" class='tableflat'></td>
                <td>1</td>
                <td><?php echo $row_get_faculty['faculty_name']; ?></td>
                <td><?php echo $row_get_faculty['user_fullname']; ?></td>
                <td><?php echo $row_get_faculty['faculty_created_date']; ?></td>
                <td>
                  <a href="year.php?fid=<?php echo $row_get_faculty['faculty_id']; ?>" class="btn btn-success">
                  <i class="fa fa-calendar"></i>
                   السنوات الدراسية
                   </a>
                   <a href="" class='btn btn-info'>
                    <i class="fa fa-edit"></i>
                     تعديل
                   </a>
                   <a href="" class='btn btn-danger'>
                    <i class="fa fa-remove"></i>
                     تعديل
                   </a>
                  </td>
              </tr>
              <?php } while ($row_get_faculty = mysql_fetch_assoc($get_faculty)); ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>

 <!-- icheck -->
        <script src="<?php echo $config['http_base_url'] ?>admin/template/js/icheck/icheck.min.js"></script>
<script>
 $(document).ready(function () {

                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });
</script>
<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>
<?php
mysql_free_result($get_faculty);
?>
