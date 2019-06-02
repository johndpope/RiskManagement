<?php require_once('Connections/RiskManagement.php'); ?>
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

$colname_Recordset1 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset1 = $_GET['ID'];
}
mysql_select_db($database_RiskManagement, $RiskManagement);
$query_Recordset1 = sprintf("SELECT * FROM userinfo WHERE ID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $RiskManagement) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE userinfo SET Name=%s, NameofDirector=%s, Username=%s, Password=%s, AccessLevel=%s, Division=%s WHERE ID=%s",
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['NameOfDirector'], "text"),
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['AccessLevel'], "text"),
                       GetSQLValueString($_POST['Division'], "text"),
                       GetSQLValueString($_POST['ID'], "int"));

  mysql_select_db($database_RiskManagement, $RiskManagement);
  $Result1 = mysql_query($updateSQL, $RiskManagement) or die(mysql_error());

  $updateGoTo = "ViewAccountList.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Edit Account Successfull.')
    window.location.href='AdminHomePage.php';
    </SCRIPT>");
  //header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO userinfo (ID, Name, NameofDirector, Username, Password, AccessLevel, Division) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ID'], "int"),
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['NameOfDirector'], "text"),
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['AccessLevel'], "text"),
                       GetSQLValueString($_POST['Division'], "text"));

  mysql_select_db($database_RiskManagement, $RiskManagement);
  $Result1 = mysql_query($insertSQL, $RiskManagement) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO userinfo (Name, NameofDirector, Username, Password, AccessLevel, Division,DateRegister) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['NameOfDirector'], "text"),
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['AccessLevel'], "text"),
                       GetSQLValueString($_POST['Division'], "text"),
					   GetSQLValueString(date("jS \of F Y"), "text"));

  mysql_select_db($database_RiskManagement, $RiskManagement);
  $Result1 = mysql_query($insertSQL, $RiskManagement) or die(mysql_error());

  $insertGoTo = "AdminHomePage.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Success edit account.')
    window.location.href='AdminHomePage.php';
    </SCRIPT>");
 // header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register New User</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
<div align="center">

  <table width="337" border="1">
    <tr>
      <td colspan="2"><div align="center">Register New User</div></td>
    </tr>
    <tr>
      <td width="93">Username:</td>
      <td width="228">
        <span id="sprytextfield1">
        <label for="Username"></label>
        <input name="Username" type="text" id="Username" value="<?php echo $row_Recordset1['Username']; ?>" />
        <span class="textfieldRequiredMsg">A value is required.</span></span>
      </td>
    </tr>
    <tr>
      <td>Name:</td>
      <td>
        <span id="sprytextfield2">
          <label for="Name"></label>
          <input name="Name" type="text" id="Name" value="<?php echo $row_Recordset1['Name']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span>
     </td>
    </tr>
    <tr>
      <td>Name of Director:</td>
      <td>
        <span id="sprytextfield3">
          <label for="NameOfDirector"></label>
          <input name="NameOfDirector" type="text" id="NameOfDirector" value="<?php echo $row_Recordset1['NameofDirector']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span>
     </td>
    </tr>
    <tr>
      <td>Password:</td>
      <td>
        <span id="sprypassword1">
          <label for="Password"></label>
          <input name="Password" type="password" id="Password" value="<?php echo $row_Recordset1['Password']; ?>" />
          <span class="passwordRequiredMsg">A value is required.</span></span>
   </td>
    </tr>
    <tr>
      <td>Confirm Password:</td>
      <td>
        <span id="spryconfirm1">
          <label for="ConfirmPass"></label>
          <input name="ConfirmPass" type="password" id="ConfirmPass" value="<?php echo $row_Recordset1['Password']; ?>" />
          <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">The values don't match.</span></span>
    </td>
    </tr>
    <tr>
      <td>AccessLevel:</td>
      <td><select name="AccessLevel" id="AccessLevel">
      <option selected hidden value="<?php echo $row_Recordset1['AccessLevel']; ?>"><?php echo $row_Recordset1['AccessLevel']; ?></option>
             <option value="Admin">Admin</option>
             <option value="Staff">Staff</option>
             </select></td>
    </tr>
    <tr>
      <td>Division:</td>
      <td><select name="Division" id="Division">
      <option selected hidden value="<?php echo $row_Recordset1['Division']; ?>"><?php echo $row_Recordset1['Division']; ?></option>
          <option value="Internal Audit Division (IAD)">Internal Audit Division (IAD)</option>
          <option value="Information and Communication Division (ICT)">Information and Communication Division (ICT)</option>
          <option value="Corporate Finance Division (CFD)">Corporate Finance Division (CFD)</option>
          <option value="Entrepreneur Development Division (EDD)">Entrepreneur Development Division (EDD)</option>
          <option value="Property Division (PTY)">Property Division (PTY)</option>
          <option value="Engineering &amp; Project Management Division (ENG)">Engineering &amp; Project Management Division (ENG)</option>
          <option value="Tourism &amp; Leisure Division (T &amp; L)">Tourism &amp; Leisure Division (T &amp; L)</option>
          <option value="Corporate Relations Division (CRC)">Corporate Relations Division (CRC)</option>
          <option value="Legal Affairs Division and Risk Management Unit (LAD)">Legal Affairs Division and Risk Management Unit (LAD)</option>
          <option value="Human Resource and General Administration Division (HRA)">Human Resource and General Administration Division (HRA)</option>
          <option value="Innovation &amp; Quality Division (IQD)">Innovation &amp; Quality Division (IQD)</option>
          <option value="Planning &amp; Monitoring (PMD)">Planning &amp; Monitoring (PMD)</option>
        </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit"value="Register"></td>
    </tr>
    <input type="hidden" name="MM_insert" value="form1" />
     
  </table>
  <p><span id="sprytextfield4">
    <label for="ID"></label>
    <input name="ID" type="hidden" id="ID" value="<?php echo $row_Recordset1['ID']; ?>" />
    <span class="textfieldRequiredMsg">A value is required.</span></span></p>
</div>
<input type="hidden" name="MM_update" value="form1" />
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "Password");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
