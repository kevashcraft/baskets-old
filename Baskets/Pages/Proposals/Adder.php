<?php
namespace Baskets\Pages\Proposals;
Class Adder
{

	public static function adder()
	{
		\Baskets\Pages\Framework::page_header('Add Proposal | Baskets');
		Styles::juitabs();
		Scripts::juitabs();
		Scripts::propform();
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
			<input type='text' class='partid' name='partid' placehold='Part ID' >
			<span class='partname'></span>
			<select class='partprices'>
				<option value='custom'>Custom</option>
			</select>
			<input type='number' class='partprice' step='0.01' min='0.01' name='partprice' placeholder='0.01'>
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
			<button id="add_tab">Add Option</button>
			<div id='tabs'>
				<ul>
					<li><a href='#tabs-1'>Main</a><span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
				</ul>
				<div id='tabs-1'>
					<div class='rooms'>
					</div>
				</div>
			</div>
		</form>
</div>
		<?
		\Baskets\Pages\Framework::page_footer();
	}

}
