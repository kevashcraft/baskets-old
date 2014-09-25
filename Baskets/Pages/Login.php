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
			<form method='post'>
				<input type='email' name='usremail' id='usremail' placeholder='Email Address'><br />
				<input type='password' name='usrpass' id='usrpass' placeholder='Password'><br />
				<input type='submit' value='login'>
			</form>
		</div>
		<script>
			$(document).ready(function(){
				$('#usremail').focus();
			});
		</script>
	</body>
<?php
		  Defaults::Footer();
	}
}
