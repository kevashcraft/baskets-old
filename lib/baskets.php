<?php
class baskets{
	private $db;
	private $dbuser = 'baskets';
	private $dbpass = 'baskets';
	private $dbname = 'baskets';
	private $dbhost = 'localhost';

	public function __construct( $debug = false ){
		$this->db_connect(); 
	}

	private function db_connect(){
		try {
			$this->db = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function log_visit(){
		$stm = $this->db->prepare("INSERT INTO visits (ua,ip) VALUES(?,?)");
		$stm->execute($_SERVER['HTTP_USER_AGENT'],ip2long($_SERVER['REMOTE_ADDR']));
	}

	public function seyHello(){
		$location = geoip_record_by_name($_SERVER['REMOTE_ADDR']);
			echo "hello world, the initial class has been created.";
			echo "<br>you are connecting from ".$_SERVER['REMOTE_ADDR']." in ".$location['city']."with a user agent of ".$_SERVER['HTTP_USER_AGENT'];
	}
}
