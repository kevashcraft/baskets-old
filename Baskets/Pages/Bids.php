<?php
namespace Baskets\Pages;
class Bids
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
				Framework::$newurl = 'suppliers/list';
				self::lister();
				break;
		}
	}




///////////////////////////////////////

//////////     BIDS LIST    //////////

///////////////////////////////////////

	public static function lister()
	{
		Framework::page_header('Bids | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> All Bids</h1>
					<a href='<?=MY_URL?>/bids/add' class='add-button'>Add Bid</a>
				</div>
				<p>
					<table style='width:100%'>

		<?
			// Print column titles
			$cols = array('id','supplier','address','phone');
			echo '<tr>';
			foreach($cols as $col)
			{
				echo "<td>$col</td>";				
			}
			echo '</tr>';

			// Connect to DB and print parts
			$db = \Baskets\Tools\Database::getConnection();
			$stm = $db->prepare("SELECT * FROM suppliers");
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

//////////     ADD BID    ///////////

///////////////////////////////////////

	public static function add()
	{
		Framework::page_header('Add Bid | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<h1><i class="fa fa-leaf"></i> Add Bid</h1>
				<p>
					<form class='formula-one'>
						<div class='line'>
							<div class='group'>
								<label for='supplier'>Supplier</label>
								<span><input type='text' name='supplier' id='supplier'></span>
							</div>
						</div>
						<div class='line'>
							<div class='group'>
								<label for='address'>Address</label>
								<span><input type='text' name='address' id='address'></span>
							</div>
						</div>	
						<div class='line'>
							<div class='group'>
								<label for='address'>Email</label>
								<span><input type='email' name='email' id='email'></span>
							</div>
						</div>	
						<div class='line'>
							<div class='group'>
								<label for='part-desc'>Phone</label>
								<span><input type='tel' name='phone' id='phone'></span>
							</div>
						</div>
						<div class='line'>
							<div class='group'>
								<label for='part-desc'>Fax</label>
								<span><input type='tel' name='fax' id='fax'></span>
							</div>
						</div>
						<div class='input-wrap'>
							<input type='hidden' name='job' value='add_supplier'>
							<input type='submit'>
						</div>
					</form>
					<script>
						$( 'form' ).submit( function( event ) {
							event.preventDefault();
							var formdata = JSON.stringify($( this ).serializeObject());
							sender('suppliers',formdata);
						});
					</script>
				</p>
			</div>
		</div>
	<?	Framework::page_footer();
	}






}
