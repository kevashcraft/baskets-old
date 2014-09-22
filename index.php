<?php

	define('ROOT',dirname(__FILE__));
	require_once ROOT . "/lib/baskets.php";
	$baskets = new baskets;
	$baskets->seyHello();

/*
<!DOCTYPE html>
<html>
	<head>
		<title>Baskets - Login</title>
		<link rel='stylesheet' type='text/css' href='style.css' />
	</head>
	<body>
		<form id='login' method='post'>
			<label for='usremail'>Email:</label><input type='email' name='usremail' id='usremail'><br />
			<label for='usrpass'>Password:</label><input type='password' name='usrpass' id='usrpass'><br />
		</form>
	</body>
</html>

 */
