<?php include("_session.php"); ?>
<?php
include("_dataAccess.php");
$pagename = "new_order.php"; 
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
			/*$insertInformation['address_id']			=	$retaddid;*/
			
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

			$insertInformation = array();
			$sqli->table='address';
			/*Address Table */
			
			$insertInformation['customer_id']	=	$retcxid;
			$insertInformation['firstname']		=	$_POST['strFirstName'];
			$insertInformation['lastname']		=	$_POST['strLastName'];
			$insertInformation['company']		=	$_POST['strCompany'];
			$insertInformation['address_1']		=	$_POST['stradd1'];
			$insertInformation['address_2']		=	$_POST['strAdd2'];
			$insertInformation['city']			=	$_POST['strCity'];
			$insertInformation['postcode']		=	$_POST['strPIN'];
			$insertInformation['country_id']	=	$_POST['strCountry'];
			$insertInformation['zone_id']		=	$_POST['strregion'];
			$fields 								= 	array_keys($insertInformation);
			$values									=	array_values($insertInformation);
			$addressresult 							=	$sqli			->	Insert_data($fields,$values);
			$retaddid = $sqli -> insert_id;
			
			/*Order Table */
			
			
			$insertInformation = array();
			$sqli->table='order';
			
			
			$insertInformation['customer_id']	=	$retcxid;
			$insertInformation['firstname']		=	$_POST['strFirstName'];
			$insertInformation['lastname']		=	$_POST['strLastName'];
			$insertInformation['email']			=	$_POST['strEmailId'];
			$insertInformation['telephone']		=	$_POST['strTelephone'];
			$insertInformation['fax']			=	$_POST['strFax'];
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
			$insertInformation['HealthInsurance']		=	$_POST['rb_healthInsurance'];
			if(isset($_POST['rb_ExpSeizure']));
			$insertInformation['EverExperiencedSeizure']	=	$_POST['rb_ExpSeizure'];
			if(isset($_POST['rb_liverKidneyDisease']));
			$insertInformation['LiverKidneyDisease']	=	$_POST['rb_liverKidneyDisease'];
			if(isset($_POST['rb_consumeAlcohol']));
			$insertInformation['ConsumeAlcohol']		=	$_POST['rb_consumeAlcohol'];
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
			$insertInformation['shipping_firstname']	=	$_POST['strFirstName'];
			$insertInformation['shipping_lastname']		=	$_POST['strLastName'];
			$insertInformation['shipping_company']		=	$_POST['strCompany'];
			$insertInformation['shipping_address_1']		=	$_POST['stradd1'];
			$insertInformation['shipping_address_2']		=	$_POST['strAdd2'];
			$insertInformation['shipping_city']		=	$_POST['strCity'];
			$insertInformation['shipping_postcode']		=	$_POST['strPIN'];
			$insertInformation['shipping_country']		=	$_POST['strCountry'];
			$insertInformation['shipping_country_id']		=	$_POST['strCountry'];
			$insertInformation['shipping_zone']		=	$_POST['strregion'];
			$insertInformation['shipping_zone_id']		=	$_POST['strregion'];
			$insertInformation['payment_firstname']	=	$_POST['strFirstName'];
			$insertInformation['payment_lastname']		=	$_POST['strLastName'];
			$insertInformation['payment_company']		=	$_POST['strCompany'];
			$insertInformation['payment_address_1']		=	$_POST['stradd1'];
			$insertInformation['payment_address_2']		=	$_POST['strAdd2'];
			$insertInformation['payment_city']		=	$_POST['strCity'];
			$insertInformation['payment_postcode']		=	$_POST['strPIN'];
			$insertInformation['payment_country']		=	$_POST['strCountry'];
			$insertInformation['payment_country_id']		=	$_POST['strCountry'];
			$insertInformation['payment_zone']		=	$_POST['strregion'];
			$insertInformation['payment_zone_id']		=	$_POST['strregion'];


			$fields 								= 	array_keys($insertInformation);
			$values									=	array_values($insertInformation);
			$OrderRsult 							=	$sqli			->	Insert_data($fields,$values);
			$RecOrderID								= 	$sqli 			-> insert_id;
			
			
			/*Order Product*/
			$insertInformation = array();
			$sqli->table='order_product';
			
			
			$insertInformation['order_id']			=	$RecOrderID;
			$insertInformation['product_id']		=	$ProdID;
			$insertInformation['name']				=	$_POST['strProduct'];
			$insertInformation['model']				=	$_POST['strProduct'];
			$insertInformation['quantity']			=	$_POST['strQuantity'];
			
			
			$Prod		=$sqli->get_selectData("SELECT * FROM  product where product_id='$ProdID'");
			
			
			$fields 								= 	array_keys($insertInformation);
			$values									=	array_values($insertInformation);
			$OrderProd 							=	$sqli			->	Insert_data($fields,$values);


			
			if(!($customer_result>0 && $addressresult>0 && $OrderRsult>0))
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
<script src="js/getOrderDetails.js" type="text/javascript"></script>
<script language="javascript">
function verify()
{
var txt_name=document.getElementById("txt_name").value;
if(txt_name=="")
{
alert("Pls. Fill First Name.");
document.getElementById("txt_name").focus();
return false;
}
var txt_lname=document.getElementById("txt_lname").value;
if(txt_lname=="")
{
alert("Pls. Fill Last Name.");
document.getElementById("txt_lname").focus();
return false;
}
var txt_email=document.getElementById("txt_email").value;
if(txt_email=="")
{
alert("Pls. Fill Email.");
document.getElementById("txt_email").focus();
return false;
}
var txt_email=document.getElementById("txt_email").value;
var atpos=txt_email.indexOf("@");
var dotpos=txt_email.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=txt_email.length)
  {
  alert("Not a valid e-mail address");
  return false;
  }
