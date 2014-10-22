<?php
/*

	parses csv file and inserts the part info into the db

	expects column headings to match db table columns

*/

//		Settings

$file_name = '';



// Open file
$file = fopen($file_name, 'r');

// Set columns
$cols = str_getcsv(fgets($file));
$dbcols = implode(',',$cols)

// create ? for each column
$q = array();
for($x=0;$x<sizeof($cols);$x++){
	$q[] = '?';
}
$qs = implode(',',$q);



$stm = $db->prepare("INSERT INTO parts ($dbcols) VALUES ($qs)");




while($line = fgets($file)){
	$db->execute(str_getcsv($line));
}
