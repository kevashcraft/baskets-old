<?php
namespace Baskets\Pages\Proposals;
class Lister
{
	public static function lister()
	{

		$proppage = isset(\Baskets\Tools\Tracker::$uri[3]) ? \Baskets\Tools\Tracker::$uri[3] : '0';
		$propstartcount = $proppage * 50;

		$propstm = \Baskets::$db->prepare("SELECT proposals.*,contractors.contractor FROM proposals,contractors WHERE contractors.id=proposals.contractorid AND proposals.id>=? ORDER BY proposals.id ASC LIMIT 50");
		$propstm->execute(array($propstartcount));

		$totalprops = \Baskets::$db->query("SELECT COUNT(*) FROM proposals")->fetchColumn();

		$numofpages = $totalprops / 50;

		\Baskets\Pages\Framework::page_header('Proposals List | Baskets');
?>
<div class='main-viewer'>
	<div class='dash-box'>
		<div class='dash-box-header'>
			<h1><i class='fa fa-leaf'></i> All Proposals</h1>
			<a href='<?=MY_URL?>/proposals/new' class='add-button'>Add Proposal</a>
		</div>
	</div>
	<ul class='list prop-list'>


<?php
	while($prop = $propstm->fetch())
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
<?
		\Baskets\Pages\Framework::page_footer();
	}
}
