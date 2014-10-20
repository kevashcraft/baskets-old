<?php
class Baskets
{
	public static $db;
	public static $mobile;
	public static $authlevel;


	function __construct()
	{

		session_start();

		self::$db = Baskets\Tools\Database::connect();
		if(isset($_GET['tiny'])){
			Baskets\Incoming\Tiny::tim();
			exit();
		}


		Baskets\Tools\Defaults::set(); // adds initial users


		self::$authlevel = Baskets\Tools\Authenticator::authenticate(); 

		if(isset($_POST['annyong']) || isset($_GET['annyong'])) // process incoming data
		{
			Baskets\Incoming\Receiver::receive();
			exit();
		}
		

		$page = Baskets\Tools\Tracker::track(); // track page visit

		switch($page)
		{
			case 'dashboard':
				Baskets\Pages\Dashboard::display();
				break;
			case 'mysettings':
				Baskets\Pages\MySettings::display();
				break;
			case 'parts':
				Baskets\Pages\Parts::display();
				break;
			case 'suppliers':
				Baskets\Pages\Suppliers::display();
				break;
			case 'bids':
				Baskets\Pages\Bids::display();
				break;
			case 'contractors':
				Baskets\Pages\Contractors::display();
				break;
			case 'proposals':
				Baskets\Pages\Proposals::display();
				break;
			default:
				if(self::$authlevel) Baskets\Pages\Dashboard::display();
				else Baskets\Pages\Login::display();

		}
	}
}
