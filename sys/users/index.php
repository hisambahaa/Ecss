<?php require_once('../../config/boot.php'); ?>
<?php
mysql_select_db($database_dares_conn, $dares_conn);
$query_Recordset1 = "SELECT * FROM sys_users";
$Recordset1 = mysql_query($query_Recordset1, $dares_conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php 
// html page title
$pageTitle=$ecss_lang['sys']['User']['LIST_USER'] ;
// require page header
require_once $config['base_url'].'/admin/template/includes/header.php';
?>
<!-- page content -->

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height:600px;">
        <div class="x_title">
          <h2><?php echo $ecss_lang['sys']['User']['LIST_USER'] ?></h2>
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
<table class="table table-striped responsive-utilities table-bordered jambo_table bulk_action">
 <thead>
  <tr>
  	<td align="center"><input type="checkbox" class='flat' id='check-all'></td>
    <td><?php echo $ecss_lang['ID'] ?></td>
    <td><?php echo $ecss_lang['NAME'] ?></td>
    <td><?php echo $ecss_lang['EMAIL'] ?></td>
    <td><?php echo $ecss_lang['PHONE'] ?></td>
    <td align="center"><?php echo $ecss_lang['STATE'] ?></td>
    <td><?php echo $ecss_lang['SEX'] ?></td>
    <td>user_last_login</td>
    <td align="center"><?php echo $ecss_lang['EDIT'] ?></td>
    <td align="center"><?php echo $ecss_lang['DELETE'] ?></td>
  </tr>
  </thead>
  <?php do { ?>
    <tr>
      <td align="center"><input type="checkbox" name='table_records[]' class='flat'></td>
      <td><?php echo $row_Recordset1['user_id']; ?></td>
      <td><?php echo $row_Recordset1['user_fullname']; ?></td>
      <td><?php echo $row_Recordset1['user_email']; ?></td>
      <td><?php echo $row_Recordset1['user_mobile']; ?></td>
      <td align="center"><?php if($row_Recordset1['user_state']==1){
		   echo '<li class="fa fa-check-circle-o text-success"></li>';
		  }else{
				echo '<li class="fa fa-ban text-danger"></li>';} ?> 
      </td>
      <td>
		  <?php if($row_Recordset1['user_sex']==1){
              echo $ecss_lang['MALE'];
          }else{
			  echo $ecss_lang['FEMALE'];
          } ?>
      </td>
      <td><?php echo $row_Recordset1['user_last_login']; ?></td>
    <td>
    	<a href="edit.php?userid=<?php echo $row_Recordset1['user_id']; ?>"class='btn btn-success btn-xs'>
          <i class="fa fa-edit"></i>
        <?php echo $ecss_lang['EDIT']; ?>          
        </a>
    </td>
    <td>
      	<a href="delete.php?userid=<?php echo $row_Recordset1['user_id']; ?>" class='btn btn-danger btn-xs'>                
        <i class="fa fa-trash"></i>
        <?php echo $ecss_lang['DELETE']; ?>
        </a>
      </td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>

<!-- icheck -->
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/validator/validator.js"></script>
<script src="<?php echo $config['http_base_url'] ?>admin/template/js/icheck/icheck.min.js"></script>

<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>
<?php
mysql_free_result($Recordset1);
?>
