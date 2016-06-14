<?php 
$pagename = "updatecenter_user.php"; 
include("_session.php"); 
include("_dataAccess.php"); 

if(isset($_POST['submit']))
{
			
			if($_POST['str_cen_email']=="" || !filter_var($_POST['str_cen_email'], FILTER_VALIDATE_EMAIL) )
			{
					array_push($_SESSION['errmessage'],"Email Must be Filled in correct Format.");
			}
			if($_POST['str_cen_fname']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Fill First Name.");
			}
			if($_POST['str_cen_lname']=="")
			{
					array_push($_SESSION['errmessage'],"Please Fill Last Name.");
			}				
		
			if($_POST['str_cen_comp']=="" )
			{
					array_push($_SESSION['errmessage'],"Please fill the Company Name.");
			}			
			
			if(count($_SESSION['errmessage'])==0)
			{
			
			$sqli->table='center_user';			
			$updateInformation['cen_email']		=$_POST['str_cen_email'];		
			$updateInformation['cen_fname']		=$_POST['str_cen_fname'];
			$updateInformation['cen_lname']		=$_POST['str_cen_lname'];
			$updateInformation['cen_comp']		=$_POST['str_cen_comp'];
			$updateInformation['cen_comp_address']	=$_POST['str_cen_comp_address'];
			$updateInformation['cen_city']		=$_POST['str_cen_city'];
			$updateInformation['cen_state']		=$_POST['str_cen_state'];
			$updateInformation['cen_country']	=$_POST['str_cen_country'];
			$updateInformation['cen_zipcode']	=$_POST['str_cen_zipcode'];
			$updateInformation['cen_phone']		=$_POST['str_cen_phone'];
			$updateInformation['cen_mobile']	=$_POST['str_cen_mobile'];
			$updateInformation['cen_fax']		=$_POST['str_cen_fax'];
            $updateInformation['cen_skype']	    =$_POST['str_cen_skype'];
            $updateInformation['cen_other_id']  =$_POST['str_cen_other_id']; 
			$updateInformation['cen_detail']	=$_POST['str_cen_detail'];
			$updateInformation['acno']			=$_POST['str_acno'];
			$updateInformation['acname']		=$_POST['str_acname'];
			$updateInformation['bank']			=$_POST['str_bank'];
			$updateInformation['bank_address']	=$_POST['str_bank_address'];
			$updateInformation['bank_city']		=$_POST['str_bank_city'];
			$updateInformation['bank_state']	=$_POST['str_bank_state'];
			$updateInformation['bank_country']	=$_POST['str_bank_country'];
			$updateInformation['swiftcode']		=$_POST['str_swiftcode'];
			$updateInformation['otherdetail']	=$_POST['str_otherdetail'];
			$updateInformation['cen_status']	=	1;
			$updateInformation['upd_date']		=	date("y-m-d h:m:s");
			
			
			$fields 										= 	array_keys($updateInformation);
			$values											=	array_values($updateInformation);
			$sqli											->	autocommit(FALSE);
			$where=array('cenid'=>$_POST['cen_id']);	
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
			pageRedirection("listcenter_user.php");
			
	}
	else
	{
			
			$data[0]['cen_email']	 =	$_REQUEST['str_cen_email'];
			$data[0]['cen_fname']	= $_REQUEST['str_cen_fname'];
			$data[0]['cen_lname']	= $_REQUEST['str_cen_lname'];
			$data[0]['cen_comp']	= $_REQUEST['str_cen_comp'];
			$data[0]['cen_comp_address']	= $_REQUEST['str_cen_comp_address'];
			$data[0]['cen_city']	= $_REQUEST['str_cen_city'];
			$data[0]['cen_state']	= $_REQUEST['str_cen_state'];
			$data[0]['cen_country']	= $_REQUEST['str_cen_country'];
			$data[0]['cen_zipcode']	= $_REQUEST['str_cen_zipcode'];
			$data[0]['cen_phone']	= $_REQUEST['str_cen_phone'];
			$data[0]['cen_mobile']	= $_REQUEST['str_cen_mobile'];
			$data[0]['cen_fax']	    = $_REQUEST['str_cen_fax'];
            $data[0]['cen_skype']	= $_REQUEST['str_cen_skype'];
            $data[0]['cen_other_id']	= $_REQUEST['str_cen_other_id'];
            
            
			$data[0]['cen_detail']	= $_REQUEST['str_cen_detail'];
			$data[0]['acno']	= $_REQUEST['str_acno'];
			$data[0]['acname']	= $_REQUEST['str_acname'];
			$data[0]['bank']	= $_REQUEST['str_bank'];
			$data[0]['bank_address']	= $_REQUEST['str_bank_address'];
			$data[0]['bank_city']	= $_REQUEST['str_bank_city'];
			$data[0]['bank_state']	= $_REQUEST['str_bank_state'];
			$data[0]['bank_country']	= $_REQUEST['str_bank_country'];
			$data[0]['swiftcode']	= $_REQUEST['str_swiftcode'];
			$data[0]['otherdetail']	= $_REQUEST['str_otherdetail'];
			
	
	
	}
	
}
		
