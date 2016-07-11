<?php 
$pagename = "updateclient_user.php"; 
include("_session.php"); 
include("_dataAccess.php");

if(isset($_GET['clientID']))
{
$strQuery1 ="Select * from client_user where cltid='".$_GET['clientID']."'";
$data=$sqli->get_selectData($strQuery1);
} 
else
{
    pageRedirection("listclient_user.php");
}
if(isset($_POST['submit']))
{
			
			if($_POST['str_clt_email']=="" || !filter_var($_POST['str_clt_email'], FILTER_VALIDATE_EMAIL) )
			{
					array_push($_SESSION['errmessage'],"Email Must be Filled in correct Format.");
			}
			if($_POST['str_clt_alias']=="" )
			{
					array_push($_SESSION['errmessage'],"Please fill Alias Name.");
			}
			if($_POST['str_clt_fname']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Fill First Name .");
			}
			if($_POST['str_clt_lname']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Fill Last Name.");
			}
			if($_POST['str_clt_mobile']=="" || !is_numeric($_POST['str_clt_mobile']) || strlen($_POST['str_clt_mobile'])!=10)
			{			
					array_push($_SESSION['errmessage'],"Mobile Number Must be Filled in 10 Digit Number.");
			}
			
		
			if($_POST['str_clt_comp']=="" )
			{
					array_push($_SESSION['errmessage'],"Please fill the Company Name.");
			}
			
							
			if(count($_SESSION['errmessage'])==0)
			{
			
			$sqli->table='client_user';			
			$updateInformation['clt_email']		=$_POST['str_clt_email'];		
			$updateInformation['clt_fname']		=$_POST['str_clt_fname'];
			$updateInformation['clt_lname']		=$_POST['str_clt_lname'];
			$updateInformation['clt_comp']		=$_POST['str_clt_comp'];
			$updateInformation['clt_comp_address']	=$_POST['str_clt_comp_address'];
			$updateInformation['clt_city']		=$_POST['str_clt_city'];
			$updateInformation['clt_state']		=$_POST['str_clt_state'];
			$updateInformation['clt_country']	=$_POST['str_clt_country'];
			$updateInformation['clt_zipcode']	=$_POST['str_clt_zipcode'];
			$updateInformation['clt_phone']		=$_POST['str_clt_phone'];
			$updateInformation['clt_mobile']	=$_POST['str_clt_mobile'];
			$updateInformation['clt_fax']		=$_POST['str_clt_fax'];
			$updateInformation['clt_detail']	=$_POST['str_clt_detail'];
            
            $updateInformation['clt_skype']	        = $_POST['str_clt_skype'];
            $updateInformation['clt_other_id']	    = $_POST['str_clt_other_id'];
			$updateInformation['clt_ph_transfer']	= $_POST['str_clt_ph_transfer'];
			$updateInformation['clt_op_hours_to']	= $_POST['str_clt_op_hours_to'];
			$updateInformation['clt_op_hours_from']	= $_POST['str_clt_op_hours_from'];
			$updateInformation['clt_timezone']	    = $_POST['str_clt_timezone'];
            
			$updateInformation['acno']			=$_POST['str_acno'];
			$updateInformation['acname']		=$_POST['str_acname'];
			$updateInformation['bank']			=$_POST['str_bank'];
			$updateInformation['bank_address']	=$_POST['str_bank_address'];
			$updateInformation['bank_city']		=$_POST['str_bank_city'];
			$updateInformation['bank_state']	=$_POST['str_bank_state'];
			$updateInformation['bank_country']	=$_POST['str_bank_country'];
			$updateInformation['swiftcode']		=$_POST['str_swiftcode'];
			$updateInformation['otherdetail']	=$_POST['str_otherdetail'];
			$updateInformation['receive_email']	=$_POST['str_receive_email'];
			$updateInformation['clt_alias']	    =$_POST['str_clt_alias'];
			$updateInformation['upd_date']		=	date("y-m-d h:m:s");			
			
			$fields 										= 	array_keys($updateInformation);
			$values											=	array_values($updateInformation);
			$sqli											->	autocommit(FALSE);
			$where=array('cltid'=>$_POST['clt_id']);	
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
				pageRedirection("listclient_user.php");
			
			
	}
	else
	{
		
			$data[0]['clt_username']	 =	$_REQUEST['str_clt_username'];
			$data[0]['clt_email']	 =	$_REQUEST['str_clt_email'];
			$data[0]['clt_fname']	= $_REQUEST['str_clt_fname'];
			$data[0]['clt_lname']	= $_REQUEST['str_clt_lname'];
			$data[0]['clt_comp']	= $_REQUEST['str_clt_comp'];
			$data[0]['clt_comp_address']	= $_REQUEST['str_clt_comp_address'];
			$data[0]['clt_city']	= $_REQUEST['str_clt_city'];
			$data[0]['clt_state']	= $_REQUEST['str_clt_state'];
			$data[0]['clt_country']	= $_REQUEST['str_clt_country'];
			$data[0]['clt_zipcode']	= $_REQUEST['str_clt_zipcode'];
			$data[0]['clt_phone']	= $_REQUEST['str_clt_phone'];
			$data[0]['clt_mobile']	= $_REQUEST['str_clt_mobile'];
			$data[0]['clt_fax']	= $_REQUEST['str_clt_fax'];
			$data[0]['clt_detail']	= $_REQUEST['str_clt_detail'];
            
            $data[0]['clt_skype']	        = $_REQUEST['str_clt_skype'];
            $data[0]['clt_other_id']	    = $_REQUEST['str_clt_other_id'];
			$data[0]['clt_ph_transfer']	    = $_REQUEST['str_clt_ph_transfer'];
			$data[0]['clt_op_hours_to']	    = $_REQUEST['str_clt_op_hours_to'];
			$data[0]['clt_op_hours_from']	= $_REQUEST['str_clt_op_hours_from'];
			$data[0]['clt_timezone']	    = $_REQUEST['str_clt_timezone'];
            
            
			$data[0]['acno']	= $_REQUEST['str_acno'];
			$data[0]['acname']	= $_REQUEST['str_acname'];
			$data[0]['bank']	= $_REQUEST['str_bank'];
			$data[0]['bank_address']	= $_REQUEST['str_bank_address'];
			$data[0]['bank_city']	= $_REQUEST['str_bank_city'];
			$data[0]['bank_state']	= $_REQUEST['str_bank_state'];
			$data[0]['bank_country']	= $_REQUEST['str_bank_country'];
			$data[0]['swiftcode']	= $_REQUEST['str_swiftcode'];
			$data[0]['otherdetail']	= $_REQUEST['str_otherdetail'];
			$data[0]['clt_alias']	= $_REQUEST['str_clt_alias'];
			$data[0]['receive_email']	= $_REQUEST['str_receive_email'];	
	
	
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
    <td>  <h2> Update Client</h2></td>
    <td align="right"><a href="listclient_user.php"><img src="images/list-details.png" alt="" title="List Client" border="0" /></a></td>
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
          <form action="" method="post" class="" id="clientForm" name="clientForm">
       
           <fieldset>
    <legend>Client Details</legend><input type="hidden" name="clt_id" value="<?php echo $data[0]['cltid']; ?>" />
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
  <tr>
    <td><table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
      
      <tr>
        <td width="20%" align="right" nowrap="nowrap">User Name :</td>
        <td width="30%"><input name="str_clt_username" type="text" class="required textbox" id="str_clt_username" value= "<?php echo $data[0]['clt_username']; ?>" size="30" maxlength="30" readonly="readonly" />
		</td>
        <td width="10%" align="right" nowrap="nowrap">Email id <span class="err">*</span>:</td>
        <td width="40%"><input name="str_clt_email" type="text" class="required textbox" id="str_clt_email" value= "<?php echo $data[0]['clt_email']; ?>" size="30" maxlength="30" /></td>
        </tr>
     
      <tr>
        <td width="20%" align="right" nowrap="nowrap">First Name <span class="err">*</span>:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_clt_fname" id="str_clt_fname" size="30" value= "<?php echo $data[0]['clt_fname']; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">Last Name <span class="err">*</span>:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_clt_lname" id="str_clt_lname" size="30"  value= "<?php echo $data[0]['clt_lname'] ; ?>"/></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Company<span class="err">*</span> :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_clt_comp" id="str_clt_comp" size="30" value= "<?php echo $data[0]['clt_comp']; ?>" /></td>
        <td width="10%" align="right" nowrap="nowrap">Cell  Phone Number<span class="err">*</span>:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_clt_mobile" id="str_clt_mobile" size="30" value= "<?php echo $data[0]['clt_mobile']; ?>" /></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">City :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_clt_city" id="str_clt_city" size="30"  value= "<?php echo $data[0]['clt_city']; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">Alias Name<span class="err">*</span>:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_clt_alias" id="str_clt_alias" size="30" value= "<?php echo $data[0]['clt_alias']; ?>"/></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">State :</td>
        <td width="30%">
               
         <select name="str_clt_state" id="str_clt_state">
         <option value="" selected="selected">- Select -</option>
         <?php
	$strQuery14="select * from zone where country_id=223";
$datastate=$sqli->get_selectData($strQuery14); 
	
	 foreach($datastate as $key=>$valuestate){?>
         <option value="<?php echo $valuestate['code'];?>"<?php if($data[0]['clt_state']==$valuestate['code']){echo "selected=\"selected\"";} ?>> <?php echo $valuestate['name'];?></option>
         <?php }?>
       </select>
       
       
       </td>
        <td width="10%" align="right" nowrap="nowrap">Country :</td>
        <td width="40%"><input type="text" class="required textbox" name="str_clt_country" id="str_clt_country" size="30" value= "<?php echo $data[0]['clt_country']; ?>"/></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Zipcode :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_clt_zipcode" id="str_clt_zipcode" size="30" value= "<?php echo $data[0]['clt_zipcode'] ?>" /></td>
        <td width="10%" align="right" nowrap="nowrap">Company Address:</td>
        <td width="40%" rowspan="3"><textarea name="str_clt_comp_address" cols="32" rows="5" class="" id="str_clt_comp_address"><?php echo $data[0]['clt_comp_address']; ?></textarea></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Phone :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_clt_phone" id="str_clt_phone" size="30"  value= "<?php echo $data[0]['clt_phone']; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right" valign="top" nowrap="nowrap">Fax :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_clt_fax" id="str_clt_fax" size="30" value= "<?php echo $data[0]['clt_fax']; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">&nbsp;</td>
        </tr>
        
           <tr>
        <td width="20%" align="right" nowrap="nowrap">Skype ID:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_clt_skype" id="str_clt_skype" size="30" value= "<?php echo $data[0]['clt_skype']; ?>" /></td>
        <td width="10%" align="right" nowrap="nowrap">Phone Transfer Line:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_clt_ph_transfer" id="str_clt_ph_transfer" size="30" value= "<?php echo $data[0]['clt_ph_transfer']; ?>" /></td>
        </tr>
        
        <tr>
                <td width="10%" align="right" nowrap="nowrap">Operation Hours (From):</td>
        <td width="40%"><input type="time" class="required textbox" name="str_clt_op_hours_from" id="str_clt_op_hours_from" size="30" value= "<?php echo $data[0]['clt_op_hours_from']; ?>" /></td>
        <td width="20%" align="right" nowrap="nowrap">Operation Hours (To) :</td>
        <td width="30%"><input type="time" class="required textbox" name="str_clt_op_hours_to" id="str_clt_op_hours_to" size="30" value= "<?php echo $data[0]['clt_op_hours_to']; ?>" /></td>

        </tr>
        
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Time Zone :</td>
        <td width="30%">
         <select name="str_clt_timezone" id="str_clt_timezone">
         <option value="" selected="selected">- Select -</option>
         <?php
	    $strQuerytz="select * from tbl_timezone where 1";
        $datatz=$sqli->get_selectData($strQuerytz); 	
	    foreach($datatz as $key=>$valuetz){?>
         <option value="<?php echo $valuetz['tz_id'];?>"<?php if($data[0]['clt_timezone']==$valuetz['tz_id'])echo "selected"; ?>> <?php echo $valuetz['tz_name'];?></option>
         <?php }?>
       </select>        
        </td>
        <td width="10%" align="right" nowrap="nowrap">Other ID</td>
        <td width="40%"><input type="text" class="required textbox" name="str_clt_other_id" id="str_clt_other_id" size="30" value= "<?php echo $data[0]['clt_other_id']; ?>"/></td>
       </tr>
        
      <tr>
       
        <td width="20%" align="right" nowrap="nowrap">Company Detail</td>
        <td width="30%" rowspan="2"><textarea name="str_clt_detail" id="str_clt_detail" cols="32" rows="5"><?php echo$data[0]['clt_detail'] ; ?>
     </textarea></td>
     
      <td width="10%" align="right" valign="top" nowrap="nowrap">Receive Email :</td>
        <td width="40%" valign="top"><input name="str_receive_email" type="checkbox" id="str_receive_email" value="1" <?php if($data[0]['receive_email']== '1') echo "checked"; ?> /></td>
        </tr>
        
      <tr>
        <td width="20%" align="right" valign="top" nowrap="nowrap">&nbsp;</td>
        <td width="30%">&nbsp;</td>
        <td width="10%" align="right" nowrap="nowrap">&nbsp;</td>
        </tr>
      
    </table></td>
    </tr>
  </table>
           </fieldset>
           
           <fieldset>
    <legend>Account Details </legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
  <tr>
    <td><table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
      
      <tr>
        <td width="20%" align="right">A/c Name:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_acname" id="str_acname" size="30" value= "<?php echo $data[0]['acname']; ?>" /></td>
        <td width="10%" align="right">A/C No:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_acno" id="str_acno" size="30" value= "<?php echo $data[0]['acno']; ?>" /></td>
        </tr>
      <tr>
        <td width="20%" align="right">Bank:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_bank" id="str_bank" size="30" value= "<?php echo $data[0]['bank'];  ?>" /></td>
        <td width="10%" align="right">Bank Address:</td>
        <td width="40%" rowspan="3"><textarea name="str_bank_address" id="str_bank_address" cols="32" rows="5"><?php echo $data[0]['bank_address']; ; ?>
     </textarea></td>
        </tr>
      <tr>
        <td width="20%" align="right">Bank City:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_bank_city" id="str_bank_city" size="30" value= "<?php echo $data[0]['bank_city']; ?>" /></td>
        <td width="10%" align="right">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right">Bank State:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_bank_state" id="str_bank_state" size="30" value= "<?php echo $data[0]['bank_state']; ?>" /></td>
        <td width="10%" align="right">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right">Bank Country:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_bank_country" id="str_bank_country" size="30" value= "<?php echo $data[0]['bank_country']; ?>" /></td>
        <td width="10%" align="right">Other Details :</td>
        <td width="40%" rowspan="3"><textarea name="str_otherdetail" id="str_otherdetail" cols="32" rows="5"><?php echo $data[0]['otherdetail']; ; ?>
     </textarea></td>
        </tr>
      <tr>
        <td width="20%" align="right">Swift Code:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_swiftcode" id="str_swiftcode" size="30" value= "<?php echo $data[0]['swiftcode']; ?>" /></td>
        <td width="10%" align="right">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right">&nbsp;</td>
        <td width="30%">&nbsp;</td>
        <td width="10%">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right">&nbsp;</td>
        <td width="30%">&nbsp;</td>
        <td width="10%"><input type="submit" name="submit" id="submit" value="Submit"/></td>
        <td width="40%">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right">&nbsp;</td>
        <td width="30%">&nbsp;</td>
        <td width="10%">&nbsp;</td>
        <td width="40%">&nbsp;</td>
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
   