<?php include("_session.php"); ?>
<?php
include("_dataAccess.php");
$pagename = "new_order.php"; 
$message = array();
$errmessage = array();
if(isset($_POST['submit']))
{
	
			if($_POST['strFirstName']=="")
			array_push($errmessage,"Please Fill First Name.");
			
			if($_POST['strLastName']=="")
			array_push($errmessage,"Please Fill last Name.");
			
			if($_POST['strTelephone']=="")
			array_push($errmessage,"Please Fill  TelePhone Number");
			
			if($_POST['stradd1']=="")
			array_push($errmessage,"Please Fill  Address");
			
			if($_POST['strPIN']=="")
			array_push($errmessage,"Please Fill  Postal Code");
			
			if($_POST['strCountry']=="")
			array_push($errmessage,"Please Fill  Country");
			
			if($_POST['strregion']=="")
			array_push($errmessage,"Please Fill  State");

			if($_POST['payment_mode']=="")
			array_push($errmessage,"Please Select Card Type");
			
			if($_POST['payment_mode']=='cc')
			{
				if($_POST['strcardNumber']=="")
				array_push($errmessage,"Please Fill Card Number");
			
				if($_POST['strcvvCode']=="")
				array_push($errmessage,"Please Fill CVV Code");
			
				if($_POST['strnameOnTheCard']=="")
				array_push($errmessage,"Please Fill Name On The Card.");

				if($_POST['dd_month']=="")
				array_push($errmessage,"Please Select a Month.");
			
				if($_POST['stryear']=="")
				array_push($errmessage,"Please Fill Year.");
			}
			
			if(count($errmessage) == 0)
			{
				
				//get the product details
			$ProdDetails			=				$sqli->get_selectData("SELECT * FROM  product where product_id='".$_POST['strProduct']."'");
			$ShippingChar			=				$sqli->get_selectData("SELECT * FROM `setting` WHERE `setting_id` =1");
			$subtotal  				=				number_format( $ProdDetails[0]['price'] * $_REQUEST['strQuantity'],2);
			$total 					=				$subtotal+$ShippingChar[0]['value'];
							/*Order Table */
						
			$insertInformation = array();
			$sqli->table='cx_order';
			
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
			$insertInformation['HealthInsurance']			=	$_POST['rb_healthInsurance'];
			if(isset($_POST['rb_ExpSeizure']));
			$insertInformation['EverExperiencedSeizure']	=	$_POST['rb_ExpSeizure'];
			if(isset($_POST['rb_liverKidneyDisease']));
			$insertInformation['LiverKidneyDisease']		=	$_POST['rb_liverKidneyDisease'];
			if(isset($_POST['rb_consumeAlcohol']));
			$insertInformation['ConsumeAlcohol']			=	$_POST['rb_consumeAlcohol'];
			if(isset($_POST['rb_opiateDependentPatient']));
			$insertInformation['OpiateDependentPatient']	=	$_POST['rb_opiateDependentPatient'];
			if(isset($_POST['rb_takingAntidepressant']));
			$insertInformation['TakingAntidepressant']		=	$_POST['rb_takingAntidepressant'];
			if(isset($_POST['rb_pregnant']));
			$insertInformation['Pregnant']	=	$_POST['rb_pregnant'];
			if(isset($_POST['rb_nursing']));
			$insertInformation['Nursing']	=	$_POST['rb_nursing'];
			if(isset($_POST['rb_tryingPregnant']));
			$insertInformation['Tryingtobepregnant']	=	$_POST['rb_tryingPregnant'];
			$insertInformation['shipping_firstname']	=	$_POST['strFirstName'];
			$insertInformation['shipping_lastname']		=	$_POST['strLastName'];
			$insertInformation['shipping_company']		=	$_POST['strCompany'];
			$insertInformation['shipping_address_1']	=	$_POST['stradd1'];
			$insertInformation['shipping_address_2']	=	$_POST['strAdd2'];
			$insertInformation['shipping_city']			=	$_POST['strCity'];
			$insertInformation['shipping_postcode']		=	$_POST['strPIN'];
			$insertInformation['shipping_country']		=	$_POST['strCountry'];
			$insertInformation['shipping_country_id']	=	$_POST['strCountry'];
			$insertInformation['shipping_zone']			=	$_POST['strregion'];
			$insertInformation['shipping_zone_id']		=	$_POST['strregion'];
			$insertInformation['payment_firstname']		=	$_POST['strFirstName'];
			$insertInformation['payment_lastname']		=	$_POST['strLastName'];
			$insertInformation['payment_company']		=	$_POST['strCompany'];
			$insertInformation['payment_address_1']		=	$_POST['stradd1'];
			$insertInformation['payment_address_2']		=	$_POST['strAdd2'];
			$insertInformation['payment_city']			=	$_POST['strCity'];
			$insertInformation['payment_postcode']		=	$_POST['strPIN'];
			$insertInformation['payment_country']		=	$_POST['strCountry'];
			$insertInformation['payment_country_id']	=	$_POST['strCountry'];
			$insertInformation['payment_zone']			=	$_POST['strregion'];
			$insertInformation['payment_zone_id']		=	$_POST['strregion'];
			if(isset($_POST['payment_mode']));
			$insertInformation['payment_method']			=	$_POST['payment_mode'];
			
				$insertInformation['ip']		   =  $_SERVER['REMOTE_ADDR'];
			if($_POST['payment_mode']=='cc')
			{
				$insertInformation['card_number']		= $_POST['strcardNumber'];
				$insertInformation['cvv_code']			= $_POST['strcvvCode'];
				$insertInformation['name_on_card']		= $_POST['strnameOnTheCard'];
				if($_POST['stryear']<date("Y"))
				{
				$insertInformation['expiry_date']		= $_POST['dd_month']."-".$_POST['stryear'];
				}
				else
				{
					
				}
				$insertInformation['card_type']			= $_POST['dd_cardtype'];

			}
			else
			{
				
				if(isset($_POST['rbcod']));
				$insertInformation['card_number']			=	$_POST['rbcod'];
			}
			//Additional Informations 
			$insertInformation['order_status_id']		= 1;
			$insertInformation['date_added']			= date("Y-m-d H:i:s");
			$insertInformation['date_modified']			= date("Y-m-d H:i:s");
			$insertInformation['affiliate_id']			= $_SESSION['sessMemberID'];
			$insertInformation['total']					= $total;
			
			
			// End of Additional Informations
			$fields 								= 	array_keys($insertInformation);
			$values									=	array_values($insertInformation);
			$OrderRsult 							=	$sqli			->	Insert_data($fields,$values);
			$RecOrderID								= 	$sqli 			-> insert_id;
		
		
			
			/*Order Product*/
			$insertInformation = array();
			$sqli->table='order_product';
			$insertInformation['order_id']			=	$RecOrderID;
			$insertInformation['product_id']		=	$_POST['strProduct'];
			$insertInformation['name']				=	$ProdDetails[0]['name'];
			$insertInformation['model']				=	$ProdDetails[0]['model'];
			$insertInformation['quantity']			=	$_POST['strQuantity'];
			$fields 								= 	array_keys($insertInformation);
			$values									=	array_values($insertInformation);
			$OrderProd 							=	$sqli			->	Insert_data($fields,$values);

			///Insert subtotal           				
			$insertInformation = array();
			$sqli->table='order_total';
			$insertInformation['order_id']				=	$RecOrderID;
			$insertInformation['code']					=	'sub_total';
			$insertInformation['title']					=	'Sub-Total';
			$insertInformation['text']					=	'$'.$subtotal;
			$insertInformation['value']					=	$subtotal;
			$insertInformation['sort_order']			=	1;
			
			$fields 									= 	array_keys($insertInformation);
			$values										=	array_values($insertInformation);
			$subtotalres								=	$sqli			->	Insert_data($fields,$values);
			//Insert Shipping
			$insertInformation = array();
			$sqli->table='order_total';
			$insertInformation['order_id']				=	$RecOrderID;
			$insertInformation['code']					=	'shipping';
			$insertInformation['title']					=	'Flat Shipping Rate';
			$insertInformation['text']					=	'$'.$ShippingChar[0]['value'];
			$insertInformation['value']					=	$ShippingChar[0]['value'];
			$insertInformation['sort_order']			=	2;
			
			$fields 									= 	array_keys($insertInformation);
			$values										=	array_values($insertInformation);
			$shippingres								=	$sqli			->	Insert_data($fields,$values);
			//Insert Total
			$insertInformation = array();
			$sqli->table='order_total';
			$insertInformation['order_id']				=	$RecOrderID;
			$insertInformation['code']					=	'total';
			$insertInformation['title']					=	'Total';
			$insertInformation['text']					=	'$'.($subtotal+$ShippingChar[0]['value']);
			$insertInformation['value']					=	($subtotal+$ShippingChar[0]['value']);
			$insertInformation['sort_order']			=	3;
			
			$fields 									= 	array_keys($insertInformation);
			$values										=	array_values($insertInformation);
			$shippingres								=	$sqli			->	Insert_data($fields,$values);
			
			////////////////
			if(!($OrderRsult>0))
			{
				$sqli->rollback();
				array_push($message,"An Error Occurred in Saving Data.");
			}
			else
			{
				
				$sqli									->	commit();
				array_push($message,"Data Successfully Saved.");
				exit;
			}
			}// End of Error Check
			
			
		}// End of Submit Check

