<?php include("_session.php"); ?><?php
include("_dataAccess.php");
$strQuery1 ="Select * from disposition where 1";
$data=$sqli->get_selectData($strQuery1);

?>
<?php include("includes/header.php"); ?>
 <div class="main_content">
<div class="menu">
  <?php include("includes/menu.php"); ?>
</div> 
                    
                    
                    
                    
    <div class="center_content">
      <div class="right_content">            
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>Disposition List</h2></td>
    <td align="right"><a href="disposition.php"><img src="images/add-details.png" alt="" title="Add New" border="0" /></a></td>
  </tr>
</table>
        
         <table id="rounded-corner" summary="List of Admin">
    <thead>
    	<tr>
        	<th nowrap="nowrap" class="rounded-company" scope="col"></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong> Id</strong></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Name</strong></th>
            <th nowrap="nowrap" class="rounded" scope="col"><strong>Edit</strong></th>
			<th nowrap="nowrap" class="rounded" scope="col"><strong>View</strong></th>
           
			
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="8" class="rounded-foot-left">
          <!--  <div class="pagination">
        	  <span class="disabled"><< prev</span><span class="current">1</span><a href="">101</a><a href="">next >></a>
      	  </div>-->
          </td>
        	</tr>
    </tfoot>
    <tbody>
    	 <?php foreach($data as $key=>$row) {
						?>
      	<tr>
        	<td ><input type="checkbox" name="" /></td>
            <td class="centedtd"><?php echo $row['dispid']; ?></td>
            <td class="centedtd"><?php echo $row['dispname']; ?></td>
            <td class="centedtd"><a href="update_disposition.php?disID=<?PHP echo $row['dispid']; ?>"><img src="images/user_edit.png" alt="" title="Edit" border="0" /></a> </td>
            <td class="centedtd"><a href="view_disposition.php?disID=<?PHP echo $row['dispid']; ?>"><img src="images/user_edit.png" alt="" title="View" border="0" /></a></td>
          
        </tr>    
         <?php }  ?>
    </tbody>
</table>
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>
   