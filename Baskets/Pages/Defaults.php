<?php
namespace Baskets\Pages;
class Defaults
{
	public static function Header()
	{
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel='stylesheet' type='text/css' href='<?php echo MY_URL ?>/reset.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo MY_URL ?>/style.css' />
	<script src='https://code.jquery.com/jquery-2.1.1.min.js'></script>
	<meta name="viewport" content="width=device-width, user-scalable=no">
<?php
	 }


	public static function PageHeader()
	{
?>
	<div class='page-header'>
		<img src='<?php echo MY_URL?>/img/logo.png'>
		<img src='<?php echo MY_URL?>/img/text.png'>
	</div>
<?php


	}




	public static function Footer()
	{
		if(\Baskets\Tools\Tracker::$uri[1] != \Baskets\Tools\Tracker::$page)
		{ ?>
<script>
	$(document).ready(function(){
		window.history.pushState("", "", '/<?php echo \Baskets\Tools\Tracker::$page ?>')		
	});
</script>
		<?php } ?>

</html>
<?php
	}

}
