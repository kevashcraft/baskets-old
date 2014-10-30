<?php
namespace Baskets\Pages\Suppliers;
class Lister
{

	public static function lister() {
		\Baskets\Pages\Framework::page_header('Parts List | Baskets');
		$page = isset(\Baskets\Tools\Tracker::$uri[3]) ? intval(\Baskets\Tools\Tracker::$uri[3]) : '0';
		$page = is_int($page) ? $page : '0';
		$limit = $page * 50;
		$stm = \Baskets::$db->prepare("SELECT * FROM suppliers ORDER BY id ASC LIMIT $limit,50");
		$stm->execute();
		$totalrows = \Baskets::$db->query("SELECT COUNT(*) FROM suppliers")->fetchColumn();
		$numopages = $totalrows / 50;
?>
<div class='main-viewer' id='main-viewer'>
	<div class='dash-box'>
		<div class='dash-box-header'>
			<h1><i class="fa fa-leaf"></i> All Suppliers</h1>
			<a href='<?=MY_URL?>/suppliers/add' class='add-button'>Add Supplier</a>
		</div>
		<div class='db-list'>
			<h2>Total Suppliers: <?=$totalrows?></h2>
			<a href='<?=MY_URL?>/bids/list'>1</a>...
<?	for($x=-1;$x<=1;$x++) {
					$nexprev = $page + $x + 1;
					if($nexprev <= 1 || $nexprev > $numopages) continue;
					$url = MY_URL . '/bids/list/' . $nexprev;
					echo "<a href='$url'>$nexprev</a> ";
} ?>
			<ul class='supplier-list list'>
				<li class='col-titles'>
					<span class='supplier-id'>ID</span>
					<span class='supplier-name'>Supplier</span>
					<span class='supplier-contact'>Contact</span>
					<span class='supplier-phone'>Phone #</span>
				</li>
<?	while($suppliers = $stm->fetch()) { ?>
				<li>
					<span class='supplier-id'><?=$suppliers['id']?></span>
					<span class='supplier-name'><?=$suppliers['supplier']?></span>
					<span class='supplier-contact'><?=$suppliers['contactperson']?></span>
					<span class='supplier-phone'><?=$suppliers['phone']?></span>
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
