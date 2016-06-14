<?php 
include("_session.php");
include("_dataAccess.php");
$pagename = "agent_user.php"; 
if(isset($_POST['submit']))
{		
				
			if($_POST['str_ag_username']=="")
			{
					array_push($_SESSION['errmessage'],"Please fill The User Name First.");
			}
			if($_POST['str_ag_email']=="" || !filter_var($_POST['str_ag_email'], FILTER_VALIDATE_EMAIL) )
			{
					array_push($_SESSION['errmessage'],"Email Must be Filled in correct Format.");
			}
			if($_POST['str_ag_center']=="" || $_POST['str_center']=="")
			{
					array_push($_SESSION['errmessage'],"Center Name Not Found.");
			}
			if($_POST['str_ag_fname']==""  )
			{
					array_push($_SESSION['errmessage'],"Please Fill First Name.");
			}
			if($_POST['str_ag_lname']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Fill Last Name .");
			}
			if($_POST['str_ag_mobile']=="" || !is_numeric($_POST['str_ag_mobile']) )
			{			
					array_push($_SESSION['errmessage'],"Mobile Number Must be Filled in Number only.");
			}
			
			if($_POST['str_ag_password']=="" || $_POST['confirmpassword']=="")
			{
					array_push($_SESSION['errmessage'],"Please Fill Password.");
			}
			if($_POST['str_ag_password']!="" && $_POST['confirmpassword']!="")
			{
					if($_POST['str_ag_password']!=$_POST['confirmpassword'])
				   {
					  array_push($_SESSION['errmessage'],"Passwords Don't match.");
				   }
			}
			$strQuery ="SELECT * FROM agent_user WHERE ag_username = '".$_POST['str_ag_username'] ."'"; 
			$data=$sqli->get_selectData($strQuery);
            if (!empty($data)) 
            { 
             array_push($_SESSION['errmessage'],"Users with the same User Name already exists, Please choose another User Name.");
            }
			
			if(count($_SESSION['errmessage'])==0)
			{
			
			$sqli->table='agent_user';
			
			$insertInformation['ag_username']	   	=	$_POST['str_ag_username'];
			$insertInformation['ag_center']	   		=	$_POST['str_ag_center'];
			$insertInformation['ag_email']	   		=	$_POST['str_ag_email'];
			$insertInformation['ag_password']		=	md5(trim($_POST['str_ag_password']));
			$insertInformation['ag_fname']			=	$_POST['str_ag_fname'];
			$insertInformation['ag_lname']			=	$_POST['str_ag_lname'];
			$insertInformation['ag_phone']			=	$_POST['str_ag_phone'];
			$insertInformation['ag_mobile']			=	$_POST['str_ag_mobile'];
			$insertInformation['ag_fax']			=	$_POST['str_ag_fax'];            
            $insertInformation['ag_skype']		    =	$_POST['str_ag_skype'];
            $insertInformation['ag_other_id']	    =	$_POST['str_ag_other_id'];            
			$insertInformation['ag_address']		=	$_POST['str_ag_address'];
			$insertInformation['ag_city']			=	$_POST['str_ag_city'];
			$insertInformation['ag_state']			=	$_POST['str_ag_state'];
			$insertInformation['ag_country']		=	$_POST['str_ag_country'];
			$insertInformation['ag_detail']			=	$_POST['str_ag_detail'];
			$insertInformation['ag_status']			=	1;
			$insertInformation['cen_status']	   	=	$_POST['str_cen_status'];
			$insertInformation['regdate']			=	date("y-m-d h:m:s");
			
			$fields 								= 	array_keys($insertInformation);
			$values									=	array_values($insertInformation);
			$sqli									->	autocommit(FALSE);
			$insert_result 							=	$sqli			->	Insert_data($fields,$values);
			if($insert_result!=1)
			{
				$sqli->rollback();
				array_push($_SESSION['errmessage'],"An Error Occurred in Saving Data.");
			}
			else
			{
				$insertedvalue							=	$sqli			->	insert_id;
				$sqli									->	commit();
				array_push($_SESSION['message'],"Data Successfully Saved.");
				
			}
	
		pageRedirection("listagent.php");
		}
			else
			{
			$data[0]['cenid'] = $_REQUEST['str_ag_center'];
			$data[0]['cen_status'] = $_REQUEST['str_cen_status'];
				
			$data[0]['cen_comp'] =	$_REQUEST['str_center'];
			$username =	$_POST['str_ag_username'];
			$email	=	$_REQUEST['str_ag_email'];
			$fname	=	$_REQUEST['str_ag_fname'];
			$lname	=	$_REQUEST['str_ag_lname'];
			$phone	=	$_REQUEST['str_ag_phone'];
			$mobile	=	$_REQUEST['str_ag_mobile'];
			$fax	=	$_REQUEST['str_ag_fax'];
			$address =	$_REQUEST['str_ag_address'];
			$city =	$_REQUEST['str_ag_city'];
			$state =	$_REQUEST['str_ag_state'];
			$country =	$_REQUEST['str_ag_country'];
			$user_detail	=	$_REQUEST['str_ag_detail'];
			
		}	
	
	
}

