<?php
namespace Baskets\Incoming;
class PartsUploader
{
	public static function engine()
	{

//		print_r($_FILES['partslist']);
		$file = fopen($_FILES['partslist']['tmp_name'],'r');
		$cols = fgets($file);
		echo $cols;






	}



}
