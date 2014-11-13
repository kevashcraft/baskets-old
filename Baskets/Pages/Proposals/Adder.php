<?php
namespace Baskets\Pages\Proposals;
class Adder
{

	public static function adder() {
/*
		$stm = \Baskets::$db->prepare( "INSERT INTO proposals ( created, last_updated, author ) 
															VALUES( NOW(), NOW(), ? )" );
		$stm->execute( array( $_SESSION['user_id'] ) );
		$proposalId = \Baskets::$db->lastInsertId();
*/
		$proposalId = "23";
	?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Proposal | Baskets</title>
	<script type="text/javascript" src="../bower_components/platform/platform.js"></script>
	<link rel="import" href="../elements/proposal-element.html">
</head>
<body>
	<proposal-element propid="<?=$proposalId?>" dialog="prop-info" newprop></proposal-element>
</body>
</html>
	<?
	}
}		
