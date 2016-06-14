<?php

$strQuery_s="select * from emp_status";
$status=$sqli->get_selectData($strQuery_s);
?>


<fieldset>
<input type="hidden" name="cmpcount" value="9" />
     <?php
	$strQuery1="select * from campaigns where cmp_id=2";
	$datacmp=$sqli->get_selectData($strQuery1); 
	?>
    <legend><?php echo $datacmp[0]['cmp_name'] ?></legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type1'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data1" size="30" id="str_Data1" value="<?php echo $data[0]['Data1']?>"/></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type2'] ?>:</td>
      <td align="left"> 
        <select name="str_Data2" id="str_Data2">
          <option value="" selected="selected">Select..</option>
          <option value="Yes" <?php if($data[0]['Data2']== "Yes") echo "selected=\"selected\"" ?>>Yes</option>
          <option value="No" <?php if($data[0]['Data2']== "No") echo "selected=\"selected\"" ?>>No</option>
          </select>
        </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type3'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data3" size="30" id="str_Data3" value="<?php echo $data[0]['Data3']?>"/> </td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type4'] ?>:</td>
      <td width="30%" align="left">
      <select name="str_Data4" id="str_Data4">
         <option value="" selected="selected">Select..</option>
        
          <option value="Current" <?php if($data[0]['Data4']== "Current") echo "selected=\"selected\"" ?>>Current</option>
          <option value="Behind" <?php if($data[0]['Data4']== "Behind") echo "selected=\"selected\"" ?>>Behind</option>
       </select>
        </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type5'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data5" size="30" id="str_Data5" value="<?php echo $data[0]['Data5']?>"/></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type6'] ?>:</td>
      <td width="30%" align="left">
        <select name="str_Data6" id="str_Data6">
          <option value="" selected="selected">Select..</option>
         	<?php
			
 foreach($status as $key=>$values){?>
<option value="<?php echo $values['s_id'];?>" <?php if($data[0]['Data6']== $values['s_id'] ) echo "selected=\"selected\"" ?>><?php echo $values['s_name'];?></option>
<?php }?>
          </select>
        </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type8'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data8" size="30" id="str_Data8" value="<?php echo $data[0]['Data8']?>"/></td>
    <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type7'] ?>:</td>
    <td width="30%" align="left"><input type="text" class="required textbox" name="str_Data7" size="30" id="str_Data7" value="<?php echo $data[0]['Data7']?>"/>
    </td>
    </tr>
     <tr>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type9'] ?>:</td>
       <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data9" size="30" id="str_Data9" value="<?php echo $data[0]['Data9']?>"/></td>
       <td width="20%" align="right" nowrap="nowrap">&nbsp;</td>
       <td width="30%" align="left"></td>
     </tr>
    
   
    </table>
     </fieldset>