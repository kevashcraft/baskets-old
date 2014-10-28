<?php
namespace Baskets\Pages\Proposals;
Class Adder
{

	public static function adder()
	{
		\Baskets\Pages\Framework::page_header('Add Proposal | Baskets');
		Styles::juitabs();
		Scripts::defscripts();
		Scripts::juitabs();
		Scripts::propform();
		Scripts::propformer();
		?>


<div id="dialog" title="Add Option">
	<form>
		<fieldset class="ui-helper-reset">
			<label for="tab_title">Option</label>
			<input type="text" name="tab_title" id="tab_title" placeholder="Option Name" class="ui-widget-content ui-corner-all">
		</fieldset>
	</form>
</div>


<div id='room-template' data-rn='0' style='display:none'>
	<input type='text' name='room' placeholder='Room' >
	<div class='parts'>
		<div id='part-template' class='part' data-pn='1'>
			<input type='text' class='partid' name='partid' placeholder='Part ID' >
			<input type='number' min='1' name='partqty' value='1' placeholder='Qty'>
			<input type='text' name='partdesc' placeholder='Description'>
			<select class='partprices' name='partprices'>
			</select>
			<input type='number' class='partprice' step='0.01' min='0.01' name='partprice' placeholder='0.01'>
			Rough In <input type='radio' name='installpoint' value='roughin'> |
			Tub Set <input type='radio' name='installpoint' value='tubset'> |
			Trim <input type='radio' name='installpoint' value='trim'>
			Hours: <input type='number' name='parthours' min='0'>
		</div>
	</div>
</div>



<div class='main-viewer'>
	<div class='dash-box'>
		<div class='db-header'>
			<h1><i class="fa fa-leaf"></i> All Proposals</h1>
		</div>
		<form>
			<div>
				<span>Contractor: </span>
				<input type='text' name='contractor'>
			</div>
			<div>
				<span>Model: </span>
				<input type='text' name='model'>
			</div>
			<div>
				<span>Valid: </span>
				<input type='date' name='datestart' value="<?=date('Y-m-d')?>">
				<span> to </span>
				<input type='date' name='dateend' value="<?=date('Y-m-d', strtotime('+1 year'))?>">
			</div>
			<div>
				<span>Labor Hourly Rate: </span>
				<input type='text' name='laborrate' value='75'>
			</div>
			<div>
				<span>Part Markup %: </span>
				<input type='text' name='partmarkup' value='35'>
			</div>
			<div>
				<span>Desired Margin %: </span>
				<input type='text' name='desiredmargin' value='27'>
			</div>
			<div>
				<span>Tax Rate %: </span>
				<input type='text' name='taxrate' value='7'>
			</div>
			<button id="add_tab">Add Option</button>
			<div id='tabs'>
				<ul>
					<li><a href='#tabs-1' data-tabname='Main'>Main</a><span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
				</ul>
				<div id='tabs-1' data-tabname='Main'>
					<div class='rooms'></div>
					<div>
						<span>Adjustment</span>
						<input type='number' name='adjustment' step='.01' value='0'>
					</div>
					<div>
						<span>Parts $</span><span class='partstotal'>
					</div>
				</div>
			</div>
			<h2>Options</h2>
			<div class='options-info'>
			</div>
			<div>
				<button onclick='propO(event)'>Click Me!</button>
			</div>
		</form>
</div>
		<?
		\Baskets\Pages\Framework::page_footer();
	}

}
