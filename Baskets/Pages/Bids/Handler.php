<?php
namespace Baskets\Pages\Bids;
class Handler
{

	public static function display()
	{
		switch (\Baskets\Tools\Tracker::$uri[2])
		{
			case 'list':
				Lister::lister();
				break;
			case 'add':
				Adder::adder();
				break;
			case 'bid':
				Bidder::bidder();
				break;
			default:
				\Baskets\Pages\Framework::$newurl = 'bids';
				self::overview();
				break;
		}
	}


	public static function overview() {
		\Baskets\Pages\Framework::page_header('Bids Overview | Baskets');
?>
<div class='main-viewer'>
	<div class='dash-box'>
		<div class='db-header'>
			<h1><i class='fa fa-leaf'></i> Bids Overview</h1>
		</div>
	</div>
	<div class='dash-box'>
		<a href='<?=MY_URL?>/bids/add'>Add a bid</a>
		<br>
		<a href='<?=MY_URL?>/bids/list'>List of all bids</a>
	</div>
</div>
<?
		\Baskets\Pages\Framework::page_footer();
	}
}
