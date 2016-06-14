<?php
/**
 * BuildQueryString
 *
 * @version 1
 * @author Julie.D
 * @link http://www.phpclasses.org/browse/package/5770.html
 */
 
Class BuildQueryString{
	
	public static $table;			//tablename to create strings
	public static $param_array;		//param_array to return for bind_param
	public static $ErrorTrace=array();
	
	public function __construct($table_name){
		self::$table=$table_name;
		self::$param_array =array();
	}
	
	/*Build SELECT values_str
		* The string is build for the table this->table which has to be define.
		*	@Arguments : are all optional
		*		$fields   	: string or array
		*		$wherearray : array
		*		$group 		: string
		*		$sort 		: string or array
		*		$limit		: string
		* @ Return string 
		*		For exemple : 'SELECT * FROM table'
		*					: 'SELECT field1 FROM table WHERE field1=?' 
		*/					
	 public static function Get_select($fields=null,$wherearray=null,$group=null,$sort=null,$limit=null) {
			$field_str = ( is_null($fields) ) ? '*' : self::Get_fields($fields);
			self::$param_array=array();																	
		
			if( !is_null($wherearray) ) {
				$where_str=self::Get_where($wherearray); 	
			}else $where_str=null;
			if( ! is_null($group) )	{																	
				$group_str=" GROUP BY $group ";
			} else $group_str=null;
			if( !is_null($sort) ) {																		
				$sort_str=self::Get_sort($sort);
			} else $sort_str=null;
			if (! is_null($limit) && is_numeric($limit) ) {												
				$limit= " LIMIT " . $limit;
			}	else $limit_str=null;
			if( $field_str === false || $where_str === false || $group_str=== false || $sort_str=== false || $limit_str=== false ){
				return false;
			} else {
				$query='SELECT '.$field_str.' FROM ' .self::$table.$where_str.$group_str.$sort_str.$limit_str;
				return $query;
			}
	}
	
	/*Build INSERT string
		* The string is build for the table this->table which has to be define.
		* @ Argument	:	$values	: array
		* @ Populate self::$param_array
		* @ Return string 
		*		For exemple : 'INSERT into table VALUES (?,?,?)
		*		
	*/					
	public static function Get_insert($fields,$values) {
		
		try{
			if( ! is_array($values) ) {
				Throw new Mysqli_exception_param('1st parameter array',null,get_class($this),__FUNCTION__);
				
			} else {
				$values_str=NULL;
				self::$param_array=array();	
				$values_str=self::Get_fields($values,false,true);
				$query='INSERT INTO '. self::$table.'('.implode($fields,",").') VALUES ('.$values_str.')';
				return $query;	
			}
		} catch(Mysqli_exception_param $e) {
			Mysqli_access::handle_exception($e);
			return false;
		}
	}
	
	/*Build UPDATE string
		* The string is build for the table this->table which has to be define.
		* @ Arguments  	: $values 		: string or array 
		*				: $fields 		: string or array 
		*						  		: has to be as $values type,
		*					 	  		: if is null get_table_fields()
		*				: $wherearray 	: array
		* @ Populate self::$param_array
		* @ Return string 
		*		For exemple : 'UPDATE table SET $field1=?,$field2=? WHERE $field1=?
	*/				
	public static function Get_update($values,$fields,$wherearray){
		try{
			self::$param_array=array();	
			if( is_null($fields) ){
				$sqli=new Mysqli_access();
				$fields=$sqli->Get_table_fields(self::$table);
				$sqli->close();
				unset($sqli);
			} 
			if ( is_array($fields) || is_array($values) ){
				if( ! is_array($fields) ) {
						Throw new Mysqli_exception_param('1st parameter array',null,get_class($this),__FUNCTION__);
				}
				if( ! is_array($values) ) {
						Throw new Mysqli_exception_param('2nd parameter array',null,get_class($this),__FUNCTION__);
				}
				if( count($values) != count($fields) ){
					Throw new Mysqli_exception_param('$values and $fields arguments count are different',6,get_class($this),__FUNCTION__);
				} else{
					$values_str=self::Get_fields($fields,$values,false);
				}
			} else{
				$values_str=$fields .'=?';
				self::$param_array[]=$values;
			}
			$where_str=self::Get_where($wherearray);
			$query= 'UPDATE '.self::$table.' SET '.$values_str.$where_str ;
			return $query;
		} catch(Mysqli_exception_param $e) {
			Mysqli_access::handle_exception($e);
			return false;
		}
	}
	
	
	/*Build DELETE string
		* The string is build for the table this->table which has to be define.
		* @ Arguments  	: $wherearray 	: array
		* @ Populate self::$param_array
		* @ Return string 
		*		For exemple : 'DELETE FROM table WHERE $field1=?'
	*/	
	public static function Get_delete($wherearray) {
		self::$param_array=array();
		$where_str=self::Get_where($wherearray);
		$query='DELETE FROM '.self::$table. $where_str;
		
		return $query;
	}
	
	/*Build Field String (to use with get_select)
		* @ Arguments: $fields	 :	 string or array
		*				 	For Exemple	:	$fields=$field1
		*								:	$fields=array($filed1,$filed2, .......)
		*   Optionals:	$values or $bind  Thus populate self::$param_array
		*			 : 	$values  :	array or string 	[ $bind has to be false ]
		*			 : 	$bind 	 : 	boleen true of false
		* @ Return field string as : '$field1,$field2,... '
		*							: if $values : '$field1=?','$field2=?' 
		*							: if $bind   :	'?,?'					
	*/	
	public static function Get_fields($fields,$values=false,$bind=false) {
		$field_str=NULL;
		if( is_array($fields) )	{				
			foreach($fields as $key=>$field) {	
				if( is_null($field_str) ) {
					$field_str = ( $bind ) ? '?' :"$field"; 
				}else{
					$field_str .= ( $bind ) ? ', ?' :", $field"; 
				}
				if($values){
					$field_str .= '=?'; 
					self::$param_array[]=$values[$key];
				} else{
					self::$param_array[]=$field;
				}
			}
		} elseif( is_string($fields) ) {	
			$field_str = $fields; 		
			if( $values ){
				$field_str = $fields . '=?'; 
				self::$param_array[]=$values;
			}
		}	
		return $field_str;
	}
	
	
	
	/*Build WHERE string
		* @Argument : $wherearray :	 Array 
		* 					For Exemple :	$wherearray[$field1]=$value1;
		*  								:	$wherearray=array( $field1=>$value1, $field2=>$value2)
		* @ Populate self::$param_array	as 	: self::$param_array=($value1,$value2);		 
		* @ Return Where string as : 'Where $field1= ? AND $field1= ?'	
	 */	
	public static function Get_where($wherearray) {										
		try{
			if( ! is_array($wherearray) ) {	
				Throw new Mysqli_exception_param('1st parameter array',null,get_class($this),__FUNCTION__);
				return false;		
			} else {
				$where_str=NULL;
				foreach($wherearray as $field=>$value) {
					if( is_null($where_str) ) {	
						$where_str =" WHERE $field=? ";
						self::$param_array[]=$value;
					} else {	
						$where_str .=" AND $field=? ";
						self::$param_array[]=$value;
					}
				}		
				return $where_str;
			}
		}catch(Mysqli_exception_param $e) {
			Mysqli_access::handle_exception($e);
			return false;
		}
	}
	
	/*Build SORT clause (to use with get_select)
		* @ Argument : $sort :	 string or array
		*					For Exemple :	$sort=$field;	
		*								:	$sort=array($filed1,$field2);
		*						->Can specify the order to sort as $order= 'DESC' or 'ASC'
		* 								:	$sort[$field1]=$order1;  
		*  								:	$sort=array( $field1=>$order1, $field2=>$order2)		
		* @ Return Sort string as 	: ' ORDER BY $field1'
		*							: ' ORDER BY $field1 $order1 ' 
	 */	
	public static function Get_sort($sort){
		$sort_str=NULL;
	
		if( is_array($sort) ) {												
			foreach($sort as $field=>$order) {	
				$field = ( is_numeric($field) ) ? NULL : $field;									
				if( is_null($sort_str) ) {															
					$sort_str= " ORDER BY $field $order "; 
				} else {
					$sort_str .= ", $field $order";
				}
			}
		} elseif( is_string($sort) ) {
			$sort_str = " ORDER BY $sort";
		}												
	return $sort_str;
	}
}


?>