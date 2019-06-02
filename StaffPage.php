<?php require_once('Connections/RiskManagement.php'); ?>
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
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "Staff";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

mysql_select_db($database_RiskManagement, $RiskManagement);
$query_Recordset1 = "SELECT * FROM risk WHERE DIVISION='".$_SESSION['MM_USERDIVISION']."'";
$Recordset1 = mysql_query($query_Recordset1, $RiskManagement) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Home Page</title>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="TableCSS.css" rel="stylesheet" type="text/css" >
</head>

<body>
 <div align="center">
  <p>RISK MANAGEMENT SYSTEM</p>
  <p>&nbsp;</p>
    <p style="position: absolute; right: 121px; top: 6px;">You logged in as,<strong>Staff</strong></p>
   <p style="position: absolute; right:1300px; top: 80px;">Division:<strong> <?php echo $_SESSION['MM_USERDIVISION']?></strong></p>
  <ul id="MenuBar1" class="MenuBarHorizontal">
    <li><a href="AddNewRisk.php">Add New</a></li>
    <li><a href="<?php echo $logoutAction ?>">LogOut</a></li>
  </ul>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="119%" border="1" class="CSSTableGenerator">
    
    <tr>
      <td width="130"><div align="center">Risk ID</div></td>
      <td width="148"><div align="center">Risk Category</div></td>
      <td width="161"><div align="center">Description of Risk(Including any identified `triggers)</div></td>
      <td width="139"><div align="center">Divisons</div></td>
      <td width="51"><div align="center">Update Date</div></td>
      <td colspan="2">&nbsp;</td>
    </tr>
      <?php do { ?>
    <tr>
  
        <td><div align="center"><a href="RiskDetailInfo.php?RiskID=<?php echo $row_Recordset1['RiskID']; ?>"><?php echo $row_Recordset1['RiskID']; ?></a></div></td>
        <td><div align="center"><?php echo $row_Recordset1['Category']; ?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['Description']; ?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['Division']; ?></div></td>
        <td><div align="center"><?php echo date("d-m-Y",strtotime($row_Recordset1['CurrentDate']));  ?></div></td>
           
      <td width="56"><a href="PrintType1.php?ID=<?php echo $row_Recordset1['RiskID']; ?>">Print Risk Register</a>
       </td>
            <td width="125"><a href="PrintType2.php?ID=<?php echo $row_Recordset1['RiskID']; ?>">Print Risk Treatment Plan</a>
        </td>
      </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
</div>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
