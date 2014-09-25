<?php
namespace Baskets\Tools;
class SetDefaults
{
	function __construct()
	{
		$db = Database::getConnection();
		$stm = $db->prepare("SELECT username FROM users WHERE username=?");
		$ins = $db->prepare("INSERT INTO users(dt,dtu,wid,username,password,authlevel,valid)
													VALUES (NOW(),NOW(),0,?,?,10,true)");
		$stm->execute(array('kevin@kevashcraft.com'));
		$row = $stm->fetch();
		if(!isset($row['username'])) {
			$ins->execute(array('kevin@kevashcraft.com',hash('sha256','password'.PHASH)));
		}

		$stm->execute(array('mark@bordeauplumbing.com'));
		$row = $stm->fetch();
		if(!isset($row['username'])) {
			$ins->execute(array('mark@bordeauplumbing.com',hash('sha256','fastcar'.PHASH)));
		}

	}
}
