<?php 
include("_session.php"); 
include("_dataAccess.php");

if(isset($_REQUEST['cenuname']))
{
		if($_REQUEST['cenuname'] == "")
		{
		echo "0";		
		}
		else
		{
		$strQuery ="SELECT * FROM center_user WHERE cen_username = '".$_REQUEST['cenuname']."'"; 
		$data=$sqli->get_selectData($strQuery);
			if (count($data) != 0)
			{
			echo "0";	
			}
			else
			{
			echo "1";
			}
		}
}
?>