<?php 
$pagename = "listlead.php";
include("_session.php");
include("_dataAccess.php");


foreach($_REQUEST as $reqkey=>$reqval)
 {
  if(!($reqkey=="page" || $reqkey=="items_per_page" || $reqval=="")  )
  {
   if(!is_array($reqval))
   $urlParameters .= "&".$reqkey."=".$reqval;
   else
   {
    foreach($reqval as $as)
    $urlParameters .= "&".$reqkey."[]=".$as;
    
   }
  }
 }
 if(isset($_REQUEST['Reset'])){
    pageRedirection("listlead.php");
 }
if(isset($_REQUEST['Search']))
	{
		if($_REQUEST['str_leadid']!="")
		{
			 $strcond = " AND freshleads.Reference = '".$_REQUEST['str_leadid']. "'";
		}
		else
		{
			$strcond = "";
			
			if($_REQUEST['str_firstName']!="")
			{
				$strcond.=" AND freshleads.FirstName LIKE '%".$_REQUEST['str_firstName']."%' ";
			}
			if($_REQUEST['str_phone']!="")
			{
					$strcond.=" AND freshleads.Telephone1 = '".$_REQUEST['str_phone']. "' ";
			}
			
			if($_REQUEST['dd_client']!="")
			{
					$strcond.=" AND freshleads.Buyer = '".$_REQUEST['dd_client']. "' ";
			}
			if($_REQUEST['dd_status']!="")
			{
					$strcond.=" AND freshleads.Status = '".$_REQUEST['dd_status']. "'";
			}
			if($_REQUEST['dd_camp']!="")
			{
					$strcond.=" AND freshleads.campaignid = '".$_REQUEST['dd_camp']. "'";
			}
			if($_REQUEST['dd_center']!="")
			{
					$strcond.=" AND freshleads.Cent_id = '".$_REQUEST['dd_center']. "'";
			}
			if($_REQUEST['dd_stateName']!="")
			{
					$strcond.=" AND freshleads.stateName LIKE '%".$_REQUEST['dd_stateName']."%' ";
			}
			if(($_REQUEST['str_date_from']!="")&&($_REQUEST['str_date_To']!=""))
			{
					$datefrom = explode("-",$_REQUEST['str_date_from']);
					$datef=$datefrom[2]."-".$datefrom[0]."-".$datefrom[1];
					
					$dateto = explode("-",$_REQUEST['str_date_To']);
					$datet=$dateto[2]."-".$dateto[0]."-".$dateto[1];
					
					$strcond.=" AND date(freshleads.TransferDateTime) >= '".$datef."'";
					$strcond.=" AND date(freshleads.TransferDateTime) <= '".$datet."'";
			}
			
		}
	}
	$qryString = "SELECT agent_user.ag_fname,agent_user.ag_lname,client_user.clt_alias,client_user.clt_comp,campaigns.cmp_name,center_user.cen_comp,disposition.dispname,freshleads.Reference,freshleads.ReceivedDateTime,freshleads.Title,freshleads.FirstName,freshleads.MiddleNames,freshleads.LastName,freshleads.Telephone1,freshleads.Telephone2,freshleads.Mobile,freshleads.Email,freshleads.Address,freshleads.Address2,freshleads.Address3,freshleads.TownCity,freshleads.stateName,freshleads.Postcode,freshleads.Data1,freshleads.Data2,freshleads.Data3,freshleads.Data4,freshleads.Data5,freshleads.Data6,freshleads.Data7,freshleads.Data8,freshleads.Data9,freshleads.Data10,freshleads.Data11,freshleads.Data12,freshleads.Data13,freshleads.Data14,freshleads.Data15,freshleads.Data16,freshleads.Data17,freshleads.Data18,freshleads.Data19,freshleads.Data20,freshleads.Data21,freshleads.Data22,freshleads.Data23,freshleads.Data24,freshleads.Data25,freshleads.Data26,freshleads.Data27,freshleads.Data28,freshleads.Data29,freshleads.Data30,freshleads.Data31,freshleads.Data32,freshleads.Data33,freshleads.Data34,freshleads.Data35,freshleads.Data36,freshleads.Data37,freshleads.Data38,freshleads.Data39,freshleads.Data40,freshleads.Data41,freshleads.Data42,freshleads.Data43,freshleads.Data44,freshleads.Data45,freshleads.Data46,freshleads.Data47,freshleads.Data48,freshleads.Data49,freshleads.Data50,freshleads.transfer_to,freshleads.comments,freshleads.TransferDateTime FROM agent_user ,center_user ,campaigns ,client_user ,disposition,freshleads WHERE freshleads.Status = disposition.dispid AND agent_user.agid = freshleads.User AND  client_user.cltid = freshleads.Buyer AND campaigns.cmp_id = freshleads.campaignid AND center_user.cenid = freshleads.Cent_id ".$strcond." AND freshleads.Buyer = client_user.cltid ORDER BY freshleads.Reference DESC ";

	
