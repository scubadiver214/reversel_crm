<?php include("_session.php"); ?>
<?php
include("_dataAccess.php");
$pagename = "script.php"; 



if(isset($_POST['View']))
{
$strQuery ="Select * from  script where cmpid ='".$_POST['str_cmpid']."' AND cltid ='".$_POST['str_cltid']."' ";
$data=$sqli->get_selectData($strQuery);


}
?>
<?php include("includes/header.php"); ?>
<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
<script src="js/jquery.metadata.js" type="text/javascript"></script>
<script src="../tinymce/tinymce.min.js" type="text/javascript"></script>
<script>tinymce.init({selector:'textarea'});</script>

<style type="text/css">
label.error { float: left;
color: red;
padding-left: .5em; }
p { clear: both; }
.submit { margin-left: 12em; }
em { font-weight: bold; padding-right: 1em; vertical-align: top; }
.err{color:#F00; font-size:14px;}
</style>
  <script>
  var JQ = jQuery.noConflict();
  JQ.metadata.setType("attr", "validate");
JQ(document).ready(function() {
    	  JQ("#adminForm").validate();
  });
  </script>
        <div class="main_content">
                  <div class="menu">
                   <?php include("includes/menu.php"); ?>
                    </div> 
                    <div class="center_content">
      <div class="right_content">            
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>Script View</h2></td>
    <td align="right"><a href="scriptview.php"><img src="images/list-details.png" alt="" title=" View Script" border="0" /></a></td>
  </tr>
</table>

        
    
        <div class="form">
        
           <fieldset>
    <legend>Script</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="98%">
  <tr>
    
	  <td valign="top" align="center" style="font-size:14px; text-align:center; font-weight:bold;">Script</td>
	 
	  </tr>
	<tr>
    
	  <td valign="top" style="text-align:justify"><?php echo $data[0]['script']; ?></td>
	 
	  </tr>
	
    </table>
  </fieldset>
       
        </div>  
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>
   