<?php 
$pagename = "listagent.php";
include("_session.php"); 
include("_dataAccess.php");

///////////////////////////////////////////////////////////////////////////////////

if(isset($_GET['del_ID']))
{
	$strQuery = "Select * from freshleads where User=".$_GET['del_ID']."";
	$data=$sqli->get_selectData($strQuery);
	
	if(count($data)<=0)
	{
	$sqli->table='agent_user';
	$where['agid']=$_GET['del_ID'];
	
	$sqli->Delete_data($where);
	pageRedirection("listcenter_user.php");
	}
    else
    {
      array_push($_SESSION['errmessage'],"Can not delete this agent, This agent assosiated with leads.");  
    }
	
}

/////////////////////////////////////////////////////////////////////////////////

if(isset($_REQUEST['centerID'])== "")
{
pageRedirection("listcenter_user.php");	
}
else
{


if(isset($_REQUEST['stat'])&&isset($_REQUEST['updid'])&& isset($_REQUEST['action']) && isset($_REQUEST['key']))
{
	if($_REQUEST['stat'] == "" || $_REQUEST['action'] == ""|| $_REQUEST['updid'] == "" || $_REQUEST['key']== "")
	{
	array_push($_SESSION['errmessage'],"Invalid Request Found.");	
	}
	if(count($_SESSION['errmessage'])==0)
	{
		
					if($_REQUEST['action']=="StatusChange")
					{
					$error								=	0;
					$sqli->table='agent_user';
			
					$updateInformation['ag_status']		=	$_REQUEST['stat'];
					
					$fields 										= 	array_keys($updateInformation);
					$values											=	array_values($updateInformation);
					$sqli											->	autocommit(FALSE);
					$where=array('agid'=>$_REQUEST['updid']);	
					$update_result= $sqli->Update_data($where,$values,$fields);
						if($update_result == 0)
						{
						$error	= 1;
						$sqli->rollback();
						array_push($_SESSION['errmessage'],"An Error Occurred in Saving Status.");
						}	
				
						else
						{
						$sqli									->	commit();
						array_push($_SESSION['message'],"Status Successfully Saved.");
						pageRedirection("listagent.php?centerID=".$_REQUEST['centerID']);
						}
					}
	
	}

}

}


if(isset($_GET['centerID']))
{

	
$strQuery1 ="Select * from center_user where cenid='".$_GET['centerID']."'";
$datacenter=$sqli->get_selectData($strQuery1);

if(isset($_POST['Search']))
{

	if($_POST['str_firstName'] !="")
	{
		$strcond.=" AND agent_user.ag_fname LIKE '%".$_POST['str_firstName']."%' AND ag_center='".$_GET['centerID']."'";
	}
	if($_POST['str_lastName'] !="")
	{
		$strcond.=" AND agent_user.ag_lname LIKE '%".$_POST['str_lastName']."%' AND ag_center='".$_GET['centerID']."'";
		
	}
	if($_POST['str_email'] !="")
	{
		$strcond.=" AND agent_user.ag_email = '".$_POST['str_email']. "' AND ag_center='".$_GET['centerID']."'";
		
		
	}
	if($_POST['str_mobile'] !="")
	{
		$strcond.=" AND agent_user.ag_mobile = '".$_POST['str_mobile']. "' AND ag_center='".$_GET['centerID']."'";
		
		
	}
	

}
$strQuery ="Select * from agent_user where ag_center='".$_GET['centerID']."' ".$strcond."";
$items_per_page=5;
	

//echo $seluserdetails;
if(isset($_REQUEST['items_per_page'])) $items_per_page = $_REQUEST['items_per_page'];else $items_per_page=5;
if(isset($_REQUEST['page'])) $pagen = $_REQUEST['page']-1;else $pagen=0; 
$pager = new SqlPager($sqli,$strQuery,"$pagename?$urlParameters",$items_per_page);	

$pager -> opt_texts['first']					= "<img src='images/first.gif' border='0' alt='first'/>";
$pager -> opt_texts['back'] 					= "<img src='images/previous.gif' border='0' alt='Previous'/>";
$pager -> opt_texts['next'] 					= "<img src='images/next.gif' border='0' alt='Next'/>";
$pager -> opt_texts['last']					    = "<img src='images/last.gif' border='0' alt='Last'/>";
$pager -> opt_texts['links_seperator'] 	        = "   ";
$pager -> opt_links_count 					    = 5;

} 



?>
<?php include("includes/header.php"); ?>
 <div class="main_content">
<div class="menu">
  <?php include("includes/menu.php"); ?>
</div> 
                    
                    
                    
                    
    <div class="center_content">
      <div class="right_content">            
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>Affilate Agents of <?PHP echo $datacenter[0]['cen_comp']; ?></h2></td>
    <td align="right"><a href="agent_user.php?centerID=<?PHP echo $_GET['centerID']; ?>"><img src="images/add-details.png" alt="" title="Add New Agent" border="0" /></a></td>
  </tr>