?>
<?php include("includes/header.php");

if(isset($_GET['centerID']))
{
$strQuery1 ="Select * from center_user where cenid='".$_GET['centerID']."'";
$data=$sqli->get_selectData($strQuery1);
	//echo $data[0]['company_name'];
$strQuery2 ="Select * from center_user where cenid='".$_GET['centerID']."'";
$datacenter=$sqli->get_selectData($strQuery2);
} 
 ?>
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
      <div class="right_content">            
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>Agent Form</h2></td>
    <td align="right"><a href="listcenter_user.php"><img src="images/list-details.png" alt="" title="List Center" border="0" /></a></td>
  </tr>
</table>

        
        <?php  foreach($_SESSION['message'] as $msg){ ?>
        <div class="valid_box">
        <?php echo $msg; ?>
     </div>
     <?php } ?>
     <?php  foreach($_SESSION['errmessage'] as $msg){ ?>
        <div class="error_box">
        <?php echo $msg; ?>
     </div>
     <?php } ?>
        <div class="form">
          <form action="<?php echo $pagename; ?>" method="post" class="" id="agentForm" name="agentForm">
           <fieldset>
    <legend>Agent of <?PHP echo $datacenter[0]['cen_comp']; ?></legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
  <tr><input type="hidden" name="str_cen_status" value= "<?php echo $data[0]['cen_status']; ?>"/>
  <input type="hidden"  name="str_ag_center"  id="str_ag_center" value= "<?php echo $data[0]['cenid']; ?>" />
 
   <td width="20%" align="right"> Center Name:</td>
   <td><input type="text" class="required textbox" name="str_center" size="30" id="str_center" maxlength="30" value= "<?php echo $data[0]['cen_comp']; ?>" readonly="readonly"/></td>
    <td width="10%">&nbsp;</td>
    <td width="40%" nowrap="nowrap">&nbsp;</td>
    </tr>
  <tr>
    <td width="20%" align="right" nowrap="nowrap">User Name <span class="err">*</span>:</td>
    <td width="30%"><input type="text" class="required textbox" name="str_ag_username" size="30" id="str_ag_username" maxlength="30" value= "<?php echo $username; ?>" Autocomplete="off"/> <div id="statusbox"></div>
   </td>
    <td width="10%" nowrap="nowrap">Email id <span class="err">*</span>:</td>
    <td width="40%"><input type="text" class="required textbox" name="str_ag_email" size="30" id="str_ag_email" maxlength="30" value= "<?php echo $email; ?>"/></td>
    </tr>
  <tr>
    <td width="20%" align="right" nowrap="nowrap">Password <span class="err">*</span>:</td>
    <td width="30%"><input type="password" class="required textbox" id="str_ag_password" name="str_ag_password" size="20" /></td>
    <td width="10%" nowrap="nowrap">Confirm Password <span class="err">*</span>:</td>
    <td width="40%"><input type="password" class="required textbox" id="confirmpassword" name="confirmpassword" size="20"  /></td>
	</tr>

	<tr>
	  <td width="20%" align="right" nowrap="nowrap">First Name <span class="err">*</span>:</td>
	  <td width="30%"><input type="text" class="required textbox" name="str_ag_fname" id="str_ag_fname" size="30" value= "<?php echo $fname; ?>"/></td>
	  <td width="10%" nowrap="nowrap">Last Name <span class="err">*</span>:</td>
	  <td width="40%"><input type="text" class="required textbox" name="str_ag_lname" id="str_ag_lname" size="30"  value= "<?php echo $lname; ?>"/></td>
	  </tr>
	<tr>
	  <td width="20%" align="right" nowrap="nowrap">Mobile<span class="err">*</span>:</td>
	  <td width="30%"><input type="text" class="required textbox" name="str_ag_mobile" id="str_ag_mobile" size="30" value= "<?php echo $mobile; ?>"/></td>
	  <td width="10%" nowrap="nowrap">Phone :</td>
	  <td width="40%"><input type="text" class="required textbox" name="str_ag_phone" id="str_ag_phone" size="30"  value= "<?php echo $phone; ?>"/></td>
	  </tr>
	 <tr>
        <td width="20%" align="right" valign="top">Skype ID :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_ag_skype" id="str_ag_skype" size="30" value= "<?php echo $ag_skype; ?>"/></td>
        <td width="10%" nowrap="nowrap">Other ID</td>
        <td width="40%" ><input type="text" class="required textbox" name="str_ag_other_id" id="str_ag_other_id" size="30" value= "<?php echo $ag_other_id; ?>"/></td>
        </tr>
	<tr>
	  <td width="20%" align="right" valign="top" nowrap="nowrap">Fax :</td>
	  <td width="30%" valign="top"><input type="text" class="required textbox" name="str_ag_fax" id="str_ag_fax" size="30" value= "<?php echo $fax; ?>"/></td>
	  <td width="10%" valign="top" nowrap="nowrap">Address :</td>
	  <td width="40%" rowspan="3"><textarea name="str_ag_address" cols="32" rows="5" class="" id="str_ag_address"><?php echo $address; ?></textarea></td>
	  </tr>
	<tr>
	  <td width="20%" align="right" valign="top" nowrap="nowrap">City :</td>
	  <td width="30%"><input type="text" class="required textbox" name="str_ag_city" id="str_ag_city" size="30"  value= "<?php echo $city; ?>"/></td>
	  <td width="10%" nowrap="nowrap">&nbsp;</td>
	  </tr>
	<tr>
	  <td width="20%" align="right" valign="top" nowrap="nowrap">State :</td>
	  <td width="30%"><input type="text" class="required textbox" name="str_ag_state" id="str_ag_state" size="30"  value= "<?php echo $state; ?>"/></td>
	  <td width="10%" nowrap="nowrap">&nbsp;</td>
	  </tr>
	<tr>
	  <td width="20%" align="right" valign="top" nowrap="nowrap">Country :</td>
	  <td width="30%" align="left" valign="top"><input type="text" class="required textbox" name="str_ag_country" id="str_ag_country" size="30" value= "<?php echo $country; ?>"/></td>
	  <td width="10%" align="left" valign="top" nowrap="nowrap">Agent Details:</td>
	  <td width="40%" align="left" valign="top"><textarea name="str_ag_detail" id="str_ag_detail" cols="32" rows="5"><?php echo $user_detail; ?></textarea></td>
	  </tr>
	
	<tr>
	  <td width="20%" align="right" nowrap="nowrap">&nbsp;</td>
	  <td width="30%">&nbsp;</td>
	  <td width="10%" nowrap="nowrap"><input type="submit" name="submit" id="submit" value="Submit"/></td>
	  <td width="40%">&nbsp;</td>
	  </tr>
  
    </table>
  </fieldset>
          </form>
        </div>  
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <script>

	var Ajx = jQuery.noConflict();
	
  Ajx( '#str_ag_username' ).change(function() {
	  var uname =  Ajx("#str_ag_username").val();
	  
   var dataString = 'ag_uname='+uname;
   
   Ajx.ajax({
     type: "GET",
     url: "checkagent_availibilty.php?"+dataString,
     data: dataString,
     cache: false,
     success: function(result){
		 if(Ajx.trim(result)=='0')
        Ajx( "#str_ag_username" ).removeClass( "nameavailable" ).addClass( "namenotavailable" );
		else  Ajx( "#str_ag_username" ).removeClass( "namenotavailable" ).addClass( "nameavailable" );
     }
   });
   
  });
 
 Ajx( '#str_ag_username' ).click(function() {
	Ajx( "#str_ag_username" ).removeClass( "nameavailable" ).addClass( "" );
	Ajx( "#str_ag_username" ).removeClass( "namenotavailable" ).addClass( "" );
	 });
  </script>
    <?php include("includes/footer.php"); ?>
   