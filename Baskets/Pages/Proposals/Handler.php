<?php
namespace Baskets\Pages\Proposals;
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
				Adder::adder();
				break;
			case 'pdf':
				PDFer::pdfer();
				break;
			default:
				\Baskets\Pages\Framework::$newurl = 'proposals';
				self::overview();
				break;
		}
	}

	public static function overview()
	{
		\Baskets\Pages\Framework::page_header('Proposals Overview | Baskets');
	?>
		<div class='main-viewer' id='main-viewer'>
			<div class='dash-box'>
				<div class='dash-box-header'>
					<h1><i class="fa fa-leaf"></i> Proposals Overview</h1>
				</div>
				<a href='<?=MY_URL?>/proposals/list'><h2>List all of the proposals</h2></a>
				<a href='<?=MY_URL?>/proposals/add'><h2>Add a new proposal</h2></a>

			</div>
		</div>
	<?
	}

}
