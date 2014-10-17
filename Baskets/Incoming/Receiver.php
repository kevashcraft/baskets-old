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
			case 'parts':
				if(\Baskets::$authlevel > 0) Parts::engine();
				break;
			case 'suppliers':
				if(\Baskets::$authlevel > 0) Suppliers::engine();
				break;
			case 'bids':
				if(\Baskets::$authlevel > 0) Bids::engine();
				break;
			case 'contractors':
				if(\Baskets::$authlevel > 0) Contractors::engine();
				break;
			case 'newpass':
				User::setpass();
				break;
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
