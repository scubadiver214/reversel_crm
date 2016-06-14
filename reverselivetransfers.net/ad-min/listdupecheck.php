<?php include("_session.php"); ?><?php
include("_dataAccess.php");
$strQuery1 ="Select * from dupelist where 1";
//$data=$sqli->get_selectData($strQuery1);

$items_per_page=5;
$pager = new SqlPager($sqli,$strQuery1,"$pagename?$urlParameters",$items_per_page);	

$pager -> opt_texts['first']					= "<img src='images/first.gif' border='0' alt='first'/>";
$pager -> opt_texts['back'] 					= "<img src='images/previous.gif' border='0' alt='Previous'/>";
$pager -> opt_texts['next'] 					= "<img src='images/next.gif' border='0' alt='Next'/>";
$pager -> opt_texts['last']					    = "<img src='images/last.gif' border='0' alt='Last'/>";
$pager -> opt_texts['links_seperator'] 	        = "   ";
$pager -> opt_links_count 					    = 5;


if(isset($_GET['del_id']))
{
	$sqli->table='dupelist';
	$where1['dupeID']=$_GET['del_id'];
    $data=$sqli->delete_data($where1);
	pageRedirection("listdupecheck.php");		
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
    <td><h2>Duplicate List</h2></td>
    <td align="right"><a href="dupecheck.php"><img src="images/add-details.png" alt="" title="Add New" border="0" /></a></td>
  </tr>
</table>



        
         <table id="rounded-corner" summary="List of Admin">
    <thead>
    	<tr>
        	<th nowrap="nowrap" class="rounded-company" scope="col"></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Sr. No.</strong></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Campaign Name</strong></th>
			<th nowrap="nowrap" class="rounded" scope="col"><strong>Client Name</strong></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Phone Number</strong></th>
         
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Action</strong></th>
           
			
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="7" class="rounded-foot-left">
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
         
             <td class="centedtd">
			 <?php 
				 $strQuery3 ="Select * from campaigns where cmp_id='".$row['dupeCamp']."'";
				$datacamp=$sqli->get_selectData($strQuery3);
				 echo $datacamp[0]['cmp_name']; ?></td>
               <td class="centedtd">
			   <?php
			    $strQuery2 ="Select * from client_user where cltid='".$row['dupeClient']."'";
				$datacenter=$sqli->get_selectData($strQuery2); 
				echo $datacenter[0]['clt_comp'];
				 ?></td>
           <td class="centedtd"><?php echo $row['dupeNumber']; ?></td>
             <td class="centedtd"><a href="listdupecheck.php?del_id=<?PHP echo $row['dupeID']; ?>"><img src="images/user_logout.png" alt="" title="" border="0" /></a></td>
          
        </tr>    
         <?php }  ?>
    </tbody>
</table>
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>
   