<!-- this is a Order Update form-->
<?php include("_session.php"); ?>
<?php
include("_dataAccess.php");
$pagename = "updateOrder.php"; 
$message = array();
$errmessage = array();
if(isset($_POST['Update']))
{
			$error	=	0;
			$sqli->table='cx_order';
			if(count($errmessage) == 0)
			{
				/*Order Table */
			$updateInformation = array();
			$sqli->table='cx_order';
			$updateInformation['firstname']				=	$_POST['strFirstName'];
			$updateInformation['lastname']				=	$_POST['strLastName'];
			$updateInformation['email']					=	$_POST['strEmailId'];
			$updateInformation['telephone']				=	$_POST['strTelephone'];
			$updateInformation['fax']					=	$_POST['strFax'];
			if(isset($_POST['rb_gender']));
			$updateInformation['PatientGender']			=	$_POST['rb_gender'];
			$updateInformation['PatientHeight']			=	$_POST['strHeight'];
			$updateInformation['PatientDOB']			=	$_POST['datetimeforcallback'];
			$updateInformation['PatientWeight']			=	$_POST['strWeight'];
			$updateInformation['ReasonforOrdering']		=	$_POST['strReason'];
			$updateInformation['PrescribedBefore']		=	$_POST['strPresBefore'];
			$updateInformation['PrescribedDate']		=	$_POST['strPresDate'];
			$updateInformation['PrescribedBy']			=	$_POST['strPresBy'];
			$updateInformation['MedicalConditions']		=	$_POST['strMedCon'];
			$updateInformation['Allergies']				=	$_POST['strAllergies'];	
			$updateInformation['Physician']				=	$_POST['strPhysician'];
			$updateInformation['LastVisit']				=	$_POST['strlstVist'];
			$updateInformation['LastVisitReason']		=	$_POST['strlstVistreason'];
			$updateInformation['PrimaryMedicalCare']	=	$_POST['strPMedCare'];
			if(isset($_POST['rb_healthInsurance']));
			$updateInformation['HealthInsurance']			=	$_POST['rb_healthInsurance'];
			if(isset($_POST['rb_ExpSeizure']));
			$updateInformation['EverExperiencedSeizure']	=	$_POST['rb_ExpSeizure'];
			if(isset($_POST['rb_liverKidneyDisease']));
			$updateInformation['LiverKidneyDisease']		=	$_POST['rb_liverKidneyDisease'];
			if(isset($_POST['rb_consumeAlcohol']));
			$updateInformation['ConsumeAlcohol']			=	$_POST['rb_consumeAlcohol'];
			if(isset($_POST['rb_opiateDependentPatient']));
			$updateInformation['OpiateDependentPatient']	=	$_POST['rb_opiateDependentPatient'];
			if(isset($_POST['rb_takingAntidepressant']));
			$updateInformation['TakingAntidepressant']		=	$_POST['rb_takingAntidepressant'];
			if(isset($_POST['rb_pregnant']));
			$updateInformation['Pregnant']					=	$_POST['rb_pregnant'];
			if(isset($_POST['rb_nursing']));
			$updateInformation['Nursing']					=	$_POST['rb_nursing'];
			if(isset($_POST['rb_tryingPregnant']));
			$updateInformation['Tryingtobepregnant']		=	$_POST['rb_tryingPregnant'];
			$updateInformation['shipping_firstname']		=	$_POST['strFirstName'];
			$updateInformation['shipping_lastname']			=	$_POST['strLastName'];
			$updateInformation['shipping_company']			=	$_POST['strCompany'];
			$updateInformation['shipping_address_1']		=	$_POST['stradd1'];
			$updateInformation['shipping_address_2']		=	$_POST['strAdd2'];
			$updateInformation['shipping_city']				=	$_POST['strCity'];
			$updateInformation['shipping_postcode']			=	$_POST['strPIN'];
			$updateInformation['shipping_country']			=	$_POST['strCountry'];
			$updateInformation['shipping_country_id']		=	$_POST['strCountry'];
			$updateInformation['shipping_zone']				=	$_POST['strregion'];
			$updateInformation['shipping_zone_id']			=	$_POST['strregion'];
			$updateInformation['payment_firstname']			=	$_POST['strFirstName'];
			$updateInformation['payment_lastname']			=	$_POST['strLastName'];
			$updateInformation['payment_company']			=	$_POST['strCompany'];
			$updateInformation['payment_address_1']			=	$_POST['stradd1'];
			$updateInformation['payment_address_2']			=	$_POST['strAdd2'];
			$updateInformation['payment_city']				=	$_POST['strCity'];
			$updateInformation['payment_postcode']			=	$_POST['strPIN'];
			$updateInformation['payment_country']			=	$_POST['strCountry'];
			$updateInformation['payment_country_id']		=	$_POST['strCountry'];
			$updateInformation['payment_zone']				=	$_POST['strregion'];
			$updateInformation['payment_zone_id']			=	$_POST['strregion'];

			$fields 								= 	array_keys($updateInformation);
			$values									=	array_values($updateInformation);
			$sqli											->	autocommit(FALSE);
			;
			/*Order Product*/
			$updateInformation = array();
			$sqli->table='order_product';
			$updateInformation['order_id']			=	$RecOrderID;
			$updateInformation['product_id']		=	$_POST['strProduct'];
			$updateInformation['name']				=	$ProdDetails[0]['name'];
			$updateInformation['model']				=	$ProdDetails[0]['model'];
			$updateInformation['quantity']			=	$_POST['strQuantity'];
			$fields 								= 	array_keys($updateInformation);
			$values									=	array_values($updateInformation);
			$OrderProd 							=	$sqli			->	Insert_data($fields,$values);

			///Insert subtotal           				
			$updateInformation = array();
			$sqli->table='order_total';
			$updateInformation['order_id']				=	$RecOrderID;
			$updateInformation['code']					=	'sub_total';
			$updateInformation['title']					=	'Sub-Total';
			$updateInformation['text']					=	'$'.$subtotal;
			$updateInformation['value']					=	$subtotal;
			$updateInformation['sort_order']			=	1;
			
			$fields 									= 	array_keys($updateInformation);
			$values										=	array_values($updateInformation);
			$subtotalres								=	$sqli			->	Insert_data($fields,$values);
			//Insert Shipping
			$updateInformation = array();
			$sqli->table='order_total';
			$updateInformation['order_id']				=	$RecOrderID;
			$updateInformation['code']					=	'shipping';
			$updateInformation['title']					=	'Flat Shipping Rate';
			$updateInformation['text']					=	'$'.$ShippingChar[0]['value'];
			$updateInformation['value']					=	$ShippingChar[0]['value'];
			$updateInformation['sort_order']			=	2;
			
			$fields 									= 	array_keys($updateInformation);
			$values										=	array_values($updateInformation);
			$shippingres								=	$sqli			->	Insert_data($fields,$values);
			//Insert Total
			$updateInformation = array();
			$sqli->table='order_total';
			$updateInformation['order_id']				=	$RecOrderID;
			$updateInformation['code']					=	'total';
			$updateInformation['title']					=	'Total';
			$updateInformation['text']					=	'$'.($subtotal+$ShippingChar[0]['value']);
			$updateInformation['value']					=	($subtotal+$ShippingChar[0]['value']);
			$updateInformation['sort_order']			=	3;
			
			$fields 									= 	array_keys($updateInformation);
			$values										=	array_values($updateInformation);
			$shippingres								=	$sqli			->	Insert_data($fields,$values);
			
			$where=array('order_id'=>$_POST['order_id']);	
			$update_result= $sqli->Update_data($where,$values,$fields);
				if($update_result == 0)
				{
					$error	= 1;
					$sqli->rollback();
					array_push($errmessage,"An Error Occurred in Saving Data.");
				}	
				
				else
				{
						$sqli									->	commit();
						array_push($message,"Data Successfully Saved.");
				}
			}// End of Error Check
			
			
		}// End of Submit Check
		
		$orderDetails = $sqli->get_selectData("SELECT
cx_order.order_id,
cx_order.firstname,
cx_order.lastname,
cx_order.email,
cx_order.telephone,
cx_order.date_added,
order_product.model,
order_product.product_id,
order_product.quantity,
order_total.value,
order_total.text,
order_total.title,
order_total.code,
order_status.name,
tbladmin.UserName,
cx_order.invoice_no,
cx_order.invoice_prefix,
cx_order.store_id,
cx_order.store_name,
cx_order.store_url,
cx_order.customer_id,
cx_order.customer_group_id,
cx_order.fax,
cx_order.PatientHeight,
cx_order.PatientGender,
cx_order.PatientDOB,
cx_order.PatientWeight,
cx_order.ReasonforOrdering,
cx_order.PrescribedBefore,
cx_order.PrescribedDate,
cx_order.PrescribedBy,
cx_order.MedicalConditions,
cx_order.Allergies,
cx_order.Physician,
cx_order.LastVisit,
cx_order.LastVisitReason,
cx_order.PrimaryMedicalCare,
cx_order.HealthInsurance,
cx_order.EverExperiencedSeizure,
cx_order.LiverKidneyDisease,
cx_order.ConsumeAlcohol,
cx_order.OpiateDependentPatient,
cx_order.TakingAntidepressant,
cx_order.Pregnant,
cx_order.Nursing,
cx_order.Tryingtobepregnant,
cx_order.shipping_firstname,
cx_order.shipping_lastname,
cx_order.shipping_company,
cx_order.shipping_address_1,
cx_order.shipping_address_2,
cx_order.shipping_city,
cx_order.shipping_postcode,
cx_order.shipping_country,
cx_order.shipping_country_id,
cx_order.shipping_zone,
cx_order.shipping_zone_id,
cx_order.shipping_address_format,
cx_order.shipping_method,
cx_order.payment_firstname,
cx_order.payment_lastname,
cx_order.payment_company,
cx_order.payment_address_1,
cx_order.payment_address_2,
cx_order.payment_city,
cx_order.payment_postcode,
cx_order.payment_country,
cx_order.payment_country_id,
cx_order.payment_zone,
cx_order.payment_zone_id,
cx_order.payment_address_format,
cx_order.payment_method,
cx_order.comment,
cx_order.total,
cx_order.reward,
cx_order.order_status_id,
cx_order.affiliate_id,
cx_order.commission,
cx_order.language_id,
cx_order.currency_id,
cx_order.currency_code,
cx_order.currency_value,
cx_order.date_modified,
cx_order.ip,
cx_order.card_number,
cx_order.cvv_code,
cx_order.name_on_card,
cx_order.expiry_date,
cx_order.card_type
FROM
cx_order
Inner Join order_total ON cx_order.order_id = order_total.order_id
Inner Join order_product ON cx_order.order_id = order_product.order_id
Inner Join product ON order_product.product_id = product.product_id
Inner Join order_status ON cx_order.order_status_id = order_status.order_status_id
Inner Join tbladmin ON cx_order.affiliate_id = tbladmin.id
WHERE cx_order.order_id ='".$_REQUEST['OrderID']."'");
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
return true;
}
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
                   <?php include("includes/menu.php"); 
				   ?>
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
          <form action="<?php echo $pagename; ?>" method="post" class="" id="updateOrderForm" name="updateOrderForm">
           <input type="hidden" name="OrderID" value="<?php echo ($_REQUEST['OrderID']); ?>" />
           <fieldset>
    <legend>Customer</legend>
     <input type="hidden" name="OrderID" value="<?php echo ($_REQUEST['OrderID']); ?>" />
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="98%">
    <tr>
      <td colspan="3"> <h3 style="color:#39F"><b>Product Details</b></h3></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Product<span class="err">*</span></td>
    <td>
    <select name="strProduct" id="strProduct" class="required" onChange="getOrderDetails(this.value);">
	    <option value="">--Select--</option>
	    <?php  $ProdIDs = $sqli->get_selectData("SELECT * FROM  product");
			   foreach($ProdIDs as $ProdID){ ?>
	    <option value="<?php echo $ProdID['product_id']; ?>" <?php if($ProdID['product_id']==$orderDetails[0]['product_id']) echo "selected"; ?> >
		<?php echo $ProdID['model']; ?></option>
	    <?php } ?>
	    </select>
    </td>
    </tr>
   	<tr>
    <td>Quantity<span class="err">*</span></td>
    <td>
    	    <select name="strQuantity" id="strQuantity" onChange="getOrTotalDetails(getElementById('strProduct').value,this.value);">
             <option value="">--Select--</option>
             <?php for($i=10;$i<=200;$i=$i+10){
				 ?>
                 <option value="<?php echo $i; ?>"  <?php if($i==$orderDetails[0]['quantity']) echo "selected"; ?> ><?php echo $i; ?></option>
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
	<td><input type="text" class="required textbox" id="strFirstName" name="strFirstName" size="30" maxlength="30" value="<?php echo $orderDetails[0]['firstname'];?>" /></td></tr>
	<tr><td>Last Name <span class="err">*</span>:</td>
    
	<td><input type="text" class="required textbox" name="strLastName" id="strLastName" size="30" maxlength="30" value="<?php echo $orderDetails[0]['lastname'];?>" /></td>
  </tr>
  <tr>
    <td>Company</td>
    <td><input type="text" class="required textbox" name="strCompany" id="strCompany" size="30" maxlength="30" value="<?php echo $orderDetails[0]['shipping_company'];?>" /></td>
    </tr>
	<tr>
	  <td>Email id</td>
      <td><input type="text" class="required textbox" name="strEmailId" id="strEmailId" size="30" maxlength="30" value="<?php echo $orderDetails[0]['email'];?>"/></td>
	  </tr>
	<tr>
	  <td>Telephone  <span class="err">*</span>:</td>
	  <td><input type="text" class="required textbox" name="strTelephone" id="strTelephone" size="30" maxlength="30" value="<?php echo $orderDetails[0]['telephone'];?>"/>
      </td>
	  </tr>
	<tr>
	  <td>Fax :</td>
	  <td><input type="text" class="required textbox" name="strFax" id="strFax" size="30" maxlength="30" value="<?php echo $orderDetails[0]['fax'];?>" /></td>
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
    <input type="text" class="required textbox" name="stradd1" id="stradd1" size="30" maxlength="30" value="<?php echo $orderDetails[0]['shipping_address_1'];?>"/></td></tr>
    <tr>
    <td>Address 2</td>
    <td>
    <input type="text" class="required textbox" name="strAdd2" id="strAdd2" size="30" maxlength="30" value="<?php echo $orderDetails[0]['shipping_address_2'];?>" /></td></tr>
    <tr>
    <td>City</td>
    <td>
    <input type="text" class="required textbox" name="strCity" id="strCity" size="30" maxlength="30" value="<?php echo $orderDetails[0]['shipping_city'];?>"/></td></tr>
    <tr>
    <td>Postal Code <span class="err">*</span> :</td>
    <td>
    <input type="text" class="required textbox" name="strPIN" id="strPIN" size="30" maxlength="30" value="<?php echo $orderDetails[0]['shipping_postcode'];?>"/></td></tr>
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
    <select name="strregion" id="strregion" class="large-field">
    <option value="" selected="selected"> --- Please Select --- </option>
    <option value="3613" <?php if("3613"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>	>Alabama</option>
    <option value="3614" <?php if("3614"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>	>Alaska</option>
    <option value="3615" <?php if("3615"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>American Samoa</option>
    <option value="3616" <?php if("3616"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Arizona</option>
    <option value="3617" <?php if("3617"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Arkansas</option>
    <option value="3618" <?php if("3618"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Armed Forces Africa</option>
    <option value="3619" <?php if("3619"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Armed Forces Americas</option>
    <option value="3620" <?php if("3620"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Armed Forces Canada</option>
    <option value="3621" <?php if("3621"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Armed Forces Europe</option>
    <option value="3622" <?php if("3622"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Armed Forces Middle East</option>
    <option value="3623" <?php if("3623"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Armed Forces Pacific</option>
    <option value="3624" <?php if("3624"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>California</option>
    <option value="3625" <?php if("3625"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Colorado</option>
    <option value="3626" <?php if("3626"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Connecticut</option>
    <option value="3627" <?php if("3627"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Delaware</option>
    <option value="3628" <?php if("3628"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>District of Columbia</option>
    <option value="3629" <?php if("3629"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Federated States Of Micronesia</option>
    <option value="3630" <?php if("3630"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Florida</option>
    <option value="3631" <?php if("3631"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Georgia</option>
    <option value="3632" <?php if("3632"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Guam</option>
    <option value="3633" <?php if("3633"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Hawaii</option>
    <option value="3634" <?php if("3634"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Idaho</option>
    <option value="3635" <?php if("3635"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Illinois</option>
    <option value="3636" <?php if("3636"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Indiana</option>
    <option value="3637" <?php if("3637"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Iowa</option>
    <option value="3638" <?php if("3638"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Kansas</option>
    <option value="3639" <?php if("3639"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Kentucky</option>
    <option value="3640" <?php if("3640"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Louisiana</option>
    <option value="3641" <?php if("3641"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Maine</option>
    <option value="3642" <?php if("3642"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Marshall Islands</option>
    <option value="3643" <?php if("3643"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Maryland</option>
    <option value="3644" <?php if("3644"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Massachusetts</option>
    <option value="3645" <?php if("3645"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Michigan</option>
    <option value="3646" <?php if("3646"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Minnesota</option>
    <option value="3647" <?php if("3647"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Mississippi</option>
    <option value="3648" <?php if("3648"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Missouri</option>
    <option value="3649" <?php if("3649"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Montana</option>
    <option value="3650" <?php if("3650"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Nebraska</option>
    <option value="3651" <?php if("3651"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Nevada</option>
    <option value="3652" <?php if("3652"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>New Hampshire</option>
    <option value="3653" <?php if("3653"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>New Jersey</option>
    <option value="3654" <?php if("3654"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>New Mexico</option>
    <option value="3655" <?php if("3655"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>New York</option>
    <option value="3656" <?php if("3656"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>North Carolina</option>
    <option value="3657" <?php if("3657"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>North Dakota</option>
    <option value="3658" <?php if("3658"==$orderDetails[0]['shipping_zone_id']) echo "selected"; ?>>Northern Mariana Islands</option>
    </select></td></tr>
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
    <input id="rb_gender" type="radio" value="male" name="rb_gender"  <?php if("male"==$orderDetails[0]['PatientGender']) echo "checked"; ?> ></input>Male
    </label>
    <label>
    <input id="rb_gender" type="radio" value="Female" name="rb_gender" <?php if("Female"==$orderDetails[0]['PatientGender']) echo "checked"; ?>></input>Female
    </label>    
    </td></tr>
     <tr><td>Patient Height</td>
    <td><input type="text" class="required textbox" name="strHeight" id="strHeight" size="30" maxlength="30" value="<?php echo $orderDetails[0]['PatientHeight'];?>" /></td></tr>
     <tr><td>Patient DOB (mm/dd/yyyy)</td>
     <td><input type="text" class="required textbox" name="datetimeforcallback" id="datetimeforcallback" size="27" maxlength="30" value="<?php echo $orderDetails[0]['PatientDOB'];?>" /></td></tr>
  <tr><td>Patient Weight (lbs)</td>
   <td><input type="text" class="required textbox" name="strWeight" id="strWeight" size="30" maxlength="30" value="<?php echo $orderDetails[0]['PatientWeight'];?>" />
   </td></tr>
      <tr>
          <td>Reason for Ordering</td>
      <td>
      <input type="text" class="required textbox" name="strReason" id="strReason" size="30" maxlength="30" value="<?php echo $orderDetails[0]['ReasonforOrdering'];?>" />
      </td>
      </tr>
      <tr>
          <td>Prescribed Before</td>
<td><input type="text" class="required textbox" name="strPresBefore" id="strPresBefore" size="30" maxlength="30" value="<?php echo $orderDetails[0]['PrescribedBefore'];?>" />
</td>
      </tr>
      <tr>
          <td>Prescribed Date</td>
        <td><input type="text" class="required textbox" name="strPresDate" id="strPresDate" size="27" maxlength="30" value="<?php echo $orderDetails[0]['PrescribedDate'];?>" />
        </td>
      </tr>
      <tr>
          <td>Prescribed By </td>
          <td><input type="text" class="required textbox" name="strPresBy" id="strPresBy" size="30" maxlength="30"  value="<?php echo $orderDetails[0]['PrescribedBy'];?>"/>
          </td>
      </tr>
      <tr>
      	<td>Medical Condition </td>
		<td><input type="text" class="required textbox" name="strMedCon" id="strMedCon" size="30" maxlength="30" value="<?php echo $orderDetails[0]['MedicalConditions'];?>"/>
        </td>
      </tr>
      <tr>
      	<td>Allergies</td>
        <td>
        <input type="text" class="required textbox" name="strAllergies" id="strAllergies" size="30" maxlength="30" value="<?php echo $orderDetails[0]['Allergies'];?>"/>
        </td>
      </tr>
      <tr>
          <td>Physician</td>
          <td><input type="text" class="required textbox" name="strPhysician" id="strPhysician" size="30" maxlength="30" value="<?php echo $orderDetails[0]['Physician'];?>" /></td>
      </tr>
 </table>
  </td>
  <td valign="top" width="50%">
  <table>
          <tr>
          <td>Last Visit</td>
          <td><input type="text" class="required textbox" name="strlstVist" id="strlstVist" size="27" maxlength="30" value="<?php echo $orderDetails[0]['LastVisit'];?>" />
          </td>
          </tr>
		    <tr>
         	<td>Last Visit Reason</td>
			<td>
<input type="text" class="required textbox" name="strlstVistreason" id="strlstVistreason" size="30" maxlength="30" value="<?php echo $orderDetails[0]['LastVisitReason'];?>" />
            </td>
            </tr>
			<tr>
            <td>Primary Medical Care</td>
   			<td>
   <input type="text" class="required textbox" name="strPMedCare" id="strPMedCare" size="30" maxlength="30" value="<?php echo $orderDetails[0]['PrimaryMedicalCare'];?>"/>
   			</td>
           	</tr>
    		<tr>
            	<td>Health Insurance</td>
     			<td>
                <label>
          			<input name="rb_healthInsurance" value="Yes" id="rb_healthInsurance" type="radio" <?php if("Yes"==$orderDetails[0]['HealthInsurance']) echo "checked"; ?>>Yes</label>
        		<label>
          			<input name="rb_healthInsurance" value="No" id="rb_healthInsurance" type="radio" <?php if("No"==$orderDetails[0]['HealthInsurance']) echo "checked"; ?>>No</label>
     			</td></tr>   
        <tr>
          	<td>Ever Experienced Seizure</td>
			<td>
	        <label>
       		   <input name="rb_ExpSeizure" value="Yes" id="rb_ExpSeizure" type="radio" <?php if("Yes"==$orderDetails[0]['EverExperiencedSeizure']) echo "checked"; ?>>Yes</label>
            <label>
          	<input name="rb_ExpSeizure" value="No" id="rb_ExpSeizure" type="radio" <?php if("No"==$orderDetails[0]['EverExperiencedSeizure']) echo "checked"; ?>>No</label>
      	<tr>
		    <td>Liver / Kidney Disease</td>
    		<td>
        	<label>
          		<input name="rb_liverKidneyDisease" value="Yes" id="rb_liverKidneyDisease" type="radio" <?php if("Yes"==$orderDetails[0]['LiverKidneyDisease']) echo "checked"; ?>>Yes</label>
        	<label>
          		<input name="rb_liverKidneyDisease" value="No" id="rb_liverKidneyDisease" type="radio" <?php if("No"==$orderDetails[0]['LiverKidneyDisease']) echo "checked"; ?>>No</label>
		    </td>
  		</tr>
  		<tr>
    		<td>Consume Alcohol </td>
    		<td>
        	<label>
          		<input name="rb_consumeAlcohol" value="Yes" id="rb_consumeAlcohol" type="radio" <?php if("Yes"==$orderDetails[0]['ConsumeAlcohol']) echo "checked"; ?>>Yes</label>
            <label>
          		<input name="rb_consumeAlcohol" value="No" id="rb_consumeAlcohol" type="radio" <?php if("No"==$orderDetails[0]['ConsumeAlcohol']) echo "checked"; ?>>No</label>      
	      	</td>
  		</tr>
  		<tr>
    		<td>Opiate Dependent Patient </td>
  		  	<td>
        	<label>
          		<input name="rb_opiateDependentPatient" value="Yes" id="rb_opiateDependentPatient" type="radio" <?php if("Yes"==$orderDetails[0]['OpiateDependentPatient']) echo "checked"; ?>>Yes</label>
        	<label>
          		<input name="rb_opiateDependentPatient" value="No" id="rb_opiateDependentPatient" type="radio" <?php if("No"==$orderDetails[0]['OpiateDependentPatient']) echo "checked"; ?>>No</label>
      		</td>
  		</tr>
  		<tr>
    		<td>Taking Antidepressant</td>
  		  	<td>
        		<label>
	          		<input name="rb_takingAntidepressant" value="Yes" id="rb_takingAntidepressant" type="radio" <?php if("Yes"==$orderDetails[0]['TakingAntidepressant']) echo "checked"; ?>>Yes</label>
        		<label>
			        <input name="rb_takingAntidepressant" value="No" id="rb_takingAntidepressant" type="radio" <?php if("No"==$orderDetails[0]['TakingAntidepressant']) echo "checked"; ?>>No</label>
      		</td>
          </tr>
          <tr>
		    <td>Pregnant</td>
  			<td>
        		<label>
          			<input name="rb_pregnant" value="Yes" id="rb_pregnant" type="radio" <?php if("Yes"==$orderDetails[0]['Pregnant']) echo "checked"; ?>>Yes</label>
        		<label>
			        <input name="rb_pregnant" value="No" id="rb_pregnant" type="radio" <?php if("No"==$orderDetails[0]['Pregnant']) echo "checked"; ?>>No</label>
     		</td>
  		</tr>
  		<tr>
    		<td>Nursing </td>
  			<td>
        		<label>
          			<input name="rb_nursing" value="Yes" id="rb_nursing" type="radio" <?php if("Yes"==$orderDetails[0]['Nursing']) echo "checked"; ?>>Yes</label>
        		<label>
          			<input name="rb_nursing" value="No" id="rb_nursing" type="radio" <?php if("No"==$orderDetails[0]['Nursing']) echo "checked"; ?>>No</label>
          	</td>
  		</tr>
  		<tr>
    		<td>Trying to be pregnant </td>
  			<td>
        	<label>
          		<input name="rb_tryingPregnant" value="Yes" id="rb_tryingPregnant" type="radio" <?php if("Yes"==$orderDetails[0]['Tryingtobepregnant']) echo "checked"; ?>>Yes</label>
            <label>
          		<input name="rb_tryingPregnant" value="No" id="rb_tryingPregnant" type="radio" <?php if("No"==$orderDetails[0]['Tryingtobepregnant']) echo "checked"; ?>>No</label>
      </td>
  </tr>
  </table>
  </td>
  </tr>
  <tr><td align="center"> 
 	<div class="buttons">
    <input name="Update" value="Update" type="submit" onClick="return verify();">
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