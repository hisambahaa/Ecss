<?php require_once('../../config/boot.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_role = "SELECT * FROM sys_role";
$get_role = mysql_query($query_get_role, $dares_conn) or die(mysql_error());
$row_get_role = mysql_fetch_assoc($get_role);
$totalRows_get_role = mysql_num_rows($get_role);
?>
<?php 
// html page title
$pageTitle='المجموعات';
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';
?>
<!-- page content -->

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height:600px;">
        <div class="x_title">
          <h2>قائمة المجموعات</h2>
           <div class="clearfix"></div>
         </div>
         <div class="row">
           <div class="col-md-12">
             <a href="create.php" class="btn btn-primary pull-left">
               <i class="fa fa-plus"></i> <?php echo $ecss_lang['sys']['Role']['ADD_ROLE'] ?>
             </a>
           </div>
         </div>
          <div class="x_content">
          
<table class="table table-striped responsive-utilities jambo_table bulk_action">
<thead>
    <tr class="headings">
  <th><input type="checkbox" id="check-all" class="flat"></th>
    <th><?php echo $ecss_lang['ID'] ?></th>
    <th><?php echo $ecss_lang['sys']['Role']['ROLE_NAME'] ?></th>
    <th><?php echo $ecss_lang['CREATED_DATE'] ?></th>
    <th><?php echo $ecss_lang['CREATED_BY'] ?></th>
    <th style="text-align:center !important"><?php echo $ecss_lang['EDIT'] ?></th>
    <th style="text-align:center !important"><?php echo $ecss_lang['DELETE'] ?></th>
  </tr>
  </thead>
  <tbody>
  <?php do { ?>
    <tr  class="even pointer">
      <td class="a-center"><input type="checkbox" class="flat" name="table_records" ></td>
      <td><?php echo $row_get_role['role_id']; ?></td>
      <td><?php echo $row_get_role['role_name']; ?></td>
      <td><?php echo $row_get_role['role_created_date']; ?></td>
      <td><?php echo $row_get_role['role_created_by']; ?></td>
      <td style="text-align:center !important">
        <a href="edit.php?roleid=<?php echo $row_get_role['role_id']; ?>" class='btn btn-success btn-xs'>
          <?php echo $ecss_lang['EDIT'] ?>  <i class="fa fa-edit"></i>
        </a>
      </td>
      <td style="text-align:center !important">
        <a href="delete.php?roleid=<?php echo $row_get_role['role_id']; ?>" class='btn btn-danger btn-xs'>
        <?php echo $ecss_lang['DELETE'] ?> <i class="fa fa-trash"></i> 
        </a>
      </td>
    </tr>
    <?php } while ($row_get_role = mysql_fetch_assoc($get_role)); ?>
    </tbody>
</table>
<!-- icheck -->
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/validator/validator.js"></script>
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/icheck/icheck.min.js"></script>

<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>
<?php
mysql_free_result($get_role);
?>
