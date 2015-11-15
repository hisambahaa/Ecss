<?php 

require_once('../../config/boot.php');

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO academy_structure_year (year_name, year_faculty_id, year_created_by) VALUES (%s, %s, %s)",
   GetSQLValueString($_POST['year_name'], "text"),
   GetSQLValueString($_POST['year_faculty_id'], "int"),
   GetSQLValueString($_SESSION['User_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE academy_structure_year SET year_name=%s WHERE year_id=%s",
   GetSQLValueString($_POST['year_name'], "text"),
   GetSQLValueString($_POST['year_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
}

$colname_get_year = "-1";
if (isset($_GET['fid'])) {
  $colname_get_year = $_GET['fid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_year = sprintf("SELECT * FROM academy_structure_year WHERE year_faculty_id = %s", GetSQLValueString($colname_get_year, "int"));
$get_year = mysql_query($query_get_year, $dares_conn) or die(mysql_error());
$row_get_year = mysql_fetch_assoc($get_year);
$totalRows_get_year = mysql_num_rows($get_year);
// html page title
$pageTitle='بلانكك';
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';

?>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel" style="min-height:600px;">
    <div class="x_title">
    <h2>السنوات الدراسية</h2>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>

    <br>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-md-offset-3">
          <div class="input-group">

           <input type="text" class='form-control' name="year_name" id='year_name' value="" size="32" />
           <span class="input-group-btn">
             <button class="btn btn-success">
               <i class="fa fa-plus"></i> <?php echo $ecss_lang['ADD_NEW'] ?>
             </button>
           </span>
         </div>
       </div>
     </div>
<br>
     <input type="hidden" name="year_faculty_id" value="<?php echo $_GET['fid']; ?>" />
     <input type="hidden" name="MM_insert" value="form1" />
   </form>


   <div class="x_content">
    <table id="example" class="table table-striped responsive-utilities jambo_table">
      <thead>
        <tr class="headings">
          <th>
            <input type="checkbox" class="tableflat">
          </th>
          <th> </th>
          <th> </th>

          <th class=" no-link last"><span class="nobr"><?php echo $ecss_lang['ACTIONS']; ?></span>
          </th>
        </tr>
      </thead>

      <tbody>
        <?php do { ?>
        <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
          <tr class="even pointer">
            <td class="a-center ">
              <input type="checkbox" class="tableflat">
            </td>
            <td><input type="text" class='form-control' name="year_name" value="<?php echo htmlentities($row_get_year['year_name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
            <td>
            <button type="submit" class='btn btn-success btn-xs' >
              <i class="fa fa-save"></i> <?php echo $ecss_lang['SAVE_UPDATES'] ?>
            </button>
            </td>
            <td>
              <a class='btn btn-info btn-xs' href="term.php?yid=<?php echo $row_get_year['year_id']; ?>">
              <i class="fa fa-group"></i> <?php echo $ecss_lang['TERM']; ?>
              </a>
              <input type="hidden" name="MM_update" value="form2" />
              <input type="hidden" name="year_id" value="<?php echo $row_get_year['year_id']; ?>" />
            </td>
          </tr>
        </form>
        <?php } while ($row_get_year = mysql_fetch_assoc($get_year)); ?>
      </tbody>
    </table>
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
mysql_free_result($get_year);
?>
