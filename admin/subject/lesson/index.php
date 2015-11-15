<?php require_once('../../../Connections/dares_conn.php'); ?>
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

$colname_get_lesson = "-1";
if (isset($_GET['subid'])) {
  $colname_get_lesson = $_GET['subid'];
}

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_lesson = sprintf("SELECT * FROM subject_lesson WHERE lesson_sub_id = %s", GetSQLValueString($colname_get_lesson, "int"));
$get_lesson = mysql_query($query_get_lesson, $dares_conn) or die(mysql_error());
$row_get_lesson = mysql_fetch_assoc($get_lesson);
$totalRows_get_lesson = mysql_num_rows($get_lesson);
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
    <td>lesson_id</td>
    <td>lesson_name</td>
    <td>lesson_sub_id</td>
    <td>lesson_order</td>
    <td>lesson_type</td>
    <td>lesson_state</td>
    <td>lesson_created_by</td>
    <td>lesson_created_date</td>
    <td>edit</td>
    <td>delete</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_get_lesson['lesson_id']; ?></td>
      <td><?php echo $row_get_lesson['lesson_name']; ?></td>
      <td><?php echo $row_get_lesson['lesson_sub_id']; ?></td>
      <td><?php echo $row_get_lesson['lesson_order']; ?></td>
      <td><?php echo $row_get_lesson['lesson_type']; ?></td>
      <td><?php echo $row_get_lesson['lesson_state']; ?></td>
      <td><?php echo $row_get_lesson['lesson_created_by']; ?></td>
      <td><?php echo $row_get_lesson['lesson_created_date']; ?></td>
    <td><a href="edit.php?lesid=<?php echo $row_get_lesson['lesson_id']; ?>&subid=<?php echo $row_get_lesson['lesson_sub_id']; ?>">edit</a></td>
    <td><a href="delete.php?lesid=<?php echo $row_get_lesson['lesson_id']; ?>&subid=<?php echo $row_get_lesson['lesson_sub_id']; ?>">delete</a></td>
    </tr>
    <?php } while ($row_get_lesson = mysql_fetch_assoc($get_lesson)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($get_lesson);
?>
