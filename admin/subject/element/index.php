<?php require_once('../../../config/boot.php'); ?>
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

$colname_get_all_element = "-1";
if (isset($_GET['lesid'])) {
  $colname_get_all_element = $_GET['lesid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_all_element = sprintf("SELECT * FROM subject_element WHERE element_lesson_id = %s", GetSQLValueString($colname_get_all_element, "int"));
$get_all_element = mysql_query($query_get_all_element, $dares_conn) or die(mysql_error());
$row_get_all_element = mysql_fetch_assoc($get_all_element);
$totalRows_get_all_element = mysql_num_rows($get_all_element);
?>
<?php 
// html page title
$pageTitle=$ecss_lang['Subject']['Lesson']['LIST_LESSON'] ;
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';
?>
<!-- page content -->

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height:600px;">
        <div class="x_title">
          <h2><?php echo $ecss_lang['Subject']['Element']['LIST_ELEMENT'] ?></h2>
           <div class="clearfix"></div>
         </div>
         <div class="row">
           <div class="col-md-12">
             <a href="create.php?lesid=<?php echo $colname_get_all_element;?>" class="btn btn-primary pull-left">
               <i class="fa fa-plus"></i> <?php echo $ecss_lang['ADD_NEW'] ?>
             </a>
           </div>
         </div>
          <div class="x_content">

<!--<p><a href="create.php?lesid=<?php echo $colname_get_all_element;?>">New</a></p> -->
<table class="table table-striped responsive-utilities table-bordered jambo_table bulk_action">
  <thead>
  <tr>
    <td align="center"><input type="checkbox" class='flat' id='check-all'></td>
    <td><?php echo $ecss_lang['ID'] ?></td>
    <td><?php echo $ecss_lang['Subject']['Element']['ELEMENT_NAME']; ?></td>
    <td><?php echo $ecss_lang['Subject']['Element']['ELEMENT_LESSON_VALUE']; ?></td>
    <td><?php echo $ecss_lang['ORDER'] ?></td>
    <td><?php echo $ecss_lang['TYPE'] ?></td>
    <td><?php echo $ecss_lang['Subject']['Element']['ELEMENT_VALUE']; ?></td>
    <td><?php echo $ecss_lang['CREATED_BY']; ?></td>
    <td><?php echo $ecss_lang['CREATED_DATE']; ?></td>
    <td><?php echo $ecss_lang['EDIT']; ?></td>
    <td><?php echo $ecss_lang['DELETE']; ?></td>
  </tr>
</thead>
<tbody>
  <?php do { ?>
    <tr>
      <td align="center"><input type="checkbox" name='table_records[]' class='flat'></td>
      <td><?php echo $row_get_all_element['element_id']; ?></td>
      <td><?php echo $row_get_all_element['element_title']; ?></td>
      <td><?php echo $row_get_all_element['element_lesson_id']; ?></td>
      <td><?php echo $row_get_all_element['element_order']; ?></td>
      <td><?php echo $row_get_all_element['element_type']; ?></td>
      <td><?php echo $row_get_all_element['element_value']; ?></td>
      <td><?php echo $row_get_all_element['element_created_by']; ?></td>
      <td><?php echo $row_get_all_element['element_created_date']; ?></td>
      <td>
        <a href="edit.php?elemid=<?php echo $row_get_all_element['element_id']; ?>&lesid=<?php echo $row_get_all_element['element_lesson_id']; ?>" class='btn btn-success btn-xs'>
          <i class="fa fa-edit"></i>
          <?php echo $ecss_lang['EDIT']; ?>
        </a>
      </td>
      <td>
        <a href="delete.php?elemid=<?php echo $row_get_all_element['element_id']; ?>&lesid=<?php echo $row_get_all_element['element_lesson_id']; ?>" class='btn btn-danger btn-xs'>
          <i class="fa fa-trash"></i>
      <?php echo $ecss_lang['DELETE']; ?>
        </a>
      </td>
    </tr>
    <?php }while ($row_get_all_element = mysql_fetch_assoc($get_all_element)); ?>
    </tbody>
</table>
</div>
</div>
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/validator/validator.js"></script>
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/icheck/icheck.min.js"></script>

<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>
<?php
mysql_free_result($get_all_element);
?>

