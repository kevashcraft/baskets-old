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
	<script src='https://code.jquery.com/jquery-2.1.1.min.js'></script>
	<link rel='stylesheet' type='text/css' href='<?php echo MY_URL ?>/reset.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo MY_URL ?>/style.css' />
	<link rel='icon' type='image/png' href='<?php echo MY_URL ?>/favicon.png'>
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<script src='<?php echo MY_URL ?>/js/hammer.min.js'></script>
	<script src='<?php echo MY_URL ?>/js/jquery.hammer.js'></script>
	<link rel='stylesheet' type='text/css' href='<?php echo MY_URL?>/lib/Font-Awesome/css/font-awesome.min.css'>
<?php
	 }


	public static function pageHeader(){?>
	<div class='page-header'>
		<a href='<?php echo MY_URL ?>'>
			<img src='<?php echo MY_URL?>/img/logo.png'><img src='<?php echo MY_URL?>/img/text.png'>
		</a>
		<?php if(isset($_SESSION['userid'])) { ?> 
		<div class='user-box'>
			<span class='user-email'><?php echo $_SESSION['useremail'] ?> <i class="fa fa-sort-desc"></i></span>
			<div class='user-dropdown'>
				<a href='<?php echo MY_URL ?>/mysettings'>Settings</a>
				<a href='<?php echo MY_URL ?>/?annyong=hello&purpose=logout'>LogOut</a>
			</div>			
		</div>

		<?php } ?>
	</div>
<?php } 

	public static function pageNavigation(){?>
<div class='page-nav-container'>
	<div class='nav-img'><a href='http://bordeauplumbing.com/' target='_blank'><img src='<?php echo MY_URL?>/img/business-logo.png'></a></div>
	<nav class='nav-main'>
		<ul>
			<li>Parts
				<ul>
					<li><a href='<?php echo MY_URL?>/parts/list'>List</a></li>
					<li><a href='<?php echo MY_URL?>/parts/suppliers'>Suppliers</a></li>
					<li><a href='<?php echo MY_URL?>/parts/bids'>Bids</a></li>
				</ul>
			</li>
			<li>Estimates
				<ul>
					<li><a href='<?php echo MY_URL?>/estimates/new'>New</a></li>
					<li><a href='<?php echo MY_URL?>/estimates/active'>Active</a></li>
					<li><a href='<?php echo MY_URL?>/estimates/all'>All</a></li>
				</ul>
			</li>
			<li>Warehouse
				<ul>
					<li><a href='<?php echo MY_URL?>/warehouse/check-in'>Check-in</a></li>
					<li><a href='<?php echo MY_URL?>/warehouse/orders'>Orders</a></li>
					<li><a href='<?php echo MY_URL?>/warehouse/report'>Report</a></li>
				</ul>
			</li>
			<li>Scheduling
				<ul>
					<li><a href='<?php echo MY_URL?>/scheduling/today'>Today</a></li>
					<li><a href='<?php echo MY_URL?>/scheduling/tomorrow'>Tomorrow</a></li>
					<li><a href='<?php echo MY_URL?>/scheduling/pending'>Pending</a></li>
				</ul>
			</li>
			<li>Jobs
				<ul>
					<li><a href='<?php echo MY_URL?>/jobs/new'>New</a></li>
					<li><a href='<?php echo MY_URL?>/jobs/current'>Current</a></li>
					<li><a href='<?php echo MY_URL?>/jobs/all'>All</a></li>
				</ul>
			</li>
			<li>Workers
				<ul>
					<li><a href='<?php echo MY_URL?>/workers/hire'>Hire</a></li>
					<li><a href='<?php echo MY_URL?>/workers/all'>All</a></li>
					<li><a href='<?php echo MY_URL?>/workers/search'>Search</a></li>
				</ul>
			</li>
		</ul>
	</nav>
</div>
<?php }




	public static function Footer(){?>
<script>
	function sender(why,what)
	{
		$.ajax({
			url: "<?php echo MY_URL ?>",
			type: 'post',
			data: { annyong: 'hello',
						purpose: why,
						what: what
					}
		}).done(function( data ) {
			alert(data);
		});

	}


	$(document).ready(function(){
		// Update url to current page if different than originally requested page
		<?php if(\Baskets\Tools\Tracker::$uri[1] != \Baskets\Tools\Tracker::$page) {?>
					window.history.pushState("", "", '/<?php echo \Baskets\Tools\Tracker::$page ?>');
		<?php }?>

	});
</script>

		<?php	if(\Baskets\Tools\Tracker::$mobile){ ?>
<script>
		//
		// Mobile Devices
		//
	$(document).ready(function(){
		if(window.innerWidth < 800){

		// Hide nav menu after login
		<?php if(!isset($_COOKIE['vetNavSlide'])) {?>
			setTimeout(function(){
				$('.page-nav-container').css('transition','left 1s ease').css('left','-260px');
			},1500);
			setTimeout(function(){
				$('.page-nav-container').css('transition','left .5s ease');
			},2000);
		<?php } else { ?>
			$('.page-nav-container').css('left','-260px');
			setTimeout(function(){
				$('.page-nav-container').css('transition','left .5s ease');
			},100);
		<?php } ?>


		$(document.body).hammer().on("swiperight",function(e){
			$('.page-nav-container').css('left','0');
		});
		$(document.body).hammer().on("swipeleft",function(e){
			$('.page-nav-container').css('left','-260px');
		});


		}
	});
</script>
		<?php } ?>



</html>
<?php
	}

}
