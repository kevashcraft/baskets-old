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
				Password: <input type='password' name='newpassword' id='newpassword'><button onclick="sender('newpass',$('#newpassword').val())">Change</button>
				</p>
			</div>
		</div>
	</body>
<?php
		Defaults::footer();
	}
}
