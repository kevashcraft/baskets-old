<?
namespace Baskets\Incoming;
class Parts
{
	public static $info;

	public static function engine()
	{
		$rawinfo = isset($_POST['what']) ? $_POST['what'] : $_GET['what'];
		self::$info = json_decode($rawinfo,true);
		print_r(self::$info);
		switch(self::$info['job'])
		{
			case 'add_part':
				self::add_part();
				break;
			default:
				echo 'you had NO job';
				break;
		}
	}


	public static function add_part()
	{
		$stm = \Baskets::$db->prepare("INSERT INTO parts(partid,partname,partdesc) VALUES(?,?,?)");
		$ins = $stm->execute(array(self::$info['partid'],self::$info['partname'],self::$info['partdesc']));
		if($ins) echo 'part has been added';
		else echo 'could not add part :(';
	}
}
