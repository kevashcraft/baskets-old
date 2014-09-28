<?php
namespace Baskets\Incoming;
class Receiver
{

	public static function receive()
	{
		$purpose = (isset($_POST['purpose']) ? $_POST['purpose'] : 'none');
		if($purpose == 'none') $purpose = (isset($_GET['purpose']) ? $_GET['purpose'] : 'none');
		switch ($purpose)
		{
			case 'login': 	
				$login = new Login;;
				break;
			case 'logout': 	
				$logout = new Logout;
				break;
			default:
				echo 'You have no purpose :(';
				break;
		}
	}
}
