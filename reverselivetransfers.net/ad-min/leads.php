<?php include("_session.php"); ?>
<?php
include("_dataAccess.php");
$pagename = "leads.php"; 


if(isset($_POST['submit']))
{				
				if($_POST['dd_Title']=="")
				{
						array_push($_SESSION['errmessage'],"Please Select Title.");
				}
				if($_POST['str_FirstName']==""  )
				{
						array_push($_SESSION['errmessage'],"First Name Must be Filled in correct Format.");
				}
				if($_POST['str_LastName']=="" )
				{
						array_push($_SESSION['errmessage'],"Last Name Must be Filled in correct Format.");
				}
				if($_POST['str_Mobile']=="" || !is_numeric($_POST['str_Mobile']) )
				{			
						array_push($_SESSION['errmessage'],"Mobile Number Must be Filled in Number only.");
				}
				if($_POST['str_Telephone1']=="" || !is_numeric($_POST['str_Telephone1']))
				{			
						array_push($_SESSION['errmessage'],"Phone Number Must be Filled in Number only .");
				}
				if($_POST['str_Email']=="" || !filter_var($_POST['str_Email'], FILTER_VALIDATE_EMAIL) )
				{
						array_push($_SESSION['errmessage'],"Email Must be Filled in correct Format.");
				}
				if($_POST['dd_stateName']=="")
				{
						array_push($_SESSION['errmessage'],"Please Select State.");
				}
			
			if(count($_SESSION['errmessage'])==0)
			{
	
			$sqli->table='freshleads';
			$insertInformation['Title']	=	$_POST['dd_Title'];
			$insertInformation['FirstName']	=	$_POST['str_FirstName'];
			$insertInformation['LastName']	=	$_POST['str_LastName'];
			$insertInformation['Telephone1']	=	$_POST['str_Telephone1'];
			$insertInformation['Telephone2']	=	$_POST['str_Telephone2'];
			$insertInformation['Mobile']	=	$_POST['str_Mobile'];
			$insertInformation['Email']	=	$_POST['str_Email'];
			$insertInformation['Address']	=	$_POST['str_Address'];
			$insertInformation['TownCity']	=	$_POST['str_TownCity'];
			$insertInformation['Postcode']	=	$_POST['str_Postcode'];
			$insertInformation['stateName']	=	$_POST['dd_stateName'];			
			$insertInformation['Data1']		=	$_POST['str_Data1'];
			$insertInformation['Data2']		=	$_POST['str_Data2'];
			$insertInformation['Data3']		=	$_POST['str_Data3'];
			$insertInformation['Data4']		=	$_POST['str_Data4'];
			$insertInformation['Data5']		=	$_POST['str_Data5'];
			$insertInformation['Data6']		=	$_POST['str_Data6'];
			$insertInformation['Data7']		=	$_POST['str_Data7'];
			$insertInformation['Data8']		=	$_POST['str_Data8'];
			$insertInformation['Data9']		=	$_POST['str_Data9'];
			//$insertInformation['Data10']	=	$_POST['str_Data10'];
			$insertInformation['Data11']	=	$_POST['str_Data11'];
			$insertInformation['Data12']	=	$_POST['str_Data12'];
			$insertInformation['campaignid'] =	1;
			$insertInformation['User'] =	$_POST['dd_agentname'];
			$insertInformation['comments'] =	$_POST['str_comments'];
			$insertInformation['TransferDateTime']		=	date("y-m-d h:m:s");
			$insertInformation['ReceivedDateTime']		=	date("y-m-d h:m:s");
			$insertInformation['IPAddress'] =	$_SERVER['REMOTE_ADDR'];
			
			
			
						
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
                	pageRedirection("listlead.php");
			}
				
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
    <td><h2>Lead</h2></td>
    <td align="right"><a href="listlead.php"><img src="images/list-details.png" alt="" title="List" border="0" /></a></td>
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
          <form action="" method="post" class="" id="leads" name="leads">
           <fieldset>
   	 <legend>List</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
 	  <!--part1-->
     <tr>
    <td>
     <fieldset>
    <legend>Personal details</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
	<tr>
    <td width="20%" align="right" nowrap="nowrap">First Name<span class="err">*</span>:</td>
    <td width="30%" align="left"><select name="dd_Title" id="dd_Title" class="small-select">
      <option value="" selected="selected">Title</option>
      <option value="Mr">Mr</option>
      <option value="Mrs">Mrs</option>
      <option value="Miss">Miss</option>
      <option value="Ms">Ms</option>
      <option value="Dr">Dr</option>
      <option value="Prof">Prof</option>
    </select>
      <input type="text" class="small-textbox" name="str_FirstName" size="30" id="str_FirstName" c/></td>
    <td width="20%" align="right" valign="top">Last Name<span class="err">*:</span></td>
    <td width="30%" align="left" valign="top"><input type="text" class="required textbox" name="str_LastName" size="30" id="str_LastName"/></td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap">Phone Number<span class="err">*</span>:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_Telephone1" size="30" id="str_Telephone1"/></td>
      <td width="20%" align="right" valign="top">Town/City:</td>
      <td width="30%" align="left" valign="top"><input type="text" class="required textbox" name="str_TownCity" size="30" id="str_TownCity"/></td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap">Alternative Phone Number:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_Telephone2" size="30" id="str_Telephone2"/></td>
      <td width="20%" rowspan="3" align="right" valign="top">Address:</td>
      <td width="30%" rowspan="3" align="left" valign="top"><textarea name="str_Address" cols="33" rows="5" class="" id="str_Address"></textarea></td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap">Mobile<span class="err">*</span>:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_Mobile" size="30" id="str_Mobile"/></td>
      </tr>
     <tr>
       <td width="20%" align="right" nowrap="nowrap">Email<span class="err">*</span>:</td>
       <td width="30%" align="left"><input type="text" class="required textbox" name="str_Email" size="30" id="str_Email"/></td>
       </tr>
     <tr>
       <td width="20%" align="right" nowrap="nowrap">Zipcode:</td>
       <td width="30%" align="left"><input type="text" class="required textbox" name="str_Postcode" size="30" id="str_Postcode"/></td>
       <td width="20%" align="right" valign="top">State<span class="err">*</span>:</td>
       <td width="30%" align="left" valign="top"><select name="dd_stateName" id="dd_stateName"> 
         <option value="" selected="selected">- Select -</option>
         <?php
	$strQuery14="select * from zone where country_id=223";
$datastate=$sqli->get_selectData($strQuery14); 
	
	 foreach($datastate as $key=>$valuestate){?>
         
  <option value="<?php echo $valuestate['code'];?>"> <?php echo $valuestate['name'];?></option>
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
     <?php //include("mca.php"); ?>
     <fieldset>
     <?php
	$strQuery1="select * from campaigns where cmp_id=1";
	$datacmp=$sqli->get_selectData($strQuery1); 
	?>
    <legend><?php echo $datacmp[0]['cmp_name'] ?></legend>
    <input type="hidden" name="str_campaignid" value="<?php echo $datacmp[0]['cmp_id']; ?>" />
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type1'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data1" size="30" id="str_Data1"/></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type2'] ?>:</td>
      <td align="left"> 
        <select name="str_Data2" id="str_Data2">
          <option value="" selected="selected">Select..</option>
          <option value="Yes">Yes</option>
          <option value="No">No</option>
          </select>
        </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type3'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><select name="str_Data3" id="str_Data3">
        <option value="" selected="selected">Select..</option>
        <option value="0">0 Years</option>
        <option value="1">1 Years</option>
        <option value="2">2 Years</option>
        <option value="3">3 Years</option>
        <option value="4">4 Years</option>
        <option value="5">5 Years</option>
        <option value="6">6 Years</option>
        <option value="7">7 Years</option>
        <option value="8">8 Years</option>
        <option value="9">9 Years</option>
        <option value="10">10 Years</option>
        <option value="11">11 Years</option>
        <option value="12">12 Years</option>
        <option value="13">13 Years</option>
        <option value="14">14 Years</option>
        <option value="15">15 Years</option>
        <option value="16">16 Years</option>
        <option value="17">17 Years</option>
        <option value="18">18 Years</option>
        <option value="19">19 Years</option>
        <option value="20">20 Years</option>
        </select></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type4'] ?>:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_Data4" size="30" id="str_Data4"/>
        </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type5'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data5" size="30" id="str_Data5"/></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type6'] ?>:</td>
      <td width="30%" align="left">
        <select name="str_Data6" id="str_Data6">
          <option value="" selected="selected">Select..</option>
          <option value="Yes">Yes</option>
          <option value="No">No</option>
          </select>
        </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type8'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data8" size="30" id="str_Data8"/></td>
    <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type7'] ?>:</td>
    <td width="30%" align="left">
     <select name="str_Data7" id="str_Data7">
	<option value="" selected="selected">Select..</option>
	<option value="Yes">Yes</option>
    <option value="No">No</option>
    </select>
    </td>
    </tr>
     <tr>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type9'] ?>:</td>
       <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data9" size="30" id="str_Data9"/></td>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type10'] ?>:</td>
       <td width="30%" align="left"><input type="text" class="required textbox" name="str_Data10" size="30" id="str_Data10"/>
         </td>
     </tr>
     <tr>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type11'] ?>:</td>
       <td width="30%" align="left" nowrap="nowrap"><select name="str_Data11" id="str_Data11">
         <option value="" selected="selected">Select..</option>
         <option value="Yes">Yes</option>
         <option value="No">No</option>
         </select></td>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type12'] ?>:</td>
       <td width="30%" align="left"><input type="text" class="required textbox" name="str_Data12" size="30" id="str_Data12"/>
         </td>
     </tr>
   
    </table>
     </fieldset>
    </td>
 	</tr>
     <!--part3--> 
    <tr>
    <td>
     <?php //include("footerlead.php"); ?>
    <fieldset>
    <legend>Agnent View</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
	<tr>
    <td width="20%" align="right" valign="top" nowrap="nowrap">Agent Name:</td>
    <td width="30%" align="left" valign="top"><input type="text" class="required textbox" name="str_transfer_to" size="30" id="str_transfer_to"/>
   
    </td>
     <td width="20%" align="right" valign="top" nowrap="nowrap">Comments:</td>
    <td width="30%" align="left" valign="top"><textarea name="str_comments" cols="32" rows="5" class="" id="str_comments"></textarea> </td>
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
   