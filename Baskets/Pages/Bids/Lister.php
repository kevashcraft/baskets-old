<?php
namespace Baskets\Pages\Bids;
class Lister
{

	public static function lister() {
		\Baskets\Pages\Framework::page_header('Parts List | Baskets');
		$page = isset(\Baskets\Tools\Tracker::$uri[3]) ? intval(\Baskets\Tools\Tracker::$uri[3]) : '0';
		$page = is_int($page) ? $page : '0';
		$limit = $page * 50;
		$stm = \Baskets::$db->prepare("SELECT bids.*,suppliers.supplier FROM bids,suppliers WHERE suppliers.id=bids.supplierid ORDER BY id ASC LIMIT $limit,50");
		$stm->execute();
		$totalrows = \Baskets::$db->query("SELECT COUNT(*) FROM bids")->fetchColumn();
		$numopages = $totalrows / 50;
?>
<div class='main-viewer' id='main-viewer'>
	<div class='dash-box'>
		<div class='dash-box-header'>
			<h1><i class="fa fa-leaf"></i> All Bids</h1>
			<a href='<?=MY_URL?>/parts/add' class='add-button'>Add Bid</a>
		</div>
		<div class='db-list'>
			<h2>Total Bids: <?=$totalrows?></h2>
			<a href='<?=MY_URL?>/bids/list'>1</a>...
<?	for($x=-1;$x<=1;$x++) {
					$nexprev = $page + $x + 1;
					if($nexprev <= 1 || $nexprev > $numopages) continue;
					$url = MY_URL . '/bids/list/' . $nexprev;
					echo "<a href='$url'>$nexprev</a> ";
} ?>
			<ul class='bid-list list'>
				<li class='col-titles'>
					<span class='bid-id'>ID</span>
					<span class='bid-bidid'>PartID</span>
					<span class='bid-biddesc'>Description</span>
					<span class='bid-upc'>UPC</span>
				</li>
<?	while($bids = $stm->fetch()) { ?>
				<li>
					<span class='bid-id'><?=$bids['id']?></span>
					<span class='bid-bid'><?=$bids['bid']?></span>
					<span class='bid-supplier'><?=$bids['supplier']?></span>
					<span class='bid-valid'><?=$bids['valid']?></span>
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
