<?php 
$pagename = "upd_pwd.php"; 
include("_session.php"); 
include("_dataAccess.php");

$strQuery1 ="Select * from client_user where cltid='".$_SESSION['sessClientID']."'";
$data=$sqli->get_selectData($strQuery1);

if(isset($_POST['submit']))
{
		
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
		
							
			if(count($_SESSION['errmessage'])==0)
			{
			
			$sqli->table='client_user';			
			$updateInformation['clt_pwd']		=	md5(trim($_POST['str_clt_pwd']));            
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
				pageRedirection("upd_pwd.php");			
			
	}
	else
	{		
			$data[0]['clt_username']	 =	$_REQUEST['str_clt_username'];
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
    <td align="right"><a href="index.php"><img src="images/list-details.png" alt="" title="Home" border="0" /></a></td>
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
        <td width="10%" align="right" nowrap="nowrap">Password <span class="err">*</span>:</td>
        <td width="40%"><input type="password" class="required textbox" id="str_clt_pwd" name="str_clt_pwd" size="20" /></td>
        </tr>
      <tr>
        <td width="20%" align="right" nowrap="nowrap">Conf Password <span class="err">*</span>:</td>
        <td width="30%"><input type="password" class="required textbox" id="strpassword" name="confirmpassword" size="20"  /></td>
        <td width="10%" align="right" nowrap="nowrap"> </td>
        <td width="40%"><input type="submit" name="submit" id="submit" value="Submit"/></td>
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
           
         
          </form>
        </div>
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>