<?php
error_reporting(0);
/*Mysqli_config*/
$title = 'Interacct Media Group';
$footer = 'Interacct Media Group';
self::$option['SHOW_EXCEPTIONS']=true;	
//self::$option['SHOW_EXCEPTIONS']=false;	//will show exceptions if true
self::$option['SHOW_MESSAGE']='<p>An error as occur The Administrator has been informed</p>';		//will show this message if SHOW_EXCEPTION=false
self::$option['DIE_ON_EXCEPTION']=false;															// will make script die when an exception is caught

self::$option['AUTOCONNECT']=true;																	//will connect to database when create object		


//optional can be set when create object.
$this->login['HOST']='localhost:3306';																	
$this->login['USER']='reversel_crm';//'mananonl_nav';
$this->login['PASSWORD']='8MdsXP.2Z{om';//'{^l9DU)4CwIM';
$this->login['DATABASE']='reversel_crm';//'mananonl_ws';
$this->login['TABLE']=false;																		//table name, optional


?>