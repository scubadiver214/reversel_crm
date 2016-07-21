<?php 
$page="listlead_order.php";
include("_session.php");
include("_dataAccess.php");

 $strQueryPer ="Select * from tbl_center_permission where cent_id='".$_SESSION['sessCenterID']."' AND all_trn_ph=1";
 $dataPer=$sqli->get_selectData($strQueryPer);
 $ccdata = count($dataPer);
   	  
           
$strQuery = "SELECT *
  FROM leadorder LEFT JOIN client_user ON (leadorder.clt_id=client_user.cltid)
  WHERE client_user.clt_status = 1";

$items_per_page=5;
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
    <td><h2>Lead Order</h2></td>
    <td align="right">
   <!-- <a href="lead_order.php"><img src="images/add-details.png" alt="" title="Add New Order" border="0" /></a>-->
    </td>
  </tr>
</table>
        
         <table id="rounded-corner" summary="List of Agent">
    <thead>
    	<tr>
        	<th nowrap="nowrap" class="rounded-company" scope="col"></th>
        
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Sr.No.</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Client Name</strong></th>
            <?php if($ccdata>0){?>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Phone Transfer</strong></th>
            <?php } ?>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Campaign </strong></th>
			<th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Quantity</strong></th>
			<th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Transfer</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Balance</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Time Zone</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Operation Hours</strong></th>
             <th align="left" nowrap="nowrap" class="rounded" scope="col" style="width: 25%;"><strong>Operation States</strong></th>
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
        	
            <td><?php echo $i;$i++ ?></td>
            <td >
			<?php 
			$strQuery12="select * from client_user where cltid = '". $row['clt_id']."' ";
			$datac=$sqli->get_selectData($strQuery12);
            $timezone = $datac[0]['clt_timezone'];
			echo $datac[0]['clt_alias']; ?>
   		  </td>
           <?php if($ccdata>0){?>
          <td> <?php echo $datac[0]['clt_ph_transfer']; ?></td>
          <?php } ?>
            <td>
			<?php 
			$strQuery13="select * from campaigns where cmp_id = '".$row['cmp_id']."' AND status=1 ";
			$datacmp=$sqli->get_selectData($strQuery13);
			echo $datacmp[0]['cmp_name']; ?>
            
            </td>
             <td ><?php echo $row['quantity']; ?></td>
             <td ><?php 
              $strQuery18="SELECT SUM(transfer_leads) AS netlead FROM leadorder_detail WHERE order_id='".$row['order_id']."'";
                $dataNetQty=$sqli->get_selectData($strQuery18);
                $netBal=$dataNetQty[0]['netlead'];
             
             
             echo $netBal; ?></td>
              <td><?php echo ($row['quantity']-$netBal); ?></td>
                      <td>
                        <?php 
                        switch ($timezone) {
                            case 0:
                                echo "Not Selected";
                                break;
                            case 1:
                                echo "PST";
                                break;
                            case 2:
                                echo "MST";
                                break;
                            case 3:
                                echo "CST";
                                break;
                            case 4:
                                echo "EST";
                                break;
                            }
                        ?>
                      </td>
               <td><?php echo $datac[0]['clt_op_hours_from']." - ".$datac[0]['clt_op_hours_to']; ?></td>
               
                <td>
                
                <?php 
                $cs = explode(",",$datac[0]['clt_transfer_states']);
               if(count($cs)>0){
                foreach($cs as $zvalue){
                  
                $strQueryzone="select * from zone where zone_id = '".$zvalue."' AND status=1 ";
			    $datazone=$sqli->get_selectData($strQueryzone);                
                echo $datazone[0]['code'].", "; 
                } }
                ?>
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
   