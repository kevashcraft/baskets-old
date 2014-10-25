<?php
namespace Baskets\Pages\Proposals;
Class Adder
{

	public static function adder()
	{
		\Baskets\Pages\Framework::page_header('Add Proposal | Baskets');
		?>

<style>
#dialog label, #dialog input { display:block; }
#dialog label { margin-top: 0.5em; }
#dialog input, #dialog textarea { width: 95%; }
#tabs { margin-top: 1em; }
#tabs li .ui-icon-close { float: left; margin: 0.4em 0.2em 0 0; cursor: pointer; }
#add_tab { cursor: pointer; }
</style>


<script>
$(function() {
	var tabTitle = $('#tab_title'),
		tabTemplate = "<li><a href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close' role='presentation'>Remove Tab</span></li>",	
		tabCounter = 2;

	var tabs = $('#tabs').tabs();
	var dialog = $( "#dialog" ).dialog({
		autoOpen: false,
		modal: true,
		buttons: {
		  Add: function() {
			 addTab();
			 $( this ).dialog( "close" );
		  },
		  Cancel: function() {
			 $( this ).dialog( "close" );
		  }
		},
		close: function() {
		  form[ 0 ].reset();
		}
	 });
	 // addTab form: calls addTab function on submit and closes the dialog
	 var form = dialog.find( "form" ).submit(function( event ) {
		addTab();
		dialog.dialog( "close" );
		event.preventDefault();
	 });
 
	 // actual addTab function: adds new tab using the input from the form above
	 function addTab() {
		var label = tabTitle.val() || "Tab " + tabCounter,
		  id = "tabs-" + tabCounter,
		  li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) ),
		  tabContentHtml = "Tab " + tabCounter + " content.";
 
		tabs.find( ".ui-tabs-nav" ).append( li );
		tabs.append( "<div id='" + id + "'><p>" + tabContentHtml + "</p></div>" );
		tabs.tabs( "refresh" );
		tabCounter++;
	 }
 
	 // addTab button: just opens the dialog
	 $( "#add_tab" )
		.button()
		.click(function() {
			event.preventDefault();
		  dialog.dialog( "open" );
		});
 
	 // close icon: removing the tab on click
	 tabs.delegate( "span.ui-icon-close", "click", function() {
		var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
		$( "#" + panelId ).remove();
		tabs.tabs( "refresh" );
	 });
 
	 tabs.bind( "keyup", function( event ) {
		if ( event.altKey && event.keyCode === $.ui.keyCode.BACKSPACE ) {
		  var panelId = tabs.find( ".ui-tabs-active" ).remove().attr( "aria-controls" );
		  $( "#" + panelId ).remove();
		  tabs.tabs( "refresh" );
		}
	 });
  });


</script>











<div id="dialog" title="Add Option">
	<form>
		<fieldset class="ui-helper-reset">
			<label for="tab_title">Option</label>
			<input type="text" name="tab_title" id="tab_title" placeholder="Option Name" class="ui-widget-content ui-corner-all">
		</fieldset>
	</form>
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
					<p>This is some data inside tab one</p>
				</div>
			</div>






		</form>





</div>









		<?
		\Baskets\Pages\Framework::page_footer();
	}

}
