<?php 
$pagename = "listcenter_user.php";
include("_session.php"); 
include("_dataAccess.php");
if(isset($_GET['del_ID']))
{
	$strQuery = "Select * from freshleads where Cent_id=".$_GET['del_ID']."";
	$data=$sqli->get_selectData($strQuery);
    
    
	if(count($data)<=0)
	{
	$sqli->table='center_user';
	$where['cenid']=$_GET['del_ID'];
	$sqli->Delete_data($where);
	pageRedirection("listcenter_user.php");
	}
	else
	{
	?>
    <script>
    alert("Center is available in leads , Sorry to delete.");
	</script>
    
    <?php
	
	}
}

//////////////////////////////////////////////////////////

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
					$sqli->table='center_user';
					$updateInformation['cen_status']		=	$_REQUEST['stat'];
					
					$fields 										= 	array_keys($updateInformation);
					$values											=	array_values($updateInformation);
					$sqli											->	autocommit(FALSE);
					$where=array('cenid'=>$_REQUEST['updid']);	
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
						pageRedirection("listcenter_user.php");
						}
					}
	
	}

}



if(isset($_POST['Search']))
{

	if($_POST['str_cenid'] !="")
	{
		$strcond.=" AND center_user.cenid = '".$_POST['str_cenid']. "' ";
		
	}
	if($_POST['str_cen_username'] !="")
	{
		$strcond.=" AND center_user.cen_username LIKE '%".$_POST['str_cen_username']."%'";
	}
	if($_POST['str_firstName'] !="")
	{
		$strcond.=" AND center_user.cen_fname LIKE '%".$_POST['str_firstName']."%'";
	}
	
	if($_POST['str_lastName'] !="")
	{
		$strcond.=" AND center_user.cen_lname LIKE '%".$_POST['str_lastName']."%'";
		
	}
	if($_POST['str_email'] !="")
	{
		$strcond.=" AND center_user.cen_email = '".$_POST['str_email']. "' ";
	}
	if($_POST['str_mobile'] !="")
	{
		$strcond.=" AND center_user.cen_mobile = '".$_POST['str_mobile']. "' ";
		
		
	}
	

}
$strQuery = "Select * from center_user where 1".$strcond."";
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
    <td><h2>Affiliate List</h2></td>
    <td align="right"><a href="center_user.php"><img src="images/add-details.png" alt="" title="Add New" border="0" /></a></td>
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
   	 <legend>Search Affiliate User</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
 	  <!--part1-->
     <tr>
    <td>
     <fieldset>
    <legend>Affiliate User Details</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
	<tr>
	  <td align="right" nowrap="nowrap">ID :</td>
	  <td align="left"><input type="text" class="required textbox" name="str_cenid" size="30" id="str_cenid"/></td>
	  <td align="right" valign="top">User Name :</td>
	  <td align="left" valign="top"><input type="text" class="required textbox" name="str_cen_username" size="30" id="str_cen_username"/></td>
	  </tr>
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
        
         <table id="rounded-corner" summary="List of center" width="100%">
    <thead>
    	<tr>
        	<th nowrap="nowrap" class="rounded-company" scope="col"></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Sr. No.</strong></th>
            <!--<th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>User Name</strong></th>-->
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Center Name</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Name</strong></th>
			<th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Mobile</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Email</strong></th>
              <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Per</strong></th>
            <th align="center" nowrap="nowrap" class="rounded" scope="col"><strong>Edit</strong></th>
              <th align="center" nowrap="nowrap" class="rounded" scope="col"><strong>Pwd</strong></th>
            <th align="center" nowrap="nowrap" class="rounded" scope="col"><strong> Agent</strong></th>
           <th align="center" nowrap="nowrap" class="rounded" scope="col"><strong>Status</strong></th>
           <th nowrap="nowrap" class="rounded" scope="col"><strong>Delete</strong></th>
			
        </tr>
    </thead>
       
    <tbody>
    	 <?php $i=1; foreach($pager->getPage() as $key=>$row) {
						?>
      	<tr>
        	<td ><input type="checkbox" name="" /></td>
            <td ><?php echo ($pagen*$items_per_page+$i);$i++; ?></td>
            <!--<td><?php //echo $row['cen_username']; ?></td>-->
            <td><?php echo $row['cen_comp']; ?></td>
            <td><?php echo $row['cen_fname']." ".$row['cen_lname']; ?></td>
             <td><?php echo $row['cen_mobile']; ?></td>
               <td><?php echo $row['cen_email']; ?></td>
               <td align="center"><a href="updatecenter_per.php?cen_id=<?PHP echo $row['cenid']; ?>"><img src="images/phone.png" alt="" title="Phone Permission" border="0"/></a></td>
             
               <td align="center"><a href="updatecenter_user.php?centerID=<?PHP echo $row['cenid']; ?>"><img src="images/user_edit.png" alt="" title="Update Client" border="0"/></a></td>
              <td align="center"><a href="updatecenter_pwd.php?centerID=<?PHP echo $row['cenid']; ?>"><img src="images/user_edit.png" alt="" title="Update Password" border="0"/></a></td>
             
          
             <td align="center">
          
               <a href="listagent.php?centerID=<?PHP echo $row['cenid']; ?>"><img src="images/user_edit.png" alt="" title="List Agent" border="0" /></a>             </td>
          
            
             <td align="center">
               <?php
			    if ($row['cen_status'] == 1) 
			   {
				  ?> 
				<a href="?updid=<?php echo $row['cenid']; ?>&stat=0&action=StatusChange&key=<?php echo md5(date("ymdhis")) ?>"> <img src="images/green.png" alt="" title="" border="0" />  </a>
                 
                 <?php 
				 
			   }
			   else
			    {
				 ?> 
				<a href="?updid=<?php echo $row['cenid']; ?>&stat=1&action=StatusChange&key=<?php echo md5(date("ymdhis")) ?>"> <img src="images/red.png" alt="" title="" border="0" />  </a>
                 
                 <?php 
			   }
			   ?>
               
              </td>
            <td align="center"><a href="listcenter_user.php?del_ID=<?PHP echo $row['cenid']; ?>"><img src="images/user_logout.png" alt="" title="" border="0" onclick="return confirm('Confirm to delete Center..!')"/></a></td>
           
        </tr>    
         <?php }  ?>
    </tbody>
    
     <tfoot>
    	<tr>
        	<td colspan="13" class="rounded-foot-left">
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
</table>
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>
   