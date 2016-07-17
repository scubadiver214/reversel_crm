<?php

$strQuery_s="select * from morgagetype";
$mtype=$sqli->get_selectData($strQuery_s);

$strQuery_cr="select * from  credit_rating";
$cr=$sqli->get_selectData($strQuery_cr);

$strQuery_emp="select * from  emp_status";
$emp=$sqli->get_selectData($strQuery_emp);

?>
<fieldset>
<input type="hidden" name="cmpcount" value="18" />
     <?php
	$strQuery1="select * from campaigns where cmp_id=8";
	$datacmp=$sqli->get_selectData($strQuery1); 
	?>
    
    
    <legend><?php echo $datacmp[0]['cmp_name'] ?></legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type1'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data1" size="30" id="str_Data1" value="<?php echo $_POST["str_Data1"] ? $_POST["str_Data1"] : $data[0]['Data1'] ?>"/></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type2'] ?>:</td>
      <td align="left"> 
       <select name="str_Data2" id="str_Data2">
        <option value="" selected="selected">Select..</option>
       <?php
			
 foreach($cr as $key=>$valuecr){?>
<option value="<?php echo $valuecr['credit_name'];?>" <?php if(($_POST["str_Data2"] || $data[0]['Data3'])==$valuecr['credit_name']){echo "selected=\"selected\"";} ?>><?php echo $valuecr['credit_name'];?></option>
<?php }?>
        
        </select>  </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type3'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"> <select name="str_Data3" id="str_Data3">
         <option value="" selected="selected">Select..</option>
         <option value="SFR" <?php if(($_POST["str_Data3"] || $data[0]['Data3']) == "SFR") echo "selected=\"selected\"" ?>>SFR</option>
         <option value="FHA approved Condo" <?php if(($_POST["str_Data3"] || $data[0]['Data3'])== "FHA approved Condo") echo "selected=\"selected\"" ?>> FHA approved Condo</option>
          <option value="Manufactured Home" <?php if(($_POST["str_Data3"] || $data[0]['Data3'])== "Manufactured Home") echo "selected=\"selected\"" ?>>Manufactured Home</option>
         
       </select></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type4'] ?>:</td>
      <td width="30%" align="left">
       <select name="str_Data4" id="str_Data4">
         <option value="" selected="selected">Select..</option>
         <option value="Yes" <?php if(($_POST["str_Data4"] || $data[0]['Data4'])== "Yes") echo "selected=\"selected\"" ?>>Yes</option>
         <option value="No" <?php if(($_POST["str_Data4"] || $data[0]['Data4'])) echo "selected=\"selected\"" ?>>No</option>
       </select>
        </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type5'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data5" size="30" id="str_Data5" value="<?php echo $_POST["str_Data5"] ? $_POST["str_Data5"] : $data[0]['Data5'] ?>" /></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type6'] ?>:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_Data6" size="30" id="str_Data6" value="<?php echo $_POST["str_Data6"] ? $_POST["str_Data6"] : $data[0]['Data6'] ?>"/>
        </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type8'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap">
      <input type="text" class="required textbox" name="str_Data8" size="30" id="str_Data8" value="<?php echo $_POST["str_Data8"] ? $_POST["str_Data8"] : $data[0]['Data8'] ?>"/>
    </td>
    <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type7'] ?>:</td>
    <td width="30%" align="left">
     <input type="text" class="required textbox" name="str_Data7" size="30" id="str_Data7" value="<?php echo $_POST["str_Data7"] ? $_POST["str_Data7"] : $data[0]['Data7'] ?>"/>
    </td>
    </tr>
     <tr>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type9'] ?>:</td>
       <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data9" size="30" id="str_Data9" value="<?php echo $_POST["str_Data9"] ? $_POST["str_Data9"] : $data[0]['Data9'] ?>"/></td>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type10'] ?>:</td>
       <td width="30%" align="left"><input type="text" class="required textbox" name="str_Data10" size="30" id="str_Data10" value="<?php echo $_POST["str_Data10"] ? $_POST["str_Data10"] : $data[0]['Data10'] ?>"/></td>
     </tr>
      <tr>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type11'] ?>:</td>
       <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data11" size="30" id="str_Data11" value="<?php echo $_POST["str_Data11"] ? $_POST["str_Data11"] : $data[0]['Data11'] ?>"/></td>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type12'] ?>:</td>
       <td width="30%" align="left">
     <select name="str_Data12" id="str_Data12">
        <option value="" selected="selected">Select..</option>
       <?php
			
 foreach($cr as $key=>$valuecr){?>
<option value="<?php echo $valuecr['credit_name'];?>" <?php if(($_POST["str_Data12"] || $data[0]['Data12'])==$valuecr['credit_name']){echo "selected=\"selected\"";} ?>><?php echo $valuecr['credit_name'];?></option>
<?php }?>
        
        </select>
       </td>
     </tr>
      <tr>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type13'] ?>:</td>
       <td width="30%" align="left" nowrap="nowrap">
        <input type="text" class="required textbox" name="str_Data13" size="30" id="str_Data13" value="<?php echo $_POST["str_Data13"] ? $_POST["str_Data13"] : $data[0]['Data13'] ?>"/>
   
         </td>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type14'] ?>:</td>
       <td width="30%" align="left">
       <select name="str_Data14" id="str_Data14">
         <option value="" selected="selected">Select..</option>
         <option value="Eliminate monthly mortgage" <?php if(($_POST["str_Data14"] || $data[0]['Data14'])== "Eliminate monthly mortgage") echo "selected=\"selected\"" ?>>Eliminate monthly mortgage</option>
         <option value="Pay credit card bills" <?php if(($_POST["str_Data14"] || $data[0]['Data14'])== "Pay credit card bills") echo "selected=\"selected\"" ?>>Pay credit card bills</option>
         <option value="More money every month" <?php if(($_POST["str_Data14"] || $data[0]['Data14'])== "More money every month") echo "selected=\"selected\"" ?>>More money every month</option>
     
       </select>
       </td>
     </tr>
    
    
   
    </table>
    
    
    
     </fieldset>