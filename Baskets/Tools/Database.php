<?php
namespace Baskets\Tools;
class Database
{
	private static $db;
	private static $dbuser = 'baskets';
	private static $dbpass = 'baskets';
	private static $dbname = 'baskets';
	private static $dbhost = 'localhost';

	public static function connect() {
		try {
			self::$db = new \PDO("mysql:host=".self::$dbhost.";dbname=".self::$dbname, self::$dbuser, self::$dbpass);
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public static function getConnection() {
		if (self::$db == null) {
			self::connect();
		}
		return self::$db;
	}
}

