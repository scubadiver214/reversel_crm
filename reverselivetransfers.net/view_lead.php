<?php include("_session.php"); 
include("_dataAccess.php");
$pagename = "view_lead.php"; 

if(isset($_GET['refID']))
{
$strQuery1 ="Select * from freshleads where Reference='".$_GET['refID']."'  AND freshleads.User = '". $_SESSION['sessAgentID']."' ";
$data=$sqli->get_selectData($strQuery1);

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
                   
                    <div class="center_content">
      <div class="right_content">            
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>Lead  Details</h2></td>
    <td align="right">
      <img src="images/printbutton2-md.png" alt="" title="Print" onclick="javascript:print();" style="height:30px; width=40px; cursor: pointer; margin-right: 10px;" border="0" />
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
   	 <legend>View Lead</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%" >
 	  <!--part1-->
     <tr>
    <td>
     <fieldset>
    <legend>Personal details</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%" style="font-size:13px;">
	<tr>
	  <td width="20%" align="right" nowrap="nowrap"><strong>Senior Name 1:</strong></td>
	  <input name="refid" type="hidden" value="<?php echo $data[0]['Reference']; ?>" />
    <td width="30%" align="left" nowrap="nowrap"><?php echo $data[0]['Title']." ". $data[0]['FirstName']." ".$data[0]['LastName']; ?></td>
    <td width="20%" align="right"><strong>Senior1 DOB:</strong></td>
    <td width="30%" align="left"><?php echo $data[0]['dob1']; ?></td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap"><strong>Senior Name 2:</strong></td>
      <td align="left" nowrap="nowrap"><?php echo $data[0]['Title2']." ". $data[0]['FirstName2']." ".$data[0]['LastName2']; ?></td>
      <td align="right"><strong>Senior2 DOB:</strong></td>
      <td align="left"><?php echo $data[0]['dob2']; ?></td>
    </tr>
        <tr>
      <td align="right" nowrap="nowrap"><strong>Senior Age 1:</strong></td>
      <td align="left" nowrap="nowrap"><?php echo $data[0]['age']?></td>
      <td align="right" nowrap="nowrap"><strong>Senior Age 2:</strong></td>
      <td align="left" nowrap="nowrap"><?php echo $data[0]['age2']?></td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap"><strong>Phone Number:</strong></td>
      <td align="left" nowrap="nowrap"><?php echo $data[0]['Telephone1']?></td>
      <td align="right"><strong>Alternative Phone Number:</strong></td>
      <td align="left"><?php echo $data[0]['Telephone2']?></td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><strong>Email:</strong></td>
      <td width="30%" align="left" nowrap="nowrap"><?php echo $data[0]['Email']?></td>
      <td width="20%" align="right">&nbsp;</td>
      <td width="30%" align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap"><strong>Address:</strong></td>
      <td align="left" nowrap="nowrap"><?php echo $data[0]['Address']?></td>
      <td width="20%" align="right" valign="top"><strong>Town/City:</strong></td>
      <td width="30%" align="left" valign="top"><?php echo $data[0]['TownCity']?></td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap"><strong>State:</strong></td>
      <td align="left" nowrap="nowrap"><?php
	$strQuery12="select * from zone where zone_id = '".$data[0]['stateName']."' ";
	$datas=$sqli->get_selectData($strQuery12); ?>
        <label><?php echo $datas[0]['name'];?></label></td>
      <td width="20%" align="right" valign="top"><strong>Zipcode:</strong></td>
      <td width="30%" align="left" valign="top"><?php echo $data[0]['Postcode']?></td>
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
	$strQuery1="select * from campaigns where cmp_id='".$data[0]['campaignid']."'";
	$datacmp=$sqli->get_selectData($strQuery1); 
	?>
     <?php
	$strQuerys="select * from emp_status where s_id='".$data[0]['Data6']."'";
	$datas=$sqli->get_selectData($strQuerys); 
	?>
    <legend><?php echo $datacmp[0]['cmp_name'] ?></legend>
    <input type="hidden" name="str_campaignid"  value="<?php echo $data[0]['campaignid'] ?>"/><table border="0" align="center" cellpadding="2" cellspacing="3" width="100%" style="font-size:13px;">
    
    
    <tr>
   <?php for($i=1;$i<=$datacmp[0]['type_no'];$i++)
   {?>
   <td width="17%" align="right" ><strong><?php echo $datacmp[0]['Type'.$i] ?>:</strong></td>
	  
    <td width="16%" align="left" ><?php echo $data[0]['Data'.$i]?></td>
   <?php
	   if(($i%2)==0) echo " </tr><tr>";
  } ?>
	</tr>
	  
   
   
   
    </table>
     </fieldset>
    </td>
 	</tr>
     <!--part3--> 
    <tr>
    <td>
   
    <fieldset>
    <legend>Transfer Detail</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%"  style="font-size:13px;">
	<tr>
    <td width="20%" align="right" valign="top" nowrap="nowrap"><strong>Transfer To:</strong></td>
    <td width="30%" align="left" valign="top">
 <label><?php echo $data[0]['transfer_to'];?></label>
  
    </td>
     <td width="20%" align="right" valign="top" nowrap="nowrap"><strong>Comments:</strong></td>
    <td width="30%" align="left" valign="top"><label><?php echo $data[0]['comments']?></label> </td>
    </tr>
   
    </table>
     </fieldset>
    </td>
 	</tr>
      <!--part4-->
   
 
     </table>
 </fieldset>
          </form>
        </div>  
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
   
   