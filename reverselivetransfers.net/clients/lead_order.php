<?php
include("_session.php");
include("_dataAccess.php");
$pagename = "lead_order.php"; 
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
	
			$sqli->table='leadorder';
			$insertInformation['cmp_id']	=	$_POST['dd_Camp'];
			$insertInformation['quantity']	=	$_POST['str_quantity'];
			$insertInformation['tpd']	    =	$_POST['str_tpd'];
			$insertInformation['clt_id']	=	$_POST['str_clt_id'];
			$insertInformation['mod_date']	=	date("y-m-d h:m:s");	
			$fields 						= 	array_keys($insertInformation);
			$values							=	array_values($insertInformation);
			$sqli							->	autocommit(FALSE);
			$insert_result 					=	$sqli	->	Insert_data($fields,$values);
            $insertedvalue					=	$sqli	->	insert_id;
		
            /////////////////////////////////////////////////////////////////
            $sqli->table='leadorder_detail';
			$insertInfo['order_id']	=	$insertedvalue;
			$insertInfo['quantity']	=	$_POST['str_quantity'];
            $insertInfo['tpd']	    =	$_POST['str_tpd'];
			$insertInfo['price']    =	$_POST['str_price'];		
			$insertInfo['mod_date']	=	date("y-m-d h:m:s");	
			$fields1 				= 	array_keys($insertInfo);
			$values1				=	array_values($insertInfo);
			$sqli					->	autocommit(FALSE);
			$insert_result1 		=	$sqli	->	Insert_data($fields1,$values1);
			if($insert_result1!=1)
			{
				$sqli->rollback();
				array_push($_SESSION['errmessage'],"An Error Occurred in Saving Data.");
			}
			else
			{
				$insertedvalue1		=	$sqli	->	insert_id;
				$sqli				->	commit();
				array_push($_SESSION['message'],"Order Successfully Saved.");
                pageRedirection("listlead_order.php");
			}
				
	}
		
	
}
 include("includes/header.php"); 
 ?>
 
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
    <td><h2>Lead Order Form</h2></td>
    <td align="right"><a href="listlead_order.php"><img src="images/list-details.png" alt="" title="List" border="0" /></a></td>
  </tr>
</table>

        
        
        <div class="form">
          <form action="<?php echo $pagename; ?>" method="post" class="" id="orderForm" name="orderForm">
           <fieldset>
   	 <legend>Lead Order</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
 	  <!--part1-->
     <tr>
    <td>
    <fieldset>
   	 <legend>Order</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
	<input type="hidden" name="str_clt_id" value="<?php echo $_SESSION['sessClientID'];?>" />
    <tr>
   <td width="10%" align="right" valign="top">Campaign<span class="err">*</span>:</td>
   <td width="20%" align="left" valign="top"><select name="dd_Camp" id="dd_Camp">
     <option value="" selected="selected">- Select -</option>
     <?php
	$strQuery2="select * from campaigns where campaigns.cmp_id NOT IN ( select cmp_id from leadorder where clt_id='".$_SESSION['sessClientID']."')  AND status=1";
	$datacmp=$sqli->get_selectData($strQuery2); 
	
	 foreach($datacmp as $key=>$valuecmp){?>
     <option value="<?php echo $valuecmp['cmp_id'];?>"> <?php echo $valuecmp['cmp_name'];?></option>
     <?php }?>
   </select></td>
         
       <td width="5%" align="right" valign="top">Quantity<span class="err">*</span>:</td>
       <td width="10%" align="left" valign="top"><input type="text" class="required textbox" name="str_quantity" size="20" id="str_quantity"  style="width: 200px;"/></td>
       <td width="5%" align="right" nowrap="nowrap">Price:</td>
       <td width="10%" align="left"><input type="text" class="required textbox" name="str_price" size="20" id="str_price" style="width: 200px;"/></td>
       <td width="5%" align="right" nowrap="nowrap">TPD:</td>
       <td width="10%" align="left"><input type="text" class="required textbox" name="str_tpd" size="20" id="str_tpd" style="width: 200px;"/></td>
    
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
   