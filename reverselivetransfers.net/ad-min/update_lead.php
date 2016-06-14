<?php 
$pagename = "update_lead.php";
include("_session.php"); 
include("_dataAccess.php");

if(isset($_POST['submit']))
{				                          
                
                if($_POST['dd_Title']=="")
				{
						array_push($_SESSION['errmessage'],"Please Select Title.");
				}
				if($_POST['str_FirstName']==""  )
				{
						array_push($_SESSION['errmessage'],"Please Fill First Name .");
				}
				if($_POST['str_LastName']=="" )
				{
						array_push($_SESSION['errmessage'],"Please Fill Last Name .");
				}
				if($_POST['str_Mobile']=="" )
				{			
						array_push($_SESSION['errmessage'],"Please Fill Mobile Number .");
				}
				if($_POST['str_Telephone1']=="" )
				{			
						array_push($_SESSION['errmessage'],"Please Fill Phone Number.");
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
			$updateInformation['Title']	         =	$_POST['dd_Title'];
			$updateInformation['FirstName']	     =	$_POST['str_FirstName'];
			$updateInformation['LastName']       =	$_POST['str_LastName'];
			$updateInformation['Telephone1']	 =	$_POST['str_Telephone1'];
			$updateInformation['Telephone2']     =	$_POST['str_Telephone2'];
			$updateInformation['Mobile']	     =	$_POST['str_Mobile'];
			$updateInformation['Email']	         =	$_POST['str_Email'];
			$updateInformation['Address']	     =	$_POST['str_Address'];
			$updateInformation['TownCity']	     =	$_POST['str_TownCity'];
			$updateInformation['Postcode']	     =	$_POST['str_Postcode'];
			$updateInformation['stateName']	     =	$_POST['dd_stateName'];	
            
            $strQuery55 ="SELECT * FROM freshleads WHERE Buyer='".$_POST['dd_Buyer']."' AND campaignid='".$_POST['str_campaignid']."' AND( `Telephone1` LIKE  '".$_POST['str_Telephone1']."' OR `Telephone2` LIKE  '".$_POST['str_Telephone1']."')";	
			$data44=$sqli->get_selectData($strQuery55);
            if(count($data44)==0)
			{
	 			$updateInformation['Buyer']	     =	$_POST['dd_Buyer'];	
			}
			else
			{
			  array_push($_SESSION['errmessage'],"This Client is duplicate, please continue with other client.");              
			}               
            		
			$no_of_leads=$_POST['cmpcount'];
			for($i=1;$i<=$no_of_leads;$i++)
            {					
			$updateInformation['Data'.$i]		   =	$_POST['str_Data'.$i];
			}			
			$updateInformation['transfer_to']      =	$_POST['str_transfer_to'];
			$updateInformation['comments']         =	$_POST['str_comments'];
			$updateInformation['TransferDateTime'] =	date("y-m-d h:m:s");
			$updateInformation['ReceivedDateTime'] =	date("y-m-d h:m:s");
			$updateInformation['IPAddress']        =	$_SERVER['REMOTE_ADDR'];			
			$fields 										= 	array_keys($updateInformation);
			$values											=	array_values($updateInformation);
			$sqli											->	autocommit(FALSE);
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
          <form action="" method="post" class="" id="Form" name="Form">
           <fieldset>
   	 <legend>Update List</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
 	  <!--part1-->
         <tr>
    <td>
  
    <fieldset>
    <legend>Transfer Details</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
	<tr>
    <td width="20%" align="right" valign="top" nowrap="nowrap">Client:</td>
    <td width="30%" align="left" valign="top">
    <select name="dd_Buyer" id="dd_Buyer">         
         <?php
	$strQuery1="select * from client_user where clt_status=1";
	$datac=$sqli->get_selectData($strQuery1); 	
	 foreach($datac as $key=>$valuec){?>         
  <option value="<?php echo $valuec['cltid'];?>"<?php if($data[0]['Buyer']==$valuec['cltid']) echo "selected=\"selected\"" ?>> <?php echo $valuec['clt_comp'];?></option>
  <?php }?>
         </select>
    </td>
     <td width="20%" align="right" valign="top" nowrap="nowrap">&nbsp;</td>
    <td width="30%" align="left" valign="top">&nbsp; </td>
    </tr>
   
    </table>
     </fieldset>
    </td>
 	</tr>
     <tr>
    <td>
     <fieldset>
    <legend>Personal details</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
	<tr>
    <input name="str_campaignid" type="hidden" value="<?php echo $data[0]['campaignid']; ?>" />
    
    <input name="refid" type="hidden" value="<?php echo $data[0]['Reference']; ?>" />
    <td width="20%" align="right" nowrap="nowrap">First Name<span class="err">*</span>:</td>
    <td width="30%" align="left"><select name="dd_Title" id="dd_Title" class="small-select">
      <option value="" selected="selected">Title</option>
      <option value="Mr" <?php if($data[0]['Title']=="Mr") echo "selected=\"selected\"" ?>>Mr</option>
      <option value="Mrs" <?php if($data[0]['Title']=="Mrs") echo "selected=\"selected\"" ?>>Mrs</option>
      <option value="Miss" <?php if($data[0]['Title']=="Miss") echo "selected=\"selected\"" ?>>Miss</option>
      <option value="Ms" <?php if($data[0]['Title']=="Ms") echo "selected=\"selected\"" ?>>Ms</option>
      <option value="Dr" <?php if($data[0]['Title']=="Dr") echo "selected=\"selected\"" ?>>Dr</option>
      <option value="Prof" <?php if($data[0]['Title']=="Prof") echo "selected=\"selected\"" ?>>Prof</option>
    </select>
      <input type="text" class="small-textbox" name="str_FirstName" size="30" id="str_FirstName" value="<?php echo $data[0]['FirstName']?>"/></td>
    <td width="20%" align="right">Last Name<span class="err">*</span>:</td>
    <td align="left"><input type="text" class="required textbox" name="str_LastName" size="30" id="str_LastName"  value="<?php echo $data[0]['LastName']?>"/></td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap">Phone Number<span class="err">*</span>:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_Telephone1" size="30" id="str_Telephone1" value="<?php echo $data[0]['Telephone1']?>"/></td>
      <td width="20%" align="right">Town/City:</td>
      <td align="left"><input type="text" class="required textbox" name="str_TownCity" size="30" id="str_TownCity" value="<?php echo $data[0]['TownCity']?>"/></td>
    </tr>
    <tr>
    <td width="20%" align="right" nowrap="nowrap">Alternative Phone Number:</td>
    <td width="30%" align="left"><input type="text" class="required textbox" name="str_Telephone2" size="30" id="str_Telephone2" value="<?php echo $data[0]['Telephone2']?>"/></td>
    <td width="20%" rowspan="3" align="right">Address:</td>
    <td rowspan="3" align="left"><textarea name="str_Address" cols="32" rows="5" class="" id="str_Address"><?php echo $data[0]['Address']?></textarea></td>
    </tr>
    <tr>
    <td width="20%" align="right" nowrap="nowrap">Mobile<span class="err">*</span>:</td>
    <td width="30%" align="left"><input type="text" class="required textbox" name="str_Mobile" size="30" id="str_Mobile" value="<?php echo $data[0]['Mobile']?>"/></td>
    </tr>
    <tr>
    <td width="20%" align="right" nowrap="nowrap">Email<span class="err">*</span>:</td>
    <td width="30%" align="left"><input type="text" class="required textbox" name="str_Email" size="30" id="str_Email" value="<?php echo $data[0]['Email']?>"/></td>
    </tr>
    <tr>
    <td width="20%" align="right" nowrap="nowrap">Zipcode:</td>
    <td width="30%" align="left"><input type="text" class="required textbox" name="str_Postcode" size="30" id="str_Postcode" value="<?php echo $data[0]['Postcode']?>"/></td>
    <td width="20%" align="right">State<span class="err">*</span>:</td>
    <td align="left"><select name="dd_stateName" id="dd_stateName">
      <option value="" selected="selected">- Select -</option>
      <?php
	$strQuery14="select * from zone where country_id=223";
$datastate=$sqli->get_selectData($strQuery14); 
	
	 foreach($datastate as $key=>$valuestate){?>
      <option value="<?php echo $valuestate['zone_id'];?>" <?php if($data[0]['stateName']== $valuestate['zone_id']) echo "selected=\"selected\"" ?>> <?php echo $valuestate['name'];?></option>
      <?php }?>
    </select></td>
    </tr>
    </table>
     </fieldset>
    <?php //include("headerlead.php"); ?>
    
    </td>
 	 </tr>
     <!--part2-->
     
    <tr>
    <td>
     <?php include("../formTemplate/".$data[0]['campaignid'].".php"); ?>
     
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
   