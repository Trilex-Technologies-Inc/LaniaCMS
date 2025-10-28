<?php

require_once("../AjaxCore.class.php");

class AjaxTest extends AjaxCore
{
	function AjaxTest()
	{	
		$this->setup();
		parent::AjaxCore();
	}
	
	function setup()
	{
		$this->setCurrentFile("AjaxTest.class.php");
		$this->setPlaceHolder("results");
		$this->setUpdating("updating...");
	}
		
	function getRandomNumber()
	{
		sleep(1); // don't use this on a production environment
		echo 'the returned number is '.rand(0,999) ;
	}	
		
} 

new AjaxTest();

?>