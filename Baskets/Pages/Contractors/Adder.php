<?php
namespace Baskets\Pages\Contractors;
class Adder
{

	public static function adder() {
		\Baskets\Pages\Framework::page_header('Add Contractor | Baskets');
?>
<div class='main-viewer'>
	<div class='dash-box'>
		<div class='db-header'>
			<h1><i class="fa fa-leaf"></i> Add Contractor</h1>
			<a href='<?=MY_URL?>/contractors/list' class='add-button'>List Contractors</a>
		</div>
	<form class='form'>
		<div>
			Contractor: <input type='text' name='contractor'>
		</div>
		<div>
			Contact Person: <input type='text' name='contactperson'>
		</div>
		<div>
			Email: <input type='email' name='email'>
		</div>
		<div>
			Address: <input type='text' name='address'>
		</div>
		<div>
			Phone: <input type='tel' name='phone'>
		</div>
		<div>
			Fax: <input type='tel' name='fax'>
		</div>
		<div>
			<input type='submit'>
		</div>
	</form>
</div>
<script>

$('.form').submit( function( event ) {
	event.preventDefault();
	var basicInfo = {
							contractor: $('[name="contractor"]').val(),
							contactperson: $('[name="contactperson"]').val(),
							email: $('[name="email"]').val(),
							address: $('[name="address"]').val(),
							phone: $('[name="phone"]').val(),
							fax: $('[name="fax"]').val(),
						};

	var formData = {
							annyong: 'hello',
							purpose: 'contractors',
							job: 'add_contractor',
							basicinfo: JSON.stringify(basicInfo),
						};


	$.post('<?=MY_URL?>',formData,function(data) { alert(data) });

});

</script>
<?
	\Baskets\Pages\Framework::page_footer();
	}
}
