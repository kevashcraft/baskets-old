<?php
/*

	Baskets.php - the main controller of the application

	1. Connect to DB
	2. Tiny requests
	3. Set the auth level
	4. Handle GET/POSTS
	5. Track page requests
	6. Main page switcher

*/


class Baskets
{

	public static $db; // the database object used by all other functions
	public static $mobile; // boolean stating if mobile device
	public static $authlevel; // the authentication level of the session


	// The construction function
	function __construct()
	{

		// start a session
		session_start();

		// create static db object
		self::$db = Baskets\Tools\Database::connect();

		// if tiny request, handle it then exit
		if(isset($_GET['tiny'])){
			Baskets\Incoming\Tiny::tim();
			exit();
		}

		// temporary function to create the initial users
		Baskets\Tools\Defaults::set(); // adds initial users

		// sets the static authentication level
		self::$authlevel = Baskets\Tools\Authenticator::authenticate(); 

		// if the request is GET/POST data, handle it then exit
		if(isset($_POST['annyong']) || isset($_GET['annyong'])) // process incoming data
		{
			Baskets\Incoming\Receiver::receive();
			exit();
		}
		
		// add visit information the the database and set the main requested page
		$page = Baskets\Tools\Tracker::track();


		// the main page switch
		switch($page)
		{
			case 'dashboard':
				Baskets\Pages\Dashboard::display();
				break;
			case 'mysettings':
				Baskets\Pages\MySettings::display();
				break;
			case 'parts':
				Baskets\Pages\Parts\Handler::begin();
				break;
			case 'suppliers':
				Baskets\Pages\Suppliers\Handler::begin();
				break;
			case 'bids':
				Baskets\Pages\Bids\Handler::display();
				break;
			case 'contractors':
				Baskets\Pages\Contractors::display();
				break;
			case 'proposals':
				Baskets\Pages\Proposals\Handler::begin();
				break;
			default: // if the requested page was not found, display the dashboard for authed users, or display the login page
				if(self::$authlevel) Baskets\Pages\Dashboard::display();
				else Baskets\Pages\Login::display();
		}
	}
}
