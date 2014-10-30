<?php
namespace Baskets\Pages\Suppliers;
class Adder
{
	public static function adder() {
		\Baskets\Pages\Framework::page_header('Add Supplier | Baskets');
?>
<div class='main-viewer' id='main-viewer'>
	<div class='dash-box'>
		<div class='db-header'>
			<h1><i class="fa fa-leaf"></i> Add Supplier</h1>
			<a href='<?=MY_URL?>/suppliers/list' class='add-button'>List Suppliers</a>
		</div>
		<form class='form'>
			<div>
				Supplier: <input type='text' name='supplier'>
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
				Phone #: <input type='tel' name='phone'>
			</div>
			<div>
				Fax #: <input type='tel' name='fax'>
			</div>
			<div>
				<input type='submit'>
			</div>
		</form>
	</div>
</div>
<script>
$('.form').submit( function ( event ) {
	event.preventDefault();

	var basicInfo = {
							supplier: $('[name="supplier"]').val(),
							contactperson: $('[name="contactperson"]').val(),
							email: $('[name="email"]').val(),
							address: $('[name="address"]').val(),
							phone: $('[name="phone"]').val(),
							fax: $('[name="fax"]').val(),
						};
	
	var formData = {
							annyong: 'hello',
							purpose: 'suppliers',
							job: 'add_supplier',
							basicinfo: JSON.stringify(basicInfo),
						};
	
	$.post('<?=MY_URL?>',formData,function(data) { alert(data) });
	
});
</script>			
<?
	\Baskets\Pages\Framework::page_footer();
	}
}
