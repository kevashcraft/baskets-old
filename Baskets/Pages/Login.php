<?php
namespace Baskets\Pages;
class Login
{
	function __construct()
	{
		Defaults::Header();
?>
		<title>Baskets - Login</title>
	</head>
	<body>
		<div class='login-box'>
			<?php if(isset($_COOKIE['hello'])) echo $_COOKIE['hello'] ?>
			<form method='post' id='login-form'>
				<input type='email' name='usremail' id='usremail' placeholder='Email Address'><br />
				<input type='password' name='usrpass' id='usrpass' placeholder='Password'><br />
				<input type='hidden' name='annyong' value='hello' >
				<input type='submit' value='login'>
			</form>
		</div>
		<script>
			$(document).ready(function(){
				$('#usremail').focus();
				window.history.pushState("", "", '/');
				$('#login-form').submit(function (event) {
					event.preventDefault();
					var posting = $.post( '<?php echo MY_URL ?>', $(this).serialize() );
					posting.done(function(data){
						alert(data);
					});
				});
			});
		</script>
	</body>
<?php
		  Defaults::Footer();
	}
}
