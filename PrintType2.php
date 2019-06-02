<?php require_once('Connections/RiskManagement.php'); ?>
<?php
session_start();
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
$RiskID=$_GET['ID'];
mysql_select_db($database_RiskManagement, $RiskManagement);
$query_Recordset2 = sprintf("SELECT * FROM risk WHERE RiskID= %s", GetSQLValueString($RiskID, "text"));
$Recordset2 = mysql_query($query_Recordset2, $RiskManagement) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_RiskManagement, $RiskManagement);
$query_Recordset1 = sprintf("SELECT * FROM risk WHERE RiskID= %s", GetSQLValueString($RiskID, "text"));

$Recordset1 = mysql_query($query_Recordset1, $RiskManagement) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Risk Treatment Plan</title>
</head>

<body onload="window.print()">
<div align="center">
<p style="font-weight:normal;color:#000000;letter-spacing:1pt;word-spacing:2pt;font-size:28px;text-align:center;font-family:arial black, sans-serif;line-height:1;margin:0px;padding:0px;">RISK TREATMENT PLAN</p>
<p style="font-weight:normal;color:#000000;letter-spacing:1pt;word-spacing:2pt;font-size:28px;text-align:center;font-family:arial black, sans-serif;line-height:1;margin:0px;padding:0px;">&nbsp;</p>
  <table width="1549" height="538" border="1" style="border-collapse:collapse;">
    <tr>
      <td colspan="5"><div align="left"><strong>Division (Risk Owner):</strong><?php echo $row_Recordset1['Division']; ?></div></td>
    </tr>
    <tr>
      <td colspan="5"><div align="left"><strong>Objectives</strong>:<?php echo $row_Recordset1['Obejective']; ?></div></td>
    </tr>
    <tr>
      <td colspan="4"><div align="left"><strong>Risk Description:</strong><?php echo $row_Recordset1['Description']; ?></div></td>
      <td width="449"><strong>Risk Category:<?php echo $row_Recordset1['Category']; ?></strong></td>
    </tr>
    <tr>
      <td colspan="5"><p align="left"><strong>Mitigation Strategy:</strong></p>
        <p align="left"><?php echo $row_Recordset1['MitigationStrategy']; ?></p></td>
    </tr>
    <tr>
      <td colspan="5"><div align="left"><strong>Ref.Risk Register as at:<?php echo $row_Recordset2['DateRegister']; ?></strong></div></td>
    </tr>
    <tr>
      <td height="23" colspan="2" style="color-background:grey;"><div align="center"><strong>Risk Ref. &amp; Risk Level</strong></div></td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td width="238" height="137"><p align="center">(1)</p>
        <p align="center">RR as at</p>
      <p align="center"><?php echo date("d-m-Y",strtotime($row_Recordset1['OriginalDate'])); ?></p></td>
      <td width="200"><p align="center">(2)</p>
        <p align="center">RR as at</p>
      <p align="center"><?php echo date("d-m-Y",strtotime($row_Recordset1['CurrentDate'])); ?></p></td>
      <td width="429"><p align="center">(3)</p>
        <p align="center"><strong>Actions</strong></p>
        <p align="center">&nbsp;</p>
      <p align="center">&nbsp;</p></td>
      <td width="199"><p>(4)</p>
      <p><strong>Status as at </strong></p>
      <p>30.09.15</p></td>
      <td><p>(5)</p>
        <p><strong>Status </strong><strong>as at </strong></p>
      <p><?php echo $row_Recordset1['CurrentDate']; ?></p></td>
    </tr>
    <tr>
      <td height="112" <?php if ($row_Recordset1['OriginalLevel']==1){?>
      style="background-color:green;font-size:14px;"
      <?php }elseif($row_Recordset1['OriginalLevel']==2){?>
      style="background-color:blue;font-size:14px;"
       <?php }elseif($row_Recordset1['OriginalLevel']==3){?>
       style="background-color:yellow;font-size:14px;"
       <?php }elseif($row_Recordset1['OriginalLevel']==4){?>
       style="background-color:orange;font-size:14px;"
          <?php }elseif($row_Recordset1['OriginalLevel']==5){?>
          style="background-color:red;font-size:14px;"<?php }?> > <div align="center"><?php echo $row_Recordset1['RiskID']; ?></div>
   
    </td>
      <td height="112" <?php if ($row_Recordset1['CurrentLevel']==1){?>
      style="background-color:green;font-size:14px;"
      <?php }elseif($row_Recordset1['CurrentLevel']==2){?>
      style="background-color:blue;font-size:14px;"
       <?php }elseif($row_Recordset1['CurrentLevel']==3){?>
       style="background-color:yellow;font-size:14px;"
       <?php }elseif($row_Recordset1['CurrentLevel']==4){?>
       style="background-color:orange;font-size:14px;"
          <?php }elseif($row_Recordset1['CurrentLevel']==5){?>
          style="background-color:red;font-size:14px;"<?php }?> ><div align="center"><?php echo $row_Recordset1['RiskID']; ?></div></td>
      <td><?php echo $row_Recordset1['ActionPlan']; ?></td>
      <td><?php echo $row_Recordset1['ActionPlan']; ?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><div align="center"><strong>Prepared by:</strong><?php echo $_SESSION['MM_Name'];?></div></td>
      <td><strong>Date:</strong><?php echo date("d/m/y");?></td>
    </tr>
    <tr>
      <td colspan="4"><div align="center"><strong>Reviewed/Approved by:</strong><?php echo $_SESSION['MM_NameOfDirector']; ?></div></td>

      <td><strong>Date:</strong><?php echo date("d/m/y");?></td>
    </tr>
  </table>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
