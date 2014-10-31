<?
namespace Baskets\Incoming;
class Proposals
{

	public static $prop;
	public static $rooms;
	public static $opts;

	public static function engine()
	{
		$job = isset($_POST['job']) ? $_POST['job'] : $_GET['job'];
		$rawinfo = isset($_POST['propinfo']) ? $_POST['propinfo'] : $_GET['propinfo'];
		self::$prop = json_decode($rawinfo,true);
		$rawinfo = isset($_POST['proprooms']) ? $_POST['proprooms'] : $_GET['proprooms'];
		self::$rooms = json_decode($rawinfo,true);
		$rawinfo = isset($_POST['propopts']) ? $_POST['propopts'] : $_GET['propopts'];
		self::$opts = json_decode($rawinfo,true);

		switch($job)
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


		/*
			Tables:
						proposals -> basic info (money and such)
						propparts -> optid, propid, price, installhours, cost, installpoint
						propoptions -> optionname, propid, adjustment

		*/


		// Get necessary info

		$consel = \Baskets::$db->prepare("SELECT id FROM contractors WHERE contractor=?");
		$consel->execute(array(self::$prop['contractor']));
		$conret = $consel->fetch();
		$contractorid = $conret['id'];

		$addProp = \Baskets::$db->prepare("INSERT INTO proposals (dt,dtu,contractorid,model,validstart,validend,partMarkup,desiredMargin,contingency,taxRate,valid) VALUES(NOW(),NOW(),?,?,?,?,?,?,?,?,1)");


		$addPart = \Baskets::$db->prepare("INSERT INTO propparts (partid,optid,room,installpoint,installhours,qty,cost,price) SELECT id,?,?,?,?,?,?,? FROM parts WHERE partid=?");



		$addOpt = \Baskets::$db->prepare("INSERT INTO propoptions (optionName,propid,adjustment,tubsetHours,trimHours,roughInHours,partCost) VALUES(?,?,?,?,?,?,?)");

		$p = self::$prop;

		$propinfo = array(
									$contractorid,
									$p['model'],
									$p['validStart'],
									$p['validEnd'],
									$p['partMarkUp'],
									$p['desiredMargin'],
									$p['contingency'],
									$p['taxRate']
							);
		$ex = $addProp->execute($propinfo);

		if($ex) echo "added prop!";
		$propid = \Baskets::$db->lastInsertId();


		foreach(self::$opts as $opt) {
			$optinfo = array(
									$opt['optName'],
									$propid,
									$opt['adjustment'],
									$opt['tubsetHours'],
									$opt['trimHours'],
									$opt['roughInHours'],
									$opt['partcost']
								);

			$ex = $addOpt->execute($optinfo);
			if($ex) echo "option added!";
			$optid = \Baskets::$db->lastInsertId();


			foreach(self::$rooms as $room) {
	
				foreach($room['parts'] as $part) {
	
					if($part['partid'] == '') continue;
	
					$partinfo = array (
												$optid,
												$room['roomname'],
												$part['installpoint'],
												$part['parthours'],
												$part['qty'],
												$part['cost'],
												$part['price'],
												$part['partid']
											);
	
					$ex = $addPart->execute($partinfo);
					if($ex) echo "added part!!!";
				}
			}
		}	

		echo "Hello, thank you for contacting the proposal receiving service. My name is Todd and here is a copy of the proposal that I received:";
		print_r(self::$prop);
		echo "AND THE RROOMS!";
		print_r(self::$rooms);
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
