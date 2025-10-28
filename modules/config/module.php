<?php

global $db;

ADOdb_Active_Record::SetDatabaseAdapter($db);

/*	Class Meta	*/
class Meta extends ADOdb_Active_Record {
	var $_table = 'tbl_ln_meta';
}

class SysConfig {
	
	function getCurrentStatus() {
			$lines = file('config.inc.php');
			foreach ($lines as $line) {
			    if (eregi('cfg_off=', $line)) {
					list($key,$value)=split("=",$line,2);
					$value=trim($value);
					$valuex=ltrim($value,"\"");
					$valuex=substr($valuex,0,strlen($valuex)-2);
					return $valuex;
				}
			}
	}
	
	function _get_line(){
		$lines = file('config.inc.php');			
		foreach ($lines as $i => $line) {
			if (eregi('cfg_off=', $line)) {
				return $i;
			}
		}
	}
	
	function setUpdateStatus($tname){
		$lines = file('config.inc.php');			
		$lines[$this->_get_line()]="\t$"."cfg_off=\"".$tname."\"".";\n";
		$handle = fopen('config.inc.php', "w+");
		foreach ($lines as $i => $line) {
			fwrite($handle, $line);
		}
		fclose($handle);
	}
	
	function configIsWrite(){
		if (is_writable('config.inc.php')) {
			return true;
		} else {
			return false;
		}		
	}
	
}

?>