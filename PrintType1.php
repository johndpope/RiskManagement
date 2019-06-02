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
$RiskID=$_GET['ID'];
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
<title>Print Register</title>
</head>

<body onload="window.print()">


<p style="font-weight:normal;color:#000000;letter-spacing:1pt;word-spacing:2pt;font-size:28px;text-align:center;font-family:arial black, sans-serif;line-height:1;margin:0px;padding:0px;"><strong>Risk Register</strong></p>
  <pre align="left" style="display:inline">Unit:<strong><?php echo $row_Recordset1['Obejective']; ?></strong></pre>
  <div align="center">
  <table width="1637" height="265" border="1" style="border-collapse:collapse;">
   
    <tr>
      <td height="19" colspan="21">Objectives:<?php echo $row_Recordset1['Obejective']; ?></td>
    </tr>
    <tr>
      <td width="31" rowspan="2"><div align="center">Risk Ref.</div></td>
      <td width="62" rowspan="2"><div align="center">Risk Category</div></td>
      <td width="90" rowspan="2" align="middle""><div align="center">Description of Risk<br>(including any Identified `triggers`)</div></td>
      <td width="38" rowspan="2"><div align="center">Risk Cause</div></td>
      <td width="0" rowspan="2"><p align="center">Effect/Impact on Business/Project(idenitity consequences)</p></td>
      <td colspan="3"><div align="center">Inherent Risk</div></td>
      <td width="97" rowspan="2">Effectiveness and implementation of existing current control(s)</td>
      <td width="58" rowspan="2">TreatRisk(Y/N)</td>
      <td width="76" colspan="3"><div align="center">Residual Risk</div></td>
      <td width="100" rowspan="2"><p align="center">Militigation/</p>
        <p align="center">Strategy/</p>
      <p align="center">Action(S)</p></td>
      <td width="75" rowspan="2">Prioritisation</td>
      <td width="83" rowspan="2"><div align="center">Lead Rensponsibility for miligation acton(s)</div></td>
      <td width="53" rowspan="2"><div align="center">Due date for militigation action(s)</div></td>
      <td width="64" rowspan="2">Status of Treatment Plan</td>
      <td colspan="3"><div align="center">Risk Level</div></td>
    </tr>
    <tr>
      <td width="75" height="98"><p>Assessment Likelihood</p></td>
      <td width="89">Assestment of Impact</td>
      <td width="72">Risk Level/Rank likelihood and impact</td>
      <td width="76"><div align="center">Assessment of Likelihood</div></td>
      <td width="76"><div align="center">Assessment of Impact</div></td>
      <td width="76"><div align="center">Risk Level/Rank likelihood and impact</div></td>
      <td width="47" valign="middle"><p align="center">Original</p>
      <p align="center">(Date)</p>
      <p align="center"><?php echo date("d-m-Y",strtotime($row_Recordset1['OriginalDate'])); ?></p></td>
      <td width="52"><div align="center">
        <p>Previous</p>
        <p>(Date)</p>
      </div></td>
      <td width="46"><div align="center">
        <p>Current</p>
        <p>(Date)</p>
        <p><?php echo date("d-m-Y",strtotime($row_Recordset1['CurrentDate'])); ?></p>
      </div></td>
    </tr>
    <tr>
      <td><div align="center">1</div></td>
      <td><div align="center">2</div></td>
      <td><div align="center">3</div></td>
      <td><div align="center">4</div></td>
      <td><div align="center">5</div></td>
      <td><div align="center">6</div></td>
      <td><div align="center">7</div></td>
   
	 <td> <div align="center">8</div>
	 <td><div align="center">9
	   
	   </div>
	 <td><div align="center">10</div></td>
	
      <td><div align="center">11</div></td>
      <td><div align="center">12</div></td>
      <td><div align="center">13</div></td>
      <td><div align="center">14</div></td>
      <td><div align="center">15</div></td>
      <td><div align="center">16</div></td>
      <td><div align="center">17</div></td>
      <td><div align="center">18</div></td>
      <td colspan="3"><div align="center">19</div></td>
    </tr>
    <tr>
      <td><div align="center"><?php echo $row_Recordset1['RiskID']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['Category']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['Description']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['Cause']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['EffectImpact']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['AssestmentLikelihood']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['AssestmentImpact']; ?></div></td>
      <td <?php if ($row_Recordset1['Level']==1){?>
      style="background-color:green;font-size:14px;"
      <?php }elseif($row_Recordset1['Level']==2){?>
      style="background-color:green;font-size:14px;"
       <?php }elseif($row_Recordset1['Level']==3){?>
       style="background-color:green;font-size:14px;"
       <?php }elseif($row_Recordset1['Level']==4){?>
       style="background-color:yellow;font-size:14px;"
          <?php }elseif($row_Recordset1['Level']==5){?>
          style="background-color:orange;font-size:14px;"
		  <?php }elseif($row_Recordset1['Level']==6){?>
          style="background-color:orange;font-size:14px;"
		  <?php }elseif($row_Recordset1['Level']==7){?>
          style="background-color:red;font-size:14px;"
          <?php }elseif($row_Recordset1['Level']==8){?>
          style="background-color:red;font-size:14px;"
		  <?php }?> align="center">
          
        <div align="center"></div>
      <?php echo $row_Recordset1['Level']; ?></td>
        <div align="center"></div>
      <td><div align="center"><?php echo $row_Recordset1['ExistionCurrentControls']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['TreatRisk']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['AssessmentLikelihoodResidualRisk']; ?></div></td>
      <td align="center" ><?php echo $row_Recordset1['AssessmentOfImpactResidualRisk']; ?></td>
     <td <?php if ($row_Recordset1['RiskLevelResidual']==1){?>
      style="background-color:green;font-size:14px;"
      <?php }elseif($row_Recordset1['RiskLevelResidual']==2){?>
      style="background-color:green;font-size:14px;"
       <?php }elseif($row_Recordset1['RiskLevelResidual']==3){?>
       style="background-color:green;font-size:14px;"
       <?php }elseif($row_Recordset1['RiskLevelResidual']==4){?>
       style="background-color:yellow;font-size:14px;"
          <?php }elseif($row_Recordset1['RiskLevelResidual']==5){?>
          style="background-color:orange;font-size:14px;"
		  <?php }elseif($row_Recordset1['RiskLevelResidual']==6){?>
          style="background-color:orange;font-size:14px;"
		  <?php }elseif($row_Recordset1['RiskLevelResidual']==7){?>
          style="background-color:red;font-size:14px;"
          <?php }elseif($row_Recordset1['RiskLevelResidual']==8){?>
          style="background-color:red;font-size:14px;"
		  <?php }?> align="center">
		   
		  <?php echo $row_Recordset1['RiskLevelResidual']; ?></td>
      <td><div align="center"><?php echo $row_Recordset1['MitigationStrategy']; ?></div></td>
       <td <?php if ($row_Recordset1['Priorotisation']=='Q1(Low)'){?>
      style="background-color:green;font-size:14px;"
      <?php }elseif($row_Recordset1['Priorotisation']=='Q1(Medium)'){?>
      style="background-color:green;font-size:14px;"
       <?php }elseif($row_Recordset1['Priorotisation']=='Q2(Medium)'){?>
       style="background-color:green;font-size:14px;"
       <?php }elseif($row_Recordset1['Priorotisation']=='Q2(High)'){?>
       style="background-color:yellow;font-size:14px;"
          <?php }elseif($row_Recordset1['Priorotisation']=='Q3(Medium)'){?>
          style="background-color:orange;font-size:14px;"
		  <?php }elseif($row_Recordset1['Priorotisation']=='Q3(High)'){?>
          style="background-color:orange;font-size:14px;"
		  <?php }elseif($row_Recordset1['Priorotisation']=='Q4(High)'){?>
          style="background-color:red;font-size:14px;"
          <?php }elseif($row_Recordset1['Priorotisation']=='Q4(Extreme)'){?>
          style="background-color:red;font-size:14px;"
		  <?php }?> align="center"><div align="center"><?php echo $row_Recordset1['Priorotisation']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['LeadResponsibility']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['MitigationActionDueDate']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['TreatmentPlanStatus']; ?></div></td>
       <div align="center">
      <td <?php if ($row_Recordset1['OriginalLevel']==1){?>
      style="background-color:green;font-size:14px;"
      <?php }elseif($row_Recordset1['OriginalLevel']==2){?>
      style="background-color:blue;font-size:14px;"
       <?php }elseif($row_Recordset1['OriginalLevel']==3){?>
       style="background-color:yellow;font-size:14px;"
       <?php }elseif($row_Recordset1['OriginalLevel']==4){?>
       style="background-color:orange;font-size:14px;"
          <?php }elseif($row_Recordset1['OriginalLevel']==5){?>
          style="background-color:red;font-size:14px;"<?php }?> align="center" >
 
      <?php echo $row_Recordset1['OriginalLevel']; ?>   
      </div>
      <td><div align="center"><?php echo $row_Recordset1['PreviousLevel']; ?></div></td>
      <td <?php if ($row_Recordset1['CurrentLevel']==1){?>
      style="background-color:green;font-size:14px;"
      <?php }elseif($row_Recordset1['CurrentLevel']==2){?>
      style="background-color:blue;font-size:14px;"
       <?php }elseif($row_Recordset1['CurrentLevel']==3){?>
       style="background-color:yellow;font-size:14px;"
       <?php }elseif($row_Recordset1['CurrentLevel']==4){?>
       style="background-color:orange;font-size:14px;"
          <?php }elseif($row_Recordset1['CurrentLevel']==5){?>
          style="background-color:red;font-size:14px;"<?php }?> align="center">
        <div align="center"></div>
      <?php echo $row_Recordset1['CurrentLevel']; ?>
    </tr>
  </table>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
