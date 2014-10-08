<?
namespace Baskets\Tools;
class JavaScript
{
	public static function setUrl($url)
	{ ?>
	<script>
		$(document).ready(function(){
			window.history.pushState("", "", '/<?=$url?>');
		});
	</script>
	<? }
}
