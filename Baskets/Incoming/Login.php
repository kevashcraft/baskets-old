<?php
namespace Baskets\Incoming;
class Login
{
	function __construct()
	{
		$db = \Baskets\Tools\Database::getConnection();
		$stm = $db->prepare("SELECT * FROM users WHERE username=? AND password=? AND valid=true");
		$stm->execute(array($_POST['usremail'],hash('sha256',$_POST['usrpass'].PHASH)));
		$res = $stm->fetch();
		if(isset($res['username'])) echo "GOOD!";
		else print_r($res);
	}
}
