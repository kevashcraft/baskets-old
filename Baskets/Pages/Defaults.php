<?php
namespace Baskets\Pages;
class Defaults
{
	public static function Header()
	{
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel='stylesheet' type='text/css' href='<?php echo MY_URL ?>/reset.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo MY_URL ?>/style.css' />
	<link rel='icon' type='image/png' href='<?php echo MY_URL ?>/favicon.png'>
	<script src='https://code.jquery.com/jquery-2.1.1.min.js'></script>
	<meta name="viewport" content="width=device-width, user-scalable=no">
<?php
	 }


	public static function PageHeader()
	{
?>
	<div class='page-header'>
		<img src='<?php echo MY_URL?>/img/logo.png'>
		<img src='<?php echo MY_URL?>/img/text.png'>
	</div>
	<div class='page-nav-container'>
		<div class='nav-img'><img src='<?php echo MY_URL?>/img/nav-basket.jpg'></div>
		<nav>
			<li>Parts
				<li><a href='<?php echo MY_URL?>/parts/list'>List</a></li>
				<li><a href='<?php echo MY_URL?>/parts/suppliers'>Suppliers</a></li>
				<li><a href='<?php echo MY_URL?>/parts/bids'>Bids</a></li>
			</li>
			<li>Estimates
				<li><a href='<?php echo MY_URL?>/estimates/new'>New</a></li>
				<li><a href='<?php echo MY_URL?>/estimates/active'>Active</a></li>
				<li><a href='<?php echo MY_URL?>/estimates/all'>All</a></li>
			</li>
			<li>Warehouse
				<li><a href='<?php echo MY_URL?>/warehouse/check-in'>Check-in</a></li>
				<li><a href='<?php echo MY_URL?>/warehouse/orders'>Orders</a></li>
				<li><a href='<?php echo MY_URL?>/warehouse/report'>Report</a></li>
			</li>
			<li>Scheduling
				<li><a href='<?php echo MY_URL?>/scheduling/today'>Today</a></li>
				<li><a href='<?php echo MY_URL?>/scheduling/tomorrow'>Tomorrow</a></li>
				<li><a href='<?php echo MY_URL?>/scheduling/pending'>Pending</a></li>
			</li>
			<li>Jobs
				<li><a href='<?php echo MY_URL?>/jobs/new'>New</a></li>
				<li><a href='<?php echo MY_URL?>/jobs/current'>Current</a></li>
				<li><a href='<?php echo MY_URL?>/jobs/all'>All</a></li>
			</li>
			<li>Parts
				<li><a href='<?php echo MY_URL?>/workers/hire'>Hire</a></li>
				<li><a href='<?php echo MY_URL?>/workers/all'>All</a></li>
				<li><a href='<?php echo MY_URL?>/workers/search'>Search</a></li>
			</li>
		</nav>
	</div>
<?php


	}




	public static function Footer()
	{
		if(\Baskets\Tools\Tracker::$uri[1] != \Baskets\Tools\Tracker::$page)
		{ ?>
<script>
	$(document).ready(function(){
		window.history.pushState("", "", '/<?php echo \Baskets\Tools\Tracker::$page ?>')		
	});
</script>
		<?php } ?>

</html>
<?php
	}

}
