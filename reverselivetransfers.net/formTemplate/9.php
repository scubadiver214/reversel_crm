<?php

$strQuery_pv="select * from   pension_values";
$datapv=$sqli->get_selectData($strQuery_pv);

$strQuery_py="select * from  pension_years";
$datapy=$sqli->get_selectData($strQuery_py);

?>
<fieldset>
<input type="hidden" name="cmpcount" value="16" />
     <?php
	$strQuery1="select * from campaigns where cmp_id=9";
	$datacmp=$sqli->get_selectData($strQuery1); 
	?>
    
    
    <legend><?php echo $datacmp[0]['cmp_name'] ?></legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type1'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><select name="str_Data1" id="str_Data1">
      
        <option value="" selected="selected">Select..</option>
        <?php
			
 foreach($datapv as $key=>$valuepv){?>
        <option value="<?php echo $valuepv['amt_range'];?>" <?php if($data[0]['Data1']==$valuepv['amt_range']){echo "selected=\"selected\"";} ?>><?php echo $valuepv['amt_range'];?></option>
        <?php }?>
      </select></td>
      
      
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type2'] ?>:</td>
      <td align="left"> 
       <select name="str_Data2" id="str_Data2">
      
        <option value="" selected="selected">Select..</option>
        <?php
			
 foreach($datapy as $key=>$valuepy){?>
        <option value="<?php echo $valuepy['py_value'];?>" <?php if($data[0]['Data2']==$valuepy['py_value']){echo "selected=\"selected\"";} ?>><?php echo $valuepy['py_value'];?></option>
        <?php }?>
      </select>
        </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type3'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data3" size="30" id="str_Data4" value="<?php echo $data[0]['Data3']?>"/></td>
      
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type4'] ?>:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_Data4" size="30" id="str_Data4" value="<?php echo $data[0]['Data4']?>"/>
        </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type5'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data5" size="30" id="str_Data5" value="<?php echo $data[0]['Data5']?>"/></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type6'] ?>:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_Data6" size="30" id="str_Data6" value="<?php echo $data[0]['Data6']?>"/>
        </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type8'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap">
      
      <input type="text" class="required textbox" name="str_Data8" size="30" id="str_Data8" value="<?php echo $data[0]['Data8']?>"/></td>
    <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type7'] ?>:</td>
    <td width="30%" align="left">
     <input type="text" class="required textbox" name="str_Data7" size="30" id="str_Data7" value="<?php echo $data[0]['Data7']?>"/>
    </td>
    </tr>
     <tr>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type9'] ?>:</td>
       <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data9" size="30" id="str_Data9" value="<?php echo $data[0]['Data9']?>"/></td>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type10'] ?>:</td>
       <td width="30%" align="left"><input type="text" class="required textbox" name="str_Data10" size="30" id="str_Data10" value="<?php echo $data[0]['Data10']?>"/></td>
     </tr>
      <tr>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type11'] ?>:</td>
       <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data11" size="30" id="strlast_edit_date_to" value="<?php echo $data[0]['Data11']?>"/></td>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type12'] ?>:</td>
       <td width="30%" align="left"><input type="text" class="required textbox" name="str_Data12" size="30" value="<?php echo $data[0]['Data12']?>"/>

</td>
     </tr>
      <tr>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type13'] ?>:</td>
       <td width="30%" align="left" nowrap="nowrap">
       
         <input type="text" class="required textbox" name="str_Data13" size="30" id="strlast_edit_date_from" value="<?php echo $data[0]['Data13']?>"/></td>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type14'] ?>:</td>
       <td width="30%" align="left"><input type="text" class="required textbox" name="str_Data14" size="30" id="str_Data14" value="<?php echo $data[0]['Data14']?>"/></td>
     </tr>
      <tr>
        <td align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type15'] ?></td>
        <td align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data15" size="30" id="str_Data15" value="<?php echo $data[0]['Data15']?>"/></td>
        <td align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type16'] ?></td>
        <td align="left"> <select name="str_Data16" id="str_Data16">
      
        <option value="" selected="selected">Select..</option>
         <option value="PB" <?php if($data[0]['Data16']== "PB") echo "selected=\"selected\"" ?>>PB</option>
          <option value="Others" <?php if($data[0]['Data16']== "Others") echo "selected=\"selected\"" ?>>Others..</option>
        </select>
       </td>
      </tr>
    </table>
    
    
    
     </fieldset>