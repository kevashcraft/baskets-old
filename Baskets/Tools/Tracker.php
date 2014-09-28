<?php
namespace Baskets\Tools;
class Tracker
{

	public static $uri;
	public static $page;
	public static function track()
	{
		$db = \Baskets\Tools\Database::getConnection();
		$stmt = $db->prepare("INSERT INTO visits(dt,ua,ip) VALUES(NOW(),?,?)");
		$stmt->execute(array($_SERVER['HTTP_USER_AGENT'],ip2long($_SERVER['REMOTE_ADDR'])));
		self::$uri = explode('/',$_SERVER['REQUEST_URI']);
		$page = self::$uri[0];
		if(Authenticator::$level < 1) $page = 'login';
		if($page == '') $page = 'dashboard';
		self::$page = $page;
		return $page;
	}
}
