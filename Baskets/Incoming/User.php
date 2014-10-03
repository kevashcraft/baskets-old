<?php
namespace Baskets\Incoming;
class User
{
	public static function setpass()
	{
		$userid = $_SESSION['userid'];
		$newpass = hash('sha256',$_POST['what'].PHASH);
		$db = \Baskets\Tools\Database::getConnection();
		$stm = $db->prepare("UPDATE users SET password=? WHERE id=?");
		$sql = $stm->execute(array($newpass,$userid)); 
		if($sql) echo "Your password has been set.";
		else echo "There was an issue...";
	}
}
