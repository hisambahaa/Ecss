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


$per_page = 5;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_recordset = $page * $per_page;

mysql_select_db($database_dares_conn, $dares_conn);
$query = "SELECT * FROM academy_structure_faculty";
$query_limit = sprintf("%s LIMIT %d, %d", $query, $startRow_recordset, $per_page);
$recordset = mysql_query($query_limit, $dares_conn) or die(mysql_error());
$row_recordset = mysql_fetch_assoc($recordset);


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
      <td><?php echo $row_recordset['faculty_id']; ?></td>
      <td><?php echo $row_recordset['faculty_name']; ?></td>
      <td><?php echo $row_recordset['faculty_created_by']; ?></td>
      <td><?php echo $row_recordset['faculty_created_date']; ?></td>
    </tr>
    <?php } while ($row_recordset = mysql_fetch_assoc($recordset)); ?>
</table>

</body>
</html>
<?php
mysql_free_result($recordset);
?>
