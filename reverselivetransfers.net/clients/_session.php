<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['sessClientID']	))
{
header('location:login.php');		
exit;
}
function pageRedirection($location)
	{
		if (!headers_sent())
		{
			header('Location: '.$location.'');
			//header("Location:$location");
		}
		else
		{
?>
<meta http-equiv="Refresh" content="0;url=<?PHP echo $location;?>" />
				
		<?PHP
		}		
	}
	
	
 ?>