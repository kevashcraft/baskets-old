<?php
class Baskets
{
	function __construct()
	{
		session_start();
		$db = new Baskets\Tools\Database;

		if(isset($_GET['setme'])) setcookie('hello','ellwo',time()+3600);
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
