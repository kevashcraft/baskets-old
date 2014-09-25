<?php
namespace Baskets\Tools;
class Authenticator
{
	public $level;

	function __construct()
	{
		if (isset($_COOKIE['cookid']) && isset($_COOKIE['userid']))
		{
			$db = Database::getConnection();
			$sel = $db->prepare("SELECT useragent FROM sessions WHERE cookid=? AND userid=?");
			$sel->execute(array($_COOKIE['cookid'],$_COOKIE['userid']));
			$test = $sel->fetch();
			print_r($test);
		}
	}


}
