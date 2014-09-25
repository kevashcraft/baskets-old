<?php
class Baskets
{
	function __construct()
	{
		$db = new Baskets\Tools\Database;
		$visit = new Baskets\Tools\Tracker;
		//$auth = new Baskets\Tools\Authenticator;



		$page = new Baskets\Pages\Login;
	}
}
