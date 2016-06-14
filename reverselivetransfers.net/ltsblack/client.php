<?php include("_session.php"); ?>
<?php
include("_dataAccess.php");
$pagename = "client.php"; 
$message = array();
$errmessage = array();
if(isset($_POST['submit']))
{
			
			/*Customer Table */
			$sqli->table='customer';
			$insertInformation = array();
		
			$insertInformation['firstname']				=	$_POST['strFirstName'];
			$insertInformation['lastname']				=	$_POST['strLastName'];
			$insertInformation['email']					=	$_POST['strEmailId'];
			$insertInformation['telephone']				=	$_POST['strTelephone'];
			$insertInformation['fax']					=	$_POST['strFax'];
			if(isset($_POST['rb_gender']));
			$insertInformation['PatientGender']			=	$_POST['rb_gender'];
			$insertInformation['PatientHeight']			=	$_POST['strHeight'];
			$insertInformation['PatientDOB']			=	$_POST['datetimeforcallback'];
			$insertInformation['PatientWeight']			=	$_POST['strWeight'];
			$insertInformation['ReasonforOrdering']		=	$_POST['strReason'];
			$insertInformation['PrescribedBefore']		=	$_POST['strPresBefore'];
			$insertInformation['PrescribedDate']		=	$_POST['strPresDate'];
			$insertInformation['PrescribedBy']			=	$_POST['strPresBy'];
			$insertInformation['MedicalConditions']		=	$_POST['strMedCon'];
			$insertInformation['Allergies']				=	$_POST['strAllergies'];	
			$insertInformation['Physician']				=	$_POST['strPhysician'];
			$insertInformation['LastVisit']				=	$_POST['strlstVist'];
			$insertInformation['LastVisitReason']		=	$_POST['strlstVistreason'];
			$insertInformation['PrimaryMedicalCare']	=	$_POST['strPMedCare'];
			if(isset($_POST['rb_healthInsurance']));
			$insertInformation['HealthInsurance']	=	$_POST['rb_healthInsurance'];
			if(isset($_POST['rb_ExpSeizure']));
			$insertInformation['EverExperiencedSeizure']	=	$_POST['rb_ExpSeizure'];
			if(isset($_POST['rb_liverKidneyDisease']));
			$insertInformation['LiverKidneyDisease']	=	$_POST['rb_liverKidneyDisease'];
			if(isset($_POST['rb_consumeAlcohol']));
			$insertInformation['ConsumeAlcohol']	=	$_POST['rb_consumeAlcohol'];
			if(isset($_POST['rb_opiateDependentPatient']));
			$insertInformation['OpiateDependentPatient']	=	$_POST['rb_opiateDependentPatient'];
			if(isset($_POST['rb_takingAntidepressant']));
			$insertInformation['TakingAntidepressant']	=	$_POST['rb_takingAntidepressant'];
			if(isset($_POST['rb_pregnant']));
			$insertInformation['Pregnant']	=	$_POST['rb_pregnant'];
			if(isset($_POST['rb_nursing']));
			$insertInformation['Nursing']	=	$_POST['rb_nursing'];
			if(isset($_POST['rb_tryingPregnant']));
			$insertInformation['Tryingtobepregnant']	=	$_POST['rb_tryingPregnant'];

			$fields 								= 	array_keys($insertInformation);
			$values									=	array_values($insertInformation);
			$sqli									->	autocommit(FALSE);
			$customer_result 						=	$sqli			->	Insert_data($fields,$values);
			$retcxid = $sqli -> insert_id;

			if(!($customer_result>0 ))
			{
				$sqli->rollback();
				array_push($message,"An Error Occurred in Saving Data.");
			}
			else
			{
				
				$sqli									->	commit();
				array_push($message,"Data Successfully Saved.");
			}
		}

