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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE risk SET Obejective=%s,  Category=%s, `Description`=%s, Division=%s, 
  Unit=%s, Cause=%s, EffectImpact=%s, AssestmentLikelihood=%s, AssestmentImpact=%s, `Level`=%s, ExistionCurrentControls=%s, 
  TreatRisk=%s,AssessmentLikelihoodResidualRisk=%s,AssessmentOfImpactResidualRisk=%s,RiskLevelResidual=%s, 
  MitigationStrategy=%s, Priorotisation=%s, LeadResponsibility=%s, MitigationActionDueDate=%s, TreatmentPlanStatus=%s, 
  ActionPlan=%s, ActionPlanStatus=%s,CurrentLevel=%s, CurrentDate=%s WHERE RiskID=%s",
                       GetSQLValueString($_POST['Objective'], "text"),
                      
                       GetSQLValueString($_POST['Category'], "text"),
                       GetSQLValueString($_POST['Description'], "text"),
                       GetSQLValueString($_POST['Division'], "text"),
                       GetSQLValueString($_POST['Unit'], "text"),
                       GetSQLValueString($_POST['Cause'], "text"),
                       GetSQLValueString($_POST['EffectImpact'], "text"),
                       GetSQLValueString($_POST['AssestmentLikelihood'], "text"),
                       GetSQLValueString($_POST['AssestmentImpact'], "text"),
                       GetSQLValueString($_POST['Level'], "text"),
                       GetSQLValueString($_POST['CurrentControls'], "text"),
                       GetSQLValueString($_POST['ThreatRisk'], "text"),
					   GetSQLValueString($_POST['AssestmentLikelihoodResidualRisk'], "text"), 
					   GetSQLValueString($_POST['AssestmentImpactResidualRisk'], "text"),
					    GetSQLValueString($_POST['RiskLevelResidual'], "text"),
                       GetSQLValueString($_POST['MitigationStrategy'], "text"),
                       GetSQLValueString($_POST['Priorotisation'], "text"),
                       GetSQLValueString($_POST['LeadRensponsibility'], "text"),
                       GetSQLValueString($_POST['MitigationStrategy'], "text"),
                       GetSQLValueString($_POST['StatusOfTreatmentPlan'], "text"),
                       GetSQLValueString($_POST['ActionPlan'], "text"),
                       GetSQLValueString($_POST['StatusOfActionPlan'], "text"),
                       GetSQLValueString($_POST['CurrentLevel'], "text"),
                       GetSQLValueString($_POST['CurrentDate'], "date"),
                       GetSQLValueString($_POST['RiskRef'], "text"));

  mysql_select_db($database_RiskManagement, $RiskManagement);
  $Result1 = mysql_query($updateSQL, $RiskManagement) or die(mysql_error());

  $updateGoTo = "AdminHomePage.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Record Update Successfull.')
    window.location.href='AdminHomePage.php';
    </SCRIPT>");

}