var txt_telephone=document.getElementById("txt_telephone").value;
if(txt_telephone=="")
{
alert("Pls. Fill Telephone");
document.getElementById("txt_telephone").focus();
return false;
}
var txt_password=document.getElementById("txt_password").value;
if(txt_password=="")
{
alert("Pls. Fill Password.");
document.getElementById("txt_password").focus();
return false;
}
var txt_confpassword=document.getElementById("txt_confpassword").value;
if(txt_confpassword=="")
{
alert("Pls. Fill Confirm Password.");
document.getElementById("txt_confpassword").focus();
return false;
}
var txt_add1=document.getElementById("txt_add1").value;
if(txt_add1=="")
{
alert("Pls. Fill Address.");
document.getElementById("txt_add1").focus();
return false;
}
var txt_postcode=document.getElementById("txt_postcode").value;
if(txt_postcode=="")
{
alert("Pls. Fill Post Code");
document.getElementById("txt_postcode").focus();
return false;
}
var txt_city=document.getElementById("txt_city").value;
if(txt_city=="")
{
alert("Pls. Fill City ");
document.getElementById("txt_city").focus();
return false;
}
var txt_country=document.getElementById("txt_country").value;
if(txt_country=="")
{
alert("Pls. Fill Country ");
document.getElementById("txt_country").focus();
return false;
}
var txt_state=document.getElementById("txt_state").value;
if(txt_state=="")
{
alert("Pls. Fill State  ");
document.getElementById("txt_state").focus();
return false;
}
var payment_mode =document.getElementById("payment_mode").value;
if(payment_mode=="cc")
{
			var dd_cardtype=document.getElementById("dd_cardtype").value;
			if(dd_cardtype=="")
			{
			alert("Pls. Select Card Type  ");
			document.getElementById("dd_cardtype").focus();
			return false;
			}
			var txt_cardNumber=document.getElementById("txt_cardNumber").value;
			if(txt_cardNumber=="")
			{
				alert("Pls. Fill Card Number  ");
				document.getElementById("txt_cardNumber").focus();
				return false;
			}
			else 
			{
				if (!checkCreditCard (txt_cardNumber,dd_cardtype)) {
						alert ("Credit card has a invalid format");
						document.getElementById("txt_cardNumber").focus();
						return false;
				} 
				
			}
			var txt_cvvCode=document.getElementById("txt_cvvCode").value;
			if(txt_cvvCode=="")
			{
			alert("Pls. Fill CVV Code  ");
			document.getElementById("txt_cvvCode").focus();
			return false;
			}
			var txt_nameOnTheCard=document.getElementById("txt_nameOnTheCard").value;
			if(txt_nameOnTheCard=="")
			{
			alert("Pls. Fill Name On The Card  ");
			document.getElementById("txt_nameOnTheCard").focus();
			return false;
			}
			var dd_month=document.getElementById("dd_month").value;
			if(dd_month=="")
			{
			alert("Pls. Select a Month  ");
			document.getElementById("dd_month").focus();
			return false;
			}
			var txt_year=document.getElementById("txt_year").value;
			if(txt_year=="")
			{
			alert("Pls. Fill Year  ");
			document.getElementById("txt_year").focus();
			return false;
			}
			if(txt_year=="")
			{
			alert("Pls. Fill Year  ");
			document.getElementById("txt_year").focus();
			return false;
			}

}
else if(payment_mode=="cod")
{
alert (payment_mode);
return false;
}


