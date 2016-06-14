<?php 
$pagetitle ="Client User";
include("_session.php"); 
include("_dataAccess.php");
$pagename = "client_user.php"; 
if(isset($_POST['submit']))
{		
				
			if($_POST['str_clt_username']=="" )
			{
					array_push($_SESSION['errmessage'],"Please fill The User Name First.");
			}
			if($_POST['str_clt_alias']=="" )
			{
					array_push($_SESSION['errmessage'],"Please fill The Alias Name.");
			}
			if($_POST['str_clt_email']=="" || !filter_var($_POST['str_clt_email'], FILTER_VALIDATE_EMAIL) )
			{
					array_push($_SESSION['errmessage'],"Email Must be Filled in correct Format.");
			}
			if($_POST['str_clt_fname']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Fill First Name .");
			}
			if($_POST['str_clt_lname']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Fill Last Name.");
			}
			if($_POST['str_clt_mobile']=="" || !is_numeric($_POST['str_clt_mobile']) )
			{			
					array_push($_SESSION['errmessage'],"Mobile Number Must be Number only.");
			}
			
			if($_POST['str_clt_pwd']=="" || $_POST['confirmpassword']=="")
			{
					array_push($_SESSION['errmessage'],"Please Fill Password.");
			}
			if($_POST['str_clt_pwd']!="" && $_POST['confirmpassword']!="")
			{
					if($_POST['str_clt_pwd']!=$_POST['confirmpassword'])
				   {
					  array_push($_SESSION['errmessage'],"Passwords Don't match.");
				   }
			}
			if($_POST['str_clt_comp']=="" )
			{
					array_push($_SESSION['errmessage'],"Please fill the Company Name.");
			}
			
			
			
			$strQuery ="SELECT * FROM client_user WHERE clt_username = '".$_POST['str_clt_username'] ."'"; 
			$data=$sqli->get_selectData($strQuery);
            if (!empty($data)) 
            { 
             array_push($_SESSION['errmessage'],"Client User with the same User Name already exists, Please choose another User Name.");
            }
			
			if(count($_SESSION['errmessage'])==0)
			{
			
			$sqli->table='client_user';		
			$insertInformation['clt_username']	    = $_POST['str_clt_username'];
			$insertInformation['clt_email']	        = $_POST['str_clt_email'];
			$insertInformation['clt_pwd']	        = md5(trim($_POST['str_clt_pwd']));
			$insertInformation['clt_fname']	        = $_POST['str_clt_fname'];
			$insertInformation['clt_lname']	        = $_POST['str_clt_lname'];
			$insertInformation['clt_comp']	        = $_POST['str_clt_comp'];
			$insertInformation['clt_comp_address']	= $_POST['str_clt_comp_address'];
			$insertInformation['clt_city']	        = $_POST['str_clt_city'];
			$insertInformation['clt_state']	        = $_POST['str_clt_state'];
			$insertInformation['clt_country']	    = $_POST['str_clt_country'];
			$insertInformation['clt_zipcode']	    = $_POST['str_clt_zipcode'];
			$insertInformation['clt_phone']	        = $_POST['str_clt_phone'];
			$insertInformation['clt_mobile']	    = $_POST['str_clt_mobile'];
			$insertInformation['clt_fax']	        = $_POST['str_clt_fax'];
			$insertInformation['clt_detail']	    = $_POST['str_clt_detail'];
			$insertInformation['acno']	            = $_POST['str_acno'];
			$insertInformation['acname']	        = $_POST['str_acname'];
			$insertInformation['bank']	            = $_POST['str_bank'];
			$insertInformation['bank_address']	    = $_POST['str_bank_address'];
			$insertInformation['bank_city']	        = $_POST['str_bank_city'];
			$insertInformation['bank_state']	    = $_POST['str_bank_state'];
			$insertInformation['bank_country']	    = $_POST['str_bank_country'];
			$insertInformation['swiftcode']	        = $_POST['str_swiftcode'];
			$insertInformation['otherdetail']	    = $_POST['str_otherdetail'];
			$insertInformation['clt_alias']	        = $_POST['str_clt_alias'];            
            $insertInformation['clt_skype']	        = $_POST['str_clt_skype'];
            $insertInformation['clt_other_id']	    = $_POST['str_clt_other_id'];            
			$insertInformation['clt_ph_transfer']	= $_POST['str_clt_ph_transfer'];
			$insertInformation['clt_op_hours_to']	= $_POST['str_clt_op_hours_to'];
			$insertInformation['clt_op_hours_from']	= $_POST['str_clt_op_hours_from'];
            if($_POST['str_clt_timezone']!=""){
			$insertInformation['clt_timezone']	    = $_POST['str_clt_timezone'];
            }
            
			if(isset ($_POST['str_receive_email'])== "")
			{
			$insertInformation['receive_email']	= 0;
			}
			else
			{
			$insertInformation['receive_email']	= 1;	
			}
			$insertInformation['regdate']		=	date("y-m-d h:m:s");
			
			
			
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
			pageRedirection("listclient_user.php");
		
		
		}
		else
		{
		
			$clt_username= $_POST['str_clt_username'];
			$clt_email	 =	$_REQUEST['str_clt_email'];
			$clt_fname	=$_REQUEST['str_clt_fname'];
			$clt_lname	=$_REQUEST['str_clt_lname'];
			$clt_comp	=$_REQUEST['str_clt_comp'];
			$clt_comp_address	=$_REQUEST['str_clt_comp_address'];
			$clt_city	=$_REQUEST['str_clt_city'];
			$clt_state	=$_REQUEST['str_clt_state'];
			$clt_country	=$_REQUEST['str_clt_country'];
			$clt_zipcode	=$_REQUEST['str_clt_zipcode'];
			$clt_phone	=$_REQUEST['str_clt_phone'];
			$clt_mobile	=$_REQUEST['str_clt_mobile'];
			$clt_fax	=$_REQUEST['str_clt_fax'];
			$clt_detail	=$_REQUEST['str_clt_detail'];
			$acno	=$_REQUEST['str_acno'];
			$acname	=$_REQUEST['str_acname'];
			$bank	=$_REQUEST['str_bank'];
			$bank_address	=$_REQUEST['str_bank_address'];
			$bank_city	=$_REQUEST['str_bank_city'];
			$bank_state	=$_REQUEST['str_bank_state'];
			$bank_country	=$_REQUEST['str_bank_country'];
			$swiftcode	=$_REQUEST['str_swiftcode'];
			$otherdetail	=$_REQUEST['str_otherdetail'];
			$clt_alias	=$_REQUEST['str_clt_alias'];
			$receive_email	=$_REQUEST['str_receive_email'];            
            $clt_skype	        = $_REQUEST['str_clt_skype'];
            $clt_other_id	    = $_REQUEST['str_clt_other_id'];
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
      <div class="right_content">            
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2><?php echo $pagetitle; ?></h2></td>
    <td align="right"><a href="listclient_user.php"><img src="images/list-details.png" alt="" title="List All" border="0" /></a></td>
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
          <form action="<?php echo$pagenam; ?>" method="post" class="" id="clientForm" name="clientForm">
       
           <fieldset>
    <legend>User Details</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
  <tr>
    <td><table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
     
      <tr>
        <td width="20%" align="right" nowrap="nowrap">User Name <span class="err">*</span>:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_clt_username" size="30" id="str_clt_username" value= "<?php echo $clt_username; ?>" Autocomplete="off"/> <div id="statusbox"></div>
         </td>
        <td width="10%" align="right" nowrap="nowrap">Email id <span class="err">*</span>:</td>
        <td width="40%"><input name="str_clt_email" type="text" class="required textbox" id="str_clt_email" value= "<?php echo $clt_email; ?>" size="30" maxlength="30"/></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Password <span class="err">*</span>:</td>
        <td width="30%"><input type="password" class="required textbox" id="str_clt_pwd" name="str_clt_pwd" size="20" /></td>
        <td width="10%" align="right" nowrap="nowrap">Confirm Password <span class="err">*</span>:</td>
        <td width="40%"><input type="password" class="required textbox" id="strpassword" name="confirmpassword" size="20"  /></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">First Name <span class="err">*</span>:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_clt_fname" id="str_clt_fname" size="30" value= "<?php echo $clt_fname; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">Last Name <span class="err">*</span>:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_clt_lname" id="str_clt_lname" size="30"  value= "<?php echo $clt_lname; ?>"/></td>
        </tr>
        
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Company<span class="err">*</span> :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_clt_comp" id="str_clt_comp" size="30" value= "<?php echo $clt_comp; ?>" /></td>
        <td width="10%" align="right" nowrap="nowrap">Cell  Phone Number<span class="err">*</span>:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_clt_mobile" id="str_clt_mobile" size="30" value= "<?php echo $clt_mobile; ?>" /></td>
        </tr>
        
       
        
         <tr>
        <td width="20%" align="right" nowrap="nowrap">City :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_clt_city" id="str_clt_city" size="30"  value= "<?php echo $clt_city; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">Alias Name<span class="err">*</span>:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_clt_alias" id="str_clt_alias" size="30" value= "<?php echo $clt_alias; ?>"/></td>
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
         <option value="<?php echo $valuestate['code'];?>"<?php if($clt_state==$valuestate['code'])echo "selected"; ?>> <?php echo $valuestate['name'];?></option>
         <?php }?>
       </select>
        
        
        </td>
        <td width="10%" align="right" nowrap="nowrap">Country :</td>
        <td width="40%"><input type="text" class="required textbox" name="str_clt_country" id="str_clt_country" size="30" value= "<?php echo $clt_country; ?>"/></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Zipcode :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_clt_zipcode" id="str_clt_zipcode" size="30" value= "<?php echo $clt_zipcode; ?>" /></td>
        <td width="10%" align="right" nowrap="nowrap">Company Address:</td>
        <td width="40%" rowspan="3"><textarea name="str_clt_comp_address" cols="32" rows="5" class="" id="str_clt_comp_address"><?php echo $clt_comp_address; ?></textarea></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Phone :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_clt_phone" id="str_clt_phone" size="30"  value= "<?php echo $clt_phone; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right" valign="top" nowrap="nowrap">Fax :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_clt_fax" id="str_clt_fax" size="30" value= "<?php echo $clt_fax; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">&nbsp;</td>
        </tr>
        
         <tr>
        <td width="20%" align="right" nowrap="nowrap">Skype ID:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_clt_skype" id="str_clt_skype" size="30" value= "<?php echo $clt_skype; ?>" /></td>
        <td width="10%" align="right" nowrap="nowrap">Phone Transfer Line:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_clt_ph_transfer" id="str_clt_ph_transfer" size="30" value= "<?php echo $clt_ph_transfer; ?>" /></td>
        </tr>
        
        <tr>
        <td width="20%" align="right" nowrap="nowrap">Operation Hours (To) :</td>
        <td width="30%"><input type="time" class="required textbox" name="str_clt_op_hours_to" id="str_clt_op_hours_to" size="30" value= "<?php echo $clt_op_hours_to; ?>" /></td>
        <td width="10%" align="right" nowrap="nowrap">Operation Hours (From):</td>
        <td width="40%"><input type="time" class="required textbox" name="str_clt_op_hours_from" id="str_clt_op_hours_from" size="30" value= "<?php echo $clt_op_hours_from; ?>" /></td>
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
         <option value="<?php echo $valuetz['tz_id'];?>"<?php if($clt_timezone==$valuetz['tz_id'])echo "selected"; ?>> <?php echo $valuetz['tz_name'];?></option>
         <?php }?>
       </select>        
        </td>
        <td width="10%" align="right" nowrap="nowrap">Other ID</td>
        <td width="40%"><input type="text" class="required textbox" name="str_clt_other_id" id="str_clt_other_id" size="30" value= "<?php echo $clt_other_id; ?>"/></td>
        </tr>
        
      <tr>
       <td width="20%" align="right" valign="top" nowrap="nowrap">Details:</td>
        <td width="30%" valign="top"><textarea name="str_clt_detail" id="str_clt_detail" cols="32" rows="5"><?php echo $clt_detail; ?>
     </textarea></td>
        <td width="10%" align="right" valign="top" nowrap="nowrap">Receive Email :</td>
        <td width="40%" valign="top"><input name="str_receive_email" type="checkbox" id="str_receive_email" value="1" /></td>
       
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
        <td width="20%" align="right" nowrap="nowrap">A/c Name:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_acname" id="str_acname" size="30" value= "<?php echo $acname; ?>" /></td>
        <td width="10%" align="right">A/C No:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_acno" id="str_acno" size="30" value= "<?php echo $acno; ?>" /></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Bank:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_bank" id="str_bank" size="30" value= "<?php echo $bank; ?>" /></td>
        <td width="10%" align="right">Bank Address:</td>
        <td width="40%" rowspan="3"><textarea name="str_bank_address" id="str_bank_address" cols="32" rows="5"><?php  echo $bank_address; ?>
     </textarea></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Bank City:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_bank_city" id="str_bank_city" size="30" value= "<?php echo $bank_city; ?>" /></td>
        <td width="10%" align="right">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Bank State:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_bank_state" id="str_bank_state" size="30" value= "<?php echo $bank_state; ?>" /></td>
        <td width="10%" align="right">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Bank Country:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_bank_country" id="str_bank_country" size="30" value= "<?php echo $bank_country;  ?>" /></td>
        <td width="10%" align="right">Other Details :</td>
        <td width="40%" rowspan="3"><textarea name="str_otherdetail" id="str_otherdetail" cols="32" rows="5"><?php  echo $otherdetail; ?>
     </textarea></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Swift Code :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_swiftcode" id="str_swiftcode" size="30" value= "<?php echo $swiftcode; ?>" /></td>
        <td width="10%" align="right">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">&nbsp;</td>
        <td width="30%">&nbsp;</td>
        <td width="10%" align="right">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">&nbsp;</td>
        <td width="30%">&nbsp;</td>
        <td width="10%" align="right"><input type="submit" name="submit" id="submit" value="Submit"/></td>
        <td width="40%">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">&nbsp;</td>
        <td width="30%">&nbsp;</td>
        <td width="10%" align="right">&nbsp;</td>
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
    
     <script>

	var Ajx = jQuery.noConflict();
	
  Ajx( '#str_clt_username' ).change(function() {
	  var uname =  Ajx("#str_clt_username").val();
	  
   var dataString = 'cltuname='+uname;
   
   Ajx.ajax({
     type: "GET",
     url: "checkclient_availibilty.php?"+dataString,
     data: dataString,
     cache: false,
     success: function(result){
		 if(Ajx.trim(result)=='0')
        Ajx( "#str_clt_username" ).removeClass( "nameavailable" ).addClass( "namenotavailable" );
		else  Ajx( "#str_clt_username" ).removeClass( "namenotavailable" ).addClass( "nameavailable" );
     }
   });
   
  });
 
 Ajx( '#str_clt_username' ).click(function() {
	Ajx( "#str_clt_username" ).removeClass( "nameavailable" ).addClass( "" );
	Ajx( "#str_clt_username" ).removeClass( "namenotavailable" ).addClass( "" );
	 });
  </script>
	
    <?php include("includes/footer.php"); ?>
   