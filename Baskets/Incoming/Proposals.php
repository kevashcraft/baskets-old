<?
namespace Baskets\Incoming;
class Proposals
{

	public static $info;

	public static function engine()
	{
		$rawinfo = isset($_POST['what']) ? $_POST['what'] : $_GET['what'];
		self::$info = json_decode($rawinfo,true);
		print_r(self::$info);
		switch(self::$info['job'])
		{
			case 'add_proposal':
				self::add_proposal();
				break;
			case 'update_proposal':
				self::update_proposal();
				break;
			default:
				echo 'you had NO job';
				break;
		}
	}


	public static function add_proposal()
	{
		$stm = \Baskets::$db->prepare("INSERT INTO proposals(proposalid,proposalname,proposaldesc) VALUES(?,?,?)");
		$ins = $stm->execute(array(self::$info['proposal-id'],self::$info['proposal-name'],self::$info['proposal-desc']));
		if($ins) echo 'proposal has been added';
		else echo 'could not add proposal :(';
	}

	public static function update_proposal()
	{
		$stm = \Baskets::$db->prepare("UPDATE proposals SET proposalid=?, proposalname=?, proposaldesc=? WHERE id=?");
		$up = $stm->execute(array(self::$info['proposal-id'],
									self::$info['proposal-name'],
									self::$info['proposal-desc'],
									self::$info['entry-id']));
		if($up) echo 'proposal has been updated';
		else echo 'there where an error..';
	}


}
