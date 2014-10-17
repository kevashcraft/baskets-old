<?php
namespace Baskets\Pages;
class Contractors
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
			case 'contractor':
				self::contractor();
				break;
			case 'old':
				self::old();
				break;
			default:
				Framework::$newurl = 'contractors/list';
				self::lister();
				break;
		}
	}




///////////////////////////////////////

//////////     PARTS LIST    //////////

///////////////////////////////////////

	public static function lister()
	{
		Framework::page_header('Contractors | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> All Contractors</h1>
					<a href='<?=MY_URL?>/contractors/add' class='add-button'>Add Contractor</a>
				</div>
				<p>
					<table class='table-one'>

		<?
			// Print column titles
			$cols = array('id','contractor','address','phone');
			echo '<tr>';
			foreach($cols as $col)
			{
				echo "<td>$col</td>";				
			}
			echo '</tr>';

			// Connect to DB and print contractors
			$db = \Baskets\Tools\Database::getConnection();
			$stm = $db->prepare("SELECT * FROM contractors");
			$stm->execute();
			while($contractors = $stm->fetch())
			{
				echo "<tr class='list-item' onclick=\"document.location = '".MY_URL."/contractors/contractor/".$contractors['id']."'\">";
				foreach($cols as $col)
				{
					echo '<td>' . $contractors[$col] . '</td>';
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

//////////     ADD SUPPLIER    ///////////

///////////////////////////////////////

	public static function add()
	{
		Framework::page_header('Add Contractor | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Add Contractor</h1>
					<a href='<?=MY_URL?>/contractors/list' class='add-button'>List Contractors</a>
				</div>
				<p>
					<form class='formula-one'>
						<div class='line'>
							<div class='group'>
								<label for='contractor'>Contractor</label>
								<span><input type='text' name='contractor' id='contractor'></span>
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
								<label for='contractor-desc'>Phone</label>
								<span><input type='tel' name='phone' id='phone'></span>
							</div>
						</div>
						<div class='line'>
							<div class='group'>
								<label for='contractor-desc'>Fax</label>
								<span><input type='tel' name='fax' id='fax'></span>
							</div>
						</div>
						<div class='input-wrap'>
							<input type='hidden' name='job' value='add_contractor'>
							<input type='submit'>
						</div>
					</form>
					<script>
						$( 'form' ).submit( function( event ) {
							event.preventDefault();
							var formdata = JSON.stringify($( this ).serializeObject());
							sender('contractors',formdata);
						});
					</script>
				</p>
			</div>
		</div>
	<?	Framework::page_footer();
	}





///////////////////////////////////////

//////////     DISPLAY SUPPLIER    ///////////

///////////////////////////////////////

	public static function contractor()
	{
		$id = \Baskets\Tools\Tracker::$uri[3];
		$stm = \Baskets::$db->prepare('SELECT * FROM contractors WHERE id=?');
		$stm->execute(array($id));
		$contractor = $stm->fetch();
		Framework::page_header($contractor['contractor'] . ' | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Update a Contractor</h1>
					<a href='<?=MY_URL?>/contractors/list' class='add-button'>List Contractors</a>
				</div>
				<p>
					<form class='formula-one'>
						<div class='line'>
							<div class='group'>
								<label for='contractor'>Contractor</label>
								<span><input type='text' name='contractor' id='contractor' value='<?=$contractor['contractor']?>'></span>
							</div>
						</div>
						<div class='line'>
							<div class='group'>
								<label for='address'>Address</label>
								<span><input type='text' name='address' id='address' value='<?=$contractor['address']?>'></span>
							</div>
						</div>	
						<div class='line'>
							<div class='group'>
								<label for='address'>Email</label>
								<span><input type='email' name='email' id='email' value='<?=$contractor['email']?>'></span>
							</div>
						</div>	
						<div class='line'>
							<div class='group'>
								<label for='contractor-desc'>Phone</label>
								<span><input type='tel' name='phone' id='phone' value='<?=$contractor['phone']?>'></span>
							</div>
						</div>
						<div class='line'>
							<div class='group'>
								<label for='contractor-desc'>Fax</label>
								<span><input type='tel' name='fax' id='fax' value='<?=$contractor['fax']?>'></span>
							</div>
						</div>
						<div class='input-wrap'>
							<input type='hidden' name='job' value='update_contractor'>
							<input type='hidden' name='entry-id' value='<?=$contractor['id']?>'>
							<input type='submit' value='Update'>
						</div>
					</form>
					<script>
						$( 'form' ).submit( function( event ) {
							event.preventDefault();
							var formdata = JSON.stringify($( this ).serializeObject());
							sender('contractors',formdata);
						});
					</script>
				</p>
			</div>
		</div>
	<?	Framework::page_footer();
	}





}
