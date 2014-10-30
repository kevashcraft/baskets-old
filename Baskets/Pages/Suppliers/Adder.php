<?php
namespace Baskets\Pages;
class Suppliers
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
			case 'supplier':
				self::supplier();
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

//////////     PARTS LIST    //////////

///////////////////////////////////////

	public static function lister()
	{
		Framework::page_header('Suppliers | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> All Suppliers</h1>
					<a href='<?=MY_URL?>/suppliers/add' class='add-button'>Add Supplier</a>
				</div>
				<p>
					<table class='table-one'>

		<?
			// Print column titles
			$cols = array('id','supplier','address','phone');
			echo '<tr>';
			foreach($cols as $col)
			{
				echo "<td>$col</td>";				
			}
			echo '</tr>';

			// Connect to DB and print suppliers
			$db = \Baskets\Tools\Database::getConnection();
			$stm = $db->prepare("SELECT * FROM suppliers");
			$stm->execute();
			while($suppliers = $stm->fetch())
			{
				echo "<tr class='list-item' onclick=\"document.location = '".MY_URL."/suppliers/supplier/".$suppliers['id']."'\">";
				foreach($cols as $col)
				{
					echo '<td>' . $suppliers[$col] . '</td>';
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
		Framework::page_header('Add Supplier | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Add Supplier</h1>
					<a href='<?=MY_URL?>/suppliers/list' class='add-button'>List Suppliers</a>
				</div>
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
								<label for='supplier-desc'>Phone</label>
								<span><input type='tel' name='phone' id='phone'></span>
							</div>
						</div>
						<div class='line'>
							<div class='group'>
								<label for='supplier-desc'>Fax</label>
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





///////////////////////////////////////

//////////     DISPLAY SUPPLIER    ///////////

///////////////////////////////////////

	public static function supplier()
	{
		$id = \Baskets\Tools\Tracker::$uri[3];
		$stm = \Baskets::$db->prepare('SELECT * FROM suppliers WHERE id=?');
		$stm->execute(array($id));
		$supplier = $stm->fetch();
		Framework::page_header($supplier['supplier'] . ' | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Update a Supplier</h1>
					<a href='<?=MY_URL?>/suppliers/list' class='add-button'>List Suppliers</a>
				</div>
				<p>
					<form class='formula-one'>
						<div class='line'>
							<div class='group'>
								<label for='supplier'>Supplier</label>
								<span><input type='text' name='supplier' id='supplier' value='<?=$supplier['supplier']?>'></span>
							</div>
						</div>
						<div class='line'>
							<div class='group'>
								<label for='address'>Address</label>
								<span><input type='text' name='address' id='address' value='<?=$supplier['address']?>'></span>
							</div>
						</div>	
						<div class='line'>
							<div class='group'>
								<label for='address'>Email</label>
								<span><input type='email' name='email' id='email' value='<?=$supplier['email']?>'></span>
							</div>
						</div>	
						<div class='line'>
							<div class='group'>
								<label for='supplier-desc'>Phone</label>
								<span><input type='tel' name='phone' id='phone' value='<?=$supplier['phone']?>'></span>
							</div>
						</div>
						<div class='line'>
							<div class='group'>
								<label for='supplier-desc'>Fax</label>
								<span><input type='tel' name='fax' id='fax' value='<?=$supplier['fax']?>'></span>
							</div>
						</div>
						<div class='input-wrap'>
							<input type='hidden' name='job' value='update_supplier'>
							<input type='hidden' name='entry-id' value='<?=$supplier['id']?>'>
							<input type='submit' value='Update'>
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
