<?php
/**
 * Msqli_access_result
 *
 * @version 1.1
 * @author Julie.D
 * @link http://www.phpclasses.org/browse/package/5770.html
 *
 */

 

class mysqli_access_result extends mysqli_result {

	public $fieldlist=array();
	protected static $option;
	public static $ErrorTrace=array();
	
	public function __construct($mysqli){
		try{
			require 'mysqli_config.php';
			if( ! is_object($mysqli) ){
				Throw new Mysqli_exception_param('1st parameter object',0,get_class($this),__FUNCTION__);
			}
			parent::__construct($mysqli);		
		} catch(Mysqli_exception_param $e) {
			Mysqli_access::handle_exception($e);
			return false;
		}
	}
	
	/*Field_list
		 * @ Argument : $metadata : object.
		 * @ Return fields name of the table as an array 
		 */
	public function Fields_list($metadata){
		try{
			if( !is_object($metadata) ){
				Throw new Mysqli_exception_param('1st argument object',0,get_class($this),__FUNCTION__);
			}
			$finfo=$metadata->fetch_fields();
			foreach ($finfo as $val) {
				$this->fieldlist[]=$val->name;	
			}
			return $this->fieldlist;
		} catch(Mysqli_exception_param $e) {
			Mysqli_access::handle_exception($e);
			return false;
		}
	}

}
?>