return true;
}
</script>
<script language="javascript" type="text/javascript">
var OR = jQuery.noConflict();
	
function enableCreditCard(method) 
{
	if(method.value=='cc'){
		  OR("#creditcardtable").show();
		   OR("#codtable").hide();
	
	}
}
function enableCashOnDelivery(method)
{
	if(method.value=='cod'){
	 OR("#creditcardtable").hide();
	 OR("#codtable").show();
	}
}
OR(document).ready(function()
{
	OR("#codtable").hide();
});
</script>
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
    <td><h2>Customer Form</h2></td>
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
          <form action="<?php echo $pagename; ?>" method="post" class="" id="customerForm" name="customerForm">
           <fieldset>
    <legend>Customer</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="80%">
    <tr>
      <td colspan="3"> <h3 style="color:#39F"><b>Product Details</b></h3></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Product</td>
    <td>
    <select name="strProduct" id="strProduct" class="required" onchange="getOrderDetails(this.value);">
	    <option value="">--Select--</option>
	    <?php  $ProdIDs = $sqli->get_selectData("SELECT * FROM  product");
			   foreach($ProdIDs as $ProdID){ ?>
	    <option value="<?php echo $ProdID['product_id']; ?>" <?php if($ProdID['product_id']==$_POST['strProduct']) echo "selected"; ?> >
		<?php echo $ProdID['model']; ?></option>
	    <?php } ?>
	    </select>
    </td>
    </tr>
   	<tr>
    <td>Quantity</td>
    <td>
    	    <select name="strQuantity" id="strQuantity" onchange="getOrTotalDetails(getElementById('strProduct').value,this.value);">
             <option value="">--Select--</option>
             <?php for($i=10;$i<=200;$i=$i+10){
				 ?>
                 <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                 <?php
				 
				 } ?>
      		
            
            </select>
    </td>
        </tr>    