?>
<?php include("includes/header.php"); ?>
<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
<script src="js/jquery.metadata.js" type="text/javascript"></script>
<style type="text/css">
label.error { float: left;
color: red;
padding-left: .5em; }
p { clear: both; }
.submit { margin-left: 12em; }
em { font-weight: bold; padding-right: 1em; vertical-align: top; }
.err{color:#F00; font-size:14px;}
</style>
  <script>
  var JQ = jQuery.noConflict();
  JQ.metadata.setType("attr", "validate");
JQ(document).ready(function() {
    	  JQ("#adminForm").validate();
  });
  </script>
        <div class="main_content">
                  <div class="menu">
                   <?php include("includes/menu.php"); ?>
                    </div> 
                    <div class="center_content">
      <div class="fullwidth_box">            
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>Client Form</h2></td>
    </tr>
</table>
        <?php  foreach($message as $msg){ ?>
        <div class="valid_box">
        <?php echo $msg; ?>
     </div>
     <?php } ?>
     <?php  foreach($errmessage as $msg){ ?>
        <div class="error_box">
        <?php echo $msg; ?>
     </div>
     <?php } ?>
        <div class="form">
          <form action="<?php echo $pagename; ?>" method="post" class="" id="ClientForm" name="ClientForm">
           <fieldset>
    <legend>Client</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="80%" >
    <tr>
    <td width="40%" valign="top">
    <table>
  <tr>
    <td><h4 style="color:#39F"><b>Personal Details</b></h4> </td>
    </tr>
    <tr>
	<tr>
	  <td>Email id<span class="err">*</span>:</td>
     
	  <td><input type="text" class="required textbox" name="strEmailId" id="strEmailId" size="30" maxlength="30" /></td>
	  </tr>
      <tr>
	  <td>Password<span class="err">*</span>:</td>
     
	  <td><input type="text" class="required textbox" name="strPassword" id="strPassword" size="30" maxlength="30" /></td>
	  </tr>
       <tr>
    <td>Alias</td>
    
    <td>
    <input type="text" class="required textbox" name="strAlias" id="strAlias" size="30" maxlength="30" /></td></tr>
    <tr><td>First Name <span class="err">*</span>:</td>
   
	<td><input type="text" class="required textbox" id="strFirstName" name="strFirstName" size="30" maxlength="30" /></td>
    </tr>
	<tr><td>Last Name <span class="err">*</span>:</td>
    
	<td><input type="text" class="required textbox" name="strLastName" id="strLastName" size="30" maxlength="30" /></td>
  </tr>
  <tr>
    <td>Company Name</td>
    <td>
    <input type="text" class="required textbox" name="strCompanyName" id="strCompanyName" size="30" maxlength="30" /></td>
    </tr>
	 <tr>
    <td>Client Details</td>
    <td>
    <textarea name="strClientDetails" id="strClientDetails"></textarea>
    </tr>
	
    </table>
    </td>
  
    <td width="40%" valign="top">
    <table>
    <tr>
    <td><h4 style="color:#39F"><b>Contact Detail</b></h4> </td>
    </tr>
     <tr>
	  <td>Telephone :</td>
	  <td><input type="text" class="required textbox" name="strTelephone" id="strTelephone" size="30" maxlength="30" /></td>
	  </tr>
       <tr>
	  <td>Mobile :</td>
	  <td><input type="text" class="required textbox" name="strMobile" id="strMobile" size="30" maxlength="30" /></td>
	  </tr>
	<tr>
	  <td>Fax :</td>
	  <td><input type="text" class="required textbox" name="strFax" id="strFax" size="30" maxlength="30" /></td>
	  </tr>
       
    <tr>
    <td>Company Address</td>
    <td>
    <input type="text" class="required textbox" name="strCompanyAdd" id="strCompanyAdd" size="30" maxlength="30" /></td>
    </tr>
    <tr>
    <td>City</td>
    <td>
    <input type="text" class="required textbox" name="strCity" id="strCity" size="30" maxlength="30" /></td></tr>
    <tr>
    <td>State</td>
    <td>
    <input type="text" class="required textbox" name="strState" id="strState" size="30" maxlength="30" />
    </td>
    </tr>
    <tr>
    <td>PIN CODE</td>
    <td>
    <input type="text" class="required textbox" name="strPIN" id="strPIN" size="30" maxlength="30" />
    </td>
    </tr>
    <tr>
    <td>Country</td>
    <td>
    <select name="strCountry" id="strCountry">
      <option value="223" selected="selected">United States</option>
    </select>
    </td></tr>
   </table>
    </td>
  </tr>
  <tr>
  <td width="40%" valign="top"><table>
    <tr>
      <td><h4 style="color:#39F"><b>Bank Detail</b></h4></td>
    </tr>
    <tr>
      <td>Client Name</td>
      <td><input type="text" class="required textbox" name="strAccName" id="strAccName" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td>Account Number</td>
      <td><input type="text" class="required textbox" name="strAccNo" id="strAccNo" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td>Bank Name</td>
      <td><input type="text" class="required textbox" name="strBankName" id="strBankName" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td>Bank Swift Code</td>
      <td><input type="text" class="required textbox" name="strSwiftCode" id="strSwiftCode" size="30" maxlength="30" /></td>
    </tr>
     <tr>
    <td>Other Details</td>
    <td>
    <textarea name="strBankDetails" id="strBankDetails"></textarea>
    </tr>
	
  </table></td>
    <td width="40%" valign="top">
    <table>
     <tr>
    <td><h4 style="color:#39F"><b>Bank Address Detail</b></h4> </td>
    </tr>
     <tr>
    <td>Bank Address</td>
    <td>
    <input type="text" class="required textbox" name="strBankAdd" id="strBankAdd" size="30" maxlength="30" />
    </td>
    </tr>
   <tr>
    <td>Bank City</td>
    <td>
    <input type="text" class="required textbox" name="strBankCity" id="strCity" size="30" maxlength="30" /></td></tr>
    <tr>
    <td>Bank State</td>
    <td>
    <input type="text" class="required textbox" name="strBankState" id="strState" size="30" maxlength="30" />
    </td>
    </tr>
    <tr>
    <td>Bank PIN</td>
    <td>
    <input type="text" class="required textbox" name="strBankPIN" id="strPIN" size="30" maxlength="30" />
    </td>
    </tr>
    <tr>
    <td>Bank Country</td>
    <td>
    <select name="strCountry" id="strCountry">
      <option value="223" selected="selected">United States</option>
    </select>
    </td>
    </tr>
    </table>
    </td>
  </tr><tr><td align="center" valign="middle" colspan="2"> 
 	
    <input name="submit" value="Confirm" type="submit">
    </td></tr>
  </table>
  
  </td>
  </tr>
    </table>
  	</fieldset>
          </form>
        </div></div><!-- end of right content-->
        </div><!--end of center content -->
        <div class="clear"></div>
        </div> <!--end of main content-->
    <?php include("includes/footer.php"); ?>