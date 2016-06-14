<?php
include("_dataAccess.php");
$pagename = "login.php"; 
$message = array();
$errmessage = array();

session_start();
if(isset($_REQUEST['action']))
if($_REQUEST['action']=='logout')
{
	$_SESSION['pageURL']='';
	if(isset($_SESSION['sessMemberID']))
	{
		$sqli->table='login_logs';
		$updateInformation['logout_time']				=	date("Y-m-d H:i:s");
		$updateInformation['logout_ip']					=	$_SERVER['REMOTE_ADDR'];
		$updateInformation['logout_agent']				=	$_SERVER['HTTP_USER_AGENT'];
		$fields 										= 	array_keys($updateInformation);
		$values											=	array_values($updateInformation);
		$where=array('sess_id'=>$_SESSION['sessid']);	
		$update_result= $sqli->Update_data($where,$values,$fields);
		unset($_SESSION['sessMemberID']);
		unset($_SESSION['sessid']);
		unset($_SESSION['sess_ip']);
		unset($_SESSION['user']);
		session_unset() ;
		session_destroy() ;
		$_SESSION['message']="You Have Successfuly Logged out.";		
	}
}

if(isset($_POST['submit'])){
	if($_POST['strUserid']=="")
	{
		array_push($errmessage,"Incorrect Login Id.");
	}
	else if($_POST['strPassword']=="")
	{
		array_push($errmessage,"Incorrect Login Password.");
	}
	else 
	{
		
		$pw= md5(trim($_POST['strPassword']));
		$sqli->table='tbllifemembers';
		$field=null;
		$where=array('regID'=>$_POST['strUserid'], 'password'=>$pw );
		
 $looginSQLresult=$sqli->get_selectData("SELECT * FROM tblAdmin where userId = '".$_POST['strUserid']."' AND password = '".$pw."' AND FIND_IN_SET( 2, roles ) > 0");
// echo "SELECT * FROM tblAdmin where userId = '".$_POST['strUserid']."' AND password = '".$pw."' AND FIND_IN_SET( 2, roles ) > 0";
$logmein = false;
		if(count($looginSQLresult) >0){
			//check if the binding has been done????
			if($looginSQLresult[0]['bindwithip']!="" && $looginSQLresult[0]['bindwithip']==$_SERVER['REMOTE_ADDR']){
				$logmein = true;
			}
			else if($looginSQLresult[0]['bindwithip']!="" && $looginSQLresult[0]['bindwithip']!=$_SERVER['REMOTE_ADDR'])
			{
				$logmein = false;
				array_push($errmessage,"Incorrect IP and Login Information.");
			}
			else if($looginSQLresult[0]['bindwithip']=="") $logmein = true;
			
			if($logmein){			
							$_SESSION['sessMemberID'] = $looginSQLresult[0]['id'];
							$_SESSION['user']=$looginSQLresult[0]['userId'];
							$_SESSION['sessid'] = session_id();
							$_SESSION['sess_ip'] = $_SERVER['REMOTE_ADDR'];
							//Add Login logs
							$logged = false;
							//echo "SELECT * FROM login_logs where sessid='".session_id()."'";
							$loginlogtest=$sqli->get_selectData("SELECT * FROM login_logs where sess_id='".session_id()."'");
							//print_r($loginlogtest);
							//exit;
							if(count($loginlogtest)>0)
							{
								if($loginlogtest[0]['user_id']==$_SESSION['sessMemberID'] && $loginlogtest[0]['login_agent'] ==	$_SERVER['HTTP_USER_AGENT'] && $loginlogtest[0]['logout_time'] == "0000-00-00 00:00:00"  )
								{
									$logged = true;
								}
								else{
									 session_regenerate_id(); 
									 $_SESSION['sessid'] = session_id();
									}
							}
							if(!$logged){
								$sqli->table='login_logs';
								$insertInformation['sess_id']		   =	$_SESSION['sessid'];
								$insertInformation['user_id']		   =	$_SESSION['sessMemberID'];
								$insertInformation['login_time']	   =	date("Y-m-d H:i:s");
								$insertInformation['login_ip']		   =	$_SERVER['REMOTE_ADDR'];
								$insertInformation['login_agent']	   =	$_SERVER['HTTP_USER_AGENT'];
								$fields 								= 	array_keys($insertInformation);
								$values									=	array_values($insertInformation);
								$insert_result 							=	$sqli			->	Insert_data($fields,$values);
							}
							if (!headers_sent())
							{
								header("Location:index.php");
								exit;
							}
							else
							{
				?>
					<script language="javascript">
										window.location.href = "index.php";
									</script>
						<?PHP
							}
					}
					
		}
		else
		{
			array_push($errmessage,"Incorrect Login Information.");
		}
	}
	
}
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Affiliate Network</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="ddaccordion.js"></script>
<script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='images/plus.gif' class='statusicon' />", "<img src='images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>

<script type="text/javascript" src="jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
	
</script>

<script language="javascript" type="text/javascript" src="niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="niceforms-default.css" />

</head>
<body>
<div id="main_container">

	<div class="header_login">
    <div class="logo"><a href="#"><img src="images/logo.png" alt="" title="" border="0" /></a></div>
    
    </div>

     
         <div class="login_form">
         
         <h3>User Login</h3>
         
         <a href="#" class="forgot_pass">Forgot password</a> 
         
         <form action="" method="post" class="niceform">
         <?php  foreach($message as $msg){ ?>
        <div class="valid_box">
        <?php echo $msg; ?>
     </div>
     <?php } ?>
     <?php  foreach($errmessage as $msg){ ?>
        <div class="error_box_login">
        <?php echo $msg; ?>
     </div>
     <?php } ?>
         
                <fieldset style="width:575px">
                    <dl>
                        <dt><label for="email">Username:</label></dt>
                        <dd><input type="text" name="strUserid" id="strUserid" size="54" /></dd>
                    </dl>
                    <dl>
                        <dt><label for="password">Password:</label></dt>
                        <dd><input type="password" name="strPassword" id="Password" size="54" /></dd>
                    </dl>
                    
                    <dl>
                        <dt><label></label></dt>
                        <dd>
                    <input type="checkbox" name="interests[]" id="" value="" /><label class="check_label">Remember me</label>
                        </dd>
                    </dl>
                    
                     <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Enter" />
                     </dl>
                    
                </fieldset>
                
         </form>
         </div>  
          
	
    
    <div class="footer_login">
    
    	<div class="left_footer">&copy; <?php echo date("Y"); ?></div>
    	<div class="right_footer"></div>
    
    </div>

</div>		
</body>
</html>