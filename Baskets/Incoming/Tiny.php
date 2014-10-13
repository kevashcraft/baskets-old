<?
namespace Baskets\Incoming;
class Tiny{
	public static function tim(){
		switch($_GET['tiny']){
			case 'part_name':
				self::part_name();
				break;
			default:
				break;
		}	
	}

	public static function part_name(){
		$stm = \Baskets::$db->prepare("SELECT partname FROM parts WHERE partid=?");
		$stm->execute(array($_GET['tp']));
		$res = $stm->fetch();
		echo $res['partname'];
	}
}