</table>
 </td>
 <td>
 <div id="order_detail"> </div>
 
 </td>
    </tr>
    <tr>
    <td colspan="3"> <h3 style="color:#39F"><b>Billing Details</b></h3></td>
    </tr>
    <tr>
    <td width="40%" valign="top">
   <table>
  <tr>
    <td colspan="2"><h4 style="color:#39F"><b>Personal Details</b></h4> </td>
    </tr>
    <tr>
	<tr><td>First Name <span class="err">*</span>:</td>
   
	<td><input type="text" class="required textbox" id="strFirstName" name="strFirstName" size="30" maxlength="30" /></td></tr>
	<tr><td>Last Name <span class="err">*</span>:</td>
    
	<td><input type="text" class="required textbox" name="strLastName" id="strLastName" size="30" maxlength="30" /></td>
  </tr>
  <tr>
    <td>Company</td>
    
    <td>
    <input type="text" class="required textbox" name="strCompany" id="strCompany" size="30" maxlength="30" /></td></tr>
	<tr>
	  <td>Email id :</td>
     
	  <td><input type="text" class="required textbox" name="strEmailId" id="strEmailId" size="30" maxlength="30" /></td>
	  </tr>
	<tr>
	  <td>Telephone :</td>

	  <td><input type="text" class="required textbox" name="strTelephone" id="strTelephone" size="30" maxlength="30" /></td>
	  </tr>
	<tr>
	  <td>Fax :</td>

	  <td><input type="text" class="required textbox" name="strFax" id="strFax" size="30" maxlength="30" /></td>
	  </tr>
    </table>
    </td>
    <td width="40%" valign="top">
    <table>
    <tr>
    <td><h4 style="color:#39F"><b> Address</b></h4> </td>
    </tr>
    
   
        <tr>
    <td>Address 1</td>
    
    <td>
    <input type="text" class="required textbox" name="stradd1" id="stradd1" size="30" maxlength="30" /></td></tr>
    
    <tr>
    <td>Address 2</td>
   
    <td>
    <input type="text" class="required textbox" name="strAdd2" id="strAdd2" size="30" maxlength="30" /></td></tr>
   
    <tr>
    <td>City</td>
   
    <td>
    <input type="text" class="required textbox" name="strCity" id="strCity" size="30" maxlength="30" /></td></tr>
   
    <tr>
    <td>Postal Code</td>
   
    <td>
    <input type="text" class="required textbox" name="strPIN" id="strPIN" size="30" maxlength="30" /></td></tr>
    
    <tr>
    <td>Country</td>
    
    <td>
       
    <select name="strCountry" id="strCountry">
      <option value="223" selected="selected">United States</option>
    
    </select>
    
    </td></tr>
   
    <tr>
    <td>Region/State</td>    
    <td>
    <select name="strregion" id="strregion" class="large-field"><option value="" selected="selected"> --- Please Select --- </option><option value="3613">Alabama</option><option value="3614">Alaska</option><option value="3615">American Samoa</option><option value="3616">Arizona</option><option value="3617">Arkansas</option><option value="3618">Armed Forces Africa</option><option value="3619">Armed Forces Americas</option><option value="3620">Armed Forces Canada</option><option value="3621">Armed Forces Europe</option><option value="3622">Armed Forces Middle East</option><option value="3623">Armed Forces Pacific</option><option value="3624">California</option><option value="3625">Colorado</option><option value="3626">Connecticut</option><option value="3627">Delaware</option><option value="3628">District of Columbia</option><option value="3629">Federated States Of Micronesia</option><option value="3630">Florida</option><option value="3631">Georgia</option><option value="3632">Guam</option><option value="3633">Hawaii</option><option value="3634">Idaho</option><option value="3635">Illinois</option><option value="3636">Indiana</option><option value="3637">Iowa</option><option value="3638">Kansas</option><option value="3639">Kentucky</option><option value="3640">Louisiana</option><option value="3641">Maine</option><option value="3642">Marshall Islands</option><option value="3643">Maryland</option><option value="3644">Massachusetts</option><option value="3645">Michigan</option><option value="3646">Minnesota</option><option value="3647">Mississippi</option><option value="3648">Missouri</option><option value="3649">Montana</option><option value="3650">Nebraska</option><option value="3651">Nevada</option><option value="3652">New Hampshire</option><option value="3653">New Jersey</option><option value="3654">New Mexico</option><option value="3655">New York</option><option value="3656">North Carolina</option><option value="3657">North Dakota</option><option value="3658">Northern Mariana Islands</option></select></td></tr>
    
    
   </table>
    </td>
  </tr>
  <tr>
  <td colspan="2">
  <h3 style="color:#39F"><b>Medical Details</b></h3>
  </td>
  </tr>
  <tr>
  <td valign="top" width="40%">
  <table>
  <tr>
    <td>Patient Gender</td>
    <td>
    <label>
    <input id="rb_gender" type="radio" value="male" name="rb_gender"></input>Male
    </label>
    <label>
    <input id="rb_gender" type="radio" value="Female" name="rb_gender"></input>Female
    </label>    
    </td></tr>
     <tr><td>Patient Height</td>
    <td><input type="text" class="required textbox" name="strHeight" id="strHeight" size="30" maxlength="30" /></td></tr>
     <tr><td>Patient DOB (mm/dd/yyyy)</td>
     <td><input type="text" class="required textbox" name="datetimeforcallback" id="datetimeforcallback" size="25" maxlength="30" /></td></tr>
  <tr><td>Patient Weight (lbs)</td>
   <td><input type="text" class="required textbox" name="strWeight" id="strWeight" size="30" maxlength="30" /></td></tr>
      <tr>
          <td>Reason for Ordering</td>
          <td><input type="text" class="required textbox" name="strReason" id="strReason" size="30" maxlength="30" /></td>
      </tr>
      <tr>
          <td>Prescribed Before</td>
          <td><input type="text" class="required textbox" name="strPresBefore" id="strPresBefore" size="30" maxlength="30" /></td>
      </tr>
      <tr>
          <td>Prescribed Date</td>
          <td><input type="text" class="required textbox" name="strPresDate" id="strPresDate" size="30" maxlength="30" /></td>
      </tr>
      <tr>
          <td>Prescribed By </td>
          <td><input type="text" class="required textbox" name="strPresBy" id="strPresBy" size="30" maxlength="30" /></td>
      </tr>
      <tr>
      	<td>Medical Condition </td>
		<td><input type="text" class="required textbox" name="strMedCon" id="strMedCon" size="30" maxlength="30" /></td>
      </tr>
      <tr>
      	<td>Allergies</td>
        <td><input type="text" class="required textbox" name="strAllergies" id="strAllergies" size="30" maxlength="30" /></td>
      </tr>
      <tr>
          <td>Physician</td>
          <td><input type="text" class="required textbox" name="strPhysician" id="strPhysician" size="30" maxlength="30" /></td>
      </tr>
    </tr>
  </table>
  </td>
  <td valign="top" width="50%">
  <table>
            <tr>
            	<td>Last Visit</td>
                <td><input type="text" class="required textbox" name="strlstVist" id="strlstVist" size="30" maxlength="30" /></td>
            </tr>
		    <tr>
            	<td>Last Visit Reason</td>
                <td><input type="text" class="required textbox" name="strlstVistreason" id="strlstVistreason" size="30" maxlength="30" /></td>
            </tr>
			<tr>
            	<td>Primary Medical Care</td>
                <td><input type="text" class="required textbox" name="strPMedCare" id="strPMedCare" size="30" maxlength="30" /></td>
           	</tr>
    		<tr>
            	<td>Health Insurance</td>
     			<td>
                <label>
          			<input name="rb_healthInsurance" value="Yes" id="rb_healthInsurance" type="radio">Yes</label>
        		<label>
          			<input name="rb_healthInsurance" value="No" id="rb_healthInsurance" checked="checked" type="radio">No</label>
     			</td></tr>   
        <tr>
          	<td>Ever Experienced Seizure</td>
			<td>
	        <label>
       		   <input name="rb_ExpSeizure" value="Yes" id="rb_ExpSeizure" type="radio">Yes</label>
            <label>
          	<input name="rb_ExpSeizure" value="No" id="rb_ExpSeizure" checked="checked" type="radio">No</label>
      	<tr>
		    <td>Liver / Kidney Disease</td>
    		<td>
        	<label>
          		<input name="rb_liverKidneyDisease" value="Yes" id="rb_liverKidneyDisease" type="radio">Yes</label>
        	<label>
          		<input name="rb_liverKidneyDisease" value="No" id="rb_liverKidneyDisease" checked="checked" type="radio">No</label>
		    </td>
  		</tr>
  		<tr>
    		<td>Consume Alcohol </td>
  		
    		<td>
        	<label>
          		<input name="rb_consumeAlcohol" value="Yes" id="rb_consumeAlcohol" type="radio">Yes</label>
            <label>
          		<input name="rb_consumeAlcohol" value="No" id="rb_consumeAlcohol" checked="checked" type="radio">No</label>      
	      	</td>
  		</tr>
  		<tr>
    		<td>Opiate Dependent Patient </td>
  		  	<td>
        	<label>
          		<input name="rb_opiateDependentPatient" value="Yes" id="rb_opiateDependentPatient" type="radio">Yes</label>
        	<label>
          		<input name="rb_opiateDependentPatient" value="No" id="rb_opiateDependentPatient" checked="checked" type="radio">No</label>
      		</td>
  		</tr>
  		<tr>
    		<td>Taking Antidepressant</td>
  		  	<td>
        		<label>
	          		<input name="rb_takingAntidepressant" value="Yes" id="rb_takingAntidepressant" type="radio">Yes</label>
        		<label>
			        <input name="rb_takingAntidepressant" value="No" id="rb_takingAntidepressant" checked="checked" type="radio">No</label>
      		</td>
          </tr>
          <tr>
		    <td>Pregnant</td>
  			<td>
        		<label>
          			<input name="rb_pregnant" value="Yes" id="rb_pregnant" type="radio">Yes</label>
        		<label>
			        <input name="rb_pregnant" value="No" id="rb_pregnant" checked="checked" type="radio">No</label>
     		</td>
  		</tr>
  		<tr>
    		<td>Nursing </td>
  			<td>
        		<label>
          			<input name="rb_nursing" value="Yes" id="rb_nursing" type="radio">Yes</label>
        		<label>
          			<input name="rb_nursing" value="No" id="rb_nursing" checked="checked" type="radio">No</label>
          	</td>
  		</tr>
  		<tr>
    		<td>Trying to be pregnant </td>
  			<td>
        	<label>
          		<input name="rb_tryingPregnant" value="Yes" id="rb_tryingPregnant" type="radio">Yes</label>
            <label>
          		<input name="rb_tryingPregnant" value="No" id="rb_tryingPregnant" checked="checked" type="radio">No</label>
      </td>
  </tr>
  </table>
  </td>
  </tr>
  <tr>
  <td colspan="2">
  <h3 style="color:#39F"><b>Payment Method</b></h3>
  </td>
  </tr>
