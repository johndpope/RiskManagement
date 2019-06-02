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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="RegisterNewUser.php";
  $loginUsername = $_POST['Username'];
  $LoginRS__query = sprintf("SELECT Username FROM userinfo WHERE Username=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_RiskManagement, $RiskManagement);
  $LoginRS=mysql_query($LoginRS__query, $RiskManagement) or die(mysql_error());
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO userinfo (Name, NameofDirector, Username, Password, AccessLevel, Division) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['NameOfDirector'], "text"),
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['AccessLevel'], "text"),
                       GetSQLValueString($_POST['Division'], "text"))
					  ;

  mysql_select_db($database_RiskManagement, $RiskManagement);
  $Result1 = mysql_query($insertSQL, $RiskManagement) or die(mysql_error());

  $insertGoTo = "AdminHomePage.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Account Successfully register..')
    window.location.href='AdminHomePage.php';
    </SCRIPT>");
 // header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
        <input type="text" name="Username" id="Username" />
        <span class="textfieldRequiredMsg">A value is required.</span></span>
      </td>
    </tr>
    <tr>
      <td>Name:</td>
      <td>
        <span id="sprytextfield2">
          <label for="Name"></label>
          <input type="text" name="Name" id="Name" />
          <span class="textfieldRequiredMsg">A value is required.</span></span>
     </td>
    </tr>
    <tr>
      <td>Name of Director:</td>
      <td>
        <span id="sprytextfield3">
          <label for="NameOfDirector"></label>
          <input type="text" name="NameOfDirector" id="NameOfDirector" />
          <span class="textfieldRequiredMsg">A value is required.</span></span>
     </td>
    </tr>
    <tr>
      <td>Password:</td>
      <td>
        <span id="sprypassword1">
          <label for="Password"></label>
          <input type="password" name="Password" id="Password" />
          <span class="passwordRequiredMsg">A value is required.</span></span>
   </td>
    </tr>
    <tr>
      <td>Confirm Password:</td>
      <td>
        <span id="spryconfirm1">
          <label for="ConfirmPass"></label>
          <input type="password" name="ConfirmPass" id="ConfirmPass" />
          <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">The values don't match.</span></span>
    </td>
    </tr>
    <tr>
      <td>AccessLevel:</td>
      <td><select name="AccessLevel" id="AccessLevel">
             <option value="Admin">Admin</option>
             <option value="Staff">Staff</option>
             </select></td>
    </tr>
    <tr>
      <td>Division:</td>
      <td><select name="Division" id="Division">
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
      </form>
  </table>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "Password");
</script>
</body>
</html>