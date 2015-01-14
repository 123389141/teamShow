<?php
require_once "class.DBConn.php";
class ChannelDB extends DBConn{
	/**
	 * 插入新的渠道
	 */
	public function insertChannel($data){
 		$conn=parent::getConn();
 		$sql="insert into channel_number (channel_name,team_name,work,person,tele)values(:channel_name,:team_name,:work,:person,:tele)";

 		try{
 			$st=$conn->prepare($sql);
 			$st->bindValue(":channel_name",$data["channel_name"],PDO::PARAM_STR);
 			$st->bindValue(":team_name",$data["team_name"],PDO::PARAM_STR);
 			$st->bindValue(":work",$data["work"],PDO::PARAM_STR);
 			$st->bindValue(":person",$data["person"],PDO::PARAM_STR);
 			$st->bindValue(":tele",$data["tele"],PDO::PARAM_STR);

 			$st->execute();
 			return true;
 		}catch(PDOException $e){
 			echo "insertChannel() failed:".$e->getMessage();
 			return false;
 		}	
	}
	/**
	 * 查询所有渠道号
	 */
	public function selectChannelNumbers($rule){
		$conn=parent::getConn();
 		$sql="SELECT id,channel_name,team_name,`work`,person,tele,create_time FROM channel_number".
 			" WHERE id IN (SELECT MAX(id) FROM channel_number GROUP BY channel_name) ORDER BY id ASC";
 		try{
 			$st=$conn->prepare($sql);
 			$st->execute();
 			$row=$st->fetchALL();
 		}catch(PDOException $e){
 			echo "selectPaymentMethods() failed:".$e->getMessage();
 			return false;
 		}		
 		return $row;
	} 

	/**
	 * 查询单个渠道号
	 */
	public function selectOneChannelNumber($rule){
		$conn=parent::getConn();
 		$sql="SELECT id,channel_name,team_name,`work`,person,tele,create_time FROM channel_number WHERE ";
 				
 		if($rule) $sql.=$rule;
 		try{
 			$st=$conn->prepare($sql);
 			$st->execute();
 			$row=$st->fetch();
 		}catch(PDOException $e){
 			echo "selectPaymentMethods() failed:".$e->getMessage();
 			return false;
 		}		
 		return $row;
	}
	/**
	 * 更新一个渠道
	 */
	public function updateOneChannelNumber($id,$data){
		$conn=parent::getConn();

 		$sql="UPDATE channel_number Set channel_name=:channel_name,bd=:bd, " .
 			" has_sdk=:has_sdk,description=:description ".
 			" where id=:id ";
 		try{
 			$st=$conn->prepare($sql);
 			$st->bindValue(":id",$id,PDO::PARAM_INT);
 			$st->bindValue(":channel_name",$data["channel_name"],PDO::PARAM_STR);
 			$st->bindValue(":bd",$data["bd"],PDO::PARAM_STR);
 			$st->bindValue(":has_sdk",$data["has_sdk"],PDO::PARAM_STR);
 			$st->bindValue(":description",$data["description"],PDO::PARAM_STR);
 			$st->execute();
 			return true;
 		}catch(PDOException $e){
 			echo "updateOneChannelNumber():".$e->getMessage();
 			return false;
 		}			
	}
}
//$bd = new ChannelDB();
//$val = $bd->selectOneChannelNumber(12);
//print_r($val);
?>
