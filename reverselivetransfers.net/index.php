<?php
$page="index.php";
 include("_session.php");
include("_dataAccess.php");
include("includes/header.php");

if(isset($_REQUEST['Go']))
	{
		
		if(($_REQUEST['strlast_edit_date_from']!="")&&($_REQUEST['strlast_edit_date_to']!=""))
			{
					$datefrom = explode("-",$_REQUEST['strlast_edit_date_from']);
					//m-d-y==y-m-d
					$datef=$datefrom[2]."-".$datefrom[0]."-".$datefrom[1];
					
					$dateto = explode("-",$_REQUEST['strlast_edit_date_to']);
					$datet=$dateto[2]."-".$dateto[0]."-".$dateto[1];
					$defauldate1= $datef;
					$strcond.=" AND f.TransferDateTime >= '".$datef."'";
					$strcond.=" AND f.TransferDateTime <= '".$datet."'";
			}
	}
     else
    {   $defauldate= date("Y-m-1");
        $defauldate1= date("Y-m-d");       
        $strconddefault.=" AND f.TransferDateTime >= '".$defauldate."' AND f.TransferDateTime <= '".$defauldate1."'";
    }
    $statsqry = "SELECT d.dispid,count(f.`Reference`) stats FROM `freshleads` f,disposition d WHERE f.`Status` = d.dispid AND f.User=".$_SESSION['sessAgentID']." ".$strcond." ".$strconddefault." GROUP By d.dispid";
    $stats = $sqli->get_selectData($statsqry);
    
     ////////////////// FIRST ///////////////////////////      
    $stadte1 =  date('Y-m-1',strtotime("-1 Month"));
    $eddate2 =  date('Y-m-t',strtotime("-1 Month"));
    $strconddefault1.=" AND f.TransferDateTime >= '".$stadte1."' AND f.TransferDateTime <= '".$eddate2."'";
    
    $statsqry1 = "SELECT d.dispid,count(f.`Reference`) stats, f.TransferDateTime FROM `freshleads` f,disposition d WHERE f.`Status` = d.dispid AND f.User=".$_SESSION['sessAgentID']." ".$strconddefault1." GROUP By d.dispid";
    $stats1 = $sqli->get_selectData($statsqry1);
    
    /////////////////// SECOND ////////////////////////////
    $stadte11 =  date('Y-m-1',strtotime("-2 Month"));
    $eddate22 =  date('Y-m-t',strtotime("-2 Month"));
    $strconddefault2.=" AND f.TransferDateTime >= '".$stadte11."' AND f.TransferDateTime <= '".$eddate22."'";
    
    $statsqry2 = "SELECT d.dispid,count(f.`Reference`) stats, f.TransferDateTime FROM `freshleads` f,disposition d WHERE f.`Status` = d.dispid AND f.User=".$_SESSION['sessAgentID']." ".$strconddefault2." GROUP By d.dispid";
    $stats2 = $sqli->get_selectData($statsqry2);
    
    //////////////////////////////////////////////////////////
     $statsqryDisp = "SELECT * FROM disposition WHERE 1";
    $statsDisp = $sqli->get_selectData($statsqryDisp);
?>
    
    
<div class="main_content">
<div class="menu"><?php include("includes/menu.php");?> </div> 
<div class="center_content">
             <div class="right_content"><h2>Affiliate Agents Dashboard</h2>

<form action="" method="post"><table width="100%" height="" border="0" cellspacing="0" cellpadding="0" style="width: 90%; padding-left: 8%;">
  <tr>
    <td>From</td>
    <td><input type="text" class="textbox" name="strlast_edit_date_from" size="30" id="strlast_edit_date_from" maxlength="30"  value="<?php echo $_REQUEST['strlast_edit_date_from']; ?>"/></td>
    <td>to</td>
    <td><input type="text" class="textbox" name="strlast_edit_date_to" size="30" id="strlast_edit_date_to" maxlength="30"  value="<?php echo $_REQUEST['strlast_edit_date_to']; ?>"/><input name="Go" type="submit" value="Go" /></td>
  </tr>
