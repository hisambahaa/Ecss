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
$query_get_permission = "SELECT * FROM sys_permission";
$get_permission = mysql_query($query_get_permission, $dares_conn) or die(mysql_error());
$row_get_permission = mysql_fetch_assoc($get_permission);
$totalRows_get_permission = mysql_num_rows($get_permission);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<a href="create.php">new</a>
<table border="1">
  <tr>
    <td>prem_id</td>
    <td>prem_name</td>
    <td>prem_url</td>
    <td>prem_categ_id</td>
    <td>prem_role_ids</td>
    <td>prem_created_date</td>
    <td>prem_created_by</td>
    <td>edit</td>
    <td>delete</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_get_permission['prem_id']; ?></td>
      <td><?php echo $row_get_permission['prem_name']; ?></td>
      <td><?php echo $row_get_permission['prem_url']; ?></td>
      <td><?php echo $row_get_permission['prem_categ_id']; ?></td>
      <td><?php echo $row_get_permission['prem_role_ids']; ?></td>
      <td><?php echo $row_get_permission['prem_created_date']; ?></td>
      <td><?php echo $row_get_permission['prem_created_by']; ?></td>
   	<td><a href="edit.php?permid=<?php echo $row_get_permission['prem_id']; ?>">edit</a></td>
      <td><a href="delete.php?prem_id=<?php echo $row_get_permission['prem_id']; ?>">delete</a></td>
    </tr>
    <?php } while ($row_get_permission = mysql_fetch_assoc($get_permission)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($get_permission);
?>
