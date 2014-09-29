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
	<div>click <a href='<?php echo MY_URL ?>?annyong=hello&purpose=logout'>here</a> to logout</div>	
	</body>
<?php
		Defaults::footer();
	}
}
