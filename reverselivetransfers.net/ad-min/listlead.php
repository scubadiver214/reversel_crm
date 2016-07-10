<?php 
$pagename = "listlead.php";
include("_session.php"); 
include("_dataAccess.php");
require_once 'phpExcel/Classes/PHPExcel.php';
					// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
if(isset($_REQUEST['action'])){
    if($_REQUEST['action']=='delete')
    {
        $sqli->table='freshleads';
	    $where['Reference']=$_REQUEST['refID'];
	    $res = $sqli->Delete_data($where); 
        array_push($_SESSION['message'],"Lead#".$_REQUEST['refID']." Successfully Deleted.");
        pageRedirection("listlead.php");
    }
}
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
			 $strcond = " AND freshleads.Reference = '".$_REQUEST['str_leadid']. "' ";
		}
		else
		{
			$strcond = "";
			
			if($_REQUEST['str_firstName']!="")
			{
				$strcond.=" AND freshleads.FirstName LIKE '%".$_REQUEST['str_firstName']."%'";
			}
			if($_REQUEST['str_lastName']!="")
			{
				$strcond.=" AND freshleads.LastName LIKE '%".$_REQUEST['str_lastName']."%'";
			}
			if($_REQUEST['str_phone']!="")
			{
					$strcond.=" AND freshleads.Telephone1 LIKE '%".$_REQUEST['str_phone']."%'";
			}
			
			if($_REQUEST['dd_client']!="")
			{
					$strcond.=" AND freshleads.Buyer = '".$_REQUEST['dd_client']. "' ";
			}
			if($_REQUEST['dd_status']!="")
			{
					$strcond.=" AND freshleads.Status = '".$_REQUEST['dd_status']. "' ";
			}
			if($_REQUEST['dd_camp']!="")
			{
					$strcond.=" AND freshleads.campaignid = '".$_REQUEST['dd_camp']. "' ";
			}
			if($_REQUEST['dd_center']!="")
			{
					$strcond.=" AND freshleads.Cent_id = '".$_REQUEST['dd_center']. "' ";
			}
			if($_REQUEST['dd_agent']!="")
			{
					$strcond.=" AND freshleads.User = '".$_REQUEST['dd_agent']. "' ";
			}
			if($_REQUEST['dd_stateName']!="")
			{
					$strcond.=" AND freshleads.stateName LIKE '%".$_REQUEST['dd_stateName']."%'";
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
    $dataString = array();
    for($l=1;$l<=50;$l++){ array_push($dataString,"campaigns.Type$l as Ques$l,freshleads.Data$l as Ans$l"); }
    if(($_REQUEST['Search']=="Download"))
    {
      
	   $qryString = 'SELECT freshleads.Reference as LeadID ,campaigns.cmp_name AS Campaign, concat_ws(" ",freshleads.Title,freshleads.FirstName,freshleads.MiddleNames,freshleads.LastName) as Senior1,concat_ws(" ",freshleads.Title2,freshleads.FirstName2,freshleads.MiddleNames,freshleads.LastName2) as Senior2,freshleads.Email,freshleads.telephone1,freshleads.telephone2,'.implode(",",$dataString).',center_user.cen_comp AS Center,client_user.clt_comp AS Client ,concat_ws(" ",agent_user.ag_fname,agent_user.ag_lname) AS Agent,disposition.dispname AS Status,freshleads.TransferDateTime AS Transferdate,freshleads.transfer_to AS `Transfer To` FROM agent_user ,center_user ,campaigns ,client_user ,disposition,freshleads WHERE freshleads.Status = disposition.dispid AND agent_user.agid = freshleads.User AND  client_user.cltid = freshleads.Buyer AND campaigns.cmp_id = freshleads.campaignid AND center_user.cenid = freshleads.Cent_id '.$strcond.' ORDER BY LeadID DESC LIMIT 0,2000';
		$objPHPExcel->getProperties()->setCreator("Lead Reporter")
							 ->setLastModifiedBy("Lead Reporter")
							 ->setTitle("Report")
							 ->setSubject("Report")
							 ->setDescription("Report")
							 ->setKeywords("Report")
							 ->setCategory("Report");
       $count = 1;
		$qryDownload = $sqli->get_selectData($qryString);
			$i = 'A' ;
			foreach($qryDownload[0] as $key=>$prn){
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($i.$count,$key );
			$i++;
			}
			$count++;
		
		foreach ($qryDownload as $dwnld)
		{
			$i = 'A' ;
			foreach($dwnld as $prn){
				$objPHPExcel->setActiveSheetIndex(0)			
            ->setCellValue($i.$count,$prn );
			$i++;
			}
			
			$count++;
		}
		
$objPHPExcel->getActiveSheet()->setTitle('Orders');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client's web browser (Excel2007)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Pick-Report-as-on-'.date("Y-m-d H-i-s").'.csv"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
$objWriter->save('php://output');
exit;
    }
    else
    { 
   	$qryString = "SELECT agent_user.ag_fname,agent_user.ag_lname,client_user.clt_alias,client_user.clt_comp,campaigns.cmp_name,center_user.cen_comp,disposition.dispname,freshleads.Reference,freshleads.ReceivedDateTime,freshleads.Title,freshleads.FirstName,freshleads.MiddleNames,freshleads.LastName,freshleads.Telephone1,freshleads.Telephone2,freshleads.Mobile,freshleads.Email,freshleads.Address,freshleads.Address2,freshleads.Address3,freshleads.TownCity,freshleads.stateName,freshleads.Postcode,freshleads.Data1,freshleads.Data2,freshleads.Data3,freshleads.Data4,freshleads.Data5,freshleads.Data6,freshleads.Data7,freshleads.Data8,freshleads.Data9,freshleads.Data10,freshleads.Data11,freshleads.Data12,freshleads.Data13,freshleads.Data14,freshleads.Data15,freshleads.Data16,freshleads.Data17,freshleads.Data18,freshleads.Data19,freshleads.Data20,freshleads.Data21,freshleads.Data22,freshleads.Data23,freshleads.Data24,freshleads.Data25,freshleads.Data26,freshleads.Data27,freshleads.Data28,freshleads.Data29,freshleads.Data30,freshleads.Data31,freshleads.Data32,freshleads.Data33,freshleads.Data34,freshleads.Data35,freshleads.Data36,freshleads.Data37,freshleads.Data38,freshleads.Data39,freshleads.Data40,freshleads.Data41,freshleads.Data42,freshleads.Data43,freshleads.Data44,freshleads.Data45,freshleads.Data46,freshleads.Data47,freshleads.Data48,freshleads.Data49,freshleads.Data50,freshleads.transfer_to,freshleads.comments,freshleads.TransferDateTime FROM agent_user ,center_user ,campaigns ,client_user ,disposition,freshleads WHERE freshleads.Status = disposition.dispid AND agent_user.agid = freshleads.User AND  client_user.cltid = freshleads.Buyer AND campaigns.cmp_id = freshleads.campaignid AND center_user.cenid = freshleads.Cent_id ".$strcond." ORDER BY freshleads.Reference DESC ";
    }

$statsqry = "SELECT dispname,count(freshleads.Reference) stats FROM freshleads ,disposition  WHERE freshleads.`Status` = disposition.dispid ".$strcond." GROUP By disposition.dispid";
$stats = $sqli->get_selectData($statsqry);	

$items_per_page=25;

if(isset($_REQUEST['items_per_page'])) $items_per_page = $_REQUEST['items_per_page'];else $items_per_page=5;
if(isset($_REQUEST['page'])) $pagen = $_REQUEST['page']-1;else $pagen=0; 
$pager = new SqlPager($sqli,$qryString,$pagename."?".$urlParameters,$items_per_page);	

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
      <input type="text" class="required textbox" name="str_leadid" <?php if($_REQUEST['str_leadid']!=""){ ?> value="<?php echo $_REQUEST['str_leadid']; ?>"  <?php } ?> id="str_leadid" c/></td>
       <td width="10%" align="right" valign="top">Agent:</td>
      <td width="40%" align="left" valign="top">
     <select name="dd_agent" id="dd_agent">
         <option value="" selected="selected">- Select -</option>
         <?php
	$strQueryag="select * from agent_user where 1";
	$dataag=$sqli->get_selectData($strQueryag); 
	
	 foreach($dataag as $key=>$valueag){?>
         <option <?php if($_REQUEST['dd_agent']==$valueag['agid']) echo "Selected"; ?> value="<?php echo $valueag['agid'];?>"> <?php echo $valueag['ag_fname']." ".$valueag['ag_lname'];?></option>
         <?php }?>
       </select>
      </td>      
    
    </tr>
    <tr>
    <td width="20%" align="right" valign="top">First Name :</td>
    <td width="30%" align="left" valign="top"><input type="text" class="required textbox" name="str_firstName" <?php if($_REQUEST['str_firstName']!=""){ ?> value="<?php echo $_REQUEST['str_firstName']; ?>"  <?php } ?> id="str_firstName"/></td>    
      <td width="10%" align="right" nowrap="nowrap">Last Name:</td>
      <td width="40%" align="left"><input type="text" class="required textbox" name="str_lastName" <?php if($_REQUEST['str_lastName']!=""){ ?> value="<?php echo $_REQUEST['str_lastName']; ?>"  <?php } ?> id="str_lastName"/></td>
     
    </tr>
     
    <tr>
      <td width="20%" align="right" nowrap="nowrap">Phone Number:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_phone" <?php if($_REQUEST['str_phone']!=""){ ?> value="<?php echo $_REQUEST['str_phone']; ?>"  <?php } ?> id="str_phone"/></td>
      <td width="10%" align="right" valign="top">Client:</td>
      <td width="40%" align="left" valign="top">
     <select name="dd_client" id="dd_client">
         <option value="" selected="selected">- Select -</option>
         <?php
	$strQuery1="select * from client_user where 1";
	$dataclt=$sqli->get_selectData($strQuery1); 
	
	 foreach($dataclt as $key=>$valueclt){?>
         <option <?php if($_REQUEST['dd_client']==$valueclt['cltid']) echo "Selected"; ?> value="<?php echo $valueclt['cltid'];?>"> <?php echo $valueclt['clt_comp'];?></option>
         <?php }?>
       </select>
      </td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap">Date From:</td>
      <td align="left"><input type="text" class="required textbox" name="str_date_from" <?php if($_REQUEST['str_date_from']!=""){ ?> value="<?php echo $_REQUEST['str_date_from']; ?>"  <?php } ?> id="strlast_edit_date_from"/></td>
      <td width="10%" align="right" valign="top">Date To:</td>
      <td width="40%" align="left" valign="top"><input type="text" class="required textbox" name="str_date_To" <?php if($_REQUEST['str_date_To']!=""){ ?> value="<?php echo $_REQUEST['str_date_To']; ?>"  <?php } ?> id="strlast_edit_date_to"/></td>
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
         <option <?php if($_REQUEST['dd_status']==$valuest['dispid']) echo "Selected"; ?> value="<?php echo $valuest['dispid'];?>"> <?php echo $valuest['dispname'];?></option>
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
         <option <?php if($_REQUEST['dd_camp']==$valuecamp['cmp_id']) echo "Selected"; ?> value="<?php echo $valuecamp['cmp_id'];?>"> <?php echo $valuecamp['cmp_name'];?></option>
         <?php }?>
       </select>
       </td>
    </tr>
     <tr>
       <td width="20%" align="right" nowrap="nowrap">Center:</td>
       <td width="30%" align="left"><select name="dd_center" id="dd_center">
         <option value="" selected="selected">- Select -</option>
         <?php
	$strQuery2="select * from center_user where 1";
$datacenter=$sqli->get_selectData($strQuery2); 
	
	 foreach($datacenter as $key=>$valuecenter){?>
         <option <?php if($_REQUEST['dd_center']==$valuecenter['cenid']) echo "Selected" ?> value="<?php echo $valuecenter['cenid'];?>"> <?php echo $valuecenter['cen_comp'];?></option>
         <?php }?>
       </select></td>
       <td width="10%" align="right" valign="top">State:</td>
       <td width="40%" align="left" valign="top"><select name="dd_stateName" id="dd_stateName">
         <option value="" selected="selected">- Select -</option>
         <?php
	$strQuery14="select * from zone where country_id=223";
$datastate=$sqli->get_selectData($strQuery14); 
	
	 foreach($datastate as $key=>$valuestate){?>
         <option <?php if($_REQUEST['dd_stateName']==$valuestate['zone_id']) echo "Selected" ?> value="<?php echo $valuestate['zone_id'];?>"> <?php echo $valuestate['name'];?></option>
         <?php }?>
       </select></td>
       </tr>
     <tr>
       <td align="right" nowrap="nowrap">&nbsp;</td>
       <td align="left">&nbsp;</td>
       <td width="10%" align="right" valign="top">&nbsp;</td>
       <td width="40%" align="left" valign="top">&nbsp;</td>
     </tr>
     <tr>
       <td align="right" nowrap="nowrap">&nbsp;</td>
       <td align="right"><input type="submit" name="Search" id="Search" value="Search" style="padding: 4px;background: #7ECE5A; text-decoration: none; color: #fff;"/></td>
      <td width="10%" align="right">
        <input type="submit" name="Search" id="Search" value="Download" style="padding: 4px;background: #468A27; text-decoration: none; color: #fff;"/>
       </td> 
       <td width="40%" align="left" valign="top"><input type="submit" name="Reset" id="Search" value="Reset" /></td>
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
    <td  align="center"><?php echo $stat['dispname']; ?></td>
    <td align="center"><?php echo $stat['stats']; ?></td>
  </tr>
   <?php }  ?>  
