<?php 
$pagename = "listlead_order.php";
include("_session.php"); 
include("_dataAccess.php");
if(isset($_GET['orderID']))
{
if(isset($_POST['Search']))
{

	if($_POST['dd_camp'] !="")
	{
		$strcond.=" AND leadorder.cmp_id = '".$_POST['dd_camp']. "' AND clt_id='".$_GET['orderID']."'";
	}

}

$strQuery ="Select * from leadorder where clt_id='".$_GET['orderID']."' ".$strcond."";
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
}
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
    <td><h2>List Lead Order</h2></td>
   
    
     <td align="right"><a href="lead_order.php?clientID=<?PHP echo $_GET['orderID']; ?>"><img src="images/add-details.png" alt="" title="Add Order" border="0" /></a></td>
   
  </tr>
</table>
        
        
        <!-- search form -->

        <div class="form">
          <form action="" method="post" class="" id="leads" name="leads">
           <fieldset>
   	 <legend>Search Lead</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
 	  <!--part1-->
     <tr>
    <td>
     <fieldset>
    <legend>Lead Details</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
    <tr>
      <td width="20%" align="right" nowrap="nowrap">Campaign:</td>
      <td width="30%" align="left"><select name="dd_camp" id="dd_camp">
        <option value="" selected="selected">- Select -</option>
        <?php
	$strQuery3="select * from campaigns where status=1";
$datacamp=$sqli->get_selectData($strQuery3); 
	
	 foreach($datacamp as $key=>$valuecamp){?>
        <option value="<?php echo $valuecamp['cmp_id'];?>"> <?php echo $valuecamp['cmp_name'];?></option>
        <?php }?>
      </select></td>
      <td width="10%" align="right" valign="top">&nbsp;</td>
      <td width="40%" align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap">Date From:</td>
      <td align="left"><input type="text" class="required textbox" name="str_date_from" size="30" id="str_date_from"/></td>
      <td width="10%" align="right" valign="top">Date To:</td>
      <td width="40%" align="left" valign="top"><input type="text" class="required textbox" name="str_date_To" size="30" id="str_date_To"/></td>
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
        
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Sr. No.</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Client</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Campaign</strong></th>
			<th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Quantity</strong></th>
             <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Transfer</strong></th>
			<th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>TPD</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Edit</strong></th>
             <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Action</strong></th>
          
         
           
			
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
            <td><a href="updatelistlead_order.php?orderID=<?PHP echo $row['order_id']; ?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
           <td><a href="update_lead_order.php?orderid=<?php echo $row['order_id']; ?>"><img src="images/addorder.png" alt="" title="Update Quantity" border="0" /></a>
            <a href="view_lead_order_det.php?orderid=<?php echo $row['order_id']; ?>&clt=<?php echo $row['clt_id']; ?>"><img src="images/view-docs.png" alt="" title="View Detail" border="0" /></a>
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
   