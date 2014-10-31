<?php
namespace Baskets\Pages\Bids;
class Adder
{

	public static function adder() {
		\Baskets\Pages\Framework::page_header('Add Bid | Baskets');
?>
<div class='main-viewer' id='main-viewer'>
<div class='dash-box'>
	<div class='dash-box-header'>
		<h1><i class="fa fa-leaf"></i> Add Bid</h1>
		<a href='<?=MY_URL?>/bids/list' class='add-button'>List Bids</a>
	</div>
</div>
<div class='dash-box'>
	<form class='form'>
		<div>
			Supplier: <input type='text' name='supplier'>
		</div>
		<div>
			Bid: <input type='text' name='bid'>
		</div>
		<div>
			Valid: <input type='date' name='validstart' value="<?=date('Y-m-d')?>"> to <input type='date' name='validend' value="<?=date('Y-m-d', strtotime('+1 year'))?>">
		</div>

		<div class='form-parts'>
			<div class='bid-parts'>
				<input type='text' name='supplierPartID' placeholder='Part ID'>
				<input type='text' name='partid' placeholder='Part Name'>
				<input type='text' name='description' placeholder='Description'>
				<input type='number' min='0' step='0.01' name='price' placeholder='Price'>
			</div>
		</div>
		<div>
			<input type='submit'>
		</div>
	</form>
	<script>
	$(function() { autopartid($('[name="partid"]').first()) });
	function autopartid(that) {
		$(that).focus(function() {
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
		
			$(that).blur(function () { 
				$(this).autocomplete('destroy');
				part_desc(this);
			}); 
		
		});
	}
	
	function part_desc(that){
		$.ajax({
			url: '<?=MY_URL?>',
			data: { tiny: 'part_info',
						tp: that.value
					}
		}).done(function(data){
			var pdata = JSON.parse(data);
			$(that).siblings('[name="description"]').val(pdata.desc);
		});
	}


	var suppliersList = [];
	$.get( '<?=MY_URL?>', { 
		tiny: 'suppliers'
	}, function (data) {
			var parsed = JSON.parse(data);
			for(var x in parsed) {
				suppliersList.push( parsed[x] );
			}
			console.log(suppliersList);
			$('[name="supplier"]').autocomplete({
				source: suppliersList
			});
		}
	);
		$('.bid-parts').children('input').focus( function() {
				var tt = $(this).parent('.bid-parts');
				console.log('checking...');
			if(!(tt.next('.bid-parts').length)) {
				console.log('adding parts');
				tt.parent('.form-parts').append(tt.clone(true,true));
				autopartid($('[name="partid"]').last());
			}
		});


		$('.form').submit( function( event ) {
			event.preventDefault();
			var basicInfo = {
									supplier: $('[name="supplier"]').val(),
									bid: $('[name="bid"]').val(),
									validstart: $('[name="validstart"]').val(),

									validend: $('[name="validend"]').val()
								};

			var parts = [];

			$('.bid-parts').each( function() {
				var tt = $(this),
					to = {
							supid: tt.children('[name="supplierPartID"]').val(),
							partid: tt.children('[name="partid"]').val(),
							partdesc: tt.children('[name="description"]').val(),
							price: tt.children('[name="price"]').val()
							};


				parts.push(to);
			});


			var formData = {
									annyong: 'hello',
									purpose: 'bids',
									job: 'add_bid',
									basicinfo: JSON.stringify(basicInfo),
									arrayinfo: JSON.stringify(parts)
								};


			$.post('<?=MY_URL?>',formData,function(data) { alert(data) });

		});

	</script>
</div>
<?
	\Baskets\Pages\Framework::page_footer();
	}
}	
