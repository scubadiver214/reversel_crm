<?php 
$pagename = "campaign.php"; 
include("_session.php"); 
include("_dataAccess.php");
if(isset($_GET['cmpID']))
{
$strQuery1 ="Select * from campaigns where cmp_id='".$_GET['cmpID']."'";
$data=$sqli->get_selectData($strQuery1);
//echo $data[0]['company_name'];
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
    <td><h2>View Campaign</h2></td>
    <td align="right"><a href="listcampaign.php"><img src="images/list-details.png" alt="" title="List Campaign" border="0" /></a></td>
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
          <form action="" method="post" class="" id="campaignForm" name="campaignForm">
           <fieldset>
    <legend>Campaign</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="500">
  <tr>
    <td align="right" nowrap="nowrap"><strong>Campaign Name</strong>:</td>
    <td align="left"><strong><?php echo $data[0]['cmp_name']; ?></strong></td>
    </tr>
  <tr>
  <td colspan="2" align="left">
  
  <?php for($i=1;$i<=50;$i++) { ?>
  
  <fieldset>
    <legend><strong>Type<?php echo $i;?></strong></legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3"  width="100%">
 	 <tr>
    <td  nowrap="nowrap" width="15%" style="padding-left:5%;">Name:</td>
    <td width="85%" align="left" style="padding-left:1%;"><?php echo $data[0]['Type'.$i.''];?></td>
   <!-- <td>Type:</td>
    <td>&nbsp;</td>
    <td>Value:</td>
     <td>&nbsp;</td>-->
	</tr>
   
    </table>
  </fieldset>
 
   <?php }?>
</td>

</tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
     </table>
 
          </form>
        </div>  
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>
   