</table>


<!-- search form -->

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
   	 <legend>Search Agent</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
 	  <!--part1-->
     <tr>
    <td>
     <fieldset>
    <legend>Agent Details</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
	<tr>
    <td width="20%" align="right" nowrap="nowrap">First Name:</td>
    <td width="30%" align="left"><input type="text" class="required textbox" name="str_firstName" size="30" id="str_firstName"/></td>
    <td width="10%" align="right" valign="top">Last Name:</td>
    <td width="40%" align="left" valign="top"><input type="text" class="required textbox" name="str_lastName" size="30" id="str_lastName"/></td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap">Email:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_email" size="30" id="str_email"/></td>
      <td width="10%" align="right" valign="top">Mobile:</td>
      <td width="40%" align="left" valign="top"><input type="text" class="required textbox" name="str_mobile" size="30" id="str_mobile"/></td>
    </tr>
     <tr>
       <td align="right" nowrap="nowrap">&nbsp;</td>
       <td align="left">&nbsp;</td>
       <td width="10%" align="right" valign="top">&nbsp;</td>
       <td width="40%" align="left" valign="top">&nbsp;</td>
     </tr>
     <tr>
       <td align="right" nowrap="nowrap">&nbsp;</td>
       <td align="right"><input type="submit" name="Search" id="Search" value="Search"/></td>
       <td width="10%" align="right" valign="top">&nbsp;</td>
       <td width="40%" align="left" valign="top">&nbsp;</td>
     </tr>
    </table>
     </fieldset>
  
    
    </td>
 	 </tr>
     </table>
     </fieldset></form></div>
        
         <table id="rounded-corner" summary="List of Agent">
    <thead>
    	<tr>
        	<th nowrap="nowrap" class="rounded-company" scope="col"></th>        
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Sr. No.</strong></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>User Name</strong></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Name</strong></th>
			<th nowrap="nowrap" class="rounded" scope="col"><strong>Mobile</strong></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Email</strong></th>
           <th nowrap="nowrap" class="rounded" scope="col"><strong>Edit</strong></th>
              <th nowrap="nowrap" class="rounded" scope="col"><strong>Edit Pwd</strong></th>
           <th nowrap="nowrap" class="rounded" scope="col"><strong>Status</strong></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Delete</strong></th> 
           
			
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="10" class="rounded-foot-left">
            <div class="pagination">
            <div class="left-pg"> 
			<?php
				$pager -> showGoToDropDown();  ?>
                </div
                ><div class="left-pg">
                 <?php
				
				$pager -> showItemsPerPageChooser();
				
				?>
                </div>
                <div class="right-pg">
                
        	
        	 <?php
			
			$pager -> showPager(1,1,1);  
			
			 ?>
             </div>
             </div>
          </td>
        	</tr>
    </tfoot>
    <tbody>
    	  <?php $i=1; foreach($pager->getPage() as $key=>$row) {
						?>
      	<tr>
        	<td ><input type="checkbox" name="" /></td>
        	
            <td class="centedtd"><?php echo $i;$i++ ?></td>
             <td class="centedtd"><?php echo $row['ag_username']; ?></td>
            <td class="centedtd"><?php echo $row['ag_fname']." ".$row['ag_lname']; ?></td>
             <td class="centedtd"><?php echo $row['ag_mobile']; ?></td>
               <td class="centedtd"><?php echo $row['ag_email']; ?></td>
              
           <td class="centedtd"><a href="updateAgent.php?agentID=<?PHP echo $row['agid']; ?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td> 
            
             <td class="centedtd"><a href="updateAgentPwd.php?agentID=<?PHP echo $row['agid']; ?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td> 
             <td class="centedtd">
           
               <?php
			    if ($row['ag_status'] == 1) 
			   {
				  ?> 
				<a href="?updid=<?php echo $row['agid']; ?>&stat=0&action=StatusChange&key=<?php echo md5(date("ymdhis")) ?>&centerID=<?php echo $_GET['centerID'] ?>"> <img src="images/green.png" alt="" title="" border="0" />  </a>
                 
                 <?php 
				 
			   }
			   else
			    {
				 ?> 
				<a href="?updid=<?php echo $row['agid']; ?>&stat=1&action=StatusChange&key=<?php echo md5(date("ymdhis")) ?>&centerID=<?php echo $_GET['centerID'] ?>"> <img src="images/red.png" alt="" title="" border="0" />  </a>
                 
                 <?php 
			   }
			   ?>
               
               </td>
               <td align="center"><a href="listagent.php?del_ID=<?PHP echo $row['agid']; ?>"><img src="images/user_logout.png" alt="" title="" border="0" onclick="return confirm('Confirm to delete Agent..!')"/></a></td>
           
          
        </tr>    
         <?php }  ?>
    </tbody>
</table>
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>
   