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
		$stm = $this->db->prepare("INSERT INTO visits (dt,ua,ip) VALUES(NOW(),?,?)");
		$stm->execute(array($_SERVER['HTTP_USER_AGENT'],ip2long($_SERVER['REMOTE_ADDR'])));
		echo "rows " . $stm->rowCount() . "<br>";
	}

	public function seyHello(){
		$location = geoip_record_by_name($_SERVER['REMOTE_ADDR']);
			echo "hello world, the initial class has been created.<br>";
			echo "you are connecting from ".$_SERVER['REMOTE_ADDR']." in ".$location['city']."<br>";
	}

	public function show_visits(){
		foreach($this->db->query("SELECT * FROM visits") as $visit){
				  echo $visit['id'] . " - " . $visit['dt'] . " - " . $visit['ip'] . "<br>";
		}

	}
}
