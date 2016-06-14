<?php
/**
 * Msqli_access_stmt
 *
 * @version 1.1
 * @author Julie.D
 * @link http://www.phpclasses.org/browse/package/5770.html
 *
 * TODO 	: function affected_rows();
 */



class mysqli_access_stmt extends mysqli_stmt{

	protected static $option=array();			//config options
	protected $login=array();			//config login
	
	public static $ErrorTrace=array();
	private $last_stmt;					//to hold last statement
	
	protected $data=array();			//store data to be returned as an array
	
	
	
	
	public function __construct($link, $stmt) {
		require 'mysqli_config.php';
		$this->last_stmt=$stmt;
		try{
			if	( ! is_object($link) ) {
				Throw new Mysqli_exception_param('1st parameter object',0,get_class($this),__FUNCTION__);
			}
			if	( ! is_string( $stmt) ){
				Throw new Mysqli_exception_param('1st parameter string',0,get_class($this),__FUNCTION__);
			}
			parent::__construct($link, $stmt) ;
			
			 if( $this->error ) {
				Throw new Mysqli_exception_query($this->error,$this->errno,get_class($this),__FUNCTION__,null,$this->last_stmt);
			 } else return true;
		}catch(Mysqli_exception_param $e) {
			Mysqli_access::handle_exception($e);
			unset($this);
			return false;
		}catch(Mysqli_exception_query $e) {
			Mysqli_access::handle_exception($e);
			unset($this);
			return false;
		}
		
	}
  
  
	/* GET_PARAM TYPES set the type string i.d or s
		* @ Argument : $param : string, integer, double or otehr
		* @ Redurn the type of the param as a string
		*/
		function Get_param_type($param){
			if( is_integer($param ) ){
				$type='i';
			} elseif( is_double($param) ){
				$type='d';
			} elseif( is_string($param) ){	
				$type='s'; 
			} else {
				$type='s';
			}
			return $type;
		}
	
	/* Get type string of param_array
		 * @ Arguments :$param_array accepts array
		 * @ Return a string with the type of each argument of the array
		 */
	
	function Get_type_string($param_array) {
		$type_str=NULL;
		try{
			if( ! is_array($param_array) ){
				Throw new Mysqli_exception_param('1st parameter array',null,get_class($this),__FUNCTION__);
			} else {
				foreach($param_array as $key=>$param){
					$type=self::Get_param_type($param);	
					if( is_null($type_str) ) {
						$type_str=$type;
					} else {
						$type_str .=$type;
					}
				}
				return $type_str;
		}
		}catch(Mysqli_exception_param $e) {
			Mysqli_access::handle_exception($e);
			return false;
		}
	}
  
	/* BIND_PARAM
		 * @ Argument : $param_array :  array 
		 * @ Bind_param()
		 */
	function bind_param($param_array){
		try{
			if( ! is_array($param_array) ){
				Throw new Mysqli_exception_param('1st parameter array',null,get_class($this),__FUNCTION__);
			} else {
				$bind_array=array();
				$type_str=self::Get_type_string($param_array);
				$bind_array[0]=$type_str;
					
				foreach($param_array as $key=>$param){
					$bind_array[]=&$param_array[$key];
				}
				if ( ! call_user_func_array('parent::bind_param',$bind_array)  )  {
				
					Throw new Mysqli_exception_query('bind_param',null,get_class($this),__FUNCTION__,null,$this->last_stmt);
				}
				return true;	
			}
		}catch(Mysqli_exception_param $e) {
			Mysqli_access::handle_exception($e);
			return false;
		}catch(Mysqli_exception_query $e) {
			Mysqli_access::handle_exception($e);
			return false;
		}
	}
	
	/* BIND RESULT
		* @ Argument :$field_array : array
		*/	

	function bind_result($field_array){
		try{
			if( ! is_array($field_array) ){
				Throw new Mysqli_exception_param('1st parameter array',null,__FUNCTION__);
			} elseif( ! call_user_func_array('parent::bind_result',$field_array) ) {
				Throw new Mysqli_exception_query('bind_result',null,get_class($this),__FUNCTION__,null,$this->last_stmt);
			}else return true;
		}catch(Mysqli_exception_param $e) {
			Mysqli_access::handle_exception($e);
			return false;
		}catch(Mysqli_exception_query $e) {
			Mysqli_access::handle_exception($e);
			return false;
		}
	}
 
	function execute() {
		try{
			parent::execute();
			if(  $this->error ) {
				Throw new Mysqli_exception_query($this->error ,$this->errno,get_class($this),__FUNCTION__,null,$this->last_stmt);
			} else return true;
		}catch(Mysqli_exception_query $e) {
				Mysqli_access::handle_exception($e);
				return false;
		}
 
	}
	
	function store_result() {
		try{
			parent::store_result();
			if( $this->error ) {
				Throw new Mysqli_exception_query($this->error ,$this->errno,get_class($this),__FUNCTION__,null,$this->last_stmt);
			} else return true;
		}catch(Mysqli_exception_query $e) {
			Mysqli_access::handle_exception($e);
			return false;
		}
	}
  
	/*FETCH
		 * Has to be use after 
		 *	mysqli->prepare, mysqli->bind_param , mysqli ->execute
		 *  @ parent Store results
		 *  @ bind results depending num of field 
		 *  @ access to properties  $this->field_count, $this->num_rows
		 *  @ parent fetch()
		 *  @ Return data as an array
		 */ 
	public function fetch(){
		
		if( ! $this->store_result() ) {
			return false;
		} 
		$result_set=array();
		for($i=0 ; $i<$this->field_count ;$i++  ) {
				$result_set[]=&$row[$i];
		}
		if( ! $this->bind_result($result_set) ) { 
				return false;
		} 
		for( $i=0 ; $i<$this->num_rows ; $i++) {
			parent::fetch() ;
			$temp=array();
			foreach( $result_set as $k=>$v ) {
				$temp[$k]=$v;
			}
			array_push($this->data,$temp);
		}
		return $this->data;
	}	
		
		
	public function result_metadata(){
		try{
			$metadata=parent::result_metadata();
			if( ! is_object($metadata) ){
				Throw new Mysqli_exception_query('Could not get metadata',null,get_class($this),__FUNCTION__);
			} else return $metadata;
		}catch(Mysqli_exception_query $e) {
			Mysqli_access::handle_exception($e);
			return false;
		}
	}
	
}
?>
