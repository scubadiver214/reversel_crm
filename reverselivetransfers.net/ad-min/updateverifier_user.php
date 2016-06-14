<?php 
$pagename = "updateverifier_user.php"; 
include("_session.php"); 
include("_dataAccess.php"); 

if(isset($_GET['vfID']))
{
$strQuery1 ="Select * from verifier_user where verifier_id='".$_GET['vfID']."'";
$data=$sqli->get_selectData($strQuery1);
} 
else
{
    pageRedirection("listverifier_user.php");
}
if(isset($_POST['submit']))
{
			
			if($_POST['str_vf_alias']=="" )
			{
					array_push($_SESSION['errmessage'],"Please fill The Alias Name.");
			}
			if($_POST['str_vf_email']=="" || !filter_var($_POST['str_vf_email'], FILTER_VALIDATE_EMAIL) )
			{
					array_push($_SESSION['errmessage'],"Email Must be Filled in correct Format.");
			}
			if($_POST['str_vf_fname']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Fill First Name .");
			}
			if($_POST['str_vf_lname']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Fill Last Name.");
			}
			if($_POST['str_vf_mobile']=="" || !is_numeric($_POST['str_vf_mobile']) )
			{			
					array_push($_SESSION['errmessage'],"Mobile Number Must be Filled in Number.");
			}			
		
			if($_POST['str_vf_comp']=="" )
			{
					array_push($_SESSION['errmessage'],"Please fill the Company Name.");
			}
			
							
			if(count($_SESSION['errmessage'])==0)
			{
			
			$sqli->table='verifier_user';			
			$updateInformation['verifier_email']	    = $_POST['str_vf_email'];		
			$updateInformation['verifier_fname']	    = $_POST['str_vf_fname'];
			$updateInformation['verifier_lname']	    = $_POST['str_vf_lname'];
			$updateInformation['verifier_comp']	        = $_POST['str_vf_comp'];
			$updateInformation['verifier_comp_address']	= $_POST['str_vf_comp_address'];
			$updateInformation['verifier_city']	        = $_POST['str_vf_city'];
			$updateInformation['verifier_state']	    = $_POST['str_vf_state'];
			$updateInformation['verifier_country']	    = $_POST['str_vf_country'];
			$updateInformation['verifier_zipcode']	    = $_POST['str_vf_zipcode'];
			$updateInformation['verifier_phone']	    = $_POST['str_vf_phone'];
			$updateInformation['verifier_mobile']	    = $_POST['str_vf_mobile'];
			$updateInformation['verifier_fax']	        = $_POST['str_vf_fax'];
			$updateInformation['verifier_detail']	    = $_POST['str_vf_detail'];	
			$updateInformation['verifier_alias']	    = $_POST['str_vf_alias'];		
			$updateInformation['upd_date']		        =	date("y-m-d h:m:s");			
			
			$fields 										= 	array_keys($updateInformation);
			$values											=	array_values($updateInformation);
			$sqli											->	autocommit(FALSE);
			$where=array('verifier_id'=>$_POST['vf_id']);	
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
						array_push($_SESSION['message'],"Data Successfully Saved.");
		
				}
				pageRedirection("listverifier_user.php");
			
			
	}
	else
	{
		
			$data[0]['verifier_username']	  =	$_REQUEST['str_vf_username'];
			$data[0]['verifier_email']	      =	$_REQUEST['str_vf_email'];
			$data[0]['verifier_fname']	      = $_REQUEST['str_vf_fname'];
			$data[0]['verifier_lname']	      = $_REQUEST['str_vf_lname'];
			$data[0]['verifier_comp']	      = $_REQUEST['str_vf_comp'];
			$data[0]['verifier_comp_address'] = $_REQUEST['str_vf_comp_address'];
			$data[0]['verifier_city']	      = $_REQUEST['str_vf_city'];
			$data[0]['verifier_state']	      = $_REQUEST['str_vf_state'];
			$data[0]['verifier_country']	  = $_REQUEST['str_vf_country'];
			$data[0]['verifier_zipcode']	  = $_REQUEST['str_vf_zipcode'];
			$data[0]['verifier_phone']	      = $_REQUEST['str_vf_phone'];
			$data[0]['verifier_mobile']	      = $_REQUEST['str_vf_mobile'];
			$data[0]['verifier_fax']	      = $_REQUEST['str_vf_fax'];
			$data[0]['verifier_detail']	      = $_REQUEST['str_vf_detail'];		
			$data[0]['verifier_alias']	      = $_REQUEST['str_vf_alias'];
			
	
	
	}
	
}
		
