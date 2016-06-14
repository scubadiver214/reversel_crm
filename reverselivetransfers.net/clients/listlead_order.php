<?php 
$pagename = "listlead_order.php";
include("_session.php"); 
include("_dataAccess.php");
$strQuery ="Select * from leadorder where clt_id='".$_SESSION['sessClientID']."'";
//$data=$sqli->get_selectData($strQuery);
//echo $data[0]['company_name']; 
$items_per_page=5;
if(isset($_REQUEST['items_per_page'])) $items_per_page = $_REQUEST['items_per_page'];else $items_per_page=5;
if(isset($_REQUEST['page'])) $pagen = $_REQUEST['page']-1;else $pagen=0; 
$pager = new SqlPager($sqli,$strQuery,"$pagename?$urlParameters",$items_per_page);	

$pager -> opt_texts['first']					= "<img src='images/first.gif' border='0' alt='first'/>";
$pager -> opt_texts['back'] 					= "<img src='images/previous.gif' border='0' alt='Previous'/>";
$pager -> opt_texts['next'] 					= "<img src='images/next.gif' border='0' alt='Next'/>";
$pager -> opt_texts['last']					    = "<img src='images/last.gif' border='0' alt='Last'/>";
$pager -> opt_texts['links_seperator'] 	        = "   ";
$pager -> opt_links_count 					    = 5;

 include("includes/header.php"); ?>
 <div class="main_content">
<div class="menu">
  <?php include("includes/menu.php"); ?>
</div> 
                    
                    
                    
                    
    <div class="center_content">
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
      <div class="right_content">            
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>Lead Order</h2></td>
    <td align="right">
    <?php 
    $strQuery2="select * from campaigns where campaigns.cmp_id NOT IN ( select cmp_id from leadorder where clt_id='".$_SESSION['sessClientID']."')  AND status=1";
	$datacmp=$sqli->get_selectData($strQuery2); 
    if(count($datacmp)>0){
    
    ?>
   
    <?php } ?>
    </td>
  </tr>
</table>
        
         <table id="rounded-corner" summary="List of Agent">
    <thead>
    	<tr>
        	<th nowrap="nowrap" class="rounded-company" scope="col"></th>        
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Sr. No.</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Client</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Campaign</strong></th>
			<th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Quantity</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Transfer</strong></th>
			<th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>TPD</strong></th>
			<th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Date (Y-M-D)</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Action </strong></th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="11" class="rounded-foot-left">
            <div class="pagination">
            <div class="left-pg"> 
			<?php
				$pager -> showGoToDropDown();  ?>
                </div>
                <div class="left-pg">
                 <?php				
				$pager -> showItemsPerPageChooser();				
				?>
                </div>
                <div class="right-pg"> 
        	 <?php	$pager -> showPager(1,1,1); ?>
             </div>
             </div>
            </td>
        	</tr>
    </tfoot>
    <tbody>
    	 <?php $i=1; foreach($pager->getPage() as $key=>$row) {	?>
      	<tr>
        	<td ><input type="checkbox" name="" /></td>        	
            <td ><?php echo ($pagen*$items_per_page+$i);$i++; ?></td>
            <td >
			<?php 
			$strQuery12="select * from client_user where cltid = '". $row['clt_id']."' ";
			$datac=$sqli->get_selectData($strQuery12);
			echo $datac[0]['clt_comp']; ?>
   		   </td>
            <td>
			<?php 
			$strQuery13="select * from campaigns where cmp_id = '".$row['cmp_id']."' ";
			$datacmp=$sqli->get_selectData($strQuery13);
			echo $datacmp[0]['cmp_name']; ?>
            
            </td>
             <td ><?php echo $row['quantity']; ?></td>
             <td ><?php 
              $strQuery18="SELECT SUM(transfer_leads) AS netlead FROM leadorder_detail WHERE order_id='".$row['order_id']."'";
                $dataNetQty=$sqli->get_selectData($strQuery18);
                $netBal=$dataNetQty[0]['netlead'];
                        
             
             echo $netBal; ?></td>
             <td ><?php echo $row['tpd']; ?></td>
             <td ><?php echo $row['mod_date']; ?></td>
             <td>
            
             <a href="view_lead_order_det.php?orderid=<?php echo $row['order_id']; ?>"><img src="images/view-docs.png" alt="" title="View Detail" border="0" /></a>
             
             </td>
           
          
            
          
        </tr>    
         <?php }  ?>
    </tbody>
</table>
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>
   