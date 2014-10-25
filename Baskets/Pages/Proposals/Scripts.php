<?php
namespace Baskets\Pages\Proposals;
class Scripts
{

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
		$(tabContentHtml).find('.partname').html('');
		$(tabContentHtml).find('.partprices').html("<option value='custom'>Custom</option>");
		$(tabContentHtml).find('.partprice').val('');
		$(tabContentHtml).find('.partid').val('');



		tabs.find( ".ui-tabs-nav" ).append( li );
		tabs.append( tabContentHtml  );
		tabs.tabs( "refresh" );
		tabCounter++;
		var tC = tabCounter - 2;
		$( "#tabs" ).tabs( "option", "active", tC );
		copyRooms(cT);
		$('input[name="room"]').focus(function() { addRoomInput(this); } );
		$('input[name="partid"]').focus(function() { addPartInput(this); partautoc(this); } );
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
								newRoom.getElementsByClassName('part')[0].id='';
								newRoom.setAttribute('data-rn',nrn);
								newRoom.style.display = 'block';
								newRoom.getElementsByTagName('input')[0].onfocus = function() { addRoomInput(this); };
								newRoom.getElementsByClassName('partprice')[0].onchange = function() { 
									$(this).siblings('select').val('custom');
									update_totals(); 
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
			update_totals();
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
}


var indinum = 0;
function updateTotes( tabnumi ) {

	var activeTabNumber = tabnumi,
		aT = $('#tabs-'+activeTabNumber),
		laborRate = $('[name="laborrate"]').val(),
		partMarkUp = $('[name="partmarkup"]').val(),
		desiredMargin = $('[name="desiredmargin"]').val(),
		contingency = $('[name="contingency"]').val(),
		taxRate = $('[name="taxrate"]').val(),
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
		totesParts += Number($(this).val());
	});
	cl('totesParts='+totesParts);
	
	var partCost = 0;
	aT.find('[name="partprices"]').each(function() {
		partCost += Number($(this).val());
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

	aT.children('tab-title').html(newTitle);

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





</script>

		<?
	}
}
