<?php 
include("_session.php");
include("_dataAccess.php");
$pagename = "script.php"; 
$strQuery="select * from client_user";
$clt=$sqli->get_selectData($strQuery); 
$strQuery3="select * from campaigns where status=1";
$cmp=$sqli->get_selectData($strQuery3);

if(isset($_POST['submit']))
{		
				
			if($_POST['str_cmpid']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Select Campaign.");
			}
			if($_POST['str_cltid']=="")
			{
					array_push($_SESSION['errmessage'],"Please Select Client.");
			}
			if($_POST['str_script']=="")
			{
					array_push($_SESSION['errmessage'],"Last Name Must be Filled in correct Format.");
			}
			
			
	if(count($_SESSION['errmessage'])==0)
	{	
		
			$sqli->table='script';
			$insertInformation['cmpid']		=	$_POST['str_cmpid'];
			$insertInformation['cltid']		=	$_POST['str_cltid'];
			$insertInformation['script']	=	$_POST['str_script'];
			$insertInformation['date1']		=	date("y-m-d h:m:s");						
			$fields 								= 	array_keys($insertInformation);
			$values									=	array_values($insertInformation);
			$sqli									->	autocommit(FALSE);
			$insert_result 							=	$sqli->	Insert_data($fields,$values);
			if($insert_result!=1)
			{
				$sqli->rollback();
				array_push($_SESSION['errmessage'],"An Error Occurred in Saving Data.");
			}
			else
			{
				$insertedvalue							=	$sqli			->	insert_id;
				$sqli									->	commit();
				array_push($_SESSION['message'],"Data Successfully Saved.");
			}
				
	}
		
	
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
    <td><h2>Script Form</h2></td>
    <td align="right"><a href="listadmin.php"><img src="images/list-details.png" alt="" title="List All" border="0" /></a></td>
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
          <form action="<?php echo $pagename; ?>" method="post" class="" id="adminForm" name="adminForm">
           <fieldset>
    <legend>Script</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
  <tr>
    <td width="10%" align="right" nowrap="nowrap">Campaign<span class="err">*</span>:</td>
    <td width="30%"><select name="str_cmpid" id="str_cmpid">
		<option value="" >- Select -</option>
        <?php foreach($cmp as $key=>$valcmp){ ?>
        <option value="<?php echo $valcmp['cmp_id']?>" ><?php echo $valcmp['cmp_name']?></option>
          <?php } ?>
        </select></td>
    <td width="10%" align="right" nowrap="nowrap">Client <span class="err">*</span>:</td>
    <td width="50%"><select name="str_cltid" id="str_cltid">
		<option value="" >- Select -</option>
         <?php foreach($clt as $key=>$valclt){ ?>
        <option value="<?php echo $valclt['cltid']?>" ><?php echo $valclt['clt_comp']?></option>
          <?php } ?>
        </select></td>
    <tr>
      <td align="right" valign="top" nowrap="nowrap">&nbsp;</td>
      <td colspan="3" valign="top">&nbsp;</td>
    </tr>
    <tr>
	  <td width="10%" align="right" valign="top" nowrap="nowrap">Script :</td>
	  <td colspan="3" valign="top"><textarea name="str_script" cols="32" rows="5" class="" id="str_script"></textarea></td>
	  </tr>
	<tr>
	  <td width="10%" align="right" valign="top" nowrap="nowrap">&nbsp;</td>
	  <td width="30%">&nbsp;</td>
	  <td width="10%" align="right" nowrap="nowrap">&nbsp;</td>
	  <td width="50%">&nbsp;</td>
	  </tr>
	
	<tr>
	  <td width="10%" align="right" nowrap="nowrap">&nbsp;</td>
	  <td width="30%">&nbsp;</td>
	  <td width="10%" align="right" nowrap="nowrap"><input type="submit" name="submit" id="submit" value="Submit"/></td>
	  <td width="50%">&nbsp;</td>
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
   