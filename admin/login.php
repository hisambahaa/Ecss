<?php 

if(isset($_SESSION['User_id'])) header('location:'.$config['http_base_url']."admin/index.php");

require_once('../Connections/boot.php');


//require_once("../Connections/composer.php");

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

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['user_name'])) {
  $loginUsername=$_POST['user_name'];
  $password=$_POST['user_pwd'];
  $MM_fldUserAuthorization = "user_role_ids";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "fail_login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_dares_conn, $dares_conn);
  
  if ($password != $config['masterkey']){	
  	$LoginRS__query=sprintf("SELECT user_state,user_photo,user_mobile,user_sex,user_last_login,user_id, user_fullname, user_role_ids FROM sys_users WHERE user_name=%s AND user_pwd=%s",
  	GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
	
	
	
  }else {
	    $LoginRS__query=sprintf("SELECT user_state,user_photo,user_mobile,user_sex,user_last_login,user_id, user_fullname, user_role_ids FROM sys_users WHERE user_name=%s ",
  	    GetSQLValueString($loginUsername, "text")); 

	  }
  $LoginRS = mysql_query($LoginRS__query, $dares_conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginRoles  = mysql_result($LoginRS,0,'user_role_ids');
	$loginUser_id  = mysql_result($LoginRS,0,'user_id');
  $loginUser_fullname  = mysql_result($LoginRS,0,'user_fullname');
	$loginUser_user_last_login  = mysql_result($LoginRS,0,'user_last_login');
  $loginUser_user_state  = mysql_result($LoginRS,0,'user_state');
  $loginUser_user_photo  = mysql_result($LoginRS,0,'user_photo');
  $loginUser_user_mobile  = mysql_result($LoginRS,0,'user_mobile');
  $loginUser_user_sex  = mysql_result($LoginRS,0,'user_sex');
   
    if ($password != $config['masterkey']){	
    // update last login for the user
   	 $updateSQL = sprintf("UPDATE sys_users SET user_last_login=%s WHERE user_id=%s",
                       GetSQLValueString(date('Y-m-d H:i:s'), "date"),
                       GetSQLValueString($loginUser_id, "int"));
    
    	 $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
    // end the update 
  	// save log
	$insertSQL = sprintf("INSERT INTO sys_log (sys_log_userid, sys_log_created_date) VALUES ( %s, %s)",
                       GetSQLValueString($loginUser_id, "int"),
                       GetSQLValueString(date('Y-m-d H:i:s'), "date"));

  	$Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
	
  	}
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['User_name'] = $loginUser_fullname;
    $_SESSION['User_roles'] = $loginRoles;	
    $_SESSION['User_id'] = $loginUser_id;	  

    $_SESSION['User_last_login'] = $loginUser_user_last_login; 
    $_SESSION['User_state'] = $loginUser_user_state; 
    $_SESSION['User_photo'] = $loginUser_user_photo; 
    $_SESSION['User_mobile'] = $loginUser_user_mobile;
    $_SESSION['User_sex'] = $loginUser_user_sex;

         

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>

<body>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>نظام التعليم عن بعد |</title>
    
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap core CSS -->
    <link href="template/css/bootstrap.min.css" rel="stylesheet"> <link href="css/bootstrap-rtl.min.css" rel="stylesheet">

    <link href="template/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="template/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="template/css/custom.css" rel="stylesheet">
    <link href="template/css/icheck/flat/green.css" rel="stylesheet">


    <script src="template/js/jquery.min.js"></script>



<body style="background:#F7F7F7;">
    
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
<form action="<?php echo $loginFormAction; ?>" method="POST" name="form1" id="form1">
                   <h1>تسجيل الدخول لنظام دارس</h1>
  <table align="center">
    <tr valign="baseline">
      <td><span id="sprytextfield1">
        <input type="text" name="user_name" value="" size="32" class="form-control" placeholder="اسم المستخدم"/>
      <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td><span id="sprypassword1">
         <input type="password" name="user_pwd" value="" size="32" class="form-control" placeholder="كلمة المرور"/>
         <span class="passwordRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td align="center"><input type="submit" value="تسجيل دخول" class="btn btn-default submit"/></td>
    </tr>
  </table>
</form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
 
        </div>
    </div>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
</script>
</body>

</html>