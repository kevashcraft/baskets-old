<?
namespace Baskets\Incoming;
class Tiny{
	public static function tim(){
		switch($_GET['tiny']){
			case 'part_desc':
				self::part_desc();
				break;
			case 'part_id':
				self::part_id();
				break;
			default:
				break;
		}	
	}

	public static function part_desc(){
		$stm = \Baskets::$db->prepare("SELECT partdesc FROM parts WHERE partid=?");
		$stm->execute(array($_GET['tp']));
		$res = $stm->fetch();
		echo $res['partdesc'];
	}

	public static function part_id() {
		$stm = \Baskets::$db->prepare("SELECT partid FROM parts WHERE partid LIKE ? LIMIT 5");
		$stm->execute(array('%'.$_GET['part_id'].'%'));
		echo json_encode($stm->fetchAll(\PDO::FETCH_COLUMN));
	}




}
