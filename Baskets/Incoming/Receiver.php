<?php
namespace Baskets\Incoming;
class Receiver
{
	function __construct()
	{
		setcookie('hello','wassupdoc',time()+3600);
		echo "hello" . session_id() . $_COOKIE['hello'];
	}
}
