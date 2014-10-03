<?php
namespace Baskets\Pages;
class MySettings
{
	public static function display()
	{
		Defaults::header();	
?>
		<title>Baskets - My Settings</title>
	</head>
	<body>
		<?php Defaults::pageHeader() ?>
		<?php Defaults::pageNavigation() ?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box db-dark-gradient'>
				<h1><i class="fa fa-leaf"></i> Settings</h1>
				<p>This is the Baskets dashboard, the starting place for all users.<br>
					Click <a href='<?php echo MY_URL ?>?annyong=hello&purpose=logout'>here</a> to logout
				</p>
			</div>
		</div>
	</body>
<?php
		Defaults::footer();
	}
}
