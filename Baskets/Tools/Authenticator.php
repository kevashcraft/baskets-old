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
			} else {
				self::$level = 0;
			}
		}
		return self::$level;
	}


}
