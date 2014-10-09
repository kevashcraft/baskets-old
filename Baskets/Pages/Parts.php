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
			case 'part':
				self::part();
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
			echo '<tr class="column-title">';
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
				echo "<tr class='list-item' onclick=\"document.location = '".MY_URL."/parts/part/".$parts['id']."'\">";
				foreach($cols as $col)
				{
					echo '<td>' . $parts[$col] . '</td>';
				}
				echo '</tr></a>';
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
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Add Parts</h1>
					<a href='<?=MY_URL?>/parts/list' class='add-button'>Parts List</a>
				</div>
				<p>
					<form class='formula-one'>
						<div class='line'>
							<div class='group small'>
								<label for='part-id'>ID</label>
								<span><input type='text' name='part-id' id='part-id'></span>
							</div>
							<div class='group large'>
								<label for='part-name'>Name</label>
								<span><input type='text' name='part-name' id='part-name'></span>
							</div>
						</div>	
						<div class='line'>
							<div class='group'>
								<label for='part-desc'>Description</label><br>
								<textarea name='part-desc' id='part-desc'></textarea>
							</div>
						</div>
						<div class='input-wrap'>
							<input type='hidden' name='job' value='add_part'>
							<input type='submit'>
						</div>
					</form>
					<script>
						$( 'form' ).submit( function( event ) {
							event.preventDefault();
							var formdata = JSON.stringify($( this ).serializeObject());
							sender('parts',formdata);
						});
					</script>
				</p>
			</div>
		</div>
	<?	Framework::page_footer();
	}



///////////////////////////////////////

//////////     DISPLAY PART    ///////////

///////////////////////////////////////

	public static function part()
	{
		$id = \Baskets\Tools\Tracker::$uri[3];
		$stm = \Baskets::$db->prepare('SELECT * FROM parts WHERE id=?');
		$stm->execute(array($id));
		$part = $stm->fetch();
		Framework::page_header($part['partid'] . ' | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Update a Part</h1>
					<a href='<?=MY_URL?>/parts/list' class='add-button'>Parts List</a>
				</div>
				<p>
					<form class='formula-one'>
						<div class='line'>
							<div class='group small'>
								<label for='part-id'>ID</label>
								<span><input type='text' name='part-id' id='part-id' value='<?=$part['partid']?>'></span>
							</div>
							<div class='group large'>
								<label for='part-name'>Name</label>
								<span><input type='text' name='part-name' id='part-name' value='<?=$part['partname']?>'></span>
							</div>
						</div>	
						<div class='line'>
							<div class='group'>
								<label for='part-desc'>Description</label><br>
								<textarea name='part-desc' id='part-desc'><?=$part['partdesc']?></textarea>
							</div>
						</div>
						<div class='input-wrap'>
							<input type='hidden' name='job' value='update_part'>
							<input type='hidden' name='entry-id' value='<?=$part['id']?>'>
							<input type='submit' value='Update'>
						</div>
					</form>
					<script>
						$( 'form' ).submit( function( event ) {
							event.preventDefault();
							var formdata = JSON.stringify($( this ).serializeObject());
							sender('parts',formdata);
						});
					</script>
				</p>
			</div>
		</div>
	<?	Framework::page_footer();
	}



}
