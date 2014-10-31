<?php
namespace Baskets\Pages\Contractors;
class Lister
{
	public static function lister() {
		\Baskets\Pages\Framework::page_header('Contractors List | Baskets');
		$page = isset(\Baskets\Tools\Tracker::$uri[3]) ? intval(\Baskets\Tools\Tracker::$uri[3]) : '0';
		$page = is_int($page) ? $page : '0';
		$limit = $page * 50;
		$stm = \Baskets::$db->prepare("SELECT * FROM contractors ORDER BY id ASC LIMIT $limit,50");
		$stm->execute();
		$totalrows = \Baskets::$db->query("SELECT COUNT(*) FROM contractors")->fetchColumn();
		$numopages = $totalrows / 50;
?>
<div class='main-viewer' id='main-viewer'>
	<div class='dash-box'>
		<div class='dash-box-header'>
			<h1><i class="fa fa-leaf"></i> All Contractors</h1>
			<a href='<?=MY_URL?>/contractors/add' class='add-button'>Add Contractor</a>
		</div>
		<div class='db-list'>
			<h2>Total Contractors: <?=$totalrows?></h2>
			<a href='<?=MY_URL?>/contractors/list'>1</a>...
<?	for($x=-1;$x<=1;$x++) {
					$nexprev = $page + $x + 1;
					if($nexprev <= 1 || $nexprev > $numopages) continue;
					$url = MY_URL . '/bids/list/' . $nexprev;
					echo "<a href='$url'>$nexprev</a> ";
} ?>
			<ul class='contractor-list list'>
				<li class='col-titles'>
					<span class='contractor-id'>ID</span>
					<span class='contractor-name'>Contractor</span>
					<span class='contractor-contactperson'>Contact</span>
					<span class='contractor-phone'>Phone #</span>
				</li>
<?	while($contractors = $stm->fetch()) { ?>
				<li>
					<span class='contractor-id'><?=$contractors['id']?></span>
					<span class='contractor-name'><?=$contractors['contractor']?></span>
					<span class='contractor-contactperson'><?=$contractors['contactperson']?></span>
					<span class='contractor-phone'><?=$contractors['phone']?></span>
				</li>
<?	} ?>
			</ul>
		</div>
	</div>
</div>
<?
		\Baskets\Pages\Framework::page_footer();
	}
}
