<?php
namespace Baskets\Pages;
class Bids
{

///////////////////////////////////////////////

//////////     Page Display Switch   //////////

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
			case 'bid':
				self::bid();
				break;
			case 'old':
				self::old();
				break;
			default:
				Framework::$newurl = 'bids/list';
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
			$cols = array('id','bid','address','phone');
			echo '<tr>';
			foreach($cols as $col)
			{
				echo "<td>$col</td>";				
			}
			echo '</tr>';

			// Connect to DB and print bids
			$db = \Baskets\Tools\Database::getConnection();
			$stm = $db->prepare("SELECT * FROM bids");
			$stm->execute();
			while($bids = $stm->fetch())
			{
				echo "<tr class='list-item' onclick=\"document.location = '".MY_URL."/bids/bid/".$bids['id']."'\">";
				foreach($cols as $col)
				{
					echo '<td>' . $bids[$col] . '</td>';
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

//////////     ADD Bid    ///////////

///////////////////////////////////////

	public static function add()
	{
		Framework::page_header('Add Bid | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Add Bid</h1>
					<a href='<?=MY_URL?>/bids/list' class='add-button'>List Bids</a>
				</div>
				<p>
					<form class='formula-one'>
						<div class='line'>
							<div class='group'>
								<label for='supplier'>Supplier</label>
								<input type='text' name='supplier' id='supplier'>
							</div>
						</div>	
						<div class='line'>
							<div class='group'>
								<label for='bid'>Bid</label>
								<span><input type='text' name='bid' id='bid'></span>
							</div>
						</div>
						<div class='line'>
							
							<div class='group large'>
								<label for='part'>Part</label>
								<span><input type='text' name='part' id='part'></span>
							</div>
							<div class='group small'>
								<label for='price'>Price</label>
								<span><input type='number' name='price' id='price'></span>
							</div>
						</div>

						<div class='input-wrap'>
							<input type='hidden' name='job' value='add_bid'>
							<input type='submit'>
						</div>
					</form>
					<script>
						$( 'form' ).submit( function( event ) {
							event.preventDefault();
							var formdata = JSON.stringify($( this ).serializeObject());
							sender('bids',formdata);
						});

var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substrRegex;
 
    // an array that will be populated with substring matches
    matches = [];
 
    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');
 
    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        // the typeahead jQuery plugin expects suggestions to a
        // JavaScript object, refer to typeahead docs for more info
        matches.push({ value: str });
      }
    });
 
    cb(matches);
  };
};





var suppliers = [<? self::print_suppliers() ?>];

$('#supplier').typeahead({
	hint: true,
	highlight: true,
	minLength:0
},
{
	name: 'suppliers',
	displayKey: 'value',
	source: substringMatcher(suppliers)
});


var parts = [<? self::print_parts() ?>];

$('#part').typeahead({
	hint: true,
	highlight: true,
	minLength:1
},
{
	name: 'part',
	displayKey: 'value',
	source: substringMatcher(parts)
});





/*
					// Autocomplete Supplier Name
						var acs = completely(document.getElementById('supplier'),{
								fontSize: '24px',
								fontFamily: 'Arial',
								color: '#000',
							});
						acs.options = [<? self::print_suppliers() ?>];
						acs.input.onfocus= function() { 
							acs.repaint();
						}

					// Autocomplete Part

						var acp = completely(document.getElementById('part'),{
								fontSize: '24px',
								fontFamily: 'Arial',
								color: '#000',
							});
						acp.options = [<? self::print_parts() ?>];
						acp.input.onfocus= function() { 
							acp.repaint();
						}

*/
					</script>
				</p>
			</div>
		</div>
	<?	Framework::page_footer();
	}


	public static function print_suppliers(){
		$stm = \Baskets::$db->prepare("SELECT supplier FROM suppliers WHERE valid=true");
		$stm->execute();
		$first = true;
		while($res = $stm->fetch()){
			if(!$first) $comma = ',';
			else{
				$comma = '';
				$first = false;
			}
			echo "$comma\"".addslashes($res['supplier'])."\"";
		}
	}


	public static function print_parts(){
		$stm = \Baskets::$db->prepare("SELECT partid FROM parts");
		$stm->execute();
		$first = true;
		while($res = $stm->fetch()){
			if(!$first) $comma = ',';
			else{
				$comma = '';
				$first = false;
			}
			echo "$comma\"".addslashes($res['partid'])."\"";
		}
	}



///////////////////////////////////////

//////////     DISPLAY BID    ///////////

///////////////////////////////////////

	public static function bid()
	{
		$id = \Baskets\Tools\Tracker::$uri[3];
		$stm = \Baskets::$db->prepare('SELECT * FROM bids WHERE id=?');
		$stm->execute(array($id));
		$bid = $stm->fetch();
		Framework::page_header($bid['bid'] . ' | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Update a Bid</h1>
					<a href='<?=MY_URL?>/bids/list' class='add-button'>List Bids</a>
				</div>
				<p>
					<form class='formula-one'>
						<div class='line'>
							<div class='group'>
								<label for='bid'>Bid</label>
								<span><input type='text' name='bid' id='bid' value='<?=$bid['bid']?>'></span>
							</div>
						</div>
						<div class='line'>
							<div class='group'>
								<label for='address'>Address</label>
								<span><input type='text' name='address' id='address' value='<?=$bid['address']?>'></span>
							</div>
						</div>	
						<div class='line'>
							<div class='group'>
								<label for='address'>Email</label>
								<span><input type='email' name='email' id='email' value='<?=$bid['email']?>'></span>
							</div>
						</div>	
						<div class='line'>
							<div class='group'>
								<label for='bid-desc'>Phone</label>
								<span><input type='tel' name='phone' id='phone' value='<?=$bid['phone']?>'></span>
							</div>
						</div>
						<div class='line'>
							<div class='group'>
								<label for='bid-desc'>Fax</label>
								<span><input type='tel' name='fax' id='fax' value='<?=$bid['fax']?>'></span>
							</div>
						</div>
						<div class='input-wrap'>
							<input type='hidden' name='job' value='update_bid'>
							<input type='hidden' name='entry-id' value='<?=$bid['id']?>'>
							<input type='submit' value='Update'>
						</div>
					</form>
					<script>
						$( 'form' ).submit( function( event ) {
							event.preventDefault();
							var formdata = JSON.stringify($( this ).serializeObject());
							sender('bids',formdata);
						});
					</script>
				</p>
			</div>
		</div>
	<?	Framework::page_footer();
	}





}
