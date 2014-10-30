<?php
namespace Baskets\Pages\Suppliers;
class Handler
{

	public static function begin()
	{
		switch (\Baskets\Tools\Tracker::$uri[2])
		{
			case 'list':
				Lister::lister();
				break;
			case 'add':
				Adder::adder();
				break;
			default:
				Framework::$newurl = 'suppliers';
				self::overview();
				break;
		}
	}

	public static function overview() {

		\Baskets\Pages\Framework::page_header('Suppliers Overview | Baskets');
?>
<div class='main-viewer'>
	<div class='dash-box'>
		<div class='db-header'>
			<h1><i class='fa fa-left'></i> Suppliers Overview</h1>
		</div>
		<a href='<?=MY_URL?>/suppliers/list'>List of Suppliers</a>
		<a href='<?=MY_URL?>/suppliers/add'>Add a Supplier</a>
	</div>
</div>
<?
		\Baskets\Pages\Framework::page_footer();
	}
}
