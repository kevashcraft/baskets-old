<?php
namespace Baskets\Pages;
class Proposals
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
			case 'new':
				self::newer();
				break;
			case 'proposal':
				self::proposal();
				break;
			case 'old':
				self::old();
				break;
			default:
				Framework::$newurl = 'proposals/list';
				self::lister();
				break;
		}
	}




///////////////////////////////////////

//////////     BIDS LIST    //////////

///////////////////////////////////////

	public static function lister()
	{
		Framework::page_header('Proposals | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> All Proposals</h1>
					<a href='<?=MY_URL?>/proposals/add' class='add-button'>Add Proposal</a>
				</div>
				<p>
					<table class='table-one'>

		<?
			// Print column titles
			$cols = array('id','proposal');
			echo '<tr>';
			foreach($cols as $col)
			{
				echo "<td>$col</td>";				
			}
			echo '</tr>';

			// Connect to DB and print proposals
			$db = \Baskets\Tools\Database::getConnection();
			$stm = $db->prepare("SELECT * FROM proposals");
			$stm->execute();
			while($proposals = $stm->fetch())
			{
				echo "<tr class='list-item' onclick=\"document.location = '".MY_URL."/proposals/bid/".$bids['id']."'\">";
				foreach($cols as $col)
				{
					echo '<td>' . $proposals[$col] . '</td>';
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

//////////     ADD Proposal    ///////////

///////////////////////////////////////

	public static function newer()
	{
		Framework::page_header('Add Proposal | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Add Proposal</h1>
					<a href='<?=MY_URL?>/proposals/list' class='add-button'>List Proposals</a>
				</div>
				<p>
					<form class='formula-one'>
						<div class='line'>
							<div class='group'>
								<input type='text' name='contractor' id='contractor' placeholder='Contactor'>
							</div>
						</div>	
						<div class='line'>
							<div class='group'>
								<label for='model'>Model</label>
								<span><input type='text' name='model' id='model'></span>
							</div>
						</div>
						<div class='line'>
							<div class='group'>
								<label for='option'>Option</label>
								<span><input type='text' name='option' id='option'></span>
							</div>
						</div>
						<div id='rooms'>
							<div id='room0' style='display:none'>
								<input type='text' name='name-of-room0' placeholder='Room' onfocus='addRoomInput(0)'>
								<div id='room0-parts'>
									<div id='room0-part0'>
										<input type='text' name='room0-part0-id' placehold='Part ID' onfocus='addPartInput(0,0)'>
										<span id='room0-part0-name'></span>
										<select>
											<option val='custom'>$</option>
										</select>
										<input type='number' class='room-part-price' step='0.01' min='0.01' name='room0-part0-price' placeholder='0.01'>
									</div>
								</div>
							</div>
						</div>
						<div class='input-wrap'>
							<input type='hidden' name='job' value='add_proposal'>
							<input type='hidden' name='pp' id='pp' value='1'>
							<input type='submit'>
						</div>
					</form>
					<script>
						$( 'form' ).submit( function( event ) {
							event.preventDefault();
							var formdata = JSON.stringify($( this ).serializeObject());
							sender('proposals',formdata);
						});

						// PROPOSED ROOM INPUT ROW ADDITION
						$(function() { addRoomInput(0) } );

						function addRoomInput(rn) {
							nrn = rn + 1;
							next_room = document.getElementById('name-of-room' + nrn);

							if ( typeof(next_room) == 'undefined' || next_room == null) {
								var newRoom = document.getElementById('room0').cloneNode(true);
								newRoom.id = 'room' + nrn;
								newRoom.style.display = 'block';
								newRoom.childNodes[1].name = 'name-of-room' + nrn;
								console.log(newRoom.childNodes[3].childNodes[1]);
								newRoom.childNodes[3].childNodes[1].childNodes[1].name = 'room' + nrn + '-part0';
								newRoom.childNodes[3].childNodes[1].childNodes[3].id = 'room' + nrn + '-part0-name';
								newRoom.childNodes[3].childNodes[1].childNodes[3].name = 'room' + nrn + '-part0-price';
								document.getElementById('rooms').appendChild(newRoom);
							}

						}


						function addPartInput(rn,pn) {
							npn = pn + 1;
							next_part = document.getElementById('room' + rn + '-part' + npn);
							if ( typeof(next_part) == 'undefined' || next_part == null) {
								var newPart = document.getElementById('room0-part0').cloneNode(true);
								newPart.childNodes[1].name = 'room' + rn + '-part' + npn + '-id';
								console.log(newPart.childNodes[7]);
								newPart.childNodes[3].id = 'room' + rn + '-part' + npn + '-name';
								newPart.childNodes[7].name = 'room' + rn + '-part' + npn + '-price';
								document.getElementById('room' + rn + '-parts').appendChild(newPart);
							}
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
	document.getElementById('proposal-pp-cont').appendChild(pp);
	document.getElementById('pp').value = numparts;
	tahead('part'+numparts);
}




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

//////////     Update Proposal    ///////////

///////////////////////////////////////

	public static function proposal()
	{
		$stm = \Baskets::$db->prepare("SELECT * FROM proposals WHERE id=?");
		$stm->execute(array(\Baskets\Tools\Tracker::$uri[3]));
		$proposal = $stm->fetch();

		$stm = \Baskets::$db->prepare("SELECT supplier FROM suppliers WHERE id=?");
		$stm->execute(array($proposal['supplierid']));
		$res = $stm->fetch();
		$supplier = $res['supplier'];

		Framework::page_header('Update Proposal ' . $proposal['bid'] . ' | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Update Proposal</h1>
					<a href='<?=MY_URL?>/proposals/list' class='add-button'>List Proposals</a>
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
								<label for='proposal'>Proposal</label>
								<span><input type='text' name='proposal' id='bid' value='<?=$bid['bid']?>'></span>
							</div>
						</div>
						<div class='proposal-pp-cont' id='bid-pp-cont'>
							<div class='proposal-pp-line'>
								<div class='proposal-part'>Part ID</div>
								<div class='proposal-name'>Name</div>
								<div class='proposal-price'>Price</div>
							</div>
							<div class='proposal-pp-line' id='pp0' style='display:none'>
								<div class='proposal-part'><input type='text' name='part0' id='part0' data-pn='0' onfocus="checkpp(this)"></div>
								<div class='proposal-name'>item name here</div>
								<div class='proposal-price'><input type='number' name='price0' id='price0' data-pn='0' onfocus="checkpp(this)"></div>
							</div>
						<?
							$astm = \Baskets::$db->prepare("SELECT * FROM parts WHERE id=?");
							$stm = \Baskets::$db->prepare("SELECT * FROM proposalparts WHERE bidid=?");
							$stm->execute(array($proposal['id']));
							$pp=0;
							while($bp = $stm->fetch()) {
								$pp++;
								$astm->execute(array($bp['partid']));
								$part = $astm->fetch();
								?>
							<div class='proposal-pp-line' id='pp<?=$pp?>'>
								<div class='proposal-part'><input value='<?=$part['partid']?>' type='text' name='part<?=$pp?>' id='part<?=$pp?>' data-pn='<?=$pp?>' onfocus="checkpp(this)"></div>
								<div class='proposal-name'><?=$part['partname']?></div>
								<div class='proposal-price'><input value='<?=$bp['price']?>' type='number' step="0.01" name='price<?=$pp?>' id='price<?=$pp?>' data-pn='<?=$pp?>' onfocus="checkpp(this)"></div>
							</div>
							<script>
								$(function(){ tahead('part<?=$pp?>'); });
							</script>
							<? } ?>
						</div>

						<div class='input-wrap'>
							<input type='hidden' name='job' value='update_proposal'>
							<input type='hidden' name='proposalid' value='<?=$bid['id']?>'>
							<input type='hidden' name='pp' id='pp' value='<?=$pp?>'>
							<input type='submit' value='Update'>
						</div>
					</form>
					<script>
						$( 'form' ).submit( function( event ) {
							event.preventDefault();
							var formdata = JSON.stringify($( this ).serializeObject());
							sender('proposals',formdata);
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
	document.getElementById('proposal-pp-cont').appendChild(pp);
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
