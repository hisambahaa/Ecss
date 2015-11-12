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
$url = str_replace('/'.$config['project_folder'],'',$_SERVER['PHP_SELF']);

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_prem_by_self_page = sprintf("SELECT prem_role_ids FROM sys_permission WHERE prem_url = %s",
GetSQLValueString($url,"text"));
$get_prem_by_self_page = mysql_query($query_get_prem_by_self_page, $dares_conn) or die(mysql_error());
$row_get_prem_by_self_page = mysql_fetch_assoc($get_prem_by_self_page);
$totalRows_get_prem_by_self_page = mysql_num_rows($get_prem_by_self_page);


$MM_authorizedUsers =  $row_get_prem_by_self_page['prem_role_ids'];
$MM_donotCheckaccess = "false";



$MM_restrictGoTo = "access_fail.php";
if (!((isset($_SESSION['User_name'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['User_name'], $_SESSION['User_roles'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}

?>