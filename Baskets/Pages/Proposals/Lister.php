<?php
namespace Baskets\Pages\Proposals;
class Lister
{
	public static function lister()
	{
		$page = isset(\Baskets\Tools\Tracker::$uri[3]) ? intval(\Baskets\Tools\Tracker::$uri[3]) : '0';
		$page = is_int($page) ? $page : '0';
		$limit = $page * 50;
		$stm = \Baskets::$db->prepare("SELECT proposals.*,contractors.contractor FROM proposals,contractors WHERE contractors.id=proposals.contractorid ORDER BY proposals.id ASC LIMIT $limit,50");
		$stm->execute();
		$totalrows = \Baskets::$db->query("SELECT COUNT(*) FROM proposals")->fetchColumn();
		$numopages = $totalrows / 50;


		\Baskets\Pages\Framework::page_header('Proposals List | Baskets');
?>
<div class='main-viewer'>
	<div class='dash-box'>
		<div class='dash-box-header'>
			<h1><i class='fa fa-leaf'></i> All Proposals</h1>
			<a href='<?=MY_URL?>/proposals/new' class='add-button'>Add Proposal</a>
		</div>
		<div class='page_list'>
			<h2>Total Proposals: <?=$totalrows?></h2>
			<a href='<?=MY_URL?>/proposals/list'>1</a>...
			<?
				for($x=-1;$x<=1;$x++) {
					$nexprev = $page + $x + 1;
					if($nexprev <= 1 || $nexprev > $numopages) continue;
					$url = MY_URL . '/proposals/list/' . $nexprev;
					echo "<a href='$url'>$nexprev</a> ";
				}
			?>
		</div>
		<ul class='list prop-list'>

<?php
	while($prop = $stm->fetch())
	{
?>
			<li>
				<span class='prop-id'><?=$prop['id']?></span>
				<span class='prop-contractor'><?=$prop['contractor']?></span>
				<span class='prop-model'><?=$prop['model']?></span>
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
