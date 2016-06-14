<?php 
error_reporting(0);
/**
 * Msqli_access
 *
 * @version 1.1
 * @author Julie.D
 * @link http://www.phpclasses.org/browse/package/5770.html
 *
 *	TODO: return affected_rows for inser, update, delete data;
 */


require 'mysqli_stmt_class.php';
require 'mysqli_result_class.php';
require 'build_query_string_class.php';
require 'mysqli_exception_class.php';


class mysqli_access extends mysqli{

	protected static $option=array();			//config options
	protected $login=array();			//config login

	public $table=null;					//to declare in script $object->table='tablename';
	public $fieldlist=array();			//list of field names of $this->table

	private $last_query;				//to hold the last query
	
	private $stmt; 						//new object of class msqli_access_stmt
	private $result;					//new object of class mysqli_access_result
	
	private $param_array=array(); 		//to create $param_array to bind parametre

	public $num_rows;
	public $insert_id;
	
	public static $ErrorTrace=array();
	
	/*__construct
		* @	Set class properties  : $host
		*						  : $user
		*						  : $pass
	*/	
	public function __construct($login=null,$option=null) {
		
		require 'mysqli_config.php';
		if( is_array( $login ) ) {
			foreach( $login as $key=>$value ) {
				$this->login[$key]=$value;
			}
		}
		if( is_array( $option ) ) {
			foreach( $option as $key=>$value ) {
				self::$option[$key]=$value;
			}
		}
		if( self::$option['AUTOCONNECT'] === true ) {
				$this->connect($this->login['DATABASE']);
		}
	}


	/* Connect to the database
		* @	Argument 	: $db : database name	
		* @ Connect 	: parent function __construct.
		*/		
	public function connect($db=null){
		try{
			if( is_null($db) ){
				Throw new mysqli_exception_config('Database not set',null,get_class($this),__FUNCTION__ );
			} else {
					 parent::connect($this->login['HOST'], $this->login['USER'],$this->login['PASSWORD'], $db); 
				if( $this -> connect_error ) {
					Throw new Mysqli_exception_connect($this->connect_error, $this->connect_errno,__FUNCTION__);
				} else return true;
			} 
		}
		catch(Mysqli_exception_config $e) {
			self::handle_exception($e);
			return false;
		}catch(Mysqli_exception_connect $e) {
			self::handle_exception($e);
			return false;
		}
	}	
	
	/* handle exceptions : 
		* @Argument  : $e :object of exception class
		* if $this->option['SHOW_EXCEPTIONS'] = true 		it will display exceptions on screen
		*									  = false		it will keep trace of exception in an array
		* if $this->option['SHOW_EXCEPTIONS'] = true 		script will die when an exception is caught
		* trace of error when no
		*/
	
	
	public function handle_exception($e){
		if( self::$option['SHOW_EXCEPTIONS'] === true ){
			if(  self::$option['DIE_ON_EXCEPTION'] === true ){
				die( $e->__tostring() );
			}
			else echo $e->__tostring();
		} else {
			$error_message=$this->option['ERROR_MESSAGE'];
			echo $error_message;
			self::$ErrorTrace[]=array	( 	'date'	=> date('d/m/y H:i:s'),
											'num'	=> $e->getCode(),
										 	'msg'	=> $e->getMessage(),
											'class'	=> $e->_class,
											'func'	=> $e->_methode
										);
										
			if(  self::$option['DIE_ON_EXCEPTION'] === true ){
				die();
			}
		}
	}
	
	/* set_table
		* if $this->table is null and $this->login['TABLE'] it will trigger an error.
		* if $this->table is null it will set teh table to select to $this->login['TABLE']
		* @ Return true if $this->table is set.									 
		*/
	
	public function set_table(){
		try{
			if( ! is_null($this->table) ){
				return true;
			} elseif( ! $this->login['TABLE'] === false ) {
					$this->table=$this->login['TABLE'];
					return true;
				  
			}else {
				throw new Mysqli_exception_config('You did not set $table property',0,get_class($this),__FUNCTION__);
			}
		}catch(Mysqli_exception_config $e) {
			self::handle_exception($e);
			return false;
		}
	}
	
	/*Get_Data from $this->table
		* Has to have $line as get_data(__LINE__) to trigger error.
		* Arguments are optionals
		*		$fields   	: to build field clause 
		*		$wherearray : to build WHERE clause 
		*		$group 		: to build GROUP BY clause
		*		$sort 		: to build ORDER BY clause
		*		$limit		: to build LIMIT clause
		* @ BuildQueryString
		* @ Prepare, Bind_param, Execute
		* @ Use function fetch() of class mysql_access_stmt
		* @ Return data as an array
	*/
	function get_data($fields=null,$wherearray=null,$group=null,$sort=null,$limit=null) {
	
		if( $this->set_table() === false){
			return false;	
		}
		BuildQueryString::$table=$this->table;
		$query=BuildQueryString::Get_select($fields,$wherearray,$group,$sort,$limit);
		$this->param_array=BuildQueryString::$param_array;
		
		if ( $query === false ) {
			return false;
		}
		if ( $this->prep_bind_execute($query,$this->param_array) === false ) {
			return false;
		} else {
			$data = $this->stmt->fetch();
			if(  $data === false ) {
				return false;
			} else {
					$this->num_rows=$this->stmt->num_rows;
					$this->stmt->close();
					unset($this->stmt);
					return $data;
			}
		}
	}
		
