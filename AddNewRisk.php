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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO risk (RiskID, Obejective,  Category, `Description`, Division, 
  Unit, Cause, EffectImpact, AssestmentLikelihood, AssestmentImpact, `Level`, ExistionCurrentControls, 
  TreatRisk,AssessmentLikelihoodResidualRisk,AssessmentOfImpactResidualRisk,RiskLevelResidual,MitigationStrategy, 
  Priorotisation, LeadResponsibility, MitigationActionDueDate, TreatmentPlanStatus, ActionPlan, ActionPlanStatus, 
  OriginalLevel, OriginalDate) VALUES (%s,%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s)",
                       GetSQLValueString($_POST['RiskRef'], "text"),
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
                       GetSQLValueString($_POST['ThreatRisk'] , "text"),
					   GetSQLValueString($_POST['AssestmentLikelihoodResidualRisk'], "text"), 
					   GetSQLValueString($_POST['AssestmentImpactResidualRisk'], "text"),
					   GetSQLValueString($_POST['RiskLevelResidual'], "text"),
                       GetSQLValueString($_POST['MitigationStrategy'], "text"),
                       GetSQLValueString($_POST['Priorotisation'], "text"),
                       GetSQLValueString($_POST['LeadRensponsibility'], "text"),
                       GetSQLValueString($_POST['DueDateMitigationAction'], "text"),
                       GetSQLValueString($_POST['StatusOfTreatmentPlan'], "text"),
                       GetSQLValueString($_POST['StatusOfActionPlan'], "text"),
                       GetSQLValueString($_POST['StatusOfActionPlan'], "text"),
                       GetSQLValueString($_POST['OriginalLevel'], "text"),
                       GetSQLValueString($_POST['OriginalDate'], "text"));

  mysql_select_db($database_RiskManagement, $RiskManagement);
  $Result1 = mysql_query($insertSQL, $RiskManagement) or die(mysql_error());

  $insertGoTo = "AdminHomePage.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Record Add Successfull.')
    window.location.href='AdminHomePage.php';
    </SCRIPT>");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add New Risk Case</title>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
var num3=document.getElementById("AssestmentLikelihoodResidualRisk").value;
var num4=document.getElementById("AssestmentImpactResidualRisk").value;
var total2=+num3 + +num4;
document.form1.Level.value=total;
document.form1.RiskLevelResidual.value=total2;


}

</script>
<body>
<div align="center">RISK INFORMATION</div>
<div align="center">
  <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>" onsubmit="calculateLevel()">
  <table width="782" border="1" cellspacing="0" >
    <tr>
      <td width="93">1.Risk Reference:</td>
      <td width="661">

        <label for="RiskRef"></label>
         
        <input type="text" name="RiskRef" id="RiskRef" />
       
        </td>
    </tr>
    <tr>
      <td>2.Objective:</td>
      <td><span id="sprytextarea1">
        <label for="Objective"></label>
        <textarea name="Objective" id="Objective" cols="45" rows="15"></textarea>
        <span class="textareaRequiredMsg">A value is
          <textarea name="Description" id="Description" cols="80" rows="15"></textarea>
        </span></span></td>
    </tr>
    <tr>
      <td>3.Category:</td>
      <td>
        <label for="Category"></label>
        <select name="Category" id="Category">
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
      <td><span id="sprytextfield10">
        <textarea name="Description" id="Description" cols="45" rows="15"/></textarea>
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>5.Division:</td>
      <td>
        <label for="Division"></label>
        <select name="Division" id="Division">
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
          <option value="PAMU">PAMU</option>
          <option value="OMSU">OMSU</option>
          <option value="SSU">SSU</option>
          <option value="HRMU">HRMU</option>
          <option value="Helpdesk Unit">Helpdesk Unit</option>
        </select>
     </td>
    </tr>
    <tr>
      <td>7.Risk Cause:</td>
      <td><span id="sprytextarea3">
        <label for="Cause"></label>
        <textarea name="Cause" id="Cause" cols="45" rows="15"></textarea>
        <span class="textareaRequiredMsg">A value is required.</span></span>
      </td>
    </tr>
    <tr>
      <td>8.Effect Impact:</td>
      <td><span id="sprytextfield11">
        <label for="EffectImpact"></label>
        <textarea name="EffectImpact" id="EffectImpact" cols="45" rows="15"/></textarea>
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="grey"><div align="center"><h4>Inherent Risk</h4></div></td>
      </tr>
    <tr>
      <td>9.Assestment Likelihood:</td>
      <td><label for="AssestmentLikelihood"></label>
        <select name="AssestmentLikelihood" id="AssestmentLikelihood">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
       
        </select></td>
    </tr>
    <tr>
      <td>10.Assestment Impact:</td>
      <td><select name="AssestmentImpact" id="AssestmentImpact">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
 
        </select></td>
    </tr>
    <tr>
      <td>11.Existing Current Controls:</td>
      <td><span id="sprytextarea4">
        <label for="CurrentControls"></label>
        <textarea name="CurrentControls" id="CurrentControls"cols="45" rows="15"></textarea>
        <span class="textareaRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>12.Threat Risk:</td>
      <td><select name="ThreatRisk" id="ThreatRisk">

 
             <option value="Yes">Yes</option>
             <option value="No">No</option>
                 </select>
        <label for="Treat Risk"></label></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="grey"><div align="center"><h4>Residual Risk</h4></div></td>
      </tr>
    <tr>
      <td>13.Assestment Likelihood:</td>
      <td><select name="AssestmentLikelihoodResidualRisk" id="AssestmentLikelihoodResidualRisk">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>

