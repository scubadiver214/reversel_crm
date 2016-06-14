<?php 
$pagetitle ="Verifier User";
include("_session.php"); 
include("_dataAccess.php");
$pagename = "verifier_user.php"; 
if(isset($_POST['submit']))
{		
				
			if($_POST['str_vf_username']=="" )
			{
					array_push($_SESSION['errmessage'],"Please fill The User Name First.");
			}
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
			if($_POST['str_vf_pwd']=="" || $_POST['confirmpassword']=="")
			{
					array_push($_SESSION['errmessage'],"Please Fill Password.");
			}
			if($_POST['str_vf_pwd']!="" && $_POST['confirmpassword']!="")
			{
					if($_POST['str_vf_pwd']!=$_POST['confirmpassword'])
				   {
					  array_push($_SESSION['errmessage'],"Passwords Don't match.");
				   }
			}
			if($_POST['str_vf_comp']=="" )
			{
					array_push($_SESSION['errmessage'],"Please fill the Company Name.");
			}
			
			
			
			$strQuery ="SELECT * FROM verifier_user WHERE verifier_username = '".$_POST['str_vf_username'] ."'"; 
			$data=$sqli->get_selectData($strQuery);
            if (!empty($data)) 
            { 
             array_push($_SESSION['errmessage'],"Verifier User with the same User Name already exists, Please choose another User Name.");
            }
			
			if(count($_SESSION['errmessage'])==0)
			{
			
			$sqli->table='verifier_user';		
			$insertInformation['verifier_username']	    = $_POST['str_vf_username'];
			$insertInformation['verifier_email']	    = $_POST['str_vf_email'];
			$insertInformation['verifier_pwd']	        = md5(trim($_POST['str_vf_pwd']));
			$insertInformation['verifier_fname']	    = $_POST['str_vf_fname'];
			$insertInformation['verifier_lname']	    = $_POST['str_vf_lname'];
			$insertInformation['verifier_comp']	        = $_POST['str_vf_comp'];
			$insertInformation['verifier_comp_address']	= $_POST['str_vf_comp_address'];
			$insertInformation['verifier_city']	        = $_POST['str_vf_city'];
			$insertInformation['verifier_state']	    = $_POST['str_vf_state'];
			$insertInformation['verifier_country']	    = $_POST['str_vf_country'];
			$insertInformation['verifier_zipcode']	    = $_POST['str_vf_zipcode'];
			$insertInformation['verifier_phone']	    = $_POST['str_vf_phone'];
			$insertInformation['verifier_mobile']	    = $_POST['str_vf_mobile'];
			$insertInformation['verifier_fax']	        = $_POST['str_vf_fax'];
			$insertInformation['verifier_detail']	    = $_POST['str_vf_detail'];	
			$insertInformation['verifier_alias']	    = $_POST['str_vf_alias'];		
			$insertInformation['regdate']		        =	date("y-m-d h:m:s");
			$fields 								= 	array_keys($insertInformation);
			$values									=	array_values($insertInformation);
			$sqli									->	autocommit(FALSE);
			$insert_result 							=	$sqli	->	Insert_data($fields,$values);
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
			pageRedirection("listverifier_user.php");
		}
		else
		{
		
			$vf_username      = $_POST['str_vf_username'];
			$vf_email	      =	$_REQUEST['str_vf_email'];
			$vf_fname	      =$_REQUEST['str_vf_fname'];
			$vf_lname	      =$_REQUEST['str_vf_lname'];
			$vf_comp	      =$_REQUEST['str_vf_comp'];
			$vf_comp_address  = $_REQUEST['str_vf_comp_address'];
			$vf_city	      =$_REQUEST['str_vf_city'];
			$vf_state	      =$_REQUEST['str_vf_state'];
			$vf_country	      =$_REQUEST['str_vf_country'];
			$vf_zipcode	      =$_REQUEST['str_vf_zipcode'];
			$vf_phone	      =$_REQUEST['str_vf_phone'];
			$vf_mobile	      =$_REQUEST['str_vf_mobile'];
			$vf_fax	          =$_REQUEST['str_vf_fax'];
			$vf_detail	      =$_REQUEST['str_vf_detail'];
			$vf_alias	      =$_REQUEST['str_vf_alias'];		
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
        <td width="30%"><input type="text" class="required textbox" name="str_vf_username" size="30" id="str_vf_username" value= "<?php echo $vf_username; ?>" Autocomplete="off"/> <div id="statusbox"></div>
         </td>
        <td width="10%" align="right" nowrap="nowrap">Email id <span class="err">*</span>:</td>
        <td width="40%"><input name="str_vf_email" type="text" class="required textbox" id="str_vf_email" value= "<?php echo $vf_email; ?>" size="30" maxlength="30"/></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Password <span class="err">*</span>:</td>
        <td width="30%"><input type="password" class="required textbox" id="str_vf_pwd" name="str_vf_pwd" size="20" /></td>
        <td width="10%" align="right" nowrap="nowrap">Confirm Password <span class="err">*</span>:</td>
        <td width="40%"><input type="password" class="required textbox" id="strpassword" name="confirmpassword" size="20"  /></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">First Name <span class="err">*</span>:</td>
        <td width="30%"><input type="text" class="required textbox" name="str_vf_fname" id="str_vf_fname" size="30" value= "<?php echo $vf_fname; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">Last Name <span class="err">*</span>:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_vf_lname" id="str_vf_lname" size="30"  value= "<?php echo $vf_lname; ?>"/></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Company<span class="err">*</span> :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_vf_comp" id="str_vf_comp" size="30" value= "<?php echo $vf_comp; ?>" /></td>
        <td width="10%" align="right" nowrap="nowrap">Cell  Phone Number<span class="err">*</span>:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_vf_mobile" id="str_vf_mobile" size="30" value= "<?php echo $vf_mobile; ?>" /></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">City :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_vf_city" id="str_vf_city" size="30"  value= "<?php echo $vf_city; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">Alias Name<span class="err">*</span>:</td>
        <td width="40%"><input type="text" class="required textbox" name="str_vf_alias" id="str_vf_alias" size="30" value= "<?php echo $vf_alias; ?>"/></td>
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
         <option value="<?php echo $valuestate['code'];?>"<?php if($vf_state==$valuestate['code'])echo "selected"; ?>> <?php echo $valuestate['name'];?></option>
         <?php }?>
       </select>
        
        
        </td>
        <td width="10%" align="right" nowrap="nowrap">Country :</td>
        <td width="40%"><input type="text" class="required textbox" name="str_vf_country" id="str_vf_country" size="30" value= "<?php echo $vf_country; ?>"/></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Zipcode :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_vf_zipcode" id="str_vf_zipcode" size="30" value= "<?php echo $vf_zipcode; ?>" /></td>
        <td width="10%" align="right" nowrap="nowrap">Company Address:</td>
        <td width="40%" rowspan="3"><textarea name="str_vf_comp_address" cols="32" rows="5" class="" id="str_vf_comp_address"><?php echo $vf_comp_address; ?></textarea></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Phone :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_vf_phone" id="str_vf_phone" size="30"  value= "<?php echo $vf_phone; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right" valign="top" nowrap="nowrap">Fax :</td>
        <td width="30%"><input type="text" class="required textbox" name="str_vf_fax" id="str_vf_fax" size="30" value= "<?php echo $vf_fax; ?>"/></td>
        <td width="10%" align="right" nowrap="nowrap">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" align="right" valign="top" nowrap="nowrap">Details :</td>
        <td width="30%" valign="top"> <textarea name="str_vf_detail" id="str_vf_detail" cols="32" rows="5"><?php echo $vf_detail; ?></textarea></td>
        
        <td width="10%" align="right" valign="top" nowrap="nowrap"></td>
        <td width="40%" valign="top">
        <input type="submit" name="submit" id="submit" value="Submit"/>
       
     </td>
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
   