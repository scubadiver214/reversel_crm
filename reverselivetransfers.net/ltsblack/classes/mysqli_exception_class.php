<?php
/**
 * Msqli_exception
 *
 * @version 1
 * @author Julie.D
 * @link http://www.phpclasses.org/browse/package/5770.html
 */

class Mysqli_exception extends Exception{
	
	public $_title;
	public $_class;
	public $_methode;
	public $_query;
	
	
		public function __construct($message,$code,$class='unknow',$methode='unknow',$title=null,$query=false){
		
			$this->_title   = $title;
			$this->_class   = $class;
			$this->_methode = $methode;
			$this->_query   = $query;
			
			$this->eLogPath['DIR']='logs';
			$this->eLogPath['FILE']='Mysqli_error';
			$this->eLogPath['EXTENSION']='.txt';
			
			parent::__construct($message,$code);
		}
		
		public function __tostring(){
			$str ='<p><b>' .$this->_title.'</b><br />';
			$str.='Class : ' .$this->_class. ' - Using Methode '.$this->_methode.'(). <br />';
			$str.='Error : ('.$this->getCode().') '.$this->getMessage().'. <br />';
			if($this->_query) {		
				$str.='Executing :' .$this->_query. '. <br />';
			}
	
			$str.='Script : '.$this->getFile().' - Line : '.$this->getLine().'. <br />';
			$str.= 'Trace :<br /> ';
			$str.=$this->Trace__tostring().' <br /></p>';
			
			return $str;
		}

		public function Trace__tostring(){
			
			$trace_array=$this->getTrace();
			$trace_str=null;
			foreach($trace_array as $trace) {
				$trace_str .=$trace['file']. ' - Line '.$trace['line'].'<br />';
				$trace_str .='Class ' .$trace['class'].'  - Using Methode ' .$trace['function'].'() <br />' ;
			}
			return $trace_str;
		}
}

class Mysqli_exception_connect extends Mysqli_exception {

	public function __construct($message,$code,$class='unknow',$methode='unknow',$title=null,$query=false) {
	
		if( is_null( $title ) ){
			$title='Connection error';
		}
		parent :: __construct($message,$code,$class,$methode,$title);
		

	}
}

Class Mysqli_Exception_config extends Mysqli_exception {

	
	public function __construct($message,$code,$class='unknow',$methode='unknow',$title=null,$query=false) {
	
		if( is_null( $title ) ){
			$title='Configuration Error [Mysqli_config.php]';
		}
		parent :: __construct($message,$code,$class,$methode,$title);
	}
}

Class Mysqli_exception_query extends Mysqli_exception {

	public function __construct($message,$code,$class='unknow',$methode='unknow',$title=null,$query=false) {
	
		if( is_null( $title ) ){
			$title='QUERY error';
		}
		if( preg_match('/prepare/',$message) ){
			$message=preg_replace('/prepare/','',$message);
			$message=$message. 'Could not prepare the query';
			$code=1;
		}
		if( preg_match('/bind_param/',$message) ){
			$message=preg_replace('/bind_param/','',$message);
			$message=$message. 'Could not bind parameter of the query';
			$code=2;
		}
		if( preg_match('/execute/',$message) ){
			$message=preg_replace('/execute/','',$message);
			$message=$message. 'Could not execute the query';
			$code=3;
		}
		if( preg_match('/store_result/',$message) ){
			$message=preg_replace('/store_result/','',$message);
			$message=$message. 'Could not store result of the statement';
			$code=5;
		}
		
		if( preg_match('/bind_result/',$message) ){
			$message=preg_replace('/bind_result/','',$message);
			$message=$message. 'Could not execute the query';
			$code=5;
		}
		
		parent :: __construct($message,$code,$class,$methode,$title,$query);
		

	}
}


class Mysqli_exception_param extends Mysqli_exception {

	public function __construct($message,$code,$class='unknow',$methode='unknow',$title=null,$query=false) {
	
		if( is_null( $title ) ){
			$title='Parametre error';
		}
		if( preg_match('/object/',$message) ){
			$message=preg_replace('/object/','',$message);
			$message=$message. 'must be an object';
			$code=1;
		}
		if( preg_match('/string/',$message) ){
			$message=preg_replace('/string/','',$message);
			$message=$message. 'must be a string';
			$code=2;
		}
		if( preg_match('/array/',$message) ){
			$message=preg_replace('/array/','',$message);
			$message=$message. 'must be a array';
			$code=3;
		}
		parent :: __construct($message,$code,$class,$methode,$title);
		

	}
}
?>