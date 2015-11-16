<?php 

require_once('../../../config/boot.php');
use \McKay\Flash;

$input = array_merge($_GET ,$_POST);

$action = $input['action'];

$year_id = (!empty($input['table_records']) and is_array($input['table_records'])) ? $input['table_records'][0] : $input['year_id'];

if(!$yearRow = db_row_exists('academy_structure_year' ,'year_id',$year_id ,['year_name'])) {
  Flash::warning(trans('ACADEMY_STRUCTURE.YEAR.YEAR_DONT_EXISTS'));
  header('location:index.php');
  exit;
}


if(empty($action)) header('location:index.php');

if($action=='delete') {
	$year_id =  GetSQLValueString($input['year_id'], "int");

	$delete = sprintf("DELETE FROM academy_structure_year WHERE year_id=%s",$year_id);

	mysql_select_db($database_dares_conn, $dares_conn);

	$result = mysql_query($delete, $dares_conn) or die(mysql_error());

	if($result) {
	    Flash::success($ecss_lang['ACADEMY_STRUCTURE']['YEAR']['DELETE_SUCCESS']);
	} else {
		Flash::success($ecss_lang['ACADEMY_STRUCTURE']['YEAR']['DELETE_ERROR']);
	}

}


if($action=='mass-delete') {

  mysql_select_db($database_dares_conn, $dares_conn);

  $ids = implode(",",$input['table_records']);

  $delete = sprintf('DELETE FROM academy_structure_year WHERE year_id IN(%s)' ,$ids);

  $query = mysql_query($delete);

  if($query) {
  	Flash::success($ecss_lang['ACADEMY_STRUCTURE']['YEAR']['MASS_DELETE_SUCCESS']);
  } else {
  	Flash::error($ecss_lang['ACADEMY_STRUCTURE']['YEAR']['MASS_DELETE_ERROR']);
  }
}

 header('location:index.php?faculty_id=' . $yearRow['year_faculty_id']);
    exit;