</table>

    </fieldset>
    </td>
 	 </tr>
     </table>
     </fieldset><br> <br></div>
     
     
     <!-- search end -->
        
         <table id="rounded-corner" summary="List of Forms">
    <thead>
    	<tr>
        	<th align="left" nowrap="nowrap" class="rounded-company" scope="col"></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Sr.</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Lead ID</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Lead Type</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Name </strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Contact No.</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Center</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Client</strong></th>
             <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Agent</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Transfer Date</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Status</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Edit</strong></th>
		    <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>View</strong></th>
            <th align="left" nowrap="nowrap" class="rounded" scope="col"><strong>Delete</strong></th>
           </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="17" class="rounded-foot-left">
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
            <td><?php echo $row['cen_comp']; ?></td>
            <td><?php echo $row['clt_comp']; ?></td>
            
             <td><?php echo $row['ag_fname']." ". $row['ag_lname']; ?></td>
             
            <td><?php echo date("m-d-Y", strtotime($row['TransferDateTime'])) ;?></td>
            <td><a  id="datas<?php echo $row['Reference'];?>" href="#" onclick="parent.L('#datas<?php echo $row['Reference'];?>').colorbox({iframe:true, innerWidth:1200, innerHeight:500,href:'leadStatus.php?ref=<?php echo  $row['Reference'] ;?>'});"><?php echo $row['dispname']; ?></a></td>
            <td><a href="update_lead.php?refID=<?PHP echo $row['Reference']; ?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
                     
             <td> <a  id="data<?php echo $row['Reference'];?>" href="#" onclick="parent.L('#data<?php echo $row['Reference'];?>').colorbox({iframe:true, innerWidth:1200, innerHeight:500,href:'view_lead.php?refID=<?PHP echo $row['Reference']; ?>'});"><img src="images/search.png" alt="" title="" border="0" /></a></td>
          <td><a onclick="return confirm('Are you sure to delete this lead? Once deleted, it will not be rolled back.')" href="?action=delete&refID=<?PHP echo $row['Reference']; ?>"><img src="images/user_logout.png" alt="" title="" border="0" /></a></td>
        </tr>    
         <?php }  ?>
    </tbody>
</table>
      
      </div><!-- end of right content-->
                
  </div>   <!--end of center content -->               
  
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>   