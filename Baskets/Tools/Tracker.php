<?php
namespace Baskets\Tools;
class Tracker
{

	public static $uri;
	public static $page;
	public static $mobile;

	public static function track()
	{
		$db = \Baskets::$db;
		$stmt = $db->prepare("INSERT INTO visits(dt,ua,ip) VALUES(NOW(),?,?)");
		$stmt->execute(array($_SERVER['HTTP_USER_AGENT'],ip2long($_SERVER['REMOTE_ADDR'])));
		self::$uri = explode('/',$_SERVER['REQUEST_URI']);
		$page = self::$uri[1];

		include MY_ROOT . "/lib/Mobile-Detect/Mobile_Detect.php";
		$detect = new \Mobile_Detect;
		self::$mobile = true;//$detect->isMobile();
		if(Authenticator::$level < 1) $page = 'login';
		if($page == '') $page = 'dashboard';
		self::$page = $page;
		return $page;
	}
}
