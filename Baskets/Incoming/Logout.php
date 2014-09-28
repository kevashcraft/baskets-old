<?php
namespace Baskets\Incoming;
class Logout
{
	function __construct()
	{
		$db = \Baskets\Tools\Database::getConnection();
		$stm = $db->prepare("UPDATE sessions SET VALID=false WHERE cookid=?");
		$stm->execute(array($_COOKIE['cookid']));
		setcookie('cookid','none',time()-3600);
		echo "You've been logged out. Click <a href='".MY_URL."'>here</a> to go back to the login page";
	}
}