$statsqry = "SELECT dispname,count(freshleads.Reference) stats,freshleads.Status as status FROM freshleads ,disposition  WHERE freshleads.`Status` = disposition.dispid GROUP By disposition.dispid";

$stats = $sqli->get_selectData($statsqry);
$items_per_page=5;
if(isset($_REQUEST['items_per_page'])) $items_per_page = $_REQUEST['items_per_page'];else $items_per_page=5;
if(isset($_REQUEST['page'])) $pagen = $_REQUEST['page']-1;else $pagen=0; 
$pager = new SqlPager($sqli,$qryString,"$pagename?$urlParameters",$items_per_page);	

$pager -> opt_texts['first']					= "<img src='images/first.gif' border='0' alt='first'/>";
$pager -> opt_texts['back'] 					= "<img src='images/previous.gif' border='0' alt='Previous'/>";
$pager -> opt_texts['next'] 					= "<img src='images/next.gif' border='0' alt='Next'/>";
$pager -> opt_texts['last']					    = "<img src='images/last.gif' border='0' alt='Last'/>";
$pager -> opt_texts['links_seperator'] 	        = "   ";
$pager -> opt_links_count 					    = 5;

?>
<?php include("includes/header.php"); ?>
<link rel="stylesheet" href="colorbox/colorbox.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script src="colorbox/js/jquery.colorbox.js"></script>
        <script type="text/javascript" charset="utf-8">
	var L = jQuery.noConflict();
		</script>
 <div class="main_content">
<div class="menu">
  <?php include("includes/menu.php"); ?>
</div> 
                    
                    
                    
                    
    <div class="center_content">
      <div class="right_content">            
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>List Leads</h2></td>
    <td align="right"><!--<a href="leads.php"><img src="images/add-details.png" alt="" title="Add New" border="0" /></a>-->
</td>
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
         
           <fieldset>
   	 <legend>Search Lead</legend>
      <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
 	  <!--part1-->
     <tr>
    <td>
     <form action="" method="post" class="" id="leads" name="leads" style="display:inline-block;">
     <fieldset style="width:98%; display:inline-block;">
    <legend>Lead Details</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
	<tr>
    <td width="20%" align="right" nowrap="nowrap">Lead ID:</td>
    <td width="30%" align="left">
      <input type="text" class="required textbox" name="str_leadid"  id="str_leadid" c/></td>
    <td width="10%" align="right" valign="top">First Name:</td>
    <td width="40%" align="left" valign="top"><input type="text" class="required textbox" name="str_firstName"  id="str_firstName"/></td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap">Phone Number:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_phone"  id="str_phone"/></td>
      <td width="10%" align="right" valign="top">Client:</td>
      <td width="40%" align="left" valign="top">
     <select name="dd_client" id="dd_client">
         <option value="" selected="selected">- Select -</option>
         <?php
	$strQuery1="select * from client_user where 1";
	$dataclt=$sqli->get_selectData($strQuery1); 
	
	 foreach($dataclt as $key=>$valueclt){?>
         <option value="<?php echo $valueclt['cltid'];?>"> <?php echo $valueclt['clt_comp'];?></option>
         <?php }?>
       </select>
      </td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap">Date From:</td>
      <td align="left"><input type="text" class="required textbox" name="str_date_from"  id="strlast_edit_date_from"/></td>
      <td width="10%" align="right" valign="top">Date To:</td>
      <td width="40%" align="left" valign="top"><input type="text" class="required textbox" name="str_date_To"  id="strlast_edit_date_to"/></td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"> Status:</td>
      <td width="30%" align="left">
     <select name="dd_status" id="dd_status">
       <option value="">- Select -</option>
        <?php
		$strQuery5="select * from disposition where 1";
		$datast=$sqli->get_selectData($strQuery5); 
		 foreach($datast as $key=>$valuest){?>
         <option value="<?php echo $valuest['dispid'];?>"> <?php echo $valuest['dispname'];?></option>
         <?php }?>
       </select>
      </td>
      <td width="10%" align="right" valign="top">Campaign:</td>
      <td width="40%" align="left" valign="top">
      <select name="dd_camp" id="dd_camp">
         <option value="" selected="selected">- Select -</option>
         <?php
	$strQuery3="select * from campaigns where status=1";
