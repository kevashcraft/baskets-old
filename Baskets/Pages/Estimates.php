<?php
namespace Baskets\Pages;
class Estimates
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
			case 'estimate':
				self::estimate();
				break;
			case 'old':
				self::old();
				break;
			default:
				Framework::$newurl = 'estimates/list';
				self::lister();
				break;
		}
	}




///////////////////////////////////////

//////////     BIDS LIST    //////////

///////////////////////////////////////

	public static function lister()
	{
		Framework::page_header('Estimates | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> All Estimates</h1>
					<a href='<?=MY_URL?>/estimates/add' class='add-button'>Add Estimate</a>
				</div>
				<p>
					<table class='table-one'>

		<?
			// Print column titles
			$cols = array('id','estimate');
			echo '<tr>';
			foreach($cols as $col)
			{
				echo "<td>$col</td>";				
			}
			echo '</tr>';

			// Connect to DB and print estimates
			$db = \Baskets\Tools\Database::getConnection();
			$stm = $db->prepare("SELECT * FROM estimates");
			$stm->execute();
			while($estimates = $stm->fetch())
			{
				echo "<tr class='list-item' onclick=\"document.location = '".MY_URL."/estimates/bid/".$bids['id']."'\">";
				foreach($cols as $col)
				{
					echo '<td>' . $estimates[$col] . '</td>';
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

//////////     ADD Estimate    ///////////

///////////////////////////////////////

	public static function add()
	{
		Framework::page_header('Add Estimate | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Add Estimate</h1>
					<a href='<?=MY_URL?>/estimates/list' class='add-button'>List Estimates</a>
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
								<label for='estimate'>Estimate</label>
								<span><input type='text' name='estimate' id='bid'></span>
							</div>
						</div>
						<div class='estimate-pp-cont' id='bid-pp-cont'>
							<div class='estimate-pp-line'>
								<div class='estimate-part'>Part ID</div>
								<div class='estimate-name'>Name</div>
								<div class='estimate-price'>Price</div>
							</div>
							<div class='estimate-pp-line' id='pp0' style='display:none'>
								<div class='estimate-part'><input type='text' name='part0' id='part0' onblur="part_name(this)" data-pn='0' onfocus="checkpp(this)"></div>
								<div class='estimate-name'>item name here</div>
								<div class='estimate-price'><input type='number' step="0.01" name='price0' id='price0' data-pn='0' onfocus="checkpp(this)"></div>
							</div>
						</div>

						<div class='input-wrap'>
							<input type='hidden' name='job' value='add_estimate'>
							<input type='hidden' name='pp' id='pp' value='1'>
							<input type='submit'>
						</div>
					</form>
					<script>
						$( 'form' ).submit( function( event ) {
							event.preventDefault();
							var formdata = JSON.stringify($( this ).serializeObject());
							sender('estimates',formdata);
						});
function part_name(that){
	console.log('here');
	var np = that.getAttribute('data-pn');
	$.ajax({
		url: '<?=MY_URL?>',
		data: { tiny: 'part_name',
					tp: that.value
				}
	}).done(function(data){
		var nn = 'partname' + np;
		console.log(nn);
		document.getElementById(nn).innerHTML = data;
	});
}

var numparts = 0;

function checkpp(elem){
	var mynum = elem.getAttribute('data-pn');
	if (mynum == numparts) addpp();
}

function addpp(){
	var pp = document.getElementById('pp0').cloneNode(true);
	numparts++;
	pp.id = 'pp' + numparts;
	pp.style.display = 'block';
	pp.childNodes[1].firstChild.id = 'part' + numparts;
	pp.childNodes[1].firstChild.name = 'part' + numparts;
	pp.childNodes[1].firstChild.setAttribute('data-pn', numparts);
	pp.childNodes[3].id = 'partname' + numparts;
	console.log( pp.childNodes[1].firstChild);
	pp.childNodes[5].firstChild.id = 'price' + numparts;
	pp.childNodes[5].firstChild.name = 'price' + numparts;
	pp.childNodes[5].firstChild.setAttribute('data-pn', numparts);
	document.getElementById('estimate-pp-cont').appendChild(pp);
	document.getElementById('pp').value = numparts;
	tahead('part'+numparts);
}

$(function(){
	addpp();
	console.log('oneo');
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
function tahead(docid){
	$('#'+docid).typeahead({
		hint: true,
		highlight: true,
		minLength:1
	},
	{
		name: 'part',
		displayKey: 'value',
		source: substringMatcher(parts)
	});
}




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



///////////////////////////////////////

//////////     Update Estimate    ///////////

///////////////////////////////////////

	public static function estimate()
	{
		$stm = \Baskets::$db->prepare("SELECT * FROM estimates WHERE id=?");
		$stm->execute(array(\Baskets\Tools\Tracker::$uri[3]));
		$estimate = $stm->fetch();

		$stm = \Baskets::$db->prepare("SELECT supplier FROM suppliers WHERE id=?");
		$stm->execute(array($estimate['supplierid']));
		$res = $stm->fetch();
		$supplier = $res['supplier'];

		Framework::page_header('Update Estimate ' . $estimate['bid'] . ' | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Update Estimate</h1>
					<a href='<?=MY_URL?>/estimates/list' class='add-button'>List Estimates</a>
				</div>
				<p>
					<form class='formula-one'>
						<div class='line'>
							<div class='group'>
								<label for='supplier'>Supplier</label>
								<input type='text' name='supplier' id='supplier' value='<?=$supplier?>'>
							</div>
						</div>	
						<div class='line'>
							<div class='group'>
								<label for='estimate'>Estimate</label>
								<span><input type='text' name='estimate' id='bid' value='<?=$bid['bid']?>'></span>
							</div>
						</div>
						<div class='estimate-pp-cont' id='bid-pp-cont'>
							<div class='estimate-pp-line'>
								<div class='estimate-part'>Part ID</div>
								<div class='estimate-name'>Name</div>
								<div class='estimate-price'>Price</div>
							</div>
							<div class='estimate-pp-line' id='pp0' style='display:none'>
								<div class='estimate-part'><input type='text' name='part0' id='part0' data-pn='0' onfocus="checkpp(this)"></div>
								<div class='estimate-name'>item name here</div>
								<div class='estimate-price'><input type='number' name='price0' id='price0' data-pn='0' onfocus="checkpp(this)"></div>
							</div>
						<?
							$astm = \Baskets::$db->prepare("SELECT * FROM parts WHERE id=?");
							$stm = \Baskets::$db->prepare("SELECT * FROM estimateparts WHERE bidid=?");
							$stm->execute(array($estimate['id']));
							$pp=0;
							while($bp = $stm->fetch()) {
								$pp++;
								$astm->execute(array($bp['partid']));
								$part = $astm->fetch();
								?>
							<div class='estimate-pp-line' id='pp<?=$pp?>'>
								<div class='estimate-part'><input value='<?=$part['partid']?>' type='text' name='part<?=$pp?>' id='part<?=$pp?>' data-pn='<?=$pp?>' onfocus="checkpp(this)"></div>
								<div class='estimate-name'><?=$part['partname']?></div>
								<div class='estimate-price'><input value='<?=$bp['price']?>' type='number' step="0.01" name='price<?=$pp?>' id='price<?=$pp?>' data-pn='<?=$pp?>' onfocus="checkpp(this)"></div>
							</div>
							<script>
								$(function(){ tahead('part<?=$pp?>'); });
							</script>
							<? } ?>
						</div>

						<div class='input-wrap'>
							<input type='hidden' name='job' value='update_estimate'>
							<input type='hidden' name='estimateid' value='<?=$bid['id']?>'>
							<input type='hidden' name='pp' id='pp' value='<?=$pp?>'>
							<input type='submit' value='Update'>
						</div>
					</form>
					<script>
						$( 'form' ).submit( function( event ) {
							event.preventDefault();
							var formdata = JSON.stringify($( this ).serializeObject());
							sender('estimates',formdata);
						});

var numparts = <?=$pp?>;

function checkpp(elem){
	var mynum = elem.getAttribute('data-pn');
	if (mynum == numparts) addpp();
}

/*	Add another part-price line	*/	
function addpp(){
	var pp = document.getElementById('pp0').cloneNode(true);
	numparts++;
	pp.id = 'pp' + numparts;
	pp.style.display = 'block';
	pp.childNodes[1].firstChild.id = 'part' + numparts;
	pp.childNodes[1].firstChild.name = 'part' + numparts;
	pp.childNodes[1].firstChild.setAttribute('data-pn', numparts);
	console.log( pp.childNodes[1].firstChild);
	pp.childNodes[5].firstChild.id = 'price' + numparts;
	pp.childNodes[5].firstChild.name = 'price' + numparts;
	pp.childNodes[5].firstChild.setAttribute('data-pn', numparts);
	document.getElementById('estimate-pp-cont').appendChild(pp);
	document.getElementById('pp').value = numparts;
	tahead('part'+numparts);
}


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
function tahead(docid){
	$('#'+docid).typeahead({
		hint: true,
		highlight: true,
		minLength:1
	},
	{
		name: 'part',
		displayKey: 'value',
		source: substringMatcher(parts)
	});
}


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


}