	function get_selectData($query) {
		$data=array();
	       if ($result = $this->query($query)) {

            /* fetch associative array */
            while ($row = $result->fetch_assoc()) {
             array_push($data,$row);
            }

             /* free result set */
            $result->free();
}
        return $data;
	}
	/*Insert_data into $this->table
		* @ Arguments 	: $values :	string or array : values to insert into the table 
		* @ BuildQueryString
		* @ Prepare, Bind_param, Execute
	*/	
	public function insert_data($fields,$values) {
		if( $this->set_table() === false){
			return false;	
		}
		BuildQueryString::$table=$this->table;
		$query=BuildQueryString::Get_insert($fields,$values);
		$this->param_array=BuildQueryString::$param_array;
		if ( $query === false ) { 
			return false;
		}
		if( $this->prep_bind_execute($query,$this->param_array) === false ) {
			return false;	
		} else {
			$insert_id= $this->stmt->insert_id;
			$this->stmt->close();
			unset($this->stmt);
			return true;
		}	
	}
	
	/*Update_data into $this->table
		* @ Arguments 	: $wherearray 	: array 
		*				: $values 		: string or array
		* 		Optional: $fields 		: has to be as $values type if not null
		* @ BuildQueryString
		* @ Prepare, Bind_param, Execute
	*/	
	public function update_data($wherearray,$values,$fields=null) {
		if( $this->set_table() === false){
			return false;	
		}
		BuildQueryString::$table=$this->table;
		$query=BuildQueryString::Get_update($values,$fields,$wherearray);
		$this->param_array=BuildQueryString::$param_array;
		
		if ( $query === false){
			return false;
		}
		if( ! $this->prep_bind_execute($query,$this->param_array) ) {
			return false;
		} else {
			$this->stmt->close();
			unset($this->stmt);
			return true;
		}	
	}
	
	/*Delete_data from $this->table
		* @ Arguments 	: $wherearray 	:  array
		* @ BuildQueryString
		* @ Prepare, Bind_param, Execute
	*/	
	public function delete_data($wherearray) {
		if( $this->set_table() === false){
			return false;	
		}
		BuildQueryString::$table=$this->table;
		$query=BuildQueryString::Get_delete($wherearray);
		$this->param_array=BuildQueryString::$param_array;
		if( $query === false ){
			return false;
		}
		if( ! $this->prep_bind_execute($query,$this->param_array) ) {
			return false;
		}else{
			$this->stmt->close();
			unset($this->stmt);
			return true;
		}
	}
	
	/*get fields names from $this->table
		* @ BuildQueryString
		* @ Prepare, Bind_param, Execute
		* @ Get result_metadata
		* @ create new object $this->result from the class mysqli_access_result
		* @ Use fetch_list() from $this->result
		* @ Return $this->fieldlist populated with fields names of $this->table 
	*/
	public function Get_table_fields($tablename=false){
		if( $tablename=== false ){
			$tablename=$this->table;
		}
		BuildQueryString::$table = $tablename;
		$query=BuildQueryString::Get_select();
		
		if( $query === false ) {
			return false;
		}
		if( ! $this->prep_bind_execute($query) ){
			return false;
		} 
		
		$metadata=$this->stmt->result_metadata();
		$this->stmt->close();
		unset($this->result);
			
		if( $metadata=== false) {
			return false;
		}
		$this->result=new mysqli_access_result($this);
		$this->fieldlist=$this->result->Fields_list($metadata);
		unset($this->result);
		if( $this->fieldlist === false){
			return false;
		}	else return $this->fieldlist;	
		
	}
	
	/*Prepare Bind execute statment
		* @ Arguments : $query : statement to be prepared.
		*			  : $param_array if got 1 argument or more bind_param()
		* @ Prepare, bind_param(), execute()
	*/		
	private function prep_bind_execute($query,$param_array=array()){
		
			if( $this->prepare($query) ) {
				if( count($param_array)>0 ) {
					$this->bind_param($param_array); 	
				}
				 $this->execute();
				return true;
			} else return false;
	}
	/*Prepare statment 
		* @ Argument : $query : statement to be prepared.
		* @ Create 	new object $this->stmt from class mysqli_stmt_access
		* 			Or Trigger Error 
		* @ return new object  $this->stmt
	*/		
	public function prepare($query){
	
		$this->last_query=$query;
		$this->stmt=new mysqli_access_stmt($this, $this->last_query );
			
		if( $this->stmt->error ) {
				unset($this->stmt);	
				return false;
		} else  return $this->stmt;
	}
	
	/*Bind parametres
		*  @ Argument : $param_array : array
		*	@ Use function bind_param of class mysqli_stmt_access 
	*/
	public function bind_param($param_array){
	
		try{
			if( ! is_array($param_array) ){
				Throw new Mysqli_exception_param('1st parameter array',null,get_class($this),__FUNCTION__);
			}
			if( ! $this->stmt->bind_param($param_array) ){
				Throw new Mysqli_exception_query('bind_param',null,get_class($this),__FUNCTION__,null,$this->last_query);
			} else return true;
		} catch(Mysqli_exception_param $e) {
			$this->handle_exception($e);
			return false;
		} catch(Mysqli_exception_query $e) {
			$this->handle_exception($e);
			return false;
		}
	}
	
	/*Execute
		*	@ Use function Execute of class mysqli_stmt_access
	*/
	public function execute(){
		Try {
			if( ! $this->stmt->execute() )	{
				Throw new Mysqli_exception_query('execute',null,get_class($this),__FUNCTION__,null,$this->last_query);
			} else return true;
		} catch(Mysqli_exception_query $e) {
			$this->handle_exception($e);
			return false;
		}
	}
}

?>