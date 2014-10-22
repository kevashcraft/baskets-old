<?php
namespace Baskets\Incoming;
class PartsUploader
{
	public static function engine()
	{

		$file = fopen($_FILES['partslist']['tmp_name'],'r');


		$colarray = str_getcsv(fgets($file));
		$cols = implode(',',$colarray);

		$questionsarray = array();
		foreach ($colarray as $col) {
			array_push($questionsarray,'?');
		}
		$questions = implode(',', $questionsarray);

		$ins = \Baskets::$db->prepare("INSERT INTO parts($cols) VALUES($questions)");

		while($line = fgets($file)) {
			$nowhitespace = preg_replace('/\s+/','', $line);
			$ins->execute(str_getcsv($nowhitespace));
			echo "ins";
//			print_r(str_getcsv($line));
		}	

	}

}
