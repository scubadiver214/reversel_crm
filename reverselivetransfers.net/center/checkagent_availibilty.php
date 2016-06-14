<?php 
include("_session.php"); 
include("_dataAccess.php");


if(isset($_REQUEST['ag_uname']))
{
		if($_REQUEST['ag_uname'] == "")
		{
		echo "0";		
		}
		else
		{
			$strQuery ="SELECT * FROM agent_user WHERE ag_username = '".$_REQUEST['ag_uname']."'"; 
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