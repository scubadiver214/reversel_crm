
<?php 
include("_session.php"); 
include("_dataAccess.php");
$pagename = "admin.php"; 
if(isset($_POST['submit']))
{
			
			if($_POST['str_ad_username']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Fill The Username First.");
			}
			if($_POST['stremail']=="" || !filter_var($_POST['stremail'], FILTER_VALIDATE_EMAIL) )
			{
					array_push($_SESSION['errmessage'],"Email Must be Filled in correct Format.");
			}
			if($_POST['strfname']==""  )
			{
					array_push($_SESSION['errmessage']," Please FillFirst Name .");
			}
			if($_POST['strlname']=="" )
			{
					array_push($_SESSION['errmessage']," Please Fill Last Name .");
			}
			if($_POST['strmobile']=="" || !is_numeric($_POST['strmobile']))
			{			
					array_push($_SESSION['errmessage'],"Mobile Number Must be Filled in Numbers only.");
			}
			
			if($_POST['strpassword']=="" || $_POST['confirmpassword']=="")
			{
					array_push($_SESSION['errmessage'],"Please Fill Password.");
			}
			if($_POST['strpassword']!="" && $_POST['confirmpassword']!="")
			{
					if($_POST['strpassword']!=$_POST['confirmpassword'])
				   {
					  array_push($_SESSION['errmessage'],"Passwords Don't match.");
				   }
			}
			$strQuery ="SELECT * FROM admin WHERE ad_username = '".$_POST['str_ad_username']."'"; 
			$data=$sqli->get_selectData($strQuery);
            if (!empty($data)) 
            { 
             array_push($_SESSION['errmessage'],"Users with the same Username already exists, Please choose another Username.");
            }
			
			if(count($_SESSION['errmessage'])==0)
			{
		
			
			$sqli->table='admin';
			
			$insertInformation['ad_username']	   	=	$_POST['str_ad_username'];
			$insertInformation['email']	   			=	$_POST['stremail'];
			$insertInformation['password']			=	md5(trim($_POST['strpassword']));
			$insertInformation['fname']				=	$_POST['strfname'];
			$insertInformation['lname']				=	$_POST['strlname'];
			$insertInformation['phone']				=	$_POST['strphone'];
			$insertInformation['mobile']			=	$_POST['strmobile'];
			$insertInformation['fax']				=	$_POST['strfax'];
			$insertInformation['address']			=	$_POST['straddress'];
			$insertInformation['city']				=	$_POST['strcity'];
			$insertInformation['state']				=	$_POST['strstate'];
			$insertInformation['country']			=	$_POST['strcountry'];
			$insertInformation['user_detail']		=	$_POST['struser_detail'];
			$insertInformation['status']			=	1;
			//$insertInformation['roles']			=	implode(",",$_POST['cb_roles']);
			$insertInformation['regdate']			=	date("y-m-d h:m:s");
			//$insertInformation['modUser']		=	"admin";
			//$insertInformation['status']		=	"1";
			//$insertInformation['supervisor']	=	implode(",",$_POST['supervisor']);
			//$insertInformation['dialplan']		=	$_POST['strdialplan'];
			
			
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
		//pageRedirection("listadmin.php");
		
		
		}
		
	
		else
		{
			$ad_username	=	$_REQUEST['str_ad_username'];
			$email	=	$_REQUEST['stremail'];
			$fname	=	$_REQUEST['strfname'];
			$lname	=	$_REQUEST['strlname'];
			$phone	=	$_REQUEST['strphone'];
			$mobile	=	$_REQUEST['strmobile'];
			$fax	=	$_REQUEST['strfax'];
			$address =	$_REQUEST['straddress'];
			$city =	$_REQUEST['strcity'];
			$state =	$_REQUEST['strstate'];
			$country =	$_REQUEST['strcountry'];
			$user_detail	=	$_REQUEST['struser_detail'];
			
			
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
    <td><h2>Admin Form</h2></td>
    <td align="right"><a href="listadmin.php"><img src="images/list-details.png" alt="" title="List All" border="0" /></a></td>
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
          <form action="" method="post" class="" id="adminForm" name="adminForm">
           <fieldset>
    <legend>Admin</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
  <tr>
    <td width="20%" align="right" nowrap="nowrap">Username <span class="err">*</span>:</td>
    <td width="30%"><input type="text" class="textbox" name="str_ad_username" size="30" id="str_ad_username" value= "<?php echo $ad_username; ?>" Autocomplete="off"/>
      <div id="statusbox"></div></td>
    <td width="10%" align="right" nowrap="nowrap">Email id <span class="err">*</span>:</td>
    <td width="40%"><input type="text" class="required textbox" name="stremail" size="30" id="stremail" value= "<?php echo $email; ?>"/></td>
  </tr>
  <tr>
    <td width="20%" align="right" nowrap="nowrap">Password <span class="err">*</span>:</td>
    <td width="30%"><input type="password" class="required textbox" id="strpassword2" name="strpassword" size="20" /></td>
    <td width="10%" align="right" nowrap="nowrap">Confirm Password <span class="err">*</span>:</td>
    <td width="40%"><input type="password" class="required textbox" id="strpassword" name="confirmpassword" size="20"  /></td>
	

	<tr>
	  <td width="20%" align="right" nowrap="nowrap">First Name <span class="err">*</span>:</td>
	  <td width="30%"><input type="text" class="required textbox" name="strfname" id="strfname" size="30" value= "<?php echo $fname; ?>"/></td>
	  <td width="10%" align="right" nowrap="nowrap">Last Name <span class="err">*</span>:</td>
	  <td width="40%"><input type="text" class="required textbox" name="strlname" id="strlname" size="30"  value= "<?php echo $lname; ?>"/></td>
	  </tr>
	<tr>
	  <td width="20%" align="right" nowrap="nowrap">Mobile<span class="err">*</span>:</td>
	  <td width="30%"><input type="text" class="required textbox" name="strmobile" id="strmobile" size="30" value= "<?php echo $mobile; ?>"/></td>
	  <td width="10%" align="right" nowrap="nowrap">Phone :</td>
	  <td width="40%"><input type="text" class="required textbox" name="strphone" id="strphone" size="30"  value= "<?php echo $phone; ?>"/></td>
	  </tr>
	
	<tr>
	  <td width="20%" align="right" valign="top" nowrap="nowrap">Fax :</td>
	  <td width="30%" valign="top"><input type="text" class="required textbox" name="strfax" id="strfax" size="30" value= "<?php echo $fax; ?>"/></td>
	  <td width="10%" align="right" valign="top" nowrap="nowrap">Address :</td>
	  <td width="40%"><textarea name="straddress" cols="32" rows="5" class="" id="straddress"><?php echo $address; ?></textarea></td>
	  </tr>
	<tr>
	  <td width="20%" align="right" valign="top" nowrap="nowrap">City :</td>
	  <td width="30%"><input type="text" class="required textbox" name="strcity" id="strcity" size="30"  value= "<?php echo $city; ?>"/></td>
	  <td width="10%" align="right" nowrap="nowrap">State :</td>
	  <td width="40%"><input type="text" class="required textbox" name="strstate" id="strstate" size="30"  value= "<?php echo $state; ?>"/></td>
	  </tr>
	<tr>
	  <td width="20%" align="right" valign="top" nowrap="nowrap">Country :</td>
	  <td width="30%" valign="top"><input type="text" class="required textbox" name="strcountry" id="strcountry" size="30" value= "<?php echo $country; ?>"/></td>
	  <td width="10%" align="right" valign="top" nowrap="nowrap">User Details:</td>
	  <td width="40%"><textarea name="struser_detail" id="struser_detail" cols="32" rows="5"><?php echo $user_detail; ?></textarea></td>
	  </tr>
	<tr>
	  <td width="20%" align="right" valign="top" nowrap="nowrap">&nbsp;</td>
	  <td width="30%">&nbsp;</td>
	  <td width="10%" align="right" nowrap="nowrap">&nbsp;</td>
	  <td width="40%">&nbsp;</td>
	  </tr>
	
	<tr>
	  <td width="20%" align="right" nowrap="nowrap">&nbsp;</td>
	  <td width="30%">&nbsp;</td>
	  <td width="10%" align="left" nowrap="nowrap"><input type="submit" name="submit" id="submit" value="Submit"/></td>
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
	
  Ajx( '#str_ad_username' ).change(function() {
	  var uname =  Ajx("#str_ad_username").val();
	  
   var dataString = 'uname='+uname;
   
   Ajx.ajax({
     type: "GET",
     url: "checkadmin_availibilty.php?"+dataString,
     data: dataString,
     cache: false,
     success: function(result){
		 if(Ajx.trim(result)=='0')
        Ajx( "#str_ad_username" ).removeClass( "nameavailable" ).addClass( "namenotavailable" );
		else  Ajx( "#str_ad_username" ).removeClass( "namenotavailable" ).addClass( "nameavailable" );
     }
   });
   
  });
 
 Ajx( '#str_ad_username' ).click(function() {
	Ajx( "#str_ad_username" ).removeClass( "nameavailable" ).addClass( "" );
	Ajx( "#str_ad_username" ).removeClass( "namenotavailable" ).addClass( "" );
	 });
  </script>

    <?php include("includes/footer.php"); ?>
   