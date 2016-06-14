<?php 
include("_session.php"); 
include("_dataAccess.php");
$pagename = "dcn.php"; 

$strQuery1 ="Select * from  dnclist where 1";
$data=$sqli->get_selectData($strQuery1);

if(isset($_GET['del_id']))
{
	$sqli->table='dnclist';
	$where1['dncID']=$_GET['del_id'];
    $data=$sqli->delete_data($where1);
	pageRedirection("dnc.php");		
}


if(isset($_POST['submit']))
{
			if($_POST['str_dncNumber']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Select Number.");
			}
			
					
	if(count($_SESSION['errmessage'])==0)
	{	
	
			$sqli->table='dnclist';
			$insertInformation['dncNumber']	=	$_POST['str_dncNumber'];
			
						
			$fields 								= 	array_keys($insertInformation);
			$values									=	array_values($insertInformation);
			$sqli									->	autocommit(FALSE);
			$insert_result 							=	$sqli			->	Insert_data($fields,$values);
			if($insert_result!=1)
			{
				$sqli->rollback();
				array_push($_SESSION['errmessage'],"An Error Occurred in Saving Data.");
			}
			else
			{
				$insertedvalue							=	$sqli			->	insert_id;
				$sqli									->	commit();
				array_push($_SESSION['message'],"Data Successfully Saved.");
			}
			?>
					<script language="javascript">
						window.location.href = "dnc.php";
					</script>
		<?php
				
	}
		
	
}
if(isset($_POST['Check']))
{
			if($_POST['str_dncNumber']!="")
			 {
			 $strQuery4 ="Select * from dnclist where dncNumber ='".$_POST['str_dncNumber']."'";
			 $data4=$sqli->get_selectData($strQuery4);
			 
				 if(count($data4)=="")
				 {
					 array_push($_SESSION['message'],"Number is Not Duplicate.");
				 }
				 else
				  {
					  array_push($_SESSION['errmessage'],"Number is Duplicate.");
				 }
			 }
			 else
			 {
			array_push($_SESSION['errmessage'],"Please Select Number.");
			 }
	
}

?>
<?php include("includes/header.php"); ?>
<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
<script src="js/jquery.metadata.js" type="text/javascript"></script>
<style type="text/css">
label.error { float: left;
color: red;
padding-left: .5em; }
p { clear: both; }
.submit { margin-left: 12em; }
em { font-weight: bold; padding-right: 1em; vertical-align: top; }
.err{color:#F00; font-size:14px;}
</style>
  <script>
  var JQ = jQuery.noConflict();
  JQ.metadata.setType("attr", "validate");
JQ(document).ready(function() {
    	  JQ("#adminForm").validate();
  });
  </script>
        <div class="main_content">
                  <div class="menu">
                   <?php include("includes/menu.php"); ?>
                    </div> 
                    <div class="center_content">
      <div class="right_content">            
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>Form DNC</h2></td>
    <td align="right">&nbsp;</td>
  </tr>
</table>

        
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
          <form action="" method="post" class="" id="dupForm" name="dupForm">
      
    <fieldset>
   	 <legend>DNC Check</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
	
    <tr>
   
         
        <td width="20%" align="right" nowrap="nowrap">Number<span class="err">*</span>:</td>
       <td width="30%" align="left"><input type="text" class="required textbox" name="str_dncNumber" size="30" id="str_dncNumber"/></td>
       
        <tr>
    <td align="right">&nbsp; </td><td align="left"><input type="submit" name="Check" id="submit" value="Check"/>&nbsp;&nbsp;<input type="submit" name="submit" id="submit" value="Add"/></td>
 	 </tr>
     </tr>
     
    </table>
     </fieldset>
 

          </form>
        </div>  
        
        
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr><td>&nbsp;</td></tr>
 
</table>
       
        
         <table id="rounded-corner" summary="List of DNC">
    <thead>
    	<tr>
        	<th nowrap="nowrap" class="rounded-company" scope="col"></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>DNC Id</strong></th>
          
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Number</strong></th>
         
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Action</strong></th>
           
			
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="7" class="rounded-foot-left"><div class="pagination">
        	  <span class="disabled"><< prev</span><span class="current">1</span><a href="">101</a><a href="">next >></a>
      	  </div></td>
        	</tr>
    </tfoot>
    <tbody>
    	 <?php foreach($data as $key=>$row) {
						?>
      	<tr>
        	<td ><input type="checkbox" name="" /></td>
            <td class="centedtd"><?php echo $row['dncID']; ?></td>
         
           
           <td class="centedtd"><?php echo $row['dncNumber']; ?></td>
             <td class="centedtd"><a href="dnc.php?del_id=<?PHP echo $row['dncID']; ?>"><img src="images/user_logout.png" alt="" title="" border="0" /></a></td>
          
        </tr>    
         <?php }  ?>
    </tbody>
</table>               
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>
   