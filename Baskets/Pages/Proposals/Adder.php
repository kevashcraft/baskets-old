<?php
namespace Baskets\Pages\Proposals;
class Adder
{

	public static function adder() {
	?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Proposal | Baskets</title>
	<script type="text/javascript" src="http://ldev/bower_components/platform/platform.js"></script>
	<link rel="import" href="../lib/Polymer.html">
</head>
<body>
	<core-toolbar>
		<div flex >New Proposal</div>
		<core-icon-button icon="menu"></core-icon-button>
	</core-toolbar>
	<form>
		<paper-input label="Model Name"></paper-input>
	</form>
</body>
</html>
	<?
	}
}		
