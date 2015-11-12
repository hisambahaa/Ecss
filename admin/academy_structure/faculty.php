<?php require_once('../../Connections/dares_conn.php'); ?>
<?php require_once('../../Connections/config.php'); ?>
<?php require_once('../../Connections/perm.php'); ?>
<?php
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
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">اسم الكلية : </td>
      <td><span id="sprytextfield1">
        <input type="text" name="faculty_name" value="" size="32" class="form-control col-md-7 col-xs-12"/>
      <span class="textfieldRequiredMsg">*</span></span></td>

      <td align="center" valign="middle"><input type="submit" value="اضافة" class="btn btn-round btn-success"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<table align="center" class="table table-striped responsive-utilities jambo_table bulk_action">
<thead>
  <tr class="headings">
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
      <td>1</td>
      <td><?php echo $row_get_faculty['faculty_name']; ?></td>
      <td><?php echo $row_get_faculty['user_fullname']; ?></td>
      <td><?php echo $row_get_faculty['faculty_created_date']; ?></td>
      <td><a href="year.php?fid=<?php echo $row_get_faculty['faculty_id']; ?>" class="btn btn-success">السنوات الدراسية</a></td>
    </tr>
    <?php } while ($row_get_faculty = mysql_fetch_assoc($get_faculty)); ?>
</tbody>
</table>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
</div>
                            </div>
                        </div>
                    </div>
                </div>
                
<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>
<?php
mysql_free_result($get_faculty);
?>