include("includes/header.php"); 
   

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
    <td>  <h2> Update Verifier</h2></td>
    <td align="right"><a href="listverifier_user.php"><img src="images/list-details.png" alt="" title="List Verifiers" border="0" /></a></td>
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
          <form action="" method="post" class="" id="verifierForm" name="verifierForm">
       
           <fieldset>
    <legend>Verifier Details</legend><input type="hidden" name="vf_id" value="<?php echo $data[0]['verifier_id']; ?>" />
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
  <tr>
    <td><table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
      
      <tr>
        <td width="20%" align="right" nowrap="nowrap">User Name :</td>
        <td width="30%"><input name="str_vf_username" type="text" class="required textbox" id="str_vf_username" value= "<?php echo $data[0]['verifier_username']; ?>" size="30" maxlength="30" readonly="readonly" />
		</td>
        <td width="10%" align="right" nowrap="nowrap">Email id <span class="err">*</span>:</td>
        <td width="40%"><input name="str_vf_email" type="text" class="required textbox" id="str_vf_email" value= "<?php echo $data[0]['verifier_email']; ?>" size="30" maxlength="30" /></td>
        </tr>
      
      <tr>
        <td width="20%" align="right" nowrap="nowrap">First Name <span class="err">*</span>:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_vf_fname" id="str_vf_fname" size="30" value= "<?php echo $data[0]['verifier_fname']; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">Last Name <span class="err">*</span>:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_vf_lname" id="str_vf_lname" size="30"  value= "<?php echo $data[0]['verifier_lname'] ; ?>"/></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Company<span class="err">*</span> :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_vf_comp" id="str_vf_comp" size="30" value= "<?php echo $data[0]['verifier_comp']; ?>" /></td>
        <td width="10%" align="right" nowrap="nowrap">Cell  Phone Number<span class="err">*</span>:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_vf_mobile" id="str_vf_mobile" size="30" value= "<?php echo $data[0]['verifier_mobile']; ?>" /></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">City :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_vf_city" id="str_vf_city" size="30"  value= "<?php echo $data[0]['verifier_city']; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">Alias Name<span class="err">*</span>:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_vf_alias" id="str_vf_alias" size="30" value= "<?php echo $data[0]['verifier_alias']; ?>"/></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">State :</td>
        <td width="30%">
               
         <select name="str_vf_state" id="str_vf_state">
         <option value="" selected="selected">- Select -</option>
         <?php
	$strQuery14="select * from zone where country_id=223";
$datastate=$sqli->get_selectData($strQuery14); 
	
	 foreach($datastate as $key=>$valuestate){?>
         <option value="<?php echo $valuestate['code'];?>"<?php if($data[0]['verifier_state']==$valuestate['code']){echo "selected=\"selected\"";} ?>> <?php echo $valuestate['name'];?></option>
         <?php }?>
       </select>
       
       
       </td>
        <td width="10%" align="right" nowrap="nowrap">Country :</td>
        <td width="40%"><input type="text" class="required textbox" name="str_vf_country" id="str_vf_country" size="30" value= "<?php echo $data[0]['verifier_country']; ?>"/></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Zipcode :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_vf_zipcode" id="str_vf_zipcode" size="30" value= "<?php echo $data[0]['verifier_zipcode'] ?>" /></td>
        <td width="10%" align="right" nowrap="nowrap">Company Address:</td>
        <td width="40%" rowspan="3"><textarea name="str_vf_comp_address" cols="32" rows="5" class="" id="str_vf_comp_address"><?php echo $data[0]['verifier_comp_address']; ?></textarea></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Phone :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_vf_phone" id="str_vf_phone" size="30"  value= "<?php echo $data[0]['verifier_phone']; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right" valign="top" nowrap="nowrap">Fax :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_vf_fax" id="str_vf_fax" size="30" value= "<?php echo $data[0]['verifier_fax']; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">&nbsp;</td>
        </tr>
     
        
        <tr>
        <td width="20%" align="right" valign="top" nowrap="nowrap">Details :</td>
        <td width="30%" valign="top"> 
       <textarea name="str_vf_detail" id="str_vf_detail" cols="32" rows="5"><?php echo$data[0]['verifier_detail'] ; ?>
     </textarea>
        </td>
        
        <td width="10%" align="right" valign="top" nowrap="nowrap"></td>
        <td width="40%" valign="top">
       
       
     </td>
        </tr>
      
      
      
      <tr>
        <td width="20%" align="right" valign="top" nowrap="nowrap">&nbsp;</td>
        <td width="30%"> <input type="submit" name="submit" id="Update" value="Update"/>;</td>
        <td width="10%" align="right" nowrap="nowrap">&nbsp;</td>
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
   