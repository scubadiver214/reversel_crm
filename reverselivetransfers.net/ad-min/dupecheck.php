<?php 
include("_session.php");
include("_dataAccess.php");
$pagename = "leadentry.php"; 

if(isset($_POST['submit']))
{
			if($_POST['dd_dupeClient']=="" )
			{
					array_push($_SESSION['errmessage'],"Please Select Client.");
			}
			if($_POST['dd_dupeCamp']=="")
			{
					array_push($_SESSION['errmessage'],"Please Select Campaign.");
			}
			if($_POST['str_dupeNumber']=="" || !is_numeric($_POST['str_dupeNumber']))
			{
					array_push($_SESSION['errmessage'],"Phone Number Must be Filled in correct format.");
			}
					
	if(count($_SESSION['errmessage'])==0)
	{	
	
			$sqli->table='dupelist';
			$insertInformation['dupeClient']	=	$_POST['dd_dupeClient'];
			$insertInformation['dupeCamp']	    =	$_POST['dd_dupeCamp'];
			$insertInformation['dupeNumber']	=	$_POST['str_dupeNumber'];
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
if(isset($_POST['Check']))
{
			if(($_POST['dd_dupeCamp']!="") || ($_POST['str_dupeNumber']!="")|| ($_POST['dd_dupeClient']!=""))
			 {
			 $strQuery4 ="Select * from dupelist where dupeClient ='".$_POST['dd_dupeClient']."' AND dupeCamp ='".$_POST['dd_dupeCamp']."' AND dupeNumber ='".$_POST['str_dupeNumber']."'";
			 $data4=$sqli->get_selectData($strQuery4);
			 
				 if(count($data4)=="")
				 {
					 array_push($_SESSION['message'],"Value is Not Duplicate.");
				 }
				 else
				  {
					  array_push($_SESSION['errmessage']," Value is Duplicate.");
				 }
			 }
			 else
			 {
			array_push($_SESSION['errmessage'],"Please Select Client.");
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
    <td><h2>Form Duplicate Check</h2></td>
    <td align="right"><a href="listdupecheck.php"><img src="images/list-details.png" alt="" title="List" border="0" /></a></td>
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
          <form action="" method="post" class="" id="dupForm" name="dupForm">
           <fieldset>
   	 <legend>Duplicate Check</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
 	  <!--part1-->
     <tr>
    <td>
    <fieldset>
   	 <legend>Check</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
	
    <tr>
   <td width="20%" align="right" valign="top">Client<span class="err">*</span>:</td>
   <td width="30%" align="left" valign="top"><select name="dd_dupeClient" id="dd_dupeClient"> 
         <option value="" selected="selected">- Select -</option>
         <?php
	$strQuery1="select * from client_user";
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
       <td width="30%" align="left"><input type="text" class="required textbox" name="str_dupeNumber" size="30" id="str_dupeNumber"/></td>
     </tr>
     
    </table>
     </fieldset>
 
   
   
    
   
    
      <tr>
    <td align="center"><input type="submit" name="Check" id="submit" value="Check"/> <input type="submit" name="submit" id="submit" value="Submit"/></td>
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
   