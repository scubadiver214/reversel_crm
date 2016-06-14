<?php 
include("_session.php"); 
include("_dataAccess.php");


if(isset($_REQUEST['uname']))
{
		if($_REQUEST['uname'] == "")
		{
		echo "0";		
		}
		else
		{
			$strQuery ="SELECT * FROM admin WHERE ad_username = '".$_REQUEST['uname']."'"; 
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