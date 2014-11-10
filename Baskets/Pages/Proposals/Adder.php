<?php
namespace Baskets\Pages\Proposals;
class Adder
{

	public static function adder() {
		\Baskets\Pages\Framework::page_header('Add Proposal | Baskets');
?>

<head>
	<script src="bower_components/platform/platform.js"></script>
	<link rel='import' href='../bower_components/core-pages/core-pages.html'>
	<link rel='import' href='../bower_components/core-overlay/core-overlay.html'>
	<link rel='import' href='../bower_components/core-icons/core-icons.html'>
	<link rel='import' href='../bower_components/paper-button/paper-button.html'>
	<link rel='import' href='../bower_components/paper-fab/paper-fab.html'>

</head>

<div class='main-viewer'>
	<div class='dash-box'>
		<div class='db-header'>
			<h1>Create a new proposal</h1>
		</div>
	</div>
</div>

<script>
</script>
<?
		\Baskets\Pages\Framework::page_footer();
	}
}		
