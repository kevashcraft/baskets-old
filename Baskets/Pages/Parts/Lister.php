<?php
namespace Baskets\Pages\Parts;
class Lister
{

	public static function lister()
	{
		\Baskets\Pages\Framework::page_header('Parts List | Baskets');
		$page = isset(\Baskets\Tools\Tracker::$uri[3]) ? intval(\Baskets\Tools\Tracker::$uri[3]) : '0';
		$page = is_int($page) ? $page : '0';
		$limit = $page * 50;
		$stm = \Baskets::$db->prepare("SELECT * FROM parts ORDER BY partid ASC LIMIT $limit,50");
		$stm->execute();
		$totalrows = \Baskets::$db->query("SELECT COUNT(*) FROM parts")->fetchColumn();
		$numopages = $totalrows / 50;
?>
<div class='main-viewer' id='main-viewer'>
	<div class='dash-box'>
		<div class='dash-box-header'>
			<h1><i class="fa fa-leaf"></i> All Parts</h1>
			<a href='<?=MY_URL?>/parts/add' class='add-button'>Add Parts</a>
		</div>
		<div class='page_list'>
			<h2>Total Parts: <?=$totalrows?></h2>
			<a href='<?=MY_URL?>/parts/list'>1</a>...
<?	for($x=-1;$x<=1;$x++) {
					$nexprev = $page + $x + 1;
					if($nexprev <= 1 || $nexprev > $numopages) continue;
					$url = MY_URL . '/parts/list/' . $nexprev;
					echo "<a href='$url'>$nexprev</a> ";
} ?>
		</div>
		<ul class='part-list list'>
			<li class='col-titles'>
				<span class='part-id'>ID</span>
				<span class='part-partid'>PartID</span>
				<span class='part-partdesc'>Description</span>
				<span class='part-upc'>UPC</span>
			</li>
<?	while($parts = $stm->fetch()) { ?>
			<li>
				<span class='part-id'><?=$parts['id']?></span>
				<span class='part-partid'><?=$parts['partid']?></span>
				<span class='part-partdesc'><?=$parts['partdesc']?></span>
				<span class='part-upc'><?=$parts['upc']?></span>
			</li>
<?	} ?>
		</ul>
	</div>
</div>
<?
		\Baskets\Pages\Framework::page_footer();
	}
}
