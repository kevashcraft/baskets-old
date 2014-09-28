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
		<div>click <a href='<?php echo MY_URL ?>?annyong=hello&purpose=logout'>here</a> to logout</div>	
		<nav>
			<li><a href='<?php echo MY_URL ?>/contractors'>Contractors</a></li>
			<li><a href='<?php echo MY_URL ?>/models'>Models</a></li>
			<li><a href='<?php echo MY_URL ?>/suppliers'>Suppliers</a></li>
			<li><a href='<?php echo MY_URL ?>/parts'>Parts</a></li>
			<li><a href='<?php echo MY_URL ?>/bids'>Bids</a></li>
			<li><a href='<?php echo MY_URL ?>/inventory'>Inventory</a></li>
			<li><a href='<?php echo MY_URL ?>/workers'>Workers</a></li>
	</body>
<?php
		Defaults::footer();
	}
}
