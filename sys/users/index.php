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
$query_Recordset1 = "SELECT * FROM sys_users";
$Recordset1 = mysql_query($query_Recordset1, $dares_conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p><a href="create.php">New</a></p>
<table border="1">
  <tr>
    <td>user_id</td>
    <td>user_name</td>
    <td>user_pwd</td>
    <td>user_role_ids</td>
    <td>user_fullname</td>
    <td>user_email</td>
    <td>user_mobile</td>
    <td>user_photo</td>
    <td>user_state</td>
    <td>user_sex</td>
    <td>user_last_login</td>
    <td>user_created_date</td>
    <td>user_created_by</td>
    <td>edit</td>
    <td>delete</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['user_id']; ?></td>
      <td><?php echo $row_Recordset1['user_name']; ?></td>
      <td><?php echo $row_Recordset1['user_pwd']; ?></td>
      <td><?php echo $row_Recordset1['user_role_ids']; ?></td>
      <td><?php echo $row_Recordset1['user_fullname']; ?></td>
      <td><?php echo $row_Recordset1['user_email']; ?></td>
      <td><?php echo $row_Recordset1['user_mobile']; ?></td>
      <td><?php echo $row_Recordset1['user_photo']; ?></td>
      <td><?php echo $row_Recordset1['user_state']; ?></td>
      <td><?php echo $row_Recordset1['user_sex']; ?></td>
      <td><?php echo $row_Recordset1['user_last_login']; ?></td>
      <td><?php echo $row_Recordset1['user_created_date']; ?></td>
      <td><?php echo $row_Recordset1['user_created_by']; ?></td>
    <td><a href="edit.php?userid=<?php echo $row_Recordset1['user_id']; ?>">edit</a></td>
    <td><a href="delete.php?userid=<?php echo $row_Recordset1['user_id']; ?>">delete</a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
