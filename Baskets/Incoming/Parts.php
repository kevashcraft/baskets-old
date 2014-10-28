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
			case 'update_part':
				self::update_part();
				break;
			default:
				echo 'you had NO job';
				break;
		}
	}


	public static function add_part()
	{
		$stm = \Baskets::$db->prepare("INSERT INTO parts(partid,partname,partdesc) VALUES(?,?,?)");
		$ins = $stm->execute(array(self::$info['part-id'],self::$info['part-name'],self::$info['part-desc']));
		if($ins) echo 'part has been added';
		else echo 'could not add part :(';
	}

	public static function update_part()
	{
		$stm = \Baskets::$db->prepare("UPDATE parts SET partid=?, partdesc=?, hours=?, installpoint=? WHERE id=?");
		$up = $stm->execute(array(self::$info['part-id'],
									self::$info['part-desc'],
									self::$info['parthours'],
									self::$info['installpoint'],
									self::$info['entry-id']));
		if($up) echo 'part has been updated';
		else echo 'there where an error..';
	}


}
