<?php 
$pagename = "listcampaign.php";
include("_session.php"); 
include("_dataAccess.php");

if(isset($_REQUEST['delID']))
{
            $sqli->table='campaigns';	
            if($_REQUEST['cmpstatus']==1)
            {
                $updateInfo['status']   = 0;   
            }
            else
            {
                $updateInfo['status']   = 1;
            } 
			$fields	= 	array_keys($updateInfo);
			$values =	array_values($updateInfo);
			$sqli->	autocommit(FALSE);
            $where=array('cmp_id'=>$_REQUEST['delID']);		
            $update_result= $sqli->Update_data($where,$values,$fields);
            $sqli	->	commit();
			array_push($_SESSION['message'],"Campaigns Status Successfully Changed.");
			
  }  
          
if(isset($_POST['Search']))
{
	if($_POST['str_cmp_id'] !="")
	{
		$strcond.=" AND campaigns.cmp_id LIKE '%".$_POST['str_cmp_id']."%'";
	}
	if($_POST['str_cmp_name'] !="")
	{
		$strcond.=" AND campaigns.cmp_name LIKE '%".$_POST['str_cmp_name']."%'";		
	}
}
$strQuery = "Select * from campaigns where 1".$strcond."";
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
    <td><h2>Campaign List</h2></td>
    <td align="right"><a href="campaign.php"><img src="images/add-details.png" alt="" title="Add New" border="0" /></a></td>
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
   	 <legend>Search Campaign</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
 	  <!--part1-->
     <tr>
    <td>
     <fieldset>
    <legend>Campaign Details</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
	<tr>
    <td width="20%" align="right" nowrap="nowrap">Campaign ID:</td>
    <td width="30%" align="left"><input type="text" class="required textbox" name="str_cmp_id" size="30" id="str_cmp_id"/></td>
    <td width="10%" align="right" valign="top" nowrap="nowrap">Campaign Name:</td>
    <td width="40%" align="left" valign="top"><input type="text" class="required textbox" name="str_cmp_name" size="30" id="str_cmp_name"/></td>
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
        
         <table id="rounded-corner" summary="List of Admin">
    <thead>
    	<tr>
        	<th nowrap="nowrap" class="rounded-company" scope="col"></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Sr. No.</strong></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Campaign Name</strong></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Edit</strong></th>
              <th nowrap="nowrap" class="rounded" scope="col"><strong>Status</strong></th>
			<th nowrap="nowrap" class="rounded" scope="col"><strong>View</strong></th>
           
			
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="8" class="rounded-foot-left">
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
            <td ><?php echo ($pagen*$items_per_page+$i);$i++; ?></td>
            <td class="centedtd"><?php echo $row['cmp_name']."-".$row['status']; ?></td>
            <td class="centedtd">
            <a href="update_campaign.php?cmpID=<?PHP echo $row['cmp_id']; ?>"><img src="images/user_edit.png" alt="" title="Edit" border="0" /></a> 
            </td>
             <td class="centedtd">
            <a href="listcampaign.php?delID=<?PHP echo $row['cmp_id']; ?>&cmpstatus=<?PHP echo $row['status']; ?>">
            <?php if($row['status']==1){?>
            <img src="images/g.png" alt="" title="Active" border="0" /></a> 
            <?php }else { ?>
               <img src="images/r.png" alt="" title="Pending" border="0" /></a>   
                <?php } ?>            
            </td>            
            <td class="centedtd"><a href="view_campaign.php?cmpID=<?PHP echo $row['cmp_id']; ?>"><img src="images/user_edit.png" alt="" title="View" border="0" /></a></td>
          
        </tr>    
         <?php }  ?>
    </tbody>
</table>
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>
   