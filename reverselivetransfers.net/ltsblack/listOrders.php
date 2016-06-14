<?php include("_session.php"); ?>
<?php
	include("_dataAccess.php");
	if(isset($_POST['Search']))
	{
		if($_POST['strOrderID']!="")
		{
			 $strcond = " AND cx_order.order_id = '".$_POST['strOrderID']. "' ";
		}
		else
		{
			$strcond = "";
			if($_POST['strFName']!="")
			{
				$strcond.=" AND cx_order.firstname LIKE '%".$_POST['strFName']."%'";
			}
			if($_POST['strPhone']!="")
			{
					$strcond.=" AND cx_order.telephone = '".$_POST['strPhone']. "' ";
			}
			if($_POST['strProduct']!="")
			{
					$strcond.=" AND order_product.model LIKE '%".$_POST['strProduct']."%'";
			}
			if(($_POST['strlast_edit_date_from']!="")&&($_POST['strlast_edit_date_from']!=""))
			{
					$dtcondfrm.=" AND cx_order.date_added >= '".$_POST['strlast_edit_date_from']."'";
					$dtcondto.=" AND cx_order.date_added >= '".$_POST['strlast_edit_date_to']."'";
			}
			
		}
	}
	$qryString = "SELECT
cx_order.order_id,
cx_order.firstname,
cx_order.lastname,
cx_order.email,
cx_order.telephone,
cx_order.date_added,
order_product.model,
order_product.quantity,
order_total.value,
order_total.text,
order_total.title,
order_total.code,
order_status.name,
tbladmin.UserName
FROM
cx_order
Inner Join order_total ON cx_order.order_id = order_total.order_id
Inner Join order_product ON cx_order.order_id = order_product.order_id
Inner Join product ON order_product.product_id = product.product_id
Inner Join order_status ON cx_order.order_status_id = order_status.order_status_id
Inner Join tbladmin ON cx_order.affiliate_id = tbladmin.id
WHERE
order_total.code =  'total'
".$strcond."
".$dtcondfrm."
".$dtcondto."

ORDER BY
cx_order.order_id DESC
";
	//$ProdOrderLists="SELECT * from order_product";
	$dataLists = $sqli->get_selectData($qryString);
	//$OrderdataLists= $sqli->get_selectData($ProdOrderLists);
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
    <table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>Search List</h2></td>
    <td align="right"></td>
  </tr>
</table>
    <div class="form">
          <form action="<?php echo $pagename; ?>" method="post" class="" id="OrderForm" name="OrderForm">
           <fieldset>
    <legend>Order Search form </legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="900">
   	<tr>
	  <td>Order No:</td>
	<td><input type="text" class="textbox" name="strOrderID" size="30" id="strOrderID" maxlength="30"  value="<?php echo $_POST['strOrderID']; ?>"/></td>
    <td>Customer Name :</td>
	  <td><input type="text" class="textbox" name="strFName" id="strFName" size="30" maxlength="30"  value="<?php echo $_POST['strFName']; ?>"/></td>
  </tr>
  	<tr>
	  <td>Phone No:</td>
	<td><input type="text" class="textbox" name="strPhone" size="30" id="strPhone" maxlength="30"  value="<?php echo $_POST['strPhone']; ?>"/></td>
    <td>Product Name :</td>
	  <td><input type="text" class="textbox" name="strProduct" id="strProduct" size="30" maxlength="30"  value="<?php echo $_POST['strProduct']; ?>"/></td>
  </tr>
  <tr>
	  <td>Order Date To:</td>
	<td><input type="text" class="textbox" name="strlast_edit_date_from" size="30" id="strlast_edit_date_from" maxlength="30"  value="<?php echo $_POST['strlast_edit_date_from']; ?>"/></td>
    <td>Order Date From :</td>
	  <td><input type="text" class="textbox" name="strlast_edit_date_to" id="strlast_edit_date_to" size="30" maxlength="30"  value="<?php echo $_POST['strlast_edit_date_to']; ?>"/></td>
  </tr>
	  <td colspan="4" align="center"><input type="submit" name="Search" id="Search" value="Search"/></td>
	  </tr>
    </table>
  </fieldset>
          </form>
        </div>
    </div>
      <div class="right_content">
         <table id="rounded-corner" summary="List of Orders">
    <thead>
    	<tr>
        	
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Order No</strong></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Affiliate Name</strong></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Order Date</strong></th>
           <th nowrap="nowrap" class="rounded" scope="col"><strong>Customer Name</strong></th>
			<th nowrap="nowrap" class="rounded" scope="col"><strong>Phone Number</strong></th>
            
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Product Name</strong></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Quantity</strong></th>
              <th nowrap="nowrap" class="rounded" scope="col"><strong>Order Total</strong></th>
               <th nowrap="nowrap" class="rounded" scope="col"><strong>Order Status</strong></th>
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
    	 <?php foreach($dataLists as $key=>$row) 
		 {
			
		?>
      	<tr>
        	
            <td><?php echo $row['order_id']; ?> </td>
            <td><?php echo $row['UserName']; ?> </td>
             <td><?php echo date("d-m-Y",strtotime($row['date_added'])); ?> </td>
            <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
            <td><?php echo $row['telephone']; ?></td>
            <td><?php echo $row['model']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['text']; ?></td>
            <td>
            <a id="data<?php echo $row['order_id'];?>" ><?php echo $row['name']; ?>
            </a>
            </td>
		    <td><a href="OrderDetail.php?OrderID=<?PHP echo $row['order_id']; ?>" target="_blank"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
        
         <?php } ?>
         
		
        </tr>     
		  
    	</tbody>
	</table>
    </div><!-- end of right content-->
  </div>   <!--end of center content -->               
    <div class="clear"></div>
    </div> <!--end of main content-->
 
 <script>
var cal = jQuery.noConflict();
	cal(function() {
		cal('#strlast_edit_date_from').datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: "images/calendar.gif",
			buttonImageOnly: true,
    		dateFormat: 'yy-mm-dd',
			yearRange: "1950:<?php echo date("Y") ?>"
			
		});
		
		cal('#strlast_edit_date_to').datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: "images/calendar.gif",
			buttonImageOnly: true,
    		dateFormat: 'yy-mm-dd',
			yearRange: "1950:<?php echo date("Y") ?>"
			
		});
		
		});
</script>
		
    <?php include("includes/footer.php"); ?>