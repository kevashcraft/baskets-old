<?
namespace Baskets\Incoming;
class Suppliers
{
	public static $info;

	public static function engine()
	{
		$job = isset($_POST['job']) ? $_POST['job'] : $_GET['job'];
		$rawinfo = isset($_POST['basicinfo']) ? $_POST['basicinfo'] : $_GET['basicinfo'];
		self::$info = json_decode($rawinfo,true);
		switch($job)
		{
			case 'add_supplier':
				self::add_supplier();
				break;
			case 'update_supplier':
				self::update_supplier();
				break;
			default:
				echo 'you had NO job';
				break;
		}
	}


	public static function add_supplier()
	{
		$stm = \Baskets::$db->prepare("INSERT INTO suppliers(dt,dtu,valid,supplier,contactperson,address,email,fax,phone) VALUES(NOW(),NOW(),true,?,?,?,?,?,?)");
		$ins = $stm->execute(array(
											self::$info['supplier'],
											self::$info['contactperson'],
											self::$info['address'],
											self::$info['email'],
											self::$info['fax'],
											self::$info['phone']
											));
		if($ins) echo 'supplier has been added';
		else echo 'could not add part :(';
	}


	public static function update_supplier()
	{
		$stm = \Baskets::$db->prepare("UPDATE suppliers SET dtu=NOW(),supplier=?,address=?,email=?,fax=?,phone=? WHERE id=?");
		$up = $stm->execute(array(self::$info['supplier'],
									self::$info['address'],
									self::$info['email'],
									self::$info['fax'],
									self::$info['phone'],
									self::$info['entry-id']));
		if($up) echo 'supplier has been updated';
		else echo 'there where an error..';
	}
}
