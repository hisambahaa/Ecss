<?php require_once('../Connections/dares_conn.php'); ?>
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

$maxRows_get_faculty = 7;
$pageNum_get_faculty = 0;
if (isset($_GET['pageNum_get_faculty'])) {
  $pageNum_get_faculty = $_GET['pageNum_get_faculty'];
}
$startRow_get_faculty = $pageNum_get_faculty * $maxRows_get_faculty;

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_faculty = "SELECT * FROM academy_structure_faculty";
$query_limit_get_faculty = sprintf("%s LIMIT %d, %d", $query_get_faculty, $startRow_get_faculty, $maxRows_get_faculty);
$get_faculty = mysql_query($query_limit_get_faculty, $dares_conn) or die(mysql_error());
$row_get_faculty = mysql_fetch_assoc($get_faculty);

if (isset($_GET['totalRows_get_faculty'])) {
  $totalRows_get_faculty = $_GET['totalRows_get_faculty'];
} else {
  $all_get_faculty = mysql_query($query_get_faculty);
  $totalRows_get_faculty = mysql_num_rows($all_get_faculty);
}
$totalPages_get_faculty = ceil($totalRows_get_faculty/$maxRows_get_faculty)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="1">
  <tr>
    <td>faculty_id</td>
    <td>faculty_name</td>
    <td>faculty_created_by</td>
    <td>faculty_created_date</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_get_faculty['faculty_id']; ?></td>
      <td><?php echo $row_get_faculty['faculty_name']; ?></td>
      <td><?php echo $row_get_faculty['faculty_created_by']; ?></td>
      <td><?php echo $row_get_faculty['faculty_created_date']; ?></td>
    </tr>
    <?php } while ($row_get_faculty = mysql_fetch_assoc($get_faculty)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($get_faculty);
?>
