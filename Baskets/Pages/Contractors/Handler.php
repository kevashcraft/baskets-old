<?php
namespace Baskets\Pages\Contractors;
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
				\Baskets\Pages\Framework::$newurl = 'contractors';
				self::overview();
				break;
		}
	}

	public static function overview() {
		\Baskets\Pages\Framework::page_header('Contractors Overview | Baskets');
?>
<div class='main-viewer'>
	<div class='dash-box'>
		<div class='db-header'>
			<h1><i class='fa fa-leaf'></i> Contractors Overview</h1>
		</div>
	</div>
	<div class='dash-box'>
		<a href='<?=MY_URL?>/contractors/add'>Add a Contractor</a>
		<br>
		<a href='<?=MY_URL?>/contractors/list'>List of all Contractors</a>
	</div>
</div>
<?
		\Baskets\Pages\Framework::page_footer();
	}
}
