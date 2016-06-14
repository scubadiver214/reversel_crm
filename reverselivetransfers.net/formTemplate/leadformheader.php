<table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
 	  <!--part1-->
     <tr>
    <td>
     <fieldset>
     
   
     <input type="hidden" name="dd_dupeClient" value="<?php echo $_POST['dd_dupeClient']?>" />
     <input type="hidden" name="dd_dupeCamp" value="<?php echo $_POST['dd_dupeCamp'] ?>" />
     
    <legend>Personal details</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="100%">
	<tr>
    <td width="20%" align="right" nowrap="nowrap">First Name(Senior 1)<span class="err">*</span>:</td>
    <td width="30%" align="left"><select name="dd_Title" id="dd_Title" class="small-select">
      <option value="" selected="selected">Title</option>
      <option value="Mr">Mr</option>
      <option value="Mrs">Mrs</option>
      <option value="Miss">Miss</option>
      <option value="Ms">Ms</option>
      <option value="Dr">Dr</option>
      <option value="Prof">Prof</option>
    </select>
      <input type="text" class="small-textbox" name="str_FirstName" size="24" id="str_FirstName" /></td>
    <td width="20%" align="right" valign="top">Last Name(Senior 1)<span class="err">*:</span></td>
    <td width="30%" align="left" valign="top"><input type="text" class="required textbox" name="str_LastName" size="30" id="str_LastName"/></td>
    </tr>
    
    	<tr>
    <td width="20%" align="right" nowrap="nowrap">First Name(Senior 2)<span class="err">*</span>:</td>
    <td width="30%" align="left"><select name="dd_Title2" id="dd_Title" class="small-select">
      <option value="" selected="selected">Title</option>
      <option value="Mr">Mr</option>
      <option value="Mrs">Mrs</option>
      <option value="Miss">Miss</option>
      <option value="Ms">Ms</option>
      <option value="Dr">Dr</option>
      <option value="Prof">Prof</option>
    </select>
      <input type="text" class="small-textbox" name="str_FirstName2" size="24" id="str_FirstName" /></td>
    <td width="20%" align="right" valign="top">Last Name(Senior 2)<span class="err">*:</span></td>
    <td width="30%" align="left" valign="top"><input type="text" class="required textbox" name="str_LastName2" size="30" id="str_LastName"/></td>
    </tr>
     <tr>
      <td width="20%" align="right" nowrap="nowrap">Date of Birth(Senior 1)<span class="err">*</span>:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_dob1" size="30" id="datepicker" readonly="readonly" value="<?php echo $_POST['str_dob1']?>"/></td>
      <td width="20%" align="right" valign="top">Date of Birth(Senior 2):</td>
      <td width="30%" align="left" valign="top"><input type="text" class="required textbox" name="str_dob2" size="30" id="datepicker1"/></td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap">Phone Number<span class="err">*</span>:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_Telephone1" size="30" id="str_Telephone1" readonly="readonly" value="<?php echo $_POST['str_Telephone1']?>"/></td>
      <td width="20%" align="right" valign="top">Town/City:</td>
      <td width="30%" align="left" valign="top"><input type="text" class="required textbox" name="str_TownCity" size="30" id="str_TownCity"/></td>
    </tr>
    
    
    <tr>
      <td width="20%" align="right" nowrap="nowrap">Alternative Phone Number:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_Telephone2" size="30" id="str_Telephone2"/></td>
      <td width="20%" rowspan="2" align="right" valign="top">Property Address:</td>
      <td width="30%" rowspan="2" align="left" valign="top"><textarea name="str_Address" cols="33" rows="5" class="" id="str_Address"></textarea></td>
    </tr>
    <tr>
      <td width="20%" align="right" nowrap="nowrap">Email<span class="err">*</span>:</td>
      <td width="30%" align="left"><input type="text" class="required textbox" name="str_Email" size="30" id="str_Email"/></td>
      </tr>
     <tr>
       <td width="20%" align="right" nowrap="nowrap">State<span class="err">*</span>:</td>
       <td width="30%" align="left"><select name="dd_stateName" id="dd_stateName">
         <option value="" selected="selected">- Select -</option>
         <?php
	$strQuery14="select * from zone where country_id=223";
$datastate=$sqli->get_selectData($strQuery14); 
	
	 foreach($datastate as $key=>$valuestate){?>
         <option value="<?php echo $valuestate['zone_id'];?>"> <?php echo $valuestate['name'];?></option>
         <?php }?>
         </select></td>
       <td width="20%" align="right" valign="top">Zipcode:</td>
       <td width="30%" align="left" valign="top"><input type="text" class="required textbox" name="str_Postcode" size="30" id="str_Postcode"/></td>
     </tr>
     </table>
     </fieldset>
       
    </td>
 	 </tr>
     <!--part2-->
     
    <tr>
    <td>
     <?php include("formTemplate/".$_POST['dd_dupeCamp'].".php"); ?>
     
    </td>
 	</tr>
     <!--part3--> 
    <tr>
    <td>
     <?php include("formTemplate/leadformfooter.php"); ?>    
    </td>
 	</tr>
      <!--part4-->
      <tr>
    <td align="center"><input type="submit" name="submit" id="submit" value="Submit"/></td>
 	 </tr>
 
     </table>