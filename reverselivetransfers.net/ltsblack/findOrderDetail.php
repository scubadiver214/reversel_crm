<?php include("_session.php"); ?>
<?php
include("_dataAccess.php");

if(isset($_REQUEST['act']))
{
	if($_REQUEST['act']=="prodet")
	{
		if(isset($_REQUEST['prodid']))
		{
		
			$Prod		=		$sqli->get_selectData("SELECT * FROM  product where product_id=".$_REQUEST['prodid']);
			echo "Unit price  = $". number_format($Prod[0]['price'],2);
			
		}
		else
		{ 
			echo "Please select valid product.";
		}
			
	}
	else if($_REQUEST['act']=="ordet")
	{
		if(isset($_REQUEST['prodid'])&&isset($_REQUEST['quantity']))
		{
		
			$Prod					=		$sqli->get_selectData("SELECT * FROM  product where product_id=".$_REQUEST['prodid']);
			$ShippingChar			=		$sqli->get_selectData("SELECT * FROM `setting` WHERE `setting_id` =1");
			echo '<table>';
			echo '<tr>';
			echo "<td>Unit price</td><td>  = </td><td> $". number_format($Prod[0]['price'],2);
			echo '</tr><tr>';
			echo "<td>Sub Total (".number_format($Prod[0]['price'],2)." x ".$_REQUEST['quantity'].") </td><td>=</td><td> $". number_format(round( $Prod[0]['price'] * $_REQUEST['quantity']),2)."</td>";
			echo '</tr><tr>';
			echo "<td>Shipping  </td><td>=</td><td> $".$ShippingChar[0]['value']."</td>";
			echo '</tr><tr>';
			echo '<td style="border-top:#333 thin solid;">Total  </td><td style="border-top:#333 thin solid;">=</td><td style="border-top:#333 thin solid;"> $'. number_format(round( ($Prod[0]['price'] * $_REQUEST['quantity'])+$ShippingChar[0]['value']),2)."</td>" ;
			echo '</tr>';
			echo '</table>';
		}
		else
		{ 
			echo "Please select valid product.";
		}
	}
	else
	{
		echo "Invalid Request found.";	
	}
	
}
else
{
		echo "Invalid Request found.";	
}		


			

?>
