<?php
namespace Baskets\Incoming;
class Logout
{
	function __construct()
	{
		$db = \Baskets\Tools\Database::getConnection();
		$stm = $db->prepare("UPDATE sessions SET VALID=false WHERE cookid=?");
		if(isset($_COOKIE['cookid'])) $stm->execute(array($_COOKIE['cookid']));
		session_destroy();
		setcookie('cookid','none',time()-3600);
		header("Location: " . MY_URL);
	}
}
