<?php include("includes/header.php"); ?>
 <div class="main_content">
                  <div class="menu">
                   <?php include("includes/menu.php"); ?>
                    </div> 
                    <div class="center_content">
      <div class="right_content">            
        
        <h2>Changed Password</h2>
        
        <div class="form">
          <form action="regConfirm.php" method="post" class="">
  <fieldset>
    <legend>Changed Password</legend>
    <table border="0" align="center" cellpadding="2" cellspacing="3" width="600">
      <tr>
        <td>Old Password </td>
        <td><input name="Old Password" type="name" size="25" maxlength="20" /></td>
        </tr>
      <tr>
        <td>New Password</td>
        <td><input name="New Password" type="password" size="25" maxlength="20"></td>
        </tr>
      <tr>
        <td>Confrim Password</td>
        <td><input name="Confrim Password" type="password" size="25" maxlength="20" /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="Update" id="Update" value="Update"/></td>
      </tr>
      
    </table>
  </fieldset>
          </form>
        </div>  
        
        
      </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    <?php include("includes/footer.php"); ?>