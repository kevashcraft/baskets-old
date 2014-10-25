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
		tabTemplate = "<li><a href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close' role='presentation'>Remove Tab</span></li>",	
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
		  li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) ),
		  tabContentHtml = "<div class='rooms'></div>";
 
		tabs.find( ".ui-tabs-nav" ).append( li );
		tabs.append( "<div id='" + id + "'>" + tabContentHtml + "</div>"  );
		tabs.tabs( "refresh" );
		tabCounter++;
		var tC = tabCounter - 2;
		$( "#tabs" ).tabs( "option", "active", tC );
		console.log('sdvsdv');
		console.log(tC);
		console.log($( "#tabs" ).tabs( "option", "active"));
		addRoomInput(0);
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
						$(function() { addRoomInput(0) } );

						function addRoomInput(rn) {
							var activeT = $( "#tabs" ).tabs( "option", "active" );
							activeT += 1;
							console.log('roominput');
							console.log(rn);
							console.log($( "#tabs" ).tabs( "option", "active"));
							var nrn = rn + 1;
							console.log('a');
							console.log($('#tabs-' + activeT).find('[data-rn="' + nrn + '"]').length);
							if ( $('#tabs-' + activeT).find('[data-rn="' + nrn + '"]').length == false ) {
								var newRoom = document.getElementById('room-template').cloneNode(true);
								newRoom.id = '';
								newRoom.getElementsByClassName('part')[0].id='';
								newRoom.setAttribute('data-rn',nrn);
								newRoom.style.display = 'block';
								newRoom.getElementsByTagName('input')[0].onfocus = function() { addRoomInput(nrn); };
								newRoom.getElementsByClassName('partprice')[0].onchange = function() { 
									$(this).siblings('select').val('custom');
									update_totals(); 
								};
								newRoom.getElementsByClassName('partprices')[0].onchange = function() { if(this.value != 'custom') $(this).siblings('.partprice').val(this.value); };
								newRoom.getElementsByClassName('partid')[0].onfocus = function() { addPartInput(nrn,1); };
								$('#tabs-' + activeT).find('.rooms').append(newRoom);
	
							}

						}


						function addPartInput(rn,pn) {
							var activeT = $( "#tabs" ).tabs( "option", "active" );
							activeT += 1;
							var npn = pn + 1;
							if ( $('#tabs-' + activeT).find('[data-rn="' + rn + '"]').find('[data-pn="' + npn + '"]').length == false ) {
								var newPart = document.getElementById('part-template').cloneNode(true);
								newPart.id = '';
								newPart.setAttribute('data-pn',npn);
								newPart.getElementsByClassName('partid')[0].onfocus = function() { addPartInput(rn,npn); };
								newPart.getElementsByClassName('partprice')[0].onchange = function() {
									$(this).siblings('select').val('custom');
									update_totals();
								};
								$('#tabs-' + activeT).find('[data-rn="'+rn+'"]').find('.parts').append(newPart);
								var curPart = $('#tabs-' + activeT).find('[data-rn="' + rn + '"]').find('[data-pn="' + pn + '"]').find('.partid')[0];
								partautoc(curPart);
								curPart.onfocus = function () { partautoc(this); };

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


function update_totals() {
	var totes = 0;


	var parts_tote = 0;
	$('input[class="partprice"]').each(function() {
		console.log($(this).val());
		parts_tote += Number($(this).val());
	});
	$('input[name="parts-total"]').val(parts_tote);
	totes += parts_tote;

	var labor = Number($('input[name="labor-total"]').val());
	totes += labor;


	var adjust = Number($('input[name="adjustment"]').val());
	totes += adjust;


	var profits = totes - parts_tote - labor;

	var promar = (( profits / totes ) * 100) + '%';
	console.log(promar);

	$('input[name="profit-margin"]').val(promar);
	$('input[name="profits"]').val(profits);
	$('input[name="total-dollar"]').val(totes);




}

</script>

		<?
	}
}
