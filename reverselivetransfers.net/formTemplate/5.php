<?php

$strQuery_s="select * from emp_status";
$emp_status=$sqli->get_selectData($strQuery_s);


?>
<fieldset>
<input type="hidden" name="cmpcount" value="10" />
     <?php
	$strQuery1="select * from campaigns where cmp_id=5";
	$datacmp=$sqli->get_selectData($strQuery1); 
	?>
  <legend><?php echo $datacmp[0]['cmp_name'] ?></legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type1'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data1" size="30" id="str_Data1" value="<?php echo $data[0]['Data1']?>"/></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type2'] ?>:</td>
      <td align="left"><select name="str_Data2" id="str_Data2">
        <option value="">Select..</option>
        <option value="Current" <?php if($data[0]['Data2']== "Current") echo "selected=\"selected\"" ?>>Current</option>
          <option value="Behind" <?php if($data[0]['Data2']== "Behind") echo "selected=\"selected\"" ?>>Behind</option>
          
      </select></td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type3'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><select name="str_Data3" id="str_Data3">
        <option value="">Select..</option>
        <option value="Unknown" <?php if($data[0]['Data3']== "Unknown") echo "selected=\"selected\"" ?>>Unknown</option>
        <option value="Yes" <?php if($data[0]['Data3']== "Yes") echo "selected=\"selected\"" ?>>Yes</option>
        <option value="No" <?php if($data[0]['Data3']== "No") echo "selected=\"selected\"" ?>>No</option>
      </select></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type4'] ?>:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_Data4" size="30" id="str_Data4" value="<?php echo $data[0]['Data4']?>"/>
        </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type5'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data5" size="30" id="str_Data5" value="<?php echo $data[0]['Data5']?>"/></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type6'] ?>:</td>
      <td width="30%" align="left"><select name="str_Data6" id="str_Data6">
        <option value="">Select..</option>
        <option value="IRS" <?php if($data[0]['Data6']== "IRS") echo "selected=\"selected\"" ?>>IRS</option>
        <option value="State" <?php if($data[0]['Data6']== "State") echo "selected=\"selected\"" ?>>State</option>
        <option value="Both" <?php if($data[0]['Data6']== "Both") echo "selected=\"selected\"" ?>>Both</option>
      </select></td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type8'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap">
      
      <select name="str_Data8" id="str_Data8">
        <option value="" selected="selected">Select..</option>
       <?php
			
 foreach($emp_status as $key=>$valuem){?>
<option value="<?php echo $valuem['s_name'];?>" <?php if($data[0]['Data8']== $valuem['s_name']) echo "selected=\"selected\"" ?>><?php echo $valuem['s_name'];?></option>
<?php }?>
        
        </select></td>
    <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type7'] ?>:</td>
    <td width="30%" align="left">
     <input type="text" class="required textbox" name="str_Data7" size="30" id="str_Data7" value="<?php echo $data[0]['Data7']?>"/>
    </td>
    </tr>
     <tr>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type9'] ?>:</td>
       <td width="30%" align="left" nowrap="nowrap"><select name="str_Data9" id="str_Data9">
         <option value="">Select..</option>
         <option value="Unknown" <?php if($data[0]['Data9']== "Unknown") echo "selected=\"selected\"" ?>>Unknown</option>
        <option value="Yes" <?php if($data[0]['Data9']== "Yes") echo "selected=\"selected\"" ?>>Yes</option>
        <option value="No" <?php if($data[0]['Data9']== "No") echo "selected=\"selected\"" ?>>No</option>
       </select></td>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type10'] ?>:</td>
       <td width="30%" align="left"><input type="text" class="required textbox" name="str_Data10" size="30" id="str_Data10" value="<?php echo $data[0]['Data10']?>"/></td>
     </tr>
    
   
    </table>
     </fieldset>