<tr>
    <td>
     
                
          <input type="radio" name="payment_mode" value="cc" id="payment_mode"  checked="checked" onchange="enableCreditCard(this);" />
          Credit Card</label></td> <td>
     
         <input type="radio" name="payment_mode" value="cod" id="payment_mode" onchange="enableCashOnDelivery(this);" />
          Cash on Delivery</label>
      
     
    </td></tr>
    <tr>
    <td><table border="0" width="100%" id="creditcardtable">
    <tbody><tr>
    <td nowrap="nowrap">Card Type</td>
    <td>:</td>
    <td><select name="dd_cardtype" id="dd_cardtype">
    <option value="">Select</option>
      <option value="1" selected="selected">Visa</option>
      <option value="2">Master</option>    
    </select></td>
    </tr>
  <tr>
    <td nowrap="nowrap" width="37%">Card Number</td>
    <td width="3%">:</td>
    <td width="60%"><input name="txt_cardNumber" id="txt_cardNumber" type="text"></td>
    </tr>
    <tr>
    <td nowrap="nowrap">CVV Code</td>
    <td>:</td>
    <td><input name="txt_cvvCode" id="txt_cvvCode" type="text" maxlength="3"></td>
    </tr>
    <tr>
    <td nowrap="nowrap">Name On The Card</td>
    <td>:</td>
    <td><input name="txt_nameOnTheCard" id="txt_nameOnTheCard" type="text"></td>
    </tr>
    <tr>
    <td nowrap="nowrap">Expiry Date</td>
    <td>:</td>
    <td><select name="dd_month" id="dd_month">
    <option value="" selected="selected">Select</option>
      <option value="1">Jan</option>
      <option value="2">Feb</option>
      <option value="3">Mar</option>
      <option value="4">Apr</option>
      <option value="5">May</option>
      <option value="6">Jun</option>
      <option value="7">Jul</option>
      <option value="8">Aug</option>
      <option value="9">Sep</option>
      <option value="10">Oct</option>
      <option value="11">Nov</option>
      <option value="12">Dec</option>
      </select>&nbsp;<input name="txt_year" id="txt_year" maxlength="4" style=" width:50px;" type="text"></td>
    </tr></tbody></table>
    <table width="100%" border="0" id="codtable">
    <tr>
      <td nowrap="nowrap"><input name="rbcod" type="radio" value="indcod" />India</td>
    </tr>
     <tr>
      <td nowrap="nowrap"><input name="rbcod" type="radio" value="uscod" /> United States</td>
    </tr>
    <tr>
    <td nowrap="nowrap">Overnight Service is not available with COD.</td>
    </tr>
</table>
    
    </td></tr>
    <tr><td align="center"> 
 	<div class="buttons">
    <input name="submit" value="Confirm" type="submit">
    </div></td></tr></table>
  	</fieldset>
          </form>
        </div></div><!-- end of right content-->
        </div><!--end of center content -->
        <div class="clear"></div>
        </div> <!--end of main content-->

    <?php include("includes/footer.php"); ?>