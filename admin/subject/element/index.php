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

$colname_get_all_element = "-1";
if (isset($_GET['lesid'])) {
  $colname_get_all_element = $_GET['lesid'];
}
mysql_select_db($database_dares_conn, $dares_conn);
$query_get_all_element = sprintf("SELECT * FROM subject_element WHERE element_lesson_id = %s", GetSQLValueString($colname_get_all_element, "int"));
$get_all_element = mysql_query($query_get_all_element, $dares_conn) or die(mysql_error());
$row_get_all_element = mysql_fetch_assoc($get_all_element);
$totalRows_get_all_element = mysql_num_rows($get_all_element);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p><a href="create.php?lesid=<?php echo $colname_get_all_element;?>">New</a></p>
<table border="1">
  <tr>
    <td>element_id</td>
    <td>element_title</td>
    <td>element_lesson_id</td>
    <td>element_order</td>
    <td>element_type</td>
    <td>element_value</td>
    <td>element_created_by</td>
    <td>element_created_date</td>
    <td>edit</td>
    <td>delete</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_get_all_element['element_id']; ?></td>
      <td><?php echo $row_get_all_element['element_title']; ?></td>
      <td><?php echo $row_get_all_element['element_lesson_id']; ?></td>
      <td><?php echo $row_get_all_element['element_order']; ?></td>
      <td><?php echo $row_get_all_element['element_type']; ?></td>
      <td><?php echo $row_get_all_element['element_value']; ?></td>
      <td><?php echo $row_get_all_element['element_created_by']; ?></td>
      <td><?php echo $row_get_all_element['element_created_date']; ?></td>
      <td><a href="edit.php?elemid=<?php echo $row_get_all_element['element_id']; ?>&lesid=<?php echo $row_get_all_element['element_lesson_id']; ?>">edit</a></td>
      <td><a href="delete.php?elemid=<?php echo $row_get_all_element['element_id']; ?>&lesid=<?php echo $row_get_all_element['element_lesson_id']; ?>">delete</a></td>
    </tr>
    <?php } while ($row_get_all_element = mysql_fetch_assoc($get_all_element)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($get_all_element);
?>
