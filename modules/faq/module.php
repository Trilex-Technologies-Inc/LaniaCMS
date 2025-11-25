<?

	include_once("class.FaqItemPager.php");

    include_once("class.FaqGroupPager.php");

	/**

	 * FAQ

	 *

	 * @package

	 * @author Administrator

	 * @copyright Copyright (c) 2006

	 * @version $Id: module.php,v 1.2 2008/07/25 02:37:25 redlinesoft Exp $

	 * @access public

	 **/

	class Faq {



		var $uid;

		var $db;

		var $cfg;

		var $_sql;





		function Faq () {

			global $db,$cfg;

			$this->db=$db;

			$this->cfg=$cfg;

			$this->uid=$_SESSION['uid'];

			//$this->db->debug=true;

		}



		function getFaqItem(){

			$sql="SELECT * FROM ".$this->cfg['tablepre']."faq_items,".$this->cfg['tablepre']."faq_category

					WHERE ".$this->cfg['tablepre']."faq_items.fcgId=".$this->cfg['tablepre']."faq_category.fcgId

                    ORDER BY ".$this->cfg['tablepre']."faq_items.fcgId ASC ";

			$this->_sql=$sql;

			$rs=$this->db->execute($sql);

			return $rs;

		}



        function getFaqItemById($mid) {

            $sql="SELECT * FROM ".$this->cfg['tablepre']."faq_items

                    WHERE faiId=".$mid;

            $rs=$this->db->execute($sql);

			return $rs;

         }



         function getFaqGroup() {

            $sql="SELECT * FROM ".$this->cfg['tablepre']."faq_category ORDER BY fcgOrder ASC";

            $this->_sql=$sql;

            $rs=$this->db->execute($sql);

			return $rs;

         }



      	function getFaqGroupById($mid) {

            $sql="SELECT * FROM ".$this->cfg['tablepre']."faq_category

                    WHERE fcgId=".$mid;

            $rs=$this->db->execute($sql);

			return $rs;

         }



        function getFaqItemMaxOrder(){

            $sql="SELECT MAX(faiOrder) FROM ".$this->cfg['tablepre']."faq_items ";

            $rs=$this->db->execute($sql);

            return ($rs->fields[0]);

        }



         function getFaqGroupMaxOrder(){

            $sql="SELECT MAX(fcgOrder) FROM ".$this->cfg['tablepre']."faq_category ";

            $rs=$this->db->execute($sql);

            return ($rs->fields[0]);

        }



        function setFaqItemNew($faiQuestion,$faiAnswer,$fcgId) {

			$sql="INSERT INTO ".$this->cfg['tablepre']."faq_items

				    (fcgId,faiQuestion,faiAnswer,faiOrder,faiActive,faiCteate)

                    VALUES (".$fcgId.",'".$faiQuestion."','".$faiAnswer."',".(($this->getFaqItemMaxOrder())+1).",'y',NOW()) ";

			$rs=$this->db->execute($sql);

			return $rs;

		}



        function setFaqGroupNew($fcgTitle,$fcgDescription) {

			$sql="INSERT INTO ".$this->cfg['tablepre']."faq_category

				    (fcgTitle,fcgDescription,fcgOrder,fcgActive,fcgCreate )

                    VALUES ('".$fcgTitle."','".$fcgDescription."',".(($this->getFaqGroupMaxOrder())+1).",'y',NOW()) ";

			$rs=$this->db->execute($sql);

			return $rs;

		}



        function setFaqItemEdit($faiId,$faiQuestion,$faiAnswer,$fcgId) {

			$sql="UPDATE ".$this->cfg['tablepre']."faq_items SET

				    fcgId=".$fcgId.",faiQuestion='".$faiQuestion."',faiAnswer='".$faiAnswer."'

                    WHERE faiId=".$faiId;

			$rs=$this->db->execute($sql);

			return $rs;

		}



        function setFaqGroupEdit($fcgId,$fcgTitle,$fcgDescription) {

			$sql="UPDATE ".$this->cfg['tablepre']."faq_category SET

				    fcgTitle='".$fcgTitle."',fcgDescription='".$fcgDescription."'

                    WHERE fcgId=".$fcgId;

			$rs=$this->db->execute($sql);

			return $rs;

		}



        function  setFaqItemDelete($mid){

			$sql="DELETE FROM ".$this->cfg['tablepre']."faq_items

					WHERE faiId=".$mid;

			$rs=$this->db->execute($sql);

			return $rs;

		}



        function  setFaqGroupDelete($mid){

			$sql="DELETE FROM ".$this->cfg['tablepre']."faq_category

					WHERE fcgId=".$mid;

			$rs=$this->db->execute($sql);

			return $rs;

		}



         function setFaqItemActive($mid,$value){

			$sql="UPDATE ".$this->cfg['tablepre']."faq_items

					SET faiActive='".$value."'

					WHERE faiId=".$mid;

			$rs=$this->db->execute($sql);

			return $rs;

		}



       function setFaqGroupActive($mid,$value){

			$sql="UPDATE ".$this->cfg['tablepre']."faq_category

					SET fcgActive='".$value."'

					WHERE fcgId=".$mid;

			$rs=$this->db->execute($sql);

			return $rs;

		}



        function setFaqItemOrder($mid,$order){

			$sql="UPDATE ".$this->cfg['tablepre']."faq_items

					SET faiOrder=$order

					WHERE faiId=".$mid;

			$rs=$this->db->execute($sql);

			return $rs;

		}



        function setFaqGroupOrder($mid,$order){

			$sql="UPDATE ".$this->cfg['tablepre']."faq_category

					SET fcgOrder=$order

					WHERE fcgId=".$mid;

			$rs=$this->db->execute($sql);

			return $rs;

		}



        function getFaqGroupCombo($name,$mid) {

            $sql="SELECT * FROM ".$this->cfg['tablepre']."faq_category ORDER BY fcgOrder ASC";

            $rs=$this->db->execute($sql);

            ?><select name="<?=$name; ?>"><?

            while (!$rs->EOF) {

                $select="";

                if ($mid==$rs->fields['fcgId']) {

                    $select="selected";

                }

                ?><option value="<?=$rs->fields['fcgId']; ?>" <?=$select; ?>><?=$rs->fields['fcgTitle']; ?></option><?

                $rs->movenext();

            } // while

            ?></select><?

         }



         function getFaqGroupShow (){

			$sql="SELECT * FROM ".$this->cfg['tablepre']."faq_category

					WHERE fcgActive='y'

					ORDER BY fcgOrder ASC";

			$this->_sql=$sql;

			$rs=$this->db->execute($sql);

			return $rs;

		}



        function getFagItemByGroupId($mid) {

            $sql="SELECT * FROM ".$this->cfg['tablepre']."faq_items WHERE faiActive='y' AND fcgId=".$mid;
            $rs=$this->db->execute($sql);

            return $rs;

        }



        function getTotalItemInGroup($mid){

			$sql="SELECT COUNT(*) AS num FROM ".$this->cfg['tablepre']."faq_items WHERE faiActive='y' AND  fcgId='".$mid;
			
			$rs=$this->db->execute($sql);

			return $rs->fields['num'];

		}



		function getFaqItemList($rows=20){

			$this->getFaqItem();

			$pager=new FaqItemPager($this->db,$this->_sql,true);

			$pager->Render($rows);

		}



        function getFaqGroupList($rows=20){

			$this->getFaqGroup();

			$pager=new FaqGroupPager($this->db,$this->_sql,true);

			$pager->Render($rows);

		}





	}



?>

