<?php 
$page="scriptview.php";
include("_session.php"); 
include("_dataAccess.php");
$pagename = "script.php"; 


$strQuery="select * from client_user";
$clt=$sqli->get_selectData($strQuery); 
$strQuery3="select * from campaigns where status=1";
$cmp=$sqli->get_selectData($strQuery3);


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
   
  </tr>
</table>

        
    
        <div class="form">
          <form action="viewscript.php" method="post" class="" id="scriptForm" name="scriptForm">
           <fieldset>
    <legend>Script</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="900">
  <tr>
    <td width="165" nowrap="nowrap">Campaign<span class="err">*</span>:</td>
    <td width="312"><select name="str_cmpid" id="str_cmpid">
		<option value="" >- Select -</option>
        <?php foreach($cmp as $key=>$valcmp){ ?>
        <option value="<?php echo $valcmp['cmp_id']?>" ><?php echo $valcmp['cmp_name']?></option>
          <?php } ?>
        </select></td>
    <td width="122" nowrap="nowrap">Client <span class="err">*</span>:</td>
    <td width="270"><select name="str_cltid" id="str_cltid">
		<option value="" >- Select -</option>
         <?php foreach($clt as $key=>$valclt){ ?>
        <option value="<?php echo $valclt['cltid']?>" ><?php echo $valclt['clt_comp']?></option>
          <?php } ?>
        </select></td>
    
	<tr>
	  <td valign="top" nowrap="nowrap">&nbsp;</td>
	  <td>&nbsp;</td>
	  <td nowrap="nowrap">&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	
	<tr>
	  <td nowrap="nowrap">&nbsp;</td>
	  <td>&nbsp;</td>
	  <td nowrap="nowrap"><input type="submit" name="View" id="submit" value="View"/></td>
	  <td>&nbsp;</td>
	  </tr>
  
    </table>
  </fieldset>
          </form>
        </div>  
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>
   