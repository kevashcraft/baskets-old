<?php
namespace Baskets\Pages\Parts;
class Lister
{

	public static function lister()
	{
		\Baskets\Pages\Framework::page_header('Parts List | Baskets');
		$partpage = isset(\Baskets\Tools\Tracker::$uri[3]) ? intval(\Baskets\Tools\Tracker::$uri[3]) : '0';
		$partpage = is_int($partpage) ? $partpage : '0';
		$partlimit = $partpage * 50;
		$partsstm = \Baskets::$db->prepare("SELECT * FROM parts ORDER BY partid ASC LIMIT $partlimit,50");
		$pricestm = \Baskets::$db->prepare("SELECT price FROM bidparts WHERE partid=? ORDER BY price ASC");
		$partsstm->execute();
		$totalparts = \Baskets::$db->query("SELECT COUNT(*) FROM parts")->fetchColumn();
		$numopartpages = $totalparts / 50;
?>
<div class='main-viewer' id='main-viewer'>
	<div class='dash-box'>
		<div class='dash-box-header'>
			<h1><i class="fa fa-leaf"></i> All Parts</h1>
			<a href='<?=MY_URL?>/parts/add' class='add-button'>Add Parts</a>
		</div>
		<div class='page_list'>
			<h2>Total Parts: <?=$totalparts?></h2>
			<a href='<?=MY_URL?>/parts/list'>1</a>...
			<?
				for($x=-1;$x<=1;$x++) {
					$prev = $partpage + $x + 1;
					if($prev <= 0 || $prev > $numopartpages) continue;
					$url = MY_URL . '/parts/list/' . $prev;
					echo "<a href='$url'>$prev</a> ";
				}
			?>
		</div>
		<ul class='part-list list'>
<?
	while($parts = $partsstm->fetch()) {
?>
			<li>
				<span class='part-id'><?=$parts['id']?></span>
				<span class='part-partid'><?=$parts['partid']?></span>
				<span class='part-partdesc'><?=$parts['partdesc']?></span>
				<span class='part-upc'><?=$parts['upc']?></span>
			</li>
<?
		}
?>
		</ul>
	</div>
</div>
<?
		\Baskets\Pages\Framework::page_footer();
	}
}
