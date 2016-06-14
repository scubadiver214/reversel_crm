<?php

$strQuery_s="select * from morgagetype";
$mtype=$sqli->get_selectData($strQuery_s);

$strQuery_cr="select * from  credit_rating";
$cr=$sqli->get_selectData($strQuery_cr);

$strQuery_cashout="select * from  cashout";
$cashout=$sqli->get_selectData($strQuery_cashout);
?>
<fieldset>
<input type="hidden" name="cmpcount" value="16" />
     <?php
	$strQuery1="select * from campaigns where cmp_id=4";
	$datacmp=$sqli->get_selectData($strQuery1); 
	?>
    <legend><?php echo $datacmp[0]['cmp_name'] ?></legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type1'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data1" size="30" id="str_Data1" value="<?php echo $data[0]['Data1']?>"/></td>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type2'] ?>:</td>
      <td align="left"> 
        <input type="text" class="required textbox" name="str_Data2" size="30" id="str_Data2" value="<?php echo $data[0]['Data2']?>"/>
        </td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type3'] ?>:</td>
      <td width="30%" align="left" nowrap="nowrap"><select name="str_Data3" id="str_Data3">
        <option value="" selected="selected">Select..</option>
       <?php
			
 foreach($mtype as $key=>$valuem){?>
<option value="<?php echo $valuem['mname'];?>" <?php if($data[0]['Data3']== $valuem['mname'] ) echo "selected=\"selected\"" ?>><?php echo $valuem['mname'];?></option>
<?php }?>
        
        </select></td>
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
      
      <select name="str_Data8" id="str_Data8">
        <option value="" selected="selected">Select..</option>
       <?php
			
 foreach($mtype as $key=>$valuem){?>
<option value="<?php echo $valuem['mname'];?>" <?php if($data[0]['Data8']== $valuem['mname'] ) echo "selected=\"selected\"" ?>><?php echo $valuem['mname'];?></option>
<?php }?>
        
        </select></td>
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
       <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data11" size="30" id="str_Data11" value="<?php echo $data[0]['Data11']?>"/></td>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type12'] ?>:</td>
       <td width="30%" align="left"><select name="str_Data12" id="str_Data12">
         <option value="" selected="selected">Select..</option>
         <option value="Yes" <?php if($data[0]['Data12']== "Yes") echo "selected=\"selected\"" ?>>Yes</option>
          <option value="No" <?php if($data[0]['Data12']== "No") echo "selected=\"selected\"" ?>>No</option>
       </select></td>
     </tr>
      <tr>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type13'] ?>:</td>
       <td width="30%" align="left" nowrap="nowrap">
       <select name="str_Data13" id="str_Data13">
       
         <option value="">Select..</option>
         <option value="Refinance" <?php if($data[0]['Data13']== "Refinance") echo "selected=\"selected\"" ?>>Refinance</option>
		<option value="Reverse" <?php if($data[0]['Data13']== "Reverse") echo "selected=\"selected\"" ?>>Reverse</option>
        </SELECT>
         </td>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type14'] ?>:</td>
       <td width="30%" align="left"><select name="str_Data14" id="str_Data14">
         <option value="" selected="selected">Select..</option>
         <?php
			
 foreach($cr as $key=>$valuecr){?>
         <option value="<?php echo $valuecr['credit_name'];?>" <?php if($data[0]['Data14']== $valuecr['credit_name']) echo "selected=\"selected\"" ?>><?php echo $valuecr['credit_name'];?></option>
         <?php }?>
       </select></td>
     </tr>
      <tr>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type15'] ?>:</td>
       <td width="30%" align="left" nowrap="nowrap"><input type="text" class="required textbox" name="str_Data15" size="30" id="str_Data15" value="<?php echo $data[0]['Data15']?>"/></td>
       <td width="20%" align="right" nowrap="nowrap"><?php echo $datacmp[0]['Type16'] ?>:</td>
       <td width="30%" align="left"><select name="str_Data16" id="str_Data16">
         <option value="" selected="selected">Select..</option>
         <?php
			
 foreach($cashout as $key=>$valuecash){?>
         <option value="<?php echo $valuecash['cashout_name'];?>" <?php if($data[0]['Data16']== $valuecash['cashout_name']) echo "selected=\"selected\"" ?>><?php echo $valuecash['cashout_name'];?></option>
         <?php }?>
       </select></td>
     </tr>
    
   
    </table>
     </fieldset>