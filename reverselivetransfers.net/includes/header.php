<?php error_reporting(0);?>
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

<script src="jquery.jclock-1.2.0.js.txt" type="text/javascript"></script>
<script type="text/javascript" src="jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	var J = jQuery.noConflict();
	J(document).ready(function() {
		J('.ask').jConfirmAction();
	});
	
</script>
<script type="text/javascript">
var K = jQuery.noConflict();
K(function($) {
		     K('.jclock').jclock();
});
</script>

 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker({changeMonth: true,changeYear: true,dateFormat: 'mm-dd-yy', yearRange: '1900:2000'});
    $( "#datepicker1" ).datepicker({changeMonth: true,changeYear: true,dateFormat: 'mm-dd-yy',  yearRange: '1900:2000'});
  });
  </script>
  
<link type="text/css" href="jquery/css/flick/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="jquery/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="jquery/js/jquery-ui-1.8.16.custom.min.js"></script><script>
var LL = jQuery.noConflict();
	LL(function() {
		LL( "#strlast_edit_date_from" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: "images/calendar.gif",
			buttonImageOnly: true,
    		dateFormat: 'mm-dd-yy',
			yearRange: "1900:<?php echo date("Y") ?>"
			
		});
		LL( "#strlast_edit_date_to" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: "images/calendar.gif",
			buttonImageOnly: true,
    		dateFormat: 'mm-dd-yy',
			yearRange: "1900:<?php echo date("Y") ?>"
			
		});
		});
</script>

<link rel="stylesheet" type="text/css" media="all" href="niceforms-default.css" />
<link rel="stylesheet" href="colorbox/colorbox.css" />
</head>

<body>
<div id="main_container">

	<div class="header">
    <div class="logo"><a href="#"><img src="images/logo.png" alt="" title="" border="0"></a></div>
    
    <div class="right_header">Welcome Agent :&nbsp;<?php $sqli->table='agent_user'; 
	$field=null; $where=array('agid'=>$_SESSION['sessAgentID']); 
	$agent_userDet=$sqli->Get_data($field,$where);echo $agent_userDet[0][5]." ".$agent_userDet[0][6];
	?> | <a href="login.php?action=logout" class="logout">Logout</a></div>
    <div class="jclock"></div>
</div>