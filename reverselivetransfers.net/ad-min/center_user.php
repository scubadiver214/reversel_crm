<?php include("_session.php"); 
$pagetitle ="Affiliate User";
include("_dataAccess.php");
$pagename = "center_user.php"; 


if(isset($_POST['submit']))
{
		
				
			if($_POST['str_cen_username']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Fill the Username First.");
			}
			if($_POST['str_cen_email']=="" || !filter_var($_POST['str_cen_email'], FILTER_VALIDATE_EMAIL) )
			{
					array_push($_SESSION['errmessage'],"Email Must be Filled in correct Format.");
			}
			if($_POST['str_cen_fname']==""  )
			{
					array_push($_SESSION['errmessage'],"Please Fill First Name .");
			}
			if($_POST['str_cen_lname']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Fill Last Name .");
			}
			if($_POST['str_cen_pwd']=="" || $_POST['confirmpassword']=="")
			{
					array_push($_SESSION['errmessage'],"Please Fill Password.");
			}
			if($_POST['str_cen_pwd']!="" && $_POST['confirmpassword']!="")
			{
					if($_POST['str_cen_pwd']!=$_POST['confirmpassword'])
				   {
					  array_push($_SESSION['errmessage'],"Passwords Don't match.");
				   }
			}
			if($_POST['str_cen_comp']=="" )
			{
					array_push($_SESSION['errmessage'],"Please fill the Company Name.");
			}
			
			$strQuery ="SELECT * FROM center_user WHERE cen_username = '".$_POST['str_cen_username'] ."'"; 
			$data=$sqli->get_selectData($strQuery);
            if (!empty($data)) 
            { 
             array_push($_SESSION['errmessage'],"Center User with the same Username already exists, Please choose another Username.");
            }
			
			
			if(count($_SESSION['errmessage'])==0)
			{
						
			$sqli->table='center_user';
			
			$insertInformation['cen_username']	      =	$_POST['str_cen_username'];
			$insertInformation['cen_email']	          =	$_POST['str_cen_email'];
			$insertInformation['cen_pwd']	          =	md5(trim($_POST['str_cen_pwd']));
			$insertInformation['cen_fname']	          =$_POST['str_cen_fname'];
			$insertInformation['cen_lname']	          =$_POST['str_cen_lname'];
			$insertInformation['cen_comp']	          =$_POST['str_cen_comp'];
			$insertInformation['cen_comp_address']	  =$_POST['str_cen_comp_address'];
			$insertInformation['cen_city']	          =$_POST['str_cen_city'];
			$insertInformation['cen_state']	          =$_POST['str_cen_state'];
			$insertInformation['cen_country']	      =$_POST['str_cen_country'];
			$insertInformation['cen_zipcode']	      =$_POST['str_cen_zipcode'];
			$insertInformation['cen_phone']	          =$_POST['str_cen_phone'];
			$insertInformation['cen_mobile']	      =$_POST['str_cen_mobile'];
			$insertInformation['cen_fax']	          =$_POST['str_cen_fax'];
            $insertInformation['cen_skype']	          =$_POST['str_cen_skype'];  
            $insertInformation['cen_other_id']	      =$_POST['str_cen_other_id']; 
            
			$insertInformation['cen_detail']	      =$_POST['str_cen_detail'];
			$insertInformation['acno']	              =$_POST['str_acno'];
			$insertInformation['acname']	          =$_POST['str_acname'];
			$insertInformation['bank']	              =$_POST['str_bank'];
			$insertInformation['bank_address']	      =$_POST['str_bank_address'];
			$insertInformation['bank_city']	          =$_POST['str_bank_city'];
			$insertInformation['bank_state']	      =$_POST['str_bank_state'];
			$insertInformation['bank_country']	      =$_POST['str_bank_country'];
			$insertInformation['swiftcode']	          =$_POST['str_swiftcode'];
			$insertInformation['otherdetail']	      =$_POST['str_otherdetail'];
			$insertInformation['cen_status']		  =	1;
			$insertInformation['regdate']		      =	date("y-m-d h:m:s");
						
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
			pageRedirection("listcenter_user.php");
		
	}
		else
		{
			$cen_username	 =	$_POST['str_cen_username'];
			$cen_email	 =	$_REQUEST['str_cen_email'];
			$cen_fname	= $_REQUEST['str_cen_fname'];
			$cen_lname	= $_REQUEST['str_cen_lname'];
			$cen_comp	= $_REQUEST['str_cen_comp'];
			$cen_comp_address	= $_REQUEST['str_cen_comp_address'];
			$cen_city	= $_REQUEST['str_cen_city'];
			$cen_state	= $_REQUEST['str_cen_state'];
			$cen_country	= $_REQUEST['str_cen_country'];
			$cen_zipcode	= $_REQUEST['str_cen_zipcode'];
			$cen_phone	= $_REQUEST['str_cen_phone'];
			$cen_mobile	= $_REQUEST['str_cen_mobile'];
			$cen_fax	= $_REQUEST['str_cen_fax'];
            $cen_skype      =$_REQUEST['str_cen_skype'];
            $cen_other_id      =$_REQUEST['str_cen_other_id']; 
			$cen_detail	= $_REQUEST['str_cen_detail'];
			$acno	= $_REQUEST['str_acno'];
			$acname	= $_REQUEST['str_acname'];
			$bank	= $_REQUEST['str_bank'];
			$bank_address	= $_REQUEST['str_bank_address'];
			$bank_city	= $_REQUEST['str_bank_city'];
			$bank_state	= $_REQUEST['str_bank_state'];
			$bank_country	= $_REQUEST['str_bank_country'];
			$swiftcode	= $_REQUEST['str_swiftcode'];
			$otherdetail	= $_REQUEST['str_otherdetail'];
			
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
    <td align="right"><a href="listcenter_user.php"><img src="images/list-details.png" alt="" title="List All" border="0" /></a></td>
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
          <form action="<?php echo $pagename; ?>" method="post" class="" id="centerForm" name="centerForm">
       
           <fieldset>
    <legend>Affiliate Details</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
  <tr>
    <td><table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
      <tr>
        <td width="20%" align="right">User Name<span class="err">*</span>:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_username" size="30" id="str_cen_username" value= "<?php echo $cen_username; ?>" Autocomplete="off"/>
         </td>
        <td width="10%" align="right">Email id <span class="err">*</span>:</td>
        <td width="40%"><input name="str_cen_email" type="text" class="required textbox" id="str_cen_email" value= "<?php echo $cen_email; ?>" size="30" maxlength="30"/></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Password <span class="err">*</span>:</td>
        <td width="30%"><input type="password" class="required textbox" id="str_cen_pwd" name="str_cen_pwd" size="20" /></td>
        <td width="10%" align="right">Confirm Password <span class="err">*</span>:</td>
        <td width="40%"><input type="password" class="required textbox" id="strpassword" name="confirmpassword" size="20"  /></td>
        </tr>
      <tr>
        <td width="20%" align="right">First Name <span class="err">*</span>:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_fname" id="str_cen_fname" size="30" value= "<?php echo $cen_fname; ?>"/></td>
        <td width="10%" align="right">Last Name <span class="err">*</span>:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_cen_lname" id="str_cen_lname" size="30"  value= "<?php echo $cen_lname; ?>"/></td>
        </tr>
      <tr>
        <td width="20%" align="right">Company<span class="err">*</span> :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_comp" id="str_cen_comp" size="30" value= "<?php echo $cen_comp; ?>" /></td>
        <td width="10%" align="right">Company Address:</td>
        <td width="40%" rowspan="3"><textarea name="str_cen_comp_address" cols="32" rows="5" class="" id="str_cen_comp_address"><?php echo $cen_comp_address; ?></textarea></td>
        </tr>
      <tr>
        <td width="20%" align="right">City :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_city" id="str_cen_city" size="30"  value= "<?php echo $cen_city; ?>"/></td>
        <td width="10%" align="right">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right">State :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_state" id="str_cen_state" size="30"  value= "<?php echo $cen_state; ?>"/></td>
        <td width="10%" align="right">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right">Zipcode :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_zipcode" id="str_cen_zipcode" size="30" value= "<?php echo $cen_zipcode; ?>" /></td>
        <td width="10%" align="right">Country :</td>
        <td width="40%"><input type="text" class="required textbox" name="str_cen_country" id="str_cen_country" size="30" value= "<?php echo $cen_country; ?>"/></td>
        </tr>
          <tr>
        <td width="20%" align="right" valign="top">Skype ID :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_skype" id="str_cen_skype" size="30" value= "<?php echo $cen_skype; ?>"/></td>
        <td width="10%" align="right">Other ID</td>
        <td width="40%" ><input type="text" class="required textbox" name="str_cen_other_id" id="str_cen_other_id" size="30" value= "<?php echo $cen_other_id; ?>"/></td>
        </tr>
      <tr>
        <td width="20%" align="right">Phone :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_phone" id="str_cen_phone" size="30"  value= "<?php echo $cen_phone; ?>"/></td>
        <td width="10%" align="right">Details:</td>
        <td width="40%" rowspan="3"><textarea name="str_cen_detail" id="str_cen_detail" cols="32" rows="5"><?php echo $cen_detail; ; ?>
     </textarea></td>
        </tr>
      <tr>
        <td width="20%" align="right" valign="top">Cell Phone Number:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_mobile" id="str_cen_mobile" size="30" value= "<?php echo $cen_mobile; ?>" /></td>
        <td width="10%" align="right">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right" valign="top">Fax :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_cen_fax" id="str_cen_fax" size="30" value= "<?php echo $cen_fax; ?>"/></td>
        <td width="10%" align="right">&nbsp;</td>
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
        <td width="20%" align="right">A/c Name:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_acname" id="str_acname" size="30" value= "<?php echo $acname; ?>" /></td>
        <td width="10%">A/C No:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_acno" id="str_acno" size="30" value= "<?php echo $acno;  ?>" /></td>
        </tr>
      <tr>
        <td width="20%" align="right">Bank :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_bank" id="str_bank" size="30" value= "<?php echo $bank; ?>" /></td>
        <td width="10%">Bank Address:</td>
        <td width="40%" rowspan="3"><textarea name="str_bank_address" id="str_bank_address" cols="32" rows="5"><?php  echo $bank_address; ?>
     </textarea></td>
        </tr>
      <tr>
        <td width="20%" align="right">Bank City:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_bank_city" id="str_bank_city" size="30" value= "<?php echo $bank_city; ?>" /></td>
        <td width="10%">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right">Bank State:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_bank_state" id="str_bank_state" size="30" value= "<?php  echo $bank_state;?>" /></td>
        <td width="10%">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right">Bank Country:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_bank_country" id="str_bank_country" size="30" value= "<?php echo $bank_country; ?>" /></td>
        <td width="10%">Other Details :</td>
        <td width="40%" rowspan="3"><textarea name="str_otherdetail" id="str_otherdetail" cols="32" rows="5"><?php  echo $otherdetail; ?>
     </textarea></td>
        </tr>
      <tr>
        <td width="20%" align="right">Swift Code :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_swiftcode" id="str_swiftcode" size="30" value= "<?php echo $swiftcode;  ?>" /></td>
        <td width="10%">&nbsp;</td>
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
      <tr>
        <td width="20%" align="right">&nbsp;</td>
        <td width="30%">&nbsp;</td>
        <td width="10%">&nbsp;</td>
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
	
     <script>

	var Ajx = jQuery.noConflict();
	
  Ajx( '#str_cen_username' ).change(function() {
	  var uname =  Ajx("#str_cen_username").val();
	  
   var dataString = 'cenuname='+uname;
   
   Ajx.ajax({
     type: "GET",
     url: "checkcenter_availibilty.php?"+dataString,
     data: dataString,
     cache: false,
     success: function(result){
		 if(Ajx.trim(result)=='0')
        Ajx( "#str_cen_username" ).removeClass( "nameavailable" ).addClass( "namenotavailable" );
		else  Ajx( "#str_cen_username" ).removeClass( "namenotavailable" ).addClass( "nameavailable" );
     }
   });
   
  });
 
	Ajx( '#str_cen_username' ).click(function() {
	Ajx( "#str_cen_username" ).removeClass( "nameavailable" ).addClass( "" );
	Ajx( "#str_cen_username" ).removeClass( "namenotavailable" ).addClass( "" );
	 });
  </script>
	
    <?php include("includes/footer.php"); ?>
   