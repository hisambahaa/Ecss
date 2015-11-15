<?php 

require_once('../../../config/boot.php');
use \McKay\Flash;

$faculty_id =  GetSQLValueString($_POST['faculty_id'], "int");

$delete = sprintf("DELETE FROM academy_structure_faculty WHERE faculty_id=%s",$faculty_id);

mysql_select_db($database_dares_conn, $dares_conn);

$result = mysql_query($delete, $dares_conn) or die(mysql_error());

if($result) {
    Flash::success($ecss_lang['ACADEMY_STRUCTURE']['FACULTY']['DELETE_SUCCESS']);
} else {
	Flash::success($ecss_lang['ACADEMY_STRUCTURE']['FACULTY']['DELETE_ERROR']);
}

header('location: index.php');
exit;