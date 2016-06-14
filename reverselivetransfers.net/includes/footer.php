 <div class="footer">
    
    	<div class="left_footer">&copy; <?php echo date("Y"); ?>  <?php echo $footer; ?></div>
    	<div class="right_footer"></div>
    
    </div>

</div>		
</body>

</html>
<?php  $sqli->close();unset($sqli); ?>
<?php $_SESSION['message'] = array();
$_SESSION['errmessage'] = array(); ?>