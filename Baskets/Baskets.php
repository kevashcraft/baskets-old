<?php
class Baskets
{
	public static $db;
	public static $mobile;

	function __construct()
	{
		session_start();
		self::$db = Baskets\Tools\Database::connect();
		Baskets\Tools\Defaults::set(); // adds initial users
		if(isset($_POST['annyong']) || isset($_GET['annyong'])) // process incoming data
		{
			Baskets\Incoming\Receiver::receive();
			exit();
		}
		
		$auth = Baskets\Tools\Authenticator::authenticate(); 
		$page = Baskets\Tools\Tracker::track(); // track page visit

		switch($page)
		{
			case 'dashboard':
				Baskets\Pages\Dashboard::display();
				break;
			case 'mysettings':
				Baskets\Pages\MySettings::display();
			case 'contractors':
				Baskets\Pages\Contractors::display();
				break;
			default:
				if($auth) Baskets\Pages\Dashboard::display();
				else Baskets\Pages\Login::display();

		}
	}
}
