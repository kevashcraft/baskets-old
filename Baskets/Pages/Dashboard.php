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
				</p>
			</div>
			<div class='dash-box db-construction-information'>
				<h1><i class="fa fa-exclamation-triangle"></i> Construction Information</h1>
				<p>This week is focused on the parts section of the application. First: building the database structure, then the input forms and display tables.
				</p>
			</div>
		</div>
	</body>
<?php
		Defaults::footer();
	}
}
