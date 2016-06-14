<?php 
include("_session.php");
include("_dataAccess.php");
include("includes/header.php");

if(isset($_GET['clientID']))
{
$strQuery14="select * from zone where country_id=223";
$datastate=$sqli->get_selectData($strQuery14); 

$strQuery1 ="Select * from client_user where cltid='".$_GET['clientID']."'";
$data=$sqli->get_selectData($strQuery1);
	
$cs = explode(",",$data[0]['clt_transfer_states']);
 }     
if(isset($_POST['submit']))
{
				
			$sqli->table='client_user';			
			$updateInformation['clt_transfer_states'] =	implode(",",$_POST['str_change_states']);
            $updateInformation['clt_op_hours_to']	  = $_POST['str_clt_op_hours_to'];
			$updateInformation['clt_op_hours_from']	  = $_POST['str_clt_op_hours_from'];            
			$updateInformation['upd_date']		      =	date("y-m-d h:m:s");			
			$fields 								  = 	array_keys($updateInformation);
			$values									  =	array_values($updateInformation);
			$sqli									  ->	autocommit(FALSE);
			$where=array('cltid'=>$_POST['str_client']);	
			$update_result= $sqli->Update_data($where,$values,$fields);
				if($update_result == 0)
				{
					$error	= 1;
					$sqli->rollback();
					array_push($_SESSION['errmessage'],"An Error Occurred in Saving Data.");
				}	
				
				else
				{
						$sqli									->	commit();
						array_push($_SESSION['message'],"States Successfully Changed.");
                        pageRedirection("listclient_user.php");			
				}		
			
	} 

?>
    
    
<div class="main_content">
<div class="menu"><?php include("includes/menu.php");?> </div> 

<div class="center_content">
             <div class="right_content"><h2>Client's Transfer State </h2>

<form action="" method="post">
<input type="hidden" name="str_client" value="<?php echo $_GET['clientID']; ?>" />
<table id="rounded-corner" summary="List of States" >         
    <tbody>
      <tr>
        <td width="16%" align="right" nowrap="nowrap">Operation Hours (To) :</td>
        <td width="25%"><input type="time" class="required textbox" name="str_clt_op_hours_to" id="str_clt_op_hours_to" size="30" value= "<?php echo $data[0]['clt_op_hours_to']; ?>" /></td>
        <td width="14%" align="right" nowrap="nowrap">Operation Hours (From):</td>
        <td width="45%"><input type="time" class="required textbox" name="str_clt_op_hours_from" id="str_clt_op_hours_from" size="30" value= "<?php echo $data[0]['clt_op_hours_from']; ?>" /></td>
        </tr>
      	<tr><td colspan="4" style="padding: 2%;">
       
        <?php $i=0;foreach($datastate as $key=>$valuestate){ $i=$i+1;?> 
               <div style="width: 90px; display: inline-block; padding: 2px 3px 2px 3px; background: #fff; margin: 3px;" title="<?php echo $valuestate['name']; ?>">
               <div style="width: 70%;display: inline-block;" title="<?php echo $valuestate['name']; ?>"> <?php echo $valuestate['code']; ?> </div>            
             <div style="width: 30%;display: inline-block; float: left;"><input type="checkbox" name="str_change_states[]" value="<?php echo $valuestate['zone_id']; ?>" <?php if(in_array($valuestate['zone_id'],$cs)) echo "checked"; ?> /> </div>
            </div>
         <?php if($i%11==0) echo "<br/>"; }  ?>
        
         </td></tr>    
        
        
        <tr><td colspan="4" style=" text-align: center;"><input type="submit" name="submit" id="submit" value="Submit"></td></tr>
    </tbody>
</table>
</form>

 




</div> 
<div class="clear"></div></div></div>
<?php include("includes/footer.php");?>
   