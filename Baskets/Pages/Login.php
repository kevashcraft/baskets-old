<?php
namespace Baskets\Pages;
class Login
{
	public static function display()
	{
		Defaults::Header();
?>
		<title>Baskets - Login</title>
	</head>
	<body>
		<?php Defaults::pageHeader() ?>
		<div class='login-box'>
			<?php if(isset($_COOKIE['hello'])) echo $_COOKIE['hello'] ?>
			<form method='post' id='login-form'>
				<input type='email' name='email' id='email' placeholder='Email Address' autocomplete='on'><br />
				<input type='password' name='password' id='password' placeholder='Password'><br />
				<input type='hidden' name='annyong' value='hello' >
				<input type='hidden' name='purpose' value='login' >
				<input type='submit' value='login'>
			</form>
		</div>
		<script>
			$(document).ready(function(){
				$('#email').focus();
				$('#login-form').submit(function (event) {
					event.preventDefault();
					var posting = $.post( '<?php echo MY_URL ?>', $(this).serialize() );
					posting.done(function(data){
						info = JSON.parse(data);
						if (info[0] == 0)
						{
							alert(info[1]);
						}
						else {
							window.location = '<?php echo MY_URL?>';
						}
					});
				});
			});
		</script>
	</body>
<?php
		  Defaults::Footer();
	}
}
