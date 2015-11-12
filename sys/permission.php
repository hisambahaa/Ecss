<?php
require_once "../Connections/boot.php";
// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="dublicate.php";
  $prem_name = $_POST['prem_name'];
  $prem_url = $_POST['prem_url'];
  $uniqe__query = sprintf("SELECT prem_name , prem_url FROM sys_permission WHERE prem_name=%s or prem_url=%s", GetSQLValueString($prem_name, "text"), GetSQLValueString($prem_url, "text"));
  mysql_select_db($database_dares_conn, $dares_conn);
  $UniqeRS=mysql_query($uniqe__query, $dares_conn) or die(mysql_error());
  $Found = mysql_num_rows($UniqeRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($Found){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
	$roles = implode(',',$_POST['prem_role_ids']);
  $updateSQL = sprintf("UPDATE sys_permission SET prem_name=%s, prem_url=%s, prem_categ_id=%s, prem_role_ids=%s WHERE prem_id=%s",
                       GetSQLValueString($_POST['prem_name'], "text"),
                       GetSQLValueString($_POST['prem_url'], "text"),
                       GetSQLValueString($_POST['prem_categ_id'], "int"),
                       GetSQLValueString($roles, "text"),
                       GetSQLValueString($_POST['prem_id'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($updateSQL, $dares_conn) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$roles = implode(',',$_POST['prem_role_ids']);
  $insertSQL = sprintf("INSERT INTO sys_permission (prem_name, prem_url, prem_categ_id, prem_role_ids, prem_created_by) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['prem_name'], "text"),
                       GetSQLValueString($_POST['prem_url'], "text"),
                       GetSQLValueString($_POST['prem_categ_id'], "int"),
                       GetSQLValueString($roles, "text"),
                       GetSQLValueString($_POST['prem_created_by'], "int"));

  mysql_select_db($database_dares_conn, $dares_conn);
  $Result1 = mysql_query($insertSQL, $dares_conn) or die(mysql_error());
}

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_prem_categ = "SELECT * FROM sys_permission_category";
$get_prem_categ = mysql_query($query_get_prem_categ, $dares_conn) or die(mysql_error());
$row_get_prem_categ = mysql_fetch_assoc($get_prem_categ);
$totalRows_get_prem_categ = mysql_num_rows($get_prem_categ);

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_roles = "SELECT * FROM sys_role";
$get_roles = mysql_query($query_get_roles, $dares_conn) or die(mysql_error());
$row_get_roles = mysql_fetch_assoc($get_roles);
$totalRows_get_roles = mysql_num_rows($get_roles);

mysql_select_db($database_dares_conn, $dares_conn);
$query_get_prem = "SELECT * FROM sys_permission";
$get_prem = mysql_query($query_get_prem, $dares_conn) or die(mysql_error());
$row_get_prem = mysql_fetch_assoc($get_prem);
$totalRows_get_prem = mysql_num_rows($get_prem);
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
      <td nowrap="nowrap" align="right">Prem_name:</td>
      <td><span id="sprytextfield1">
        <input type="text" name="prem_name" value="" size="32" />
      <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prem_url:</td>
      <td><span id="sprytextfield2">
        <input type="text" name="prem_url" value="" size="32" />
      <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prem_categ_id:</td>
      <td><span id="spryselect1">
        <select name="prem_categ_id">
          <?php 
do {  
?>
          <option value="<?php echo $row_get_prem_categ['categ_id']?>" ><?php echo $row_get_prem_categ['categ_name']?></option>
          <?php
} while ($row_get_prem_categ = mysql_fetch_assoc($get_prem_categ));
mysql_data_seek($get_prem_categ,0);
?>
        </select>
      <span class="selectRequiredMsg">*</span></span></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prem_role_ids:</td>
      <td><span id="spryselect2">
        <select name="prem_role_ids[]"  multiple="multiple">
          <?php 
do {  
?>
          <option value="<?php echo $row_get_roles['role_id']?>" ><?php echo $row_get_roles['role_name']?></option>
          <?php
} while ($row_get_roles = mysql_fetch_assoc($get_roles));
mysql_data_seek($get_roles,0);
?>
        </select>
      <span class="selectRequiredMsg">*</span></span></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="prem_created_by" value="<?php echo $_SESSION['User_id']; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<?php do{?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prem_name:</td>
      <td><input type="text" name="prem_name" value="<?php echo htmlentities($row_get_prem['prem_name'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prem_url:</td>
      <td><input type="text" name="prem_url" value="<?php echo htmlentities($row_get_prem['prem_url'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prem_categ_id:</td>
      <td><select name="prem_categ_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_get_prem_categ['categ_id']?>" <?php if (!(strcmp($row_get_prem_categ['categ_id'], htmlentities($row_get_prem['prem_categ_id'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_get_prem_categ['categ_name']?></option>
        <?php
} while ($row_get_prem_categ = mysql_fetch_assoc($get_prem_categ));
mysql_data_seek($get_prem_categ,0);
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Prem_role_ids:</td>
      <td><select name="prem_role_ids[]" multiple="multiple">
        <?php 
do {  
?>
        <option value="<?php echo $row_get_roles['role_id']?>" <?php if ((in_array($row_get_roles['role_id'], explode(',',$row_get_prem['prem_role_ids'])))) {echo "SELECTED";} ?>><?php echo $row_get_roles['role_name']?></option>
        <?php
} while ($row_get_roles = mysql_fetch_assoc($get_roles));
mysql_data_seek($get_roles,0);
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form2" />
  <input type="hidden" name="prem_id" value="<?php echo $row_get_prem['prem_id']; ?>" />
</form>
<?php }while($row_get_prem = mysql_fetch_assoc($get_prem))?>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
</script>
</body>
</html>
<?php
mysql_free_result($get_prem_categ);

mysql_free_result($get_roles);

mysql_free_result($get_prem);
?>