$datacamp=$sqli->get_selectData($strQuery3); 
	
	 foreach($datacamp as $key=>$valuecamp){?>
         <option value="<?php echo $valuecamp['cmp_id'];?>"> <?php echo $valuecamp['cmp_name'];?></option>
         <?php }?>
       </select>
       </td>
    </tr>
     <tr>
       <td width="20%" align="right" nowrap="nowrap">State:</td>
       <td width="30%" align="left"><select name="dd_stateName" id="dd_stateName">
         <option value="" selected="selected">- Select -</option>
         <?php
	$strQuery14="select * from zone where country_id=223";
$datastate=$sqli->get_selectData($strQuery14); 
	
	 foreach($datastate as $key=>$valuestate){?>
         <option value="<?php echo $valuestate['zone_id'];?>"> <?php echo $valuestate['name'];?></option>
         <?php }?>
       </select></td>
       <td width="10%" align="right" valign="top">&nbsp;</td>
       <td width="40%" align="left" valign="top">&nbsp;</td>
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
       <td width="10%" align="right" valign="top"><input type="submit" name="Reset" id="Search" value="Reset" /></td>
       <td width="40%" align="left" valign="top">&nbsp;</td>
     </tr>
    </table>
     </fieldset>
  	</form>
    <fieldset style="width:14%; display:inline-block; float:right;'">
    <legend>Lead Status</legend> 
 
 <table width="100%" border="1" cellpadding="0" cellspacing="0" id="rounded-corner">
  <tr>
    <th >Status</th>
    <th>Count</th>
  </tr>
  <?php foreach($stats as $stat){ ?>
  <tr>
    <td  align="center"><a href="listlead.php?&dd_status=<?php echo $stat['status']; ?>&Search=Search"><?php echo $stat['dispname']; ?></a></td>
    <td align="center"><?php echo $stat['stats']; ?></td>
  </tr>
   <?php }  ?>  
</table>

    </fieldset>
    </td>
 	 </tr>
     </table>
     </fieldset><br><br></div>
     
     
     <!-- search end -->
        
         <table id="rounded-corner" summary="List of Forms">
    <thead>
    	<tr>
        	<th nowrap="nowrap" class="rounded-company" scope="col"></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Sr. No.</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Lead ID</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Lead Type</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Name </strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Contact No.</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Transfer Date</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Status</strong></th>
             <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Edit</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>View</strong></th>
           
			
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="14" class="rounded-foot-left">
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
             <td ><?php echo $row['Reference']; ?></td>
            <td><?php echo $row['cmp_name']; ?></td>
            <td><?php echo $row['Title']." . ".$row['FirstName']." ".$row['LastName']; ?></td>
            <td><?php echo $row['Telephone1']; ?></td>
            <td><?php echo date("m-d-Y", strtotime($row['TransferDateTime'])); ?></td>
          <td><a  id="datas<?php echo $row['Reference'];?>" href="#" onclick="parent.L('#datas<?php echo $row['Reference'];?>').colorbox({iframe:true, innerWidth:700, innerHeight:500,href:'leadStatus.php?ref=<?php echo  $row['Reference'] ;?>'});"><?php echo $row['dispname']; ?></a></td>
             <td><a href="update_lead.php?refID=<?PHP echo $row['Reference']; ?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td>
 <a  id="data<?php echo $row['Reference'];?>" href="#" onclick="parent.L('#data<?php echo $row['Reference'];?>').colorbox({iframe:true, innerWidth:1200, innerHeight:500,href:'view_lead.php?refID=<?PHP echo $row['Reference']; ?>'});"><img src="images/search.png" alt="" title="" border="0" /></a>            </td>
          
        </tr>    
         <?php }  ?>
    </tbody>
</table>
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>
   