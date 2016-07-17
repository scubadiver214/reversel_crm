<?php include("_session.php"); 
include("_dataAccess.php");
$pagename = "update_lead.php"; 

if(isset($_POST['submit']))
{
				if($_POST['str_Telephone1']=="" )
				{			
						array_push($_SESSION['errmessage'],"Phone Number Must be Filled in correct format.");
				}
				
				if($_POST['dd_stateName']=="")
				{
						array_push($_SESSION['errmessage'],"Please Select State.");
				}

				if($_POST['str_Email']!="" && !filter_var($_POST['str_Email'], FILTER_VALIDATE_EMAIL)) 
				{
						array_push($_SESSION['errmessage'],"Email is not required. But if provided, it must be entered in the correct Format.");
				}
							if($_POST['age']=="" )
				{
						array_push($_SESSION['errmessage'],"Age is required.");
				}
			
			if(count($_SESSION['errmessage'])==0) {		
			$sqli->table='freshleads';
			$updateInformation['Title']	        =	$_POST['dd_Title'];
			$updateInformation['FirstName']	    =	$_POST['str_FirstName'];
			$updateInformation['LastName']	    =	$_POST['str_LastName'];
      $updateInformation['Title2']	    =	$_POST['dd_Title2'];
			$updateInformation['FirstName2']	=	$_POST['str_FirstName2'];
			$updateInformation['LastName2']	    =	$_POST['str_LastName2'];            
            
			if($_POST['str_dob1']!=""){
				$dates = explode('-', $_POST['str_dob1']);
				$month = $dates[0];
				$day = $dates[1];
				$year = $dates[2];
				$finalDob = $year.'-'.$month.'-'.$day;
				$insertInformation['dob1']	        =	$finalDob;
			}
          
      if($_POST['str_dob2']!=""){
				$dates2 = explode('-', $_POST['str_dob2']);
				$month2 = $dates2[0];
				$day2 = $dates2[1];
				$year2 = $dates2[2];
				$finalDob2 = $year2.'-'.$month2.'-'.$day2;
				$insertInformation['dob2'] =	$finalDob2;
			}    

			$insertInformation['age']	    =	$_POST['age'];

			if($_POST['age2']!= ""){
				$insertInformation['age2']	    =	$_POST['age2'];
			}
			$updateInformation['Telephone1']	=	$_POST['str_Telephone1'];
			$updateInformation['Telephone2']	=	$_POST['str_Telephone2'];		
			$updateInformation['Email']	        =	$_POST['str_Email'];
			$updateInformation['Address']	    =	$_POST['str_Address'];
			$updateInformation['TownCity']	    =	$_POST['str_TownCity'];
			$updateInformation['Postcode']	    =	$_POST['str_Postcode'];
			$updateInformation['stateName']	    =	$_POST['dd_stateName'];		
			$no_of_leads=$_POST['cmpcount'];
			for($i=1;$i<=$no_of_leads;$i++){					
			$updateInformation['Data'.$i]	  =	$_POST['str_Data'.$i];
			}			
			$updateInformation['transfer_to'] =	$_POST['str_transfer_to'];
			$updateInformation['comments']    =	$_POST['str_comments'];
			$updateInformation['TransferDateTime']	=	date("y-m-d h:m:s");
			$updateInformation['ReceivedDateTime']	=	date("y-m-d h:m:s");
			$updateInformation['IPAddress'] =	$_SERVER['REMOTE_ADDR'];			
			$fields = 	array_keys($updateInformation);
			$values	=	array_values($updateInformation);
			$sqli ->	autocommit(FALSE);
			$where=array('Reference'=>$_POST['refid']);	
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
				pageRedirection("listlead.php");
				}			
			exit;
	}
}

