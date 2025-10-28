<?php

if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
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
	    $this->setCurrentFile("modules/%MODULE%/ajaxfunction.class.php");
	    $this->setPlaceHolder("results");
	    $this->setUpdating("loading...");
	 } 
	 
	function myFunction(){
		
	}
	
}

new AjaxFunctions(); // do not forget this!

?>
