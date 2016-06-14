<?php
error_reporting(0);

session_start();
date_default_timezone_set('Europe/London');
if(!isset($_SESSION['sessMemberID']) || !isset($_SESSION['sessid']) || !isset($_SESSION['sess_ip']))
{
	unset($_SESSION['sessMemberID']);
	unset($_SESSION['sessid']);
	unset($_SESSION['login_ip']);
	unset($_SESSION['user']);
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