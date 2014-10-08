<?php
namespace Baskets\Pages;
class Parts
{

///////////////////////////////////////////////

//////////     Page Display Switct   //////////

///////////////////////////////////////////////

	public static function display()
	{
		switch (\Baskets\Tools\Tracker::$uri[2])
		{
			case 'list':
				self::lister();
				break;
			case 'add':
				self::add();
				break;
			case 'old':
				self::old();
				break;
			default:
				Framework::$newurl = 'parts/list';
				self::lister();
				break;
		}
	}




///////////////////////////////////////

//////////     PARTS LIST    //////////

///////////////////////////////////////

	public static function lister()
	{
		Framework::page_header('Parts List | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> All Parts</h1>
					<a href='<?=MY_URL?>/parts/add' class='add-button'>Add Parts</a>
				</div>
				<p>
					<table style='width:100%'>

		<?
			// Print column titles
			$cols = array('id','partid','partname','partdesc');
			echo '<tr>';
			foreach($cols as $col)
			{
				echo "<td>$col</td>";				
			}
			echo '</tr>';

			// Connect to DB and print parts
			$db = \Baskets\Tools\Database::getConnection();
			$stm = $db->prepare("SELECT * FROM parts");
			$stm->execute();
			while($parts = $stm->fetch())
			{
				echo '<tr>';
				foreach($cols as $col)
				{
					echo '<td>' . $parts[$col] . '</td>';
				}
				echo '</tr>';
			}
		?>

					</table>
				</p>
			</div>
		</div>
<?php
		Framework::page_footer();
	}







///////////////////////////////////////

//////////     ADD PARTS    ///////////

///////////////////////////////////////

	public static function add()
	{
		Framework::page_header('Add Parts | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<h1><i class="fa fa-leaf"></i> Add Parts</h1>
				<p>
					<form>
						Part ID: <input type='text' name='partid'><br>
						Part Name: <input type='text' name='partname'><br>
						Part Description: <input type='text' name='partdesc'><br>
						<input type='hidden' name='job' value='add_part'>
						<input type='submit'>
					</form>
					<script>
						$( 'form' ).submit( function( event ) {
							var formdata = JSON.stringify($( this ).serializeObject());
							sender('parts',formdata);
							event.preventDefault();
						});
					</script>
				</p>
			</div>
		</div>
	<?	Framework::page_footer();
	}






}
