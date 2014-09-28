<?php
namespace Baskets\Pages;
class Contractors
{
	public static function display()
	{

		$db = \Baskets\Tools\Database::getConnection();
		$stm = $db->prepare("SELECT * FROM contractors WHERE valid=true");
		$stm->execute();
		Defaults::header();	
?>
		<title>Baskets - Contractors</title>
	</head>
	<body>
	<?php Defaults::PageHeader() ?>
	<table style="width:100%">
	<?php
		$first = true;
		$keys = [];
		while($results = $stm->fetch(\PDO::FETCH_ASSOC))
		{
			if($first)
			{
				echo "<tr>";
				foreach(array_keys($results) as $key)
				{
					echo "<td>$key</td>";
					$keys[] = $key;
				}
				echo "</tr>";
				$first = false;
			}
			echo "<tr>";
			foreach($keys as $key)
			{
				echo "<td>".$results[$key]."</td>";
			}
			echo "</tr>";
		}
	?>
	</table>
	</body>
<?php
		Defaults::footer();
	}
}
