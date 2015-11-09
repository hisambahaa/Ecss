<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['User_id'] = NULL;
  $_SESSION['User_name'] = NULL;
  $_SESSION['User_roles'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['User_id']);
  unset($_SESSION['User_name']);
  unset($_SESSION['User_roles']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<a href="<?php echo $logoutAction ?>">logout</a>
<table width="100%" border="0">
  <tr>
    <td><?php echo $_SESSION['User_name']; ?></td>
    <td><?php echo $_SESSION['User_id']; ?></td>
    <td><?php echo $_SESSION['User_roles']; ?></td>
  </tr>
</table>


</body>
</html>