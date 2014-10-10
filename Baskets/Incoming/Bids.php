<?
namespace Baskets\Incoming;
class Bids
{
	public static $info;

	public static function engine()
	{
		$rawinfo = isset($_POST['what']) ? $_POST['what'] : $_GET['what'];
		self::$info = json_decode($rawinfo,true);
		print_r(self::$info);
		switch(self::$info['job'])
		{
			case 'add_bid':
				self::add_bid();
				break;
			case 'update_bid':
				self::update_bid();
				break;
			default:
				echo 'you had NO job';
				break;
		}
	}


	public static function add_bid()
	{
		$stm = \Baskets::$db->prepare("INSERT INTO bids(dt,expiration,bid,supplierid,valid) SELECT NOW(),NOW(),?,id,true FROM suppliers WHERE supplier LIKE ?");
		$ins = $stm->execute(array(	self::$info['bid'],
												"%".self::$info['supplier']."%"));
		if($ins){
			$compl = false;
			$lastid = \Baskets::$db->lastInsertId();
			$stm = \Baskets::$db->prepare("INSERT INTO bidparts SELECT ?,id,? FROM parts WHERE partid LIKE ?");
			for($pp=1;$pp<=self::$info['pp'];$pp++){
				if(self::$info["part$pp"] != '' && self::$info["price$pp"] != ''){
					$ins = $stm->execute(array(	$lastid,
														self::$info["price$pp"],
														"%".self::$info["part$pp"]."%"));
					if($ins) $compl = true;
				}
			}
			if($compl) echo "bid has been added";
			else echo "could not add bid :(";
		}
		else echo 'could not add bid :(';
	}


	public static function update_bid()
	{
		$stm = \Baskets::$db->prepare("DELETE FROM bidparts WHERE bidid=?");
		$stm->execute(array(self::$info['bidid']));
		$stm = \Baskets::$db->prepare("INSERT INTO bidparts SELECT ?,id,? FROM parts WHERE partid LIKE ?");
		$compl = false;
		for($pp=1;$pp<=self::$info['pp'];$pp++){
			if(self::$info["part$pp"] != '' && self::$info["price$pp"] != ''){
				$ins = $stm->execute(array(self::$info['bidid'],
													self::$info["price$pp"],
													"%".self::$info["part$pp"]."%"));
				if($ins) $compl = true;
			}
		}
		
		if($compl) echo 'supplier has been updated';
		else echo 'there where an error..';
	}
}
