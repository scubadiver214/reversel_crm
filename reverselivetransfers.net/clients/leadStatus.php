<?php include("_session.php"); ?>
<?php
include("_dataAccess.php");
$pagename = "leadStatus.php?ref=".$_REQUEST['ref'];

$statuscodes		=		$sqli->get_selectData("SELECT * FROM `disposition` where dispid>2");

$orderDetails 		=		$sqli->get_selectData("SELECT agent_user.ag_fname,agent_user.ag_lname,client_user.clt_alias,client_user.clt_comp,campaigns.cmp_name,center_user.cen_comp,disposition.dispname,freshleads.Reference,freshleads.ReceivedDateTime,freshleads.Title,freshleads.FirstName,freshleads.MiddleNames,freshleads.LastName,freshleads.Telephone1,freshleads.Telephone2,freshleads.Mobile,freshleads.Email,freshleads.Address,freshleads.Address2,freshleads.Address3,freshleads.TownCity,freshleads.stateName,freshleads.Postcode,freshleads.Data1,freshleads.Data2,freshleads.Data3,freshleads.Data4,freshleads.Data5,freshleads.Data6,freshleads.Data7,freshleads.Data8,freshleads.Status,
freshleads.Data9,freshleads.Data10,freshleads.Data11,freshleads.Data12,freshleads.Data13,freshleads.Data14,freshleads.Data15,freshleads.Data16,freshleads.Data17,freshleads.Data18,freshleads.Data19,freshleads.Data20,freshleads.Data21,freshleads.Data22,freshleads.Data23,freshleads.Data24,freshleads.Data25,freshleads.Data26,freshleads.Data27,freshleads.Data28,freshleads.Data29,freshleads.Data30,freshleads.Data31,freshleads.Data32,freshleads.Data33,freshleads.Data34,freshleads.Data35,
freshleads.Data36,freshleads.Data37,freshleads.Data38,freshleads.Data39,freshleads.Data40,freshleads.Data41,freshleads.Data42,freshleads.Data43,freshleads.Data44,freshleads.Data45,freshleads.Data46,freshleads.Data47,freshleads.Data48,freshleads.Data49,freshleads.Data50,freshleads.transfer_to,freshleads.comments FROM agent_user ,center_user ,campaigns ,client_user ,disposition,freshleads WHERE freshleads.Status = disposition.dispid AND agent_user.agid = freshleads.User AND  client_user.cltid = freshleads.Buyer AND campaigns.cmp_id = freshleads.campaignid AND center_user.cenid = freshleads.Cent_id   AND freshleads.Reference='".$_REQUEST['ref']."'");
if(isset($_REQUEST['ref']))
{
	
	if( count($orderDetails) > 0 )
	{		
		
		if(isset($_POST['Change']))
		{
			$_SESSION['message'] = array();
			$_SESSION['errmessage'] = array();
			
			if($_POST['strStatus']=="")
			array_push($_SESSION['errmessage'],"Please Select Status.");
			
			if($_POST['strComments']=="")
			array_push($_SESSION['errmessage'],"Please Fill Comments.");
			if(count($_SESSION['errmessage']) == 0)
			{
				
				$updateInformation = array();
				
				
			//Start Adding History on order
			
			$sqli->table='freshleads';
			$updateInformation['Status']		=	$_POST['strStatus'];			
			$updateInformation['LastNote']		=	$_POST['strComments'];			
			$sqli									->	autocommit(FALSE);
			$fields 									= 	array_keys($updateInformation);
			$values										=	array_values($updateInformation);
			$where=array('Reference'=>$_REQUEST['ref']);	
			$update_result= $sqli->Update_data($where,$values,$fields);
			$sqli->table='lead_history';
			$insertInformation 								=   array();
			$insertInformation['lead_id']					=	$_REQUEST['ref'];
			$insertInformation['lead_status_id']			=	$_POST['strStatus'];
			$insertInformation['notify']					=	1;
			$insertInformation['comment']					=	$_POST['strComments'];
			$insertInformation['date_added']				=	date("y-m-d H:i:s");			
			$fields 										= 	array_keys($insertInformation);
			$values											=	array_values($insertInformation);
			$historyRes										=	$sqli			->	Insert_data($fields,$values);
			
			if(!($historyRes>0))
			{
				$sqli->rollback();
				array_push($_SESSION['errmessage'],"An Error Occurred in Saving Data.");
			}
			else
			{
				
				$sqli									->	commit();
				array_push($_SESSION['message'],"Data Successfully Saved.");
				pageRedirection($pagename);
			}
			//End of Saving
			}
			pageRedirection($pagename);
		}
		
		///Check Submit End
	}
	else
	{
		echo "Invalid Order ID Found.";	
		exit;
	}
	
}
else
{
		echo "Invalid Request found.";	
		exit;
}		


			

?>
<table width="600" border="1" align="center">
<?php  foreach($_SESSION['message'] as $msg){ ?>
       <tr>
    <td> <div class="valid_box">
        <?php echo $msg; ?>
     </div></td></tr>
     <?php } ?>
     <?php  foreach($_SESSION['errmessage'] as $msg){ ?>
    <tr>
    <td>    <div class="error_box">
        <?php echo $msg; ?>
     </div></td></tr>
     <?php } ?>
  <tr>
    <td><form action="" method="post"><table width="600" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="2" align="center"><h2>Change Status</h2></td>
    </tr>
  <tr>
    <td style="padding-left: 10px;">Order Id</td> <td>:</td>
    <td ><input type="hidden" name="ref" value="<?php echo $_REQUEST['ref']; ?>" /><?php echo $_REQUEST['ref']; ?></td>
  </tr>
  <tr>
    <td style="padding-left: 10px;"> Current Status</td> <td>:</td>
    <td><?php echo $orderDetails[0]['dispname']; ?></td>
  </tr>
  <tr>
    <td style="padding-left: 10px;">New Status *</td> <td>:</td>
    <td><label for="strStatus"></label>
      <select name="strStatus" id="strStatus">
      <option value="">--Select--</option>	
      <?php foreach($statuscodes as $status){ ?><option value="<?php echo $status['dispid']; ?>"><?php echo $status['dispname']; ?></option><?php } ?>
      </select></td>
  </tr>
  <tr>
    <td style="padding-left: 10px;" >Comments *</td> <td>:</td>
    <td ><textarea name="strComments" id="strComments" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
   <td>&nbsp;</td>
    <td style="padding-left: 18px;"><input name="Change" type="submit" value="Change" /></td>
  
  </tr>
    </table></form>
</td>
  </tr>
  <tr>
    <td><form action="" method="post"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></form></td>
  </tr>
  <tr>
    <td><h2> Status History</h2></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Status</td>
        <td>Date</td>
        <td>Comments</td>
      </tr>
      <?php
	  $statushistory		=		$sqli->get_selectData("SELECT
*
FROM
lead_history
Inner Join  disposition ON disposition.dispid = lead_history.lead_status_id
WHERE
lead_history.lead_id = '".$orderDetails[0]['Reference']."'");
	
	foreach($statushistory as $hist) { 
	   ?>
      <tr>
        <td><?php echo $hist['dispname']; ?></td>
        <td><?php echo $hist['date_added']; ?></td>
        <td><?php echo $hist['comment']; ?></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
</table>

<?php $_SESSION['message'] = array();
			$_SESSION['errmessage'] = array(); ?>