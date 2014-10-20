<?php
namespace Baskets\Pages;
class Dashboard
{
	public static function display()
	{
		Framework::page_header('Dashboard | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<h1><i class="fa fa-leaf"></i> Welcome</h1>
				<p>This is the Baskets dashboard, the starting place for all users.<br>
				</p>
			</div>
			<div class='dash-box db-construction-information'>
				<h1><i class="fa fa-exclamation-triangle"></i> Construction Information</h1>
				<p><b>Parts lists!</b><br>
					We've got parts lists from Kohler & Delta! This week all 3,000+ parts will be added to the database with ID's, names, and descriptions. Along with adding these parts, the Warehouse database and controller are being created with will work with the Proposals and Parts objects to prepare for upcoming jobs.
				</p>
			</div>
		</div>
<?php
		Framework::page_footer();
	}
}