</select></td>
    </tr>
    <tr>
      <td>14.Assestment Impact:</td>
      <td><select name="AssestmentImpactResidualRisk" id="AssestmentImpactResidualRisk">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>

</select></td>
    </tr>
    <tr>
      <td>15.Mitigation Strategy:</td>
      <td><span id="sprytextarea5">
        <label for="Mitigation Strategy"></label>
        <textarea name="MitigationStrategy" id="MitigationStrategy" cols="45" rows="15"></textarea>
        <span class="textareaRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>16.Prioritisation</td>
      <td><span id="sprytextfield4">
        <label for="Priorotisation"></label>
        
        <select name="Priorotisation" id="Priorotisation">
<option value="Q1 Low)">Q1(Low)</option>
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
        <select name="LeadRensponsibility" id="LeadRensponsibility">
  <option value="Information System Officer">Information System Officer</option>
<option value="Administrative Officer">Administrative Officer</option>
<option value="Accountant">Accountant</option>
<option value="Engineer">Engineer</option>
<option value="Internal Audit Officer
">Internal Audit Officer
</option>

</select>
        
        <span class="textfieldRequiredMsg">A value is required.</span></span> Eg.Information System Officer</td>
    </tr>
    <tr>
      <td>18.Due Date for Mitigation Action:</td>
      <td><span id="sprytextfield6">
        <label for="DueDateMitigationAction"></label>
        <input type="date" name="DueDateMitigationAction" id="DueDateMitigationAction" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>19.Status of Treatment Plan:</td>
      <td><span id="sprytextarea6">
        <label for="StatusOfTreatmentPlan"></label>
        <textarea name="StatusOfTreatmentPlan" id="StatusOfTreatmentPlan" cols="45" rows="15"></textarea>
        <span class="textareaRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>20.Action Plan:</td>
      <td><span id="sprytextfield7">
        <label for="Action Plan"></label>
        <textarea name="Action Plan" id="Action Plan" cols="45" rows="15"/></textarea>
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>21.Status of Action Plan:</td>
      <td><span id="sprytextarea7">
        <label for="StatusOfActionPlan"></label>
        <textarea name="StatusOfActionPlan" id="StatusOfActionPlan" cols="45" rows="15"></textarea>
        <span class="textareaRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Original Level:</td>
      <td><span id="sprytextfield8">
        <label for="OriginalLevel"></label>
       <select name="OriginalLevel" id="OriginalLevel">
<option value="Q1(Low)">Q1(Low)</option>
<option value="Q1(Medium)">Q1(Medium)</option>
<option value="Q2(Medium)">Q2(Medium)</option>
<option value="Q2(Medium)">Q2(High)</option>
<option value="Q3(Medium)">Q3(Medium)</option>
<option value="Q3(High)">Q3(High)</option>
<option value="Q4(High)">Q4(High)</option>
<option value="Q4(Extreme)">Q4(Extreme)</option>
</select>
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Original Date:</td>
      <td><input type="date" name="OriginalDate" id="OriginalDate"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span id="sprytextfield2">
        <label for="Level"></label>
        <input type="hidden" name="Level" id="Level" value=""/>
        <span class="textfieldRequiredMsg">A value is required.</span></span>
        <input type="submit" value="submit" />
        <span id="sprytextfield3">
          <label for="ResidualLevel"></label>
          <input type="hidden" name="RiskLevelResidual" id="RiskLevelResidual" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    </table>
  <input type="hidden" name="MM_insert" value="form1" />
  </form>
</div>
<script type="text/javascript">
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
var sprytextarea3 = new Spry.Widget.ValidationTextarea("sprytextarea3");
var sprytextarea4 = new Spry.Widget.ValidationTextarea("sprytextarea4");
var sprytextarea5 = new Spry.Widget.ValidationTextarea("sprytextarea5");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextarea6 = new Spry.Widget.ValidationTextarea("sprytextarea6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextarea7 = new Spry.Widget.ValidationTextarea("sprytextarea7");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "none");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11");
</script>
</body>
</html>