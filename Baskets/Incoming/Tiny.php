<?
namespace Baskets\Incoming;
class Tiny{
	public static function tim(){
		switch($_GET['tiny']){
			case 'part_info':
				self::part_desc();
				break;
			case 'part_id':
				self::part_id();
				break;
			case 'part_prices':
				self::part_prices();
				break;
			case 'contractors':
				self::contractors();
			default:
				break;
		}	
	}

	public static function part_desc(){
		$stm = \Baskets::$db->prepare("SELECT id,partdesc FROM parts WHERE partid=?");
		$stm->execute(array($_GET['tp']));
		$res = $stm->fetch();
		$ret['id'] = $res['id'];
		$ret['desc'] = $res['partdesc'];
		echo json_encode($ret);
	}

	public static function part_id() {
		$stm = \Baskets::$db->prepare("SELECT partid FROM parts WHERE partid LIKE ? LIMIT 5");
		$stm->execute(array('%'.$_GET['part_id'].'%'));
		echo json_encode($stm->fetchAll(\PDO::FETCH_COLUMN));
	}

	public static function part_prices() {
		$stm = \Baskets::$db->prepare("SELECT suppliers.supplier,bidparts.price,bids.id FROM suppliers,bids,bidparts WHERE bidparts.partid IN (SELECT id FROM parts WHERE partid=?) AND bidparts.bidid = bids.id && suppliers.id = bids.supplierid;");
		$stm->execute(array($_GET['tp']));
		$return = [];
		while($stick = $stm->fetch(\PDO::FETCH_ASSOC)) {
			$return[$stick['supplier']]['price'] = $stick['price'];
			$return[$stick['supplier']]['bidid'] = $stick['id'];
		}

		echo json_encode($return);
	}


	public static function contractors() {
		$stm = \Baskets::$db->prepare("SELECT contractor FROM contractors WHERE valid=1");
		$stm->execute();
		$return = [];
		while ($line = $stm->fetch()) {
			$return[] = $line['contractor'];
		}
		echo json_encode($return);
	}



}
