<?php
$page="dupecheck.php";
include("_session.php"); 
include("_dataAccess.php");
$pagename = "lead.php"; 
include("includes/header.php");

?>
<script src="js/jquery.metadata.js" type="text/javascript"></script>
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
    <td><h2>Duplicate Form Check</h2></td>
   
  </tr>
</table>

        
        <?php  foreach($_SESSION['message'] as $msg){ ?>
        <div class="valid_box">
        <?php echo $msg; ?>
     </div>
     <?php } ?>
     <?php  foreach($_SESSION['errmessage'] as $msg){ ?>
        <div class="error_box">
        <?php echo $msg; ?>
     </div>
     <?php } ?>
        <div class="form">
          <form action="lead.php" method="post" class="" id="dupForm" name="dupForm">
           <fieldset>
   	 <legend>Duplicate Check</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
 	  <!--part1-->
     <tr>
    <td>
    <fieldset>
   	 <legend>Form</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
	
    <tr>
   <td width="20%" align="right" valign="top">Client<span class="err">*</span>:</td>
   <td width="30%" align="left" valign="top"><select name="dd_dupeClient" id="dd_dupeClient"> 
         <option value="" selected="selected">- Select -</option>
         <?php
	$strQuery1="select * from client_user where clt_status=1";
	$datac=$sqli->get_selectData($strQuery1); 
	
	 foreach($datac as $key=>$valuec){?>
         
  <option value="<?php echo $valuec['cltid'];?>"> <?php echo $valuec['clt_comp'];?></option>
  <?php }?>
         </select>
         </td>
         
          <td width="20%" align="right" valign="top">Campaign<span class="err">*</span>:</td>
       <td width="30%" align="left" valign="top"><select name="dd_dupeCamp" id="dd_dupeCamp"> 
         <option value="" selected="selected">- Select -</option>
         <?php
	$strQuery2="select * from campaigns where status=1";
	$datacmp=$sqli->get_selectData($strQuery2); 
	
	 foreach($datacmp as $key=>$valuecmp){?>
         
  <option value="<?php echo $valuecmp['cmp_id'];?>"> <?php echo $valuecmp['cmp_name'];?></option>
  <?php }?>
         </select>
         </td>
         
        <td width="20%" align="right" nowrap="nowrap">Phone Number<span class="err">*</span>:</td>
       <td width="30%" align="left"><input type="text" class="required textbox" name="str_Telephone1" size="30" id="str_Telephone1"/></td>
     </tr>
     
    </table>
     </fieldset>
 
   
   
    
   
    
      <tr>
    <td align="center"><input type="submit" name="Continue" id="Continue" value="Continue"/> </td>
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
   