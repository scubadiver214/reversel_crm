<?php
error_reporting(0);
$title = 'Reverse Live Transfers';
$footer = 'Reverse Live Transfers';
require 'classes/mysqli_class.php';
if(!isset($_SESSION['message']))
 $_SESSION['message'] = array();
 if(!isset($_SESSION['errmessage']))
$_SESSION['errmessage'] = array();
/*login info  / options
	*	If set here will overight info set in mysqli_config.php
	*	can set database or not
		*/
	/* $login=array(	'HOST'=>'localhost',
						'USER'=>'root',
						'PASSWORD'=>'',
					); 
	*/
	/* $options=array(	'SHOW_EXCEPTIONS'=>true,
						'SHOW_MESSAGE'=> '<p>An error as occur </p>',
						'DIE_ON_EXCEPTION'=>false,
						'AUTOCONNECT'=>false,
					); 
	*/
						
	/* $sqli=new mysqli_access($login,$options); 
		$sqli->connect('db');
	*/
	
	include("classes/SqlPager.php");
	$sqli=new mysqli_access();
	include("classes/general.php");
    $general = new general($sqli);
	
	function generatePasswd($numAlpha=30,$numNonAlpha=30)
	{
	   $listAlpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	   $listNonAlpha = '$@.?$!';
	   return str_shuffle(
		  substr(str_shuffle($listAlpha),0,$numAlpha) .
		  substr(str_shuffle($listNonAlpha),0,$numNonAlpha)
		);
	}
	
	
	
/*	echo 'Connection Succeded... ' .$sqli->host_info .'<br />'; 


/*GET TABLE FIELDS
	*
	echo '<p><b> Get_Table fields </b></p>';
	
	$sqli->table='mytable';
	$sqli->Get_table_fields();
	$c=count($sqli->fieldlist);

	echo "<p> There is " .$c. " fields in the table '". $sqli->table ."' :</p>";
	
		foreach( $sqli->fieldlist as $key=>$field) {
			$field_num=$key+1;
			echo 'Field '.$field_num . ' : ' .$field . '<br />';
		}
		
/*GET_DATA
	* The following exemple is really general
	* It will get all the rowas of data from the table
	*	If you know the number of field on the table you are working on and the field you want to print just :
	*		foreach($data as $row){
	* 			echo $row['2'];
	*		}
	*
	* POSSIBLE SELECTION CRITERES
	*	
	*	$data=$sqli->Get_data(__LINE__,$field,$where,$group,$sort,$limit);
	* 	
	* 	To get specific field only try:
	*			 $field=$field1
	* 		 	$field=array($field1,$field3);
	*	To get specific rows try:
	* 			$where['field name']=value
	*			$where=array( 'field1 name'=>value, 'field3 name'=>value )
	*	To group try
	*			$group='field1';
	*	To sort try
	* 			$sort='field1'
	*			$sort=array('field1','field3')
	*	To specify the sorting order
	*			$sort['field1']='ASC'  
	*			$sort=array('field1'=>'ASC','field3'=>'DESC');
	*To put a limit
	*			$limit=(int)
	*
		
		echo '<p><b> Get_data  </b></p>';
		
		$field=null;
		$where['1']='1';
		
		$sqli->table='mytable';
		$data=$sqli->Get_data($field,$where);
	
		echo "<p> There is " .$sqli->num_rows. " row in the table '". $sqli->table ."'</p>";
		
			foreach($data as $key=>$row) {
				$row_num=$key+1;
				echo 'Row of data number '.$row_num . '<p>';
					for($i=0 ; $i<$c ; $i++){
		
						echo ' : ' . $row[$i] . ' <br />';
					}
				echo '</p>';
			} 
		 	


 /* INSERT DATA
	* This is just exemple of the syntax
	*
		$sqli->table='mytable';
		$fields = array('member_ID','title');
		$values=array('Sono','sdfdfgv');
		$sqli->autocommit(FALSE);
		$sqli->Insert_data($fields,$values);
		echo $sqli->insert_id;
		//$sqli->rollback();
		$sqli->commit();
 /* UPDATE DATA
	* This is just exemple of the syntax
	*
	*POSSIBLE Update arguments
	*	$where as to be array
	*		$where['field']='value;
	* To update all the fields of the table try :
	*		$fields=null; OR $fields=array(all fields);
	*		$values=(all values);
	* To update only certain fields
	*		$fields=array('field2','field3');
	*		$values=array('value1','value2');	
	*
	
	
		$sqli->table='tablename';
	 	$where['field']='value';	
		$values=array('value3','value2','value3','value4');
		$fields=null;
		$sqli->Update_data($where,$values,$fields); */
	 
 /* DELETE DATA
	* This is just exemple of the syntax
	* 	$where as to be array : $where['field']='value;
	*
	$sqli->table='tablename';
	$where['field']='value';
	$sqli->Delete_data($where); 
	*

$sqli->close();

unset($sqli);*/

?>