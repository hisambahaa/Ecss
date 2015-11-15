<?php 

require_once('../../../config/boot.php');
use \McKay\Flash;

$input = array_merge($_GET ,$_POST);

$action = $input['action'];

if(empty($action)) header('location:index.php');

if($action=='delete') {
	$faculty_id =  GetSQLValueString($input['faculty_id'], "int");

	$delete = sprintf("DELETE FROM academy_structure_faculty WHERE faculty_id=%s",$faculty_id);

	mysql_select_db($database_dares_conn, $dares_conn);

	$result = mysql_query($delete, $dares_conn) or die(mysql_error());

	if($result) {
	    Flash::success($ecss_lang['ACADEMY_STRUCTURE']['FACULTY']['DELETE_SUCCESS']);
	} else {
		Flash::success($ecss_lang['ACADEMY_STRUCTURE']['FACULTY']['DELETE_ERROR']);
	}

}


if($action=='mass-delete') {

  mysql_select_db($database_dares_conn, $dares_conn);

  $ids = implode(",",$input['table_records']);

  $delete = sprintf('DELETE FROM academy_structure_faculty WHERE faculty_id IN(%s)' ,$ids);

  $query = mysql_query($delete);

  if($query) {
  	Flash::success($ecss_lang['ACADEMY_STRUCTURE']['FACULTY']['MASS_DELETE_SUCCESS']);
  } else {
  	Flash::error($ecss_lang['ACADEMY_STRUCTURE']['FACULTY']['MASS_DELETE_ERROR']);
  }
}

 header('location:index.php');
    exit;