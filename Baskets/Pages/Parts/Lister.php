<?php
namespace Baskets\Pages\Parts;
class Lister
{

///////////////////////////////////////

//////////     PARTS LIST    //////////

///////////////////////////////////////

	public static function lister()
	{
		\Baskets\Pages\Framework::page_header('Parts List | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> All Parts</h1>
					<a href='<?=MY_URL?>/parts/add' class='add-button'>Add Parts</a>
				</div>
				<p>
					<table class='table-one'>

		<?
			// Print column titles
			$cols = array('id','partid','partdesc','upc');
			echo '<tr class="column-title">';
			foreach($cols as $col)
			{
				echo "<td>$col</td>";				
			}
			echo "<td>Price</td>";
			echo '</tr>';

			// Connect to DB and print parts
			$db = \Baskets\Tools\Database::getConnection();
			$stm = $db->prepare("SELECT * FROM parts");
			$stmp = $db->prepare("SELECT price FROM bidparts WHERE partid=? ORDER BY price ASC");
			$stm->execute();
			while($parts = $stm->fetch())
			{
				echo "<tr class='list-item' onclick=\"document.location = '".MY_URL."/parts/part/".$parts['id']."'\">";
				foreach($cols as $col)
				{
					echo '<td>' . $parts[$col] . '</td>';
				}
				$stmp->execute(array($parts['id']));
				echo '<td><select>';
				while($price = $stmp->fetch()){
					echo '<option>'.$price['price'].'</option>';
				}
				echo '</select></td>';
				echo '</tr></a>';
			}
		?>

					</table>
				</p>
			</div>
		</div>
<?php
		\Baskets\Pages\Framework::page_footer();
	}



}
