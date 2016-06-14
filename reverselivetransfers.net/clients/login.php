<?php
include("_dataAccess.php");
$pagename = "login.php"; 



session_start();
if(isset($_REQUEST['action']))
if($_REQUEST['action']=='logout')
{
	$_SESSION['pageURL']='';
	if(isset($_SESSION['sessClientID']))
	{
		
		$_SESSION['sessClientID']='';
		unset($_SESSION['sessClientID']);
		//clt_comp
		$_SESSION['sessClientUser']='';
		unset($_SESSION['sessClientUser']);
		$_SESSION['message']="You Have Successfuly Logged out.";		
	}
}

if(isset($_POST['submit'])){
	if($_POST['strUserid']=="")
	{
		array_push($_SESSION['errmessage'],"Incorrect Login Id.");
	}
	else if($_POST['strPassword']=="")
	{
		array_push($_SESSION['errmessage'],"Incorrect Login Password.");
	}
	else 
	{
		$pw= md5(trim($_POST['strPassword']));
		$sqli->table='client_user';
		$field=null;
		$where=array('clt_username'=>$_POST['strUserid'], 'password'=>$pw);
		
		 $looginSQLresult=$sqli->get_selectData("SELECT * FROM client_user where clt_username = '".$_POST['strUserid']."' AND clt_pwd = '".$pw."' AND clt_status = 1");	
		 		if(count($looginSQLresult) >0)
		{
			$_SESSION['sessClientID'] = $looginSQLresult[0]['cltid'];
			$_SESSION['sessClientUser']=$looginSQLresult[0]['clt_username'];
			pageRedirection("index.php");
		}
		else
		{
			array_push($_SESSION['errmessage'],"Incorrect Login Information.");
		}
	}
	
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
		exit;	
	}
	
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
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
    <div class="logo"><a href="#"><img src="../images/logo.png" alt=""  border="0" title="" /></a></div>
    
    </div>

     
         <div class="login_form">
         
         <h3>Client Panel Login</h3>
         
         <a href="#" class="forgot_pass">Forgot password</a> 
         
         <form action="<?php echo $pagename; ?>" method="post" class="niceform">
         <?php  foreach($_SESSION['message'] as $msg){ ?>
        <div class="valid_box">
        <?php echo $msg; ?>
     </div>
     <?php } ?>
     <?php  foreach($_SESSION['errmessage'] as $msg){ ?>
        <div class="error_box_login">
        <?php echo $msg; ?>
     </div>
     <?php } ?>
         
                <fieldset>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><dl>
                        <dt><label for="email">Username:</label></dt>
                        <dd><input type="text" name="strUserid" id="strUserid" size="54" /></dd>
                    </dl></td>
  </tr>
  <tr>
    <td> <dl>
                        <dt><label for="password">Password:</label></dt>
                        <dd><input type="password" name="strPassword" id="Password" size="54" /></dd>
                    </dl></td>
  </tr>
  <tr>
    <td> <dl>
                        <dt><label></label></dt>
                        <dd>
                    <input type="checkbox" name="interests[]" id="" value="" /><label class="check_label">Remember me</label>
                        </dd>
                    </dl></td>
  </tr>
  <tr>
    <td> <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Enter" />
                     </dl></td>
  </tr>
</table>

                    
                   
                    
                   
                    
                    
                    
                </fieldset>
                
         </form>
         </div>  
          
	
    
    <div class="footer_login">
    
    	<div class="left_footer"> <?php echo $footer; ?></div>
    	<div class="right_footer"></div>
    
    </div>

</div>		
</body>
</html>
<?php  $sqli->close();unset($sqli); ?>
<?php $_SESSION['message'] = array();
$_SESSION['errmessage'] = array(); ?>