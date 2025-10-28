<?

	include_once("class.BlockPager.php");

	/**
	 * Block
	 * 
	 * @package 
	 * @author Administrator
	 * @copyright Copyright (c) 2006
	 * @version $Id: module.php,v 1.1 2007/03/23 12:37:33 redlinesoft Exp $
	 * @access public
	 **/
	class Block {
		var $uid;
		var $db;
		var $cfg;
		var $_sql;	
		
		function Block() {
			global $db,$cfg;
			$this->db=$db;
			$this->cfg=$cfg;
			$this->uid=$_SESSION['uid'];
			//$this->db->debug=true;		
		}
		
		function getBlock(){
			$sql="SELECT * FROM ".$this->cfg['tablepre']."block 
					ORDER BY blcOrder ASC ";
			$this->_sql=$sql;			
			$rs=$this->db->execute($sql);	
			return $rs;		
		}
		
		function getBlockById($blcid){
			$sql="SELECT * FROM ".$this->cfg['tablepre']."block 
					WHERE blcId=$blcid";
			$this->_sql=$sql;			
			$rs=$this->db->execute($sql);	
			return $rs;		
		}
		
		function getBlockList($rows=30){
			//$this->getBlock();
			$sql="SELECT * FROM ".$this->cfg['tablepre']."block 
					ORDER BY blcPosition ";
			$this->_sql=$sql;	
			$pager=new BlockPager($this->db,$this->_sql,true);
			$pager->Render($rows);
		}
		
		function setBlockActive($mid,$v){
			$sql="UPDATE ".$this->cfg['tablepre']."block 
					SET blcActive='".$v."' 
					WHERE blcId=$mid";
			$rs=$this->db->execute($sql);	
			return $rs;		
		}
		
		function setBlockOrder($mid,$order){
			$sql="UPDATE ".$this->cfg['tablepre']."block 
					SET blcOrder=$order
					WHERE blcId=".$mid;
			$rs=$this->db->execute($sql);	
			return $rs;	
		}	
		
		
		function setDeleteBlock($mid){
			$sql="DELETE FROM ".$this->cfg['tablepre']."block 
					WHERE blcId=$mid";
			$rs=$this->db->execute($sql);	
			return $rs;		
		}
		
		function getMaxOrderValue() {
			$sql="SELECT MAX(blcOrder) FROM ".$this->cfg['tablepre']."block ";
			$rs=$this->db->execute($sql);	
			return ($rs->fields[0]);		
		}
		
		function setNewBlock($blcTitle,$blcName,$blcContent,$blcRssUrl,$blcRssRefesh=600,$blcPosition,$m){
			$sql="INSERT INTO ".$this->cfg['tablepre']."block 
					(blcTitle,blcName,blcType,blcRssUrl,blcRssRefesh,blcRssTime,blcContent,blcPosition,blcOrder,blcActive) 
					VALUES ('".$blcTitle."','".strtolower($blcName)."','".$m."','".$blcRssUrl."',".$blcRssRefesh.",".time().",'".$blcContent."','".$blcPosition."',".($this->getMaxOrderValue()+1).",'y')";
			$rs=$this->db->execute($sql);
			return $rs;
		}
		
		function setEditBlock($blcId,$blcTitle,$blcName,$blcContent,$blcRssUrl,$blcRssRefesh=600,$blcPosition,$m){
			$sql="UPDATE ".$this->cfg['tablepre']."block 
					SET blcTitle='".$blcTitle."',blcName='".strtolower($blcName)."',blcType='".$m."',blcRssUrl='".$blcRssUrl."',
						blcRssRefesh=".$blcRssRefesh.",blcRssTime=".time().",blcContent='".$blcContent."',
						blcPosition='".$blcPosition."' 
					WHERE blcId=$blcId";
			$rs=$this->db->execute($sql);
			return $rs;
		}
		
		function setBlockUpload($userfile){
			global $sys_lanai;
			$modpath=$this->cfg['dir'].$sys_lanai->getPath()."blocks/";			
			$cfgPackagePath=$this->cfg['packdir'].$sys_lanai->getPath();
			if (move_uploaded_file($_FILES['userfile']['tmp_name'], $cfgPackagePath.$prefix.$_FILES['userfile']['name'])) {
				//echo "uploaded";
				include('include/pclzip/pclzip.lib.php');
				$moddir=substr($_FILES['userfile']['name'],0,(strlen($_FILES['userfile']['name'])-4));
				$archive = new PclZip($cfgPackagePath.$prefix.$_FILES['userfile']['name']);
				if ($archive->extract(PCLZIP_OPT_PATH, $modpath)){
				 	return true;
				} else {
					//echo "Cannot extract file to block directory, please check directory permission.";
					return false;
				}				
				unlink ($cfgPackagePath.$prefix.$_FILES['userfile']['name']);
			} else {
				//echo "cannot upload";
				return false;
			}// if upload file
		}
		
		
	} // end class
	
	

?>