?>
<?php include("includes/header.php"); 
   
if(isset($_GET['centerID']))
{
$strQuery1 ="Select * from center_user where cenid='".$_GET['centerID']."'";
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
    <td>  <h2> Update Affiliate User </h2></td>
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
          <form action="" method="post" class="" id="centerForm" name="centerForm">
       
           <fieldset>
    <legend>Center User</legend><input type="hidden" name="cen_id" value="<?php echo $data[0]['cenid']; ?>" />
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
  <tr>
    <td><table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
      <tr>
        <td width="20%" align="right" nowrap="nowrap">User Name:</td>
        <td width="30%"><label><?php echo $data[0]['cen_username']; ?></label></td>
        <td width="10%" align="right" nowrap="nowrap">Email id <span class="err">*</span>:</td>
        <td width="40%"><input name="str_cen_email" type="text" class="required textbox" id="str_cen_email" value= "<?php echo $data[0]['cen_email']; ?>" size="30"/></td>
        </tr>
    
      <tr>
        <td width="20%" align="right" nowrap="nowrap">First Name <span class="err">*</span>:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_fname" id="str_cen_fname" size="30" value= "<?php echo $data[0]['cen_fname']; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">Last Name <span class="err">*</span>:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_cen_lname" id="str_cen_lname" size="30"  value= "<?php echo $data[0]['cen_lname'] ; ?>"/></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Company<span class="err">*</span> :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_comp" id="str_cen_comp" size="30" value= "<?php echo $data[0]['cen_comp']; ?>" /></td>
        <td width="10%" align="right" nowrap="nowrap">Company Address:</td>
        <td width="40%" rowspan="3"><textarea name="str_cen_comp_address" cols="32" rows="5" class="" id="str_cen_comp_address"><?php echo $data[0]['cen_comp_address']; ?></textarea></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">City :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_city" id="str_cen_city" size="30"  value= "<?php echo $data[0]['cen_city']; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">State :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_state" id="str_cen_state" size="30"  value= "<?php echo $data[0]['cen_state']; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Zipcode :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_zipcode" id="str_cen_zipcode" size="30" value= "<?php echo $data[0]['cen_zipcode'] ?>" /></td>
        <td width="10%" align="right" nowrap="nowrap">Country :</td>
        <td width="40%"><input type="text" class="required textbox" name="str_cen_country" id="str_cen_country" size="30" value= "<?php echo $data[0]['cen_country']; ?>"/></td>
        </tr>
         <tr>
        <td width="20%" align="right" nowrap="nowrap">Skype ID :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_skype" id="str_cen_skype" size="30" value= "<?php echo $data[0]['cen_skype']; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">Other ID</td>
        <td width="40%"><input type="text" class="required textbox" name="str_cen_other_id" id="str_cen_other_id" size="30" value= "<?php echo $data[0]['cen_other_id']; ?>"/></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Phone :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_phone" id="str_cen_phone" size="30"  value= "<?php echo $data[0]['cen_phone']; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">Cell Phone Number:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_cen_mobile" id="str_cen_mobile" size="30" value= "<?php echo $data[0]['cen_mobile']; ?>" /></td>
        </tr>
      <tr>
        <td width="20%" align="right" valign="top" nowrap="nowrap"> Detail</td>
        <td width="30%"><textarea name="str_cen_detail" id="str_cen_detail" cols="32" rows="5"><?php echo $data[0]['cen_detail'] ; ?>
     </textarea></td>
        <td width="10%" align="right" valign="top" nowrap="nowrap">Fax :</td>
        <td width="40%" valign="top"><input type="text" class="required textbox" name="str_cen_fax" id="str_cen_fax" size="30" value= "<?php echo $data[0]['cen_fax']; ?>"/></td>
        </tr>
        
      
    </table></td>
    </tr>
  </table>
           </fieldset>
           
           <fieldset>
    <legend>Center Account Details </legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
  <tr>
    <td><table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
   
   <tr>
     <td width="40%" align="right">A/c Name:</td>
     <td width="60%"><input type="text" class="required textbox" name="str_acname" id="str_acname" size="30" value= "<?php echo $data[0]['acname']; ?>" /></td>
   </tr>
   <tr>
     <td width="40%" align="right">Bank :</td>
     <td width="60%"><input type="text" class="required textbox" name="str_bank" id="str_bank" size="30" value= "<?php echo $data[0]['bank'];  ?>" /></td>
   </tr>
   <tr>
     <td width="40%" align="right">Bank City:</td>
     <td width="60%"><input type="text" class="required textbox" name="str_bank_city" id="str_bank_city" size="30" value= "<?php echo $data[0]['bank_city']; ?>" /></td>
   </tr>
   <tr>
     <td width="40%" align="right">Bank State:</td>
     <td width="60%"><input type="text" class="required textbox" name="str_bank_state" id="str_bank_state" size="30" value= "<?php echo $data[0]['bank_state']; ?>" /></td>
   </tr>
   <tr>
     <td width="40%" align="right">Bank Country:</td>
     <td width="60%"><input type="text" class="required textbox" name="str_bank_country" id="str_bank_country" size="30" value= "<?php echo $data[0]['bank_country']; ?>" /></td>
   </tr>
   <tr>
     <td width="40%" align="right">Swift Code :</td>
     <td width="60%"><input type="text" class="required textbox" name="str_swiftcode" id="str_swiftcode" size="30" value= "<?php echo $data[0]['swiftcode']; ?>" /></td>
   </tr>
   <tr>
     <td width="40%" align="right">&nbsp;</td>
     <td width="60%">&nbsp;</td>
   </tr>
   <tr>
     <td width="40%" align="right">&nbsp;</td>
     <td width="60%">&nbsp;</td>
   </tr>
   <tr>
     <td width="40%" align="right">&nbsp;</td>
     <td width="60%">&nbsp;</td>
   </tr>
   <tr>
     <td width="40%" align="right">&nbsp;</td>
     <td width="60%">&nbsp;</td>
   </tr>
   <tr>
    <td width="40%" align="right">&nbsp;</td>
    <td width="60%">&nbsp;</td>
  </tr>
  
  </table></td>
    <td>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
   <tr>
     <td width="30%" align="right">A/C No:</td>
     <td width="70%"><input type="text" class="required textbox" name="str_acno" id="str_acno" size="30" value= "<?php echo $data[0]['acno']; ?>" /></td>
   </tr>
   <tr>
     <td width="30%" align="right" valign="top">Bank Address:</td>
     <td width="70%"><textarea name="str_bank_address" id="str_bank_address" cols="32" rows="5"><?php echo $data[0]['bank_address']; ; ?>
     </textarea></td>
   </tr>
   <tr>
     <td width="30%" align="right" valign="top">Other Details :</td>
     <td width="70%"><textarea name="str_otherdetail" id="str_otherdetail" cols="32" rows="5"><?php echo $data[0]['otherdetail']; ; ?>
     </textarea></td>
   </tr>
   <tr>
     <td width="30%" align="right">&nbsp;</td>
     <td width="70%">&nbsp;</td>
   </tr>
   <tr>
     <td width="30%" align="left"><input type="submit" name="submit" id="Update" value="Update"/></td>
     <td width="70%">&nbsp;</td>
   </tr>
   <tr>
    <td width="30%" align="right">&nbsp;</td>
    <td width="70%">&nbsp;</td>
  </tr>
  </table></td>
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
   