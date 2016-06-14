<?php 
include("_session.php"); 
include("_dataAccess.php");


if(isset($_REQUEST['cltuname']))
{
	if($_REQUEST['cltuname'] == "")
		{
		echo "0";		
		}
		else
		{
		$strQuery ="SELECT * FROM client_user WHERE clt_username = '".$_REQUEST['cltuname']."'"; 
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