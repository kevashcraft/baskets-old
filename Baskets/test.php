<?php
namespace Baskets;
class test{

	// STRING SETTINGS



	// DB SETTINGS
	private $db;
	private $dbuser = 'baskets';
	private $dbpass = 'baskets';
	private $dbname = 'baskets';
	private $dbhost = 'localhost';


/*
************************************************************
		TRAITS
************************************************************
*/
	// INCLUDES





/*
************************************************************
		CONSTRUCT
************************************************************
*/
	public function __construct( $debug = false ){
/*
		require_once("lib/traits/databaseConnectorTrait.php");
		session_start();
		$this->db = db_connect($this->dbhost,$this->dbname,$this->dbuser,$this->dbpass);
//		$this->db_connect();  // Connect to DB
		$this->log_visit();	// Log the visit
//		$this->login_page(); // Show login page
*/		$this->say_hello();
	}



/*
************************************************************
		PRIMARY FUNCTIONS
************************************************************
*/

/*
	private function db_connect(){
		try {
			$this->db = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
*/
	public function log_visit(){
		$stm = $this->db->prepare("INSERT INTO visits (dt,ua,ip) VALUES(NOW(),?,?)");
		$stm->execute(array($_SERVER['HTTP_USER_AGENT'],ip2long($_SERVER['REMOTE_ADDR'])));
	}



/*
************************************************************
		PAGES
************************************************************
*/

	private function login_page(){ ?>
<!DOCTYPE html>
<html>
	<head>
		<link rel='stylesheet' type='text/css' href='reset.css' />
		<link rel='stylesheet' type='text/css' href='style.css' />
		<title>Login | Baskets</title>
	</head>
	<body>
		<div class='login_box'>
			<form id='login' method='post'>
				<label for='usremail'>Email:</label><input type='email' name='usremail' id='usremail'><br />
				<label for='usrpass'>Password:</label><input type='password' name='usrpass' id='usrpass'><br />
			</form>
		</div>
	</body>
</html>
	<?php }




/*
************************************************************
		MISC FUNCTIONS
************************************************************
*/



	public function say_hello(){
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
