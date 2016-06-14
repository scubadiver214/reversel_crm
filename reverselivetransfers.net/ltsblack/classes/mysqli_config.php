<?php
/*Mysqli_config*/
self::$option['SHOW_EXCEPTIONS']=true;	
//self::$option['SHOW_EXCEPTIONS']=false;	//will show exceptions if true
self::$option['SHOW_MESSAGE']='<p>An error as occur The Administrator has been informed</p>';		//will show this message if SHOW_EXCEPTION=false
self::$option['DIE_ON_EXCEPTION']=false;															// will make script die when an exception is caught

self::$option['AUTOCONNECT']=true;																	//will connect to database when create object		


//optional can be set when create object.
$this->login['HOST']='localhost';																	
$this->login['USER']='root';//'mananonl_nav';
$this->login['PASSWORD']='';//'{^l9DU)4CwIM';
$this->login['DATABASE']='ajeet_aff';//'mananonl_ws';
$this->login['TABLE']=false;																		//table name, optional


?>