<?php require_once('../../Connections/dares_conn.php'); ?>
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<a href="../role/create.php">new role</a>
<table border="1">
  <tr>
    <td>role_id</td>
    <td>role_name</td>
    <td>role_created_date</td>
    <td>role_created_by</td>
    <td>edit</td>
    <td>delete</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_get_role['role_id']; ?></td>
      <td><?php echo $row_get_role['role_name']; ?></td>
      <td><?php echo $row_get_role['role_created_date']; ?></td>
      <td><?php echo $row_get_role['role_created_by']; ?></td>
      <td><a href="../role/edit.php?roleid=<?php echo $row_get_role['role_id']; ?>">edit</a></td>
      <td><a href="../role/delete.php?roleid=<?php echo $row_get_role['role_id']; ?>">delete</a></td>
    </tr>
    <?php } while ($row_get_role = mysql_fetch_assoc($get_role)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($get_role);
?>
