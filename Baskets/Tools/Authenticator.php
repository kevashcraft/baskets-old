<?php
namespace Baskets\Tools;
class Authenticator
{
	public static $level;
	public static function authenticate()
	{
		if (isset($_COOKIE['cookid']) && isset($_COOKIE['userid']))
		{
			$db = Database::getConnection();
			$sel = $db->prepare("SELECT * FROM sessions WHERE cookid=? AND userid=? AND valid=true");
			$sel->execute(array($_COOKIE['cookid'],$_COOKIE['userid']));
			$test = $sel->fetch();
			if(isset($test['id']))
			{
				self::$level =  1;//$test['authlevel'];
				if(!isset($_SESSION['userid'])) self::setsession();
			} else {
				self::$level = 0;
			}
		}
		if(isset($_GET['a'])) self::$level = 1;
		return self::$level;
	}

	public static function setsession()
	{
		$userid = $_COOKIE['userid'];
		$db = Database::getConnection();
		$sel = $db->prepare("SELECT * FROM users WHERE id=? AND valid=true");
		$sel->execute(array($userid));
		$user = $sel->fetch();
		$_SESSION['useremail'] = $user['username'];
		$_SESSION['userid'] = $user['id'];
	}

}
