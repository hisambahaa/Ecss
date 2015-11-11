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

  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['User_id'] = NULL;
  $_SESSION['User_name'] = NULL;
  $_SESSION['User_roles'] = NULL;
  $_SESSION['User_last_login'] = NULL;
  $_SESSION['User_state'] = NULL;
  $_SESSION['User_photo'] = NULL;
  $_SESSION['User_mobile'] = NULL;
  $_SESSION['User_sex'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['User_id']);
  unset($_SESSION['User_name']);
  unset($_SESSION['User_roles']);
  unset($_SESSION['User_last_login']);
  unset($_SESSION['User_state']);
  unset($_SESSION['User_photo']);
  unset($_SESSION['User_mobile']);
  unset($_SESSION['User_sex']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
?>