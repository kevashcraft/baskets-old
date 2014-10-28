<?php
namespace Baskets\Pages\Proposals;
class Scripts
{

	public static function defscripts()
	{ ?>
<script>
$(function() {


	var contractorsList = [];
	$.get( '<?=MY_URL?>', { 
		tiny: 'contractors'
	}, function (data) {
			var parsed = JSON.parse(data);
			for(var x in parsed) {
				contractorsList.push( parsed[x] );
			}
			console.log(contractorsList);
			$('[name="contractor"]').autocomplete({
				source: contractorsList
			});
		}
	);
});

</script>

	<? }




	public static function propformer()
	{
		?>
<script>
	function propformer () {


	}


function propO(e){
	e.preventDefault();
	console.log('oooooooooOOOOOOOOOHHH BABY!');

	var p = {};

	p.laborRate = Number($('[name="laborrate"]').val());
	p.partMarkUp = Number($('[name="partmarkup"]').val()) / 100 + 1;
	p.desiredMargin = Number($('[name="desiredmargin"]').val()) / 100;
	p.contingency = Number($('[name="contingency"]').val());
	p.taxRate = Number($('[name="taxrate"]').val()) / 100;
	

	p.rooms = [];

	$('[data-rn]').each(function() {
		 var msel = $(this);
		if(msel.attr('data-rn') != 0) {
			var roomName = msel.children('[name="room"]').val();
			if(roomName != '') {
				p.rooms[roomName] = {};
				p.rooms[roomName].parts = [];
				msel.find('[data-pn]').each(function() {
					var dsel = $(this),
						partID = dsel.children('[name="partid"]').val();
					if(partID != '') {
						p.rooms[roomName].parts[partID] = [],
						mytp = p.rooms[roomName].parts[partID],
						mytp['price'] = dsel.children('[name="partprice"]').val(),
						mytp['insallPoint'] = dsel.children('[name="installpoint"]').val(),
						mytp['qty'] = dsel.children('[name="partqty"]').val(),
						mytp['parthours'] = dsel.children('[name="parthours"]').val();
						console.log('MY PART');
						console.log(mytp);
					}
				});
				console.log('ROOM & Parts');
				console.log(roomName);
				console.log(Object.keys(p.rooms[roomName].parts));
			}
		}
	});
	

}

			



		</script>
		<?
	}





	public static function juitabs()
	{
		?>
<script>
$(function() {
	var tabTitle = $('#tab_title'),
		tabTemplate = "<li><a class='tab-title' data-tabname='#{label}' href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close' role='presentation'>Remove Tab</span></li>",	
		tabCounter = 2;

	var tabs = $('#tabs').tabs();
	var dialog = $( "#dialog" ).dialog({
		autoOpen: false,
		modal: true,
		buttons: {
		  Add: function() {
			 addTab();
			 $( this ).dialog( "close" );
		  },
		  Cancel: function() {
			 $( this ).dialog( "close" );
		  }
		},
		close: function() {
		  form[ 0 ].reset();
		}
	 });
	 // addTab form: calls addTab function on submit and closes the dialog
	 var form = dialog.find( "form" ).submit(function( event ) {
		addTab();
		dialog.dialog( "close" );
		event.preventDefault();
	 });
 
	 // actual addTab function: adds new tab using the input from the form above
	 function addTab() {
		var label = tabTitle.val() || "Tab " + tabCounter,
		  id = "tabs-" + tabCounter,
		  li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) );
		var cT = tabCounter - 1;
		var tabContentHtml = $('#tabs-' + cT).clone();
		$(tabContentHtml).attr('id',id);
		$(tabContentHtml).attr('data-tabname',label);
		$(tabContentHtml).find('.partprices').html("<option value='custom'>Custom</option>");
		$(tabContentHtml).find('.partprice').val('');
		$(tabContentHtml).find('.partdesc').val('');
		$(tabContentHtml).find('.partid').val('');



		tabs.find( ".ui-tabs-nav" ).append( li );
		tabs.append( tabContentHtml  );
		tabs.tabs( "refresh" );
		tabCounter++;
		var tC = tabCounter - 2;
		$( "#tabs" ).tabs( "option", "active", tC );
		copyRooms(cT);
		$('input[name="room"]').unbind('focus').focus(function() { addRoomInput(this); roomupdater(this); } );
		$('input[name="partid"]').unbind('focus').focus(function() { addPartInput(this); partautoc(this); } );
		setpartupdater();
						

		plsUpdate();

	 }
 
	 // addTab button: just opens the dialog
	 $( "#add_tab" )
		.button()
		.click(function() {
			event.preventDefault();
		  dialog.dialog( "open" );
		});
 
	 // close icon: removing the tab on click
	 tabs.delegate( "span.ui-icon-close", "click", function() {
		var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
		$( "#" + panelId ).remove();
		tabs.tabs( "refresh" );
	 });
 
	 tabs.bind( "keyup", function( event ) {
		if ( event.altKey && event.keyCode === $.ui.keyCode.BACKSPACE ) {
		  var panelId = tabs.find( ".ui-tabs-active" ).remove().attr( "aria-controls" );
		  $( "#" + panelId ).remove();
		  tabs.tabs( "refresh" );
		}
	 });
  });
