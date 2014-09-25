<?php
class Baskets
{
	function __construct()
	{
		session_start();
		$db = new Baskets\Tools\Database;
		$default = new Baskets\Tools\SetDefaults;

		if(isset($_POST['annyong']))
		{
			$receiver = new Baskets\Incoming\Receiver;
			exit();
		}
		
		$visit = new Baskets\Tools\Tracker;
		$auth = new Baskets\Tools\Authenticator;
		$page = new Baskets\Pages\Login;
	}
}
