<?php 
include("_session.php");
include("_dataAccess.php");
$qryString = "SELECT * from product";		
$dataLists = $sqli->get_selectData($qryString);
 include("includes/header.php"); ?>
        <div class="main_content">
                  <div class="menu">
                    <?php include("includes/menu.php"); ?>
                    </div> 
                    
                    
                    
                    
    <div class="center_content">
    <div class="right_content"> 
    <table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>Search List</h2></td>
    <td align="right"><a href="addProduct.php">Add Product</a></td>
  </tr>
</table>
    <div class="form">
          <form action="<?php echo $pagename; ?>" method="post" class="" id="adminForm" name="adminForm">
        
           <fieldset>
    <legend>Product Search form </legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="900">
   	<tr>
	  <td>SKU:</td>
	<td><input type="text" class="textbox" name="strsku" size="30" id="strsku" maxlength="30"  value="<?php echo $_POST['strsku']; ?>"/></td>
    <td>Product Name :</td>
	  <td><input type="text" class="textbox" name="strmodel" id="strmodel" size="30" maxlength="30"  value="<?php echo $_POST['strmodel']; ?>"/></td>
  </tr>
	  <td colspan="4" align="center"><input type="submit" name="submit" id="submit" value="Search"/></td>
	  </tr>
    </table>
  </fieldset>
          </form>
        </div>
    </div>
      <div class="right_content">            
        
        
        
         <table id="rounded-corner" summary="List of Products">
    <thead>
    	<tr>
        	
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Procuct ID</strong></th>
           <th nowrap="nowrap" class="rounded" scope="col"><strong>SKU</strong></th>
			<th nowrap="nowrap" class="rounded" scope="col"><strong>Product Name</strong></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Quantity</strong></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Action</strong></th>
	
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="8" class="rounded-foot-left"><div class="pagination">
        	  <span class="disabled"></div></td>
        	</tr>
    </tfoot>
    <tbody>
    	 <?php foreach($dataLists as $key=>$row) {
						?>
      	<tr>
        	
            <td><?php echo $row['product_id']; ?> </td>
            <td><?php echo $row['sku']; ?></td>
            <td><?php echo $row['model']; ?></td>
              <td><?php echo $row['quantity']; ?></td>
               <td><a href="updateProduct.php?productID=<?PHP echo $row['product_id']; ?>">
               <img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
         
        </tr>    
         <?php }  ?>
    </tbody>
</table>
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
    <link rel="stylesheet" href="colorbox/colorbox.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script src="colorbox/js/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				$(".iframe").colorbox({iframe:true, width:"1010", height:"550"});
				
			});
		</script>
    <?php include("includes/footer.php"); ?>
   