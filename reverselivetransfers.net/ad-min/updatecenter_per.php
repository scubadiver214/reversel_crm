<?php 
$pagename = "updatecenter_pwd.php"; 
include("_session.php"); 
include("_dataAccess.php"); 

if(isset($_GET['cen_id']))
{
$strQuery1 ="Select * from tbl_center_permission where cent_id='".$_GET['cen_id']."'";
$data=$sqli->get_selectData($strQuery1);
$ccdata = count($data);

}

if(isset($_POST['submit']))
{
	    	if(count($_SESSION['errmessage'])==0)
			{	
			 if($ccdata>0)
                {
        			$sqli->table='tbl_center_permission'; 
                    if(isset($_POST['str_all_trn_ph'])){	       			
        			$updateInformation['all_trn_ph']	=	1;	
                    }	
                    else $updateInformation['all_trn_ph']	=	0;
        			$fields 							= 	array_keys($updateInformation);
        			$values								=	array_values($updateInformation);
        			$sqli								->	autocommit(FALSE);
        			$where=array('cent_id'=>$_POST['cen_id']);	
        			$update_result= $sqli->Update_data($where,$values,$fields);
        			if($update_result == 0)
        			{
        			$error	= 1;
        			$sqli->rollback();
        			array_push($_SESSION['errmessage'],"An Error Occurred in Updated Data.");
        			}	
        			else
        			{
        			$sqli									->	commit();
        			array_push($_SESSION['message'],"Permission Successfully Updated.");		
        			}
			 }
             else
             {
                	$sqli->table='tbl_center_permission';
        			$insertInfo['cent_id']		=	$_POST['cen_id'];
                    if(isset($_POST['str_all_trn_ph'])){	
        			$insertInfo['all_trn_ph']	= 1	;}	
                    else	$insertInfo['all_trn_ph']	= 0	;
        			$fields 					= 	array_keys($insertInfo);
        			$values						=	array_values($insertInfo);
                    $sqli						->	autocommit(FALSE);
		            $insert_result 				=	$sqli	->	Insert_data($fields,$values);
			        if($insert_result!=1)
			        {
				    $sqli->rollback();
				    array_push($_SESSION['errmessage'],"An Error Occurred in Saving Data.");
			       }
			       else
			       {
				   $insertedvalue							=	$sqli			->	insert_id;
				   $sqli									->	commit();
				   array_push($_SESSION['message'],"Permission Successfully Saved.");
			       }
             }
            
        //    pageRedirection("listcenter_user.php");			
	}
	
}
		
 include("includes/header.php"); 
   
 
?> 
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
    	  JQ("#updateadminForm").validate();
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
    <td>  <h2> Update Affiliate User Password</h2></td>
    <td align="right"><a href="listcenter_user.php"><img src="images/list-details.png" alt="" title="List Center" border="0" /></a></td>
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
          <form action="" method="post" class="" id="centerForm" name="centerForm">
       
           <fieldset>
    <legend>Center User View Phone Transfer Number</legend>
    <input type="hidden" name="cen_id" value="<?php echo $_GET['cen_id']; ?>" />
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
  <tr>
    <td style=" padding-left: 5%;">
    
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
      <tr>
        <td >
           <input type="checkbox" name="str_all_trn_ph" value="1" checked="checked" />
           <label>Alllowed to view transfer number</label> </td>
        </tr>
      <tr>       
        <td style=" padding-left: 5%;"><input type="submit" name="submit" id="Update" value="Submit"/></td>
      </tr>
    </table>
    
    </td>
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
   