<?php
trait databaseConnectorTrait{
	public function db_connect($dbhost,$dbname,$dbuser,$dbpass){
		try {
			$db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
		return $db;
	}
}
