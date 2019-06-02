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
$query_Recordset1 = "SELECT * FROM risk";
$Recordset1 = mysql_query($query_Recordset1, $RiskManagement) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

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
  $updateSQL = sprintf("UPDATE risk SET Obejective=%s, Referrance=%s, Category=%s, `Description`=%s, Division=%s, Unit=%s, Cause=%s, EffectImpact=%s, AssestmentLikelihood=%s, AssestmentImpact=%s, `Level`=%s, ExistionCurrentControls=%s, TreatRisk=%s, MitigationStrategy=%s, Priorotisation=%s, LeadResponsibility=%s, MitigationActionDueDate=%s, TreatmentPlanStatus=%s, ActionPlan=%s, ActionPlanStatus=%s,CurrentLevel=%s, CurrentDate=%s WHERE RiskID=%s",
                       GetSQLValueString($_POST['Objective'], "text"),
                       GetSQLValueString($_POST['Referance'], "text"),
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
<link href="TableCSSDetail.css" rel="stylesheet" type="text/css" >
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

<body>
 
   <div align="center">
     <table width="542" border="1" cellspacing="8" class="CSSTableGenerator">
       <tr>
         <td width="93">Risk Ref.</td>
         <td width="421"><?php echo $row_Recordset1['RiskID']; ?></td>
       </tr>
       <tr>
         <td>Objective:</td>
         <td><span id="sprytextarea1">
          <label for="Objective"></label>
         <?php echo $row_Recordset1['Obejective']; ?>         </span></td>
       </tr>
       <tr>
         <td>Category:</td>
         <td>
           <label for="Category"><?php echo $row_Recordset1['Category']; ?></label></td>
       </tr>
       <tr>
         <td>Description</td>
         <td>
           <span id="sprytextarea2">
             <label for="Description"></label>
           <?php echo $row_Recordset1['Description']; ?>           </span>
         </td>
       </tr>
       <tr>
         <td>Division:</td>
         <td>
           <label for="Division"></label>
           <?php echo $row_Recordset1['Division']; ?></td>
       </tr>
       <tr>
         <td>Unit:</td>
         <td>
           <label for="Unit"><?php echo $row_Recordset1['Unit']; ?></label></td>
       </tr>
       <tr>
         <td>Cause</td>
         <td><span id="sprytextarea3">
          <label for="Cause"></label>
          <?php echo $row_Recordset1['Cause']; ?>         </span>
         </td>
       </tr>
       <tr>
         <td>Effect Impact:</td>
         <td><span id="sprytextfield2">
          <label for="EffectImpact"></label>
          <?php echo $row_Recordset1['EffectImpact']; ?><span class="textfieldRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td>Assestment Likelihood:</td>
         <td><label for="AssestmentLikelihood"><?php echo $row_Recordset1['AssestmentLikelihood']; ?></label></td>
       </tr>
       <tr>
         <td>Assestment Impact:</td>
         <td><?php echo $row_Recordset1['AssestmentImpact']; ?></td>
       </tr>
       <tr>
         <td>Level:</td>
         <td><span id="sprytextfield3">
          <label for="Level"></label>
          <?php echo $row_Recordset1['Level']; ?><span class="textfieldRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td>Existing Current Controls:</td>
         <td><span id="sprytextarea4">
          <label for="CurrentControls"></label>
         <?php echo $row_Recordset1['ExistionCurrentControls']; ?>         </span></td>
       </tr>
       <tr>
         <td>Threat Risk:</td>
         <td><?php echo $row_Recordset1['TreatRisk']; ?></td>
       </tr>
       <tr>
         <td>Mitigation Strategy:</td>
         <td><span id="sprytextarea5">
          <label for="Mitigation Strategy"></label>
         <?php echo $row_Recordset1['MitigationStrategy']; ?>         </span></td>
       </tr>
       <tr>
         <td>Priorotisation</td>
         <td><span id="sprytextfield4">
          <label for="Priorotisation"></label>
          <?php echo $row_Recordset1['Priorotisation']; ?><span class="textfieldRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td>Lead Rensponsibility:</td>
         <td><span id="sprytextfield5">
          <label for="Lead Rensponsibility"></label>
          <?php echo $row_Recordset1['LeadResponsibility']; ?><span class="textfieldRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td>Due Date for Mitigation Action:</td>
         <td><span id="sprytextfield6">
          <label for="DueDateMitigationAction"></label>
          <?php echo $row_Recordset1['MitigationActionDueDate']; ?><span class="textfieldRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td>Status of Treatment Plan:</td>
         <td><span id="sprytextarea6">
          <label for="StatusOfTreatmentPlan"></label>
         <?php echo $row_Recordset1['TreatmentPlanStatus']; ?>         </span></td>
       </tr>
       <tr>
         <td>Action Plan:</td>
         <td><span id="sprytextfield7">
          <label for="ActionPlan"></label>
          <?php echo $row_Recordset1['ActionPlan']; ?><span class="textfieldRequiredMsg">A value is required.</span></span></td>
       </tr>
       <tr>
         <td>Status of Action Plan:</td>
         
         <td><span id="sprytextarea7">
          <label for="StatusOfActionPlan"></label>
         <?php echo $row_Recordset1['ActionPlanStatus']; ?>         </span></td>
       </tr>
       <tr>
         <td>Original Level:</td>
         <td><?php echo $row_Recordset1['OriginalLevel']; ?></td>
       </tr>
       <tr>
         <td>Original Date:</td>
        
         <td><?php echo $row_Recordset1['OriginalDate']; ?></td>
       </tr>
       <tr>
         <td>Current Level:</td>
         <td><?php echo $row_Recordset1['CurrentLevel']; ?></td>
       </tr>
       <tr>
         <td>Current Date::</td>
         <td><?php echo date("d-m-Y",strtotime($row_Recordset1['CurrentDate'])); ?></td>
 

       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>
       
         <button onclick="location.href='EditDetailInfo.php?RiskID=<?php echo $row_Recordset1['RiskID']; ?>'">
    Edit</button></td>
       </tr>
     </table>
   </div>
</body>
<?php
mysql_free_result($Recordset1);
?>
</html>
