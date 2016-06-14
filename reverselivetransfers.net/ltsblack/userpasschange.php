<!-- this is a admin update form-->
<?php include("_session.php"); 
include("_dataAccess.php"); 
$pagename = "userpasschange.php"; 
$message = array();
$errmessage = array();
if(isset($_POST['Update']))
{
			$error											=	0;
			$sqli->table='tbllifemembers';
			if($_POST['strpassword']!="" && $_POST['confirmpassword']!="")
			if($_POST['strpassword']==$_POST['confirmpassword']){
			$updateInformation['password']            = md5(trim($_POST['strpassword']));
			$updateInformation['transpwd']            = md5(trim($_POST['strpassword']));
			$updateInformation['lastUpdated']		  =	date("y-m-d h:m:s:");
			$updateInformation['modUser']		      =	  $_POST['sessMemberID'];
			$updateInformation['status']		=	"1";
			$fields 										= 	array_keys($updateInformation);
			$values											=	array_values($updateInformation);
			$sqli											->	autocommit(FALSE);
			$where=array('regID'=>$_SESSION['sessMemberID']);	
				$update_result= $sqli->Update_data($where,$values,$fields);
				if($update_result != 1)
				{
					$error	= 1;
					$sqli->rollback();
					array_push($errmessage,"An Error Occurred in Saving Data.");
				}					
				else
				{
						$insertedvalue							=	$sqli			->	insert_id;
						$sqli									->	commit();
						array_push($message,"Data Successfully Updated.");
				}
				
				}
				else
				{
						array_push($errmessage,"Password Mismatch.");
				}
}
?>
<?php include("includes/header.php"); 
      $field=null;
		$where =array('regID'=>$_SESSION['sessMemberID']);
		$sqli->table='tbllifemembers';
		$data=$sqli->Get_data($field,$where);
		//print_r($data);

?> 
<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>    
<script src="ws-admin/js/jquery.metadata.js" type="text/javascript"></script>
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
    	  JQ("#updateadminForm").validate();
  });
  </script>             
 <div class="main_content">
                  <div class="menu">
                   <?php include("includes/menu.php"); ?>
                    </div> 
                    <div class="center_content">
      <div class="right_content">
        <h2> Edit Password </h2>
        
          <?php  foreach($message as $msg){ ?>
        <div class="valid_box">
        <?php echo $msg; ?>
     </div>
     <?php } ?>
     <?php  foreach($errmessage as $msg){ ?>
        <div class="error_box">
        <?php echo $msg; ?>
     </div>
     <?php } ?>
        <div class="form">
          <form action="<?php echo $pagename; ?>" method="post" class="" id="updateadminForm">
		
           <fieldset>
    <legend>Edit Password</legend><input type="hidden" name="sessMemberID" value="<?php echo($data[0][0]); ?>" />
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="600">
    <tr>
	 <tr>
    <td>User Id <span class="err">*</span>: </td>
    <td><input type="text" class="required textbox" name="struserid" readonly="readonly" value="<?php echo $data[0][0]; ?>"/></td>
  </tr>
    <td>Password <span class="err">*</span>:</td>
    <td><input type="password" name="strpassword" class="required textbox" size="20" maxlength="30"/></td>
	<tr><td>Confirm Password <span class="err">*</span>:</td>
	<td><input type="password" class="required textbox" name="confirmpassword" size="20" maxlength="30" /></td></tr>

	<tr><td>User Name <span class="err">*</span>:</td>
	<td><input type="text" class="required textbox" name="strusername" size="30" maxlength="30"  value="<?php echo $data[0][6]; ?><?php echo $data[0][6]; ?>" /></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="Update" id="Update" value="Update"/></td>
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
   