$colname_Recordset1 = "-1";
if (isset($_GET['RiskID'])) {
  $colname_Recordset1 = $_GET['RiskID'];
}
mysql_select_db($database_RiskManagement, $RiskManagement);
$query_Recordset1 = sprintf("SELECT * FROM risk WHERE RiskID = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $RiskManagement) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Risk Detail Info
</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="TableCSSEdit.css" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
</head>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<script >
function calculateLevel()
{
var num1=document.getElementById("AssestmentLikelihood").value;
	var num2=document.getElementById("AssestmentImpact").value;
	var total=+num1 + +num2;

document.form1.Level.value=total;
var num3=document.getElementById("AssestmentLikelihoodResidualRisk").value;
var num4=document.getElementById("AssestmentImpactResidualRisk").value;
var total2=+num3 + +num4;
document.form1.RiskLevelResidual.value=total2;

}

</script>
<body>
 <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>" onsubmit="calculateLevel()">
   <div align="center">
     <table width="542" border="0" cellspacing="8" class="CSSTableGenerator">
       <tr>
         <td width="93">1.Risk Ref.</td>
         <td width="421"><span id="sprytextfield9">
          <label for="RiskRef3"></label>
          <input name="RiskRef" style="background-color : #d1d1d1; "type="text" id="RiskRef3" value="<?php echo $row_Recordset1['RiskID']; ?>" readonly="readonly" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td>2.Objective:</td>
         <td><span id="sprytextarea1">
          <label for="Objective"></label>
          <span id="sprytextarea8">
          <label for="Objective2"></label>
          <textarea name="Objective" id="Objective2" cols="45" rows="15"><?php echo $row_Recordset1['Obejective']; ?></textarea>
         <span class="textareaRequiredMsg">A value is required.</span></span>         </span></td>
       </tr>
       <tr>
         <td>3.Category:</td>
         <td>
           <label for="Category"></label>
           <select name="Category" id="Category">
           <option selected hidden value="<?php echo $row_Recordset1['Category']; ?>"><?php echo $row_Recordset1['Category']; ?></option>
             <option value="Operational (OP-6.0)">Operational (OP-6.0)</option>
             <option value="Information Technology (IT-4.0)">Information Technology (IT-4.0)</option>
             <option value="Environment (ENV-1.0)">Environment (ENV-1.0)</option>
             <option value="Financial (FIN-2.0)">Financial (FIN-2.0)</option>
             <option value="Human Resources (HR-3.0)">Human Resources (HR-3.0)</option>
             <option value="Legal &amp; Regulatory or Compliance (COM-5.0)">Legal &amp; Regulatory or Compliance (COM-5.0)</option>
             <option value="Reputation (REP-7.0)">Reputation (REP-7.0)</option>
             <option value="Stakeholder Management (STM-8.0)">Stakeholder Management (STM-8.0)</option>
             <option value="Strategic (STR-9.0)">Strategic (STR-9.0)</option>
             <option value="Market (MKT-10.0)">Market (MKT-10.0)</option>
           </select>
         </td>
       </tr>
       <tr>
         <td>4.Description</td>
         <td>
           <span id="sprytextarea2">
             <label for="Description"></label>
             <textarea name="Description" id="Description" cols="45" rows="5"><?php echo $row_Recordset1['Description']; ?></textarea>
             <span class="textareaRequiredMsg">A value is required.</span></span>
         </td>
       </tr>
       <tr>
         <td>5.Division:</td>
         <td>
           <label for="Division"></label>
           <select name="Division" id="Division">
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
           </select>
         </td>
       </tr>
       <tr>
         <td>6.Unit:</td>
         <td>
           <label for="Unit"></label>
           <select name="Unit" id="Unit">

 <option selected hidden value="<?php echo $row_Recordset1['Unit']; ?>"><?php echo $row_Recordset1['Unit']; ?></option>             <option value="PAMU">PAMU</option>
             <option value="OMSU">OMSU</option>
             <option value="SSU">SSU</option>
             <option value="HRMU">HRMU</option>
             <option value="Helpdesk Unit">Helpdesk Unit</option>
           </select>
         </td>
       </tr>
       <tr>
         <td>7.Cause</td>
         <td><span id="sprytextarea3">
          <label for="Cause"></label>
          <textarea name="Cause" id="Cause" cols="60" rows="15"><?php echo $row_Recordset1['Cause']; ?></textarea>
          <span class="textareaRequiredMsg">A value is required.</span></span>
         </td>
       </tr>
       <tr>
         <td>8.Effect Impact:</td>
         <td><span id="sprytextfield2">
          <label for="EffectImpact"></label>
          <textarea name="EffectImpact" type="text" id="EffectImpact" value="<?php echo $row_Recordset1['EffectImpact']; ?>" cols="60" rows="15"/></textarea>
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td colspan="2"><div align="center"><u>Inherent Risk</u></div></td>
       </tr>
       <tr>
         <td>9.Assestment Likelihood:</td>
         <td><label for="AssestmentLikelihood"></label>
           <select name="AssestmentLikelihood" id="AssestmentLikelihood">
 <option selected hidden value="<?php echo $row_Recordset1['AssestmentLikelihood']; ?>"><?php echo $row_Recordset1['AssestmentLikelihood']; ?></option>
             <option value="1">1</option>
             <option value="2">2</option>
             <option value="3">3</option>
              <option value="4">4</option>
           </select></td>
       </tr>
       <tr>
         <td>10.Assestment Impact:</td>
         <td><select name="AssestmentImpact" id="AssestmentImpact">
         <option selected hidden value="<?php echo $row_Recordset1['AssestmentImpact']; ?>"><?php echo $row_Recordset1['AssestmentImpact']; ?></option>
           <option value="1">1</option>
           <option value="2">2</option>
           <option value="3">3</option>
           <option value="4">4</option>
         </select></td>
       </tr>
       <tr>
         <td>Total Level:</td>
         <td><span id="sprytextfield3">
          <label for="Level"></label>
          <input name="Level" type="text" id="Level" style="background-color : #d1d1d1; "
          value="<?php echo $row_Recordset1['Level']; ?>" readonly="readonly" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td>11.Existing Current Controls:</td>
         <td><span id="sprytextarea4">
          <label for="CurrentControls"></label>
          <textarea name="CurrentControls" id="CurrentControls" cols="45" rows="5"><?php echo $row_Recordset1['ExistionCurrentControls']; ?></textarea>
          <span class="textareaRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td>12.Threat Risk:</td>
         <td><select name="ThreatRisk" id="ThreatRisk">

 <option selected hidden value="<?php echo $row_Recordset1['TreatRisk']; ?>"><?php echo $row_Recordset1['TreatRisk']; ?></option>             
             <option value="Yes">Yes</option>
             <option value="No">No</option>
                 </select></td>
       </tr>
       <tr>
         <td colspan="2"><div align="center"><u>Residual Risk</u></div></td>
       </tr>
       <tr>
         <td>13.Assestment Likelihood:</td>
         <td><select name="AssestmentLikelihoodResidualRisk" id="AssestmentLikelihoodResidualRisk">
         <option selected hidden value="<?php echo $row_Recordset1['AssessmentLikelihoodResidualRisk']; ?>"><?php echo $row_Recordset1['AssessmentLikelihoodResidualRisk']; ?></option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
      
        </select></td>
       </tr>
       <tr>
         <td>14.Assestment Impact:</td>
         <td>
         <select name="AssestmentImpactResidualRisk" id="AssestmentImpactResidualRisk">
         <option selected hidden value="<?php echo $row_Recordset1['AssessmentOfImpactResidualRisk']; ?>"><?php echo $row_Recordset1['AssessmentOfImpactResidualRisk']; ?></option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
      
        </select></td>
       </tr>
       <tr>
         <td>Total Level:</td>
         <td><input name="RiskLevelResidual" type="text" id="RiskLevelResidual" style="background-color : #d1d1d1; " value="<?php echo $row_Recordset1['RiskLevelResidual']; ?>" readonly="readonly" /></td>
       </tr>
       <tr>
         <td>15.Mitigation Strategy:</td>
         <td><span id="sprytextarea5">
          <label for="Mitigation Strategy"></label>
          <textarea name="MitigationStrategy" id="MitigationStrategy" cols="45" rows="5"><?php echo $row_Recordset1['MitigationStrategy']; ?></textarea>
          <span class="textareaRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td>16.Priorotisation</td>
         <td><span id="sprytextfield4">
          <label for="Priorotisation"></label>
        <select name="Priorotisation" id="Priorotisation">
<option value="Q1 (Low)">Q1(Low)</option>
<option value="Q1(Medium)">Q1(Medium)</option>
<option value="Q2(Medium)">Q2(Medium)</option>
<option value="Q2(High)">Q2(High)</option>
<option value="Q3(Medium)">Q3(Medium)</option>
<option value="Q3(High)">Q3(High)</option>
<option value="Q4(High)">Q4(High)</option>
<option value="Q4(Extreme)">Q4(Extreme)</option>
</select>
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td>17.Lead Rensponsibility:</td>
         <td><span id="sprytextfield5">
          <label for="Lead Rensponsibility"></label>
          <input name="LeadRensponsibility" type="text" id="LeadRensponsibility" value="<?php echo $row_Recordset1['LeadResponsibility']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td>18.Due Date for Mitigation Action:</td>
         <td><span id="sprytextfield6">
          <label for="DueDateMitigationAction"></label>
          <textarea name="DueDateMitigationAction" type="text" id="DueDateMitigationAction" ><?php echo $row_Recordset1['MitigationActionDueDate']; ?> </textarea>
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td>19.Status of Treatment Plan:</td>
         <td><span id="sprytextarea6">
          <label for="StatusOfTreatmentPlan"></label>
          <textarea name="StatusOfTreatmentPlan" id="StatusOfTreatmentPlan" cols="45" rows="5"><?php echo $row_Recordset1['TreatmentPlanStatus']; ?></textarea>
          <span class="textareaRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td>20.Action Plan:</td>
         <td><span id="sprytextfield7">
          <label for="ActionPlan"></label>
          <input name="ActionPlan" type="text" id="ActionPlan" value="<?php echo $row_Recordset1['ActionPlan']; ?>" size="50"/>
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td>21.Status of Action Plan:</td>
         
         <td><span id="sprytextarea7">
          <label for="StatusOfActionPlan"></label>
          <textarea name="StatusOfActionPlan" id="StatusOfActionPlan" cols="45" rows="5"><?php echo $row_Recordset1['ActionPlanStatus']; ?></textarea>
          <span class="textareaRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td>Original Level:</td>
         <td><?php echo $row_Recordset1['OriginalLevel']; ?></td>
       </tr>
       <tr>
         <td>Original Date:</td>
         <td><?php echo date("d-m-Y",strtotime($row_Recordset1['OriginalDate'])); ?></td>
       </tr>
       <tr>
         <td>Current Level:</td>
         <td><select name="CurrentLevel" id="CurrentLevel">
                      <option value="1">1</option>
           <option value="2">2</option>
           <option value="3">3</option>
                         <option value="4">4</option>
               
         </select></td>
       </tr>
       <tr>
         <td>Current Date::</td>
         <td><input name="CurrentDate" type="date" id="CurrentDate" value="<?php echo $row_Recordset1['OriginalDate']; ?>" /></td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td><input type="submit" value="Update" /></td>
       </tr>
     </table>
     <input type="hidden" name="MM_insert" value="form1" />
   </div>
   <input type="hidden" name="MM_update" value="form1" />
 </form>
<script type="text/javascript">
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "none", {validateOn:["blur"]});
var sprytextarea8 = new Spry.Widget.ValidationTextarea("sprytextarea8");
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
