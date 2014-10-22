<?php
namespace Baskets\Pages\Parts;
class Handler
{
	public static function begin()
	{

		$page = isset(\Baskets\Tools\Tracker::$uri[2]) ? \Baskets\Tools\Tracker::$uri[2] : 'default';
		switch ($page)
		{
			case 'list':
				Lister::lister();
				break;
			case 'add':
				Addder::adder();
				break;
			case 'upload':
				Uploader::uploader();
				break;
			case 'find':
				FindAPart::display();
				break;
			default:
				\Baskets\Pages\Framework::$newurl = 'parts';
				self::overview();
				break;
		}
	}

	public static function overview()
	{

		\Baskets\Pages\Framework::page_header('Parts Overview | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Parts Overview</h1>
				</div>
				<a href='<?=MY_URL?>/parts/list'><h2>List all of the parts</h2></a>
				<a href='<?=MY_URL?>/parts/add'><h2>Add a new part</h2></a>
				<a href='<?=MY_URL?>/parts/upload'><h2>Upload a parts list</h2></a>
				<a href='<?=MY_URL?>/parts/find'><h2>Find a part</h2></a>

			</div>
		</div>
	<?
	}


}
