<?php 
$page="lead.php";
include("_session.php"); 
include("_dataAccess.php");
$pagename = "lead.php"; 

			if($_POST['dd_dupeClient']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Select Client.");
			}
			if($_POST['dd_dupeCamp']=="")
			{
					array_push($_SESSION['errmessage'],"Please Select Campaign.");
			}
			if($_POST['str_Telephone1']=="" || !is_numeric($_POST['str_Telephone1']))
			{
					array_push($_SESSION['errmessage'],"Phone Number Must be Filled in correct format.");
			}
           
            
if(count($_SESSION['errmessage'])!=0)
	 pageRedirection("dupecheck.php");
	
	
if(isset($_POST['Continue']))
{
			
					
	if(count($_SESSION['errmessage'])==0)
	{	
			
			 $strQuery4 ="Select * from dupelist where  dupeClient ='".$_POST['dd_dupeClient']."' AND dupeCamp ='".$_POST['dd_dupeCamp']."' AND dupeNumber ='".$_POST['str_Telephone1']."'";
			 $data4=$sqli->get_selectData($strQuery4);
			 
			 $strQuery55 ="SELECT * FROM freshleads WHERE Buyer='".$_POST['dd_dupeClient']."' AND campaignid='".$_POST['dd_dupeCamp']."' AND( `Telephone1` LIKE  '".$_POST['str_Telephone1']."' OR `Telephone2` LIKE  '".$_POST['str_Telephone1']."')";	
			 $data44=$sqli->get_selectData($strQuery55);
             
             
             $strQuerynetleads ="SELECT leadorder.cmp_id,leadorder.clt_id,leadorder.order_id,leadorder.tpd,leadorder_detail.order_id,leadorder_detail.quantity,leadorder_detail.transfer_leads,leadorder_detail.cur_status,leadorder_detail.cur_status,order_det_id from leadorder_detail,leadorder where leadorder.cmp_id ='".$_POST['dd_dupeCamp']."' AND leadorder.clt_id ='".$_POST['dd_dupeClient']."' AND leadorder.order_id = leadorder_detail.order_id  AND leadorder_detail.quantity-leadorder_detail.transfer_leads >0 AND leadorder_detail.cur_status=0 order by order_det_id ASC LIMIT 0,1";	
			 $datanetleads=$sqli->get_selectData($strQuerynetleads);  
             $countnetleads = count($datanetleads);
             
            $nettpdlead = $datanetleads[0]['tpd'];
             
             
            $strQueryfreshlead ="SELECT * FROM freshleads where Buyer='".$_POST['dd_dupeClient']."' AND campaignid='".$_POST['dd_dupeCamp']."' AND freshleads.TransferDateTime='".date("Y-m-d")."'";	
			 $datafreshlead=$sqli->get_selectData($strQueryfreshlead);  
           $countfreshleads= count($datafreshlead);
            /*
                if($countfreshleads>=$nettpdlead)
                {
					  array_push($_SESSION['errmessage'],"Daily limit of transfer  for this client and campaign has been achieved, Please check order details.");
					  pageRedirection("listlead_order.php");
				 } 
             */
            //Daily limit for transfer  for this client and Campaign has been achieved, Please check order details.
			/*
                 if($countnetleads==0)
                 {
					  array_push($_SESSION['errmessage'],"Order for this client and Campaign has been completed.Please check order details");
					  pageRedirection("listlead_order.php");
				 }        
			 	*/ 
				 if(count($data4)==0&&count($data44)==0)
				 {
					 array_push($_SESSION['message'],"Please Complete the Add New Lead Form.");
				 }
				 else
				 {
					  array_push($_SESSION['errmessage'],"This lead is duplicate, please continue with other details.");
					  pageRedirection("dupecheck.php");
				 }
				
	}
		
}
	
			if(isset($_POST['submit']))
			{
				if($_POST['dd_Title']=="")
				{
						array_push($_SESSION['errmessage'],"Please Select Title.");
				}
				if($_POST['str_FirstName']=="" )
				{
						array_push($_SESSION['errmessage'],"First Name Must be Filled in correct Format.");
				}
				if($_POST['str_LastName']=="" )
				{
						array_push($_SESSION['errmessage'],"Last Name Must be Filled in correct Format.");
				}
				if($_POST['age']=="" )
				{
						array_push($_SESSION['errmessage'],"Age is required.");
				}
				if($_POST['str_Telephone1']=="" )
				{			
						array_push($_SESSION['errmessage'],"Phone Number Must be Filled in correct format.");
				}
				if($_POST['str_Email']!="" && !filter_var($_POST['str_Email'], FILTER_VALIDATE_EMAIL)) 
				{
						array_push($_SESSION['errmessage'],"Email is not required. But if provided, it must be entered in the correct Format.");
				}
				if($_POST['dd_stateName']=="")
				{
						array_push($_SESSION['errmessage'],"Please Select State.");
				}
			
			if(count($_SESSION['errmessage'])==0)
			{	
			 
             $strQuerynetleads ="SELECT * FROM leadorder,leadorder_detail where leadorder.cmp_id ='".$_POST['dd_dupeCamp']."' AND leadorder.clt_id ='".$_POST['dd_dupeClient']."' AND leadorder.order_id = leadorder_detail.order_id  AND leadorder_detail.quantity-leadorder_detail.transfer_leads >0 AND cur_status=0 order by order_det_id ASC LIMIT 0,1";	
			 $datanetleads=$sqli->get_selectData($strQuerynetleads);
            
	
			$sqli->table='freshleads';
			$insertInformation['User']				=	$_SESSION['sessAgentID'];
			$insertInformation['Cent_id']			=	$_SESSION['agent_center'];
			$insertInformation['Buyer']				=	$_POST['dd_dupeClient'];
			$insertInformation['IPAddress']			=	$_SERVER['REMOTE_ADDR'];
			$insertInformation['TransferDateTime']	=	date("y-m-d h:m:s");	
			$insertInformation['ReceivedDateTime']	=	date("y-m-d h:m:s");
            			
			$insertInformation['Title']	        =	$_POST['dd_Title'];
			$insertInformation['FirstName']	    =	$_POST['str_FirstName'];
			$insertInformation['LastName']	    =	$_POST['str_LastName'];
            
            $insertInformation['Title2']	    =	$_POST['dd_Title2'];
			$insertInformation['FirstName2']	=	$_POST['str_FirstName2'];
			$insertInformation['LastName2']	    =	$_POST['str_LastName2'];     

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

			$insertInformation['Telephone1']	=	$_POST['str_Telephone1'];
			$insertInformation['Telephone2']	=	$_POST['str_Telephone2'];		
			$insertInformation['Email']	    =	$_POST['str_Email'];
			$insertInformation['age']	    =	$_POST['age'];

			if($_POST['age2']!= ""){
				$insertInformation['age2']	    =	$_POST['age2'];
			}
			$insertInformation['Address']	=	$_POST['str_Address'];
			$insertInformation['TownCity']	=	$_POST['str_TownCity'];
			$insertInformation['Postcode']	=	$_POST['str_Postcode'];
			$insertInformation['stateName']	=	$_POST['dd_stateName'];			
			for($i=1;$i<=$_POST['cmpcount'];$i++){
			$insertInformation['Data'.$i]	  =	$_POST['str_Data'.$i];
			}
			$insertInformation['campaignid']  =	$_POST['dd_dupeCamp'];
			$insertInformation['transfer_to'] =	$_POST['str_transfer_to'];
			$insertInformation['comments'] =	$_POST['str_comments'];						
			$fields 								= 	array_keys($insertInformation);
			$values									=	array_values($insertInformation);
			$sqli									->	autocommit(FALSE);
			$insert_result 							=	$sqli			->	Insert_data($fields,$values);
            $insertedvalue							=	$sqli			->	insert_id;
		
        
        
            if($insert_result==1)
            {
             $sqli->table='leadorder_detail';
             $updateInformation['transfer_leads']   =	($datanetleads[0]['transfer_leads']+1);
             
             if($datanetleads[0]['quantity']==$updateInformation['transfer_leads'])
             {
               $updateInformation['cur_status']   =	1;  
             }
             $fields 						= 	array_keys($updateInformation);
			 $values						=	array_values($updateInformation);
			 $sqli							->	autocommit(FALSE);
			 $where=array('order_det_id'=>$datanetleads[0]['order_det_id']);	
			 $update_result= $sqli->Update_data($where,$values,$fields);
             }
            if($insert_result!=1)
			{
				$sqli->rollback();
				array_push($_SESSION['errmessage'],"An Error Occurred in Saving Data.");
			}
			else
			{
				
				$sqli									->	commit();
				array_push($_SESSION['message'],"Data Successfully Saved.");
				$_POST = array();	
			}
            header("Location: listlead.php");
			exit();	
	}
}

?>
<?php include("includes/header.php"); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.js"></script>
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
    <td><h2>Lead Form</h2></td>
    <td align="right">&nbsp;</td>
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
          <form action="" method="post" class="" id="leadForm" name="leadForm">
          
           <fieldset>
   	 <legend>List</legend>
   <?php include("formTemplate/leadformheader.php"); ?>   
 </fieldset>
          </form>
        </div>  
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>
   