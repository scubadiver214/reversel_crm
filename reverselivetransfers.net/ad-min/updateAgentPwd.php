<?php 
$pagename = "updateAgent.php"; 
include("_session.php"); 
include("_dataAccess.php"); 

if(isset($_POST['Update']))
{
	
$strQuery12 ="Select * from center_user where cenid='".$_POST['str_ag_center']."'";
$datacen=$sqli->get_selectData($strQuery12);

			
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
			$updateInformation['upd_date']			=	date("y-m-d h:m:s");				
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
						array_push($_SESSION['message'],"Data Successfully Saved.");
		
				}
			pageRedirection("listcenter_user.php");
				
			
	}
	else
	{		
	$data[0]['ag_username']		= $_REQUEST['str_ag_username'];
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
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
     
      <tr>
    <td width="20%" align="right">User Name<span class="err">*</span>: </td>
    <td width="30%"><input name="str_ag_username" type="text" class="required textbox" id="str_ag_username" value="<?php echo $data[0]['ag_username']; ?>" readonly="readonly" /></td>
    <td width="10%" align="right" nowrap="nowrap">Password <span class="err">*</span>: </td>
    <td width="40%"><input type="password" class="required textbox" id="str_ag_password" name="str_ag_password" size="20" /></td>
  </tr>
   <tr>
    <td width="20%" align="right">Confirm Password <span class="err">*</span>:</td>
    <td width="30%"><input type="password" class="required textbox" id="confirmpassword" name="confirmpassword" size="20"  /></td>
    <td width="10%" align="right" nowrap="nowrap"></td>
    <td width="40%"><input type="submit" name="Update" id="Update" value="Update"/></td>
	


	<tr>
	  <td width="20%" align="right" valign="top">&nbsp;</td>
	  <td width="30%" valign="top">&nbsp;</td>
	  <td width="10%" align="right" valign="top" nowrap="nowrap">&nbsp;</td>
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
   