<?php
$pagename = "updatelistlead_order.php"; 
include("_session.php");
include("_dataAccess.php");

if(isset($_POST['submit']))
{
		if($_POST['str_quantity']=="" || !is_numeric($_POST['str_quantity']))
			{
					array_push($_SESSION['errmessage'],"Please Fill Quantity in Numeric .");
			}
			if($_POST['dd_Camp']=="")
			{
					array_push($_SESSION['errmessage'],"Please Select Campaign.");
			}		
					
	if(count($_SESSION['errmessage'])==0)
	{	
	
			$sqli->table=' leadorder';
			$updateInformation['cmp_id']	=	$_POST['dd_Camp'];
			$updateInformation['quantity']	=	$_POST['str_quantity'];
			$updateInformation['tpd']	=	$_POST['str_tpd'];
			//$updateInformation['clt_id']	=	$_POST['str_clt_id'];
			$updateInformation['mod_date']		=	date("y-m-d h:m:s");			
						
			$fields 										= 	array_keys($updateInformation);
			$values											=	array_values($updateInformation);
			$sqli											->	autocommit(FALSE);
			$where=array('order_id'=>$_POST['str_ord_id']);	
			$update_result= $sqli->Update_data($where,$values,$fields);
				if($update_result == 0)
				{
					$error	= 1;
					$sqli->rollback();
					array_push($_SESSION['errmessage'],"An Error Occurred in Saving Data.");
				}	
				
				else
				{
						$sqli									->	commit();
						array_push($_SESSION['message'],"Data Successfully Updated.");
		
				}
				pageRedirection("listlead_order.php?orderID=".$_POST['str_clt_id']."");
				
	}
		
	
}


?>
<?php include("includes/header.php");

if(isset($_GET['orderID']))
{
$strQuery1 ="Select * from leadorder where order_id='".$_GET['orderID']."'";
$data=$sqli->get_selectData($strQuery1);
	
}  ?>
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
    <td><h2>Order Form</h2></td>
    <td align="right"><a href="listlead_order.php"><img src="images/list-details.png" alt="" title="List" border="0" /></a></td>
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
          <form action="<?php echo $pagename; ?>" method="post" class="" id="orderForm" name="orderForm">
           <fieldset>
   	 <legend>Update Order</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
 	  <!--part1-->
     <tr>
    <td>
    <fieldset>
   	 <legend>Order</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
    <input type="hidden" name="str_clt_id" value="<?php echo $data[0]['clt_id'];?>" />
	<input type="hidden" name="str_ord_id" value="<?php echo $data[0]['order_id'];?>" />
    <tr>
   <td width="10%" align="right" valign="top">Campaign<span class="err">*</span>:</td>
   <td width="23%" align="left" valign="top"><select name="dd_Camp" id="dd_Camp">
     <option value="" selected="selected">- Select -</option>
     <?php
	$strQuery2="select * from campaigns where status=1";
	$datacmp=$sqli->get_selectData($strQuery2); 
	
	 foreach($datacmp as $key=>$valuecmp){?>
     <option value="<?php echo $valuecmp['cmp_id'];?>"<?php if($data[0]['cmp_id']==$valuecmp['cmp_id']){echo "selected=\"selected\"";} ?>> <?php echo $valuecmp['cmp_name'];?></option>
     
   
       
     <?php }?>
   </select></td>
         
          <td width="8%" align="right" valign="top">Quantity<span class="err">*</span>:</td>
       <td width="25%" align="left" valign="top"><input type="text" class="required textbox" name="str_quantity" size="30" id="str_quantity" value="<?php echo $data[0]['quantity'];?>" /></td>
         
        <td width="9%" align="right" nowrap="nowrap">TPD:</td>
       <td width="25%" align="left"><input type="text" class="required textbox" name="str_tpd" size="30" id="str_tpd" value="<?php echo $data[0]['tpd'];?>" /></td>
     </tr>
     
    </table>
     </fieldset>
 
      <tr>
    <td align="center">&nbsp;<input type="submit" name="submit" id="submit" value="Submit"/></td>
 	 </tr>
 
     </table>
      </fieldset>

          </form>
        </div>  
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>
   