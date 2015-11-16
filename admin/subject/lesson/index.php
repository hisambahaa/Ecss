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

$colname_get_lesson = "-1";
if (isset($_GET['subid'])) {
  $colname_get_lesson = $_GET['subid'];
}

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_lesson = sprintf("SELECT * FROM subject_lesson WHERE lesson_sub_id = %s", GetSQLValueString($colname_get_lesson, "int"));
$get_lesson = mysql_query($query_get_lesson, $dares_conn) or die(mysql_error());
$row_get_lesson = mysql_fetch_assoc($get_lesson);
$totalRows_get_lesson = mysql_num_rows($get_lesson);
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
          <h2><?php echo $ecss_lang['Subject']['Lesson']['LIST_LESSON'] ?></h2>
           <div class="clearfix"></div>
         </div>
         <div class="row">
           <div class="col-md-12">
             <a href="create.php?subid=<?php echo $_GET['subid']; ?>" class="btn btn-primary pull-left">
               <i class="fa fa-plus"></i> <?php echo $ecss_lang['ADD_NEW'] ?>
             </a>
           </div>
         </div>
          <div class="x_content">
<table class="table table-striped responsive-utilities table-bordered jambo_table bulk_action">
 <thead>
  <tr>
  	<td align="center"><input type="checkbox" class='flat' id='check-all'></td>
    <td><?php echo $ecss_lang['ID'] ?></td>
    <td><?php echo $ecss_lang['Subject']['Lesson']['LESSON_NAME'] ?></td>
    <td><?php echo $ecss_lang['ORDER'] ?></td>
    <td align="center"><?php echo $ecss_lang['TYPE'] ?></td>
    <td align="center"><?php echo $ecss_lang['STATE'] ?></td>
    <td><?php echo $ecss_lang['CREATED_BY'] ?></td>
    <td><?php echo $ecss_lang['CREATED_DATE'] ?></td>
    <td align="center"><?php echo $ecss_lang['EDIT']; ?></td>
    <td align="center"><?php echo $ecss_lang['DELETE']; ?></td>
  </tr>
  </thead>
  <?php do { ?>
    <tr>
      <td align="center"><input type="checkbox" name='table_records[]' class='flat'></td>
      <td><?php echo $row_get_lesson['lesson_id']; ?></td>
      <td><?php echo $row_get_lesson['lesson_name']; ?></td>
      <td><?php echo $row_get_lesson['lesson_order']; ?></td>
      <td align="center">
	  <?php if($row_get_lesson['lesson_type']==1){
		  		echo $ecss_lang['Subject']['Lesson']['LESSON_TYPE_1'];
			}else{
			  echo $ecss_lang['Subject']['Lesson']['LESSON_TYPE_0'];} ?>
      </td>
      <td align="center">
	  <?php if($row_get_lesson['lesson_state']==1){
		  		echo '<li class="fa fa-check-circle-o btn btn-success"></li>';
		  }else{
				echo '<li class="fa fa-ban btn btn-danger"></li>';} ?>
      </td>
      <td><?php echo $row_get_lesson['lesson_created_by']; ?></td>
      <td><?php echo $row_get_lesson['lesson_created_date']; ?></td>
      <td align="center">
      <a href="edit.php?lesid=<?php echo $row_get_lesson['lesson_id']; ?>&subid=<?php echo $row_get_lesson['lesson_sub_id']; ?>" 
      	  class='btn btn-success btn-xs'>
          <i class="fa fa-edit"></i>
          <?php echo $ecss_lang['EDIT']; ?>
      </a>
      </td>
    <td align="center">
      <a href="delete.php?lesid=<?php echo $row_get_lesson['lesson_id']; ?>&subid=<?php echo $row_get_lesson['lesson_sub_id']; ?>" 
      class='btn btn-danger btn-xs'>                
      <i class="fa fa-trash"></i>
      <?php echo $ecss_lang['DELETE']; ?>
      </a>
    </td>
    </tr>
    <?php } while ($row_get_lesson = mysql_fetch_assoc($get_lesson)); ?>
</table>
<!-- icheck -->
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/validator/validator.js"></script>
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/icheck/icheck.min.js"></script>

<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?><?php
mysql_free_result($get_lesson);
?>
