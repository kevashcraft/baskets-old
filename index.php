<?php
/*

	index.php for Baskets
	
	This file sets the initial variables with define and lib/bootstrap.php
	Then, it starts a new Baskets object

	test addition	2
*/



// Set the directory root
define('MY_ROOT',dirname(__FILE__));

// Incude some fundamental functions
include "lib/bootstrap.php";

// Include the main Baskets class
include "Baskets/Baskets.php";

// Start a new Baskets object
$baskets = new Baskets();
