<?php 
$pagename = "updateAdmin.php"; 
include("_session.php"); 
include("_dataAccess.php"); 

if(isset($_POST['Update']))
{
			if($_POST['stremail']=="" || !filter_var($_POST['stremail'], FILTER_VALIDATE_EMAIL) )
			{
					array_push($_SESSION['errmessage'],"Email Must be Filled in correct Format.");
			}
			if($_POST['strfname']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Fill First Name .");
			}
			if($_POST['strlname']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Fill Last Name.");
			}
			if($_POST['strmobile']=="" || !is_numeric($_POST['strmobile']) )
			{			
					array_push($_SESSION['errmessage'],"Mobile Number Must be Filled in Numbers only.");
			}			
		
			
			if(count($_SESSION['errmessage'])==0)
			{	
			$error	=	0;
			$sqli->table='admin';
			$updateInformation['email']	   		=	$_POST['stremail'];
			$updateInformation['password']		=	md5(trim($_POST['strpassword']));
			$updateInformation['fname']			=	$_POST['strfname'];
			$updateInformation['lname']			=	$_POST['strlname'];
			$updateInformation['phone']			=	$_POST['strphone'];
			$updateInformation['mobile']		=	$_POST['strmobile'];
			$updateInformation['fax']			=	$_POST['strfax'];
			$updateInformation['address']		=	$_POST['straddress'];
			$updateInformation['city']			=	$_POST['strcity'];
			$updateInformation['state']			=	$_POST['strstate'];
			$updateInformation['country']		=	$_POST['strcountry'];
			$updateInformation['user_detail']	=	$_POST['struser_detail'];
			$updateInformation['status']		=	1;
			$updateInformation['upd_date']		=	date("y-m-d h:m:s");		
			
			$fields 										= 	array_keys($updateInformation);
			$values											=	array_values($updateInformation);
			$sqli											->	autocommit(FALSE);
			$where=array('adminid'=>$_POST['admin_id']);	
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
				
				pageRedirection("listadmin.php");
			
			exit;
	}
	else
	{
	$data[0]['email']		= $_REQUEST['stremail'];
	$data[0]['fname']		=	$_REQUEST['strfname'];
	$data[0]['lname']		=	$_REQUEST['strlname'];
	$data[0]['phone']		=	$_REQUEST['strphone'];
	$data[0]['mobile']		=	$_REQUEST['strmobile'];
	$data[0]['fax']			=	$_REQUEST['strfax'];
	$data[0]['address']		=	$_REQUEST['straddress'];
	$data[0]['city']		=	$_REQUEST['strcity'];
	$data[0]['state']		=	$_REQUEST['strstate'];
	$data[0]['country']		=	$_REQUEST['strcountry'];
	$data[0]['user_detail']	=	$_REQUEST['struser_detail'];	
	
	
	}
	
}
		
?>
<?php include("includes/header.php"); 
   
if(isset($_GET['adminID']))
{
$strQuery1 ="Select * from admin where adminid='".$_GET['adminID']."'";
   $data=$sqli->get_selectData($strQuery1);
	//echo $data[0]['company_name'];
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
        
         <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>  <h2> Update Admin</h2></td>
    <td align="right"><a href="listadmin.php"><img src="images/list-details.png" alt="" title="List Admin" border="0" /></a></td>
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
          <form action="" method="post" class="" id="updateadminForm">
		 
           <fieldset>
    <legend>Admin </legend>
    <input type="hidden" name="admin_id" value="<?php echo $data[0]['adminid']; ?>" />
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
      <tr>
    <td width="20%" align="right">User Name :</td>
    <td width="30%"><input type="text" readonly="readonly" class="required textbox" name="struser" id="struser" value="<?php echo $data[0]['ad_username']; ?>"/></td>
    <td width="10%" align="right" nowrap="nowrap">Email <span class="err">*</span>:</td>
    <td width="40%"><input type="text" class="required textbox" name="stremail" id="stremail" value="<?php echo $data[0]['email']; ?>"/></td>
  </tr>
 

	<tr>
	  <td width="20%" align="right">First Name <span class="err">*</span>:</td>
	  <td width="30%"><input type="text" class="required textbox" name="strfname" id="strfname" size="30" value= "<?php echo  $data[0]['fname']; ?>"/></td>
	  <td width="10%" align="right" nowrap="nowrap">Last Name <span class="err">*</span>:</td>
	  <td width="40%"><input type="text" class="required textbox" name="strlname" id="strlname" size="30"  value= "<?php echo  $data[0]['lname']; ?>"/></td>
	  </tr>
	<tr>
	  <td width="20%" align="right">Mobile<span class="err">*</span>:</td>
	  <td width="30%"><input type="text" class="required textbox" name="strmobile" id="strmobile" size="30" value= "<?php echo  $data[0]['mobile']; ?>"/></td>
	  <td width="10%" align="right" nowrap="nowrap">Phone :</td>
	  <td width="40%"><input type="text" class="required textbox" name="strphone" id="strphone" size="30"  value= "<?php echo  $data[0]['phone']; ?>"/></td>
	  </tr>
	<tr>
	  <td width="20%" align="right" valign="top">Fax :</td>
	  <td width="30%" valign="top"><input type="text" class="required textbox" name="strfax" id="strfax" size="30" value= "<?php echo  $data[0]['fax']; ?>"/></td>
	  <td width="10%" align="right" valign="top" nowrap="nowrap">Address :</td>
	  <td width="40%"><textarea name="straddress" cols="32" rows="5" class="" id="straddress"><?php echo  $data[0]['address']; ?></textarea></td>
	  </tr>
	<tr>
	  <td width="20%" align="right">City :</td>
	  <td width="30%"><input type="text" class="required textbox" name="strcity" id="strcity" size="30"  value= "<?php echo  $data[0]['city']; ?>"/></td>
	  <td width="10%" align="right" nowrap="nowrap">State :</td>
	  <td width="40%"><input type="text" class="required textbox" name="strstate" id="strstate" size="30"  value= "<?php echo  $data[0]['state']; ?>"/></td>
	  </tr>
	<tr>
	  <td width="20%" align="right" valign="top">Country :</td>
	  <td width="30%" valign="top"><input type="text" class="required textbox" name="strcountry" id="strcountry" size="30" value= "<?php echo  $data[0]['country']; ?>"/></td>
	  <td width="10%" align="right" valign="top" nowrap="nowrap">User Details :</td>
	  <td width="40%"><textarea name="struser_detail" id="struser_detail" cols="32" rows="5"><?php echo  $data[0]['user_detail']; ?></textarea></td>
	  </tr>
	<tr>
	  <td width="20%" align="right">&nbsp;</td>
	  <td width="30%">&nbsp;</td>
	  <td width="10%" align="right" nowrap="nowrap">&nbsp;</td>
	  <td width="40%">&nbsp;</td>
	  </tr>
	<tr>
	  <td width="20%" align="right" valign="top">&nbsp;</td>
	  <td width="30%">&nbsp;</td>
	  <td width="10%" align="right" nowrap="nowrap"><input type="submit" name="Update" id="Update" value="Update"/></td>
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
	
    <?php include("includes/footer.php"); ?>
   