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
				<h1><i class="fa fa-exclamation-triangle"></i> Construction Information NEW</h1>
				<p><b>C</b>urrently working on the new proposal page<p>
				<p><b>Goal</b>Create new job PDFs</p>
			</div>
		</div>
<?php
		Framework::page_footer();
	}
}
