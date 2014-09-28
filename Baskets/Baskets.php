<?php
class Baskets
{
	function __construct()
	{
		session_start();
		Baskets\Tools\Database::connect();
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
			case 'contractors':
				Baskets\Pages\Contractors::display();
				break;
			default:
				Baskets\Pages\Login::display();

		}
	}
}
