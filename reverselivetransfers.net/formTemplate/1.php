<fieldset>
<input type="hidden" name="cmpcount" value="11" />
     <?php
	$strQuery1="select * from campaigns where cmp_id=1";
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
      <td width="30%" align="left" nowrap="nowrap"><select name="str_Data3" id="str_Data3">
        <option value="" selected="selected">Select..</option>
       <?php for($i=0;$i<=20;$i++) {?> 
       <option value="<?php echo $i; ?>"<?php if($data[0]['Data3']== "$i") echo "selected=\"selected\"" ?>><?php echo $i; ?> Years</option>
        <?php } ?>
        
        
      
        </select></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type4'] ?>:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_Data4" size="30" id="str_Data4" value="<?php echo $data[0]['Data4']?>"/>
        </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type5'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data5" size="30" id="str_Data5" value="<?php echo $data[0]['Data5']?>"/></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type6'] ?>:</td>
      <td width="30%" align="left">
        <select name="str_Data6" id="str_Data6">
          <option value="" selected="selected">Select..</option>
          <option value="Yes" <?php if($data[0]['Data6']== "Yes") echo "selected=\"selected\"" ?>>Yes</option>
          <option value="No" <?php if($data[0]['Data6']== "No") echo "selected=\"selected\"" ?>>No</option>
          </select>
        </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type8'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data8" size="30" id="str_Data8" value="<?php echo $data[0]['Data8']?>"/></td>
    <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type7'] ?>:</td>
    <td width="30%" align="left">
     <select name="str_Data7" id="str_Data7">
	<option value="" selected="selected">Select..</option>
	 <option value="Yes" <?php if($data[0]['Data7']== "Yes") echo "selected=\"selected\"" ?>>Yes</option>
          <option value="No" <?php if($data[0]['Data7']== "No") echo "selected=\"selected\"" ?>>No</option>
    </select>
    </td>
    </tr>
     <tr>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type9'] ?>:</td>
       <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data9" size="30" id="str_Data9" value="<?php echo $data[0]['Data9']?>"/></td>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type10'] ?>:</td>
       <td width="30%" align="left"><select name="str_Data10" id="str_Data10">
         <option value="" selected="selected">Select..</option>
         <option value="Yes" <?php if($data[0]['Data10']== "Yes") echo "selected=\"selected\"" ?>>Yes</option>
          <option value="No" <?php if($data[0]['Data10']== "No") echo "selected=\"selected\"" ?>>No</option>
       </select></td>
     </tr>
     <tr>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type11'] ?>:</td>
       <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data11" size="30" id="str_Data11" value="<?php echo $data[0]['Data11']?>"/></td>
       <td width="20%" align="right" nowrap="nowrap">&nbsp;</td>
       <td width="30%" align="left">&nbsp;</td>
     </tr>
   
    </table>
     </fieldset>