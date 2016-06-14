<?php include("_session.php"); ?>
<?php
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
			$insertInformation['cmp_name']		=	$_POST['str_cmp_name'];
			for($i=1;$i<=50;$i++)
			{ 
			
			$insertInformation['Type'.$i.'']			=	$_POST['str_type'.$i.'_name'];
			
			}
			$insertInformation['mod_date']		=	date("y-m-d h:m:s:");
						
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
				
	//}
		
	
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
    <td><h2>Campaign Form</h2></td>
    <td align="right"><a href="listcampaign.php"><img src="images/list-details.png" alt="" title="List Campaign" border="0" /></a></td>
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
   	 <legend>Campaign</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="900">
 	  <!--part1-->
     <tr>
    <td>
     <fieldset>
    <legend>Personal details</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="900">
	<tr>
    <td width="30%" align="right" nowrap="nowrap">First Name<span class="err">*</span>:</td>
    <td align="left"> <select name="dd_title" id="title">
						<option value="" selected="selected">Title</option>
						<option value="Mr">Mr</option>
                         <option value="Mrs">Mrs</option>
                         <option value="Miss">Miss</option>
                          <option value="Ms">Ms</option>
                          <option value="Dr">Dr</option>
                           <option value="Prof">Prof</option>
							</select>
                                <input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/>
    </td>
    </tr>
    <tr>
    <td width="40%" align="right" nowrap="nowrap">Last Name<span class="err">*</span>:</td>
    <td align="left"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/>
    </td>
    </tr>
    <tr>
    <td width="40%" align="right" nowrap="nowrap">Phone Number<span class="err">*</span>:</td>
    <td align="left"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/>
    </td>
    </tr>
    <tr>
    <td width="40%" align="right" nowrap="nowrap">Alternative Phone Number<span class="err">*</span>:</td>
    <td align="left"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/>
    </td>
    </tr>
    <tr>
    <td width="40%" align="right" nowrap="nowrap">Mobile<span class="err">*</span>:</td>
    <td align="left"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/>
    </td>
    </tr>
    <tr>
    <td width="40%" align="right" nowrap="nowrap">Email<span class="err">*</span>:</td>
    <td align="left"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/>
    </td>
    </tr>
    <tr>
    <td width="40%" align="right" nowrap="nowrap">Address<span class="err">*</span>:</td>
    <td align="left"><textarea name="straddress" cols="32" rows="5" class="" id="straddress"></textarea>
    </td>
    </tr>
     <tr>
    <td width="40%" align="right" nowrap="nowrap">Town/City<span class="err">*</span>:</td>
    <td align="left"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/>
    </td>
    </tr>
     <tr>
    <td width="40%" align="right" nowrap="nowrap">Zipcode<span class="err">*</span>:</td>
    <td align="left"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/>
    </td>
    </tr>
     <tr>
    <td width="40%" align="right" nowrap="nowrap">State<span class="err">*</span>:</td>
    <td align="left"><select name="dd_country" id="dd_country"> 
     <option value="" selected="selected">- Select -</option>
	<?php
	$strQuery14="select * from state";
$datastate=$sqli->get_selectData($strQuery14); 
	
	 foreach($datastate as $key=>$valuestate){?>
                         
<option value="<?php echo $valuestate['state_id'];?>"> <?php echo $valuestate['state_name'];?></option>
<?php }?>
    </select>
    </td>
    </tr>
    </table>
     </fieldset>
    <?php //include("headerlead.php"); ?>
    
    </td>
 	 </tr>
     <!--part2-->
     
    <tr>
    <td>
     <fieldset>
     <?php
	$strQuery1="select * from campaigns where cmp_id=1";
	$datacmp=$sqli->get_selectData($strQuery1); 
	?>
    <legend><?php echo $datacmp[0]['cmp_name'] ?></legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="900">
   
	<tr>
    <td width="18%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type1'] ?><span class="err">*</span>:</td>
    <td width="30%" align="left"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/>
    </td>
    </tr>
    <tr>
    <td width="18%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type2'] ?><span class="err">*</span>:</td>
    <td align="left"> 
    <select name="dd_title" id="title">
	<option value="" selected="selected">Select..</option>
	<option value="Mr">Mr</option>
    <option value="Mrs">Mrs</option>
    </select>
    </td>
    </tr>
    <tr>
    <td width="18%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type3'] ?><span class="err">*</span>:</td>
    <td width="30%" align="left">
     <select name="dd_title" id="title">
	<option value="" selected="selected">Select..</option>
	<option value="Mr">Mr</option>
    <option value="Mrs">Mrs</option>
    </select>
    </td>
    </tr>
    <tr>
    <td width="18%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type4'] ?><span class="err">*</span>:</td>
    <td width="30%" align="left"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/>
    </td>
    </tr>
    <tr>
    <td width="18%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type5'] ?><span class="err">*</span>:</td>
    <td width="30%" align="left"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/>
    </td>
    </tr>
    <tr>
    <td width="18%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type6'] ?><span class="err">*</span>:</td>
    <td width="30%" align="left">
     <select name="dd_title" id="title">
	<option value="" selected="selected">Select..</option>
	<option value="Mr">Mr</option>
    <option value="Mrs">Mrs</option>
    </select>
    </td>
    </tr>
    <tr>
    <td width="18%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type7'] ?><span class="err">*</span>:</td>
    <td width="30%" align="left">
     <select name="dd_title" id="title">
	<option value="" selected="selected">Select..</option>
	<option value="Mr">Mr</option>
    <option value="Mrs">Mrs</option>
    </select>
    </td>
    </tr>
    <tr>
    <td width="18%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type8'] ?><span class="err">*</span>:</td>
    <td width="30%" align="left"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/>
    </td>
    </tr>
     <tr>
    <td width="18%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type9'] ?><span class="err">*</span>:</td>
    <td width="30%" align="left"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/>
    </td>
    </tr>
     <tr>
    <td width="18%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type10'] ?><span class="err">*</span>:</td>
    <td width="30%" align="left"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/>
    </td>
    </tr>
     <tr>
    <td width="18%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type11'] ?><span class="err">*</span>:</td>
    <td width="30%" align="left">
     <select name="dd_title" id="title">
	<option value="" selected="selected">Select..</option>
	<option value="Mr">Mr</option>
    <option value="Mrs">Mrs</option>
    </select>
    </td>
    </tr>
     <tr>
    <td width="18%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type12'] ?><span class="err">*</span>:</td>
    <td width="30%" align="left"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/>
    </td>
    </tr>
   
    </table>
     </fieldset>
    </td>
 	</tr>
     <!--part3--> 
    <tr>
    <td>
    <fieldset>
    <legend>Agnent View</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="800">
	<tr>
    <td align="right" valign="top" nowrap="nowrap">Agent Name<span class="err">*</span>:</td>
    <td align="left" valign="top"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/></td>
     <td align="right" valign="top" nowrap="nowrap">Comments<span class="err">*</span>:</td>
    <td align="left" valign="top"><textarea name="straddress" cols="32" rows="5" class="" id="straddress"></textarea> </td>
    </tr>
   
    </table>
     </fieldset>
    </td>
 	</tr>
      <!--part4-->
      <tr>
    <td align="center"><input type="submit" name="submit" id="submit" value="Submit"/></td>
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
   