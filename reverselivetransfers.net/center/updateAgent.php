<!-- this is a admin update form-->
<?php 
$page="updateAgent.php";
include("_session.php"); 
include("_dataAccess.php"); 

if(isset($_POST['Update']))
{
			
			if($_POST['str_ag_email']=="" || !filter_var($_POST['str_ag_email'], FILTER_VALIDATE_EMAIL) )
			{
					array_push($_SESSION['errmessage'],"Email Must be Filled in correct Format.");
			}
			if($_POST['str_ag_fname']==""  )
			{
					array_push($_SESSION['errmessage']," Please Fill First Name .");
			}
			if($_POST['str_ag_lname']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Fill Last Name .");
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
			
			if(count($_SESSION['errmessage'])==0)
			{
				
			$sqli->table='agent_user';
			$updateInformation['ag_password']		=	md5(trim($_POST['str_ag_password']));
			$updateInformation['ag_fname']			=	$_POST['str_ag_fname'];
			$updateInformation['ag_lname']			=	$_POST['str_ag_lname'];
			$updateInformation['ag_email']	   		=	$_POST['str_ag_email'];
			$updateInformation['ag_phone']			=	$_POST['str_ag_phone'];
			$updateInformation['ag_mobile']			=	$_POST['str_ag_mobile'];
			$updateInformation['ag_fax']			=	$_POST['str_ag_fax'];
			$updateInformation['ag_address']		=	$_POST['str_ag_address'];
			$updateInformation['ag_city']			=	$_POST['str_ag_city'];
			$updateInformation['ag_state']			=	$_POST['str_ag_state'];
			$updateInformation['ag_country']		=	$_POST['str_ag_country'];
			$updateInformation['ag_detail']			=	$_POST['str_ag_detail'];
			$updateInformation['ag_status']			=	1;
		
			$updateInformation['regdate']			=	date("y-m-d h:m:s");
			$fields 										= 	array_keys($updateInformation);
			$values											=	array_values($updateInformation);
			$sqli											->	autocommit(FALSE);
			$where=array('agid'=>$_POST['agent_id']);	
			$update_result= $sqli->Update_data($where,$values,$fields);
				if($update_result == 0)
				{
					$error	= 1;
					$sqli->rollback();
					array_push($_SESSION['errmessage'],"An Error Occurred in Saving Data.");
				}	
				
				else
				{
						$sqli									->	commit();
						array_push($_SESSION['message'],"Data Successfully Updated.");		
				}			
				pageRedirection("listagent.php");
	}
	else
	{
	$data[0]['ag_email']		= $_REQUEST['str_ag_email'];
	$data[0]['ag_fname']		=	$_REQUEST['str_ag_fname'];
	$data[0]['ag_lname']		=	$_REQUEST['str_ag_lname'];
	$data[0]['ag_phone']		=	$_REQUEST['str_ag_phone'];
	$data[0]['ag_mobile']		=	$_REQUEST['str_ag_mobile'];
	$data[0]['ag_fax']			=	$_REQUEST['str_ag_fax'];
	$data[0]['ag_address']		=	$_REQUEST['str_ag_address'];
	$data[0]['ag_city']		=	$_REQUEST['str_ag_city'];
	$data[0]['ag_state']		=	$_REQUEST['str_ag_state'];
	$data[0]['ag_country']		=	$_REQUEST['str_ag_country'];
	$data[0]['ag_detail']	=	$_REQUEST['str_ag_detail'];	
	
	}
	
}
		
?>
<?php include("includes/header.php"); 
   
if(isset($_GET['agentID']))
{
$strQuery1 ="Select * from agent_user where agid='".$_GET['agentID']."'";
$data=$sqli->get_selectData($strQuery1);
	//echo $data[0]['company_name'];
$strQuery12="select * from center_user";
$center=$sqli->get_selectData($strQuery12); 
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
    	  JQ("#updateadminForm").validate();
  });
  </script>             
 <div class="main_content">
                  <div class="menu">
                   <?php include("includes/menu.php"); ?>
                    </div> 
                    <div class="center_content">
      <div class="right_content">
        <h2> Update Agent </h2>
        
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
          <form action="" method="post" class="" id="updateagentForm" name="updateagentForm">
		 
           <fieldset>
    <legend>Agent User</legend><input type="hidden" name="agent_id" value="<?php echo $data[0]['agid']; ?>" />
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="900">
      <tr>
    <td>User Name :</td>
    <td><input type="text" class="required textbox" name="str_ag_username" id="str_ag_username" value="<?php echo $data[0]['ag_username']; ?>" readonly="readonly"/></td>
    <td>Email <span class="err">*</span>: </td>
    <td><input type="text" class="required textbox" name="str_ag_email" id="str_ag_email" value="<?php echo $data[0]['ag_email']; ?>"/></td>
  </tr>
   <tr>
    <td>Password <span class="err">*</span>:</td>
    <td><input type="password" class="required textbox" id="str_ag_password" name="str_ag_password"  /></td>
    <td>Confirm Password <span class="err">*</span>:</td>
    <td><input type="password" class="required textbox" id="confirmpassword" name="confirmpassword"   /></td>
	

	<tr>
	  <td>First Name <span class="err">*</span>:</td>
	  <td><input type="text" class="required textbox" name="str_ag_fname" id="str_ag_fname"  value= "<?php echo  $data[0]['ag_fname']; ?>"/></td>
	  <td>Last Name <span class="err">*</span>:</td>
	  <td><input type="text" class="required textbox" name="str_ag_lname" id="str_ag_lname"   value= "<?php echo  $data[0]['ag_lname']; ?>"/></td>
	  </tr>
	<tr>
	  <td align="left">Mobile:</td>
	  <td><input type="text" class="required textbox" name="str_ag_mobile" id="str_ag_mobile"  value= "<?php echo  $data[0]['ag_mobile']; ?>"/></td>
	  <td>Phone :</td>
	  <td><input type="text" class="required textbox" name="str_ag_phone" id="str_ag_phone"   value= "<?php echo  $data[0]['ag_phone']; ?>"/></td>
	  </tr>
	<tr>
	  <td valign="top">Fax :</td>
	  <td valign="top"><input type="text" class="required textbox" name="str_ag_fax" id="str_ag_fax"  value= "<?php echo  $data[0]['ag_fax']; ?>"/></td>
	  <td valign="top">Address :</td>
	  <td rowspan="3"><textarea name="str_ag_address" cols="32" rows="5" class="" id="str_ag_address"><?php echo  $data[0]['ag_address']; ?></textarea></td>
	  </tr>
	<tr>
	  <td>City :</td>
	  <td><input type="text" class="required textbox" name="str_ag_city" id="str_ag_city"   value= "<?php echo  $data[0]['ag_city']; ?>"/></td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td>State :</td>
	  <td><input type="text" class="required textbox" name="str_ag_state" id="str_ag_state"   value= "<?php echo  $data[0]['ag_state']; ?>"/></td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td valign="top">Country :</td>
	  <td valign="top"><input type="text" class="required textbox" name="str_ag_country" id="str_ag_country"  value= "<?php echo  $data[0]['ag_country']; ?>"/></td>
	  <td valign="top">Agent Details :</td>
	  <td><textarea name="str_ag_detail" id="str_ag_detail" cols="32" rows="5"><?php echo  $data[0]['ag_detail']; ?></textarea></td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td valign="top">&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="Update" id="Update" value="Update"/></td>
	  <td>&nbsp;</td>
	  </tr>
  
    </table>
  </fieldset>
          </form>
        </div>
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>