?>
<?php include("includes/header.php"); ?>
<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
<script src="js/jquery.metadata.js" type="text/javascript"></script>
<script src="js/getOrderDetails.js" type="text/javascript"></script>
 <script type="text/javascript" src="js/creditcard.js"></script>
<script language="javascript">
function verify()
{
			var validform = true;
			var strProduct=document.getElementById("strProduct").value;
			if(strProduct=="")
				{
					alert("Pls. Select Product");
					document.getElementById("strProduct").focus();
					return false;
				}
			var strQuantity=document.getElementById("strQuantity").value;
			if(strQuantity=="")
				{
					alert("Pls. Select Quantity");
					document.getElementById("strQuantity").focus();
					return false;
				}
			var strname=document.getElementById("strFirstName").value;
			if(strname=="")
			{
			alert("Pls. Fill First Name.");
			document.getElementById("strFirstName").focus();
			return false;
			}
			var strlname=document.getElementById("strLastName").value;
			if(strlname=="")
			{
			alert("Pls. Fill Last Name.");
			document.getElementById("strLastName").focus();
			return false;
			}
			var stremail=document.getElementById("strEmailId").value;
			if(stremail!="")
			{
			
			var atpos=stremail.indexOf("@");
			var dotpos=stremail.lastIndexOf(".");
			if (atpos<1 || dotpos<atpos+2 || dotpos+2>=stremail.length)
			  {
			  alert("Not a valid e-mail address");
			  return false;
			  }
			}
			var strtelephone=document.getElementById("strTelephone").value;
			if(strtelephone=="")
			{
			alert("Pls. Fill Telephone");
			document.getElementById("strTelephone").focus();
			return false;
			}

var stradd1=document.getElementById("stradd1").value;
if(stradd1=="")
{
alert("Pls. Fill Address.");
document.getElementById("stradd1").focus();
return false;
}
			var strPIN=document.getElementById("strPIN").value;
			if(strPIN=="")
			{
			alert("Pls. Fill Post Code");
			document.getElementById("strPIN").focus();
			return false;
			}
			
var strCountry=document.getElementById("strCountry").value;
if(strCountry=="")
{
alert("Pls. Fill Country ");
document.getElementById("strCountry").focus();
return false;
}
			var strregion=document.getElementById("strregion").value;
			if(strregion=="")
			{
			alert("Pls. Fill State  ");
			document.getElementById("strregion").focus();
			return false;
			}
var payment_mode =document.getElementsByName("payment_mode");
if(payment_mode[0].checked)
{
			var dd_cardtype=document.getElementById("dd_cardtype").value;
			if(dd_cardtype=="")
			{
			alert("Pls. Select Card Type  ");
			document.getElementById("dd_cardtype").focus();
			return false;
			}
			var strcardNumber=document.getElementById("strcardNumber").value;
			if(strcardNumber=="")
			{
				alert("Pls. Fill Card Number  ");
				document.getElementById("strcardNumber").focus();
				return false;
			}
			else 
			{
				if (!checkCreditCard (strcardNumber,dd_cardtype)) {
						alert ("Credit card has a invalid format");
						document.getElementById("strcardNumber").focus();
						return false;
				} 
				
			}
			var strcvvCode=document.getElementById("strcvvCode").value;
			if(strcvvCode=="")
			{
			alert("Pls. Fill CVV Code  ");
			document.getElementById("strcvvCode").focus();
			return false;
			}
			var strnameOnTheCard=document.getElementById("strnameOnTheCard").value;
			if(strnameOnTheCard=="")
			{
			alert("Pls. Fill Name On The Card.");
			document.getElementById("strnameOnTheCard").focus();
			return false;
			}
			var dd_month=document.getElementById("dd_month").value;
			if(dd_month=="")
			{
			alert("Pls. Select a Month.");
			document.getElementById("dd_month").focus();
			return false;
			}
			var stryear=document.getElementById("stryear").value;
			if(stryear=="")
			{
			alert("Pls. Fill Year.");
			document.getElementById("stryear").focus();
			return false;
			}
			
}
else if(payment_mode[1].checked)
{
if (!document.getElementsByName("rbcod")[0].checked && !document.getElementsByName("rbcod")[1].checked) {
			alert("Pls. Select Cod Type.");
			return false;
}

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
padding-left: .5em;
}
p { clear: both; }
.submit { margin-left: 12em; }
em { font-weight: bold; padding-right: 1em; vertical-align: top; }
.err{color:#F00; font-size:14px;}
</style>
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
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="98%">
    <tr>
      <td colspan="3"> <h3 style="color:#39F"><b>Product Details</b></h3></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Product<span class="err">*</span></td>
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
    <td>Quantity<span class="err">*</span></td>
    <td>
    	    <select name="strQuantity" id="strQuantity" onchange="getOrTotalDetails(getElementById('strProduct').value,this.value);">
             <option value="">--Select--</option>
             <?php for($i=10;$i<=200;$i=$i+10){
				 ?>
                 <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                 <?php
				 
				 } ?></select>
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
   
	<td><input type="text" class="required textbox" id="strFirstName" name="strFirstName" size="30" maxlength="30" value="<?php echo $_POST['strFirstName']; ?>" /></td></tr>
	<tr><td>Last Name <span class="err">*</span>:</td>
    
	<td><input type="text" class="required textbox" name="strLastName" id="strLastName" size="30" maxlength="30" value="<?php echo $_POST['strLastName'] ?>" /></td>
  </tr>
  <tr>
    <td>Company</td>
    
    <td>
    <input type="text" class="required textbox" name="strCompany" id="strCompany" size="30" maxlength="30" value="<?php echo $_POST['strCompany'] ?>" /></td></tr>
	<tr>
	  <td>Email id</td>
     
	  <td><input type="text" class="required textbox" name="strEmailId" id="strEmailId" size="30" maxlength="30" value="<?php echo $_POST['strEmailId'] ?>" /></td>
	  </tr>
	<tr>
	  <td>Telephone  <span class="err">*</span>:</td>

	  <td><input type="text" class="required textbox" name="strTelephone" id="strTelephone" size="30" maxlength="30" value="<?php echo $_POST['strTelephone']?>" /></td>
	  </tr>
	<tr>
	  <td>Fax :</td>

	  <td><input type="text" class="required textbox" name="strFax" id="strFax" size="30" maxlength="30" value="<?php echo $_POST['strFax'] ?>" /></td>
	  </tr>
    </table>
    </td>
    <td width="40%" valign="top">
    <table>
    <tr>
    <td><h4 style="color:#39F"><b> Address</b></h4> </td>
    </tr>
    
   
        <tr>
    <td>Address 1 <span class="err">*</span>: </td>
    
    <td>
    <input type="text" class="required textbox" name="stradd1" id="stradd1" size="30" maxlength="30" value="<?php echo $_POST['stradd1'] ?>" /></td></tr>
    
    <tr>
    <td>Address 2</td>
   
    <td>
    <input type="text" class="required textbox" name="strAdd2" id="strAdd2" size="30" maxlength="30" value="<?php echo $_POST['strAdd2'] ?>" /></td></tr>
   
    <tr>
    <td>City</td>
   
    <td>
    <input type="text" class="required textbox" name="strCity" id="strCity" size="30" maxlength="30" value="<?php echo $_POST['strCity'] ?>" /></td></tr>
   
    <tr>
    <td>Postal Code <span class="err">*</span> :</td>
   
    <td>
    <input type="text" class="required textbox" name="strPIN" id="strPIN" size="30" maxlength="30" value="<?php echo $_POST['strPIN'] ?>"/></td></tr>
    
    <tr>
    <td>Country <span class="err">*</span> :</td>
    
    <td>
       
    <select name="strCountry" id="strCountry">
      <option value="223" selected="selected">United States</option>
    
    </select>
    
    </td></tr>
   
    <tr>
    <td>Region/State <span class="err">*</span> :</td>    
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
    <input id="rb_gender" type="radio" value="male" name="rb_gender" ></input>Male
    </label>
    <label>
    <input id="rb_gender" type="radio" value="Female" name="rb_gender"></input>Female
    </label>    
    </td></tr>
     <tr><td>Patient Height</td>
    <td><input type="text" class="required textbox" name="strHeight" id="strHeight" size="30" maxlength="30" value="<?php echo $_POST['strHeight'] ?>" /></td></tr>
     <tr><td>Patient DOB (mm/dd/yyyy)</td>
     <td><input type="text" class="required textbox" name="datetimeforcallback" id="datetimeforcallback" size="27" maxlength="30" value="<?php echo $_POST['datetimeforcallback']?>" /></td></tr>
  <tr><td>Patient Weight (lbs)</td>
   <td><input type="text" class="required textbox" name="strWeight" id="strWeight" size="30" maxlength="30" value="<?php echo $_POST['strWeight']?>" /></td></tr>
      <tr>
          <td>Reason for Ordering</td>
          <td><input type="text" class="required textbox" name="strReason" id="strReason" size="30" maxlength="30" value="<?php echo $_POST['strReason']?>" /></td>
      </tr>
      <tr>
          <td>Prescribed Before</td>
          <td><input type="text" class="required textbox" name="strPresBefore" id="strPresBefore" size="30" maxlength="30" value="<?php echo $_POST['strPresBefore']?>" /></td>
      </tr>
      <tr>
          <td>Prescribed Date</td>
          <td><input type="text" class="required textbox" name="strPresDate" id="strPresDate" size="27" maxlength="30" value="<?php echo $_POST['strPresDate']?>" /></td>
      </tr>
      <tr>
          <td>Prescribed By </td>
          <td><input type="text" class="required textbox" name="strPresBy" id="strPresBy" size="30" maxlength="30"  value="<?php echo $_POST['strPresBy']?>"/></td>
      </tr>
      <tr>
      	<td>Medical Condition </td>
		<td><input type="text" class="required textbox" name="strMedCon" id="strMedCon" size="30" maxlength="30" value="<?php echo $_POST['strMedCon']?>" /></td>
      </tr>
      <tr>
      	<td>Allergies</td>
        <td><input type="text" class="required textbox" name="strAllergies" id="strAllergies" size="30" maxlength="30" value="<?php echo $_POST['strAllergies']?>" /></td>
      </tr>
      <tr>
          <td>Physician</td>
          <td><input type="text" class="required textbox" name="strPhysician" id="strPhysician" size="30" maxlength="30" value="<?php echo $_POST['strPhysician']?>" /></td>
      </tr>
    
  </table>
  </td>
  <td valign="top" width="50%">
  <table>
            <tr>
            	<td>Last Visit</td>
                <td><input type="text" class="required textbox" name="strlstVist" id="strlstVist" size="27" maxlength="30" value="<?php echo $_POST['strlstVist']?>" /></td>
            </tr>
		    <tr>
            	<td>Last Visit Reason</td>
                <td><input type="text" class="required textbox" name="strlstVistreason" id="strlstVistreason" size="30" maxlength="30" value="<?php echo $_POST['strlstVistreason']?>" /></td>
            </tr>
			<tr>
            	<td>Primary Medical Care</td>
                <td><input type="text" class="required textbox" name="strPMedCare" id="strPMedCare" size="30" maxlength="30" value="<?php echo $_POST['strPMedCare']?>" /></td>
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
    <td><div id="payment_holder"><table border="0" width="100%" id="creditcardtable">
    <tbody><tr>
    <td nowrap="nowrap">Card Type<span class="err">*</span></td>
    <td>:</td>
    <td><select name="dd_cardtype" id="dd_cardtype">
    <option value="">Select</option>
    <option value="AmEx">American Express</option>
  <option value="CarteBlanche">Carte Blanche</option>
  <option value="DinersClub">Diners Club</option>
  <option value="Discover">Discover</option>
  <option value="EnRoute">enRoute</option>
  <option value="JCB">JCB</option>
  <option value="Maestro">Maestro</option>
  <option value="MasterCard">MasterCard</option>
  <option value="Solo">Solo</option>
  <option value="Switch">Switch</option>
  <option value="Visa">Visa</option>
  <option value="VisaElectron">Visa Electron</option>
  <option value="LaserCard">Laser</option>
    </select></td>
    </tr>
  <tr>
    <td nowrap="nowrap" width="37%">Card Number<span class="err">*</span></td>
    <td width="3%">:</td>
    <td width="60%"><input name="strcardNumber" id="strcardNumber" type="text" value="<?php echo $_POST['strcardNumber']?>"></td>
    </tr>
    <tr>
    <td nowrap="nowrap">CVV Code</td>
    <td>:</td>
    <td><input name="strcvvCode" id="strcvvCode" type="text" maxlength="3"></td>
    </tr>
    <tr>
    <td nowrap="nowrap">Name On The Card<span class="err">*</span></td>
    <td>:</td>
    <td><input name="strnameOnTheCard" id="strnameOnTheCard" type="text" value="<?php echo $_POST['strnameOnTheCard']?>"></td>
    </tr>
    <tr>
    <td nowrap="nowrap">Expiry Date<span class="err">*</span></td>
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
      </select>&nbsp;<input name="stryear" id="stryear" maxlength="4" style=" width:50px;" type="text"></td>
    </tr></tbody></table>
    <table width="60%" border="0" id="codtable">
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
    
    </div></td></tr>
    <tr><td align="center"> 
 	<div class="buttons">
    <input name="submit" value="Confirm" type="submit" onclick="return verify();">
    </div></td></tr></table>
  	</fieldset>
          </form>
        </div></div><!-- end of right content-->
        </div><!--end of center content -->
        <div class="clear"></div>
        </div> <!--end of main content-->
<script>
var cal = jQuery.noConflict();
	cal(function() {
		cal('#strPresDate').datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: "images/calendar.gif",
			buttonImageOnly: true,
    		dateFormat: 'yy-mm-dd',
			yearRange: "1950:<?php echo date("Y") ?>"
			
		});
		
		cal('#strlstVist').datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: "images/calendar.gif",
			buttonImageOnly: true,
    		dateFormat: 'yy-mm-dd',
			yearRange: "1950:<?php echo date("Y") ?>"
			
		});
		
		});
</script>
    <?php include("includes/footer.php"); ?>