<?php
namespace Baskets\Tools;
class Tracker
{
	function __construct()
	{
		$db = \Baskets\Tools\Database::getConnection();
		$stmt = $db->prepare("INSERT INTO visits(dt,ua,ip) VALUES(NOW(),?,?)");
		$stmt->execute(array($_SERVER['HTTP_USER_AGENT'],ip2long($_SERVER['REMOTE_ADDR'])));
	}
}
