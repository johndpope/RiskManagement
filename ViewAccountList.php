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

mysql_select_db($database_RiskManagement, $RiskManagement);
$query_Recordset1 = "SELECT * FROM userinfo";
$Recordset1 = mysql_query($query_Recordset1, $RiskManagement) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Account List</title>
</head>

<body>
<h2>&nbsp;</h2>
<h2 align="center">
  <p align="center">List of Username &amp; Password</p>
  <p align="center">&nbsp;</p>
</h2>

<p style="position: absolute; left: 432px; top: 180px;"> There are <?php echo $totalRows_Recordset1; ?> registered user found.</p>
<p align="left">&nbsp;</p>
<p align="left">&nbsp;</p>
<div align="center">
  <table width="1198" border="1" cellpadding="2" cellspacing="0" style="text-align:center" class="CSSTableGenerator">
    <tr style="background-color:#960;">
      <td>No</td>
      <td>Username</td>
      <td>Password</td>
      <td>FirstName</td>
      <td>Reporting to:</td>
      <td>AccessLevel</td>
      <td>Division</td>
      <td>Modify</td>
    </tr>
    <?php $no=1;?>
    <?php do { ?>
    <tr>
      <td><div align="center"><?php echo $no++; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['Username']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['Password']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['Name']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['NameofDirector']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['AccessLevel']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['Division']; ?></div></td>
      <td><a href="editAdmininfo.php?ID=<?php echo $row_Recordset1['ID']; ?>">
        <input type="submit" style="background-color:green;" name="button2" id="button2" value="Edit Account" onclick="" />
        </a><a href="DeleteUser.php?ID=<?php echo $row_listAdmin['ID']; ?>"></a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
</div>
<p align="center">&nbsp;</p>
<p align="center"><a href="AdminHomePage.php"><br />
  <input type="submit"  name="button" id="button" value="Back" />
</a></p>
<p align="center">&nbsp;</p>
<form name="form1" method="post" action="SearchingUser.php">
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
