<?
namespace Baskets\Incoming;
class Contractors
{
	public static $info;

	public static function engine()
	{
		$job = isset($_POST['job']) ? $_POST['job'] : $_GET['job'];
		$rawinfo = isset($_POST['basicinfo']) ? $_POST['basicinfo'] : $_GET['basicinfo'];
		self::$info = json_decode($rawinfo,true);
		switch($job)
		{
			case 'add_contractor':
				self::add_contractor();
				break;
			case 'update_contractor':
				self::update_contractor();
				break;
			default:
				echo 'you had NO job';
				break;
		}
	}


	public static function add_contractor()
	{
		$stm = \Baskets::$db->prepare("INSERT INTO contractors(dt,dtu,valid,contractor,contactperson,address,email,fax,phone) VALUES(NOW(),NOW(),true,?,?,?,?,?,?)");
		$ins = $stm->execute(array(
											self::$info['contractor'],
											self::$info['contactperson'],
											self::$info['address'],
											self::$info['email'],
											self::$info['fax'],
											self::$info['phone']
											));
		if($ins) echo 'contractor has been added';
		else echo 'could not add part :(';
	}


	public static function update_contractor()
	{
		$stm = \Baskets::$db->prepare("UPDATE contractors SET dtu=NOW(),contractor=?,address=?,email=?,fax=?,phone=? WHERE id=?");
		$up = $stm->execute(array(self::$info['contractor'],
									self::$info['address'],
									self::$info['email'],
									self::$info['fax'],
									self::$info['phone'],
									self::$info['entry-id']));
		if($up) echo 'contractor has been updated';
		else echo 'there where an error..';
	}
}
