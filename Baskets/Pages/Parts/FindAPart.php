<?php
namespace Baskets\Pages\Parts;
class FindAPart
{

	public static function display()
	{
		\Baskets\Pages\Framework::page_header('Find a Part | Baskets');
		?>

		
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Find a Part</h1>
				</div>
				<form>
					Part ID: <input type='text' name='partid'>
				</form>
			</div>
		</div>


		
		<script>

			$('[name="partid"]').autocomplete({
				source: function (request, response) {
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





		</script>




		<?
		\Baskets\Pages\Framework::page_footer();
	}

}
