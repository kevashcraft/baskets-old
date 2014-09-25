<?php
namespace Baskets\Incoming;
class Receiver
{

	function __construct()
	{
		$purpose = (isset($_POST['purpose']) ? $_POST['purpose'] : 'none');
		switch ($purpose)
		{
			case 'login': 	
				$login = new Login;;
				break;
			default:
				echo 'You have no purpose :(';
				break;
		}
	}
}
