<?php
namespace Baskets\Pages;
class Dashboard
{
	public static function display()
	{
		Defaults::header();	
?>
		<title>Baskets - Dashboard</title>
	</head>
	<body>
		<?php Defaults::pageHeader() ?>
		<?php Defaults::pageNavigation() ?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<h1><i class="fa fa-leaf"></i> Welcome</h1>
				<p>This is the Baskets dashboard, the starting place for all users.<br>
					Click <a href='<?php echo MY_URL ?>?annyong=hello&purpose=logout'>here</a> to logout
				</p>
			</div>
			<div class='dash-box db-construction-information'>
				<h1><i class="fa fa-exclamation-triangle"></i> Construction Information</h1>
				<p>This is where you can find info about the current status of the program. Things like, we've got a new
					menu bar that is swipeable on mobile devices but don't try any of the links yet because they don't go anywhere.<br>
					Also, coming soon! User settings page...
				</p>
			</div>
		</div>
	</body>
<?php
		Defaults::footer();
	}
}
