<!-- this is a admin update form-->
<?php include("_session.php"); 
include("_dataAccess.php"); 
$pharmacydetails		=		$sqli->get_selectData("SELECT * FROM pharmacy");
$pagename = "updateProduct.php"; 


if(isset($_POST['Update']))
{
			$error	=	0;
			$sqli->table='product';
			$updateInformation['sku']		    =	$_POST['strsku'];			
			$updateInformation['model']		    =	$_POST['strmodel'];
			$updateInformation['name']			=	$_POST['strname'];
			$updateInformation['description']	=	$_POST['strdescription'];
			$updateInformation['quantity']		=	$_POST['strquantity'];
			$updateInformation['price']			=	$_POST['strprice'];
			$updateInformation['sales_price']	=	$_POST['strsales_price'];
			$updateInformation['direc']			=	$_POST['strdirec'];
			$updateInformation['pharmacy_id']	=	$_POST['strSearchpharmacy'];			
			$fields 										= 	array_keys($updateInformation);
			$values											=	array_values($updateInformation);
			$sqli											->	autocommit(FALSE);
			$where=array('product_id'=>$_POST['productID']);	
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
						array_push($_SESSION['message'],"Data Successfully Saved.");
				}
}
		$data=$sqli->get_selectData("SELECT * FROM product WHERE product_id = '".$_REQUEST['productID']."'");	

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
    	  JQ("#updateadminForm").validate();
  });
  </script>             
 <div class="main_content">
                  <div class="menu">
                   <?php include("includes/menu.php"); ?>
                    </div> 
                    <div class="center_content">
      <div class="right_content">
        <h2> Update Product </h2>
        
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
          <form action="" method="post" class="" id="updateProduct">
		
           <fieldset>
    <legend>Product Update</legend><input type="hidden" name="productID" value="<?php echo ($_REQUEST['productID']); ?>" />
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="600">
    <tr>
	 
   	<tr><td>SKU <span class="err">*</span>:</td>
	<td><input type="text" class="required textbox" name="strsku" size="30"value="<?php echo $data[0]['sku']; ?>" /></td>
  </tr>
   <tr>
    <td>Model <span class="err">*</span>:</td>
    <td><input type="text" class="required textbox" id="strmodel" name="strmodel" value="<?php echo $data[0]['model']; ?>" /></td>
	<tr>
	  <td>Name</td>
	  <td><input type="text" class="required textbox" id="strname" name="strname" value="<?php echo $data[0]['name']; ?>" /></td>
	  </tr>
	<tr>
	  <td>Description</td>
	  <td><input type="text" class="required textbox" id="strdescription" name="strdescription" value="<?php echo $data[0]['description']; ?>" /></td>
	  </tr>
	<tr>
	  <td>Quantity</td>
	  <td><input type="text" class="required textbox" id="strquantity" name="strquantity" value="<?php echo $data[0]['quantity']; ?>" /></td>
	  </tr>
	<tr>
	<td>Price <span class="err">*</span>:</td>
	<td><input type="text" class="required textbox" name="strprice" id="strprice" size="30"value="<?php echo $data[0]['price']; ?>" /></td>
  </tr>
	<tr>
	  <td>Sales Price</td>
	  <td><input type="text" class="required textbox" id="strsales_price" name="strsales_price" value="<?php echo $data[0]['sales_price']; ?>" /></td>
	  </tr>
	
      <tr>
        <td>Direction</td>
        <td><input type="text" class="required textbox" id="strdirec" name="strdirec" value="<?php echo $data[0]['direc']; ?>" /></td>
      </tr>
      <tr>
        <td>Default Pharmacy</td>
        <td><select name="strSearchpharmacy" id="strSearchpharmacy">
      <option value="">--Select--</option>
      <?php foreach($pharmacydetails as $status){ ?><option value="<?php echo $status['pharmacyId']; ?>"  <?php if($data[0]['pharmacy_id']==$status['pharmacyId'])echo "selected"; ?>><?php echo $status['pharmacyName']; ?></option><?php } ?>
      </select></td>
      </tr>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="Update" id="Update" value="Update"/></td>
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
   