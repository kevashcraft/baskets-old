<?
namespace Baskets\Pages;
class Framework
{
	public static $newurl;


//
//	Page Header
//


	public static function page_header($title)
	{ ?>
<!DOCTYPE html>
<html>
	<head>
		<script src='<?=MY_URL?>/js/jquery-2.1.1.min.js'></script>
		<link rel='stylesheet' type='text/css' href='<?=MY_URL?>/reset.css' />
		<link rel='stylesheet' type='text/css' href='<?=MY_URL?>/style.css' />
		<link rel='icon' type='image/png' href='<?=MY_URL?>/favicon.png'>
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<script src='<?=MY_URL?>/js/hammer.min.js'></script>
		<script src='<?=MY_URL?>/js/jquery.hammer.js'></script>
		<link rel='stylesheet' type='text/css' href='<?=MY_URL?>/lib/Font-Awesome/css/font-awesome.min.css'>
		<title><?=$title?></title>
		<? if(isset(self::$newurl)) self::updateURL() ?>
	</head>
	<body>
	<?
	self::page_navigation();
	self::page_top();
	}


//
//	Header Options
//

	public static function updateURL()
	{ ?>
		<script>
			window.history.pushState("", "", '/<?=self::$newurl?>');
		</script>
	<? }




//
// General JS
//

	public static function genjs()
	{ ?>
<script>
function sender(why,what) {
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

$.fn.serializeObject = function()
{
   var o = {};
   var a = this.serializeArray();
   $.each(a, function() {
		if (o[this.name] !== undefined) {
			if (!o[this.name].push) {
				o[this.name] = [o[this.name]];
			}
		o[this.name].push(this.value || '');
		} else {
			o[this.name] = this.value || '';
		}
	});
	return o;
};
</script>
	<? }



//
//	Mobile Menu
//
	public static function mobile_menu()
	{ ?>
<script>
   $(function(){
      $(document.body).hammer().on("swiperight",function(e){
         $('.page-nav-container').css('left','0');
      });
      $(document.body).hammer().on("swipeleft",function(e){
         $('.page-nav-container').css('left','-260px');
      });
	});
</script>
	<? }

//
//	Page Top
//
	public static function page_top(){ ?>
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



//
//	Navigation
//
   public static function page_navigation()
	{ ?>
<div class='page-nav-container'>
	<div class='nav-img'><a href='http://bordeauplumbing.com/' target='_blank'><img src='<?php echo MY_URL?>/img/business-logo.png'></a></div>
	<nav class='nav-main'>
	  <ul>
		 <li>Parts
			<ul>
				<li><a href='<?php echo MY_URL?>/parts/list'>List</a></li>
				<li><a href='<?php echo MY_URL?>/suppliers/list'>Suppliers</a></li>
				<li><a href='<?php echo MY_URL?>/bids/list'>Bids</a></li>
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






//
//	Footer
//

	public static function page_footer()
	{ 
	self::genjs();
	if(\Baskets\Tools\Tracker::$mobile) self::mobile_menu();
	echo '</body>';
	echo '</html>';
	}
}
