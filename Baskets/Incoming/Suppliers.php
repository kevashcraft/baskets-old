<?
namespace Baskets\Incoming;
class Suppliers
{
	public static $info;

	public static function engine()
	{
		$rawinfo = isset($_POST['what']) ? $_POST['what'] : $_GET['what'];
		self::$info = json_decode($rawinfo,true);
		print_r(self::$info);
		switch(self::$info['job'])
		{
			case 'add_supplier':
				self::add_supplier();
				break;
			default:
				echo 'you had NO job';
				break;
		}
	}


	public static function add_supplier()
	{
		$stm = \Baskets::$db->prepare("INSERT INTO suppliers(dt,dtu,valid,supplier,address,email,fax,phone) VALUES(NOW(),NOW(),true,?,?,?,?,?)");
		$ins = $stm->execute(array(	self::$info['supplier'],
												self::$info['address'],
												self::$info['email'],
												self::$info['fax'],
												self::$info['phone']));
		if($ins) echo 'supplier has been added';
		else echo 'could not add part :(';
	}
}
