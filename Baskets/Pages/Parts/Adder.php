<?php
namespace Baskets\Pages;
class Adder
{

///////////////////////////////////////

//////////     ADD PARTS    ///////////

///////////////////////////////////////

	public static function add()
	{
		Framework::page_header('Add Parts | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Add Parts</h1>
					<a href='<?=MY_URL?>/parts/list' class='add-button'>Parts List</a>
				</div>
				<p>
					<form class='formula-one'>
						<div class='line'>
							<div class='group small'>
								<label for='part-id'>ID</label>
								<span><input type='text' name='part-id' id='part-id'></span>
							</div>
							<div class='group large'>
								<label for='part-name'>Name</label>
								<span><input type='text' name='part-name' id='part-name'></span>
							</div>
						</div>	
						<div class='line'>
							<div class='group'>
								<label for='part-desc'>Description</label><br>
								<textarea name='part-desc' id='part-desc'></textarea>
							</div>
						</div>
						<div class='input-wrap'>
							<input type='hidden' name='job' value='add_part'>
							<input type='submit'>
						</div>
					</form>
					<script>
						$( 'form' ).submit( function( event ) {
							event.preventDefault();
							var formdata = JSON.stringify($( this ).serializeObject());
							sender('parts',formdata);
						});
					</script>
				</p>
			</div>
		</div>
	<?	Framework::page_footer();
	}

}
