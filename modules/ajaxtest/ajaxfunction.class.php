<?php

if ((!eregi("module.php", $_SERVER['PHP_SELF'])) AND  (!eregi("setting.php", $_SERVER['PHP_SELF']))) {
	require_once("../../include/ajaxcore/AjaxCore.class.php");  
} else {
	require_once("include/ajaxcore/AjaxCore.class.php");  // first we include the AjaxCore class
}


class AjaxFunctions extends AjaxCore { 
	
	 function AjaxFunctions() {
	    $this->setup();
	    parent::AjaxCore();
	 } 
	 
	 function setup()	 {
	    $this->setCurrentFile("modules/ajaxtest/ajaxfunction.class.php");
	    $this->setPlaceHolder("results");
	    $this->setUpdating("loading...");
	 } 
	 
	function getRandomNumber(){
		$user=$this->request['name'];
		sleep(1); // don't use this on a production environment
		echo "Hello ".$user.". My random number is ".rand(0,999) ;
	}
	
}

new AjaxFunctions(); // do not forget this!

?>
