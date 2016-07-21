<?php 
include("_session.php");
include("_dataAccess.php");
$strQuery1 ="Select * from script where 1";
$data=$sqli->get_selectData($strQuery1);

 include("includes/header.php"); ?>
 <div class="main_content">
<div class="menu">
  <?php include("includes/menu.php"); ?>
</div> 
                    
                    
                    
                    
    <div class="center_content">
      <div class="right_content">            
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>Script List</h2></td>
    <td align="right"><a href="script.php"><img src="images/add-details.png" alt="" title="Add New" border="0" /></a></td>
  </tr>
</table>
        
         <table id="rounded-corner" summary="List of Admin">
    <thead>
    	<tr>
        	<th nowrap="nowrap" class="rounded-company" scope="col"></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Sr. No.</strong></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Campaign Name</strong></th>
			<th nowrap="nowrap" class="rounded" scope="col"><strong>Client Name</strong></th>
         
            
           
			
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="7" class="rounded-foot-left"><div class="pagination">
        	  <span class="disabled"><< prev</span><span class="current">1</span><a href="">101</a><a href="">next >></a>
      	  </div></td>
        	</tr>
    </tfoot>
    <tbody>
    	 <?php $i=1; foreach($data as $key=>$row) {
						?>
      	<tr>
        	<td ><input type="checkbox" name="" /></td>
            <td class="centedtd"><?php echo $i;$i++ ?></td>
         
             <td class="centedtd">
			 <?php 
				 $strQuery3 ="Select * from campaigns where cmp_id='".$row['cmpid']."'";
				$datacamp=$sqli->get_selectData($strQuery3);
				 echo $datacamp[0]['cmp_name']; ?></td>
               <td class="centedtd">
			   <?php
			    $strQuery2 ="Select * from client_user where cltid='".$row['cltid']."'";
				$datacenter=$sqli->get_selectData($strQuery2); 
				echo $datacenter[0]['clt_comp'];
				 ?></td>
          
             
          
        </tr>    
         <?php }  ?>
    </tbody>
</table>
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>
   