<?php

$strQuery_cr="select * from  credit_rating";
$cr=$sqli->get_selectData($strQuery_cr);


?>
<fieldset>
<input type="hidden" name="cmpcount" value="6" />
     <?php
	$strQuery1="select * from campaigns where cmp_id=6";
	$datacmp=$sqli->get_selectData($strQuery1); 
	?>
  <legend><?php echo $datacmp[0]['cmp_name'] ?></legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type1'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data1" size="30" id="str_Data1" value="<?php echo $data[0]['Data1']?>"/></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type2'] ?>:</td>
      <td align="left"><input type="text" class="required textbox" name="str_Data2" size="30" id="str_Data2" value="<?php echo $data[0]['Data2']?>"/></td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type3'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><select name="str_Data3" id="str_Data3">
         <option value="" selected="selected">Select..</option>
         <?php
			
 foreach($cr as $key=>$valuecr){?>
         <option value="<?php echo $valuecr['credit_name'];?>" <?php if($data[0]['Data3']== $valuecr['credit_name']) echo "selected=\"selected\"" ?>><?php echo $valuecr['credit_name'];?></option>
         <?php }?>
       </select></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type4'] ?>:</td>
      <td width="30%" align="left">
<select name="str_Data4" id="str_Data4">
<option value="">Select..</option>
<OPTION value="Single Family" <?php if($data[0]['Data4']== "Single Family") echo "selected=\"selected\"" ?>>Single Family</OPTION>
<OPTION value="Multi-family 2 Unit" <?php if($data[0]['Data4']== "Multi-family 2 Unit") echo "selected=\"selected\"" ?>>Multi-family 2 Unit</OPTION>
<OPTION value="Multi-family 4 Unit" <?php if($data[0]['Data4']== "Multi-family 4 Unit") echo "selected=\"selected\"" ?>>Multi-family 4 Unit</OPTION>
<OPTION value="Town House" <?php if($data[0]['Data4']== "Town House") echo "selected=\"selected\"" ?>>Town House</OPTION>
<OPTION value="Condo" <?php if($data[0]['Data4']== "Condo") echo "selected=\"selected\"" ?>>Condo</OPTION>
<OPTION value="Manufactured" <?php if($data[0]['Data4']== "Manufactured") echo "selected=\"selected\"" ?>>Manufactured</OPTION>
<OPTION value="Mobile" <?php if($data[0]['Data4']== "Mobile") echo "selected=\"selected\"" ?>>Mobile</OPTION>

</select>        </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type5'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><select name="str_Data5" id="str_Data5">
        <option value="">Select..</option>
          <option value="Yes" <?php if($data[0]['Data5']== "Yes") echo "selected=\"selected\"" ?>>Yes</option>
          <option value="No" <?php if($data[0]['Data5']== "No") echo "selected=\"selected\"" ?>>No</option>
    
      </select></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type6'] ?>:</td>
      <td width="30%" align="left"><select name="str_Data6" id="str_Data6">
        <option value="">Select..</option>
       <option value="Yes" <?php if($data[0]['Data6']== "Yes") echo "selected=\"selected\"" ?>>Yes</option>
          <option value="No" <?php if($data[0]['Data6']== "No") echo "selected=\"selected\"" ?>>No</option>
       
      </select></td>
    </tr>
    
   
    </table>
     </fieldset>