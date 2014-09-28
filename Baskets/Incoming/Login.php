<?php
namespace Baskets\Incoming;
class Login
{
	function __construct()
	{
		$db = \Baskets\Tools\Database::getConnection();
		$stm = $db->prepare("SELECT * FROM users WHERE username=? AND password=? AND valid=true");
		$stm->execute(array(strtolower($_POST['usremail']),hash('sha256',$_POST['usrpass'].PHASH)));
		$res = $stm->fetch();
		if(isset($res['username'])) {
			$ins = $db->prepare("INSERT INTO sessions(dt,userid,cookid,useragent,valid) VALUES(NOW(),?,?,?,true)");
			$cookid = randString(23);
			$ins->execute(array($res['id'],$cookid,$_SERVER['HTTP_USER_AGENT']));
			setcookie('cookid',$cookid,time()+86400);
			setcookie('userid',$res['id'],time()+86400);
			$data = array(1,'good!');
			echo json_encode($data);
		} else {
			$data = array(0,'invalid username or password');
			echo json_encode($data);
		}
	}
}