</script>
		<?
	}



	public static function propform()
	{
		?>

		<script>
						$(function() { addRoomInput($('#room-template').children('input')); plsUpdate(); } );

						function addRoomInput(elem) {
							var activeTabNumber = $( "#tabs" ).tabs( "option", "active" ) + 1;
							var aT = $('#tabs-'+activeTabNumber);
							var numberOfRooms = aT.find('[data-rn]').length;
							console.log('nor='+numberOfRooms);
							var thisRoomNumber = $(elem).parent().attr('data-rn');
							console.log('trn'+thisRoomNumber); 

							if(numberOfRooms == thisRoomNumber) {
								console.log('you appear to be using the last room, going to add another blank one');

								var nrn = numberOfRooms + 1;
								var newRoom = document.getElementById('room-template').cloneNode(true);
								newRoom.id = '';
								$(newRoom).children('[name="room"]').focus(function() { roomupdater(this); });
								newRoom.getElementsByClassName('part')[0].id='';
								newRoom.setAttribute('data-rn',nrn);
								newRoom.style.display = 'block';
								newRoom.getElementsByTagName('input')[0].onfocus = function() { addRoomInput(this); };
								newRoom.getElementsByClassName('partprice')[0].onchange = function() { 
									$(this).siblings('select').val('custom');
									plsUpdate(); 
								};
								newRoom.getElementsByClassName('partprices')[0].onchange = function() { if(this.value != 'custom') $(this).siblings('.partprice').val(this.value); };
								newRoom.getElementsByClassName('partid')[0].onfocus = function() { addPartInput(this); };
								$('.rooms').append(newRoom);
	
							}

						}




						function addPartInput(elem) {
							console.log('at part adder');
							var activeTabNumber = $( "#tabs" ).tabs( "option", "active" ) + 1;
							var aT = $('#tabs-'+activeTabNumber);
							var thisRoomNumber = $(elem).parents('[data-rn]').attr('data-rn');
							var numberOfParts = aT.find('[data-rn="'+thisRoomNumber+'"]').find('[data-pn]').length;
							console.log('nop='+numberOfParts);
							var thisPartNumber = $(elem).parent().attr('data-pn');
							console.log('tpn'+thisPartNumber); 

							if(numberOfParts == thisPartNumber) {
								var npn = numberOfParts + 1;
								var pn = thisPartNumber;
								var rn = thisRoomNumber;
								var newPart = document.getElementById('part-template').cloneNode(true);
								newPart.id = '';
								newPart.setAttribute('data-pn',npn);
								newPart.getElementsByClassName('partid')[0].onfocus = function() { addPartInput(this); };
								newPart.getElementsByClassName('partprice')[0].onchange = function() {
									$(this).siblings('select').val('custom');
									update_totals();
								};
								$('[data-rn="'+rn+'"]').find('.parts').append(newPart);
								partautoc(elem);
								elem.onfocus = function () { partautoc(this); };

							}




						}

function roomupdater(that) {
	var mytv = $(that).val();
	var nrn = $(that).parent('[data-rn]').attr('data-rn');
	$(that).blur(function() {
		if($(this).val() != mytv && mytv != '') {
			var nv = $(this).val();
			$('[data-rn="' + nrn + '"]').each(function() {
				$(this).children('[name="room"]').val(nv);
			});
		}
		$(this).unbind('blur');
	});
}


function part_name(that){
	$.ajax({
		url: '<?=MY_URL?>',
		data: { tiny: 'part_info',
					tp: that.value
				}
	}).done(function(data){
		var pdata = JSON.parse(data);
		$(that).siblings('[name="partdesc"]').val(pdata.desc);
		$(that).parent('[data-pn]').attr('data-entryid',pdata.id);
		$(that).siblings('[name="installpoint"]').val(pdata.installpoint);
	});




}

function part_prices(that) {
	$.ajax({
		url: '<?=MY_URL?>',
		data: { tiny: 'part_prices',
					tp: that.value
				}
	}).done(function(data){
		$(that).siblings('select[name="partprices"]').html('');
		console.log(data);
		var lowestprice = 99999999;
		$.each(JSON.parse(data), function(i,value) {
			$(that).siblings('select[name="partprices"]').append($('<option>').text(i + ' - ' + value.bidid).attr('value',value.price));
			if(value.price < lowestprice) {
				$(that).siblings('select[name="partprices"]').val(value.price);
				lowestprice = value.price;
			}
			$(that).siblings('[name="partprice"]').val(lowestprice);
		});
		plsUpdate();
//		$(that).parent().next('[data-pn]').children('.partid').focus();
	});
	
}


function partautoc(that) {
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


	that.onblur = function () { 
		$(this).autocomplete('destroy');
		part_name(this);
		part_prices(this);
	}; 

}


function cl(logg) {
	console.log(logg);
}

// The tab title / total update controller
function plsUpdate ( upwhat ) {

	cl('update control init.');

	var upwhat = upwhat || $( "#tabs" ).tabs( "option", "active" ) + 1;

	cl('upwhat='+upwhat);
	
	if ( upwhat == 'all' ) {
		var numOfTabs = $('[data-tabname]').length;
		cl('not='+numOfTabs);
		for ( var t = 1; t <= numOfTabs; t++ ) {
			cl('asking for update on t='+t);
			updateTotes ( t );
		}
	} else {
		cl('asking for single update on '+upwhat);
		updateTotes ( upwhat );
	}
	setpartupdater();	

}


var indinum = 0;
function updateTotes( tabnumi ) {

	var activeTabNumber = tabnumi,
		aT = $('#tabs-'+activeTabNumber),
		laborRate = Number($('[name="laborrate"]').val()),
		partMarkUp = Number($('[name="partmarkup"]').val()) / 100 + 1,
		desiredMargin = Number($('[name="desiredmargin"]').val()) / 100,
		contingency = Number($('[name="contingency"]').val()),
		taxRate = Number($('[name="taxrate"]').val()) / 100,
		tabName = aT.attr('data-tabname');



	cl('activeTabNumber='+activeTabNumber);
	cl('aT='+aT);
	cl('laborRate='+laborRate);
	cl('partMarkUp='+partMarkUp);
	cl('desiredMargin='+desiredMargin);
	cl('contingency='+contingency);
	cl('taxRate='+taxRate);
	cl('tabName='+tabName);

	var tubsetHours = 0,
		trimHours = 0,
		roughInHours = 0;

	aT.find('[name="installpoint"]:checked').each(function() {
		var thisis = $(this).val();
		cl('thisis'+thisis);
		var thishours = Number($(this).siblings('[name="parthours"]').val());
		switch(thisis) {
			case 'roughin':
				roughInHours += thishours;
				break;
			case 'tubset':
				tubsetHours += thishours;
				break;
			case 'trim':
				trimHours += thishours;
				break;
		}
	});

	cl('roughInHours='+roughInHours);
	cl('tubsetHours='+tubsetHours);
	cl('trimHours='+trimHours);

	var totesHours = trimHours + tubsetHours + roughInHours;
	cl('totesHours='+totesHours);

	var totesParts = 0;
	aT.find('[name="partprice"]').each(function() {
		var adder = Number($(this).val()) || 0;
		totesParts += adder;
	});
	cl('totesParts='+totesParts);
	
	var partCost = 0;
	aT.find('[name="partprice"]').each(function() {
		var adder = Number($(this).val()) || 0;
		partCost += adder;
	});
	
	cl('partCost='+partCost);

	var adjustment = aT.find('[name="adjustment"]').val();

	cl('adjustment='+adjustment);

	var propToteCost = partCost + ( totesHours * laborRate);
	cl('propToteCost='+propToteCost);

	var propTotePriceSubTax = (partCost * partMarkUp) + (totesHours * laborRate) + adjustment;
	cl('propTotePriceSubTax='+propTotePriceSubTax);

	var propTotePrice = propTotePriceSubTax * taxRate;

	cl('propTotePrice='+propTotePrice);
	var newTitle = tabName + ' - ' + propToteCost;

	cl('newTitle='+newTitle);

	$('a[data-tabname="' + tabName + '"]').html(newTitle);



	aT.find('[type="number"]').each(function() { 
		$(this).unbind('focus');
		$(this).focus(function() {
			var myOriginalVal = $(this).val();
			$(this).blur(function() {
				if ( $(this).val() != myOriginalVal ) {
					plsUpdate();
				}
				$(this).unbind('blur');
			});
		});
	});


	cl(indinum);
	indinum += 1;
}





function copyRooms(mytc) {
	var mytc = mytc || 1;
	$('#tabs-' + mytc).find('[data-rn]').each(function() {
		var myRoom = $(this).children('input').val(),
			rn = $(this).attr('data-rn');
		$('[data-rn="' + rn + '"]').each(function() {
			$(this).children('input').val(myRoom);
		});
	});

}


function setpartupdater() {
	console.log('setting');
	var aTn = $( "#tabs" ).tabs( "option", "active" ) + 1;
	var aT = $('#tabs-' + aTn);
	aT.find('[data-updateme="please"]').unbind('focus').focus(function() {
		console.log("THIS");
		console.log(this);
		var mytv = $(this).val();
		console.log('mytv');
		$(this).blur(function() {
			if($(this).val() != mytv) {
				var partdata = {};
				
				partdata.job = 'update_part';
				partdata.partcolumn = $(this).attr('name');
				partdata.partval = $(this).val();
				partdata.entryid = $(this).parent('[data-pn]').attr('data-entryid');
		
				var postit = {};
	
				postit.annyong = 'hello';
				postit.purpose = 'parts';
				postit.what = JSON.stringify(partdata);
				console.log('POSTING PART UPDATE');
				console.log(postit);
				$.post('<?=MY_URL?>',
					postit,
					function(data) { 
						$('[data-entryid="' + partdata.entryid + '"]')
							.find('[name="' + partdata.partcolumn + '"]')
							.val(partdata.partval);
						console.log(data);
					}
				);
			}
			$(this).unbind('blur');
		});
	});
}

</script>

		<?
	}
}
