<?php 
include("_session.php"); 
include("_dataAccess.php");
$pagename = "campaign.php"; 


if(isset($_POST['submit']))
{
		/*	if($_POST['str_cmpid']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Select Campaign.");
			}
			if($_POST['str_cltid']=="")
			{
					array_push($_SESSION['errmessage'],"Please Select Client.");
			}
			if($_POST['str_script']=="")
			{
					array_push($_SESSION['errmessage'],"Last Name Must be Filled in correct Format.");
			}
					
	if(count($_SESSION['errmessage'])==0)
	{	*/
	
			$sqli->table='campaigns';
			$updateInformation['cmp_name']		=	$_POST['str_cmp_name'];
			for($i=1;$i<=50;$i++)
			{ 			
			$updateInformation['Type'.$i.'']	=	$_POST['str_type'.$i.'_name'];			
			}
			$updateInformation['mod_date']		=	date("y-m-d h:m:s");
						
			$fields 										= 	array_keys($updateInformation);
			$values											=	array_values($updateInformation);
			$sqli											->	autocommit(FALSE);
			$where=array('cmp_id'=>$_POST['cmpid']);	
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
				pageRedirection("listcampaign.php");
			
				
	//}
		
	
}

?>
<?php include("includes/header.php");

if(isset($_GET['cmpID']))
{
$strQuery1 ="Select * from campaigns where cmp_id='".$_GET['cmpID']."'";
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
    <td><h2>Campaign Form</h2></td>
    <td align="right"><a href="#"><img src="images/list-details.png" alt="" title="List Campaign" border="0" /></a></td>
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
          <form action="" method="post" class="" id="campaignForm" name="campaignForm">
           <fieldset>
    <legend>Campaign</legend><input type="hidden" name="cmpid" value="<?php echo $data[0]['cmp_id']; ?>" />
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
  <tr>
    <td align="right" nowrap="nowrap"><strong>Campaign Name</strong><span class="err">*</span>:</td>
    <td align="left"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name" value="<?php echo $data[0]['cmp_name']; ?>"/>
    </td>
    </tr>
  <tr>
  <td colspan="2">
  
  <?php for($i=1;$i<=50;$i++) { ?>
  
  <fieldset>
    <legend>Type<?php echo $i;?></legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="900">
 	 <tr>
    <td nowrap="nowrap">Name<span class="err">*</span>:</td>
    <td><input type="text" class="required textbox" name="str_type<?php echo $i;?>_name" size="30" id="str_type<?php echo $i;?>_name" value="<?php echo $data[0]['Type'.$i.'']; ?>"/></td>
    <td>Type<span class="err">*</span>:</td>
    <td><select name="str_type<?php echo $i;?>_type" id="str_type<?php echo $i;?>_type">
		<option value="" >- Select -</option>
        <option value="Radio" >Radio</option>
        <option value="Chechbox" >Check Box</option>
        <option value="Select" >Select Box</option>
      
        </select></td>
    <td>Value<span class="err">*</span>:</td>
     <td><input type="text" class="required textbox" name="str_type<?php echo $i;?>_value" size="30" id="str_type<?php echo $i;?>_value"/></td>
	</tr>
    
	
	
  
    </table>
  </fieldset>
 
   <?php }?>
</td></tr>

  <tr>
    <td width="50%">&nbsp;</td>
    <td ><input type="submit" name="submit" id="submit" value="Submit"/></td>
     </table>
 
          </form>
        </div>  
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>
   