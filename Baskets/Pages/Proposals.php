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
			default:
				Framework::$newurl = 'proposals/list';
				self::lister();
				break;
		}
	}




///////////////////////////////////////

//////////     LIST PROPOSAL   //////////

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
						<div id='rooms'>
							<div data-rn='0' style='display:none'>
								<input type='text' name='room' placeholder='Room' >
								<div class='parts'>
									<div class='part' data-pn='0'>
										<input type='text' class='partid' name='partid' placehold='Part ID' >
										<span class='partname'></span>
										<select class='partprices'>
											<option value='custom'>Custom</option>
										</select>
										<input type='number' class='partprice' step='0.01' min='0.01' name='partprice' placeholder='0.01'>
									</div>
								</div>
							</div>
						</div>
						<div class='line'>
							<div class='group'>
								<label for='parts-total'>Parts</label>
								<span><input type='number' step='0.01' min='0.01' name='parts-total' id='parts-total'></span>
							</div>
						</div>
						<div class='line'>
							<div class='group'>
								<label for='labor-total'>Labor</label>
								<span><input type='number' step='0.01' min='0.01' name='labor-total' id='labor-total'></span>
							</div>
						</div>
						<div class='line'>
							<div class='group'>
								<label for='profit-margin'>Profit Margin</label>
								<span><input type='number' step='0.01' min='0.01' name='profit-margin' id='profit-margin'></span>
							</div>
						</div>
						<div class='line'>
							<div class='group'>
								<label for='adjustment'>Adjust +/-</label>
								<span><input type='number' step='0.01' min='0.01' name='adjustment' id='adjustment'></span>
							</div>
						</div>
						<div class='line'>
							<div class='group'>
								<label for='total-dollar'>Total</label>
								<span><input type='number' step='0.01' min='0.01' name='total-dollar' id='total-dollar'></span>
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


						function selcus(that) {
							console.log(that.parentNode.getElementsByClassName('room-part-price')[0].value);
							that.parentNode.getElementsByClassName('room-part-price')[0].value = that.options[that.selectedIndex].value;
						}

						$(function() { addRoomInput(0) } );

						function addRoomInput(rn) {
							console.log(rn);
							var nrn = rn + 1;
							if ( typeof(document.querySelectorAll('[data-rn]')[nrn]) == 'undefined' ) {
								var newRoom = document.querySelectorAll('[data-rn]')[0].cloneNode(true);
								newRoom.setAttribute('data-rn',nrn);
								newRoom.style.display = 'block';
								newRoom.getElementsByTagName('input')[0].onfocus = function() { addRoomInput(nrn); };
								newRoom.getElementsByClassName('partprice')[0].onchange = function() { $(this).siblings('select').val('custom'); };
								newRoom.getElementsByClassName('partprices')[0].onchange = function() { if(this.value != 'custom') $(this).siblings('.partprice').val(this.value); };
								newRoom.getElementsByClassName('partid')[0].onfocus = function() { addPartInput(nrn,0); };
								console.log(newRoom.getElementsByTagName('input')[0].onfocus);
								document.getElementById('rooms').appendChild(newRoom);
							}

						}


						function addPartInput(rn,pn) {
							var npn = pn + 1;
							if ( typeof(document.querySelectorAll('[data-rn]')[rn].querySelectorAll('[data-pn]')[npn]) == 'undefined') {
								var newPart = document.querySelectorAll('[data-rn]')[0].querySelectorAll('[data-pn]')[0].cloneNode(true);
								newPart.setAttribute('data-pn',npn);
								newPart.getElementsByClassName('partid')[0].name = 'partid' + npn;
								newPart.getElementsByClassName('partid')[0].onfocus = function() { addPartInput(rn,npn); };
								newPart.getElementsByClassName('partprice')[0].onchange = function() { $(this).siblings('select').val('custom'); };
								document.querySelectorAll('[data-rn]')[rn].getElementsByClassName('parts')[0].appendChild(newPart);
								var curPart = document.querySelectorAll('[data-rn]')[rn].querySelectorAll('[data-pn]')[pn].getElementsByClassName('partid')[0];
								partautoc(curPart);
								curPart.onfocus = function () { partautoc(this); };
								curPart.onblur = function () { 
									$(this).autocomplete('destroy');
									part_name(this);
									part_prices(this);
								}; 

							}




						}

function part_name(that){
	$.ajax({
		url: '<?=MY_URL?>',
		data: { tiny: 'part_desc',
					tp: that.value
				}
	}).done(function(data){
		console.log(data);
		console.log($(that).next());
		$(that).next().html(data);
	});
}

function part_prices(that) {
	$.ajax({
		url: '<?=MY_URL?>',
		data: { tiny: 'part_prices',
					tp: that.value
				}
	}).done(function(data){
		console.log(data);
		var lowestprice = 99999999;
		$.each(JSON.parse(data), function(i,value) {
			console.log(value);
			console.log($(that).siblings('select'));
			$(that).siblings('select').append($('<option>').text(value).attr('value',value));
			if(value < lowestprice) {
				$(that).siblings('select').val(value);
				lowestprice = value;
			}
			$(that).siblings('input').val(lowestprice);
		});
	});
	
}


function partautoc(that) {
	console.log(that);
	$(that).autocomplete({
		source: function(request,response) {
			$.get( '<?=MY_URL?>', { 
				tiny: 'part_id',
				part_id: request.term
			}, function (data) {
				var parsed = JSON.parse(data);
				var partslist = [];

				for(var x in parsed) {
					partslist.push( parsed[x] );
				}
			

				console.log(partslist);
				response(partslist);
		
			});
		},
		minLength: 3
	});



}


$(function() {
	$('#contractor').typeahead({
		hint: true,
		highlight: true,
		minLength:3
	},
	{
		name: 'contractor',
		displayKey: 'value',
		source: substringMatcher(contractors)
	});
});

var contractors = [<? self::print_contractors() ?>];




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


	// PRINTS CONTRACTORS
	public static function print_contractors(){
		$stm = \Baskets::$db->prepare("SELECT contractor FROM contractors WHERE valid=true");
		$stm->execute();
		$first = true;
		while($res = $stm->fetch()){
			if(!$first) $comma = ',';
			else{
				$comma = '';
				$first = false;
			}
			echo "$comma\"".addslashes($res['contractor'])."\"";
		}



	}


	// PRINTS PARTS
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
