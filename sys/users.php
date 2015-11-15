<?php
require_once "../config/boot.php";
// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="dublicate.php";
  $loginUsername = $_POST['user_name'];
  $LoginRS__query = sprintf("SELECT user_name FROM sys_users WHERE user_name=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_dares_conn, $dares_conn);
  $LoginRS=mysql_query($LoginRS__query, $dares_conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}
?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
	$roles = implode(',',$_POST['user_role_ids']);
  $updateSQL = sprintf("UPDATE sys_users SET user_name=%s, user_pwd=%s, user_role_ids=%s, user_fullname=%s, user_email=%s, user_mobile=%s, user_photo=%s, user_state=%s WHERE user_id=%s",
                       GetSQLValueString($_POST['user_name'], "text"),
                       GetSQLValueString(md5($_POST['user_pwd']), "text"),
                       GetSQLValueString($roles, "text"),
                       GetSQLValueString($_POST['user_fullname'], "text"),
                       GetSQLValueString($_POST['user_email'], "text"),
                       GetSQLValueString($_POST['user_mobile'], "text"),
                       GetSQLValueString($_POST['user_photo'], "text"),
                       GetSQLValueString(isset($_POST['user_state']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['user_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
  $roles = implode(',',$_POST['user_role_ids']);
  $insertSQL = sprintf("INSERT INTO sys_users (user_name, user_pwd, user_role_ids, user_fullname, user_email, user_mobile, user_photo, user_created_by) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['user_name'], "text"),
                       GetSQLValueString(md5($_POST['user_pwd']), "text"),
                       GetSQLValueString($roles, "text"),
                       GetSQLValueString($_POST['user_fullname'], "text"),
                       GetSQLValueString($_POST['user_email'], "text"),
                       GetSQLValueString($_POST['user_mobile'], "text"),
                       GetSQLValueString($_POST['user_photo'], "text"),
                       GetSQLValueString($_POST['user_created_by'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
}

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_role = "SELECT * FROM sys_role";
$get_role = mysql_query($query_get_role, $dares_conn) or die(mysql_error());
$row_get_role = mysql_fetch_assoc($get_role);
$totalRows_get_role = mysql_num_rows($get_role);

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_all_users = "SELECT * FROM sys_users";
$get_all_users = mysql_query($query_get_all_users, $dares_conn) or die(mysql_error());
$row_get_all_users = mysql_fetch_assoc($get_all_users);
$totalRows_get_all_users = mysql_num_rows($get_all_users);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td align="center">User_name:</td>
      <td><span id="sprytextfield1">
        <input type="text" name="user_name" value="" size="20" />
      <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td align="center">User_pwd:</td>
      <td><span id="sprytextfield2">
        <input type="text" name="user_pwd" value="" size="20" />
      <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td align="center">User_role_ids:</td>
      <td><span id="spryselect1">
        <select name="user_role_ids[]" multiple="multiple">
          <?php 
do {  
?>
          <option value="<?php echo $row_get_role['role_id']?>" ><?php echo $row_get_role['role_name']?></option>
          <?php
} while ($row_get_role = mysql_fetch_assoc($get_role));
mysql_data_seek($get_role, 0);
?>
        </select>
      <span class="selectRequiredMsg">*</span></span></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td align="center">User_fullname:</td>
      <td><span id="sprytextfield3">
        <input type="text" name="user_fullname" value="" size="20" />
      <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td align="center">User_email:</td>
      <td><span id="sprytextfield4">
      <input type="text" name="user_email" value="" size="20" />
      <span class="textfieldRequiredMsg">*</span><span class="textfieldInvalidFormatMsg">البريد الالكتروني</span></span></td>
    </tr>
    <tr valign="baseline">
      <td align="center">User_mobile:</td>
      <td><span id="sprytextfield5">
        <input type="text" name="user_mobile" value="" size="20" />
      <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td align="center">User_photo:</td>
      <td><input type="text" name="user_photo" value="" size="20" /></td>
    </tr>
    <tr valign="baseline">
      <td align="center">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="user_created_by" value="<?php echo $_SESSION['User_id']; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<!-- update users -->
    <table align="center" dir="rtl">
    <tr>
        <td align="center" >User_name</td>
        <td align="center" >User_pwd</td>
        <td align="center" >User_role_ids</td>
        <td align="center" >User_fullname</td>
        <td align="center" >User_email</td>
        <td align="center" >User_mobile</td>
        <td align="center" >User_photo</td>
        <td align="center">User_state</td>
        <td></td>
    	
    </tr>
<?php do { ?>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
      <tr valign="baseline">
        <td><input type="text" name="user_name" value="<?php echo htmlentities($row_get_all_users['user_name'], ENT_COMPAT, 'utf-8'); ?>" size="20" /></td>

        <td><input type="text" name="user_pwd" value="" size="20" /></td>

        <td><select name="user_role_ids[]"  multiple="multiple">
          <?php 
do {  
?>
          <option value="<?php echo $row_get_role['role_id']?>" 
		  <?php if ((in_array($row_get_role['role_id'], explode(",",$row_get_all_users['user_role_ids'])))) 
		  {echo "SELECTED";} ?>
          ><?php echo $row_get_role['role_name']?></option>
          <?php
} while ($row_get_role = mysql_fetch_assoc($get_role));
mysql_data_seek($get_role, 0);

?>
        </select></td>
    
        <td><input type="text" name="user_fullname" value="<?php echo htmlentities($row_get_all_users['user_fullname'], ENT_COMPAT, 'utf-8'); ?>" size="20" /></td>
     
        <td><input type="text" name="user_email" value="<?php echo htmlentities($row_get_all_users['user_email'], ENT_COMPAT, 'utf-8'); ?>" size="20" /></td>
     
        <td><input type="text" name="user_mobile" value="<?php echo htmlentities($row_get_all_users['user_mobile'], ENT_COMPAT, 'utf-8'); ?>" size="20" /></td>
    
        <td><input type="text" name="user_photo" value="<?php echo htmlentities($row_get_all_users['user_photo'], ENT_COMPAT, 'utf-8'); ?>" size="20" /></td>
     
        <td><input type="checkbox" name="user_state" value=""  <?php if (!(strcmp(htmlentities($row_get_all_users['user_state'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?> /></td>
    
        <td align="center">&nbsp;</td>
        <td><input type="submit" value="Update record" /></td>
      </tr>
    <input type="hidden" name="MM_update" value="form2" />
    <input type="hidden" name="user_id" value="<?php echo $row_get_all_users['user_id']; ?>" />
  </form>
  <?php } while ($row_get_all_users = mysql_fetch_assoc($get_all_users)); ?>
  </table>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
</script>
</body>
</html>
<?php
mysql_free_result($get_role);

mysql_free_result($get_all_users);
?>
