<?
namespace Baskets\Incoming;
class Bids
{
	public static $bainfo;
	public static $arinfo;

	public static function engine() {
	
		$job = isset($_POST['job']) ? $_POST['job'] : $_GET['job'];
		$rawinfo = isset($_POST['basicinfo']) ? $_POST['basicinfo'] : $_GET['basicinfo'];
		self::$bainfo = json_decode($rawinfo,true);
		$rawinfo = isset($_POST['arrayinfo']) ? $_POST['arrayinfo'] : $_GET['arrayinfo'];
		self::$arinfo = json_decode($rawinfo,true);
		switch($job)
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
		$stm = \Baskets::$db->prepare("INSERT INTO bids(
		echo "hello! it's an auction and you've got a bid!!";

		echo "your bid was read as..";
		echo "basic info:";
		print_r(self::$bainfo);
		echo "more info:";
		print_r(self::$arinfo);
		echo "Thank you!";
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
