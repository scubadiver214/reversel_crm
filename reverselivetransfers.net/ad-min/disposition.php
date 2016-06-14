<?php 
include("_session.php"); 
include("_dataAccess.php");
$pagename = "disposition.php"; 


if(isset($_POST['submit']))
{
			if($_POST['str_dispname']=="" )
			{
					array_push($_SESSION['errmessage'],"Please fill the value.");
			}
				
	if(count($_SESSION['errmessage'])==0)
	{	
			$sqli->table='disposition';
			$insertInformation['dispname']		=	$_POST['str_dispname'];
			$insertInformation['mod_date']		=	date("y-m-d h:m:s");
						
			$fields 								= 	array_keys($insertInformation);
			$values									=	array_values($insertInformation);
			$sqli									->	autocommit(FALSE);
			$insert_result 							=	$sqli			->	Insert_data($fields,$values);
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
    <td><h2>Disposition Form</h2></td>
    <td align="right"><a href="listdisposition.php"><img src="images/list-details.png" alt="" title="List Campaign" border="0" /></a></td>
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
          <form action="" method="post" class="" id="dispositionForm" name="dispositionForm">
           <fieldset>
    <legend>Disposition</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="900">
  <tr>
    <td align="right" nowrap="nowrap"> Name<span class="err">*</span>:</td>
    <td width="78%" align="left"><input type="text" class="required textbox" name="str_dispname" size="30" id="str_dispname"/></td>
    </tr>
   <tr>
    <td width="22%">&nbsp;</td>
    <td ><input type="submit" name="submit" id="submit" value="Submit"/></td>
     </table>
      </fieldset>
 
          </form>
        </div>  
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>
   