</table></form>

 
<br><br>
<table style="width: 99%; padding-left: 2%;">
    <tr>
        <td>
            <!-----------------------Month 1 ------------------------------->
<fieldset style="width:80%; display:inline-block; float:right;'">
    <legend><strong><?php echo date('M-Y',strtotime($defauldate1))?></strong> </legend> 
        <table id="rounded-corner" summary="List of Admin" >
            <thead>            
                <tr>        
                    <th width="30%" align="center" nowrap="nowrap" class="rounded" scope="col"><strong> Status</strong></th>
                    <th align="center" nowrap="nowrap" class="rounded" scope="col"><strong>Count</strong></th>
                </tr>
            </thead>       
            <tbody>
            	<?php foreach($statsDisp as $Disp){   ?>
              	<tr>        	
                   <td width="30%" align="center" nowrap="nowrap"><?php echo $Disp['dispname']; ?></td>
                   <td align="center">
                   <?php
                   
                   $stat_cnt =0;
                    foreach($stats as $stat){
                      if($Disp['dispid']==$stat['dispid'])
                       {
                       $stat_cnt= $stat['stats']; 
                       }
                      
                  } 
                  
                  echo $stat_cnt;
                  ?>
                   </td> 
                </tr>    
                 <?php  } ?>
            </tbody>
        </table>
</fieldset>
        </td>
        <td>
        <!-----------------------Month 2 ------------------------------->
<fieldset style="width:80%; display:inline-block; float:right;'">
    <legend><strong><?php echo date('M-Y',strtotime($stadte1))?> </strong></legend> 
        <table id="rounded-corner" summary="List of Admin" >
            <thead>
            
                <tr>        
                    <th width="30%" align="center" nowrap="nowrap" class="rounded" scope="col"><strong> Status</strong></th>
                    <th align="center" nowrap="nowrap" class="rounded" scope="col"><strong>Count</strong></th>
                </tr>
            </thead>       
            <tbody>
            	<?php foreach($statsDisp as $Disp){   ?>
              	<tr>        	
                   <td width="30%" align="center" nowrap="nowrap"><?php echo $Disp['dispname']; ?></td>
                   <td align="center">
                   <?php 
                   $stat_cnt1=0;
                   foreach($stats1 as $stat1){
                      if($Disp['dispid']==$stat1['dispid'])
                       {
                       $stat_cnt1= $stat1['stats']; 
                       }
                      
                  } echo $stat_cnt1; ?>
                   </td> 
                </tr>    
                 <?php }  ?>
            </tbody>
        </table>
</fieldset>
        </td>
        <td>
        <!-----------------------Month 3 ------------------------------->
<fieldset style="width:80%; display:inline-block; float:right;'">
    <legend><strong><?php echo date('M-Y',strtotime($stadte11))?></strong></legend> 
        <table id="rounded-corner" summary="List of Admin" >
            <thead>
            
                <tr>        
                    <th width="30%" align="center" nowrap="nowrap" class="rounded" scope="col"><strong> Status</strong></th>
                    <th align="center" nowrap="nowrap" class="rounded" scope="col"><strong>Count</strong></th>
                </tr>
            </thead>       
            <tbody>
            	<?php foreach($statsDisp as $Disp){   ?>
              	<tr>        	
                   <td width="30%" align="center" nowrap="nowrap"><?php echo $Disp['dispname']; ?></td>
                   <td align="center">
                   <?php 
                   $stat_cnt2=0;
                   foreach($stats2 as $stat2){
                      if($Disp['dispid']==$stat2['dispid'])
                       {
                       $stat_cnt2= $stat2['stats']; 
                       }
                       
                  } echo $stat_cnt2;?>
                   </td> 
                </tr>    
                 <?php  } ?>
            </tbody>
        </table>
</fieldset>
        </td>    
    </tr>
</table>

</div> 
<div class="clear"></div></div></div>
<?php include("includes/footer.php");?>
   