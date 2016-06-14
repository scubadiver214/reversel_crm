<?php
$pagename = "update_lead_order.php"; 
include("_session.php");
include("_dataAccess.php");

if(isset($_GET['orderid']))
{
    $strQuery ="Select * from leadorder where order_id='".$_GET['orderid']."'";
    $data=$sqli->get_selectData($strQuery);
    $strQuery2="select * from campaigns where cmp_id='".$data[0]['cmp_id']."'";
	$datacmp=$sqli->get_selectData($strQuery2);    
}
if(isset($_POST['submit']))
{
            if($_POST['str_quantity']=="" || !is_numeric($_POST['str_quantity']))
			{
					array_push($_SESSION['errmessage'],"Please Fill Quantity in Numeric .");
			}			
					
	if(count($_SESSION['errmessage'])==0)
	{
	
			$sqli->table='leadorder';			
			$updateInformation['quantity']	=	($_POST['str_cur_quantity']+$_POST['str_quantity']);
            if($_POST['str_tpd']!=""){				
			$updateInformation['tpd']	    =	$_POST['str_tpd'];
            }				
			$updateInformation['mod_date']	=	date("y-m-d h:m:s");	
            $fields 						= 	array_keys($updateInformation);
			$values							=	array_values($updateInformation);
			$sqli							->	autocommit(FALSE);
			$where=array('order_id'=>$_POST['str_order_id']);	
			$update_result= $sqli->Update_data($where,$values,$fields);
			
            /////////////////////////////////////////////////////////////////
            $sqli->table='leadorder_detail';
			$insertInfo['order_id']	=	$_POST['str_order_id'];
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
				$insertedvalue1							=	$sqli			->	insert_id;
				$sqli									->	commit();
				array_push($_SESSION['message'],"Order Successfully Saved.");
                pageRedirection("listlead_order.php?orderID=".$_POST['str_clt_id']);
			}
				
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
    <td><h2>Update <?php echo $datacmp[0]['cmp_name']?> Lead Order </h2></td>
    <td align="right"><a href="index.php"><img src="images/list-details.png" alt="" title="Home" border="0" /></a></td>
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
   	 <legend>Update Order</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
	<input type="hidden" name="str_order_id" value="<?php echo $_GET['orderid'];?>" />
    	<input type="hidden" name="str_clt_id" value="<?php echo $data[0]['clt_id'];?>" />
    <tr>  
       <td width="10%" align="right" valign="top">Current Quantity<span class="err">*</span>:</td>
       <td width="10%" align="left" valign="top"><input type="text" class="required textbox" name="str_cur_quantity" size="20" id="str_quantity" readonly="readonly" value="<?php echo $data[0]['quantity']; ?>"  style="width: 150px;"/></td>
       <td width="10%" align="right" valign="top">New Quantity<span class="err">*</span>:</td>
       <td width="10%" align="left" valign="top"><input type="text" class="required textbox" name="str_quantity" size="20" id="str_quantity"  style="width: 150px;"/></td>
       <td width="10%" align="right" nowrap="nowrap">TPD:</td>
       <td width="10%" align="left"><input type="text" class="required textbox" name="str_tpd" size="20" id="str_tpd" style="width: 150px;"/></td>
       <td width="10%" align="right" nowrap="nowrap">Price:</td>
       <td width="10%" align="left"><input type="text" class="required textbox" name="str_price" size="20" id="str_price" style="width: 150px;"/></td>
      
     </tr>
     
    </table>
     </fieldset>
 
      <tr>
    <td align="center">&nbsp;<input type="submit" name="submit" id="submit" value="Update Order"/></td>
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
   