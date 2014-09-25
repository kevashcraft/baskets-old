<?php
namespace Baskets\Tools;
class Database
{
	private static $db;
	private $dbuser = 'baskets';
	private $dbpass = 'baskets';
	private $dbname = 'baskets';
	private $dbhost = 'localhost';

	function __construct() {
		try {
			self::$db = new \PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	function __destruct() {
		self::$db = null;
	}

	public static function getConnection() {
		if (self::$db == null) {
			self::$db = new Database();
		}
		return self::$db;
	}
}