?>
<?php include("includes/header.php");
if(isset($_GET['refID']))
{
$strQuery1 ="Select * from freshleads where Reference='".$_GET['refID']."'";
$data=$sqli->get_selectData($strQuery1);
$ref= $data[0]['Reference'];
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
    <td><h2>Update Lead</h2></td>
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
          <form action="" method="post" class="" id="Form" name="Form">
           <fieldset>
   	 <legend>Update List</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
 	  <!--part1-->
    
     <tr>
    <td>
    <fieldset>
     
  
    <input type="hidden" class="small-textbox" name="refid" id="refid" value="<?php echo $data[0]['Reference']?>"/>
    <legend>Personal details </legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
	<tr>
    <td width="20%" align="right" nowrap="nowrap">First Name(Senior 1)<span class="err">*</span>:</td>
    <td width="30%" align="left"><select name="dd_Title" id="dd_Title" class="small-select">
      <option value="" selected="selected">Title</option>
      <option value="Mr" <?php if($data[0]['Title']=="Mr") echo "selected=\"selected\"" ?>>Mr</option>
      <option value="Mrs" <?php if($data[0]['Title']=="Mrs") echo "selected=\"selected\"" ?>>Mrs</option>
      <option value="Miss" <?php if($data[0]['Title']=="Miss") echo "selected=\"selected\"" ?>>Miss</option>
      <option value="Ms" <?php if($data[0]['Title']=="Ms") echo "selected=\"selected\"" ?>>Ms</option>
      <option value="Dr" <?php if($data[0]['Title']=="Dr") echo "selected=\"selected\"" ?>>Dr</option>
      <option value="Prof" <?php if($data[0]['Title']=="Prof") echo "selected=\"selected\"" ?>>Prof</option>
    </select>
      <input type="text" class="small-textbox" name="str_FirstName" size="24" id="str_FirstName" value="<?php echo $data[0]['FirstName']?>"/></td>
    <td width="20%" align="right" valign="top">Last Name(Senior 1)<span class="err">*:</span></td>
    <td width="30%" align="left" valign="top"><input type="text" class="required textbox" name="str_LastName" size="30" id="str_LastName" value="<?php echo $data[0]['LastName']?>"/></td>
    </tr>
    
    	<tr>
    <td width="20%" align="right" nowrap="nowrap">First Name(Senior 2):</td>
    <td width="30%" align="left"><select name="dd_Title2" id="dd_Title" class="small-select">
      <option value="" selected="selected">Title</option>
     <option value="Mr" <?php if($data[0]['Title2']=="Mr") echo "selected=\"selected\"" ?>>Mr</option>
      <option value="Mrs" <?php if($data[0]['Title2']=="Mrs") echo "selected=\"selected\"" ?>>Mrs</option>
      <option value="Miss" <?php if($data[0]['Title2']=="Miss") echo "selected=\"selected\"" ?>>Miss</option>
      <option value="Ms" <?php if($data[0]['Title2']=="Ms") echo "selected=\"selected\"" ?>>Ms</option>
      <option value="Dr" <?php if($data[0]['Title2']=="Dr") echo "selected=\"selected\"" ?>>Dr</option>
      <option value="Prof" <?php if($data[0]['Title2']=="Prof") echo "selected=\"selected\"" ?>>Prof</option>
    </select>
      <input type="text" class="small-textbox" name="str_FirstName2" size="24" id="str_FirstName" value="<?php echo $data[0]['FirstName2']?>"/></td>
    <td width="20%" align="right" valign="top">Last Name(Senior 2)<span class="err">*:</span></td>
    <td width="30%" align="left" valign="top"><input type="text" class="required textbox" name="str_LastName2" size="30" id="str_LastName" value="<?php echo $data[0]['LastName2']?>"/></td>
    </tr>
        <!-- age -->
    <tr>
      <td width="20%" align="right" nowrap="nowrap">Age (Senior 1)<span class="err">*</span>:</td>
      <td width="30%" align="left"><input type="text" class="required textbox"  name="age" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo $data[0]['age'];?>"/></td>
      <td width="20%" align="right" nowrap="nowrap">Age (Senior 2):</td>
      <td width="30%" align="left"><input type="text" name="age2" size="3" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo $data[0]['age2'];?>"/></td>
    </tr>
     <tr>
      <td width="20%" align="right" nowrap="nowrap">Date of Birth(Senior 1):</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_dob1" size="30" id="datepicker" value="<?php echo $data[0]['dob1'];?>"/></td>
      <td width="20%" align="right" valign="top">Date of Birth(Senior 2):</td>
      <td width="30%" align="left" valign="top"><input type="text" class="required textbox" name="str_dob2" size="30" id="datepicker1" value="<?php echo $data[0]['dob2'];?>"/></td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap">Phone Number<span class="err">*</span>:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_Telephone1" size="30" id="str_Telephone1" readonly="readonly" value="<?php echo $data[0]['Telephone1']?>"/></td>
      <td width="20%" align="right" valign="top">Town/City:</td>
      <td width="30%" align="left" valign="top"><input type="text" class="required textbox" name="str_TownCity" size="30" id="str_TownCity" value="<?php echo $data[0]['TownCity']?>"/></td>
    </tr>
    
    
    <tr>
      <td width="20%" align="right" nowrap="nowrap">Alternative Phone Number:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_Telephone2" size="30" id="str_Telephone2" value="<?php echo $data[0]['Telephone2']?>"/></td>
      <td width="20%" rowspan="2" align="right" valign="top">Property Address:</td>
      <td width="30%" rowspan="2" align="left" valign="top"><textarea name="str_Address" cols="33" rows="5" class="" id="str_Address"><?php echo $data[0]['Address']?></textarea></td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap">Email:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_Email" size="30" id="str_Email" value="<?php echo $data[0]['Email']?>"/></td>
      </tr>
     <tr>
       <td width="20%" align="right" nowrap="nowrap">State<span class="err">*</span>:</td>
       <td width="30%" align="left"><select name="dd_stateName" id="dd_stateName">
         <option value="" selected="selected">- Select -</option>
         <?php
	$strQuery14="select * from zone where country_id=223";
$datastate=$sqli->get_selectData($strQuery14); 
	
	 foreach($datastate as $key=>$valuestate){?>
         <option value="<?php echo $valuestate['zone_id'];?>" <?php if($data[0]['stateName']== $valuestate['zone_id']) echo "selected=\"selected\"" ?>> <?php echo $valuestate['name'];?></option>
         <?php }?>
         </select></td>
       <td width="20%" align="right" valign="top">Zipcode:</td>
       <td width="30%" align="left" valign="top"><input type="text" class="required textbox" name="str_Postcode" size="30" id="str_Postcode" value="<?php echo $data[0]['Postcode']?>"/></td>
     </tr>
     </table>
     </fieldset>
    <?php //include("leadformheader.php.php"); ?>
    
    </td>
 	 </tr>
     <!--part2-->
     
    <tr>
    <td>
     <?php include("formTemplate/".$data[0]['campaignid'].".php"); ?>
     
    </td>
 	</tr>
     <!--part3--> 
    <tr>
    <td>
     <?php //include("footerlead.php"); ?>
    <fieldset>
    <legend>Agent View</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
	<tr>
    <td width="20%" align="right" valign="top" nowrap="nowrap">Agent Name:</td>
    <td width="30%" align="left" valign="top"><input type="text" class="required textbox" name="str_transfer_to" size="30" id="str_transfer_to" value="<?php echo $data[0]['transfer_to']?>"/>
    
    </td>
     <td width="20%" align="right" valign="top" nowrap="nowrap">Comments:</td>
    <td width="30%" align="left" valign="top"><textarea name="str_comments" cols="32" rows="5" class="" id="str_comments"><?php echo $data[0]['comments']?></textarea> </td>
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
   